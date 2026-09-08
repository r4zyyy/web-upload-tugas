<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    /**
     * Display all 17 meetings with their assignment status and stats.
     */
    public function index(Request $request)
    {
        $search = $request->input('q');
        $filter = $request->input('filter', 'all'); // 'all', 'submitted', 'pending'

        $meetingsQuery = Meeting::with('submissions')->orderBy('meeting_number', 'asc');

        if (!empty($search)) {
            $meetingsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('topic', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('meeting_number', $search);
            });
        }

        $allMeetings = $meetingsQuery->get();

        // Calculate global statistics across all 17 meetings
        $totalMeetings = 17;
        $all17Meetings = Meeting::with('submissions')->get();
        $submittedMeetingsCount = $all17Meetings->filter(function ($m) {
            return $m->submissions->isNotEmpty();
        })->count();
        $pendingMeetingsCount = $totalMeetings - $submittedMeetingsCount;
        $progressPercentage = $totalMeetings > 0 ? round(($submittedMeetingsCount / $totalMeetings) * 100) : 0;
        $totalUploadedFiles = Submission::count();

        // Filter collections if requested
        $meetings = $allMeetings->filter(function ($m) use ($filter) {
            if ($filter === 'submitted') {
                return $m->submissions->isNotEmpty();
            } elseif ($filter === 'pending') {
                return $m->submissions->isEmpty();
            }
            return true;
        });

        return view('assignments.index', [
            'meetings' => $meetings,
            'totalMeetings' => $totalMeetings,
            'submittedCount' => $submittedMeetingsCount,
            'pendingCount' => $pendingMeetingsCount,
            'progressPercentage' => $progressPercentage,
            'totalFiles' => $totalUploadedFiles,
            'currentFilter' => $filter,
            'searchQuery' => $search,
        ]);
    }

    /**
     * Store an uploaded assignment file for a specific meeting.
     */
    public function store(Request $request, Meeting $meeting)
    {
        $validated = $request->validate([
            'student_name' => 'nullable|string|max:100',
            'student_nim' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000',
            'assignment_file' => 'required|file|max:51200|extensions:pdf,zip,rar,7z,doc,docx,ppt,pptx,xls,xlsx,png,jpg,jpeg,txt,html',
        ], [
            'assignment_file.required' => 'Silakan pilih berkas tugas yang ingin diunggah.',
            'assignment_file.file' => 'Berkas tidak valid.',
            'assignment_file.max' => 'Ukuran berkas maksimal adalah 50 MB.',
            'assignment_file.extensions' => 'Format berkas harus berupa PDF, ZIP, RAR, DOC/DOCX, PPTX, Gambar, atau TXT/HTML.',
        ]);

        $file = $request->file('assignment_file');
        $originalName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $mimeType = $file->getClientMimeType();

        // Generate sanitized file name with timestamp
        $extension = $file->getClientOriginalExtension();
        $safeBasename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $uniqueFilename = "tugas_pertemuan_{$meeting->meeting_number}_" . time() . "_{$safeBasename}.{$extension}";

        // Save into storage/app/public/submissions/pertemuan_X
        $directory = "submissions/pertemuan_{$meeting->meeting_number}";
        $path = $file->storeAs($directory, $uniqueFilename, 'public');

        Submission::create([
            'meeting_id' => $meeting->id,
            'student_name' => (!empty($validated['student_name'])) ? $validated['student_name'] : 'Mahasiswa',
            'student_nim' => $validated['student_nim'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'file_path' => $path,
            'original_filename' => $originalName,
            'file_size' => $fileSize,
            'mime_type' => $mimeType,
            'submitted_at' => now(),
        ]);

        return redirect()->route('assignments.index')
            ->with('success', "Tugas untuk Pertemuan {$meeting->meeting_number} berhasil diunggah!");
    }

    /**
     * Download the submitted assignment file.
     */
    public function download(Submission $submission)
    {
        if (!Storage::disk('public')->exists($submission->file_path)) {
            return redirect()->route('assignments.index')
                ->with('error', 'Berkas fisik tidak ditemukan di penyimpanan server.');
        }

        return Storage::disk('public')->download(
            $submission->file_path,
            $submission->original_filename
        );
    }

    /**
     * Delete a submission (e.g. to re-upload).
     */
    public function destroy(Submission $submission)
    {
        $meetingNumber = $submission->meeting->meeting_number;

        if (Storage::disk('public')->exists($submission->file_path)) {
            Storage::disk('public')->delete($submission->file_path);
        }

        $submission->delete();

        return redirect()->route('assignments.index')
            ->with('success', "Berkas tugas Pertemuan {$meetingNumber} berhasil dihapus.");
    }
}

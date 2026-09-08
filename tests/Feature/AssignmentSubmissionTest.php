<?php

namespace Tests\Feature;

use App\Models\Meeting;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AssignmentSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_displays_all_17_meetings(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Pengembangan Aplikasi Web');
        $response->assertSee('Muhammad Deden Firdaus, S.T, M.Kom');
        $response->assertSee('Pertemuan 01');
        $response->assertSee('Pertemuan 17');
        $response->assertSee('Belum Dikumpulkan');
    }

    public function test_can_upload_assignment_file_for_meeting(): void
    {
        Storage::fake('public');

        $meeting = Meeting::where('meeting_number', 1)->firstOrFail();

        $file = UploadedFile::fake()->create('tugas_pertemuan_1.pdf', 1024, 'application/pdf');

        $response = $this->post(route('assignments.upload', $meeting->id), [
            'student_name' => 'Budi Santoso',
            'student_nim' => '220101001',
            'notes' => 'Tugas pengenalan web dan struktur dokumen.',
            'assignment_file' => $file,
        ]);

        $response->assertRedirect(route('assignments.index'));
        $response->assertSessionHas('success');

        // Check database
        $this->assertDatabaseHas('submissions', [
            'meeting_id' => $meeting->id,
            'student_name' => 'Budi Santoso',
            'student_nim' => '220101001',
            'original_filename' => 'tugas_pertemuan_1.pdf',
        ]);

        $submission = Submission::first();
        Storage::disk('public')->assertExists($submission->file_path);

        // Check homepage shows submitted status
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Sudah Dikumpulkan');
        $homeResponse->assertSee('tugas_pertemuan_1.pdf');
    }

    public function test_can_download_assignment_file(): void
    {
        Storage::fake('public');

        $meeting = Meeting::where('meeting_number', 2)->firstOrFail();
        $file = UploadedFile::fake()->create('laporan_pertemuan_2.docx', 500, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        $this->post(route('assignments.upload', $meeting->id), [
            'student_name' => 'Siti Rahma',
            'assignment_file' => $file,
        ]);

        $submission = Submission::where('meeting_id', $meeting->id)->firstOrFail();

        $response = $this->get(route('assignments.download', $submission->id));
        $response->assertStatus(200);
    }

    public function test_can_delete_submitted_assignment(): void
    {
        Storage::fake('public');

        $meeting = Meeting::where('meeting_number', 3)->firstOrFail();
        $file = UploadedFile::fake()->create('source_code.zip', 2048, 'application/zip');

        $this->post(route('assignments.upload', $meeting->id), [
            'student_name' => 'Ahmad',
            'assignment_file' => $file,
        ]);

        $submission = Submission::where('meeting_id', $meeting->id)->firstOrFail();
        Storage::disk('public')->assertExists($submission->file_path);

        $deleteResponse = $this->delete(route('assignments.destroy', $submission->id));
        $deleteResponse->assertRedirect(route('assignments.index'));

        // Assert record is deleted
        $this->assertDatabaseMissing('submissions', [
            'id' => $submission->id,
        ]);
        Storage::disk('public')->assertMissing($submission->file_path);
    }
}

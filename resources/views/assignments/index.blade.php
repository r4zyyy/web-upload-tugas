@extends('layouts.app')

@section('title', 'Pengembangan Aplikasi Web - Portal Pengumpulan Tugas 17 Pertemuan')

@push('styles')
<style>
    /* Hero & Stats Section */
    .hero-panel {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
        border-radius: var(--radius-xl);
        padding: 2.5rem 2rem;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 20px 40px -15px rgba(49, 46, 129, 0.4);
        position: relative;
        overflow: hidden;
    }

    .hero-panel::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, rgba(99, 102, 241, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 2rem;
        align-items: center;
    }

    .hero-title-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        padding: 0.35rem 0.85rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .hero-title {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.25;
        margin-bottom: 0.75rem;
    }

    .hero-desc {
        font-size: 0.95rem;
        color: #c7d2fe;
        max-width: 580px;
        margin-bottom: 1.25rem;
    }

    .lecturer-info-card {
        display: inline-flex;
        align-items: center;
        gap: 0.85rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        padding: 0.65rem 1.15rem;
        border-radius: var(--radius-md);
        margin-bottom: 1.5rem;
    }

    .lecturer-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fde047;
        font-size: 1.1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .lecturer-text {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .lecturer-label {
        font-size: 0.725rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #c7d2fe;
        font-weight: 600;
    }

    .lecturer-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #ffffff;
    }

    /* Progress Widget */
    .progress-widget {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 0.75rem;
    }

    .progress-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #e0e7ff;
    }

    .progress-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #ffffff;
    }

    .progress-bar-bg {
        width: 100%;
        height: 10px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 9999px;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
        border-radius: 9999px;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.06);
        padding: 0.75rem;
        border-radius: var(--radius-sm);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .stat-num {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
    }

    .stat-text {
        font-size: 0.725rem;
        color: #c7d2fe;
        font-weight: 500;
    }

    /* Filter & Search Bar */
    .controls-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
        background: white;
        padding: 1rem 1.25rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        color: var(--slate-600);
        background: var(--slate-100);
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .filter-tab:hover {
        background: var(--slate-200);
        color: var(--dark);
    }

    .filter-tab.active {
        background: var(--primary);
        color: white;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
    }

    .search-box {
        position: relative;
        min-width: 280px;
    }

    .search-icon {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate-400);
        font-size: 0.9rem;
    }

    .search-input {
        width: 100%;
        padding: 0.55rem 0.85rem 0.55rem 2.3rem;
        border-radius: 9999px;
        border: 1px solid var(--slate-200);
        font-size: 0.85rem;
        outline: none;
        transition: var(--transition);
    }

    .search-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-glow);
    }

    /* Meetings Grid */
    .meetings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 1.5rem;
    }

    .meeting-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        overflow: hidden;
        position: relative;
    }

    .meeting-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: #cbd5e1;
    }

    .meeting-card.is-submitted {
        border-top: 4px solid var(--success);
    }

    .meeting-card.is-pending {
        border-top: 4px solid var(--warning);
    }

    .card-head {
        padding: 1.25rem 1.5rem 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .meeting-badge {
        font-size: 0.775rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--primary);
        background: var(--primary-light);
        padding: 0.3rem 0.75rem;
        border-radius: 9999px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.3rem 0.75rem;
        border-radius: 9999px;
    }

    .status-badge.badge-success {
        background: var(--success-light);
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .status-badge.badge-pending {
        background: var(--warning-light);
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .card-body {
        padding: 0 1.5rem 1.25rem 1.5rem;
        flex: 1;
    }

    .meeting-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    .meeting-topic {
        font-size: 0.8rem;
        color: var(--slate-500);
        font-weight: 500;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .meeting-topic i {
        color: var(--primary);
    }

    .meeting-desc {
        font-size: 0.85rem;
        color: var(--slate-600);
        line-height: 1.5;
        margin-bottom: 1.25rem;
    }

    /* Submission Info Box */
    .submission-info-box {
        background: var(--slate-50);
        border: 1px solid var(--slate-200);
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-top: auto;
    }

    .file-pill {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .file-icon-box {
        width: 36px;
        height: 36px;
        background: white;
        border: 1px solid var(--slate-200);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .file-meta {
        overflow: hidden;
    }

    .file-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-subtext {
        font-size: 0.725rem;
        color: var(--slate-500);
    }

    .student-note-preview {
        font-size: 0.775rem;
        color: var(--slate-600);
        background: white;
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--slate-200);
        margin-bottom: 0.75rem;
        font-style: italic;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .pending-action-box {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px dashed var(--slate-200);
    }

    /* Empty state */
    .empty-state {
        grid-column: 1 / -1;
        background: white;
        border-radius: var(--radius-lg);
        padding: 3rem 1.5rem;
        text-align: center;
        border: 1px solid var(--slate-200);
    }
    .empty-state i {
        font-size: 3rem;
        color: var(--slate-400);
        margin-bottom: 1rem;
    }

    @media (max-width: 900px) {
        .hero-content {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

    <!-- Hero / Progress Section -->
    <div class="hero-panel">
        <div class="hero-content">
            <div>
                <div class="hero-title-badge">
                    <i class="fa-solid fa-graduation-cap"></i> Mata Kuliah &bull; 17 Pertemuan
                </div>
                <h1 class="hero-title">Pengembangan Aplikasi Web</h1>
                <p class="hero-desc">
                    Portal pengumpulan dan arsip tugas mandiri mahasiswa selama 17 pertemuan perkuliahan. Unggah berkas tugas Anda langsung ke server website dan pantau progres penyelesaian tugas secara real-time.
                </p>

                <div class="lecturer-info-card">
                    <div class="lecturer-icon">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <div class="lecturer-text">
                        <span class="lecturer-label">Dosen Pengampu</span>
                        <span class="lecturer-name">Muhammad Deden Firdaus, S.T, M.Kom</span>
                    </div>
                </div>

                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <a href="#daftar-pertemuan" class="btn btn-outline" style="border: none;">
                        <i class="fa-solid fa-arrow-down"></i> Mulai Unggah Tugas
                    </a>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="progress-widget">
                <div class="progress-header">
                    <span class="progress-label">Progres Keseluruhan</span>
                    <span class="progress-value">{{ $progressPercentage }}%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $progressPercentage }}%;"></div>
                </div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-num">{{ $submittedCount }} / {{ $totalMeetings }}</div>
                        <div class="stat-text">Tugas Terkumpul</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">{{ $pendingCount }}</div>
                        <div class="stat-text">Belum Dikumpulkan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <div class="controls-bar" id="daftar-pertemuan">
        <div class="filter-tabs">
            <a href="{{ route('assignments.index', ['q' => $searchQuery]) }}" 
               class="filter-tab {{ $currentFilter === 'all' ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i> Semua ({{ $totalMeetings }})
            </a>
            <a href="{{ route('assignments.index', ['filter' => 'submitted', 'q' => $searchQuery]) }}" 
               class="filter-tab {{ $currentFilter === 'submitted' ? 'active' : '' }}">
                <i class="fa-solid fa-circle-check"></i> Sudah Dikumpulkan ({{ $submittedCount }})
            </a>
            <a href="{{ route('assignments.index', ['filter' => 'pending', 'q' => $searchQuery]) }}" 
               class="filter-tab {{ $currentFilter === 'pending' ? 'active' : '' }}">
                <i class="fa-solid fa-clock"></i> Belum Dikumpulkan ({{ $pendingCount }})
            </a>
        </div>

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="liveSearchInput" class="search-input" 
                   placeholder="Cari pertemuan atau materi..." 
                   value="{{ $searchQuery ?? '' }}">
        </div>
    </div>

    <!-- Meetings 17 Grid -->
    <div class="meetings-grid" id="meetingsGrid">
        @forelse($meetings as $meeting)
            @php
                $submission = $meeting->latestSubmission;
                $hasSubmission = !is_null($submission);
            @endphp
            <div class="meeting-card {{ $hasSubmission ? 'is-submitted' : 'is-pending' }}"
                 data-title="{{ strtolower($meeting->title) }}"
                 data-topic="{{ strtolower($meeting->topic) }}"
                 data-desc="{{ strtolower($meeting->description) }}"
                 data-number="{{ $meeting->meeting_number }}">
                
                <div class="card-head">
                    <span class="meeting-badge">
                        <i class="fa-solid fa-bookmark"></i> Pertemuan {{ sprintf('%02d', $meeting->meeting_number) }}
                    </span>
                    @if($hasSubmission)
                        <span class="status-badge badge-success">
                            <i class="fa-solid fa-check"></i> Sudah Dikumpulkan
                        </span>
                    @else
                        <span class="status-badge badge-pending">
                            <i class="fa-solid fa-clock"></i> Belum Dikumpulkan
                        </span>
                    @endif
                </div>

                <div class="card-body">
                    <h2 class="meeting-title">{{ $meeting->title }}</h2>
                    
                    @if($meeting->topic)
                        <div class="meeting-topic">
                            <i class="fa-solid fa-hashtag"></i>
                            <span>{{ $meeting->topic }}</span>
                        </div>
                    @endif

                    <p class="meeting-desc">{{ $meeting->description }}</p>

                    @if($hasSubmission)
                        <!-- File Info Container -->
                        <div class="submission-info-box">
                            <div class="file-pill">
                                <div class="file-icon-box">
                                    @php
                                        $ext = strtolower(pathinfo($submission->original_filename, PATHINFO_EXTENSION));
                                    @endphp
                                    @if(in_array($ext, ['zip', 'rar', '7z']))
                                        <i class="fa-solid fa-file-zipper"></i>
                                    @elseif($ext === 'pdf')
                                        <i class="fa-solid fa-file-pdf" style="color: #e11d48;"></i>
                                    @elseif(in_array($ext, ['png', 'jpg', 'jpeg']))
                                        <i class="fa-solid fa-file-image" style="color: #0284c7;"></i>
                                    @else
                                        <i class="fa-solid fa-file-lines"></i>
                                    @endif
                                </div>
                                <div class="file-meta">
                                    <div class="file-name" title="{{ $submission->original_filename }}">
                                        {{ $submission->original_filename }}
                                    </div>
                                    <div class="file-subtext">
                                        {{ $submission->formatted_file_size }} &bull; Diunggah {{ $submission->submitted_at ? $submission->submitted_at->diffForHumans() : '-' }}
                                    </div>
                                </div>
                            </div>

                            @if($submission->notes)
                                <div class="student-note-preview">
                                    <i class="fa-regular fa-comment-dots"></i> Catatan: "{{ $submission->notes }}"
                                </div>
                            @endif

                            <div class="card-actions">
                                <a href="{{ route('assignments.download', $submission->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-download"></i> Unduh
                                </a>
                                <button type="button" 
                                        class="btn btn-outline btn-sm"
                                        onclick="openUploadModal({{ $meeting->id }}, {{ $meeting->meeting_number }}, '{{ addslashes($meeting->title) }}', true)">
                                    <i class="fa-solid fa-arrows-rotate"></i> Ganti
                                </button>
                                <form action="{{ route('assignments.destroy', $submission->id) }}" 
                                      method="POST" 
                                      style="display: inline;" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-outline btn-sm" title="Hapus Berkas">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Pending Action -->
                        <div class="pending-action-box">
                            <button type="button" 
                                    class="btn btn-primary" 
                                    style="width: 100%;"
                                    onclick="openUploadModal({{ $meeting->id }}, {{ $meeting->meeting_number }}, '{{ addslashes($meeting->title) }}', false)">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Unggah Tugas Sekarang
                            </button>
                        </div>
                    @endif
                </div>

            </div>
        @empty
            <div class="empty-state">
                <i class="fa-solid fa-folder-open"></i>
                <h3>Tidak ada pertemuan ditemukan</h3>
                <p style="color: var(--slate-500); margin-top: 0.5rem;">Coba ubah kata kunci pencarian atau bersihkan filter.</p>
                <a href="{{ route('assignments.index') }}" class="btn btn-outline" style="margin-top: 1rem;">
                    Reset Filter
                </a>
            </div>
        @endforelse
    </div>

    <!-- Upload Modal -->
    <div class="modal-backdrop" id="uploadModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fa-solid fa-cloud-arrow-up" style="color: var(--primary);"></i>
                    <span id="modalHeaderTitle">Unggah Tugas Pertemuan</span>
                </div>
                <button type="button" class="modal-close" onclick="closeUploadModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="uploadForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div style="background: var(--slate-100); padding: 0.75rem 1rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem; font-size: 0.85rem;">
                        <span style="color: var(--slate-500);">Topik Pertemuan:</span>
                        <div id="modalMeetingSubtitle" style="font-weight: 700; color: var(--dark); margin-top: 0.2rem;"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="student_name">Nama Mahasiswa / Pengumpul</label>
                        <input type="text" name="student_name" id="student_name" class="form-input" placeholder="Masukkan nama Anda (cth: Budi Santoso)">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="student_nim">NIM (Nomor Induk Mahasiswa)</label>
                        <input type="text" name="student_nim" id="student_nim" class="form-input" placeholder="Masukkan NIM Anda (cth: 220101001)">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="notes">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" id="notes" class="form-textarea" rows="2" placeholder="Catatan untuk dosen atau keterangan link live demo..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Berkas Tugas <span style="color: var(--danger); font-weight: bold;">*</span></label>
                        <input type="file" name="assignment_file" id="assignmentFileInput" style="display: none;" required 
                               accept=".pdf,.zip,.rar,.7z,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.png,.jpg,.jpeg,.txt,.html">
                        
                        <div class="dropzone-area" id="dropzoneBox" onclick="document.getElementById('assignmentFileInput').click()">
                            <i class="fa-solid fa-cloud-arrow-up dropzone-icon"></i>
                            <div style="font-weight: 700; font-size: 0.95rem; color: var(--dark); margin-bottom: 0.25rem;">
                                Klik untuk memilih berkas atau seret ke sini
                            </div>
                            <div style="font-size: 0.775rem; color: var(--slate-500);">
                                Mendukung PDF, ZIP, RAR, Word (DOC/DOCX), PPT, Gambar, TXT (Maks. 50 MB)
                            </div>
                        </div>

                        <div class="file-selected-box" id="fileSelectedBox">
                            <div style="display: flex; align-items: center; gap: 0.5rem; overflow: hidden;">
                                <i class="fa-solid fa-file" style="font-size: 1.1rem;"></i>
                                <span id="fileNameDisplay" style="font-weight: 600; text-overflow: ellipsis; overflow: hidden;"></span>
                            </div>
                            <span id="fileSizeDisplay" style="font-size: 0.75rem; opacity: 0.85;"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeUploadModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitModal">
                        <i class="fa-solid fa-upload"></i> Simpan &amp; Unggah Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const uploadModal = document.getElementById('uploadModal');
    const uploadForm = document.getElementById('uploadForm');
    const modalHeaderTitle = document.getElementById('modalHeaderTitle');
    const modalMeetingSubtitle = document.getElementById('modalMeetingSubtitle');
    const fileInput = document.getElementById('assignmentFileInput');
    const dropzoneBox = document.getElementById('dropzoneBox');
    const fileSelectedBox = document.getElementById('fileSelectedBox');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileSizeDisplay = document.getElementById('fileSizeDisplay');
    const btnSubmitModal = document.getElementById('btnSubmitModal');

    function openUploadModal(meetingId, meetingNumber, meetingTitle, isReupload = false) {
        uploadForm.action = `/meetings/${meetingId}/upload`;
        modalHeaderTitle.innerHTML = isReupload 
            ? `<i class="fa-solid fa-arrows-rotate" style="color: var(--warning);"></i> Unggah Ulang Tugas Pertemuan ${meetingNumber}`
            : `<i class="fa-solid fa-cloud-arrow-up" style="color: var(--primary);"></i> Unggah Tugas Pertemuan ${meetingNumber}`;
        modalMeetingSubtitle.textContent = `Pertemuan ${meetingNumber}: ${meetingTitle}`;
        
        // Reset file selection
        fileInput.value = '';
        fileSelectedBox.style.display = 'none';
        btnSubmitModal.disabled = false;
        btnSubmitModal.innerHTML = '<i class="fa-solid fa-upload"></i> Simpan & Unggah Tugas';

        uploadModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeUploadModal() {
        uploadModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close on clicking backdrop
    uploadModal.addEventListener('click', function(e) {
        if (e.target === uploadModal) {
            closeUploadModal();
        }
    });

    // File change handler
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            fileNameDisplay.textContent = file.name;
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            fileSizeDisplay.textContent = `${sizeInMB} MB`;
            fileSelectedBox.style.display = 'flex';
        }
    });

    // Drag and drop handlers
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzoneBox.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropzoneBox.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzoneBox.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropzoneBox.classList.remove('dragover');
        });
    });

    dropzoneBox.addEventListener('drop', (e) => {
        if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    });

    // Loading indicator on submit
    uploadForm.addEventListener('submit', function() {
        btnSubmitModal.disabled = true;
        btnSubmitModal.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengunggah Berkas...';
    });

    // Instant Client-side Filter / Search
    const liveSearchInput = document.getElementById('liveSearchInput');
    if (liveSearchInput) {
        liveSearchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.meeting-card');

            cards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const topic = card.getAttribute('data-topic') || '';
                const desc = card.getAttribute('data-desc') || '';
                const number = card.getAttribute('data-number') || '';

                if (title.includes(keyword) || topic.includes(keyword) || desc.includes(keyword) || number === keyword) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>
@endpush

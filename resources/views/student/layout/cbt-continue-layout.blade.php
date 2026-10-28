<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume Examination | {{ $collegeSetup->name ?? 'CBT Portal' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('student/vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <style>
        :root { --green:#123d31; --green2:#18734f; --ink:#172b28; --muted:#6c7f75; --line:#e1e9e4; --bg:#f4f7f5; }
        *, *::before, *::after { box-sizing:border-box; }
        html, body { margin:0; min-height:100%; }
        body { background:var(--bg); color:var(--ink); font-family:Arial,Helvetica,sans-serif; line-height:1.5; }
        .cbt-header { background:var(--green); color:white; padding:18px max(24px,calc((100vw - 1180px)/2)); }
        .cbt-header-inner { display:flex; align-items:center; gap:15px; min-width:0; }
        .cbt-college-logo { width:55px; height:55px; object-fit:contain; background:#fff; border-radius:12px; padding:6px; flex-shrink:0; }
        .cbt-college-name { font-weight:700; font-size:17px; line-height:1.35; }
        .cbt-header-subtitle { font-size:12px; color:#c2ded0; margin-top:3px; }
        .cbt-container { max-width:1180px; margin:auto; padding:35px 24px 50px; }
        .cbt-page-intro { margin-bottom:24px; }
        .cbt-eyebrow { color:var(--green2); text-transform:uppercase; letter-spacing:1.3px; font-weight:800; font-size:11px; margin-bottom:8px; }
        .cbt-page-intro h1 { font-size:clamp(25px,3vw,35px); letter-spacing:-.6px; margin:0 0 8px; line-height:1.2; }
        .cbt-page-intro p { color:var(--muted); margin:0; font-size:14px; }
        .cbt-alert { padding:15px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; }
        .cbt-alert-success { color:#17603d; background:#e6f6ed; border:1px solid #b8dfc9; }
        .cbt-alert-error { color:#a52727; background:#fff1f1; border:1px solid #edc8c8; }
        .cbt-layout { display:grid; grid-template-columns:minmax(0,1.28fr) minmax(320px,0.9fr); gap:22px; align-items:start; }
        .cbt-card { border:1px solid var(--line); background:white; border-radius:18px; box-shadow:0 8px 32px rgba(20,55,40,.04); overflow:hidden; }
        .cbt-card-header { padding:22px 26px; border-bottom:1px solid var(--line); }
        .cbt-card-header h2 { margin:0; font-size:18px; display:flex; align-items:center; gap:10px; }
        .cbt-card-header h2 i { color:var(--green2); }
        .cbt-card-header p { margin:7px 0 0; font-size:13px; color:var(--muted); }
        .cbt-card-body { padding:26px; }
        .cbt-student-summary { display:flex; align-items:center; gap:17px; padding-bottom:23px; border-bottom:1px solid var(--line); margin-bottom:23px; }
        .cbt-photo { width:84px; height:84px; object-fit:cover; border-radius:15px; background:#edf3ef; border:3px solid #e4efe8; }
        .cbt-student-name { font-weight:800; font-size:20px; line-height:1.25; margin:0 0 7px; }
        .cbt-student-meta { color:var(--muted); font-size:13px; margin:2px 0; }
        .cbt-status { display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border-radius:100px; color:#865514; background:#fff4db; font-size:12px; font-weight:700; margin-bottom:16px; }
        .cbt-resume-title { font-size:20px; margin:0 0 10px; }
        .cbt-resume-desc { font-size:14px; color:var(--muted); line-height:1.75; margin:0 0 22px; }
        .cbt-time-card { background:#edf7f0; border:1px solid #c8e8d4; border-radius:13px; padding:19px 21px; margin-bottom:24px; }
        .cbt-time-label { color:#426b56; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.8px; margin-bottom:6px; }
        .cbt-time-value { color:var(--green); font-weight:800; font-size:30px; line-height:1.2; }
        .cbt-time-note { font-size:12px; color:#5a7966; margin-top:7px; }
        .cbt-resume-button { display:flex; justify-content:center; align-items:center; gap:10px; width:100%; padding:16px 20px; background:var(--green2); color:white; text-decoration:none; text-align:center; font-size:15px; font-weight:800; border-radius:11px; transition:background .2s, transform .2s; }
        .cbt-resume-button:hover, .cbt-resume-button:focus { background:#105c3e; color:white; text-decoration:none; }
        .cbt-resume-button:focus-visible { outline:3px solid #80bda0; outline-offset:3px; }
        .cbt-help { margin:15px 0 0; color:var(--muted); text-align:center; font-size:12px; }
        .cbt-stats { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:21px; }
        .cbt-stat { background:#f3f8f5; border-radius:12px; padding:15px; }
        .cbt-stat strong { display:block; font-size:23px; color:var(--green); }
        .cbt-stat span { font-size:12px; color:var(--muted); }
        .cbt-detail-list { margin:0; }
        .cbt-detail { display:grid; grid-template-columns:minmax(120px,40%) minmax(0,1fr); gap:12px; padding:14px 0; border-bottom:1px solid var(--line); align-items:start; }
        .cbt-detail:last-child { border-bottom:0; }
        .cbt-detail dt { color:var(--muted); font-size:13px; }
        .cbt-detail dd { margin:0; font-size:13px; font-weight:700; overflow-wrap:anywhere; }
        .cbt-guidance { padding:16px 19px; margin-top:17px; border:1px solid #e7e5d5; border-radius:12px; background:#fdfbf0; font-size:13px; color:#665d37; line-height:1.65; }
        .cbt-footer { display:flex; flex-wrap:wrap; justify-content:space-between; gap:10px; border-top:1px solid var(--line); margin-top:35px; padding-top:18px; color:#819087; font-size:11px; }
        @media(max-width:850px) { .cbt-layout { grid-template-columns:1fr; } .cbt-container { padding-top:25px; } }
        @media(max-width:520px) { .cbt-header { padding:14px 18px; } .cbt-container { padding:22px 16px 35px; } .cbt-card-header,.cbt-card-body { padding:20px; } .cbt-student-name { font-size:17px; } .cbt-photo { width:70px; height:70px; } .cbt-college-name { font-size:14px; } .cbt-college-logo { width:46px; height:46px; } .cbt-time-value { font-size:27px; } }
    </style>
</head>
<body>
    <header class="cbt-header">
        <div class="cbt-header-inner">
            @if(!empty($collegeSetup->avatar))
                <img class="cbt-college-logo" src="{{ asset($collegeSetup->avatar) }}" alt="College logo">
            @endif
            <div>
                <div class="cbt-college-name">{{ $collegeSetup->name ?? 'College CBT Portal' }}</div>
                <div class="cbt-header-subtitle">Computer-Based Examination Portal</div>
            </div>
        </div>
    </header>

    <main class="cbt-container">
        <div class="cbt-page-intro">
            <div class="cbt-eyebrow">Examination in progress</div>
            <h1>Resume Your Examination</h1>
            <p>Your examination has not yet been completed. Review the details below and continue where you left off.</p>
        </div>

        @if(session('success'))
            <div class="cbt-alert cbt-alert-success" role="status">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="cbt-alert cbt-alert-error" role="alert">{{ session('error') }}</div>
        @endif

        <div class="cbt-layout">
            <section class="cbt-card" aria-labelledby="resume-heading">
                <div class="cbt-card-header">
                    <h2 id="resume-heading"><i class="fas fa-user-graduate" aria-hidden="true"></i> Student &amp; Examination Status</h2>
                    <p>Confirm your information before returning to the test.</p>
                </div>
                <div class="cbt-card-body">
                    <div class="cbt-student-summary">
                        <img class="cbt-photo" src="{{ asset('uploads/' . $studentData->picture_name . '.jpg') }}" alt="Student photograph">
                        <div>
                            <h3 class="cbt-student-name">{{ $studentData->surname }} {{ $studentData->first_name }} {{ $studentData->other_name }}</h3>
                            <p class="cbt-student-meta">{{ $studentData->department }}</p>
                            <p class="cbt-student-meta">Level: {{ $studentData->level }}</p>
                        </div>
                    </div>

                    <div class="cbt-status"><i class="fas fa-hourglass-half" aria-hidden="true"></i> Examination not completed</div>
                    <h3 class="cbt-resume-title">Your test is still in progress</h3>
                    <p class="cbt-resume-desc">You have not completed this examination. Select <strong>Continue Examination</strong> to return to your test. Your examination time may continue to elapse while you are away.</p>

                    <div class="cbt-time-card">
                        <div class="cbt-time-label">Time left (as reported by the system)</div>
                        <div class="cbt-time-value">{{ $studentMin }} <span style="font-size:16px; font-weight:700">minutes</span></div>
                        <div class="cbt-time-note">The remaining time shown here is not a live countdown. The examination page controls the active timer.</div>
                    </div>

                    <a class="cbt-resume-button" href="{{ route('cbt-page', ['id' => $studentData->id]) }}" id="cbt-continue-link">
                        <span>Continue Examination</span><i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <p class="cbt-help">Need assistance? Inform your invigilator.</p>
                </div>
            </section>

            <aside class="cbt-card" aria-labelledby="exam-details-heading">
                <div class="cbt-card-header">
                    <h2 id="exam-details-heading"><i class="fas fa-clipboard-list" aria-hidden="true"></i> Examination Information</h2>
                    <p>Details of your current examination.</p>
                </div>
                <div class="cbt-card-body">
                    <div class="cbt-stats">
                        <div class="cbt-stat"><strong>{{ $examSetting->no_of_qst }}</strong><span>Total questions</span></div>
                        <div class="cbt-stat"><strong>{{ $examSetting->duration }}</strong><span>Duration (minutes)</span></div>
                    </div>
                    <dl class="cbt-detail-list">
                        <div class="cbt-detail"><dt>Academic Session</dt><dd>{{ $examSetting->session1 }}</dd></div>
                        <div class="cbt-detail"><dt>Programme</dt><dd>{{ $examSetting->department }}</dd></div>
                        <div class="cbt-detail"><dt>Level</dt><dd>{{ $examSetting->level }}</dd></div>
                        @if($examSetting->exam_category == 'SEMESTER')
                            <div class="cbt-detail"><dt>Subject / Course</dt><dd>{{ $examSetting->course }}</dd></div>
                        @endif
                        <div class="cbt-detail"><dt>Exam Mode</dt><dd>{{ $examSetting->exam_mode }}</dd></div>
                        <div class="cbt-detail"><dt>Exam Category</dt><dd>{{ $examSetting->exam_category }}</dd></div>
                        <div class="cbt-detail"><dt>Exam Type</dt><dd>{{ $examSetting->exam_type }}</dd></div>
                    </dl>
                    <div class="cbt-guidance"><i class="fas fa-info-circle" aria-hidden="true"></i> Please remain in fullscreen mode and follow your invigilator's instructions throughout the examination.</div>
                </div>
            </aside>
        </div>

        <footer class="cbt-footer">
            <span>&copy; 2020 - {{ date('Y') }} {{ $collegeSetup->name ?? 'College CBT Portal' }}</span>
            <span>Version: {{ $softwareVersion->version ?? 'N/A' }}</span>
        </footer>
    </main>
</body>
</html>

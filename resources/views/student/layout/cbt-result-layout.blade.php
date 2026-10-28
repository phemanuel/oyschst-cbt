<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CBT Examination Result | {{ $collegeSetup->name }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('student/vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('student/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('student/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('student/css/style.css') }}">
    <style>
        :root { --primary:#123d31; --green:#18734f; --ink:#172b28; --muted:#64766d; --line:#e1e9e4; --bg:#f4f7f5; }
        *,*::before,*::after { box-sizing:border-box; }
        html,body { min-height:100%; }
        body.cbt-result-page { margin:0; background:var(--bg); color:var(--ink); font-family:Arial,Helvetica,sans-serif; }
        .cbt-result-topbar { background:var(--primary); color:white; padding:15px 24px; }
        .cbt-result-topbar-inner { max-width:1000px; margin:0 auto; display:flex; align-items:center; gap:13px; }
        .cbt-result-topbar img { width:48px; height:48px; object-fit:contain; background:#fff; border-radius:9px; padding:5px; }
        .cbt-result-topbar .name { font-size:15px; font-weight:700; line-height:1.45; }
        .cbt-result-topbar .sub { font-size:12px; color:#cee1d7; margin-top:3px; }
        .cbt-result-wrap { max-width:1000px; margin:0 auto; padding:32px 18px 44px; }
        .cbt-result-heading { text-align:center; margin-bottom:25px; }
        .cbt-result-heading .check { width:62px; height:62px; display:flex; align-items:center; justify-content:center; margin:0 auto 15px; background:#e0f2e7; color:var(--green); border-radius:50%; font-size:29px; }
        .cbt-result-heading h1 { font-size:28px; font-weight:800; margin:0 0 9px; color:var(--ink); }
        .cbt-result-heading p { font-size:14px; line-height:1.65; color:var(--muted); margin:0; }
        .cbt-slip { background:#fff; border:1px solid var(--line); border-radius:16px; box-shadow:0 12px 38px rgba(14,45,32,.06); overflow:hidden; }
        .cbt-slip-head { padding:26px 30px 22px; border-bottom:1px solid var(--line); text-align:center; }
        .cbt-slip-head img { width:76px; height:76px; object-fit:contain; margin-bottom:10px; }
        .cbt-slip-head h2 { font-size:20px; line-height:1.45; font-weight:800; color:var(--primary); margin:0 0 8px; }
        .cbt-slip-head .slip-title { text-transform:uppercase; font-size:13px; letter-spacing:.8px; font-weight:700; color:var(--muted); line-height:1.6; }
        .cbt-slip-content { padding:26px 30px 30px; }
        .cbt-slip-section-label { font-size:12px; text-transform:uppercase; letter-spacing:.8px; color:var(--green); font-weight:800; margin-bottom:15px; }
        .cbt-student-layout { display:grid; grid-template-columns:145px minmax(0,1fr); gap:26px; }
        .cbt-student-photo { width:145px; height:170px; object-fit:cover; border:1px solid var(--line); border-radius:10px; background:#f2f5f3; }
        .cbt-student-details { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:17px 20px; margin:0; }
        .cbt-detail { border-bottom:1px solid #edf1ee; padding-bottom:12px; min-width:0; }
        .cbt-detail dt { font-size:12px; color:var(--muted); margin-bottom:6px; font-weight:500; }
        .cbt-detail dd { margin:0; font-size:14px; font-weight:700; line-height:1.55; overflow-wrap:anywhere; color:var(--ink); }
        .cbt-score-strip { display:grid; grid-template-columns:repeat(2,1fr); gap:15px; margin-top:27px; }
        .cbt-score-box { background:#f3f8f5; border:1px solid #dbeadf; border-radius:12px; padding:18px 20px; }
        .cbt-score-box .label { font-size:12px; color:#527463; margin-bottom:6px; }
        .cbt-score-box .value { font-size:29px; font-weight:800; color:var(--primary); line-height:1.2; }
        .cbt-score-box.score { background:#e9f5ee; }
        .cbt-slip-note { background:#f7f9f7; border-left:3px solid var(--green); padding:13px 15px; margin:22px 0 0; color:#41584a; font-size:13px; line-height:1.6; }
        .cbt-signature { text-align:right; margin-top:28px; }
        .cbt-signature img { display:block; max-width:210px; width:100%; height:auto; max-height:95px; object-fit:contain; margin-left:auto; }
        .cbt-signature .caption { font-size:12px; color:var(--muted); margin-top:5px; }
        .cbt-complete-only { background:#fff; border:1px solid var(--line); border-radius:16px; padding:35px 25px; text-align:center; max-width:700px; margin:0 auto; }
        .cbt-complete-only h2 { font-size:20px; font-weight:700; color:var(--primary); }
        .cbt-complete-only p { color:var(--muted); font-size:14px; line-height:1.7; margin:12px 0 0; }
        .cbt-result-actions { display:flex; flex-wrap:wrap; justify-content:center; gap:12px; margin-top:25px; }
        .cbt-action { display:inline-flex; align-items:center; justify-content:center; gap:9px; padding:14px 22px; min-height:48px; text-decoration:none!important; border-radius:9px; font-size:14px; font-weight:700; border:1px solid transparent; }
        .cbt-action-primary { background:var(--green); color:#fff!important; }
        .cbt-action-primary:hover { background:#105e3d; }
        .cbt-action-secondary { background:#fff; border-color:#bfd8c8; color:var(--primary)!important; }
        .cbt-action-secondary:hover { background:#eaf4ed; }
        .cbt-result-footer { text-align:center; font-size:12px; color:#819088; padding:16px; line-height:1.7; }
        .cbt-result-footer a { color:inherit; }
        @media(max-width:700px) { .cbt-slip-head,.cbt-slip-content { padding:22px 17px; } .cbt-student-layout { grid-template-columns:1fr; } .cbt-student-photo { margin:0 auto; } .cbt-student-details { grid-template-columns:1fr; gap:11px; } .cbt-result-heading h1 { font-size:24px; } .cbt-slip-head h2 { font-size:17px; } .cbt-score-strip { gap:10px; } .cbt-score-box { padding:14px; } .cbt-score-box .value { font-size:25px; } }
        @media print {
            @page { size:A4; margin:12mm; }
            html,body.cbt-result-page { background:#fff!important; margin:0; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
            .cbt-result-topbar,.cbt-result-heading,.cbt-result-actions,.cbt-result-footer { display:none!important; }
            .cbt-result-wrap { max-width:none; padding:0; margin:0; }
            .cbt-slip { box-shadow:none; border:1px solid #b8c2bc; border-radius:0; overflow:visible; break-inside:avoid; }
            .cbt-slip-head { padding:14px 18px; } .cbt-slip-head img { width:65px; height:65px; }
            .cbt-slip-content { padding:16px 20px; }
            .cbt-student-layout { grid-template-columns:125px 1fr; gap:18px; }
            .cbt-student-photo { width:125px; height:145px; }
            .cbt-student-details { grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px 16px; }
            .cbt-detail { padding-bottom:7px; } .cbt-score-strip { margin-top:16px; }
            .cbt-score-box { background:white!important; border:1px solid #aab7ad; padding:12px 14px; }
            .cbt-slip-note { background:white!important; border-left:2px solid #444; margin-top:12px; }
            .cbt-signature { margin-top:15px; }
        }

        
/* ==========================================
   CBT RESULT ACTION BUTTONS
========================================== */

.cbt-result-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin: 25px auto;
}

.cbt-print-btn,
.cbt-exit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 13px 26px;
    border: 0;
    border-radius: 9px;
    color: #fff !important;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none !important;
    cursor: pointer;
}

.cbt-print-btn {
    background: #18734f;
}

.cbt-print-btn:hover {
    background: #105b3d;
}

.cbt-exit-btn {
    background: #334155;
}

.cbt-exit-btn:hover {
    background: #1e293b;
}

/* ==========================================
   PRINT ONLY RESULT CONFIRMATION SLIP
========================================== */

@media print {

    @page {
        size: A4 portrait;
        margin: 12mm;
    }

    html,
    body {
        width: 100%;
        height: auto !important;
        overflow: visible !important;
        background: #fff !important;
    }

    /* Hide everything by default */
    body * {
        visibility: hidden !important;
    }

    /* Show only the result slip */
    #cbt-print-area,
    #cbt-print-area * {
        visibility: visible !important;
    }

    /* Position slip at top of printed page */
    #cbt-print-area {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
        box-shadow: none !important;
        border: none !important;
    }

    /* Remove unnecessary screen styling */
    #cbt-print-area .card,
    #cbt-print-area .card-body {
        box-shadow: none !important;
        background: #fff !important;
    }

    /* Preserve readable printed text */
    #cbt-print-area * {
        color: #000 !important;
    }

    /* Keep student photo and signature */
    #cbt-print-area img {
        max-width: 100% !important;
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
    }

    /* Hide action buttons */
    .cbt-result-actions,
    .navbar,
    .footer,
    .page-header {
        display: none !important;
    }

}

    </style>
<style>
    /* ==========================================
   CBT RESULT SIGNATURE
   CONSISTENT SCREEN AND PRINT ALIGNMENT
========================================== */

#cbt-print-area .cbt-signature-section {
    display: block;
    width: 100%;
    margin: 25px 0 15px;
    padding: 0;
    text-align: center;
    float: none;
}

#cbt-print-area .cbt-signature-content {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    width: 240px;
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
    text-align: center;
}

#cbt-print-area .cbt-signature-image {
    display: block;
    width: 200px;
    max-width: 100%;
    height: auto;
    margin: 0 auto 4px;
    object-fit: contain;
}

#cbt-print-area .cbt-signature-line {
    display: block;
    width: 240px;
    max-width: 100%;
    border-top: 1px solid #444;
    margin: 0 auto 6px;
}

#cbt-print-area .cbt-signature-label {
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    text-align: center;
    font-size: 12px;
    font-weight: 600;
    color: #333;
}

/* Print: preserve the same layout */

@media print {
    #cbt-print-area .cbt-signature-section,
    #cbt-print-area .cbt-signature-content,
    #cbt-print-area .cbt-signature-image,
    #cbt-print-area .cbt-signature-line,
    #cbt-print-area .cbt-signature-label {
        float: none !important;
        position: static !important;
    }
}
</style>
</head>
<body class="cbt-result-page">
    <header class="cbt-result-topbar">
        <div class="cbt-result-topbar-inner">
            @if(!empty($collegeSetup->avatar))
                <img src="{{ asset($collegeSetup->avatar) }}" alt="College logo">
            @endif
            <div>
                <div class="name">{{ $collegeSetup->name }}</div>
                <div class="sub">Computer-Based Testing System</div>
            </div>
        </div>
    </header>

    <main class="cbt-result-wrap">
        <div class="cbt-result-heading">
            <div class="check"><i class="fas fa-check"></i></div>
            <h1>Examination Completed</h1>
            <p>Your examination has been submitted successfully.</p>
        </div>

        @if($examSetting->check_result == 1)
        <div id="cbt-print-area">

            <!-- Existing CBT Result Confirmation Slip -->
             <article class="cbt-slip" id="cbt-result-slip">
                <header class="cbt-slip-head">
                    @if(!empty($collegeSetup->avatar))
                        <img src="{{ asset($collegeSetup->avatar) }}" alt="College logo">
                    @endif
                    <h2>{{ $collegeSetup->name }}</h2>
                    <div class="slip-title">{{ $cbtEvaluation->session1 }} {{ $cbtEvaluation->exam_type }} Result Confirmation Slip</div>
                </header>
                <div class="cbt-slip-content">
                    <div class="cbt-slip-section-label">Student &amp; Examination Information</div>
                    <div class="cbt-student-layout">
                        <img src="{{ asset('uploads/' . $cbtEvaluation->studentno . '.jpg') }}" alt="Student photograph" class="cbt-student-photo">
                        <dl class="cbt-student-details">
                            <div class="cbt-detail"><dt>Examination Date</dt><dd>{{ \Carbon\Carbon::parse($cbtEvaluation->examdate)->format('F j, Y') }}</dd></div>
                            <div class="cbt-detail"><dt>Student Name</dt><dd>{{ $cbtEvaluation->studentname }}</dd></div>
                            <div class="cbt-detail"><dt>Student Number</dt><dd>{{ $cbtEvaluation->studentno }}</dd></div>
                            <div class="cbt-detail"><dt>Programme</dt><dd>{{ $cbtEvaluation->department }}</dd></div>
                            <div class="cbt-detail"><dt>Level</dt><dd>{{ $cbtEvaluation->level }}</dd></div>
                            @if($cbtEvaluation->exam_category == 'SEMESTER')
                                <div class="cbt-detail"><dt>Semester</dt><dd>{{ $cbtEvaluation->semester }}</dd></div>
                                <div class="cbt-detail"><dt>Course</dt><dd>{{ $cbtEvaluation->course }}</dd></div>
                            @endif
                            <div class="cbt-detail"><dt>Academic Session</dt><dd>{{ $cbtEvaluation->session1 }}</dd></div>
                        </dl>
                    </div>
                    <div class="cbt-score-strip">
                        <div class="cbt-score-box"><div class="label">Total Questions</div><div class="value">{{ $cbtEvaluation->noofquestion }}</div></div>
                        <div class="cbt-score-box score"><div class="label">Score</div><div class="value">{{ $cbtEvaluation->correct }}</div></div>
                    </div>
                    @if($cbtEvaluation->exam_type == 'ENTRANCE')
                        <p class="cbt-slip-note">Check your Portal for Cut-off mark and interview date.</p>
                    @endif
                    <!-- Authorized Signature -->
                <div class="cbt-signature-section">

                    <div class="cbt-signature-content">

                        <img
                            src="{{ asset('college/signature.jpg') }}"
                            alt="Authorized Signature"
                            class="cbt-signature-image"
                        >

                        <div class="cbt-signature-line"></div>

                        <p class="cbt-signature-label">
                            Authorized Signature
                        </p>

                    </div>

                </div>
                </div>
            </article>
        @else
            <section class="cbt-complete-only">
                <h2>You have successfully completed the test.</h2>
                <p>Your result is not displayed on this page. Please exit the Computer-Based Testing system.</p>
            </section>
        @endif

        <div class="cbt-result-actions">            
            <div class="cbt-result-actions">

                @if($examSetting->check_result == 1)
                    <button
                        type="button"
                        class="cbt-print-btn"
                        onclick="window.print()"
                    >
                        <i class="fas fa-print"></i>
                        Print Result
                    </button>
                @endif

                <a href="{{ route('student-logout') }}"
                class="cbt-exit-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Exit CBT
                </a>

            </div>
        </div>

        </div>
            
    </main>

    <footer class="cbt-result-footer">
        Copyright &copy; 2020 - {{ date('Y') }}
        <a href="{{ $collegeSetup->web_url }}" target="_blank" rel="noopener noreferrer">{{ $collegeSetup->name }}</a>.
        Version: {{ $softwareVersion->version }}
    </footer>

    <script src="{{ asset('student/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('student/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('student/js/off-canvas.js') }}"></script>
    <script src="{{ asset('student/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('student/js/misc.js') }}"></script>
    <script src="{{ asset('student/js/settings.js') }}"></script>
    <script src="{{ asset('student/js/todolist.js') }}"></script>
    <script src="{{ asset('student/js/dashboard.js') }}"></script>
</body>
</html>

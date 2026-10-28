<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Exam Confirmation | {{ $collegeSetup->name ?? 'CBT Portal' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('student/vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <style>
        :root {
            --green: #123d31; --green-bright: #18734f; --green-light: #eaf5ee;
            --ink: #172b28; --muted: #667b73; --line: #dfe9e2; --bg: #f5f8f6;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { min-height: 100%; }
        body { margin: 0; background: var(--bg); color: var(--ink); font-family: Arial, Helvetica, sans-serif; line-height: 1.55; }
        button { font: inherit; }
        .cbt-topbar { background: var(--green); color: #fff; }
        .cbt-topbar-inner { max-width: 1240px; margin: auto; min-height: 88px; padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
        .cbt-identity { display: flex; align-items: center; gap: 15px; min-width: 0; }
        .cbt-logo { flex: 0 0 auto; width: 58px; height: 58px; padding: 6px; border-radius: 12px; object-fit: contain; background: #fff; }
        .cbt-college { font-size: 16px; font-weight: 700; line-height: 1.35; overflow-wrap: anywhere; }
        .cbt-subbrand { font-size: 12px; color: #c6ded1; margin-top: 4px; }
        .cbt-status { display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border: 1px solid rgba(255,255,255,.22); border-radius: 30px; font-size: 12px; white-space: nowrap; }
        .cbt-status-dot { width: 8px; height: 8px; border-radius: 50%; background: #93e0af; }
        .cbt-main { max-width: 1240px; margin: 0 auto; padding: 36px 28px 24px; }
        .cbt-eyebrow { color: var(--green-bright); text-transform: uppercase; font-size: 12px; letter-spacing: 1.1px; font-weight: 800; }
        .cbt-page-title { font-size: clamp(26px, 3vw, 36px); margin: 6px 0 8px; line-height: 1.2; letter-spacing: -.6px; }
        .cbt-intro { color: var(--muted); margin: 0 0 27px; max-width: 800px; font-size: 15px; }
        .cbt-alert { border-radius: 12px; padding: 13px 16px; margin: 0 0 20px; font-size: 14px; }
        .cbt-alert-success { background: #e7f7ec; color: #155c36; border: 1px solid #bae5c8; }
        .cbt-alert-error { background: #fff0f0; color: #992e2e; border: 1px solid #f2c6c6; }
        .cbt-layout { display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(0, .88fr); gap: 22px; align-items: start; }
        .cbt-card { background: #fff; border: 1px solid var(--line); border-radius: 18px; box-shadow: 0 10px 30px rgba(18,61,49,.04); overflow: hidden; }
        .cbt-card-head { padding: 23px 27px; border-bottom: 1px solid var(--line); display: flex; align-items: center; gap: 12px; }
        .cbt-card-icon { color: var(--green-bright); background: var(--green-light); width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; flex: 0 0 auto; }
        .cbt-card-head h2 { font-size: 18px; margin: 0; line-height: 1.35; }
        .cbt-card-head p { margin: 3px 0 0; color: var(--muted); font-size: 12px; }
        .cbt-card-body { padding: 26px 27px; }
        .cbt-student-hero { display: flex; align-items: center; gap: 20px; padding-bottom: 25px; border-bottom: 1px solid var(--line); }
        .cbt-photo { width: 94px; height: 94px; object-fit: cover; border: 4px solid var(--green-light); border-radius: 17px; flex: 0 0 auto; }
        .cbt-student-tag { display: inline-block; padding: 5px 9px; border-radius: 6px; background: var(--green-light); color: var(--green-bright); font-size: 11px; font-weight: 700; margin-bottom: 7px; }
        .cbt-student-name { font-size: 21px; font-weight: 800; line-height: 1.4; margin: 0; overflow-wrap: anywhere; }
        .cbt-info-list { margin: 10px 0 0; }
        .cbt-info-row { display: grid; grid-template-columns: 145px minmax(0,1fr); gap: 14px; padding: 15px 0; border-bottom: 1px solid #eef2ef; }
        .cbt-info-row:last-child { border-bottom: 0; }
        .cbt-info-row dt { color: var(--muted); font-size: 13px; }
        .cbt-info-row dd { margin: 0; color: var(--ink); font-weight: 700; font-size: 14px; overflow-wrap: anywhere; }
        .cbt-check { margin: 21px 0 0; padding: 15px 16px; background: #f0f7f2; border-radius: 10px; color: #315947; font-size: 13px; display: flex; align-items: flex-start; gap: 10px; }
        .cbt-check i { margin-top: 3px; color: var(--green-bright); }
        .cbt-stats { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 12px; margin-bottom: 23px; }
        .cbt-stat { background: #f3f8f5; border: 1px solid #e2eee6; border-radius: 12px; padding: 17px; }
        .cbt-stat-label { font-size: 12px; color: var(--muted); display: block; }
        .cbt-stat-value { display: block; font-size: 24px; line-height: 1.2; font-weight: 800; color: var(--green); margin-top: 5px; }
        .cbt-stat-unit { font-size: 12px; font-weight: 500; }
        .cbt-guidance { margin: 25px 0 0; padding: 18px; border: 1px solid #e5eadd; background: #fbfcf8; border-radius: 12px; }
        .cbt-guidance h3 { font-size: 14px; margin: 0 0 10px; }
        .cbt-guidance ul { margin: 0; padding-left: 20px; color: #56675d; font-size: 13px; }
        .cbt-guidance li + li { margin-top: 7px; }
        .cbt-start { margin-top: 22px; }
        .cbt-start-button { width: 100%; background: var(--green-bright); color: #fff; font-weight: 700; border: 0; border-radius: 11px; min-height: 56px; padding: 14px 18px; display: flex; align-items: center; justify-content: center; gap: 12px; cursor: pointer; transition: background .2s; }
        .cbt-start-button:hover { background: #105f3e; }
        .cbt-start-button:focus-visible { outline: 3px solid #93d0ab; outline-offset: 3px; }
        .cbt-start-button:disabled { opacity: .65; cursor: wait; }
        .cbt-start-help { text-align: center; font-size: 12px; color: var(--muted); margin: 12px 0 0; }
        .cbt-footer { max-width: 1240px; margin: 0 auto; padding: 22px 28px 32px; display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap; color: #788a7f; font-size: 12px; }
        .cbt-footer a { color: var(--green-bright); }
        @media (max-width: 850px) { .cbt-layout { grid-template-columns: 1fr; } .cbt-main { padding-top: 25px; } }
        @media (max-width: 560px) {
            .cbt-topbar-inner { padding: 12px 18px; min-height: 76px; }
            .cbt-logo { width: 48px; height: 48px; }
            .cbt-college { font-size: 13px; }
            .cbt-status { display: none; }
            .cbt-main { padding: 24px 15px 10px; }
            .cbt-card-head, .cbt-card-body { padding: 20px; }
            .cbt-student-hero { gap: 13px; }
            .cbt-photo { width: 75px; height: 75px; }
            .cbt-student-name { font-size: 17px; }
            .cbt-info-row { grid-template-columns: 1fr; gap: 3px; }
            .cbt-footer { padding: 19px 15px 30px; }
        }
    </style>
</head>
<body>
    <header class="cbt-topbar">
        <div class="cbt-topbar-inner">
            <div class="cbt-identity">
                @if(!empty($collegeSetup->avatar))
                    <img src="{{ asset($collegeSetup->avatar) }}" alt="College logo" class="cbt-logo">
                @endif
                <div>
                    <div class="cbt-college">{{ $collegeSetup->name ?? 'College CBT Portal' }}</div>
                    <div class="cbt-subbrand">Computer-Based Testing System</div>
                </div>
            </div>
            <div class="cbt-status"><span class="cbt-status-dot"></span> Examination Portal</div>
        </div>
    </header>

    <main class="cbt-main">
        <div class="cbt-eyebrow">Student Dashboard</div>
        <h1 class="cbt-page-title">Confirm Your Examination Details</h1>
        <p class="cbt-intro">Please verify your personal information and the examination settings below before proceeding to your test.</p>

        @if(session('success'))
            <div class="cbt-alert cbt-alert-success" role="status">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="cbt-alert cbt-alert-error" role="alert">{{ session('error') }}</div>
        @endif

        <div class="cbt-layout">
            <section class="cbt-card" aria-labelledby="student-heading">
                <div class="cbt-card-head">
                    <span class="cbt-card-icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></span>
                    <div>
                        <h2 id="student-heading">Student Information</h2>
                        <p>Verify that the information displayed belongs to you</p>
                    </div>
                </div>
                <div class="cbt-card-body">
                    <div class="cbt-student-hero">
                        <img
                            class="cbt-photo"
                            src="{{ asset('uploads/' . $studentData->picture_name . '.jpg') }}"
                            alt="Student photograph"
                        >
                        <div>
                            <span class="cbt-student-tag">Student Profile</span>
                            <h3 class="cbt-student-name">{{ $studentData->surname }} {{ $studentData->first_name }} {{ $studentData->other_name }}</h3>
                        </div>
                    </div>
                    <dl class="cbt-info-list">
                        <div class="cbt-info-row"><dt>Full Name</dt><dd>{{ $studentData->surname }} {{ $studentData->first_name }} {{ $studentData->other_name }}</dd></div>
                        <div class="cbt-info-row"><dt>Programme</dt><dd>{{ $studentData->department }}</dd></div>
                        <div class="cbt-info-row"><dt>Level</dt><dd>{{ $studentData->level }}</dd></div>
                    </dl>
                    <form class="cbt-start" action="{{ route('cbt-check', ['id' => $studentData->id]) }}" method="POST" id="cbt-start-form">
                        @csrf
                        <button type="submit" class="cbt-start-button" id="start-cbt-button">
                            <span>Start Computer-Based Test</span> <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </button>
                        <p class="cbt-start-help">Only proceed when you are ready and have confirmed your details.</p>
                    </form>
                    <div class="cbt-check"><i class="fas fa-shield-alt" aria-hidden="true"></i><span>If any information is incorrect, contact your invigilator before starting the examination.</span></div>
                </div>
            </section>

            <section class="cbt-card" aria-labelledby="exam-heading">
                <div class="cbt-card-head">
                    <span class="cbt-card-icon"><i class="fas fa-clipboard-list" aria-hidden="true"></i></span>
                    <div>
                        <h2 id="exam-heading">Examination Information</h2>
                        <p>Review your assigned examination settings</p>
                    </div>
                </div>
                <div class="cbt-card-body">
                    <div class="cbt-stats">
                        <div class="cbt-stat"><span class="cbt-stat-label">Total Questions</span><span class="cbt-stat-value">{{ $examSetting->no_of_qst }}</span></div>
                        <div class="cbt-stat"><span class="cbt-stat-label">Duration</span><span class="cbt-stat-value">{{ $examSetting->duration }} <span class="cbt-stat-unit">mins</span></span></div>
                    </div>
                    <dl class="cbt-info-list">
                        <div class="cbt-info-row"><dt>Academic Session</dt><dd>{{ $examSetting->session1 }}</dd></div>
                        <div class="cbt-info-row"><dt>Programme</dt><dd>{{ $examSetting->department }}</dd></div>
                        <div class="cbt-info-row"><dt>Level</dt><dd>{{ $examSetting->level }}</dd></div>
                        @if($examSetting->exam_type != 'ENTRANCE')
                            <div class="cbt-info-row"><dt>Subject / Course</dt><dd>{{ $examSetting->course }}</dd></div>
                        @endif
                        <div class="cbt-info-row"><dt>Exam Mode</dt><dd>{{ $examSetting->exam_mode }}</dd></div>
                        <div class="cbt-info-row"><dt>Exam Type</dt><dd>{{ $examSetting->exam_type }}</dd></div>
                    </dl>
                    <aside class="cbt-guidance" aria-label="Before you continue">
                        <h3><i class="fas fa-info-circle" aria-hidden="true"></i> Before You Continue</h3>
                        <ul>
                            <li>Confirm your name, programme and examination details.</li>
                            <li>Follow the instructions provided by the invigilator.</li>
                            <li>Remain in fullscreen mode during the examination.</li>
                        </ul>
                    </aside>
                    
                </div>
            </section>
        </div>
    </main>

    <footer class="cbt-footer">
        <div>&copy; 2020 - {{ date('Y') }} {{ $collegeSetup->name ?? 'CBT Portal' }}</div>
        <div>Version: {{ $softwareVersion->version ?? 'N/A' }}</div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('cbt-start-form');
            const button = document.getElementById('start-cbt-button');
            if (!form || !button) return;
            form.addEventListener('submit', function () {
                if (button.disabled) return;
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i><span>Preparing Examination...</span>';
            });
        });
    </script>
</body>
</html>

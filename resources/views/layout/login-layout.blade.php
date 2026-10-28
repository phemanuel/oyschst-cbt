
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="_token" content="{{ csrf_token() }}">

    <title>
        Student Login | {{ $collegeSetup->name ?? 'CBT Portal' }}
    </title>

    <link rel="shortcut icon"
          href="{{ asset('favicon.png') }}">

    <link href="{{ asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">

    @stack('plugin-styles')

    <style>

        :root {
            --cbt-primary: #123d31;
            --cbt-primary-light: #18734f;
            --cbt-accent: #d4a84b;
            --cbt-text: #172b28;
            --cbt-muted: #718078;
            --cbt-border: #dfe7e2;
            --cbt-background: #f4f7f5;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--cbt-background);
            color: var(--cbt-text);
        }

        /* MAIN LAYOUT */

        .cbt-login-page {
            min-height: 100vh;
            min-height: 100dvh;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        }

        /* LEFT BRANDING PANEL */

        .cbt-brand-panel {
            position: relative;

            background:
                linear-gradient(
                    rgba(9, 39, 31, 0.82),
                    rgba(9, 39, 31, 0.92)
                ),
                url("{{ asset('assets/images/auth/bg2.jpg') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            color: #fff;
            padding: 55px 65px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            overflow: hidden;
        }

        .cbt-brand-panel::after {
            content: "";
            position: absolute;
            width: 430px;
            height: 430px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            right: -180px;
            bottom: -180px;
            pointer-events: none;
        }

        .cbt-brand-top,
        .cbt-brand-content,
        .cbt-brand-bottom {
            position: relative;
            z-index: 1;
        }

      /* College branding container */
        .cbt-brand-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 22px;
            width: 100%;
            padding: 20px 15px;
        }

        /* Larger college logo */
        .cbt-brand-logo {
            display: block;
            width: 125px;
            height: 125px;
            max-width: 100%;
            object-fit: contain;
            flex-shrink: 0;
        }

        /* Larger college name */
        .cbt-college-name {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            text-align: center;
            color: #ffffff;
            max-width: 650px;
            margin: 0;
        }

        /* Responsive adjustment */
        @media (max-width: 768px) {

            .cbt-brand-top {
                gap: 16px;
                padding: 15px 10px;
            }

            .cbt-brand-logo {
                width: 100px;
                height: 100px;
            }

            .cbt-college-name {
                font-size: 23px;
                line-height: 1.4;
            }
        }

        .cbt-brand-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            padding: 9px 15px;
            border-radius: 30px;
            color: #e7f3ec;
            font-size: 12px;
            letter-spacing: .5px;
            margin-bottom: 25px;
        }

        .cbt-brand-content h1 {
            font-size: clamp(30px, 3.3vw, 48px);
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
            max-width: 510px;
            margin: 0 0 22px;
        }

        .cbt-brand-content > p {
            font-size: 16px;
            line-height: 1.85;
            max-width: 490px;
            color: #c5dcd0;
            margin-bottom: 30px;
        }

        .cbt-info-card {
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 14px;
            padding: 20px 22px;
            max-width: 490px;
        }

        .cbt-info-card h3 {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            margin: 0 0 13px;
        }

        .cbt-info-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cbt-info-card li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 10px;
            color: #d9e7df;
        }

        .cbt-info-card li:last-child {
            margin-bottom: 0;
        }

        .cbt-info-card li i {
            color: #b9d9c2;
            font-size: 17px;
        }

        .cbt-brand-bottom {
            font-size: 12px;
            color: #a8c7b7;
        }

        /* RIGHT LOGIN PANEL */

        .cbt-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 36px;
            background: #f8faf9;
        }

        .cbt-login-card {
            width: 100%;
            max-width: 440px;
        }

        .cbt-form-heading {
            margin-bottom: 35px;
        }

        .cbt-form-heading .cbt-eyebrow {
            display: block;
            font-size: 12px;
            color: var(--cbt-primary-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 11px;
        }

        .cbt-form-heading h2 {
            font-size: 32px;
            font-weight: 800;
            color: var(--cbt-text);
            margin: 0 0 12px;
        }

        .cbt-form-heading p {
            font-size: 14px;
            line-height: 1.7;
            color: var(--cbt-muted);
            margin: 0;
        }

        /* FIELDS */

        .cbt-form-group {
            margin-bottom: 24px;
        }

        .cbt-form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #344b40;
            margin-bottom: 10px;
        }

        .cbt-input-wrapper {
            position: relative;
        }

        .cbt-form-control {
            display: block;
            width: 100%;
            height: 54px;
            border: 1px solid var(--cbt-border);
            border-radius: 10px;
            background: #fff;
            padding: 0 48px 0 17px;
            font-size: 14px;
            color: var(--cbt-text);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .cbt-form-control:focus {
            border-color: var(--cbt-primary-light);
            box-shadow: 0 0 0 3px rgba(24,115,79,.12);
        }

        .cbt-form-control::placeholder {
            color: #9ba8a1;
        }

        .cbt-input-icon {
            position: absolute;
            right: 17px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 21px;
            color: #87998d;
            pointer-events: none;
        }

        select.cbt-form-control {
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
        }

        .cbt-form-control.is-invalid {
            border-color: #dc3545;
        }

        .cbt-field-error {
            display: block;
            color: #c92c35;
            font-size: 12px;
            margin-top: 7px;
        }

        /* ALERTS */

        .cbt-alert {
            padding: 14px 16px;
            margin-bottom: 25px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.6;
        }

        .cbt-alert-success {
            background: #e9f8ee;
            border: 1px solid #b7e5c7;
            color: #17603d;
        }

        .cbt-alert-danger {
            background: #fff0f0;
            border: 1px solid #f1c4c4;
            color: #aa2b2b;
        }

        /* SUBMIT BUTTON */

        .cbt-login-button {
            width: 100%;
            height: 55px;
            background: var(--cbt-primary-light);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background .2s;
        }

        .cbt-login-button:hover {
            background: #105f3e;
        }

        .cbt-login-button:disabled {
            opacity: .7;
            cursor: wait;
        }

        .cbt-login-button i {
            font-size: 19px;
        }

        .cbt-login-help {
            margin-top: 23px;
            text-align: center;
            color: var(--cbt-muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .cbt-login-help i {
            color: var(--cbt-primary-light);
            margin-right: 5px;
        }

        .cbt-mobile-brand {
            display: none;
        }

        .cbt-form-footer {
            margin-top: 65px;
            text-align: center;
            font-size: 11px;
            color: #94a39a;
            line-height: 1.7;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {
            .cbt-brand-panel {
                padding: 35px;
            }

            .cbt-brand-content h1 {
                font-size: 32px;
            }

            .cbt-form-panel {
                padding: 35px 25px;
            }
        }

        @media (max-width: 700px) {
            .cbt-login-page {
                grid-template-columns: 1fr;
            }

            .cbt-brand-panel {
                display: none;
            }

            .cbt-mobile-brand {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                text-align: left;
                margin-bottom: 32px;
            }

            .cbt-mobile-brand img {
                width: 54px;
                height: 54px;
                object-fit: contain;
            }

            .cbt-mobile-brand strong {
                font-size: 13px;
                line-height: 1.5;
                max-width: 240px;
            }

            .cbt-form-panel {
                min-height: 100vh;
                min-height: 100dvh;
                padding: 35px 20px;
            }

            .cbt-form-heading h2 {
                font-size: 27px;
            }

            .cbt-form-footer {
                margin-top: 45px;
            }
        }

        @media (max-height: 700px) and (min-width: 701px) {
            .cbt-brand-panel {
                padding-top: 24px;
                padding-bottom: 24px;
            }

            .cbt-brand-content h1 {
                font-size: 29px;
            }

            .cbt-brand-content > p {
                margin-bottom: 15px;
            }

            .cbt-info-card {
                padding: 12px 16px;
            }

            .cbt-form-panel {
                padding-top: 22px;
                padding-bottom: 22px;
            }

            .cbt-form-heading {
                margin-bottom: 18px;
            }

            .cbt-form-group {
                margin-bottom: 15px;
            }

            .cbt-form-footer {
                margin-top: 25px;
            }
        }

    </style>

    @stack('style')

</head>

<body>

<main class="cbt-login-page">

    <!-- ========================================
         LEFT: INSTITUTIONAL BRANDING
    ========================================= -->

    <section class="cbt-brand-panel">

       <div class="cbt-brand-top">

            @if(!empty($collegeSetup->avatar))
                <img
                    src="{{ asset($collegeSetup->avatar) }}"
                    alt="College Logo"
                    class="cbt-brand-logo"
                >
            @endif

            <div class="cbt-college-name">
                {{ $collegeSetup->name ?? 'College Examination Portal' }}
            </div>

        </div>

        <div class="cbt-brand-content">

            <div class="cbt-brand-tag">
                <i class="mdi mdi-monitor"></i>
                COMPUTER BASED TESTING
            </div>

            <!-- <h1>
                Welcome to Your Examination
            </h1> -->

            <p>
                Access your examination through our
                Computer-Based Testing platform.
                Enter your correct student details
                to continue.
            </p>

            <div class="cbt-info-card">

                <h3>
                    <i class="mdi mdi-information-outline"></i>
                    Before You Begin
                </h3>

                <ul>
                    <li>
                        <i class="mdi mdi-check-circle-outline"></i>
                        <span>
                            Ensure your registration or matric
                            number is correct.
                        </span>
                    </li>

                    <li>
                        <i class="mdi mdi-check-circle-outline"></i>
                        <span>
                            Select the correct academic programme.
                        </span>
                    </li>

                    <li>
                        <i class="mdi mdi-check-circle-outline"></i>
                        <span>
                            Follow all examination instructions
                            provided by your invigilator.
                        </span>
                    </li>
                </ul>

            </div>

        </div>


        <div class="cbt-brand-bottom">
            &copy; 2020 - {{ date('Y') }}
            {{ $collegeSetup->name ?? 'CBT Portal' }}
        </div>

    </section>


    <!-- ========================================
         RIGHT: STUDENT LOGIN
    ========================================= -->

    <section class="cbt-form-panel">

        <div class="cbt-login-card">

            <!-- Mobile branding -->

            <div class="cbt-mobile-brand">

                @if(!empty($collegeSetup->avatar))
                    <img
                        src="{{ asset($collegeSetup->avatar) }}"
                        alt="College Logo"
                    >
                @endif

                <strong>
                    {{ $collegeSetup->name ?? 'College CBT Portal' }}
                </strong>

            </div>


            <!-- Heading -->

            <div class="cbt-form-heading">

                <span class="cbt-eyebrow">
                    Student Examination Portal
                </span>

                <h2>Student Login</h2>

                <p>
                    Enter your registration number and select
                    your programme to access the CBT system.
                </p>

            </div>


            <!-- Session alerts -->

            @if(session('success'))
                <div class="cbt-alert cbt-alert-success"
                     role="status">
                    <i class="mdi mdi-check-circle-outline"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="cbt-alert cbt-alert-danger"
                     role="alert">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    {{ session('error') }}
                </div>
            @endif


            <!-- Login Form -->

            <form
                id="start-cbt-form"
                action="{{ route('login.action') }}"
                method="POST"
            >

                @csrf


                <!-- Registration Number -->

                <div class="cbt-form-group">

                    <label
                        for="admission_no"
                        class="cbt-form-label"
                    >
                        Registration / Matric Number
                    </label>

                    <div class="cbt-input-wrapper">

                        <input
                            type="text"
                            id="admission_no"
                            name="admission_no"
                            class="cbt-form-control @error('admission_no') is-invalid @enderror"
                            placeholder="Enter your Reg / Matric Number"
                            value="{{ old('admission_no') }}"
                            autocomplete="off"
                            autocapitalize="characters"
                            spellcheck="false"
                            required
                            autofocus
                        >

                        <i class="mdi mdi-account-outline cbt-input-icon"></i>

                    </div>

                    @error('admission_no')
                        <small class="cbt-field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- Programme -->

                <div class="cbt-form-group">

                    <label
                        for="department"
                        class="cbt-form-label"
                    >
                        Academic Programme
                    </label>

                    <div class="cbt-input-wrapper">

                        <select
                            id="department"
                            name="department"
                            class="cbt-form-control @error('department') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select your programme
                            </option>

                            @foreach($dept as $rs)

                                <option
                                    value="{{ $rs->department }}"
                                    {{ old('department') == $rs->department ? 'selected' : '' }}
                                >
                                    {{ $rs->department }}
                                </option>

                            @endforeach

                        </select>

                        <i class="mdi mdi-chevron-down cbt-input-icon"></i>

                    </div>

                    @error('department')
                        <small class="cbt-field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    id="start-cbt-button"
                    class="cbt-login-button"
                >
                    <span>Login to CBT</span>
                    <i class="mdi mdi-arrow-right"></i>
                </button>

            </form>


            <!-- Help text -->

            <div class="cbt-login-help">
                <i class="mdi mdi-shield-check-outline"></i>
                Please use only your assigned examination credentials.
                <div>
                    Need assistance? Contact your invigilator.
                </div>
            </div>


            <!-- Footer -->

            <div class="cbt-form-footer">
                &copy; 2020 - {{ date('Y') }}
                {{ $collegeSetup->name ?? 'CBT Portal' }}
                <div>
                    Computer Based Testing System
                </div>
            </div>

        </div>

    </section>

</main>


<!-- ========================================
     SCRIPTS
========================================= -->

<script src="{{ asset('js/app.js') }}"></script>

@stack('plugin-scripts')
@stack('custom-scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('start-cbt-form');
    const button = document.getElementById('start-cbt-button');

    if (!form || !button) return;

    form.addEventListener('submit', function (event) {

        if (!form.checkValidity()) {
            return;
        }

        // Prevent repeated submissions
        button.disabled = true;

        button.innerHTML =
            '<i class="mdi mdi-loading mdi-spin"></i> ' +
            '<span>Verifying Details...</span>';

    });

});
</script>

</body>
</html>

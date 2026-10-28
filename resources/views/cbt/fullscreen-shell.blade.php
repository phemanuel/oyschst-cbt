<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CBT Examination Portal</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { width: 100%; height: 100%; margin: 0; overflow: hidden; }
        body { font-family: Arial, sans-serif; background: #f5f8f6; }
        #cbt-shell { position: relative; width: 100%; height: 100vh; height: 100dvh; overflow: hidden; }
        #cbt-frame { display: block; width: 100%; height: 100%; border: 0; background: #fff; }
        #cbt-fullscreen-overlay {
            position: absolute; inset: 0; z-index: 2147483647;
            display: flex; justify-content: center; align-items: center;
            padding: 20px; overflow-y: auto;
            background: rgba(8, 30, 24, 0.96);
        }
        #cbt-fullscreen-overlay.is-hidden { display: none; }
        .cbt-dialog {
            width: 100%; max-width: 450px; padding: 36px 30px;
            background: #fff; border-radius: 16px; text-align: center;
            box-shadow: 0 22px 65px rgba(0,0,0,.24);
        }
        .cbt-icon {
            width: 68px; height: 68px; margin: 0 auto 18px;
            display: grid; place-items: center; border-radius: 50%;
            font-size: 32px; color: #18734f; background: #edf7f0;
        }
        .cbt-dialog h1 { margin: 0 0 14px; font-size: 24px; color: #123d31; }
        .cbt-dialog p { margin: 0 0 23px; font-size: 15px; line-height: 1.65; color: #58675e; }
        #cbt-enter-fullscreen {
            display: block; width: 100%; padding: 15px; cursor: pointer;
            font-size: 15px; font-weight: 700; border: 0; border-radius: 9px;
            color: #fff; background: #18734f;
        }
        #cbt-enter-fullscreen:hover { background: #125d3f; }
        #cbt-enter-fullscreen:disabled { opacity: .65; cursor: wait; }
        .cbt-dialog small { display: block; margin-top: 16px; line-height: 1.55; color: #718078; }
        #cbt-fullscreen-error { margin-top: 12px; font-size: 13px; color: #b42318; }
        #cbt-fullscreen-error[hidden] { display: none; }
        .cbt-emergency-link { margin-top: 18px; border: none; background: none; color: #52665b; font-size: 13px; cursor: pointer; text-decoration: underline; }
        .cbt-emergency-link:hover { color: #123d31; }
        #cbt-pin-panel[hidden], #cbt-pin-error[hidden] { display: none !important; }
        #cbt-pin-panel { margin-top: 15px; padding: 16px; border: 1px solid #dce8e0; background: #f7faf8; border-radius: 10px; }
        #cbt-pin-panel label { display: block; font-size: 13px; font-weight: 700; color: #123d31; margin-bottom: 8px; }
        #cbt-admin-pin { width: 100%; height: 46px; border: 1px solid #bccdc2; border-radius: 8px; text-align: center; letter-spacing: 10px; font-size: 20px; margin-bottom: 10px; }
        .cbt-pin-actions { display: flex; gap: 8px; }
        .cbt-pin-actions button { flex: 1; border-radius: 8px; padding: 11px; cursor: pointer; border: 1px solid #d1dcd5; font-weight: 700; }
        #cbt-pin-confirm { background: #123d31; color: #fff; }
        #cbt-pin-cancel { background: #fff; color: #334155; }
        #cbt-pin-error { color: #b42318; margin: 10px 0 0; font-size: 13px; }
        @media (max-width: 480px) { .cbt-dialog { padding: 28px 20px; } }
    </style>
</head>
<body>
    <main id="cbt-shell">
        <iframe id="cbt-frame"
                src="{{ route('login') }}"
                title="CBT Student Portal"
                allow="fullscreen"
                allowfullscreen></iframe>

        <div id="cbt-fullscreen-overlay" role="dialog" aria-modal="true"
             aria-labelledby="cbt-fullscreen-title">
            <section class="cbt-dialog">
                <div class="cbt-icon" aria-hidden="true">⛶</div>
                <h1 id="cbt-fullscreen-title">Full Screen Required</h1>
                <p>To access the CBT portal, enter full screen mode. Your login and examination pages will remain within this screen.</p>
                <button id="cbt-enter-fullscreen" type="button">Enter Full Screen</button>
                <small>If full screen is exited, this screen will appear again. Your examination timer is managed by the examination page.</small>
                <div id="cbt-fullscreen-error" role="alert" hidden></div>
                <button type="button" class="cbt-emergency-link" id="cbt-emergency-open">Admin Emergency Exit</button>
                <form id="cbt-pin-panel" hidden autocomplete="off">
                    <label for="cbt-admin-pin">Enter administrator 4-digit PIN</label>
                    <input id="cbt-admin-pin" name="pin" type="password" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" minlength="4" required autocomplete="off">
                    <div class="cbt-pin-actions">
                        <button type="button" id="cbt-pin-cancel">Cancel</button>
                        <button type="submit" id="cbt-pin-confirm">Exit Fullscreen</button>
                    </div>
                    <div id="cbt-pin-error" role="alert" hidden></div>
                </form>
            </section>
        </div>
    </main>

    
<script>
(function () {
    'use strict';

    const shell = document.getElementById('cbt-shell');
    const overlay = document.getElementById('cbt-fullscreen-overlay');
    const button = document.getElementById('cbt-enter-fullscreen');
    const error = document.getElementById('cbt-fullscreen-error');

    const emergencyOpen = document.getElementById('cbt-emergency-open');
    const pinPanel = document.getElementById('cbt-pin-panel');
    const pinInput = document.getElementById('cbt-admin-pin');
    const pinError = document.getElementById('cbt-pin-error');
    const pinConfirm = document.getElementById('cbt-pin-confirm');
    const pinCancel = document.getElementById('cbt-pin-cancel');

    let emergencyExiting = false;
    let busy = false;

    /*
    |--------------------------------------------------------------------------
    | FULLSCREEN COMPATIBILITY
    |--------------------------------------------------------------------------
    */

    function getFullscreenElement() {
        return document.fullscreenElement ||
               document.webkitFullscreenElement ||
               document.mozFullScreenElement ||
               document.msFullscreenElement ||
               null;
    }

    function isFullscreenActive() {
        return getFullscreenElement() === shell;
    }

    function syncFullscreen() {
        const active = isFullscreenActive();

        overlay.classList.toggle(
            'is-hidden',
            active || emergencyExiting
        );

        if (active) {
            error.hidden = true;
            error.textContent = '';
        }
    }

    function requestCompatibleFullscreen() {

        var request =
            shell.requestFullscreen ||
            shell.webkitRequestFullscreen ||
            shell.mozRequestFullScreen ||
            shell.msRequestFullscreen;

        if (typeof request !== 'function') {
            throw new Error('Fullscreen is not supported.');
        }

        return request.call(shell);
    }

    function exitCompatibleFullscreen() {

        const exit =
            document.exitFullscreen ||
            document.webkitExitFullscreen ||
            document.mozCancelFullScreen ||
            document.msExitFullscreen;

        if (typeof exit === 'function' && getFullscreenElement()) {
            return exit.call(document);
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | ENTER FULLSCREEN
    |--------------------------------------------------------------------------
    */

    button.addEventListener('click', function () {

        if (busy || emergencyExiting) return;

        busy = true;
        button.disabled = true;

        error.hidden = true;
        error.textContent = '';

        try {

            // Request fullscreen directly from the click event
            var result = requestCompatibleFullscreen();

            Promise.resolve(result).then(function () {

                syncFullscreen();

                if (!isFullscreenActive()) {
                    throw new Error(
                        'Fullscreen was requested but is not active.'
                    );
                }

                console.log('CBT fullscreen successfully activated.');

            }).catch(function (e) {

                console.error('Fullscreen activation error:', e);

                error.textContent =
                    'Unable to activate fullscreen: ' +
                    (e.message || 'Browser restriction');

                error.hidden = false;

            }).then(function () {

                busy = false;
                button.disabled = false;

            });

        } catch (e) {

            console.error('Fullscreen error:', e);

            error.textContent = e.message;
            error.hidden = false;

            busy = false;
            button.disabled = false;

        }

    });
    /*
    |--------------------------------------------------------------------------
    | ADMIN EMERGENCY EXIT PANEL
    |--------------------------------------------------------------------------
    */

    emergencyOpen.addEventListener('click', function () {

        pinPanel.hidden = false;
        pinError.hidden = true;
        pinInput.value = '';
        pinInput.focus();

    });

    pinCancel.addEventListener('click', function () {

        pinPanel.hidden = true;
        pinInput.value = '';
        pinError.hidden = true;

    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN PIN VERIFICATION
    |--------------------------------------------------------------------------
    */

    pinPanel.addEventListener('submit', async function (event) {

        event.preventDefault();

        if (pinConfirm.disabled || !pinPanel.reportValidity()) {
            return;
        }

        pinConfirm.disabled = true;
        pinError.hidden = true;

        try {

            // Fetch the current Laravel CSRF token
            const tokenResponse = await fetch(
                "{{ route('fullscreen.emergency.token') }}",
                {
                    method: 'GET',
                    credentials: 'same-origin',
                    cache: 'no-store',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            if (!tokenResponse.ok) {
                throw new Error(
                    'Unable to refresh CSRF token. HTTP ' +
                    tokenResponse.status
                );
            }

            const tokenData = await tokenResponse.json();

            // Verify the administrator PIN
            const response = await fetch(
                "{{ route('fullscreen.emergency.verify') }}",
                {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': tokenData.csrf_token
                    },
                    body: JSON.stringify({
                        pin: pinInput.value
                    })
                }
            );

            const result = await response.json().catch(function () {
                return {};
            });

            if (!response.ok || result.success !== true) {

                if (response.status === 403) {

                    pinError.textContent =
                        'Incorrect administrator PIN. Please try again.';

                } else if (response.status === 419) {

                    pinError.textContent =
                        'Your session has expired. Please retry.';

                } else if (response.status === 429) {

                    pinError.textContent =
                        'Too many attempts. Please try again later.';

                } else {

                    pinError.textContent =
                        'Verification failed. Please contact the administrator.';

                    console.error(
                        'Emergency PIN verification status:',
                        response.status
                    );

                }

                pinError.hidden = false;
                pinInput.value = '';
                pinInput.focus();

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | VERIFIED EMERGENCY EXIT
            |--------------------------------------------------------------------------
            */

            emergencyExiting = true;

            try {

                await Promise.resolve(
                    exitCompatibleFullscreen()
                );

            } catch (exitError) {

                console.warn(
                    'Fullscreen exit warning:',
                    exitError
                );

            }

            // Leave the fullscreen shell completely
            window.location.replace(
                "{{ route('fullscreen.emergency.exited') }}"
            );

        } catch (verificationError) {

            console.error(
                'Emergency exit verification error:',
                verificationError
            );

            pinError.textContent =
                'Unable to verify the PIN. Please contact the administrator.';

            pinError.hidden = false;

        } finally {

            pinConfirm.disabled = false;

        }

    });

    /*
    |--------------------------------------------------------------------------
    | FULLSCREEN CHANGE LISTENERS
    |--------------------------------------------------------------------------
    */

    [
        'fullscreenchange',
        'webkitfullscreenchange',
        'mozfullscreenchange',
        'MSFullscreenChange'
    ].forEach(function (eventName) {

        document.addEventListener(
            eventName,
            syncFullscreen
        );

    });

    document.addEventListener('visibilitychange', function () {

        if (!document.hidden) {
            syncFullscreen();
        }

    });

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    syncFullscreen();

})();
</script>

</body>
</html>

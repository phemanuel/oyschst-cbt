<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blink Test</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* Simple blinking style */
.blink {
    background-color: #ff9800; /* orange background */
    color: #fff;
    font-weight: bold;
    padding: 20px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    animation: blink 1s infinite;
}

/* Blink animation */
@keyframes blink {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0; }
}
</style>
</head>
<body>

<h2>Simple Blink Test</h2>

<div id="test-warning">
    <i class="fa fa-clock"></i>
    <span>Blinking Warning!</span>
</div>

<button onclick="startBlink()">Start Blink</button>

<script>
// JS to trigger blinking
function startBlink() {
    const warning = document.getElementById('test-warning');
    warning.classList.add('blink');
}
</script>

</body>
</html>

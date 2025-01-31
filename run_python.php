

<?php
$python = "C:\Users\risab\AppData\Local\Programs\Python\Python313\python.exe";  // Replace with your actual Python path
$script = "Disease-Prediction-Chatbot/main.py";

// Check if Flask is already running
$flask_running = shell_exec("tasklist | findstr /I python");

// If Flask is NOT running, start it
if (strpos($flask_running, "python") === false) {
    $command = "start /B " . escapeshellarg($python) . " " . escapeshellarg($script);
    shell_exec($command);
}

// Wait a few seconds to ensure Flask starts
sleep(3);

// Redirect to the Flask web app
header("Location: http://127.0.0.1:5000/");
exit;
?>



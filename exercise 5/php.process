<?php
date_default_timezone_set('Asia/Manila');

function validate_name($name) {
    $name = htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8');
    
    if (strlen($name) < 3) {
        return false;
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        return false;
    }

    $name = preg_replace('/\s+/', ' ', $name);

    return $name;
}

header('Content-Type: text/html; charset=UTF-8'); // Specifies the content type as HTML
header('X-Powered-By: CustomServer'); // Custom header to show server-side control

if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = validate_name($_GET['name']);

    if ($name === false) {
        echo "<p style='color: red;'>Invalid name. Please ensure it contains only letters and is at least 3 characters long.</p>";
        exit();
    }

    $currentHour = date("H");
    $greeting = "Hello";

    if ($currentHour < 12) {
        $greeting = "Good morning";
    } elseif ($currentHour < 18) {
        $greeting = "Good afternoon";
    } else {
        $greeting = "Good evening";
    }

    echo "<h3>$greeting, $name!</h3>";
    echo "<p>Welcome and have a great day!</p>";
    echo "<p>The current server time is: <strong>" . date("h:i A") . "</strong></p>";

} else {
    echo "<p style='color: red;'>No name was provided. Please enter your name and try again.</p>";
}
?>

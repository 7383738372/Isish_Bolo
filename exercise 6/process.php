<?php
header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
header('Content-Security-Policy: upgrade-insecure-requests');
header('X-Frame-Options: DENY'); 
header('X-Content-Type-Options: nosniff'); 
header('X-XSS-Protection: 1; mode=block'); 

date_default_timezone_set('Asia/Manila');

echo "Current Date and Time in the Philippines: <br><strong>" . date("M. d, Y | h:i A") . "</strong>";

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

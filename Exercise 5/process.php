<?php

date_default_timezone_set('Asia/Singapore');



if (isset($_GET['name']) && !empty($_GET['name'])) {

    // Sanitize user input to prevent XSS attacks

    $name = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');

    

    // Get the current hour to determine the greeting

    $currentHour = date("H");

    $greeting = "Hello";



    if ($currentHour < 12) {

        $greeting = "Good morning";

    } elseif ($currentHour < 18) {

        $greeting = "Good afternoon";

    } else {

        $greeting = "Good evening";

    }



    // Return the greeting message

    echo "<h3>$greeting, $name!</h3>";

    echo "<p>Welcome and have a great day!</p>";

    echo "<p>The current server time is: <strong>" . date("h:i A") . "</strong></p>";

} else {

    echo "<p style='color: red;'>No name was provided. Please enter your name and try again.</p>";

}

?>

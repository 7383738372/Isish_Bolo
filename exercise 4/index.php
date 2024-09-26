<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Exercise 4</title>

    <link rel="stylesheet" href="styles.css">

</head>

<body>

    <div class="container">

    <h1>Exercise 4: GET and POST Method</h1>



    <h2>GET Method Form</h2>

    <form action="" method="GET">

        <label for="name_get">Name (GET): </label>

        <input type="text" id="name_get" name="name_get">

        <input type="submit" value="Submit GET">

    </form>



    <h2>POST Method Form</h2>

    <form action="" method="POST">

        <label for="name_post">Name (POST): </label>

        <input type="text" id="name_post" name="name_post">

        <input type="submit" value="Submit POST">

    </form>



    <hr>



    <?php

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name_get'])) {

        $name_get = htmlspecialchars($_GET['name_get']);

        if (!empty($name_get)) {

            echo "<div class='response'<strong>Response:</strong> Hello, " . $name_get . "!<br>";

            echo "<p>Check the URL address.</p></div>";

        }

        else {

            echo "<div class='response' style='color: red;'>No name was provided. Please enter your name and try again.</div>";

        }

    }



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name_post'])) {

        $name_post = htmlspecialchars($_POST['name_post']);

        if (!empty($name_post)) {

            echo "<div class='response'><strong>Response:</strong> Hello, " . $name_post . "!</div>";

        }

        else {

            echo "<div class='response' style='color: red;'>No name was provided. Please enter your name and try again.</div>";

        }

    }

    ?>

    </div>



</body>

</html>

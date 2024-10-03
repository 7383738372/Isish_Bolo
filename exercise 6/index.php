
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 6</title>

    <!-- Add HTTPS header for security -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    <style>
        body {
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #response {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #e9ecef;
            display: none;
        }

        .loading {
            display: none;
            margin-top: 20px;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Welcome!</h2>
        <p>Please enter your name below:</p>

        <input type="text" id="name" placeholder="Enter your name here" />
        <button onclick="sendRequest()">Submit</button>

        <div id="response"></div> <!-- Response display area -->
        <div class="loading" id="loading">Loading...</div> <!-- Loading animation -->
    </div>

    <footer>
        <p>&copy; 2024 Group 5. All Rights Reserved.</p>
    </footer>

    <script>
        function sendRequest() {
            var name = document.getElementById("name").value.trim();
            var responseDiv = document.getElementById("response");
            var loadingDiv = document.getElementById("loading");

            if (name === "") {
                alert("Please enter your name.");
                return;
            }
            if (name.length < 3) {
                alert("Name must be at least 3 characters long.");
                return;
            }
            if (!/^[a-zA-Z\s]+$/.test(name)) {
                alert("Name can only contain letters and spaces.");
                return;
            }
            name = name.replace(/\s+/g, ' ').trim();

            loadingDiv.style.display = "block";
            responseDiv.style.display = "none";  // Hide the response area

            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    loadingDiv.style.display = "none";
                    responseDiv.innerHTML = this.responseText;
                    responseDiv.style.display = "block"; // Show the response area
                }
            };
            xhttp.open("GET", "process.php?name=" + encodeURIComponent(name), true);

            xhttp.send();
        }
    </script>

</body>

</html>

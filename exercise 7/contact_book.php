<?php
session_start();
if (isset($_SESSION['lastSearchTerm'])) {
    echo "<p>Session Search Term: " . htmlspecialchars($_SESSION['lastSearchTerm']) . "</p>";
}

if (isset($_COOKIE['lastSearchTerm'])) {
    echo "<p>Cookie Search Term: " . htmlspecialchars($_COOKIE['lastSearchTerm']) . "</p>";
}

header("HTTP/1.1 200 OK");
echo "Request was successful.";

$filename = 'contacts.txt';
$successMessage = "";
$searchTerm = ""; // Initialize search term for GET requests

// Function to display contacts
function displayContacts($filename, $searchTerm = "") {
    if (file_exists($filename)) {
        $contacts = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($contacts) {
            $filteredContacts = [];
            
            // Filter contacts based on the search term (GET request)
            if (!empty($searchTerm)) {
                foreach ($contacts as $contact) {
                    if (stripos($contact, $searchTerm) !== false) { // Case-insensitive search
                        $filteredContacts[] = $contact;
                    }
                }
            } else {
                $filteredContacts = $contacts;
            }

            if (!empty($filteredContacts)) {
                echo "<h2 style='color: #333; font-size: 20px; font-weight: bold; text-align: left; margin-top: 20px;'>Contact List:</h2>";
                echo "<ul style='list-style-type: none; padding: 0;'>";

                foreach ($filteredContacts as $contact) {
                    $contactDetails = explode('|', $contact); 
                    echo "<li style='padding: 8px 0; border-bottom: 1px solid #ccc;'>"
                         . "<strong>" . htmlspecialchars($contactDetails[0]) . "</strong>: " 
                         . htmlspecialchars($contactDetails[1]) .
                         " <form method='post' action='' style='display:inline; margin-left: 10px;'>"
                         . "<input type='hidden' name='delete' value='" . htmlspecialchars($contact) . "'>"
                         . "<button type='submit' style='background-color: #2E7D32; color: white; border: 2px solid #f3fadc; padding: 8px 12px; border-radius: 5px; cursor: pointer;'>Delete</button>"
                         . "</form></li>";
                }

                echo "</ul>";
            } else {
                echo "<p style='color: #666;'>No matching contacts found.</p>";
            }
        } else {
            echo "<p style='color: #666;'>No contacts found.</p>";
        }
    } else {
        echo "<p style='color: #666;'>Contact file does not exist.</p>";
    }
}

// Function to add a new contact
function addContact($filename, $username, $contactNumber) {
    global $successMessage;
    $existingContacts = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    foreach ($existingContacts as $contact) {
        $contactDetails = explode('|', $contact);
        if ($contactDetails[0] == $username && $contactDetails[1] == $contactNumber) {
            $successMessage = "<p style='color: red;'>Contact already exists.</p>";
            return;
        }
    }

    file_put_contents($filename, $username . '|' . $contactNumber . PHP_EOL, FILE_APPEND);
    $successMessage = "<p style='color: green;'>Contact added successfully.</p>";
}

// Function to delete a contact
function deleteContact($filename, $contact) {
    global $successMessage;
    if (file_exists($filename)) {
        $contacts = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $newContacts = array_filter($contacts, function($existingContact) use ($contact) {
            return trim($existingContact) !== trim($contact);
        });

        if (count($contacts) === count($newContacts)) {
            $successMessage = "<p style='color: red;'>Contact not found.</p>";
            return;
        }

        file_put_contents($filename, implode(PHP_EOL, $newContacts) . PHP_EOL);
        $successMessage = "<p style='color: green;'>Contact deleted successfully.</p>";
    } else {
        $successMessage = "<p style='color: red;'>Contact file does not exist.</p>";
    }
}

// Handling POST requests for adding/deleting contacts
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['contact'])) {
        $username = trim($_POST['username']);
        $newContact = trim($_POST['contact']);
        if (!empty($username) && !empty($newContact) && is_numeric($newContact)) {
            addContact($filename, $username, $newContact);
        } else {
            $successMessage = "<p style='color: red;'>Please enter a valid username and a numeric contact number.</p>";
        }
    } elseif (isset($_POST['delete'])) {
        $contactToDelete = trim($_POST['delete']);
        if (!empty($contactToDelete)) {
            deleteContact($filename, $contactToDelete);
        }
    } elseif (isset($_POST['clearSearch'])) {
        setcookie("lastSearchTerm", "", time() - 3600); // Clear cookie
        unset($_SESSION['lastSearchTerm']); // Clear session
        $searchTerm = ""; // Reset search term
    }
}

// Handling GET requests for search
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $searchTerm = trim($_GET['search']);
    $_SESSION['lastSearchTerm'] = $searchTerm; // Store in session
    setcookie("lastSearchTerm", $searchTerm, time() + 3600 * 24 * 30); // Cookie expires in 30 days
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Book</title>

    <script>
    // Existing function for handling the AJAX search
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("contactList").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("contactList").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "contact_search.php?search=" + str, true);
            xmlhttp.send();
        }
    }

    // Function to retrieve a cookie value by name
    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    // On page load, check for the last search term from session or cookie
    window.onload = function() {
        <?php if (isset($_SESSION['lastSearchTerm'])) : ?>
            document.getElementById("search").value = "<?php echo htmlspecialchars($_SESSION['lastSearchTerm']); ?>"; // Set input value
            showHint("<?php echo htmlspecialchars($_SESSION['lastSearchTerm']); ?>"); // Trigger search with last term
        <?php else : ?>
            let lastSearchTerm = getCookie("lastSearchTerm");
            if (lastSearchTerm) {
                document.getElementById("search").value = lastSearchTerm; // Set input value
                showHint(lastSearchTerm); // Trigger search with last term
            }
        <?php endif; ?>
    };
    </script>

</head>
<body style="background-image: url('avocadobg.jpg'); background-size: cover; background-position: center; font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 0;">

    <div style="background-color: #F1EB9C; border-radius: 15px; padding: 30px; width: 400px; margin: 50px auto; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); border: 5px solid #2E7D32;">
        <h1 style="color: #2E7D32; font-size: 36px; margin-bottom: 20px;">CONTACT BOOK</h1>

        <!-- Add Contact Form -->
        <form method="post" action="" style="margin-bottom: 20px;">
            <label for="username" style="font-size: 18px; color: #333;">Username:</label><br>
            <input type="text" id="username" name="username" required style="width: 80%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 2px solid #4CAF50;"><br>
            
            <label for="contact" style="font-size: 18px; color: #333;">Contact Number:</label><br>
            <input type="number" id="contact" name="contact" required style="width: 80%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 2px solid #4CAF50;"><br>
            
            <button type="submit" style="background-color: #2E7D32; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer;">Add Contact</button>
        </form>

        <!-- Display success message if any -->
        <?php echo $successMessage; ?>

        <!-- Search and Clear Search Forms -->
        <form method="get" action="" style="margin-bottom: 10px;">
            <label for="search" style="font-size: 18px; color: #333;">Search:</label><br>
            <input type="text" id="search" name="search" onkeyup="showHint(this.value)" style="width: 80%; padding: 10px; border-radius: 5px; border: 2px solid #4CAF50;">
        </form>

        <form method="post" action="" style="margin-bottom: 20px;">
            <input type="hidden" name="clearSearch" value="1">
            <button type="submit" style="background-color: #f5f5f5; color: #333; border: 1px solid #ccc; padding: 8px 12px; border-radius: 5px; cursor: pointer;">Clear Search</button>
        </form>

        <!-- Contact List -->
        <div id="contactList">
            <?php displayContacts($filename, $_GET['search'] ?? $_SESSION['lastSearchTerm'] ?? ""); ?>
        </div>
    </div>

    <footer>
    <p>&copy; 2024 GROUP NG MAGAGANDA. All rights reserved.</p>
</footer>

</body>
</html>

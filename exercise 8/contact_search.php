<?php
$filename = 'contacts.txt';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
displayContacts($filename, $searchTerm);

function displayContacts($filename, $searchTerm = "") {
    if (file_exists($filename)) {
        $contacts = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($contacts) {
            $filteredContacts = [];
            
            if (!empty($searchTerm)) {
                foreach ($contacts as $contact) {
                    if (stripos($contact, $searchTerm) !== false) {
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
?>

    

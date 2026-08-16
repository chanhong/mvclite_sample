<?php
// Check if DateTimeZone class exists
if (class_exists('DateTimeZone')) {
    echo "DateTimeZone class exists! It's available for use.<br>";

    // Try creating an instance
    try {
        $utcZone = new DateTimeZone('UTC');
        echo "Successfully created DateTimeZone object for UTC: " . $utcZone->getName() . "<br>";

        // List some available timezones using PHP's Intl features
        echo "Listing some available TimeZone identifiers:<br>";
        $timeZoneIdentifiers = DateTimeZone::listIdentifiers();
        // Print the first 5 for brevity
        for ($i = 0; $i < 5 && $i < count($timeZoneIdentifiers); $i++) {
            echo "- " . htmlspecialchars($timeZoneIdentifiers[$i]) . "<br>";
        }
        if(count($timeZoneIdentifiers) > 5) echo "...<br>";

    } catch (Exception $e) {
        echo "Error creating DateTimeZone object: " . htmlspecialchars($e->getMessage()) . "<br>";
    }

} else {
    echo "DateTimeZone class does NOT exist. The Intl extension might not be fully functional or enabled correctly.<br>";
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');  //--> Adjust to your time zone.
$target_dir = "captured_images/"; //--> Folder to store images.

// Establish connection to MySQL
include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to database.";
}
// Append timestamp to file name
$timestamp = date('His');
$imageFileType = strtolower(pathinfo($_FILES["imageFile"]["name"], PATHINFO_EXTENSION));
$file_name = basename($_FILES["imageFile"]["name"]);
$new_file_name = date("Ymd_His") . "_" . $file_name;

// Check if the picture name contains "001" to "999"
if (preg_match('/[1-9][0-9]{0,2}/', $file_name, $matches)) {
    // Extract the matched folder number
    $folder_number = sprintf('%03d', $matches[0]);
    
    // Create folder for the matched number if not exists
    $sub_folder = $target_dir . $folder_number . "/";
    if (!file_exists($sub_folder)) {
        mkdir($sub_folder, 0777, true); // You may adjust the permission as needed
    }

    // Append date folder
    $sub_folder .= date("Ymd") . "/";
    if (!file_exists($sub_folder)) {
        mkdir($sub_folder, 0777, true); // You may adjust the permission as needed
    }

    $target_file = $sub_folder . $new_file_name;
} else {
    // If the filename doesn't contain '001' - '999'
    // Save directly into target directory
    $sub_folder = $target_dir;
    
    // Append date folder
    $sub_folder .= date("Ymd") . "/";
    if (!file_exists($sub_folder)) {
        mkdir($sub_folder, 0777, true); // You may adjust the permission as needed
    }

    $target_file = $sub_folder . $new_file_name;
}

$uploadOk = 1;

// Check if image file is an actual image or fake image.
if (isset($_FILES["imageFile"])) {
    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists.
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size.
if ($_FILES["imageFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats.
if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error.
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file.
} else {
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
        echo "Photo successfully uploaded to the server with the name: " . $new_file_name;

        // Insert into MySQL database
        $sql = "INSERT INTO file_name (image_name, id) VALUES ('$new_file_name', '$folder_number')";
        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error in the photo upload process.";
    }
}

// Close MySQL connection
$conn->close();
?>

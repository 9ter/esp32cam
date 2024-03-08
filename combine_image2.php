<?php
// Set timezone to Asia/Bangkok
date_default_timezone_set('Asia/Bangkok');

// Function to combine images into one image in a 3x5 grid format within a range of time
function combineImagesInRange($imageFiles, $outputDir, $startTime, $endTime, $folderName, $line_notify, $baseDir)
{
    // Check if the array is empty before accessing its elements
    if (empty($imageFiles)) {
        //echo "No image files found.";
        return;
    }

    // Initialize memory usage limit
    ini_set('memory_limit', '-1'); // Set memory limit to unlimited (-1)

    // Get dimensions of the first image to determine the dimensions of the combined image
    $firstImage = imagecreatefromjpeg($imageFiles[0]);
    if ($firstImage === false) {
        // echo "Failed to load image: " . $imageFiles[0];
        return;
    }

    $imageWidth = 320; // กำหนดความกว้างของภาพ
    $imageHeight = 240; // กำหนดความสูงของภาพ
    $numImages = count($imageFiles);

    // Ensure we have at most 15 images (3x5 grid)
    $numImages = min($numImages, 30);

    // Calculate grid size
    $numColumns = min($numImages, 3); // 3 columns
    $numRows = ceil($numImages / $numColumns);

    // Calculate dimensions for the combined image
    $combinedWidth = $imageWidth * $numColumns;
    $combinedHeight = $imageHeight * $numRows;

    // Create the blank canvas for the combined image
    $combinedImage = imagecreatetruecolor($combinedWidth, $combinedHeight);
    imagefill($combinedImage, 0, 0, imagecolorallocate($combinedImage, 255, 255, 255)); // Fill with white background

    // Loop through each image file within the specified time range
    $offsetX = 0;
    $offsetY = 0;
    $imageIndex = 0;
    foreach ($imageFiles as $imageFile) {
        $fileTime = filemtime($imageFile); // Get the last modified time of the image file
        if ($fileTime >= $startTime && $fileTime <= $endTime) { // Check if the file is within the specified time range
            if ($imageIndex >= $numImages) {
                break; // Stop if we have processed all images
            }

            // Load the current image
            $currentImage = imagecreatefromjpeg($imageFile);
            if ($currentImage === false) {
                // echo "Failed to load image: $imageFile";
                continue;
            }

            // Copy current image onto the combined image at the appropriate position in the grid
            imagecopy($combinedImage, $currentImage, $offsetX, $offsetY, 0, 0, $imageWidth, $imageHeight);

            // Free memory for current image
            imagedestroy($currentImage);

            // Update grid position for the next image
            $offsetX += $imageWidth;
            if (($imageIndex + 1) % $numColumns === 0) {
                $offsetX = 0; // Reset X offset if we reach the end of a row
                $offsetY += $imageHeight; // Move to the next row
            }

            $imageIndex++;
        }
    }


    // Generate output filename with current date and time
    $outputFilename = $outputDir . '/' . date('Ymd_His', $startTime) . '_' . date('Ymd_His', $endTime) . '_' . $folderName . '_combined.jpg';

    // Save the combined image
    imagejpeg($combinedImage, $outputFilename);


    // Free memory for combined image
    imagedestroy($combinedImage);

    //line_notify($line_notify,$outputPath);

    return $outputFilename;
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve values sent via POST parameters
    $folderName = isset($_GET['camera']) ? $_GET['camera'] : '';
    $Date = isset($_GET['date']) ? $_GET['date'] : '';
    $startTime = isset($_GET['time_start']) ? $_GET['time_start'] : '';
    $endTime = isset($_GET['time_stop']) ? $_GET['time_stop'] : '';
    $line_token = isset($_GET['line_token']) ? $_GET['line_token'] : '';



    // Prepare response array
    $response = array(
        'status' => 'success',
        'message' => 'Received data successfully.',
        'camera' => $folderName,
        'date' => $Date,
        'time_start' => $startTime,
        'time_stop' => $endTime,
        'line_token' => $line_token
    );

    // Convert the response array to JSON format

    echo json_encode($response);

    // Validate folder name (you may need to add additional validation)
    if (!preg_match('/^\d{3}$/', $folderName)) {
        //echo "Invalid folder name.";
        exit;
    }

    // Construct base directory path with date
    $baseDir = "D:/xampp/htdocs/esp32cam/captured_images/{$folderName}/" . date('Ymd');

    // Get all image files from the directory
    $imageFiles = glob($baseDir . '/*.jpg'); // Adjust file extension if needed

    // Combine date and time inputs for start and end times
    $startTimeCombined = strtotime("$Date $startTime");
    $endTimeCombined = strtotime("$Date $endTime");

    // Call function to combine images within the specified time range
    $outputPath = combineImagesInRange($imageFiles, $baseDir, $startTimeCombined, $endTimeCombined, $folderName, $line_token, $baseDir);

    // Output combined image path
    //echo "<script>document.getElementById('output').innerHTML = 'Combined image saved: $outputPath';</script>";
}

function line_notify($token,$imagePath)
{
    $access_token = $token;

    // ข้อความที่ต้องการส่ง
    $message = "รวมรูป";

    // URL ของ Line Notify API
    $url = 'https://notify-api.line.me/api/notify';

    // ข้อมูลที่จะส่งไปยัง Line Notify API
    $data = array(
        'message' => $message,
        'imageFile' => new CURLFile("$imagePath") // ใช้ path ของรูปภาพที่คุณต้องการส่งผ่าน Line Notify
    );

    // ใช้ cURL เพื่อสร้าง HTTP request
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer $access_token"));

    // ตัวเลือกเพิ่มเติมสำหรับการตั้งค่า cURL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // ในกรณีที่คุณใช้ SSL สำหรับเว็บไซต์ที่ไม่ได้รับการรับรอง

    // ส่งคำขอ
    $result = curl_exec($curl);

    // ตรวจสอบผลลัพธ์
    if ($result === FALSE) {
        echo 'Error sending Line Notify!';
    } else {
        echo 'Line Notify sent successfully!';
    }

    // ปิดเซสชัน cURL
    curl_close($curl);
}
line_notify($line_token, $outputPath);
unlink($outputPath);


?>
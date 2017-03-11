<?php
require_once 'libs/Buffer/Client.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: image/png');

// Decode JSON into PHP Object we can use
$src = $_POST['dataUrl'];
// Access the source object's data
// echo "Image Data URL is: " . $src->dataUrl . "<br>";
// echo "Content Type is: " . $src->contentType . "<br>";

// Decode the inline image url to extract data contents
$data = base64_decode($src);
$formImage = imagecreatefromstring($data);
imagejpeg($formImage, "output.jpg");
// Clear the memory of the tempory image
imagedestroy($formImage);

?>
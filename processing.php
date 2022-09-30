<?php require_once("includes/header2.php"); 
 require_once("includes/classes/VideoUploadData.php"); 
 require_once("includes/classes/VideoProcessor.php");
 require_once("includes/classes/VideoDetailsFormProvider.php"); 

if (!isset($_POST['uploadButton'])) {
	echo "No File Found";
	exit();
}
// create file upload data
$videoUploadData = new VideoUploadData($_FILES['fileInput'], 
    $_POST['titleInput'], 
	$_POST['descriptionInput'], 
	$_POST['privacyInput'], 
	$_POST['categoryInput'], 
	"REPLACE-THIS");
//Processing video data(upload)
$videoProcessor = new VideoProcessor($con);
$wasSuccesful = $videoProcessor->upload($videoUploadData);

?> 



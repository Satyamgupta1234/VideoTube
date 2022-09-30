<?php 
class VideoProcessor {
	private $con;
	private $sizeLimit = 500000000;
	private $allowedTypes = array("mp4", "flv", "webm", "vob", "mov", "mpg","mp3" );
	public function __construct($con) {
		$this->con = $con;

	}

	public function upload($videoUploadData) {
		$targetDir = "uploads/videos/";
		$videoData = $videoUploadData->videoDataArray;
		$tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
		$tempFilePath = str_replace(" ", "_", $tempFilePath);
		$isValidData = $this->processData($videoData, $tempFilePath);
		if(!$isValidData) {
			return false;
		}
		if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)){
			// echo "file move successfully";
			$finalFilePath = $targetDir . uniqid() . ".mp4";
			if(!$this->insertVideoData($videoUploadData, $finalFilePath)) 
			{
				echo "Insert query failed";
				return false;
			}
		}


	}
	private function processData($videoData, $filePath) {
       $videoType = pathInfo($filePath, PATHINFO_EXTENSION);
       if (!$this->isValidSize($videoData)) {
       	echo "File too large. can't be more than" . $this->sizeLimit . " bytes";
       	return false; 
       }
       else if(!$this->isValidType($videoType)) {
           echo "Invalid File Type";
           return false;
       }
       elseif ($this->hasError($videoData)) {
          echo "Error code: " . $videoData["error"];
          return false;
       	
       }
       return true;
	}
	private function isValidSize($data) {
		return $data["size"] <= $this->sizeLimit;
	}
	private function isValidType($type) {
        $lowercase = strtolower($type);
        return in_array($lowercase, $this->allowedTypes);
	}
	private function hasError($data) {
		return $data["error"] != 0;
	}
	private function insertVideoData($uploadData, $filePath) {
		$query = $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
			VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");
		$query->bindParam(":title", $uploadData->title);
		$query->bindParam(":uploadedBy", $uploadData->uploadedBy);
		$query->bindParam(":description", $uploadData->description);
		$query->bindParam(":privacy", $uploadData->privacy);
		$query->bindParam(":category", $uploadData->category);
		$query->bindParam(":filePath", $filePath);
		return $query->execute();

	}
}
?>
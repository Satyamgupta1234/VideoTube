<?php
/**
 * 
 */
class VideoDetailsFormProvider
{
	private $con;
	public function __construct($con) {
		$this->con = $con;

	}
	
	public function createUploadForm()
	{
		$fileInput = $this->createFileInput();
		$titleInput = $this->createTitleInput();
		$descriptionInput = $this->createDescriptionInput();
		$privacyInput = $this->createPrivacyInput();
		$categoriesInput = $this->createCategoriesInput();
		$uploadButton = $this->createUploadButton();
		return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
		 $fileInput
		 $titleInput
		 $descriptionInput
		 $privacyInput
		 $categoriesInput
		 $uploadButton
		</form>";
	}
	private function createFileInput() {
		return " <div class='form-group'>
		 <label for='fileInput'>Select Your File</label>
		    <input type='file' class='form-control-file' id='fileInput' name='fileInput' >
		  </div>";
	}
	private function createTitleInput() {
		return "<div class = form-group>
		<input class='form-control' type='text' placeholder='Title' name='titleInput' >
		</div>";
}
    private function createDescriptionInput() {
		return "<div class = form-group>
		<textarea class='form-control' type='text' placeholder='Description' name='descriptionInput' row='5'></textarea>
		</div>";
}
private function createPrivacyInput() {
	return "<div class = form-group>
	         <label for='privacyInput'>Select Your Privacy Setting</label>
	         <select class='form-control' id='privacyInput' name='privacyInput'>
              <option value='0'>Private</option>
              <option value='1'>Public</option>
</select></div>";
}
private function createCategoriesInput() {
	 $query = $this->con->prepare("SELECT * FROM categories");
                    $query->execute();
                    $html = "<div class = form-group>
	         <label for='categoriesInput'>Select Your Category</label>
	         <select class='form-control' id='categoryInput' name='categoryInput'>";
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    	$name = $row["name"];
                    	$id = $row["id"];
                    	$html .= "<option value='$id'>$name</option>";
                    	// echo $row["name"] . "<br>";
                    }
                    $html .= "</select></div>";
                    return $html;
}
private function createUploadButton() {
	return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
}
}
	?>
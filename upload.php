<?php require_once("includes/header2.php"); ?> 
<?php require_once("includes/classes/VideoDetailsformProvider.php"); ?> 
       			<div class="column">
       				<?php
       				$formProvider = new VideoDetailsFormProvider($con);
       				echo $formProvider->createUploadForm();
                   


       				?>
       			</div>
<?php require_once("includes/footer.php"); ?> 
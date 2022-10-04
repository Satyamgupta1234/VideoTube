<?php require_once("includes/header2.php"); ?> 
<?php require_once("includes/classes/VideoDetailsformProvider.php"); ?> 
       			<div class="column">
       				<?php
       				$formProvider = new VideoDetailsFormProvider($con);
       				echo $formProvider->createUploadForm();
                   


       				?>

       			</div>
       			<script>
       				$("form").submit(function() {
       			        $("#loadingModal").modal("show");});
       			                </script>
  <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop = "static" data-keyboard="false" style="margin-top: 200px;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
       <b>Loading...</b>
       <img src="assests/images/icons/Christmasball.gif" style="size:200px; align-content: center;">
      </div>
    </div>
  </div>
</div>
<?php require_once("includes/footer.php"); ?> 
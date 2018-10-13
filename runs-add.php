<?php

//ob_start();
session_start();


// If User is logged => redirect to tavern.php and announce it

 if ( !isset($_SESSION['user']) ) {
  $_SESSION['logged'] = 1;
  header("Location: tavern.php");
  echo "<meta http-equiv='refresh' content='0; url=tavern.php'>";
  exit;
 }

require_once 'inc.php';

html_head("Run Type Adding");

navbar('bgimg_index_logged');

HelpButton();
pageFade();


if( isset($_POST['Send']) ) {
	$conn = connect_db();

		$sql = "INSERT INTO `runs` (name,note) VALUES ('". $_POST['name'] ."', '". htmlspecialchars($_POST['note']) ."')";
		$res = mysqli_query($conn, $sql);

if ($res) {
	echo '<script>
	swal({
	 title: "Successfully added!!",
	text: "Run Type has been added without any problem!",
	type: "success",
	showConfirmButton: false,
	timer: 1990
	});
	</script>';

	echo "<meta http-equiv='refresh' content='2; url=runs-add.php'>";

   } else {
    mysqli_error($conn);
   }

	mysqli_close($conn);
}


?>

<script>

	$(function() {
		$source=$("#name");
		$output=$("#result");
		$source.keyup(function() {
			$output.text($source.val());
		});
	});

</script>



<div class="w3-text-light-grey Oswald">

<p class="w3-center" style="margin-top: -4%; font-size: 5vw;">Run Type Adding</p>

<form method="post" action="">
	<div style="margin-left: 30%; margin-top: -2%;">
	<b><label for="name" style="font-size: 1.5vw;">Run Type Name: </label></b>
	<input type="text" class="w3-input w3-animate-input w3-transparent w3-text-light-grey w3-center w3-margin-top" placeholder="Fill in the Name..." name="name" id="name" style="width: 30%; max-width: 40%; font-size: 1.25vw;" />
	
	<div style="margin-top: 5%;">
	<b><label for="note" class="w3-text-light-grey" style="font-size: 2vw;">Run Type Description: </label></b><br />
	<textarea class="w3-transparent w3-text-light-grey w3-border-0 w3-leftbar" onKeyDown="limitText(this.form.note,this.form.countdown,255);" 
onKeyUp="limitText(this.form.note,this.form.countdown,255);" name="note" id="note" style="width: 40%; resize: none; height: 10rem; padding-left: 2%; font-size: 1vw;"></textarea>
	<input class="w3-input w3-transparent w3-text-light-grey w3-center" name="countdown" value="255" style="width: 10%;" /> characters left
	</div>

	<div class='w3-center' style='margin-top: 4%; margin-left: -50%; font-size: 1.5vw;'>
			<input type='submit' value='Add' name='Send' class='w3-btn w3-transparent w3-text-lime w3-border w3-border-lime w3-padding-large' />
            <input type='reset' value='Reset' class='w3-btn w3-transparent w3-text-red w3-border w3-border-red w3-padding-large' style='margin-left: 5%;' />
		</div>

	</div>
</form>

</div>


</body>
</html>
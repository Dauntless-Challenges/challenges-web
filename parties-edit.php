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

html_head("Run Type Edit");

navbar('bgimg_index_logged');

HelpButton();
pageFade();


if( isset($_POST['Edit']) ) {
	$conn = connect_db();

		$sql = "UPDATE parties SET name='". $_POST['name'] ."', note='". htmlspecialchars($_POST['note']) ."' WHERE id_party=". $_POST['id'];
		$res = mysqli_query($conn, $sql);

if ($res) {
	echo '<script>
	swal({
	 title: "Successfully edited!!",
	text: "Party Type has been edited without any problem!",
	type: "success",
	showConfirmButton: false,
	timer: 1990
	});
	</script>';

	echo "<meta http-equiv='refresh' content='2; url=tavern.php'>";

   } else {
    mysqli_error($conn);
   }

	mysqli_close($conn);
}




if( isset($_POST['value']) ) $id = $_POST['value'];
else $id = $_POST['id'];

$conn = connect_db();
	
	$sql = "SELECT * FROM parties WHERE id_party=". $id;
	$res = mysqli_query($conn, $sql);
    $set = mysqli_fetch_array($res, MYSQLI_ASSOC);

mysqli_close($conn);

$noteValue = 255 - strlen($set['note']);


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

<p class="w3-center" style="margin-top: -2%; font-size: 5vw;">Edit of Party Type No.<?php echo $id; ?></p>

<form method="post" action="">
	
	<input type="hidden" name="id" value="<?php echo $id; ?>" />

	<div style="margin-left: 30%; margin-top: -4%;">
	<b><label for="name" style="font-size: 1.5vw;">Party Type Name: </label></b>
	<input type="text" class="w3-input w3-animate-input w3-transparent w3-text-light-grey w3-center w3-margin-top" placeholder="Fill in the Name..." value="<?php echo $set['name']; ?>" name="name" id="name" style="width: 30%; max-width: 40%; font-size: 1.25vw;" />
	
	<div style="margin-top: 5%;">
	<b><label for="note" class="w3-text-light-grey" style="font-size: 2vw;">Party Type Description: </label></b><br />
	<textarea class="w3-transparent w3-text-light-grey w3-border-0 w3-leftbar" onKeyDown="limitText(this.form.note,this.form.countdown,255);" 
onKeyUp="limitText(this.form.note,this.form.countdown,255);" name="note" id="note" style="width: 40%; resize: none; height: 10rem; padding-left: 2%; font-size: 1vw;"><?php echo htmlspecialchars($set['note']); ?></textarea>
	<input class="w3-input w3-transparent w3-text-light-grey w3-center" name="countdown" value="<?php echo $noteValue; ?>" style="width: 10%;" /> characters left
	</div>

	<div class='w3-center' style='margin-top: 2%; margin-left: -50%; font-size: 1.5vw;'>
		<input type='submit' value='Edit' name='Edit' class='w3-btn w3-transparent w3-text-green w3-border w3-border-green w3-padding-large' />
        <input type='reset' value='Reset' class='w3-btn w3-transparent w3-text-red w3-border w3-border-red w3-padding-large' style='margin-left: 5%;' />
	</div>

	</div>
</form>

</div>


</body>
</html>
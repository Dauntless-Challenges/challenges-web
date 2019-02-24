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

html_head("Behemoth Edit");

navbar('bgimg_index_logged');

HelpButton();
pageFade();


if( isset($_POST['Edit']) ) {
	$conn = connect_db();

		$sql = "UPDATE behemoths SET name='". $_POST['name'] ."', type='". $_POST['type'] ."', note='". htmlspecialchars($_POST['note']) ."' WHERE id_behemoth=". $_POST['id'];
		$res = mysqli_query($conn, $sql);

if ($res) {
	echo '<script>
	swal({
	 title: "Successfully edited!!",
	text: "Behemoth has been edited without any problem!",
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
	
	$sql = "SELECT * FROM behemoths WHERE id_behemoth=". $id;
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

<p class="web-feature-title-edit w3-center">Edit of Behemoth No.<?php echo $id; ?></p>

<form method="post" action="">
	
	<div style="margin-top: -2%;">

	<input type="hidden" name="id" value="<?php echo $id; ?>" />

	<div class="w3-half pl-25_">
	<b><label class="fs-1p5vw" for="name">Behemoth Name: </label></b>
	<input type="text" class="web-feature-form-element w3-input w3-animate-input w3-transparent w3-text-light-grey w3-center w3-margin-top" placeholder="Fill in the Name..." value="<?php echo $set['name']; ?>" name="name" id="name" required />

	<br /><br />
	<b><label class="fs-1p5vw" for="type">Behemoth Type: </label></b>
	<select class="web-feature-form-element w3-select w3-transparent w3-text-light-grey" name="type" id="type">
		<option class="w3-text-black" value="blaze" <?php if($set['type'] == "blaze") echo "selected"; ?>>Blaze</option>
		<option class="w3-text-black" value="frost" <?php if($set['type'] == "frost") echo "selected"; ?>>Frost</option>
		<option class="w3-text-black" value="lightning" <?php if($set['type'] == "lightning") echo "selected"; ?>>Lightning</option>
		<option class="w3-text-black" value="umbral" <?php if($set['type'] == "umbral") echo "selected"; ?>>Umbral</option>
		<option class="w3-text-black" value="radiant" <?php if($set['type'] == "radiant") echo "selected"; ?>>Radiant</option>
	</select>
	</div>
	
	<div class="w3-half pl-5_">
	<b><label for="note" class="w3-text-light-grey fs-1p5vw">Difficulty Description: </label></b><br />
	<textarea class="web-feature-note w3-transparent w3-text-light-grey w3-border-0 w3-leftbar" onKeyDown="limitText(this.form.note,this.form.countdown,255);" 
onKeyUp="limitText(this.form.note,this.form.countdown,255);" name="note" id="note"><?php echo htmlspecialchars($set['note']); ?></textarea>
	<input class="w3-input w3-transparent w3-text-light-grey w3-center w-10_" name="countdown" value="<?php echo $noteValue; ?>" /> characters left
	</div>


	<div class='web-feature-buttons w3-center'>
		<input type='submit' value='Edit' name='Edit' class='w3-btn w3-transparent w3-text-green w3-border w3-border-green w3-padding-large' />
        <input type='reset' value='Reset' class='w3-btn w3-transparent w3-text-red w3-border w3-border-red w3-padding-large ml-5_' />
	</div>

	</div>
</form>

</div>


</body>
</html>
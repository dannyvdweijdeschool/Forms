<?php 
	$name = "";
	$email = "";
	$nameErr = "";
	$emailErr = "";
	$form = false;
	$errors = 0;

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
	  $name = test_input($_POST["name"]);
	  $email = test_input($_POST["e_mail"]);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (empty($_POST["name"])){
		    $nameErr = "Name is nodig";
		    $errors++;
		}elseif(!preg_match("/^[a-zA-Z ]*$/",$name)){
		    $nameErr = "Je mag alleen letters en witruimte gebruiken.";
		    $errors++;
		}
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (empty($_POST["e_mail"])){
			$emailErr = "E-mail is nodig";
			$errors++;
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	        $emailErr = "ongeldig e-mail address."; 
	        $errors++;
	    }else{
		    $email = test_input($_POST["e_mail"]);
	}

	if($errors == 0){
		$form = true;
	}
}

function test_input($data) {
  $data = trim($data); //Zorgt ervoor dat onnodige space, tab, newline worden weggehaald.
  $data = stripslashes($data); //verwijderd backslashes (\).
  $data = htmlspecialchars($data); //Dit zorgt ervoor dat speciale karakters naar html veranderd waardoor je niet gehackt kan worden.
  return $data;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>form</title>
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>
<?php if($form == false){ ?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<legend>Gegevens:</legend>
			<div>
				<label>Name:</label>
				<input type="text" name="name" value="<?php echo $name;?>">
				<span class="error">* <?php echo $nameErr;?></span>
			</div>
			<div>
				<label>E-mail:</label>
				<input type="text" name="e_mail" value="<?php echo $email;?>">
				<span class="error">* <?php echo $emailErr;?></span>
			</div>
			<div id="submit">
				<input type="submit" value="Submit">
			</div>
		</fieldset>
	</form>
<?php } else{?>
	<p><?php echo $name ?></p>
	<p><?php echo $email ?></p>
<?php } ?>
</body>
</html>


<!-- Antwoord: Hij voert de alert uit. -->
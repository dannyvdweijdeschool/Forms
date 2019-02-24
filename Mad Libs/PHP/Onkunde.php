<?php 
	$Questions = ["Q1"=>"Wat zou je graag willen kunnen?","Q2"=>"Met welke persoon kun je goed opschieten?","Q3"=>"Wat is je favoriete getal?","Q4"=>"Wat heb je altijd bij je als je op vakantie gaat?","Q5"=>"Wat is je beste peroonlijke eigenschap?","Q6"=>"Wat is je slechtste persoonlijke eigenschap?","Q7"=>"Wat is het ergste dat je kan overkomen?"];
	$Awnsers = ["Q1"=>"","Q2"=>"", "Q3"=>"","Q4"=>"","Q5"=>"","Q6"=>"","Q7"=>""];
	$form = false;
	$errors = 0;
	$Err = [];
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		foreach ($Awnsers as $key => $awnserValue) {
			if (empty($_POST[$key])){
			    $Err[$key] = "Je moet iets invullen";
			    $errors++;
			}else{
				$Awnsers[$key] = test_input($_POST[$key]);
			}
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
	<title>Onkunde</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<?php include "../HTML/Header_and_menu.html"?>
	<?php if($form == false){ ?>
	<div style="background-color: white; width: 80vw; margin: 0 auto;">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php foreach ($Questions as $key => $questionValue) { ?>
	 	 <div class="form-group">
	  		<div class="col-4">
		   		<label style="position: relative; top: 25px;" for="exampleInputEmail1"><?php echo $questionValue ?></label>
		   	</div>
		   	<div class="col-3">
		   		<input type="text" class="form-control" name="<?php echo $key ?>" placeholder="Text..." value="<?php echo $Awnsers["$key"];?>">
		   		<span style="position: relative; bottom: 48px; font-size: 12px;" class="error">* <?php echo $Err[$key];?></span>
		   	</div>
	 	<?php } ?>
	  </div>
	  <button style="margin-left: 630px; margin-bottom: 10px;" type="submit" class="btn btn-primary">Submit</button>
	</form>
	<?php } else{?>
		<div id="text" style="background-color: white; width: 80vw; margin: 0 auto; padding-left: 5vw;padding-top: 4vh; padding-bottom: 4vh;">
			<h1>Onkunde</h1>
			<p>Er zijn veel mensen die niet kunnen <?php echo $Awnsers["Q1"] ?>. Neem nou <?php echo $Awnsers["Q2"] ?>. Zelfs met de hulp van een <?php echo $Awnsers["Q4"] ?> of zelfs <?php echo $Awnsers["Q3"] ?> kan meneer Ronkes niet <?php echo $Awnsers["Q1"] ?>. Dat heeft niet te maken met een gebrek aan <?php echo $Awnsers["Q5"] ?>, maar met een te veel aan <?php echo $Awnsers["Q6"] ?>. Te veel <?php echo $Awnsers["Q6"] ?> leidt tot <?php echo $Awnsers["Q7"] ?> en dat is niet goed als je wilt <?php echo $Awnsers["Q1"] ?>. Helaas voor <?php echo $Awnsers["Q2"] ?></p>
		</div>
	<?php } ?>
	<?php include "../HTML/Footer.html" ?>
	</div>
</body>
</html>

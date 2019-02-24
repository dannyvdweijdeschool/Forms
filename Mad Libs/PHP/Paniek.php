<?php
	$Questions = ["Q1"=>"Welke dier zou jij nooit als huisdier willen hebben?","Q2"=>"Wie is de belangrijkste persoon in je leven?","Q3"=>"In welk land zou je graag willen wonen?","Q4"=>"Wat doe je als je je verveelt?","Q5"=>"Met welk speelgoed speelde je als kind het meeste?","Q6"=>"Bij welke docent pijbel je het liefst?","Q7"=>"Als je € 100.000,- had, wat zou je dan kopen?","Q8"=>"Wat is je favoriete bezigheid?"];
	$Awnsers = ["Q1"=>"","Q2"=>"", "Q3"=>"","Q4"=>"","Q5"=>"","Q6"=>"","Q7"=>"","Q8"=>""];
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
				if(!preg_match("/^[a-zA-Z ]*$/",$_POST[$key])){
				    $Err[$key] = "Je mag alleen letters en witruimte gebruiken.";
				    $errors++;
				}
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
	<title>Paniek</title>
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>
	<?php include "../HTML/Header_and_menu.html" ?>
	<?php if($form == false){ ?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<h1 id="paniek">Er heerst paniek...</h1>
			<?php foreach ($Questions as $key => $questionValue) { ?>
			<div>
				<p><?php echo $questionValue ?></p>
				<input type="text" name="<?php echo $key ?>" value="<?php echo $Awnsers["$key"];?>">
				<span class="error">* <?php echo $Err[$key];?></span>
			</div>
			<?php } ?>
			<div>
				<input id="submit" type="submit" value="Versturen">
			</div>
		</fieldset>
	</form>
	<?php } else{?>
		<div id="text" style="background-color: white; width: 75vw; margin: 0 auto; padding-left: 5vw;padding-top: 4vh; padding-bottom: 4vh;">
			<h1>Er heerst paniek...</h1>
			<p>Er heerst paniek in het koninkrijk <?php echo $Awnsers["Q3"] ?>. Koning <?php echo $Awnsers["Q6"] ?> is ten einde raad en als koning <?php echo $Awnsers["Q6"] ?>  ten einde raad is, dan roept hij zijn ten-einde-raadsheer <?php echo $Awnsers["Q2"] ?>.</p></br>
			<p>"<?php echo $Awnsers["Q2"] ?>! het is een ramp! Het is een schande!"</p></br>
			<p>"Sire!, Majesteit, Uwe Luidruchtigheid, wat is er aan de hand?"</p></br>
			<p>"Mijn <?php echo $Awnsers["Q1"] ?> is verdwenen! Zo maar, zonder waarschuwing. En ik had net <?php echo $Awnsers["Q5"] ?> voor hem gekocht!"</p></br>
			<p>"Majesteit, uw <?php echo $Awnsers["Q1"] ?> komt vanzelf weer terug?"</p></br>
			<p>"Ja, da's leuk en aardig, maar hoe moet ik in de tussentijd <?php echo $Awnsers["Q8"] ?> leren?"</p></br>
			<p>"Maar Sire, daar kunt u toch uw <?php echo $Awnsers["Q7"] ?> voor gebruiken."</p></br>
			<p>"<?php echo $Awnsers["Q2"] ?>, je hebt helemaal gelijk! Wat zou ik doen als ik jou niet had."</p></br>
			<p>"<?php echo $Awnsers["Q4"] ?>, Sire."</p>
		</div>
	<?php } 
	include "../HTML/Footer.html" ?>
</body>
</html>
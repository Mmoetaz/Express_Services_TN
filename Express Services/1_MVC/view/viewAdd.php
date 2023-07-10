<!DOCTYPE html>
<html lang="en">
<head>
	<!--character encoding-->
	<meta charset="utf-8">
	<title>Express Services TN</title>
	<!--icon de la fenetre-->
	<link rel="icon" href="../../photos/Flag_of_Tunisia.png">
	<!--metadata-->
	<meta name="description" content="PaimenetTN,Radar,Admin">
	<meta name="keywords" content="PaimenetTN,Radar,Admin">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--CSS file for layout-->
	<link rel="stylesheet" href="../../css/paiment.css">
</head>
<body>

    <?php
    	require_once "header.php";
    ?>
    <header class="titre">
        <h1>Express Services TN</h1>
        <form name="void" method="post" action="../../php/void.php">
            <button class="logout" type="submit">Log out</button>
        </form>
    </header>
    <a href="viewMain.php" style="color:lightpink;">Previous page</a>
    <div style="position: -webkit-sticky;position:sticky;margin-top:-2em;top:2em;margin-left: 85%;font-size: 18px;border:solid 2px lightsalmon;">
		<h3 style="color:red;font-family: initial;margin-top:0;">Attention:</h3>
		<p style="font-family: initial;color:white;display: flex;justify-content: center;align-items:center;">
			Please!<br>note that the citizen you are going to add should have an account on the <br>EXPRESS SERVICES application "Citizen space" 
		</p>
	</div>
	<fieldset class="f2">
		<legend class="lg2">Add Penalty:</legend>
			<form name="paimentform" method="post" action="../index.php?controller=Penal">
				<table>
					<tr>
						<td><label for="id"><span class="style">Citizen ID:</span></label></td>
					</tr>
					<tr>
						<td><input type="text" name="id" id="id" placeholder="00000000" required></td>
					</tr>
					<tr>
						<td><label for="reason"><span class="style">Reason:</span></label></td>
					</tr>
					<tr>
						<td><textarea name="reason" id="reason" rows="3" cols="25"></textarea></td>
					</tr>
					<tr>
						<td><label for="prix"><span class="style">Price to pay(DT):</span></label></td>
					</tr>
					<tr>
						<td><input type="number" name="prix" id="prix" placeholder="0000" min="1" required></td>
					</tr>
				</table>
				<div>
					<center><button type="submit" name="loginbutton" class="but">ADD</button></center>
				</div>
			</form>
		</fieldset>
	<?php
    require_once "footer.php";
    ?>
</body>
</html>
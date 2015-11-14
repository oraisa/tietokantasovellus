<!DOCTYPE html>
<html lang='fi'>
<head>
	<title>Tietokantasovellus</title>
	<meta charset='utf-8'/>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <div class='w3-container padding-10'>
		<form method='get' action='/muistilista/tehtava/uusi' style='display: inline;'>
			<button class='w3-btn w3-round-xlarge w3-green w3-large' style='margin: 3mm 0mm;'>Uusi tehtävä</button>
		</form>
    <button class='w3-btn w3-round-xlarge w3-large' style='float: right; margin: 3mm 0mm;''>Kirjaudu ulos</button>
		<?php
		$i = 0;
		$rowSize = 4;
		foreach($assignments as $assignment){
			if($i % $rowSize == 0){
				echo "<div class='w3-row'>";
			}
			echo "<div class='w3-col l" . 12 / $rowSize . "'>";
				echo "<div class='w3-card-4' style='margin: 2mm;'>";
					echo "<header class='w3-container'>";
						echo "<h1>" . $assignment->name . "</h1>";
					echo "</header>";
					echo "<div class='w3-container'>";
						echo "Tärkeys: " . $assignment->importance . "<br>";
						echo "Deadline: " . $assignment->deadline;
						echo "<p>" . $assignment->description . "</p>";
						echo "Tag coming soon";
						echo "<form method='get' action='/muistilista/tehtava/" . $assignment->id . "'>";
							echo "<button class='w3-btn w3-round-xlarge w3-small' style='float: right; margin: 2mm 0mm;'>Muokkaa</button>";
						echo "</form>";
					echo "</div>";
				echo"</div>";
			echo"</div>";
			if(($i + 1) % $rowSize == 0){
				echo "</div>";
			}
			$i++;
		}
		?>
  </div>
</body>
</html>

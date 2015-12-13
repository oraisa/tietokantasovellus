<?php include 'src/views/templates/header.php'; ?>
<body>
  <div class='w3-container padding-10'>
		<form method='get' action='/muistilista/tehtava/uusi' style='display: inline;'>
			<button class='w3-btn w3-round-xlarge w3-green w3-large' style='margin: 3mm 0mm;'>Uusi tehtävä</button>
		</form>
		<a class='w3-btn w3-round-xlarge w3-large' style='margin: 3mm 0mm;' href='/muistilista/tagi/lista'>Tägit</a>
		<form method='post' action='/muistilista/logout' style='display: inline;'>
			<button class='w3-btn w3-round-xlarge w3-large' style='float: right; margin: 3mm 0mm;'>Kirjaudu ulos</button>
		</form>
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
						echo "<h1>" . htmlspecialchars($assignment->name, ENT_QUOTES, 'UTF-8') . "</h1>";
					echo "</header>";
					echo "<div class='w3-container'>";
						echo "Tärkeys: " . htmlspecialchars($assignment->importance, ENT_QUOTES, 'UTF-8') . "<br>";
						echo "Deadline: " . htmlspecialchars($assignment->deadline, ENT_QUOTES, 'UTF-8');
						echo "<p>" . htmlspecialchars($assignment->description, ENT_QUOTES, 'UTF-8') . "</p>";
						$tagName = $assignment->tag != null ? $assignment->tag->name : "Ei tägiä";
						echo "<button class='w3-btn w3-round-xlarge w3-tiny'>" .
							htmlspecialchars($tagName, ENT_QUOTES, 'UTF-8') .
							"</button>";
						echo "<form method='get' action='/muistilista/tehtava/" . $assignment->id . "'>";
							echo "<button class='w3-btn w3-round-xlarge w3-small' style='float: right; margin: 2mm 1mm;'>Muokkaa</button>";
						echo "</form>";
						echo "<form method='post' action='/muistilista/tehtava/" . $assignment->id . "/poista'>";
							echo "<button class='w3-btn w3-round-xlarge w3-small w3-red' style='float: right; margin: 2mm 1mm;'>Poista</button>";
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

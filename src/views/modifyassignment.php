<!DOCTYPE html>
<html lang='fi'>
<head>
  <meta charset='utf-8'/>
  <title>Muistilista</title>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <form class='w3-form'>
    <div class='w3-input-group'>
      <label>Nimi</label><br>
      <?php echo "<input class='w3-input' type='text' value='" . $assignment->name . "'/>"; ?>
    </div>
    <div class='w3-input-group'>
      <label>Tärkeys</label><br>
      <?php echo "<input class='w3-input' type='number' value='" . $assignment->importance . "'/> "; ?>
    </div>
    <div class='w3-input-group'>
      <label>Deadline</label><br>
      <!-- Change the space in '2000-01-01 13:00:00' to T for datetime-local-->
      <?php echo "<input type='datetime-local' value='" . substr_replace($assignment->deadline, "T", 10, 1) . "'/> "; ?>
    </div>
    <div class='w3-input-group'>
      <label>Kuvaus</label><br>
      <?php echo "<textarea class='w3-input' rows='3'>" . $assignment->description . "</textarea> "; ?>
    </div>
    <div class='w3-input-group'>
      <label>Tägi</label><br>
      <select>
				<?php
					require_once(BASE_PATH . '/src/models/tag.php');
					$tags = Tag::all();
					foreach($tags as $tag){
						echo '<option value=\'' . $tag->id . '\'>' . $tag->name . '</option>';
					}
				?>
      </select>
      <button class='w3-btn w3-round-xlarge w3-green w3-small'>Luo uusi tägi</button>
    </div>
    <input class='w3-btn w3-round-xlarge w3-green w3-large' type='submit' value='Tallenna'/>
  </form>
</body>
</html>

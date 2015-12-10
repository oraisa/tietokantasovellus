<!DOCTYPE html>
<html lang='fi'>
<head>
  <meta charset='utf-8'/>
  <title>Muistilista</title>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <?php include 'src/views/templates/errorlist.php'; ?>
  <?php echo "<form class='w3-form' method='post' action='/muistilista/tehtava/" . $assignment->id . "/paivita'>"; ?>
    <div class='w3-input-group'>
      <label>Nimi</label><br>
      <?php echo "<input class='w3-input' type='text' name='name' value='" .
        htmlspecialchars($assignment->name, ENT_QUOTES, 'UTF-8') . "'/>"; ?>
    </div>
    <div class='w3-input-group'>
      <label>Tärkeys</label><br>
      <?php echo "<input class='w3-input' type='number' name='importance' value='" .
        htmlspecialchars($assignment->importance, ENT_QUOTES, 'UTF-8') . "'/> "; ?>
    </div>
    <div class='w3-input-group'>
      <label>Deadline</label><br>
      <!-- Change the space in '2000-01-01 13:00:00' to T for datetime-local-->
      <?php echo "<input type='datetime-local' name='deadline' value='" .
        htmlspecialchars(substr_replace($assignment->deadline, "T", 10, 1), ENT_QUOTES, 'UTF-8') . "'/> "; ?>
    </div>
    <div class='w3-input-group'>
      <label>Kuvaus</label><br>
      <?php echo "<textarea class='w3-input' name='description' rows='3'>" .
        htmlspecialchars($assignment->description, ENT_QUOTES, 'UTF-8') . "</textarea> "; ?>
    </div>
    <div class='w3-input-group'>
      <label>Tägi</label><br>
      <select name='tag'>
				<?php
					require_once(BASE_PATH . '/src/models/tag.php');
					$tags = Tag::all($user);
					foreach($tags as $tag){
            $tagId = $assignment->tag != null ? $assignment->tag->id : -1;
						echo "<option value='" . $tag->id . "' " . ($tag->id == $tagId ? "selected" : "") . ">" .
              htmlspecialchars($tag->name, ENT_QUOTES, 'UTF-8') . '</option>';
					}
				?>
      </select>
      <button class='w3-btn w3-round-xlarge w3-green w3-small'>Luo uusi tägi</button>
    </div>
    <input class='w3-btn w3-round-xlarge w3-green w3-large' type='submit' value='Tallenna'/>
  </form>
</body>
</html>

<!DOCTYPE html>
<html lang='fi'>
<head>
	<title>Tietokantasovellus</title>
	<meta charset='utf-8'/>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <form class='w3-form' method='post' action='/muistilista/tehtava'>
    <div class='w3-input-group'>
      <label>Nimi</label><br>
      <input class='w3-input' type='text' name='name'/>
    </div>
    <div class='w3-input-group'>
      <label>Tärkeys</label><br>
      <input class='w3-input' type='number' name='importance'/>
    </div>
    <div class='w3-input-group'>
      <label>Deadline</label><br>
      <input type='datetime-local' name='deadline'/>
    </div>
    <div class='w3-input-group'>
      <label>Kuvaus</label><br>
      <textarea class='w3-input' rows='3' name='description'></textarea>
    </div>
    <div class='w3-input-group'>
      <label>Tägi</label><br>
      <select name='tag'>
				<?php
					require(BASE_PATH . '/src/models/tag.php');
					$tags = Tag::all();
					foreach($tags as $tag){
						echo '<option value=\'' . $tag->id . '\'>' . $tag->name . '</option>';
					}
				?>
      </select>
      <button class='w3-btn w3-round-xlarge w3-green w3-small'>Luo uusi tägi</button>
    </div>
    <input class='w3-btn w3-round-xlarge w3-green w3-large' type='submit' value='Luo tehtävä'/>
  </form>
</body>
</html>

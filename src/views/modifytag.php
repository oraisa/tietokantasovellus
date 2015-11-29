<!DOCTYPE html>
<html lang='fi'>
<head>
  <title>Muistilista</title>
  <meta charset="utf-8"/>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <?php include 'src/views/templates/errorlist.php'; ?>
  <form method='post' action='/muistilista/tag/paivita'>
    <?php echo "<input type='text' name='name' value='" .
      htmlspecialchars($tag->name, ENT_QUOTES, "UTF-8") . "'/>"; ?>
    <input class='w3-btn w3-green w3-round-xlarge w3-large' type='submit' value='Tallenna'/>
  </form>
</body>

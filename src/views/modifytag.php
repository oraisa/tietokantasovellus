<?php include 'src/views/templates/header.php'; ?>
<body>
  <?php include 'src/views/templates/errorlist.php'; ?>
  <form method='post' action='/muistilista/tag/paivita'>
    <?php echo "<input type='text' name='name' value='" .
      htmlspecialchars($tag->name, ENT_QUOTES, "UTF-8") . "'/>"; ?>
    <input class='w3-btn w3-green w3-round-xlarge w3-large' type='submit' value='Tallenna'/>
  </form>
</body>

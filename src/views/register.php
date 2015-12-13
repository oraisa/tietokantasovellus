<?php include 'src/views/templates/header.php'; ?>
<body>
  <?php include 'src/views/templates/errorlist.php'; ?>
  <form class='w3-form' method='post' action='/muistilista/register'>
    <div class='w3-input-group'>
      <label>Käyttäjänimi</label><br>
      <?php echo "<input type='text' name='username' class='w3-input' value='" . $user->username ."'/>"; ?>
    </div>
    <div class='w3-input-group'>
      <label>Salasana</label><br>
      <input type='password' name='password' class='w3-input'/>
    </div>
    <div class='w3-input-group'>
      <label>Vahvista salasana</label><br>
      <input type='password' name='passwordConfirm' class='w3-input'/>
    </div>
    <input type='submit' class='w3-btn w3-green w3-round-xlarge w3-large' value='Luo käyttäjä'/>
  </form>
</bofy>

<!DOCTYPE html>
<html lang='fi'>
<head>
  <title>Muistilista</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <div class='w3-container padding-10'>
    <a class='w3-btn w3-round-xlarge w3-large' style='margin: 3mm 0mm;' href='/muistilista/tehtava/lista'>Tehtävät</a>
    <form method='post' action='/muistilista/logout' style='display: inline;'>
      <button class='w3-btn w3-round-xlarge w3-large' style='float: right; margin: 3mm 0mm;'>Kirjaudu ulos</button>
    </form>
    <?php include 'src/views/templates/errorlist.php'; ?>
    <?php
    $i = 0;
    $rowSize = 4;
    //Add a dummy tag to create another card for creating a new tag
    $tags[] = new Tag(-1, "", -1);
    foreach($tags as $tag){
      if($i % 4 == 0){
        echo "<div class='w3-row'>";
      }
      echo "<div class='w3-col l" . 12 / $rowSize . "'>";
        echo "<div class='w3-card-4' style='margin: 2mm;'>";
          //The delete button uses the form-attribute
          echo "<form id='delete" . $tag->id . "' method='post' action='/muistilista/tagi/" . $tag->id . "/poista'>";
          echo "</form>";
          //The dummy tag has the id -1
          $action = $tag->id == -1 ? '/muistilista/tagi' : '/muistilista/tagi/' . $tag->id . '/paivita';
          echo "<form method='post' action='" . $action . "'>";
            echo "<header class='w3-container'>";
              echo "<input class='w3-xlarge' name='name' type='text' value='" . htmlspecialchars($tag->name, ENT_QUOTES, 'UTF-8') . "'/>";
            echo "</header>";
            echo "<div class='w3-container'>";
              echo "<div>";
              echo "<p>Parent tags:</p>";
              echo "<select multiple name='parents[]'>";
              foreach($tags as $option){
                if($tag->id != $option->id && $option->id != -1){
                  $isSelected = $tag->isParent($option) ? "selected" : "";
                  echo "<option value='" . $option->id . "'" . $isSelected .">" . $option->name . "</option>";
                }
              }
              echo "</select>";
              echo "</div>";
              $text = $tag->id == -1 ? 'Luo uusi tagi' : 'Tallenna';
              echo "<input type='submit' class='w3-btn w3-round-xlarge w3-small w3-green' style='float: right; margin: 2mm 1mm;' value='" . $text . "'/>";
              if($tag->id != -1){
                  echo "<button form='delete" . $tag->id . "' class='w3-btn w3-round-xlarge w3-small w3-red' style='float: right; margin: 2mm 1mm;'>Poista</button>";
              }
            echo "</div>";
          echo "</form>";
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

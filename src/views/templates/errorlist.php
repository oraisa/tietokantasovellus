<?php
if(isset($errors)){
  foreach($errors as $error){
    echo "<div class='w3-container w3-round-large w3-red' style='margin:1mm;'>" . $error . "</div>";
  }
}

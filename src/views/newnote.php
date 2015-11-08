<!DOCTYPE html>
<html lang='fi'>
<head>
	<title>Tietokantasovellus</title>
	<meta charset='utf-8'/>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
  <form class='w3-form'>
    <div class='w3-input-group'>
      <label>Nimi</label><br>
      <input class='w3-input' type='text'/>
    </div>
    <div class='w3-input-group'>
      <label>Tärkeys</label><br>
      <input class='w3-input' type='number'/>
    </div>
    <div class='w3-input-group'>
      <label>Deadline</label><br>
      <input type='datetime-local'/>
    </div>
    <div class='w3-input-group'>
      <label>Kuvaus</label><br>
      <textarea class='w3-input' rows='3'></textarea>
    </div>
    <div class='w3-input-group'>
      <label>Tägi</label><br>
      <select>
        <option value='Tira'>Tira</option>
        <option value='Koulu'>Koulu</option>
        <option value='Kotityö'>Kotityö</option>
      </select>
      <button class='w3-btn w3-round-xlarge w3-green w3-small'>Luo uusi tägi</button>
    </div>
    <input class='w3-btn w3-round-xlarge w3-green w3-large' type='submit' value='Luo tehtävä'/>
  </form>
</body>
</html>

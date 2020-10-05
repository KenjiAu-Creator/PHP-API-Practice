<?php
$GLOBALS['pageTitle'] = "Home";

// Show header
include './templates/header.php';
?>

<p>Welcome to the Band Tracker!</p>
<form action="#" method="POST">
  <label for="artist-input">
    <input type="text" id="artist-input" name="artist">
  </label>
  <input type="submit" value="Search">
</form>

<?php include './templates/footer.php';
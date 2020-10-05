<?php
$GLOBALS['pageTitle'] = "Home";

// If the user has submitted a artist query
if (isset($_POST['artist'] ) )
{ // Request the artist data from the API.
  $artistDataString = file_get_contents(
  "https://rest.bandsintown.com/artists/{$_POST['artist']}?app_id=1"
  );
}

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

<h2>Debugging</h2>
<?php if ($artistDataString) : ?>
  <?php echo $artistDataString ?>
<?php endif ?>
<?php include './templates/footer.php';
<?php
$GLOBALS['pageTitle'] = "Home";

// If the user has submitted a artist query
if (isset($_POST['artist'] ) )
{ // Request the artist data from the API.
  $artistDataString = file_get_contents(
  "https://rest.bandsintown.com/artists/{$_POST['artist']}?app_id=1"
  );

  // Check if the request returned.
  // The API should return an object.
  if (!empty($artistDataString))
  {
    $artistData = json_decode($artistDataString);
    $artistName = $artistData->name;
    $artistImageUrl = $artistData->image_url;
    $artistUpcoming = $artistData->upcoming_event_count;
  }

  // If the artist has atleast one upcoming show
  if ($artistUpcoming > 0)
  { // Call the API for the artists upcoming shows.
    // This API will return an array with objects inside.
    $artistEventsString = file_get_contents(
      "https://rest.bandsintown.com/artists/{$_POST['artist']}/events?app_id=1"
    );
    $artistEvents = json_decode($artistEventsString);
  }
}

// Show header
include './templates/header.php';
?>

<p>Welcome to the Artist Tracker!</p>
<p>This application was made using the BandsInTown API!</p>

<form action="#" method="POST">
  <label for="artist-input">
    <input type="text" id="artist-input" name="artist">
  </label>
  <input type="submit" value="Search">
</form>

<?php if( $artistData ) : ?>
  <h2><?php echo $artistName; ?></h2>
  <img id="artist-image" src="<?php echo $artistImageUrl; ?>">
  <p>Upcoming shows: <?php echo $artistUpcoming; ?>
  <?php if ($artistEvents) : ?>
    <table>
      <tr>
        <td>Date</td>
        <td>Location</td>
        <td>Venue</td>
        <td>Get your ticket!</td>
      </tr>
    <?php foreach ($artistEvents as $event) : ?>
      <tr>
        <td>
          <?php 
          // Stack overflow code snippet for coverting ISO time into a readable format.
          // link @ https://stackoverflow.com/questions/3106652/php-convert-iso-date-to-more-readable-format
          $format = "M d Y ";
          echo date_format(date_create($event->datetime), $format);
           ?>
      </td>
        <td><?php echo $event->venue->city ?>, <?php echo $event->venue->country ?></td>
        <td><?php echo $event->venue->name ?></td>
        <td><a href="<?php echo $event->offers[0]->url ?>" target="_blank">Buy now!</a></td>
      </tr>
    <?php endforeach ?>
    </table>
  <?php endif ?>

<?php else : ?>
  <p>Sorry that artist could not be found.</p>
<?php endif ?>

<h2>Debugging</h2>
<?php if ($artistDataString) : ?>
  <?php echo $artistDataString; ?>
<?php endif ?>

<?php include './templates/footer.php';
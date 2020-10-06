<?php

/**
 * Goal: Return a JSON representation of songs.
 * Parameter:
 */

 // Header to ensure that the correct API response is expected.
 header('Content-type: application/JSON; charset=UTF-8');

// Obtain the JSON object from the file.
 $songsJSONString = file_get_contents('../data/songs.json');

 if ($songsJSONString !== false )
 {  // Decode the JSON string.
    $songsJSON = json_decode($songsJSONString);
    // Respond with the encoded JSON object.
    echo json_encode($songsJSON);
 }
 else
 {  // If the data is unable to be parsed, return an error.
   echo "{\"response\":\"ERROR: Unable to retrieve albums.\"}";
 }
<?php
function getSongs($albumId = false){

    $selectedSongs = [];


    if($albumId != false){
        $selectedSongs = dbConnect()->query('SELECT * FROM songs WHERE album_id ="'.$albumId.'"')->fetchAll();
    }
    else{
      $selectedSongs = dbConnect()->query('SELECT * FROM songs')->fetchAll();
    }

    return $selectedSongs;
}

function getSong($id){
    foreach (getSongs() as $song){
      if ($id == $song['id']){
        return $song;
      }
    }

    return false;
}

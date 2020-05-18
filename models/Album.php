<?php

function getAlbums($artistId = false){

  $selectedAlbums = [];

  if($artistId != false){
      $selectedAlbums = dbConnect()->query('SELECT * FROM albums WHERE artist_id ="'.$artistId.'"')->fetchAll();
  }
  else{
    $selectedAlbums = dbConnect()->query('SELECT * FROM albums')->fetchAll();
  }

  return $selectedAlbums;
}

function getAlbum($id){
    foreach (getAlbums() as $album){
      if ($id == $album['id']){
        return $album;
      }
    }

    return false;
}

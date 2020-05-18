<?php
function getArtists($artistId = null){

    $selectedArtists = [];

    if($artistId != false){
        $selectedArtists = dbConnect()->query('SELECT * FROM artists WHERE artist_id ="'.$artistId.'"');
    }
    else{
        $selectedArtists = dbConnect()->query('SELECT * FROM artists')->fetchAll();
    }

    return $selectedArtists;

}

function getArtist($id){
    foreach (getArtists() as $artist){
      if ($id == $artist['id']){
        return $artist;
      }
    }

    return false;
}

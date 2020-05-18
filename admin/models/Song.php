<?php


function getAllSong()
{

    $db = dbConnect();

    $query = $db->query('SELECT * FROM songs');
    $songs = $query->fetchAll();

    return $songs;
}

function getSong($id)
{
    //Requete de connexion
    $db = dbConnect();

    $query = $db->prepare ('SELECT * FROM songs WHERE id=?');

    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    return $result; //Retourne de l'artiste en question
}

function addSong($informations){

    $db = dbConnect();

    $query = $db->prepare('INSERT INTO songs (title, artist_id, album_id) VALUES(?,?,?)');
    $result = $query->execute([
        $informations['title'],
        $informations['artist_id'],
        $informations['album_id'],
    ]);

    return $result;

}

function updateSong($id, $information){
    $db = dbConnect();

    $query = $db->prepare('UPDATE songs SET title = ?, artist_id = ?, album_id = ? WHERE id = ?');
    $result = $query->execute([
        $information['title'],
        $information['artist_id'],
        $information['album_id'],
        $id
    ]);
    return $result;
}

function deleteSong($id){
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM songs WHERE id=?');
    $result = $query->execute([
        $id
    ]);


    return $result;

}

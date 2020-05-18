<?php


function getAllAlbum() {
    $db = dbConnect();

    $query = $db->query('SELECT * FROM albums');
    $albums = $query->fetchAll();

    return $albums;
}


function addAlbum($informations) {
    $db = dbConnect();


    $query = $db->prepare('INSERT INTO albums (name, year, artist_id) VALUES(?,?,?)');
    $result = $query->execute([
        $informations['name'],
        $informations['year'],
        $informations['artist_id']
    ]);

    return $result;
}

function updateAlbum($id, $informations) {
    $db = dbConnect();

    $query = $db->prepare('UPDATE albums SET name = ?, year = ?, artist_id = ? WHERE id = ?');

    $result = $query->execute([
        $informations['name'],
        $informations['year'],
        $informations['artist_id'],
        $id
    ]);

    return $result;
}

function getAlbum($id){

    $db = dbConnect();

    $query = $db->prepare ('SELECT * FROM albums WHERE id=?');

    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    return $result; //Retourne de l'artiste en question
}


function deleteAlbum($id){
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM albums WHERE id=?');
    $result = $query->execute([
        $id
    ]);

    return $result;

}
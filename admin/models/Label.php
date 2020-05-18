<?php

    //Fonction qui retourne tous les labels
    function getAllLabels()
    {
        $db = dbConnect();

        $query = $db->query('SELECT * FROM labels');

        $labels = $query->fetchAll();

        return $labels;
    }


    function addLabel($informations){

        $db = dbConnect();

        $query = $db->prepare('INSERT INTO labels (name) VALUE (?)');
        $result = $query->execute([
            $informations['name']
        ]);
        return $result;
    }

function updateLabel($id, $informations)
{
    $db = dbConnect();

    $query = $db->prepare('UPDATE labels SET name = ? WHERE id = ?');

    $result = $query->execute([
        $informations['name'],
        $id
    ]);

    return $result;

}

function getLabel($id){

    $db = dbConnect();

    $query = $db->prepare ('SELECT * FROM labels WHERE id=?');

    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    return $result;

}

function deleteLabel($id)
{
    $db = dbConnect();

    $query = $db->prepare('DELETE FROM labels WHERE id=?');
    $result = $query->execute([
        $id
    ]);


    return $result;

}
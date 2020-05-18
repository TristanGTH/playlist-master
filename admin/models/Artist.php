<?php

    //Fonction qui retourne tous les artistes
    function getAllArtist()
    {

        $db = dbConnect();

        $query = $db->query('SELECT * FROM artists');
        $artists = $query->fetchAll();

        return $artists;
    }

    //Fonction qui retourne un artiste en particulier
    function getArtist($id)
    {
        //Requete de connexion
        $db = dbConnect();

        $query = $db->prepare ('SELECT * FROM artists WHERE id=?');

        $query->execute([
            $id
        ]);

        $result = $query->fetch();

        return $result; //Retourne de l'artiste en question
    }

    //Fonction qui retourne vrai ou faux si il a réussi a supprimer l'artiste ayant pour id id
    function deleteArtist($id)
    {
        $db = dbConnect();

        $query = $db->query("SELECT image FROM artists WHERE id = $id");
        $result = $query->fetch();

        $img_extention = pathinfo($result['image'], PATHINFO_EXTENSION);
        unlink('../assets/images/artists/'.$id.'.' . $img_extention);

        $query = $db->prepare('DELETE FROM artists WHERE id=?');
        $mainResult = $query->execute([
            $id
        ]);

        $query = $db->prepare('DELETE FROM songs WHERE artist_id=?');
        $result = $query->execute([
            $id
        ]);

        $query = $db->prepare('DELETE FROM albums WHERE artist_id=?');
        $result = $query->execute([
            $id
        ]);



        return $mainResult;

    }

    //Fonction qui ajoute un artiste
    function addArtist($informations)
    {

        $db = dbConnect();


        //Après traitement et upload, j'ai mon nom de fichier
        $query = $db->prepare('INSERT INTO artists (name, biography, label_id) VALUES(:name, :biography, :label_id)');
        $result = $query->execute([
            'name' => $informations['name'],
            'biography' => $informations['description'],
            'label_id' => $informations['label_id']
        ]);

        if($result) {

            $artistId = $db->lastInsertId(); //retourne l'id de la dernière ligne insérée

            $allowed_extensions = array('jpg', 'png', 'jpeg', 'gif');
            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {

                $new_file_name = $artistId . '.' . $my_file_extension;
                $destination = '../assets/images/artists/' . $new_file_name;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                //update du nom de l'image de l'enregistrement d'id
                $query = $db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");

            }
        }

        return $result;
    }

    //Fonction qui va updater les valeurs d'un artiste
    function updateArtist($id, $informations)
    {
        $db = dbConnect();

        if(!empty($_FILES['image']['name'])){

            $query = $db->query("SELECT image FROM artists WHERE id = $id");
            $result = $query->fetch();
            $img_extention = pathinfo($result['image'], PATHINFO_EXTENSION);



            unlink('../assets/images/artists/'.$id.'.' . $img_extention);

            $artistId = $id;

            $allowed_extensions = array('jpg', 'png', 'jpeg', 'gif');
            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {

                $new_file_name = $artistId . '.' . $my_file_extension;
                $destination = '../assets/images/artists/' . $new_file_name;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                //update du nom de l'image de l'enregistrement d'id
                $query = $db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");
            }

        }

        $query = $db->prepare('UPDATE artists SET name = ?, biography = ?, label_id = ? WHERE id = ?');

        $result = $query->execute([
            $informations['name'],
            $informations['description'],
            $informations['label_id'],
            $id
        ]);



        return $result;
    }
?>
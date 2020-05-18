<?php


    require 'models/Song.php';
    require 'models/Artist.php';
    require 'models/Album.php';

require ('views/partials/header.php');
require ('views/partials/menu.php');



//Si il y a une action envoyée
if(isset($_GET['action'])):

    //On affiche la view correspondante
    switch($_GET['action']):

        case 'list': //Pour affichage de la liste d'artiste
            $songs = getAllSong();
            require ('views/songViews/songList.php');
            break;

        case 'new': //Pour création d'un artiste

            $artists = getAllArtist();//on récupère tous les artists
            $albums = getAllAlbum();
            require ('views/songViews/songNew.php');
            break;

        case 'add': //Pour création d'un artiste

            //vérif des champs obligatoires (nom)
            if(empty($_POST['title'])){

                //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                $_SESSION['message'] = 'Le champ title est obligatoire !';

                //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                $_SESSION['old_inputs'] = $_POST;

                header('Location: index.php?controller=songs&action=new'); //redirection vers la liste des artistes
                exit;

            }else{
                $informations = $_POST;

                $result = addSong($informations); //appel de la fonction d'ajout d'un artiste

                $_SESSION['message'] = $result ? 'Chanson enregistré !' : 'Erreur lors de l\'enregistrement...';

                header('Location: index.php?controller=songs&action=list'); //redirection vers la liste des artistes
                exit;
            }

            break;

        case 'edit': //Pour modification d'un artiste

            $artists = getAllArtist();//on récupère tous les artists
            $albums = getAllAlbum();

            if(!empty($_POST)){

                //On vérif si il a bien rempli les champs obligatoires
                if(empty($_POST['title'])){

                    //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                    $_SESSION['message'] = 'Le champ nom est obligatoire !';

                    //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                    $_SESSION['old_inputs'] = $_POST;

                    header('Location: index.php?controller=songs&action=edit&id='. $_GET['id']); //redirection vers la liste des artistes
                    exit;

                }else{

                    $result = updateSong($_GET['id'], $_POST);

                    $_SESSION['message'] = $result ? 'Chanson mis à jour !' : 'Erreur lors de la mise à jour de la chanson.';

                    header('Location: index.php?controller=songs&action=list'); //redirection vers la liste des artistes
                    exit;
                }

            }else{

                //Si il n'a pas raté sa modification de formulaire alors on rempli avec les valeurs de l'artiste
                if(!isset($_SESSION['old_inputs']))
                    //On va chercher les infos de l'artiste pour préremplir le formulaire
                    $song = getSong($_GET['id']); //On stocke l'artiste renvoyé par la fonction getArtist


                require ('views/songViews/songNew.php'); //Modification donc il y a déjà les anciennes infos dans le formulaire
            }

            break;

        case 'delete': //Pour suppression d'un artiste
            //Appel d'une fonction qui supprimera l'artiste
            $result = deleteSong($_GET['id']);

            $_SESSION['message'] = $result ? 'La chanson a bien été supprimé !' : 'Erreur lors de la suppresion...';

            header('Location: index.php?controller=songs&action=list'); //redirection vers la liste des artistes
            exit;

            break;

        default :
            $songs = getAllSong();
            require ('views/songViews/songList.php');

    endswitch;

    //unset($_SESSION['message']); //on détruit le message une fois que la page a changé

endif;

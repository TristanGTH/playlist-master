<?php

require 'models/Label.php';

require ('views/partials/header.php');
require ('views/partials/menu.php');

//Si il y a une action envoyée
if(isset($_GET['action'])):

    //On affiche la view correspondante
    switch($_GET['action']):

        case 'list': //Pour affichage de la liste d'artiste
            $labels = getAllLabels();
            require ('views/labelViews/labelList.php');
            break;

        case 'new': //Pour création d'un album

            require ('views/labelViews/labelNew.php');
            break;

        case 'add': //Pour création d'un artiste

            //vérif des champs obligatoires (nom)
            if(empty($_POST['name'])){

                //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                $_SESSION['message'] = 'Le champ nom est obligatoire !';

                //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                $_SESSION['old_inputs'] = $_POST;

                header('Location: index.php?controller=labels&action=new'); //redirection vers la liste des artistes
                exit;

            }else{
                $informations = $_POST;

                $result = addLabel($informations); //appel de la fonction d'ajout d'un artiste

                $_SESSION['message'] = $result ? 'label enregistré !' : 'Erreur lors de l\'enregistrement...';

                header('Location: index.php?controller=labels&action=list'); //redirection vers la liste des artistes
                exit;
            }

            break;

        case 'edit': //Pour modification d'un artiste

            if(!empty($_POST)){

                //On vérif si il a bien rempli les champs obligatoires
                if(empty($_POST['name'])){

                    //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                    $_SESSION['message'] = 'Le champ nom est obligatoire !';

                    //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                    $_SESSION['old_inputs'] = $_POST;

                    header('Location: index.php?controller=labels&action=edit&id='. $_GET['id']); //redirection vers la liste des artistes
                    exit;

                }else{

                    $result = updateLabel($_GET['id'], $_POST);

                    $_SESSION['message'] = $result ? 'label mis à jour !' : 'Erreur lors de la mise à jour de l\'artiste.';

                    header('Location: index.php?controller=labels&action=list'); //redirection vers la liste des artistes
                    exit;
                }

            }else{

                //Si il n'a pas raté sa modification de formulaire alors on rempli avec les valeurs de l'artiste
                if(!isset($_SESSION['old_inputs']))
                    //On va chercher les infos de l'artiste pour préremplir le formulaire
                    $label = getLabel($_GET['id']); //On stocke l'artiste renvoyé par la fonction getArtist


                require ('views/labelViews/labelNew.php'); //Modification donc il y a déjà les anciennes infos dans le formulaire
            }

            break;

        case 'delete': //Pour suppression d'un artiste
            //Appel d'une fonction qui supprimera l'artiste
            $result = deleteLabel($_GET['id']);

            $_SESSION['message'] = $result ? 'Le label a bien été supprimé !' : 'Erreur lors de la suppresion...';

            header('Location: index.php?controller=labels&action=list'); //redirection vers la liste des artistes
            exit;

            break;

        default:
            $labels = getAllLabels();
            require ('views/labelViews/labelList.php');
    endswitch;

endif;

?>
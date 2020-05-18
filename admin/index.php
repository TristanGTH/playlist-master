<?php

session_start();

//Routeur de l'administrateur
require '../helpers.php'; //on chope le helpers qui est dans le dossier parent

if(isset($_GET['controller'])):

    switch ($_GET['controller']):

        case 'artists' :
            require 'controllers/artistController.php';
            break;

        case 'songs':
            require 'controllers/songController.php';
            break;

        case 'albums':
            require 'controllers/albumController.php';
            break;

        case 'labels':
            require 'controllers/labelController.php';
            break;

        default :
            require 'controllers/indexController.php';

    endswitch;

else:
    require 'controllers/indexController.php';
endif;

//Si il y a eu un message de généré en session, on le supprime
if(isset($_SESSION['message']))
    unset($_SESSION['message']); //on supprime le flash session

//Suppression des oldinputs du formulaire
if(isset($_SESSION['old_inputs']))
    unset ($_SESSION['old_inputs']);
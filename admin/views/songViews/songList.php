<h2> Affichage de la liste complète des Chansons : </h2>

<a href="index.php?controller=songs&action=new">Crée une chanson</a>


<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php foreach ($songs as $song): ?>

    <p> <?= $song['title'] ?>
        <a style="color: inherit;" href="index.php?controller=songs&action=edit&id=<?= $song['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'un artiste -->

        |

        <a style="color: inherit;" href="index.php?controller=songs&action=delete&id=<?= $song['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'un artiste -->
    </p>


<?php endforeach; ?>

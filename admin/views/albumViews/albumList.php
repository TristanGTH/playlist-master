<h2> Affichage de la liste complète des albums : </h2>

<a href="index.php?controller=albums&action=new">Crée un album</a>


<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php foreach ($albums as $album): ?>

    <p> <?= $album['name'] ?>
        <a style="color: inherit;" href="index.php?controller=albums&action=edit&id=<?= $album['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'un artiste -->

        |

        <a style="color: inherit;" href="index.php?controller=albums&action=delete&id=<?= $album['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'un artiste -->
    </p>


<?php endforeach; ?>
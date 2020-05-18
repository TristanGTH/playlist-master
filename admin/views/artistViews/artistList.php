<h2> Affichage de la liste complète des artistes : </h2>

<a href="index.php?controller=artists&action=new">Crée un artiste</a>


<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php foreach ($artists as $artist): ?>

    <p> <?= $artist['name'] ?>
        <a style="color: inherit;" href="index.php?controller=artists&action=edit&id=<?= $artist['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'un artiste -->

        |

        <a style="color: inherit;" href="index.php?controller=artists&action=delete&id=<?= $artist['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'un artiste -->
    </p>


<?php endforeach; ?>

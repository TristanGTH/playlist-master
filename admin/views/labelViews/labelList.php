<h2> Affichage de la liste complète des labels : </h2>

<a href="index.php?controller=labels&action=new">Crée un label</a>


<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php foreach ($labels as $label): ?>

    <p> <?= $label['name'] ?>
        <a style="color: inherit;" href="index.php?controller=labels&action=edit&id=<?= $label['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'un artiste -->

        |

        <a style="color: inherit;" href="index.php?controller=labels&action=delete&id=<?= $label['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'un artiste -->
    </p>


<?php endforeach; ?>

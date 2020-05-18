<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>


<h1> <?= $_GET['action'] == 'edit' ? 'Edition ' : 'Création'; ?> d'un Label </h1>


<form action="index.php?controller=labels&action=<?= isset($label) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">

    <!-- Nom de l'artiste -->
    <label for="name"> Nom : </label>
    <input type="text" name="name" id="name" value="<?= isset($label) ? $label['name'] : '' ?>">
    <br><br>

    <input type="submit" value="Enregistrer"/>



</form>

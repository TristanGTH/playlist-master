<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>


<h1> <?= $_GET['action'] == 'edit' ? 'Edition ' : 'Création'; ?> d'un Album </h1>

<form action="index.php?controller=albums&action=<?= isset($album) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">

    <!-- Nom de l'artiste -->
    <label for="name"> Nom : </label>
    <input type="text" name="name" id="name" value="<?= isset($album) ? $album['name'] : '' ?>">
    <br><br>

    <label for="year">Année : </label>
    <input type="number" min="1900" max="2099" step="1" value="2016" name="year" id="year"/>
    <br><br>

    <label for="artist_id"> Artist : </label>
    <select name="artist_id" id="artist_id">

        <?php foreach ($artists as $artist) : ?>
            <option value="<?= $artist['id'] ?>"><?= $artist['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>


    <input type="submit" value="Enregistrer"/>



</form>

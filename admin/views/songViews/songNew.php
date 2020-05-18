<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>


<h1> <?= $_GET['action'] == 'edit' ? 'Edition ' : 'Création'; ?> d'une Chanson </h1>

<form action="index.php?controller=songs&action=<?= isset($song) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">

    <!-- Nom de l'artiste -->
    <label for="title"> Nom : </label>
    <input type="text" name="title" id="title" value="<?= isset($song) ? $song['title'] : '' ?>">
    <br><br>

    <!-- Label de l'artiste -->
    <label for="artist_id"> Artist : </label>
    <select name="artist_id" id="artist_id">

        <?php foreach ($artists as $artist) : ?>
            <option value="<?= $artist['id'] ?>"><?= $artist['name'] ?></option>
        <?php endforeach; ?>

    </select>
    <br><br>

    <!-- faire les albums ici -->

    <label for="album_id"> Album : </label>
    <select name="album_id" id="album_id">

        <?php foreach ($albums as $album) : ?>
            <option value="<?= $album['id'] ?>"><?= $album['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>



    <input type="submit" value="Enregistrer"/>

</form>



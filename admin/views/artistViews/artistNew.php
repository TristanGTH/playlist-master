<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>


<h1> <?= $_GET['action'] == 'edit' ? 'Edition ' : 'Création'; ?> d'un artiste </h1>

<form action="index.php?controller=artists&action=<?= isset($artist) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">

    <!-- Nom de l'artiste -->
    <label for="name"> Nom : </label>
    <input type="text" name="name" id="name" value="<?= isset($artist) ? $artist['name'] : '' ?>">
    <br><br>

    <!-- Label de l'artiste -->
    <label for="label_id"> Label : </label>
    <select name="label_id" id="label_id">

        <?php foreach ($labels as $label): ?>

            <!-- On le met en selected pour seulement celui qui est égal -->
            <option value=<?= $label['id'] ?>
                <?php if(isset($artist) && $label['id'] == $artist['label_id']) : ?> selected="selected"
                <?php endif; ?>> <?= $label['name'] ?>
            </option> <!-- value est la valeur retournée en post -->

        <?php endforeach; ?>

    </select>
    <br><br>

    <!-- Biography de l'artiste -->
    <label for="description"> Description : </label>
    <textarea name="description" id="description" rows="5" cols="33" >
        <?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' //On prérempli le formulaire si il y a des old inputs ?>
        <?= isset($artist) ? $artist['biography'] : '' //test si on est en mode édition d'un artiste ou non ?>
    </textarea>
    <br><br>

    <!-- Image de l'artiste -->
    <label for="image"> Image : </label>
    <input type="file" name="image" id="image"/>
    <br><br>

    <input type="submit" value="Enregistrer"/>

</form>
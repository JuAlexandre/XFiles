<?php

require('inc/functions.php');

if (isset($_POST['content'])) {
    $file = $_GET['file'];
    $fileHandle = fopen($file, 'w');
    fwrite($fileHandle, $_POST['content']);
    fclose($fileHandle);
}

if (isset($_GET['delete'])) {
    if (is_dir($_GET['delete'])) {
        deleteDirectory($_GET['delete']);
    } else {
        unlink($_GET['delete']);
    }
    header('Location: index.php');
}
?>

<?php include('inc/head.php'); ?>

    <?php listDirectory('files'); ?>

    <?php if (isset($_GET['file']) && pathinfo($_GET['file'])['extension'] !== 'jpg'): ?>

        <h4 id="filename"><?= $_GET['file'] ?></h4>

        <?php $content = file_get_contents($_GET['file']); ?>

        <form action="" method="post">
            <textarea name="content" id="content" rows="10"><?= $content ?></textarea>
            <button type="submit">Envoyer</button>
        </form>

    <?php endif; ?>

    <?php if (isset($_GET['file']) && pathinfo($_GET['file'])['extension'] == 'jpg'): ?>

        <h4 id="filename"><?= $_GET['file'] ?></h4>

        <img src="<?= $_GET['file'] ?>" alt="<?= $_GET['file'] ?>">

    <?php endif; ?>

<?php include('inc/foot.php'); ?>

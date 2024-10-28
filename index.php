<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deefy</title>
</head>
<body>
    <a href="index.php?action=show-playlist">Show playlist</a>

    <form action="index.php?action=add-playlist" method="POST">
        <label for="nom">Nouvelle playlist :</label>
        <input type="text" id="nom" name="nom" required>
        <button type="submit">Créer</button>
    </form>

    <?php
        require_once 'src/vendor/autoload.php';
        use iutnc\deefy\dispatch\Dispatcher ;

        $d = new Dispatcher() ;
        $d->run();
    ?>

</body>
</html>

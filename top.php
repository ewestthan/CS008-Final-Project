<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$path_parts = pathinfo($phpSelf);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Artem Galleries</title>
        <meta name="author" content="Ethan West, Wyatt Taylor">
        <meta name="description" content="The website for Artem Galleries, an art gallery and seller.">
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media = "(max-width: 800px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media = "(max-width: 600px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">
        <meta name = "viewport" content = "width=device-width initial-scale = 1.0">
    </head>

    <?php
    print '<body class = "flexbox" id = "' . $path_parts['filename'] . '">';
    print '<!-- ###    Start of Body   ### -->';
    include 'connect-DB.php';
    print PHP_EOL;
    include 'header.php';
    print PHP_EOL;
    include 'nav.php';
    ?>
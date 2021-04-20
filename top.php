<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$path_parts = pathinfo($phpSelf);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sustainable VS Unsustainable Forms of Energy</title>
        <meta name="author" content="Ethan West">
        <meta name="description" content="All about sustainable forms of energy, info, comparisons, diagrams, and more.">
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
<nav>
    <a class ="<?php
    if($path_parts['filename'] == "index") {
        print 'activePage';
    }
    ?>" href = "index.php">Home</a>

    <a class ="<?php
    if($path_parts['filename'] == "gallery") {
        print 'activePage';
    }
    ?>" href = "gallery.php">Gallery</a>

    <a class ="<?php
    if($path_parts['filename'] == "form") {
        print 'activePage';
    }
    ?>" href = "form.php">Survey</a>
</nav>
<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }
    ?>" href="index.php">HOME</a>
    
    <a class="<?php
    if (PATH_PARTS['filename'] == "about"){
        print'activePage';
    }
    ?>" href=" about.php">ABOUT</a>

    <a class="<?php
    if (PATH_PARTS['filename'] == "contact"){
        print 'activePage';
    }
    ?> " href="contact.php">CONTACT</a>
    
    <a id="adminBtn" class="<?php
    if (PATH_PARTS['filename'] == "admin"){
        print 'activePage';
    }
    ?> " href="admin.php">ADMIN</a>
</nav>

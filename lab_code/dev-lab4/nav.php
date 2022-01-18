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
    
    <div id="adminBtn" class="dropdown">
    <button class="dropbtn">ADMIN
      <i class="fa fa-caret-down"></i>
    </button>
  

    <div class="dropdown-content">
      <a href="admin/addWildlife.php">Add Wildlife Records</a>
      <a href="admin/updateWildlife.php">Update Wildlife Records</a>
      <a href="admin/deleteWildlife.php">Delete Wildlife Records</a>
    </div>
    </div>
</nav>

<nav>
    <a class= "<?php
    if (PATH_PARTS['filename'] == "index") {
        print'activePage';
    }
    ?>" href= "index.php" >Home</a>

    <a class= "<?php
    if (PATH_PARTS['filename'] == "about"){
        print'activePage';
    }
    ?>" href="about.php">About Us</a>

    <a class="<?php
    if (PATH_PARTS['filename'] == "contact"){
        print'activePage';
    }
    ?> " href="contact.php">Contact</a>
    <div class="dropdown">
        <a class="dropbtn <?php
        if (PATH_PARTS['filename'] == "admin"){
            print'activePage';
        }
        ?> ">Admin</a>
        <div class="dropdown-content">
            <a href="admin/addRecords.php">Add Records</a>
            <a href="admin/updateRecords.php?">Update Records</a>
            <a href="admin/deleteRecords.php?">Delete Records</a>
            <a href="admin/report01.php">Report</a>

        </div>
    </div>
</nav>
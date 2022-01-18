<nav>
       <!--Add Records-->
   <a class= "<?php
    if (PATH_PARTS['filename'] == "addRecords") {
        print'activePage';
    }
    ?>" href= "addRecords.php" >Add Records</a>

    <!--Update Records-->
    <a class= "<?php
    if (PATH_PARTS['filename'] == "updateRecords"){
        print'activePage';
    }
    ?>" href="updateRecords.php">Update Records</a>

    <!--Delete Records-->
    <a class="<?php
    if (PATH_PARTS['filename'] == "deleteRecords"){
        print'activePage';
    }
    ?> " href="deleteRecords.php">Delete Records</a>
    
    <!-- Report-->
    <a class="<?php
    if (PATH_PARTS['filename'] == "report"){
        print'activePage';
    }
    ?> " href="report01.php">Report</a>
    

    <!--RETURN HOME-->
    <a class= "<?php
    if (PATH_PARTS['filename'] == "index") {
        print'activePage';
    }
    ?>" href= "../index.php" >X</a>

</nav>
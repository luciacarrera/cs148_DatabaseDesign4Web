<?php
include 'top.php';

//selecting for everything but avg
//
$sql = 'SELECT tblMtn.fldName, tblUser.fldFirstName, tblUser.fldLastName, tblRating.fldComment, tblRating.fldRating ';
$sql .= 'FROM tblRating JOIN tblUser ON fpkUserEmail = pmkEmail ';
$sql .= 'JOIN tblMtn ON pmkMountainId = fpkMountainId ';
$sql .= 'ORDER BY tblMtn.fldName;';

//selecting for avg
$sql2 = 'SELECT AVG(fldRating) as avg, COUNT(fldRating) as count, fldName FROM tblRating JOIN tblMtn ON pmkMountainId = tblRating.fpkMountainId GROUP BY fldName; ';
$data = array();
$noavgs = $thisDatabaseReader->select($sql, $data);

$data2 = array();
$withavgs = $thisDatabaseReader->select($sql2, $data2);

?>


<main>
    <h1> Database Reports </h1>
    <h2>1. Mountain Ratings Report by User </h2>
    <?php 
    if(is_array($noavgs)){
        foreach($noavgs as $noavg){
            //Now start to print out the contents
            
            print'<section class = "reportSection"><h3>Rater Name</h3>';
            print nl2br($noavg['fldFirstName'] .' ' . $noavg['fldLastName']) . PHP_EOL;
            print'<h3>Mountain Name</h3>';
            print nl2br($noavg['fldName']) . PHP_EOL;
            print'<h3> Rating (0-10) </h3>';
            print nl2br($noavg['fldRating']) . PHP_EOL;
            print'<h3> Comment </h3>';
            print nl2br($noavg['fldComment']) . PHP_EOL;
            print '</section>';
        }
    }
    print '<h2> 2. Rating Per Mountain </h2>';
    if(is_array($withavgs)){
        foreach($withavgs as $withavg){
            //Now start to print out the contents
            print '<section class = "reportSection"><h3>' . $withavg['fldName'] . '</h3>';
            print nl2br('Average: ')  .  PHP_EOL;
            print nl2br($withavg['avg']) . PHP_EOL;
            print nl2br('|   Total Entries: ')  .  PHP_EOL;
            print nl2br($withavg['count']) . PHP_EOL. '</section>';
        }
    }

    ?>
</main>

<?php
include 'footer.php';
?>
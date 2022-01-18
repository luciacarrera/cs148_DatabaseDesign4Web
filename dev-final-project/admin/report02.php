<?php
include 'top.php';

//selecting for everything but sums
$sql = 'SELECT tblMtn.fldCommonName,tblAdopter.fldFirstName, tblAdopter.fldLastName, ';
$sql .= 'tblAdopterMountain.fldRating FROM tblAdopter ';
$sql .= 'JOIN tblAdopterMountain ON tblAdopter.pmkAdopterEmail = tblAdopterMountain.fpkAdopterEmail ';
$sql .= 'JOIN tblMtn ON tblAdopterMountain.fpkMountainId = tblMtn.pmkMountainId ';
$sql .= 'ORDER BY tblMtn.fldCommonName;';

//selecting for sums
$sql2 = 'SELECT SUM(tblAdopterMountain.fldRating) as sum, tblAdopter.fldLastName, tblAdopter.fldFirstName  FROM tblAdopter ';
$sql2 .= 'JOIN tblAdopterMountain ON tblAdopter.pmkAdopterEmail = tblAdopterMountain.fpkAdopterEmail ';
$sql2 .= 'JOIN tblMtn ON tblAdopterMountain.fpkMountainId = tblMtn.pmkMountainId ';
$sql2 .= 'GROUP BY tblAdopter.fldLastName, tblAdopter.fldFirstName;';

$data = array();
$noSums = $thisDatabaseReader->select($sql, $data);

$data2 = array();
$withSums = $thisDatabaseReader->select($sql2, $data2);

?>


<main>
    <h2> Mountain Adoption Report </h2>
    <?php 
    if(is_array($noSums)){
        foreach($noSums as $noSum){
            //Now start to print out the contents
            
            print'<h3>Adopter First Name</h3>';
            print nl2br($noSum['fldFirstName']) . PHP_EOL;
            print'<h3>Adopter Last Name</h3>';
            print nl2br($noSum['fldLastName']) . PHP_EOL;
            print'<h3>Common Name</h3>';
            print nl2br($noSum['fldCommonName']) . PHP_EOL;
            print'<h3> Donation Amount ($) </h3>';
            print nl2br($noSum['fldRating']) . PHP_EOL;
            print '<p> ------------------------------  </p>';
        }
        foreach($withSums as $withSum){
            print'<h3>Total Donations ($) by Adopter </h3>';

            //Now start to print out the contents
            print nl2br($withSum['fldFirstName'] . ' ' . $withSum['fldLastName']. ':')  .  PHP_EOL;
            print nl2br($withSum['sum']) . PHP_EOL;
            print '';
    }
    print '<p> ------------------------------  </p>';

}

    ?>
</main>

<?php
include 'footer.php';
?>
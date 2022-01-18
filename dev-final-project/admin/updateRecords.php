<?php

include 'top.php'; 
$sql = 'SELECT pmkMountainId, fldName ';
$sql .= 'FROM tblMtn ';
$sql .= 'ORDER BY fldName ';

$data = array();
# print($thisDatabaseReader->displayQuery($sql));
$mountains = $thisDatabaseReader->select($sql, $data);

?>

<main> 
    <h2>Update Mountain Records</h2>
    <table>
    <?php
        // $sql = 'UPDATE tblMtn SET fldName = ? WHERE pmkMountainId = ? ';
        //$data = array('Bob the Beaver', 1);
        // print $thisDatabaseReader-> displayQuery($sql, $data);

        //$saved = $thisDatabaseWriter->update($sql, $data);

        // will print out image + name (+alt) of mountains in database
        // print_r($mountains);
    
        if(is_array($mountains)){
            foreach($mountains as $mountain){
                print '<tr>';
                print '<td>'. $mountain['fldName'] .'</td>';
                print '<td><a href = "addRecords.php?mid='. $mountain['pmkMountainId'] . '" >';
                print 'Update</a></td>';
                print '</tr>';
            }
        }
    ?>
    </table>
</main> 

<?php 
include '../footer.php'; 
?>
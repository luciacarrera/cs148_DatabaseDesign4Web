<?php

include 'top.php'; 
 
?>

<main> 
    <h2>Delete Mountain Records</h2>
    
    <?php
    

    // $data = array(1);
    //print $thisDatabaseReader-> displayQuery($sql, $data);
    //print $thisDatabaseReader-> displayQuery($sql, $data);
    if(isset($_POST['confirmBtn'])){
        $mountainId = (int) getData('hidMountainId');
        $sql = 'DELETE FROM tblMtn WHERE pmkMountainId = ?';
        $data = array($mountainId);
        $saved = $thisDatabaseWriter->delete($sql, $data);
        print($thisDatabaseWriter->displayQuery($sql, $data));

    }
    if(isset($_GET['mid'])){

        $mountainId = (isset($_GET['mid'])) ? (int) htmlspecialchars($_GET['mid']) : 0;

        // CONFIRM BUTTON
        print '<section><h5>Do you want to delete this mountain? </h5>';
        print '<form method = "POST" action ="deleteRecords.php">';
        print '<input type="hidden" id="hidWildlifeId" name="hidMountainId" value="'. $mountainId. '"> ';
        print '<button type="submit" name = "confirmBtn">Confirm</button>';
        print '</form></section>';
        
        // PRINT ANIAML
        $sql5 = 'SELECT pmkMountainId, fldName, fldState, fldTown, fldDescription, ';
        $sql5 .= 'fldRange, fldVertical, fldElevation, fldSnowfall, fldPassPrice, fldLink, fldImage ';
        $sql5 .= 'FROM tblMtn ';
        $sql5 .= 'WHERE pmkMountainId = ? ';
        $sql5 .= 'ORDER BY fldName';

        $data5 = array($mountainId);
        $mountains = $thisDatabaseReader->select($sql5, $data5);

        # checks if there is an id or if empty
        if(is_array($mountains)){
            foreach($mountains as $mountain){

                print'<figure class = "mountain">';
                print'<img alt="' . $mountain['fldName'] . '" src="../images/uploads/'.  $mountain['fldImage'] . '">';
                print '<figcaption> A look at the mountain. </figcaption>';
                print "</figure>";

                //Now start to print out the contents
                print'<h3>State</h3>';
                print nl2br($mountain['fldState']) . PHP_EOL;
                print'<h3>Town</h3>';
                print nl2br($mountain['fldTown']) . PHP_EOL;
                print'<h3>Description</h3>';
                print nl2br($mountain['fldDescription']) . PHP_EOL;
                print"<h3>Mountain Range</h3>";
                print nl2br($mountain['fldRange'] ) . PHP_EOL;
                print"<h3>Vertical (feet)</h3>";
                print nl2br($mountain['fldVertical'] ) . PHP_EOL;
                print"<h3>Elevation (feet)</h3>";
                print nl2br( $mountain['fldElevation'] ) . PHP_EOL;
                print"<h3>Average Annual Snowfall (in)</h3>";
                print nl2br($mountain['fldSnowfall'] ) . PHP_EOL;
                print"<h3>Pass Price ($) </h3>";
                print nl2br($mountain['fldPassPrice'] ) . PHP_EOL;
                print'<h3>Link to Mountain Website</h3>';
                print'<a href= "'. $mountain['fldLink'] . '" > ' . $mountain['fldLink'] . '</a>';
            
            }
        }
        else{
            # this is not printing, why?
            print'<p>Hi! Sorry to inform you that no cute mountains live on this page, please keep on searching!</p>';
        }
        
            

    }else{
        $sql = 'SELECT pmkMountainId, fldName ';
        $sql .= 'FROM tblMtn ';
        $sql .= 'ORDER BY fldName ';

        $data = array();
        # print($thisDatabaseReader->displayQuery($sql));
        $animals = $thisDatabaseReader->select($sql, $data); 

        print '<table>';
        // $saved = $thisDatabaseWriter->delete($sql, $data);
        if(is_array($animals)){
            foreach($animals as $animal){
                print '<tr>';
                print '<td>'. $animal['fldName'] .'</td>';
                print '<td><a href = "deleteRecords.php?mid='. $animal['pmkMountainId'] . '" >';
                print 'Delete</a></td>';
                print '</tr>';
            }
        }
        print '</table>';

    }

    ?>
    
</main> 

<?php 
include '../footer.php'; 
?>
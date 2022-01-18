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
        print("hellos");
        $mountainId = (int) getData('hidMountainId');
        print($mountainId);
        $sql = 'DELETE FROM tblMtn WHERE pmkMountainId = ?';
        print($sql);
        $data = array($mountainId);
        $saved = $thisDatabaseWriter->delete($sql, $data);
        print($thisDatabaseWriter->displayQuery($sql, $data));

    }
    if(isset($_GET['mid'])){

        $mountainId = (isset($_GET['mid'])) ? (int) htmlspecialchars($_GET['mid']) : 0;
        print($mountainId);
        // CONFIRM BUTTON
        print '<section><h5>Do you want to delete this mountain? </h5>';
        print '<form method = "POST" action ="deleteRecords.php">';
        print '<input type="hidden" id="hidMountainId" name="hidMountainId" value="'. $mountainId. '"> ';
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

                print '<h2>'. $mountain['fldName'] .'</h2>';
                print '<img alt="( ' . $mountain['fldName'] . ' image)" src="../images/uploads/' . $mountain['fldImage'] . '">';
                print  $mountain['fldDescription'];

                print '<section class = "property">';
                print '<h3>State</h3>';
                print  $mountain['fldState'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Town</h3>';
                print  $mountain['fldTown'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Description</h3>';
                print  $mountain['fldDescription'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Range</h3>';
                print  $mountain['fldRange'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Vertical</h3>';
                print  $mountain['fldVertical'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Elevation</h3>';
                print  $mountain['fldElevation'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Snowfall</h3>';
                print  $mountain['fldSnowfall'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>PassPrice</h3>';
                print  $mountain['fldPassPrice'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Link</h3>';
                print  $mountain['fldLink'];
                print '</section>';

                print '<section class = "property">';
                print '<h3>Image</h3>';
                print  $mountain['fldImage'];
                print '</section>';
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
        $mtns = $thisDatabaseReader->select($sql, $data); 

        print '<table>';
        // $saved = $thisDatabaseWriter->delete($sql, $data);
        if(is_array($mtns)){
            foreach($mtns as $mtn){
                print '<tr>';
                print '<td>'. $mtn['fldName'] .'</td>';
                print '<td><a href = "deleteRecords.php?mid='. $mtn['pmkMountainId'] . '" >';
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
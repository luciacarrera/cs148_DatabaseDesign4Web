<?php
include 'top.php';
$mountainId = (isset($_GET['mid'])) ? (int) htmlspecialchars($_GET['mid']) : 0;
//print '<p>Mountain Id = ' . $mountainId;

$sql = 'SELECT pmkMountainId, fldName, fldState, fldTown, fldDescription, fldRange, fldVertical, fldElevation, fldSnowfall, fldPassPrice, fldLink, fldImage ';
$sql .= 'FROM tblMtn ';
$sql .= 'WHERE pmkMountainId= ? ';

$data = array($mountainId);
$mountains = $thisDatabaseReader->select($sql, $data);

?>

<main>
    
<?php
print'<h2>' . $mountains[0]['fldName'] . '</h2>';

if(is_array($mountains)){
    foreach($mountains as $mountain){
        print'<a class = "button fixed" href="rateMountain.php?mid=' . $mountain['pmkMountainId'] . '"> CLICK HERE to rate this mountain: ' . $mountains[0]['fldName'] . '!</a>';
        print'<figure class = "mountain">';
        print'<img alt="' . $mountain['fldName'] . '" src="images/uploads/'.  $mountain['fldImage'] . '">';
        print '<figcaption> A look at the mountain. </figcaption>';
        print "</figure>";

        //Now start to print out the contents
        print'<section><h3>This mountain is located in ' .$mountain['fldTown'] . ', '.$mountain['fldState']. '</h3></section>';
        print'<section><h3>Description</h3>';
        print nl2br($mountain['fldDescription']) . PHP_EOL.'</section>';
        print"<section><h3>Mountain Range</h3>";
        print nl2br($mountain['fldRange'] ) . PHP_EOL.'</section>';
        print"<section><h3>Vertical (feet)</h3>";
        print nl2br($mountain['fldVertical'] ) . PHP_EOL.'</section>';
        print"<section><h3>Elevation (feet)</h3>";
        print nl2br( $mountain['fldElevation'] ) . PHP_EOL.'</section>';
        print"<section><h3>Average Annual Snowfall (in)</h3>";
        print nl2br($mountain['fldSnowfall'] ) . PHP_EOL.'</section>';
        print"<section><h3>Pass Price ($) </h3>";
        print nl2br($mountain['fldPassPrice'] ) . PHP_EOL.'</section>';
        print'<section><h3>Link to Mountain Website</h3>';
        print'<a href= "https://'. $mountain['fldLink'] . '" > ' . $mountain['fldLink'] . '</a></section>';
        
        
    }
}
print'</main>';


include 'footer.php';

?>
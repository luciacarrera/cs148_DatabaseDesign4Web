<?php
include 'top.php';

//Alpha validation- for first and last names
function verifyAlphaNum($testString) {
    return (preg_match("/^[A-Za-z]+$/", $testString));
}
//initialize mid variables
$mountainId = (isset($_GET['mid'])) ? (int) htmlspecialchars($_GET['mid']) : 0;
if(DEBUG) print "<p>Mountain Id = " . $mountainId . "</p>";
if($mountainId != 0){
    $sql = 'SELECT pmkMountainId, fldName, fldState, fldTown, fldDescription, ';
    $sql .= 'fldRange, fldVertical, fldElevation, fldSnowfall, fldPassPrice, fldLink, fldImage ';
    $sql .= 'FROM tblMtn ';
    $sql .= 'WHERE pmkMountainId = ? ';

    print($sql);

    $data =array($mountainId);
    # print_r($data);
    # print($thisDatabaseReader->displayQuery($sql));
    $mountains = $thisDatabaseReader->select($sql, $data)[0];

    $name = $mountains['fldName'];
    $state = $mountains['fldState'];
    $town = $mountains['fldTown'];
    $description = $mountains['fldDescription'];
    $range = $mountains['fldRange'];
    $vertical = $mountains['fldVertical'];
    $elevation = $mountains['fldElevation'];
    $snowfall = $mountains['fldSnowfall'];
    $passPrice = $mountains['fldPassPrice'];
    $link = $mountains['fldLink'];
    $image_dir = $mountains['fldImage'];

} else{
//STEP A: initializing of variables
    // set mountain default variables
    $name = "";
    $state = "";
    $town = "";
    $description = "";
    $range = "";
    $vertical = "";
    $elevation = "";
    $snowfall = "";
    $passPrice = "";
    $link = "";
    $image_dir = "../images/uploads/";

}

$saveData = true;

?>

<main>
    <?php 
    
    print '<h2>Insert a New Mountain to Rate</h2> '; 
    print '<h4>Please Enter All Fields.</h4> ';


    if(isset($_POST['BtnSubmit'])){
        if(DEBUG){
            print '<p>POST array:</p><pre>';
            print_r($_POST);
            print '</pre>';
        }
        
        //sanitize data 
        $name = filter_var($_POST['fldName'], FILTER_SANITIZE_STRING);
        $state = filter_var($_POST['fldState'], FILTER_SANITIZE_STRING);
        $town = filter_var($_POST['fldTown'], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['fldDescription'], FILTER_SANITIZE_STRING);
        $range = filter_var($_POST['fldRange'], FILTER_SANITIZE_STRING);
        $vertical = (int) getData('fldVertical');
        $elevation = (int) getData('fldElevation');
        $snowfall = (int) getData('fldSnowfall');
        $elevation = (int) getData('fldElevation');
        $passPrice = (int) getData('fldPassPrice');
        $link = (string) getData('fldLink');


        $target_file = $target_dir . basename($_FILES['fldImage']['tmp_name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $savedImage = '';
        

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['fldImage']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            die('Invalid file format.');
        }

        $imageFileName = sprintf('%s.%s',sha1_file($_FILES['fldImage']['tmp_name']),$ext);
        
        $savedImage = sprintf('../images/uploads/%s',$imageFileName);

        print($savedImage);

       //Validate  data 
        if ($name != ""){
            if ($name == "") {
                print'<p class="mistake"> Please enter "Name of the Mountain".</p>';
                $saveData = false;
            } elseif(is_numeric($name)== true) {
                print '<p class="mistake"> Make sure the Mountain name is non-numeric.</p>';
                $saveData = false;
            }
         }

         if ($state != ""){
            if ($state == "") {
                print'<p class="mistake"> Please enter state the mountain is found in.</p>';
                $saveData = false;
            } elseif(is_numeric($state)== true) {
                print '<p class="mistake"> Make the state non-numeric.</p>';
                $saveData = false;
            }
         }

         if ($town != ""){
            if ($town == "") {
                print'<p class="mistake"> Please enter state the mountain is found in.</p>';
                $saveData = false;
            } elseif(is_numeric($town)== true) {
                print '<p class="mistake"> Make the state non-numeric.</p>';
                $saveData = false;
            }
         }

         if ($description != ""){
            if ($description == "") {
                print'<p class="mistake"> Please enter "Description".</p>';
                $saveData = false;
            }
         }
        
        if ($range != ""){
           if ($range == "") {
               print'<p class="mistake"> Please enter the mountain range.</p>';
               $saveData = false;
           } elseif(is_numeric($range)== true) {
               print '<p class="mistake"> Make "Range" non-numeric.</p>';
               $saveData = false;
           }
        }

        if ($vertical < 0 or $vertical > 20000){
            print'<p class="mistake"> Please enter a valid skiable vertical.</p>';
               $saveData = false;
        }

        if ($elevation < 0 or $elevation > 25000){
            print'<p class="mistake"> Please enter a valid elevation.</p>';
               $saveData = false;
        }

        if ($passPrice < 0 or $passPrice > 500){
            print'<p class="mistake"> Please enter a valid day pass price.</p>';
               $saveData = false;
        }

        if ($snowfall < 0 or $snowfall > 1000){
            print'<p class="mistake"> Please enter a valid yearly snowfall in inches.</p>';
               $saveData = false;
        }

        if(empty($link)){
            print '<p class="mistake">You must not leave the Link field empty.</p>';
        
            $saveData = false;
        }

         //validating- files may have different symbols. Adapted from: 
        
        
        //print '<p> File Name ' . $target_file;
            //Attempting to validate input file has posed a problem
        $check = getimagesize($_FILES["fldImage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $saveData = true;
            if (!move_uploaded_file(
                $_FILES['fldImage']['tmp_name'],
                $savedImage
            )) {
                die('Failed to move uploaded file.');
            }
        } else {
            echo "File is not an image.";
            $saveData = true;
        }
                 
        if($saveData){
            $sql = '';
            if($mountainId == 0){
                $sql = 'INSERT INTO tblMtn SET ';
                $sql .= 'fldName = ?, ';
                $sql .= 'fldState = ?, ';
                $sql .= 'fldTown = ?, ';
                $sql .= 'fldDescription = ?, ';
                $sql .= 'fldRange = ?, ';
                $sql .= 'fldVertical = ?, ';
                $sql .= 'fldElevation = ?, ';
                $sql .= 'fldSnowfall = ?, ';
                $sql .= 'fldPassPrice = ?, ';
                $sql .= 'fldLink = ?, ';
                $sql .= 'fldImage = ?';
            }else{
                $sql = 'UPDATE tblMtn SET ';
                $sql .= 'fldName = ?, ';
                $sql .= 'fldState = ?, ';
                $sql .= 'fldTown = ?, ';
                $sql .= 'fldDescription = ?, ';
                $sql .= 'fldRange = ?, ';
                $sql .= 'fldVertical = ?, ';
                $sql .= 'fldElevation = ?, ';
                $sql .= 'fldSnowfall = ?, ';
                $sql .= 'fldPassPrice = ?, ';
                $sql .= 'fldLink = ?, ';
                $sql .= 'fldImage = ?';
                $sql .= 'WHERE pmkMountainId = ?';
            }

            $data = array();

            $data[] = $name;
            $data[] = $state;
            $data[] = $town;
            $data[] = $description;
            $data[] = $range;
            $data[] = $vertical;
            $data[] = $elevation;
            $data[] = $snowfall;
            $data[] = $passPrice;
            $data[] = $link;
            $data[] = $imageFileName;
            
            if($mountainId != 0){
                $data[] = $mountainId;
            }

            if(DEBUG){
                print $thisDatabaseWriter->displayQuery($sql, $data);
            }
            $thisDatabaseWriter->insert($sql, $data);
            if($thisDatabaseWriter == true){
                print '<p> Your new entry has been saved!</p>';
            }
            else{
                print '<p> Something went wrong- Entry NOT saved </p>';
            }
        }
    }
    ?>

    <form id="frmUpdate" action = "<?= PHP_SELF. $mountainId == 0 ? '' : '?mid='.$mountainId ?>" method="post" enctype="multipart/form-data">
        <fieldset class="textbox">
                <p>
                    <label for="fldName">Mountain Name: </label>
                    <input type="text" id="fldName" name="fldName" 
                    value="<?php print $name; ?>" tabindex="200" required>
                </p>
        </fieldset>
        
        <fieldset>
            <p>
                <label for="fldState">Mountain's State:</label>
                <input type="text" 
                        name="fldState" 
                        id="fldState"
                        value="<?php print $state; ?>"
                        required
                        >
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="fldTown">Mountain's Town:</label>
                <input type="text" 
                        name="fldTown" 
                        id="fldTown"
                        value="<?php print $town; ?>"
                        required
                        >
            </p>
        </fieldset>
        
        <fieldset>
            <p>
                <label for="fldDescription">Mountain Description:</label>
                <input type="text" 
                        name="fldDescription" 
                        id="fldDescription"
                        value="<?php print $description; ?>"
                        required
                        >
            </p>
        </fieldset>
        
        <fieldset>
            <p>
                <label for="fldRange">Mountain Range:</label>
                <input type="text" 
                        name="fldRange" 
                        id="fldRange"
                        value="<?php print $range; ?>"
                        required
                        >
            </p>
        </fieldset>
        
        <fieldset>
            <p>
                <label for="fldVertical">Skiable Vertical:</label>
                <input type="text" 
                        name="fldVertical" 
                        id="fldVertical"
                        value="<?php print $vertical; ?>"
                        required
                        >
            </p>
        </fieldset>
        
        <fieldset>
            <p>
                <label for="fldElevation">Mountain Peak Elevation:</label>
                <input type="text" 
                        name="fldElevation" 
                        id="fldElevation"
                        value="<?php print $elevation; ?>"
                        required
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="fldSnowfall">Snowfall:</label>
                <input type="text" 
                        name="fldSnowfall" 
                        id="fldSnowfall"
                        value="<?php print $snowfall; ?>"
                        required
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="fldPassPrice">Price of a Day Pass:</label>
                <input type="text" 
                        name="fldPassPrice" 
                        id="fldPassPrice"
                        value="<?php print $passPrice; ?>"
                        required
                        >
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="fldLink">Mountain Website link:</label>
                <input type="text" 
                        name="fldLink" 
                        id="fldLink"
                        value="<?php print $link; ?>"
                        required
                        >
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="fldImage">Mountain Image:</label>
                <input type="file" id="fldImage" name="fldImage"
                 value="<?php print $fldImage; ?>" accept=".jpg, .jpeg, .png">
            </p>
        </fieldset>

        <fieldset>
            <input type="submit" value="Submit"
            tabindex="999" name="BtnSubmit">
        </fieldset>
    
    </form>
</main>
<?php
include 'top.php';

//sanitize using $_GET
function getData($field){
    if(!isset($_POST[$field])){
        $data = "";
    }
    else{
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}
//initialize mid variables
$mountainId = (isset($_GET['mid'])) ? (int) htmlspecialchars($_GET['mid']) : 0;
if(DEBUG) print "<p>Critter Id = " . $mountainId . "</p>";

//Alpha validation- for first and last names
function verifyAlphaNum($testString) {
    return (preg_match("/^[A-Za-z]+$/", $testString));
}

//Set default variables
$fldType = "";

?>

<main>
    <?php 
    
    print '<h2>Adopt a(n)  ' . $mountainName . '</h2> '; 
    print '<h3>Update Fields as Needed</h2> ';
    if(isset($_POST['btnInsert'])){
        if(DEBUG){
            print '<p>POST array:</p><pre>';
            print_r($_POST);
            print '</pre>';
        }
        
        //sanitize data 

       
        // how to validate?

        // Validate critter ID
        if (!is_numeric($mountainId)){
            print '<p class = "mistake"> Invalid input </p>';
            $saveData = false;
        }
        $fldType = filter_var($_POST['fldType'], FILTER_SANITIZE_STRING);
        /*
       $fldCommonName = filter_var($_POST['fldCommonName'], FILTER_SANITIZE_STRING);
       $fldDescription = filter_var($_POST['fldDescription'], FILTER_SANITIZE_STRING);
       $fldHabitat = filter_var($_POST['fldHabitat'], FILTER_SANITIZE_STRING);
       $fldReproduction = filter_var($_POST['fldReproduction'], FILTER_SANITIZE_STRING);
       $fldDiet = filter_var($_POST['fldDiet'], FILTER_SANITIZE_STRING);
       $fldManagement = filter_var($_POST['fldManagement'], FILTER_SANITIZE_STRING);
       $fldStatus = filter_var($_POST['fldStatus'], FILTER_SANITIZE_STRING);
       $fldMainImage = filter_var($_POST['fldMainImage'], FILTER_SANITIZE_STRING);
       //delete eventually-just to check if it gets passed through
       $mountainId = (int) getData('mid');

        */
       //Validate  data 
        if ($fldType != ""){
           if ($fldType == "") {
               print'<p class="mistake"> Please enter your first name.</p>';
               $saveData = false;
           } elseif (!verifyAlphaNum($fldType)) {
               print '<p class="mistake"> Your first name appears to have some extra characters.</p>';
               $saveData = false;
           } elseif(is_numeric($fldType)== true) {
               print '<p class="mistake"> Make your entry non-numeric.</p>';
               $saveData = false;
           }
        }
        // Insert donation amount and email into tblAdopterMountain
        if($saveData){
           
            /*



            $sql = 'INSERT INTO tblAdopterMountain SET ';
            $sql .= 'fldRating = ?, ';
            $sql .= 'fpkAdopterEmail = ?, ';
            $sql .= 'fpkMountainId = ?';

            $data = array();
            $data[] = $donationAmount;
            $data[] = $adopterEmail;
            $data[] = $mountainId;
            
            if(DEBUG){
                print $thisDatabaseReader->displayQuery($sql, $data);
            }
            $thisDatabaseWriter->insert($sql, $data);
            if($thisDatabaseWriter == true){
                print '<p> Working on that...</p>';
            }
            else{
                print '<p> Something went wrong- Entry NOT saved </p>';
            }
            
            /*
            //Insert email, first name, and other factors into table adopters
            $sql2 = 'INSERT INTO tblAdopter SET ';
            $sql2 .= 'pmkAdopterEmail = ?, ';
            $sql2 .= 'fldFirstName = ?, ';
            $sql2 .= 'fldLastName = ?, ';
            $sql2 .= 'fldAgreeToTerms = ?, ';
            $sql2 .= 'fldRecieveCommunication = ?';

            $data2 = array();
            $data2[] = $adopterEmail;
            $data2[] = $firstName;
            $data2[] = $lastName;
            $data2[] = $agreeTerms;
            $data2[] = $sendEmail;
            
            if(DEBUG){
                print $thisDatabaseReader->displayQuery($sql2, $data2);
            }
            //is this the right idea?
            $thisDatabaseWriter->insert($sql2, $data2);
            if($thisDatabaseWriter == true){
                print '<p> Congratulations, your adoption has been recieved! </p>';
            }
            else{
                print '<p> Something went wrong- Entry NOT saved </p>';
            }
            
*/
        }
        
    }
    
    
    ?>

    <form action="<?php print PHP_SELF; ?>" id="frmUpdate" method="post">
        <fieldset class="textbox">
                <p>
                    <label for="txtType">Type: </label>
                    <input type="text" id="txtType" name="txtType" 
                    value="<?php print $fldType; ?>" tabindex="200">
                </p>
        </fieldset>

        <!--
        
        <fieldset>
            <p>
                <label for="txtCommonName">Common Name:</label>
                <input type="text" 
                        name="txtCommonName" 
                        id="txtCommonName"
                        value="<?php print $fldCommonName; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtDescription">Description:</label>
                <input type="text" 
                        name="txtDescription" 
                        id="txtDescription"
                        value="<?php print $fldDescription; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtHabitat">Habitat:</label>
                <input type="text" 
                        name="txtHabitat" 
                        id="txtHabitat"
                        value="<?php print $fldHabitat; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtReproduction">Reproduction:</label>
                <input type="text" 
                        name="txtReproduction" 
                        id="txtReproduction"
                        value="<?php print $fldReproduction; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtDiet">Diet:</label>
                <input type="text" 
                        name="txtDiet" 
                        id="txtDiet"
                        value="<?php print $fldDiet; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtManagement">Management:</label>
                <input type="text" 
                        name="txtManagement" 
                        id="txtManagement"
                        value="<?php print $fldManagement; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtStatus">Status:</label>
                <input type="text" 
                        name="txtStatus" 
                        id="txtStatus"
                        value="<?php print $fldStatus; ?>"
                        >
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtMainImage">Main Image:</label>
                <input type="text" 
                        name="txtMainImage" 
                        id="txtMainImage"
                        value="<?php print $fldMainImage; ?>"
                        >
            </p>
        </fieldset>

        <fieldset>
        <input type = "hidden" id = "mid" name = "mid" value = "<?php print $mountainId ;?>" >
        </fieldset>
        -->
        <fieldset>
            <p><input type="submit" value="Insert"
            tabindex="999" name="btnInsert"></p>
        </fieldset>
    


    </form>
</main>
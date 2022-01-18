 
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
if(DEBUG) print "<p>Mountain Id = " . $mountainId . "</p>";


//SQL Statement
$sql = 'SELECT pmkMountainId, fldName, fldImage ';
$sql .= 'FROM tblMtn ';
$sql .= 'WHERE pmkMountainId = ?';

$data = array($mountainId);
$mountainToRate = $thisDatabaseReader->select($sql, $data);

//if data doesn't exist-> pull out common name, default value, true to save data
$mountainName = $mountainToRate[0]['fldName'];

 //default variables here
$rating = 5;
$comment = "";
$skier = "1";
$userEmail = 'example@uvm.edu';
$firstName = "";
$lastName = "";
$homeState = "";
$homeCountry = "";
$agreeTerms = '1';
$sendEmail = '1';


$saveData = true;


//Alpha validation- for first and last names
function verifyAlphaNum($testString) {
    return (preg_match("/^[A-Za-z]+$/", $testString));
}
?>

<main>
    <?php 
    
    print '<h2>Rate this mountain:  ' . $mountainName . '</h2> '; 

    if(isset($_POST['btnSubmit'])){
        if(DEBUG){
            print '<p>POST array:</p><pre>';
            print_r($_POST);
            print '</pre>';
        }
        
        //sanitize data 
        $rating = (int) getData('rngRating');
        $comment = filter_var($_POST['txtComment'], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST['txtUserEmail'], FILTER_SANITIZE_EMAIL);
        $firstName = filter_var($_POST['txtFirstName'], FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST['txtLastName'], FILTER_SANITIZE_STRING);
        $homeState = filter_var($_POST['txtHomeState'], FILTER_SANITIZE_STRING);
        $homeCountry = filter_var($_POST['txtHomeCountry'], FILTER_SANITIZE_STRING);
        $agreeTerms = (int) getData('chkAgreeTerms');
        $sendEmail = (int) getData('chkSendEmail');
        $skier = (int) getData('chkSkier');
        $mountainId = (int) getData('mid');

        // validate data
        if($rating <= 1 or $rating >= 10){
            print '<p class="mistake">Error! Please choose a valid rating.</p>';
            $saveData = false;
        }

        if ($comment != ""){
            if ($comment == "") {
                print'<p class="mistake"> Please enter a comment.</p>';
                $saveData = false;
            } 
        }
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
            print '<p class="mistake">The email you entered is invalid</p>';
            $saveData = false;
        }
        //Validate First name 
        if ($firstName != ""){
            if ($firstName == "") {
                print'<p class="mistake"> Please enter your first name.</p>';
                $saveData = false;
            } elseif (!verifyAlphaNum($firstName)) {
                print '<p class="mistake"> Your first name appears to have some extra characters.</p>';
                $saveData = false;
            } elseif(is_numeric($firstName)== true) {
                print '<p class="mistake"> Make your entry non-numeric.</p>';
                $saveData = false;
            }
        }

        //Validate Last name 
        if ($lastName != ""){
            if ($lastName == "") {
                print'<p class="mistake"> Please enter your last name.</p>';
                $saveData = false;
            } elseif (!verifyAlphaNum($lastName)) {
                print '<p class="mistake"> Your last name appears to have some extra characters.</p>';
                $saveData = false;
            } elseif(is_numeric($lastName)== true) {
                print '<p class="mistake"> Make your entry non-numeric.</p>';
                $saveData = false;
            }

        }

        if ($homeState != ""){
            if ($homeState == "") {
                print'<p class="mistake"> Please enter your home state.</p>';
                $saveData = false;
            } elseif (!verifyAlphaNum($homeState)) {
                print '<p class="mistake"> Your home state appears to have some extra characters.</p>';
                $saveData = false;
            } elseif(is_numeric($homeState)== true) {
                print '<p class="mistake"> Make your entry non-numeric.</p>';
                $saveData = false;
            }

        }

        if ($homeCountry != ""){
            if ($homeCountry == "") {
                print'<p class="mistake"> Please enter your home country.</p>';
                $saveData = false;
            } elseif (!verifyAlphaNum($homeCountry)) {
                print '<p class="mistake"> Your home country appears to have some extra characters.</p>';
                $saveData = false;
            } elseif(is_numeric($homeCountry)== true) {
                print '<p class="mistake"> Make your entry non-numeric.</p>';
                $saveData = false;
            }

        }

        //Validate agreeTerms, Hardwiring value to be zero if not checked
        if ($agreeTerms != 1) {
            $agreeTerms = 0;
            $saveData = true;
        }

         //Validate sendEmail, Hardwiring value to be zero if not checked
         if ($sendEmail != 1) {
            $sendEmail = 0;
            $saveData = true;
        }

        if ($skier != 1) {
            $skier = 0;
            $saveData = true;
        }

        // Validate critter ID
        if (!is_numeric($mountainId)){
            print '<p class = "mistake"> Invalid input </p>';
            $saveData = false;
        }





/* 



        $donationAmount = (int) getData('rngDonationAmount');
        $userEmail = filter_var($_POST['txtUserEmail'], FILTER_SANITIZE_EMAIL);
        $firstName = filter_var($_POST['txtFirstName'], FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST['txtLastName'], FILTER_SANITIZE_STRING);
        $agreeTerms = (int) getData('chkAgreeTerms');
        $sendEmail = (int) getData('chkSendEmail');
        //delete eventually-just to check if it gets passed through
        $mountainId = (int) getData('mid');

        //validate data- donation range
        if($donationAmount <= 25 or $donationAmount >= 1000){
            print '<p class="mistake">Error! Please choose a valid amount to donate.</p>';
            $saveData = false;
        }
        //validate data- email
        if (!filter_var($adopterEmail, FILTER_VALIDATE_EMAIL)){
            print '<p class="mistake">The email you entered is invalid</p>';
            $saveData = false;
        }

        //Validate First name 
        if ($firstName != ""){
            if ($firstName == "") {
                print'<p class="mistake"> Please enter your first name.</p>';
                $saveData = false;
            } elseif (!verifyAlphaNum($firstName)) {
                print '<p class="mistake"> Your first name appears to have some extra characters.</p>';
                $saveData = false;
            } elseif(is_numeric($firstName)== true) {
                print '<p class="mistake"> Make your entry non-numeric.</p>';
                $saveData = false;
            }
        }

         //Validate Last name 
         if ($lastName != ""){
            if ($lastName == "") {
                print'<p class="mistake"> Please enter your last name.</p>';
                $saveData = false;
            } elseif (!verifyAlphaNum($lastName)) {
                print '<p class="mistake"> Your last name appears to have some extra characters.</p>';
                $saveData = false;
            } elseif(is_numeric($lastName)== true) {
                print '<p class="mistake"> Make your entry non-numeric.</p>';
                $saveData = false;
            }

        }
        //Validate agreeTerms, Hardwiring value to be zero if not checked
        if ($agreeTerms != 1) {
            $agreeTerms = 0;
            $saveData = true;
        }

         //Validate sendEmail, Hardwiring value to be zero if not checked
         if ($sendEmail != 1) {
            $sendEmail = 0;
            $saveData = true;
        }
        // Validate critter ID
        if (!is_numeric($mountainId)){
            print '<p class = "mistake"> Invalid input </p>';
            $saveData = false;
        }


         */

        // Insert donation amount and email into tblAdopterMountain
        if($saveData){
            $sql = 'INSERT INTO tblRating SET ';
            $sql .= 'fldRating = ?, ';
            $sql .= 'fpkMountainId = ?, ';
            $sql .= 'fpkUserEmail = ?, ';
            $sql .= 'fldComment = ?';

            
            // HOW ARE WE GETTING THE USERS EMAIL TO HERE? IS IT A SIGN INTO
            // YOUR ACCOUNT TYPE OF THING? OR IS IT ANOTHER FORM ELEMENT THAT WE
            // MAKE THE USER FILL OUT? (need to make variable for it)
            $data = array();
            $data[] = $rating;
            $data[] = $mountainId;
            $data[] = $userEmail ;
            $data[] = $comment;
            
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
            
            //Insert email, first name, and other factors into table adopters
            $sql2 = 'INSERT INTO tblUser SET ';
            $sql2 .= 'pmkUserEmail = ?, ';
            $sql2 .= 'fldFirstName = ?, ';
            $sql2 .= 'fldLastName = ?, ';
            $sql2 .= 'fldHomeState = ?, ';
            $sql2 .= 'fldHomeCountry = ?, ';
            $sql2 .= 'fldAgreeToTerms = ?, ';
            $sql2 .= 'fldRecieveCommunication = ?, ';
            $sql2 .= 'fldSkier= ?';

            $data2 = array();
            $data2[] = $userEmail;
            $data2[] = $firstName;
            $data2[] = $lastName;
            $data2[] = $homeState;
            $data2[] = $homeCountry;
            $data2[] = $agreeTerms;
            $data2[] = $sendEmail;
            $data2[] = $skier;
            
            
            if(DEBUG){
                print $thisDatabaseReader->displayQuery($sql2, $data2);
            }
            //is this the right idea?
            $thisDatabaseWriter->insert($sql2, $data2);
            if($thisDatabaseWriter == true){
                print '<p> Your rating has been recieved! </p>';
            }
            else{
                print '<p> Something went wrong- Entry NOT saved </p>';
            }
            

        }
        
          
    }
    ?>
    <form action="<?php print PHP_SELF; ?>" id="frmAdopt" method="post">
        <fieldset class="range">

            <p>
                <lable for="rngRating">Mountain raiting: <span id="rating"></span></label>
                <input type="range" min="1" max="10" step="1" value="<?php print $rating; ?>" name="rngRating" id="rngRating">
                <script>
                    var slider = document.getElementById("rngRating");
                    var output = document.getElementById("rating");
                    output.innerHTML = slider.value;
                    slider.oninput = function() {
                        output.innerHTML = this.value;
                    }
                </script>
            </p>

        </fieldset>

        <fieldset>
            <p>
                <label for="txtComment">Comment on your rating: </label>
                <input type="textarea" 
                        name="txtComment" 
                        id="txtComment"
                        value="<?php print $comment; ?>"
                        required>
            </p>
        </fieldset>

        <fieldset class="textbox">
                <p>
                    <label for="txtuserEmail">Email Address</label>
                    <input type="email" id="txtUserEmail" name="txtUserEmail" 
                    value="<?php print $userEmail; ?>" tabindex="200">
                </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtFirstName">First Name:</label>
                <input type="text" 
                        name="txtFirstName" 
                        id="txtFirstName"
                        value="<?php print $firstName; ?>"
                        required>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtLastName">Last Name:</label>
                <input type="text" 
                        name="txtLastName" 
                        id="txtLastName"
                        value="<?php print $lastName; ?>"
                        required>
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="txtHomeState">Home state: </label>
                <input type="text" 
                        name="txtHomeState" 
                        id="txtHomeState"
                        value="<?php print $homeState; ?>"
                        required>
            </p>
        </fieldset>

        <fieldset>
            <p>
                <label for="txtHomeCountry">Home Country: </label>
                <input type="text" 
                        name="txtHomeCountry" 
                        id="txtHomeCountry"
                        value="<?php print $homeCountry; ?>"
                        required>
            </p>
        </fieldset>

        <fieldset class="checkbox">
            <p>
                <input
                    id="chkAgreeTerms"
                    name="chkAgreeTerms"
                    tabindex="420"
                    type="checkbox"
                    value="<?php print $agreeTerms; ?>"
                    >
                <label for="chkAgreeTerms">I agree to the terms and conditions. </label>
            </p>
        </fieldset>
        <fieldset class="checkbox">
            <p>
                <input
                    id="chkSendEmail"
                    name="chkSendEmail"
                    tabindex="430"
                    type="checkbox"
                    value="<?php print $sendEmail; ?>"
                    >
                <label for="chkSendEmail">Would you like emails from Ski Finder? </label>
            </p>
        </fieldset>
        <fieldset class="checkbox">
            <p>
                <input
                    id="chkSkier"
                    name="chkSkier"
                    tabindex="430"
                    type="checkbox"
                    value="<?php print $skier; ?>"
                    >
                <label for="chkSkier">Have you skied before? </label>
            </p>
        </fieldset>
        <fieldset>
        <input type = "hidden" id = "mid" name = "mid" value = "<?php print $mountainId ;?>" >
        </fieldset>
        <fieldset>
            <p><input type="submit" value="Rate"
            tabindex="999" name="btnSubmit"></p>
        </fieldset>

    </form>
</main>


<?php
include 'footer.php';
?>

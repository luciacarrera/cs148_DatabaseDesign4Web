<?php
include 'top.php';

// sanitizing data with getData function
function getData($field){
    if(!isset($_POST[$field])){
    $data ="";
    }else{
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

// variable to hold id value passed in (initialization) + sanitization
$critterId = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;
if(isset($_POST['hidCritterId'])){
    $critterId = (int) htmlspecialchars($_POST['hidCritterId']);
}

// select id and commonname from db
$sql = 'SELECT pmkWildlifeId, fldCommonName ';
$sql .= 'FROM tblWildlife ';
$sql .= 'WHERE pmkWildlifeId = ? ';

$data = array($critterId);
$animalToAdopt = $thisDatabaseReader->select($sql, $data);

// sanitization if record does not exist
$critterCommonName = $animalToAdopt[0]['fldCommonName'];

//STEP A: initializing of variables
$donationAmount = 50;
$adopterEmail = 'lcarrera@uvm.edu';
$firstName = 'Lucia';
$lastName = 'Carrera';
$agreeToTerms = '1';
$agreeToPromo = '1';


$saveData = true;
?>
<main>
    <!--display common name in heading-->
    <h2>Adopt a 
        <?php print $critterCommonName; ?>
    </h2>
    <?php
if(isset($_POST['btnSubmit'])) {
    if(DEBUG){
        print '<p>POST array: </p><pre>';
        print_r($_POST);
        print '</pre>';
    }

    // STEP D: sanitization of variables
    $donationAmount = (int) getData('rngDonationAmount');
    $adopterEmail = filter_var($_POST['txtAdopterEmail'], FILTER_SANITIZE_EMAIL);
    $firstName = (string) getData('txtFirstName');
    $lastName = (string) getData('txtLastName');
    $agreeToTerms = (int) getData('chkAgreeToTerms');
    $agreeToPromo = (int) getData('chkAgreeToPromotional');
    $critterId = (int) getData('hidCritterId');



    // STEP E: validation of variables
    if($donationAmount <= 25 or $donationAmount >= 1000){
        print '<p class="mistake">Please choose a valid donation amount.</p>';
        
        // save data flag
        $saveData = false;
    }

    if(!filter_var($adopterEmail, FILTER_VALIDATE_EMAIL)) {
        print '<p class="mistake">Please enter a valid email address.</p>';
        $saveData = false;
    }

    if(!ctype_alpha($firstName) or !(strlen(trim($firstName)) == strlen($firstName))){
        print '<p class="mistake">Please enter a valid first name.</p>';
        $saveData = false;
    }

    if(!ctype_alpha($lastName) or !(strlen(trim($lastName)) == strlen($lastName))){
        print '<p class="mistake">Please enter a valid last name.</p>';
        $saveData = false;
    }

    if($agreeToTerms != '1'){
        print '<p class="mistake">Please agree to the terms & conditions.</p>';
        $saveData = false;
    }

    //insert variables
    if($saveData){

        $sql = 'INSERT INTO tblAdopterWildlife SET ';
        $sql .= 'fldDonationAmount = ?, ';
        $sql .= 'fpkAdopterEmail = ?, ';
        $sql .= 'fpkWildlifeId = ?';


        $data = array();
        $data[] = $donationAmount;
        $data[] = $adopterEmail;
        $data[] = $critterId;

        $thisDatabaseWriter->insert($sql, $data);
        if(DEBUG) {
            print $thisDatabaseReader->displayQuery($sql, $data);
        }

        // table adopters
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
        $data2[] = $agreeToTerms;
        $data2[] = $agreeToPromo;

        $thisDatabaseWriter->insert($sql2, $data2);
        if (DEBUG) {
            print $thisDatabaseReader->displayQuery($sql2, $data2);
        }
    }
}
?>
    <!--form-->
    <p id="submitOutput" ></p>
    <!--STEP B: Add form element & C-->
    <form action="<?php print PHP_SELF; ?>" id="frmAdopt" method="post">
        <!--range slider-->
        <fieldset>
            <p>
                <label for="rngDonationAmount">Donation Amount: $<span id="donationValue"></span></label>
                <input type="range" min="25" max="1000" step="25" value="<?php print $donationAmount; ?>"
                    name="rngDonationAmount" id="rngDonationAmount">
            </p>
        </fieldset>

        <!--email-->
        <fieldset class="textbox">
            <p>
                <label for="txtAdopterEmail">Email address</label>
                <input type="email" id="txtAdopterEmail" name="txtAdopterEmail"
                    value="<?php print $adopterEmail; ?>"
                    tabindex="200">
            </p>
        </fieldset>

        <!--first name-->
        <fieldset class="textbox">
            <p>
                <label for="txtFirstName">First Name</label>
                <input type="text" id="txtFirstName" name="txtFirstName"
                    value="<?php print $firstName; ?>"
                    tabindex="300">
            </p>
        </fieldset>

        <!--last name-->
         <fieldset class="textbox">
            <p>
                <label for="txtLastName">Last Name</label>
                <input type="text" id="txtLastName" name="txtLastName"
                    value="<?php print $lastName; ?>"
                    tabindex="300">
            </p>
        </fieldset>

        <!--agree to terms checkbox-->
        <fieldset class="checkbox">
            <p>
                <label for="chkAgreeToTerms">I agree to Terms & Conditions</label>
                <input type="checkbox" id="chkAgreeToTerms" name="chkAgreeToTerms"
                    checked="" tabindex="500"
                    value="<?php print $agreeToTerms; ?>">
            </p>
        </fieldset>
        
        <!--agree to promotional-->
        <fieldset class="checkbox">
            <p>
                <label for="chkAgreeToPromotional">Would you like to receive promotional material?</label>
                <input type="checkbox" id="chkAgreeToPromotional" name="chkAgreeToPromotional"
                    checked="" tabindex="600"
                    value="<?php print $agreeToTerms; ?>">
            </p>
        </fieldset>

        <!--hidden input wildlife id-->
         <fieldset class="hidden">
            <p>
                <input type="hidden" id="hidCritterId" name="hidCritterId" value="<?php print $critterId; ?>"> 
            </p>
        </fieldset>

        <!--submit button-->
        <fieldset>
            <p><input type="submit" value = "Adopt" tabindex="999" name="btnSubmit"></p>
        </fieldset>
    </form>
    
</main>
<script>
    var slider = document.getElementById("rngDonationAmount");
    var output = document.getElementById("donationValue");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }
    var submitOutput = document.getElementById("submitOutput");
</script>
<?php
include 'footer.php'
?>
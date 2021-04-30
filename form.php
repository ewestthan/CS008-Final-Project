<?php 
include 'top.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dataIsGood = false;
$email = '';
$firstName = '';
$lastName = '';
$genderRad = '';
// $chkCoal = '';
// $chkHydro = '';
// $chkWind = ''; 
// $chkSolar = '';
// $chkNuclear = '';
$artistsLst = '';
$comments = '';


function getData($field){
if(!isset($_POST[$field])){
    $data = "";
}
else{
    $data = trim($_POST[$field]);
    $data = htmlspecialchars($data);
}
return $data;
}
?>
    
<main>
    <article>
        <?php
        print '<p>Post Array:</p><pre>';
        print_r($_POST);
        print '</pre>';

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $dataIsGood = true;
            
            $firstName = getData("txtFirstName");
            $lastName = getData("txtLastName");
            $email = getData("txtEmail");
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $gender = getData("fldGenderRad");

            // $chkCoal = getData("chkCoal");
            // $chkHydro = getData("chkHydro");
            // $chkWind = getData("chkWind");
            // $chkSoal = getData("chkSoal");
            // $chkNuclear = getData("chkNuclear");
            
            $artistLst = getData('fldArtistLst');
            
            $comments = getData('fldComments');

            if($firstName == ""){
                print '<p class = "mistake"> Please enter your first name.</p>';
                $dataIsGood = false;
            }

            if($lastName == ""){
                print '<p class = "mistake"> Please enter your last name.</p>';
                $dataIsGood = false;
            }

            if($email == ""){
                print '<p class="mistake">Please enter your email address.</p>';
                $dataIsGood = false;
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                print '<p class="mistake">Your email address appears to be incorrect.</p>';
                $dataIsGood = false;
            }

            if($genderRad == ""){
                print '<p class = "mistake"> Please indicate your gender preference</p>';
                $dataIsGood = false;
            }

            if($dataIsGood){
                try{
                    $sql = 'INSERT INTO tblArtInquiry (fldEmail, fldFirstName, fldLastName, fldGender, fldArtistLst, fldComments) VALUES (?, ?, ?, ?, ?, ?)';
                    $statement = $pdo->prepare($sql);
                    $params = array($email, $firstName, $lastName, $genderRad, $artistsLst, $comments);

                    // foreach ($params as $param){
                    //     $pos = strpos($sql, '?');
                    //     if($pos !== false){
                    //         $sql = substr_replace($sql, '"' . $param . '"', $pos, strlen('?'));
                    //     }
                    // }
                    // print '<p>' . $sql. '</p>';


                    if($statement->execute($params)){
                        print '<p>Record was successfuly saved.</p>';
                    }
                    else{
                        print '<p>Record was NOT successfully saved.</p>';
                    }
                }
                catch(PDOException $e){
                    print '<p>Couldn\'t insert the record, please contact someone.</p>';
                }
            }
        }

        if($dataIsGood){
            print '<h2>Thank you, your information has been recieved.</h2>';
        }
        ?>

        <form action="<?php print $phpSelf;?>" 
                id = "frmArtInquiry"
                method="post">
<!-- text boxes: 2-4-->
            <fieldset class = "contact">
                <legend>Contact info</legend>
                <p class = "form">
                    <label for="txtFirstName">First</label>
                    <input type="text" name = "txtFirstName" id = "txtFirstName" value= "<?php print $firstName; ?>" required>
                </p>
                <p class = "form">
                    <label for="txtLastName">Last</label>
                    <input type="text" name = "txtLastName" id = "txtLastName" value= "<?php print $lastName; ?>" required>
                </p>
                <p class = "form">
                    <label for="txtEmail">Email</label>
                    <input type="email" name = "txtEmail" id = "txtEmail" value= "<?php print $email; ?>" required>
                </p>
            </fieldset>
<!-- radio buttons: 3-5 -->
            <fieldset class = "radio">
                <legend>What is your prefered gender?</legend>
                <p>
                    <label for="radYes">Male</label>
                    <input type="radio" value = "Male" name = "fldGender" id = "radMale" required>
                </p>
                <p>
                    <label for="radNo">Female</label>
                    <input type="radio" value = "Female" name = "fldGender" id = "radFemale" required>
                </p>
                <p>
                    <label for="radPrefer">Other</label>
                    <input type="radio" value = "Other" name = "fldGender" id = "radOther" required>
                </p>
            </fieldset>
<!-- checkboxes: 3-5-->
            <fieldset class = "checkbox">
                <legend>Check all that you support</legend>
                <p>
                    <label for="chkCoal">Coal</label>
                    <input type="checkbox" name = "chkCoal" id = "chkCoal" value = '1'>
                </p>
                <p>
                    <label for="chkHydro">Hydro</label>
                    <input type="checkbox" name = "chkHydro" id = "chkHydro" value = '1'>
                </p>
                <p>
                    <label for="chkWind">Wind</label>
                    <input type="checkbox" name = "chkWind" id = "chkWind" value = '1'>
                </p>
                <p>
                    <label for="chkSolar">Solar</label>
                    <input type="checkbox" name = "chkSolar" id = "chkSolar" value = '1'>
                </p>
                <p>
                    <label for="chkNuclear">Nuclear</label>
                    <input type="checkbox" name = "chkNuclear" id = "chkNuclear" value = '1'>
                </p>
            </fieldset>
<!-- select list: 1+ 3-5 options -->
            <fieldset class = "list">
                <legend>What art piece are you interested in?</legend>
                <p>
                    <select name = "lstArtists" id = "fldArtistsLst">
                        <option value="lstUntitled">Untitled (heart)</option>
                        <option value="lstMonet">Water Lilies</option>
                        <option value="lstBroadway">Broadway Boogie Woogie</option>
                        <option value="lstNighthawk">Nighthawk</option>
                    </select>
                </p>
            </fieldset>
<!-- text area: 1+ -->
            <fieldset class = "text">
                <legend>Is there anything else you would like us to know about your inquiry?</legend>
                <p>
                    <textarea name = "fldComments" id = "fldComments"></textarea>
                </p>
            </fieldset>
<!-- submit button -->
            <fieldset class = "submit">
                <legend></legend>
                <p>
                    <input type="submit" name = "btnSubmit">
                </p>
            </fieldset>
        </form>
    </article>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
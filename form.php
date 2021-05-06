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
$chkAbstract = '';
$chkSurrealism = '';
$chkRealism = ''; 
$chkCubism = '';
$chkDadaism = '';
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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $dataIsGood = true;
            
            $firstName = getData("txtFirstName");
            $lastName = getData("txtLastName");
            $email = getData("txtEmail");
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $genderRad = getData("fldGender");

            $chkAbstract = getData("fldAbstract");
            $chkSurrealism = getData("fldSurrealism");
            $chkRealism = getData("fldRealism");
            $chkCubism = getData("fldCubism");
            $chkDadaism = getData("fldDadaism");
            
            $artistLst = getData('fldArtistLst');
            
            $comments = getData('fldComments');
            $comments = filter_var($comments, FILTER_SANITIZE_STRING);

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
            if($chkAbstract == '' && $chkSurrealism == '' && $chkRealism == '' && $chkCubism == '' && $chkDadaism == ''){
                print '<p class = "mistake"> Please indicate an interest</p>';
                $dataIsGood = false;
            }
            if($comments == ""){
                print '<p class = "mistake"> Please enter a comment</p>';
                $dataIsGood = false;
            }

            if($dataIsGood){
                try{
                    $sql = 'INSERT INTO tblArtInquiry (fldEmail, fldFirstName, fldLastName, fldGender, fldAbstract, fldSurrealism, fldRealism, fldCubism, fldDadaism, fldArtistLst, fldComments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    $statement = $pdo->prepare($sql);
                    $params = array($email, $firstName, $lastName, $genderRad, $chkAbstract, $chkSurrealism, $chkRealism, $chkCubism, $chkDadaism, $artistsLst, $comments);
                    
                    if($statement->execute($params)){
                        print '<p>Record was successfuly saved.</p>';

                        $to = $email;
                        $from = 'Art dealers <ewest3@uvm.edu>';
                        $subject = 'Regarding your art inquiry';

                        $mailMessage = 'Thank you for inquiring about our art selection, we are currently out of stock. You will be notified when the piece you have chose is back in stock.';
                        $mailMessage .= ' -Your local art dealer';
                
                        $headers = "MIME-Version 1.0\r\n";
                        $headers .= "Content-type: text/html; charset=utf-8\r\n";
                        $headers .= "From: " . $from . "\r\n";

                        $mailSent = mail($to, $subject, $mailMessage, $headers);

                        if($mailSent){
                            print '<p>An email has been sent to you containing further information about your art inquiry.</p>';
                            print $mailMessage;
                        }
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
                    <input type="radio" <?php if($gender = 'Male') print 'checked'; ?> value = "Male" name = "fldGender" id = "radMale" required>
                </p>
                <p>
                    <label for="radNo">Female</label>
                    <input type="radio" <?php if($gender = 'Female') print 'checked'; ?>value = "Female" name = "fldGender" id = "radFemale" required>
                </p>
                <p>
                    <label for="radPrefer">Other</label>
                    <input type="radio" <?php if($gender = 'Other') print 'checked'; ?> value = "Other" name = "fldGender" id = "radOther" required>
                </p>
            </fieldset>
<!-- checkboxes: 3-5-->
            <fieldset class = "checkbox">
                <legend>Indicate what styles of art you are most fascinated by:</legend>
                <p>
                    <label for="fldAbstract">Abstract</label>
                    <input type="checkbox" name = "fldAbstract" id = "fldAbstract" value = '1'>
                </p>
                <p>
                    <label for="fldSurrealism">Surrealism</label>
                    <input type="checkbox" name = "fldSurrealism" id = "fldSurrealism" value = '1'>
                </p>
                <p>
                    <label for="fldRealism">Realism</label>
                    <input type="checkbox" name = "fldRealism" id = "fldRealism" value = '1'>
                </p>
                <p>
                    <label for="fldCubism">Cubism</label>
                    <input type="checkbox" name = "fldCubism" id = "fldCubism" value = '1'>
                </p>
                <p>
                    <label for="fldDadaism">Dadaism</label>
                    <input type="checkbox" name = "fldDadaism" id = "fldDadaism" value = '1'>
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
                    <textarea name = "fldComments" id = "fldComments" <?php if($gender != '') print $comments; ?>> </textarea>
                </p>
            </fieldset>
<!-- submit button -->
            <fieldset class = "submit">
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
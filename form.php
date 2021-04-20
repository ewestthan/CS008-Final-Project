<?php 
include 'top.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dataIsGood = false;


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
            

            if($dataIsGood){
                try{
                    $sql = 'INSERT INTO tbl (fld) VALUES (?)';
                    $statement = $pdo->prepare($sql);
                    $params = array($firstName, $lastName, $email);

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
                id = "frmRegister"
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
                <legend>Do You Support Sustainable Energy?</legend>
                <p>
                    <label for="radYes">Yes</label>
                    <input type="radio" value = "Yes" name = "fldSupportRad" id = "radYes" required>
                </p>
                <p>
                    <label for="radNo">No</label>
                    <input type="radio" value = "No" name = "fldSupportRad" id = "radNo" required>
                </p>
                <p>
                    <label for="radPrefer">Prefer not to say</label>
                    <input type="radio" value = "Prefer" name = "fldSupportRad" id = "radPrefer" required>
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
                <legend>What is the method of sustainable energy do you believe holds the most potential?</legend>
                <p>
                    <select name = "lstSustainableEnergy" id = "fldSustainableLst">
                        <option value="lstHydro">Hydro</option>
                        <option value="lstWind">Wind</option>
                        <option value="lstSolar">Solar</option>
                        <option value="lstNuclear">Nuclear</option>
                    </select>
                </p>
            </fieldset>
<!-- text area: 1+ -->
            <fieldset class = "text">
                <legend>If you did not check Nuclear Energy, please explain why:</legend>
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
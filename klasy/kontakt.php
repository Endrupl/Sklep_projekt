<?php
// Initialize variables to null.
$NameError="";
$EmailError="";
$GenderError="";
//$WebsiteError="";
//On Submitting form, below function will execute
//Submit Scope starts from here
if(isset($_POST['Submit'])){
	
 if(empty($_POST["Name"])){
$NameError=" Twoja nazwa(nick) jest wymagana";
 }
 else{
$Name=Test_User_Input($_POST["Name"]);
// check Name only contains letters and whitespace
if(!preg_match("/^[A-Za-zĄ-Żą-żłŁ\. ]*$/",$Name)){
$NameError=" Dozwolone są tylko litery i spacje";
}
 }
  if(empty($_POST["Email"])){
$EmailError=" Adres Email jest wymagany";
 }
 else{
$Email=Test_User_Input($_POST["Email"]);
// check if e-mail address syntax is valid or not
if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{2,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email))
{
$EmailError=" Niepoprawny adres email";
}
}
  if(empty($_POST["Gender"])){
$GenderError=" Płęć jest wymagana";
 }
 else{
$Gender=Test_User_Input($_POST["Gender"]);

}
if(!empty($_POST["Name"])&&!empty($_POST["Email"])&&!empty($_POST["Gender"])){
if((preg_match("/^[A-Za-zĄ-Żą-żłŁ\. ]*$/",$Name)==true)&&(preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{2,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email)==true))
{
/*echo "Name:".ucwords ($_POST["Name"])."<br>";
echo "Email: {$_POST["Email"]}<br>";
echo "Gender: {$_POST["Gender"]}<br>";
echo "Website: {$_POST["Website"]}<br>";
echo "Comments: {$_POST["Comment"]}<br>"; */
$emailTo="mail@gmail.com";
 $subject="Formularz kontaktowy";
 $body=" Nazwa : ".$_POST["Name"]."
 Email : ".$_POST["Email"].
 "
 Płęć : ". $_POST["Gender"].
 "
 Wiadomość : ".$_POST["Comment"];
 $Sender="From:mail@gmail.com";
     if (mail($emailTo, $subject, $body, $Sender)) {
                echo "<h2>".$_POST['Name'].",  Twoja wiadomość została wysłana poprawnie.</h2> <br>";
                    } else {
                echo "<h2>".$_POST['Name']." Coś poszło nie tak :/ Spróbuj ponownie!</h2> <br>";
                    }
     
}else{
	echo '<span class="Error">* Proszę popraw błędy i spróbuj ponownie później*<br><br></span>';
}
}
}//Submit Scope  Ends here
//Function to get and throw data to each of the field final varriable like Name / Gender etc.
function Test_User_Input($Data){
	return $Data;
}

//php code ends here
?>


<?php ?>
<style>
    .Error {
        color: red;
    }
</style>

<div class="container">
    <h3>* Prosze wypełnić obowiązkowo pola z gwiazdką</h3>
<form id="contactForm" class="form-horizontal" action="" method="post">    
    <div class="form-group">
        <div class="col-xs-6">
        <label for="validationCustom01">Nazwa</label>
        <input type="text" Name="Name" class="form-control" id="validationCustom01" placeholder="Nazwa" value="">
        <span class="Error">*<?php echo $NameError;  ?></span><br>
        </div>
    </div>
<br>
    <div class="form-group">
        <div class="col-xs-6">
        <label for="inputEmail4">Email</label>
        <input type="email" Name="Email" class="form-control" id="inputEmail4" placeholder="Email" value="">
        <span class="Error">*<?php echo $EmailError; ?></span>
        </div>
    </div>
<br>
    <div class="form-group">
        <div class="col-xs-6">
        <label class="form-check-label">Płęć</label>
        </div>
    </div>
    <div class="form-group">
        <input class="form-check-input" type="radio" Name="Gender" value="Mężczyzna">
        Mężczyzna
        <input class="form-check-input" type="radio" Name="Gender" value="Kobieta">
        Kobieta
        <span class="Error">*<?php echo $GenderError; ?></span><br>
    </div>
<br>
    <div class="form-group">
        <div class="col-xs-6">
        <label for="exampleFormControlTextarea1">Zamieść wiadomość poniżej</label>
        <textarea class="form-control noresize" Name="Comment"></textarea>
        </div>
    </div>
<br>
<button type="submit" Name="Submit" value="Submit" class="btn btn-primary">Zatwierdź</button>

</form> 





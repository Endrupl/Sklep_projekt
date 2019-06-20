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
$NameError="Name is Required";
 }
 else{
$Name=Test_User_Input($_POST["Name"]);
// check Name only contains letters and whitespace
if(!preg_match("/^[A-Za-z\. ]*$/",$Name)){
$NameError="Only Letters and white sapace are allowed";
}
 }
  if(empty($_POST["Email"])){
$EmailError="Email is Required";
 }
 else{
$Email=Test_User_Input($_POST["Email"]);
// check if e-mail address syntax is valid or not
if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email))
{
$EmailError="Invalid Email Format";
}
}
  if(empty($_POST["Gender"])){
$GenderError="Gender is Required";
 }
 else{
$Gender=Test_User_Input($_POST["Gender"]);

}
  /*if(empty($_POST["Website"])){
$WebsiteError="Website is Required";
 }
 else{
$Website=Test_User_Input($_POST["Website"]);
 // check Website address syntax is valid or not*/

/*if(!preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[a-zA-Z0-9.\-_\/?\$=&\#\~`!]",$Website)){
$WebsiteError="Invalid Webside Address Format";	
}*/
}
if(!empty($_POST["Name"])&&!empty($_POST["Email"])&&!empty($_POST["Gender"])){
if((preg_match("/^[A-Za-z\. ]*$/",$Name)==true)&&(preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email)==true))
{
/*echo "Name:".ucwords ($_POST["Name"])."<br>";
echo "Email: {$_POST["Email"]}<br>";
echo "Gender: {$_POST["Gender"]}<br>";
echo "Website: {$_POST["Website"]}<br>";
echo "Comments: {$_POST["Comment"]}<br>"; */
$emailTo="mail@gmail.com";
 $subject="Contact Form";
 $body=" Name : ".$_POST["Name"]."
 Email : ".$_POST["Email"].
 "
 Gender : ". $_POST["Gender"].
 "
 Message :: ".$_POST["Comment"];
 $Sender="From:mail@gmail.com";
     if (mail($emailTo, $subject, $body, $Sender)) {
                echo "<h2>".$_POST['Name'].",  Your Message Submitted Successfully</h2> <br>";
                    } else {
                echo "<h2>".$_POST['Name']." Something Went Wrong :/ Try Again !</h2> <br>";
                    }
     
}else{
	echo '<span class="Error">* Please Complete & Correct your Form then Try Again*<br><br></span>';
}
}

function Test_User_Input($Data){
	return $Data;
}


?>
<div class="container">
<div class="jumbotron">
<h3>* Please Fill Out the following Fields.</h3>
<div class="container">
<form class="form-horizontal">    
    
    <div class="form-group">
        <div class="col-xs-6">
        <label for="validationCustom01">First name</label>
        <input type="text" Name="Name" class="form-control" id="validationCustom01" placeholder="First name">
        <span class="Error">*<?php echo $NameError;  ?></span><br>
        </div>
    </div>
<br>
    <div class="form-group">
        <div class="col-xs-6">
        <label for="inputEmail4">Email</label>
        <input type="email" Name="Email" class="form-control" id="inputEmail4" placeholder="Email">
        <span class="Error">*<?php echo $EmailError; ?></span>
        </div>
    </div>
<br>
    <div class="form-group">
        <div class="col-xs-6">
        <label class="form-check-label">Gender</label>
        <br>
        </div>
    </div>
    <div class="form-group">
        <input class="form-check-input" type="radio" Name="Gender" value="Male" checked>
        Male
        <input class="form-check-input" type="radio" Name="Gender" value="Female">
        Female
        <span class="Error">*<?php echo $GenderError; ?></span><br>
    </div>
<br>
    <div class="form-group">
        <div class="col-xs-6">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control noresize" Name="Comment"></textarea>
        </div>
    </div>
<br>
<button type="submit" Name="Submit" value="Submit" class="btn btn-primary">Submit</button>


</form> 
</div>
</div>


    



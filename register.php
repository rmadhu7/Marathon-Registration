<!-- Form validation in server side -->
<?php
function header_write(){
print <<<ENDBLOCK
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>SDSU Marathon</title>

	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />
		
	<link rel="stylesheet" type="text/css" href="index.css" />
	<link rel="stylesheet" type="text/css" href="register.css" />
</head>

<body>
	<div id="container">
        <h2>Registration</h2>
ENDBLOCK;
}
function write_htmlpage()
{	
print <<<ENDBLOCK
	<form name="personal" method="post" action="file_upload.php" enctype="multipart/form-data" >
	<fieldset>
	<legend><b>Personal Information</b></legend>

	    <table id="personalTable">
                <tr>		
                    <td><label for="fname">First Name:</label></td>
                    <td><input type="text" name="fname" id="fname" value="$_POST[fname]" size="20" /></td>
					<td><label for="mname">Middle Name:</label></td>
                    <td><input type="text" name="mname" id="mname" value="$_POST[mname]" size="20"  /></td>
                    <td><label for="lname">Last Name:</label></td>
                    <td><input type="text" name="lname" id="lname" value="$_POST[lname]" size="20" /></td>                    
                </tr>
				<tr>
					<td><label for="gender">Gender:</label></td><td>
ENDBLOCK;
				$gender_choice = array("male","female");
				foreach($gender_choice as $item) {
					echo "<input type='radio' name='gender'  value='$item'";
					if($item == $_POST[gender])
						echo " checked='checked'";
					echo " />$item";
					}
print <<<ENDBLOCK
					</td>
				
					<td><label>Date of Birth:</label></td>
					<td><input type="text" id="m" size="2" maxlength="2" name="month" value="$_POST[month]" placeholder="MM" />-<input type="text" id="d" size="2" name="day" maxlength="2" value="$_POST[day]" placeholder="DD" />-<input type="text" id="y" size="4"  maxlength="4" name="year" value="$_POST[year]" placeholder="YYYY"/></td>
				</tr>
                <tr>		
                    <td><label for="address1">Address 1:</label></td>
                    <td><input type="text" name="address1" id="address1" value="$_POST[address1]" size="35" /></td>
                </tr> 
                <tr>		
                    <td><label for="address2">Address 2:</label></td>
                    <td><input type="text" name="address2" id="address2" value="$_POST[address2]" size="35" /></td>
                </tr>                  
                <tr>		
                    <td><label for="city">City:</label></td>
                    <td><input type="text" name="city" id="city" value="$_POST[city]" size="20" /></td>
                    <td><label for="state">State:</label></td>
                    <td><input type="text" name="state" id="state" value="$_POST[state]" /</td>
                    <td><label for="zip">Zipcode:</label></td>
                    <td><input type="text" name="zip" id="zip" size="5" value="$_POST[zip]" maxlength="5" placeholder="#####"/></td>                                        
                </tr> 
				<tr>
				<td><label for="phone">Phone</label></td>
                <td><input type="text" name="phone" id="phone" size="10" value="$_POST[phone]" maxlength="10" placeholder="xxxxxxxxxx"/></td>
				
				<td><label for="email">Email</label></td>
                <td><input type="text" name="email" id="email" value="$_POST[email]" size="20" /></td>
				</tr>
				<tr>
					<td><label for="race">Race category:</label></td>
					<td>
ENDBLOCK;
/* now print race choice in dropdown */
            echo "<select name='race' id='race'>";
                        
            $race_values = array("---","full","half","five");
            foreach($race_values as $item) {
                echo "<option value='$item'";
                if($item == $_POST[race])
                    echo " selected";
                echo ">$item</option>";
                }
print <<<ENDBLOCK
           </select></td>
		   <td><label for="experience">Experience Level:</label></td>
			<td>
ENDBLOCK;
/* now print experience choice in dropdown */
            echo "<select name='experience' id='experience'>";
                        
            $experience = array("---","expert","experienced","novice");
            foreach($experience as $item1) {
                echo "<option value='$item1'";
                if($item1 == $_POST[experience])
                    echo " selected";
                echo ">$item1</option>";
                }
print <<<ENDBLOCK
           </select></td>
		   <td><label for="category">Category:</label></td>
			<td>
ENDBLOCK;
/* now print category choice in dropdown */
            echo "<select name='category' id='category'>";
                        
            $category = array("---","teen","adult","senior");
            foreach($category as $item2) {
                echo "<option value='$item2'";
                if($item2 == $_POST[category])
                    echo " selected";
                echo ">$item2</option>";
                }
print <<<ENDBLOCK
            </select></td>
				</tr>
                <tr>		
                    <td><label for="medical">Medical Conditions:</label></td>
					<td><textarea name="medical" value="$_POST[medical]" rows="7" cols="28"></textarea></td>                    
                </tr>
				<tr>
					<td>Image:</td>
					<td><input type="file" id="picture" name="file" /></td>
				</tr>
            </table>   
	</fieldset> 
ENDBLOCK;
}
function write_error_msg($msg){
	header_write();
	write_htmlpage();
	echo "<h3>Sorry, an error occurred. $msg</h3>";
	footer();
}
function footer(){
print <<<ENDBLOCK
		<div id="button_panel">  
            <input type="reset" value="Clear Data" class="button" />
            <input type="submit" value="Submit Data"  class="button" /> 
        </div> 
		<br/>
	</form>
		</div>
</body>
</html>
ENDBLOCK;
}
function  validate(){
########################Storing parameters############################
######################################################################

	global $bad_chars;
    $params = array();
    $params[] = trim(str_replace($bad_chars, "",$_POST['fname']));//0
	$params[] = trim(str_replace($bad_chars, "",$_POST['lname']));//1
	$params[] = trim(str_replace($bad_chars, "",$_POST['mname']));//2
	$params[] = $_POST['gender'];//3
	$m = $_POST['month'];
	$d = $_POST['day'];
	$y = $_POST['year'];
	$dob = $m."-".$d."-".$y;//
    $params[] = trim(str_replace($bad_chars, "",$_POST['address1']));//5
	$params[] = trim(str_replace($bad_chars, "",$_POST['address2']));//6
    $params[] = trim(str_replace($bad_chars, "",$_POST['city']));//7
    $params[] = trim(str_replace($bad_chars, "",$_POST['state']));//8
    $params[] = trim(str_replace($bad_chars, "",$_POST['zip']));//9
	$params[] = trim(str_replace($bad_chars, "",$_POST['phone']));//10
    $params[] = trim(str_replace($bad_chars, "",$_POST['email']));//11
	$params[] = $_POST['race'];//12
	$params[] = $_POST['experience'];//13
	$params[] = $_POST['category'];//14
	$params[] = $_POST['medical'];//15
	$fileName = $_FILES['file']['name'];//16

############################ Validating################################

	$msg = "";
    if(strlen($params[0]) == 0)
        $msg .= "Please enter the your first name<br />"; 
	if(strlen($params[1]) == 0)
        $msg .= "Please enter the Last name<br />";
	if((strlen($m) == 0) && (strlen($d) == 0) && (strlen($y) == 0))
        $msg .= "Please enter your date of birth<br />";
    if(strlen($params[4]) == 0)
        $msg .= "Please enter the address<br />"; 
    if(strlen($params[6]) == 0)
        $msg .= "Please enter the city<br />"; 
    if(strlen($params[7]) == 0)
        $msg .= "Please enter the state<br />";                        
    if(strlen($params[8]) == 0)
        $msg .= "Please enter the zip code<br />";
    elseif(!is_numeric($params[8])) 
        $msg .= "Zip code may contain only numeric digits<br />";
	if(strlen($params[9]) == 0)
        $msg .= "Please enter the Phone number<br />";
    elseif(!is_numeric($params[9])) 
        $msg .= "Phone number may contain only numeric digits<br />";
    if(strlen($params[10]) == 0)
        $msg .= "Please enter email<br />";
    elseif(!filter_var($params[10], FILTER_VALIDATE_EMAIL))
        $msg .= "Your email appears to be invalid<br/>";    
    if($msg) {
        write_error_msg($msg);
        exit;
}
}
?>

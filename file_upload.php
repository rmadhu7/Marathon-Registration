<!-- Uploading image and form details into database -->
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
<div id="confirmation">

<?php
###############Image Upload###################################
####################################################################
    $UPLOAD_DIR = 'proj3pics/';
    $COMPUTER_DIR = '/home/jadrn041/public_html/proj3/proj3pics/';
    $fileName = $_FILES['file']['name'];
    $bad_chars = array('$','%','?','<','>','php');

    if(file_exists("$UPLOAD_DIR".$fileName))  {
        echo "<b>Error, the file $fileName already exists on the server</b><br />\n";
        }
    elseif($_FILES['file']['error'] > 0) {
    	$err = $_FILES['file']['error'];	
        echo "Error Code: $err ";
	if($err == 1)
		echo "The file was too big to upload, the limit is 2MB<br />";
        } 
    elseif(exif_imagetype($_FILES['file']['tmp_name']) != IMAGETYPE_JPEG) {
        echo "ERROR, not a jpg file<br />";   
        }
## file is valid, copy from /tmp to your directory.        
    else { 
        move_uploaded_file($_FILES['file']['tmp_name'], "$UPLOAD_DIR".$fileName);
    }  
######################Database connection#############################
#####################################################################

	$server = "opatija.sdsu.edu:3306";
    $user = "jadrn041";
    $password = "pamphlet";
    $database = "jadrn041";   
	$db = mysqli_connect($server, $user, $password, $database);
    if(!$db) {
        echo "SQL ERROR: Connection failed:" .mysqli_error($db);
        }
	else{
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
################# Duplicate check##############

$sql = "SELECT * FROM person WHERE email = '$params[10]';";
##echo "The SQL statement is ",$sql;    
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) > 0) {
        write_error_msg('This record appears to be a duplicate');
        exit;
        }
		
#########################Inserting into database##########################
##########################################################################
	else{
		$sql = "INSERT INTO person (fname,mname,lname,gender,dob,address1,address2,city,state,zipcode,phoneno,email,race,experience,category,medical,image) VALUES('$params[0]','$params[2]','$params[1]','$params[3]','$dob','$params[4]','$params[5]','$params[6]','$params[7]','$params[8]','$params[9]','$params[10]','$params[11]','$params[12]','$params[13]','$params[14]','$fileName')";  
		mysqli_query($db,$sql);
		}
	}
	mysqli_close($db);
	
###########################################################################
############################Confirmation###################################
print <<<ENDBLOCK
	<h2>$params[0] $params[1], Thank you for registering!</h2>
	<h3> Confirmation details:</h3><br/>
	<h4><table id="confirm">
		<tr><td>Gender: $params[3]</td></tr>
		<tr><td>Date Of birth: $dob</td></tr>
		<tr><td>Phone number: $params[9]</td></tr>
		<tr><td>Email: $params[10]</td></tr>
		<tr><td>Race category: $params[11]</td></tr>
	</table></h4>	
ENDBLOCK;
    ?>       
<img src= "Images/goodluck.png" alt= "Goodluck" width="150px"/>
<h4 align="center"> Please contact us incase of any discrepancy in the Registration. Thank you<br/> Contact us: sdsumarathon@sdsu.edu<br/> Phone- 858-777-7777</h4>
</div>
</body>
</html>     
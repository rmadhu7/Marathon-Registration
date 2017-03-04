<?php

$bad_chars = array('$','%','?','<','>','php');

function check_post_only() {
if(!$_POST) {
    write_error_page("This scripts can only be called from a form.");
    exit;
    }
}

function write_error_page($msg) {
    write_header();
    echo "<h2>Sorry, an error occurred<br />",
    $msg,"</h2>";
    write_footer();
    }
    
function write_header() {
print <<<ENDBLOCK
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;
    charset=iso-8859-1" />
    <title>SDSU Marathon</title>
	<link rel="stylesheet" type="text/css" href="index.css" />
	<link rel="stylesheet" type="text/css" href="register.css" />
    
</head>
<body>
<div id="container">
	<h2>Registration</h2>    
ENDBLOCK;
}

function write_footer() {
    echo "</div></body></html>";
    }
    
function get_db_handle() {            
    $server = 'opatija.sdsu.edu:3306';
    $user = 'jadrn041';
    $password = 'pamphlet';
    $database = 'jadrn041';   
	$db = mysqli_connect($server, $user, $password, $database);
    if(!($db = mysqli_connect($server, $user, $password, $database))) {
        write_error_page('SQL ERROR: Connection failed: '.mysqli_error($db));
        }

    return $db;
    }        
       
function close_connector($db) {
    mysqli_close($db);
    }
    
?>

/*Form validation */
$(document).ready( function() {
	$('input[name="fname"]').focus();
	/*$('[name="file"]').on('blur', function() {
		var handle = document.getElementById("picture");
		alert(handle.value);
	});	*/
	$(':submit').on('click', function() {
		return validateForm();
        });
    
    });
    

function validateDate() {
    var day = document.getElementById("d").value; 
    var month = document.getElementById("m").value;
    var year = document.getElementById("y").value;

    var checkDate = new Date(year, month-1, day);    
    var checkDay = checkDate.getDate();
    var checkMonth = checkDate.getMonth()+1;
    var checkYear = checkDate.getFullYear();
	
	var today = new Date();
    var nowyear = today.getFullYear();
	var age = nowyear-year;
    if(day == checkDay && month == checkMonth && year == checkYear)
        return true;
    else
        return false;        
        } 
		
function isEighteen(){
	var year = document.getElementById("y").value;
	var day = document.getElementById("d").value; 
    var month = document.getElementById("m").value;
	
	var today = new Date();
    var nowyear = today.getFullYear();
	
	var age = nowyear-year;
	if(age > 18)
		return true;
	else if(age = 18){
		if(month = 12)
		{
			if(day > 4)
				return false;
		}
		else 
			return true;
	}
	else
		return false;
}		
function validateForm() {
    var a = document.forms["personal"]["fname"].value;
	var b = document.forms["personal"]["lname"].value;
	var d = validateDate();
	var n = isEighteen();
	var e = document.forms["personal"]["address1"].value;
	var f = document.forms["personal"]["city"].value;
	var g = document.forms["personal"]["state"].value;
	var h = document.forms["personal"]["zip"].value;
	var i = document.forms["personal"]["phone"].value;
	var l = document.forms["personal"]["email"].value;
	var m = document.forms["personal"]["race"].value;
	
    if (a == null || a == "") {
        document.getElementById("message_line").innerHTML = "Please enter your first name";
		document.personal.fname.focus();
        return false;
    }
	if (b == null || b == "") {
        document.getElementById("message_line").innerHTML = "Please enter your Last name";
		document.personal.lname.focus();
        return false;
    }
	if (d === false){
		document.getElementById("message_line").innerHTML = "Invalid date";
		document.personal.month.focus();
        return false;
	}
	if (n === false){
		document.getElementById("message_line").innerHTML = "You must be minimum of 18 years to enter the marathon";
		document.personal.month.focus();
        return false;
	}
	if((document.personal.gender[0].checked == false) && (document.personal.gender[1].checked == false)){
		document.getElementById("message_line").innerHTML = "Please select gender";
        return false;
	}
	if (e == null || e == "") {
        document.getElementById("message_line").innerHTML = "Please enter your address";
		document.personal.address1.focus();
        return false;
    }
	if (f == null || f == "") {
        document.getElementById("message_line").innerHTML = "Please enter the city";
		document.personal.city.focus();
        return false;
    }
	if (g == null || g == "") {
        document.getElementById("message_line").innerHTML = "Please enter the state";
		document.personal.state.focus();
        return false;
    }
	if( h == null || h == "" )
    {
        document.getElementById("message_line").innerHTML = "Please enter zipcode";
		document.personal.zip.focus();
        return false;
    }
	if( isNaN(h) || h.length != 5 ){
		document.getElementById("message_line").innerHTML = "Please input numbers in zipcode field of length 5";
		document.personal.zip.focus();
        return false;
	}
		if( i == null || i == "" )
    {
        document.getElementById("message_line").innerHTML = "Please enter your Phone number";
		document.personal.phone.focus();
        return false;
    }
	if( isNaN(i) || i.length != 10){
		document.getElementById("message_line").innerHTML = "Phone number should be 10 digit numbers";
		document.personal.phone.focus();
        return false;
	}
	
	if (l == null || l == "") {
        document.getElementById("message_line").innerHTML = "Please enter your email address";
		document.personal.email.focus();
        return false;
    }
	if ( m == "nada")
    {
        document.getElementById("message_line").innerHTML = "Please select the race category";
		document.personal.race.focus();
        return false;
    }
	
}
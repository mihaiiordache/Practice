<!DOCTYPE HTML>
<!-- Website Template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Help Me!</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style2.css?v=2" type="text/css">
        <script>
    function validateForm() {
    //alert( document.forms["registration_form"]["firstname"].value.trim());
    var x=document.forms["login_form"]["username"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Username must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["login_form"]["password"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Password must be filled out and it cannot contain any special characters!");
        return false;
    }
    if(x.length<7||x.length>30){
        alert ("Your password cannot be shorter than 6 characters and longer than 30 characters!");
        return false;
    }
    var confirmedPAssword=document.forms["login_form"]["password2"].value.trim();
    if(x.localeCompare(confirmedPAssword)){
        alert("Password is not confirmed. Please, be sure that password confirmation match your password!");
        return false;
    }
    return true;
}
</script>
</head>
<body>
	<div id="header">
		<img src="<?php echo base_url(); ?>images/mountains.jpg" alt="">
	</div>
	<div id="content" >
		<ul>
			<input type="text" name="search" placeholder="Search.." id="search">
			<a href="<?php echo base_url(); ?>index.php/Create_account/index"><figure class="profile" id="profile1">
				<p id="create"> Create your profile</p>
			</figure></a>
			<figure class="profile" id="profile2">
                            <form action="<?php echo base_url(); ?>index.php/Home/checkLogin" method="post" name="login_form" onsubmit="return validateForm()">
				<p id="usernamelabel">Username <input id="username" type="text" name="username"> </p>
				<p id="passwordlabel">Password <input id="password" type="password" name="password"></p>
				
                                    <input id="login" type="submit" value= "Log in" name="login">
                                   
                            </form>
			</figure>
		</ul>
	</div>
</body>
</html>
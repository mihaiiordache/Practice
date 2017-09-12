<script>
    function validateForm() {
    //alert( document.forms["registration_form"]["firstname"].value.trim());
    var x = document.forms["registration_form"]["firstname"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Firstname must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["surname"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Surname must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["postcode"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Post code must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["address"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Address must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["city"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("City must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["email"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Email must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["username"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Username must be filled out and it cannot contain any special characters!");
        return false;
    }
    var x=document.forms["registration_form"]["password"].value.trim();
    if (x == ""||!(!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(x))) {
        alert("Password must be filled out and it cannot contain any special characters!");
        return false;
    }
    if(x.length<7||x.length>30){
        alert ("Your password cannot be shorter than 6 characters and longer than 30 characters!");
        return false;
    }
    var confirmedPAssword=document.forms["registration_form"]["password2"].value.trim();
    if(x.localeCompare(confirmedPAssword)){
        alert("Password is not confirmed. Please, be sure that password confirmation match your password!");
        return false;
    }
    return true;
    

}
</script>
     
		<div id="personaldetails">	
                   
			<p class="subtitle">Personal details</p>
                        <form action="<?php echo base_url(); ?>index.php/Create_account/createProfile" method="post" enctype="multipart/form-data" name="registration_form" onsubmit="return validateForm()">
                            
				<div id="photo">
                                    <input type="file" id="input" name="myfile"/>
                                    <canvas id="profilepic"/>
                                <script>
                                    var URL = window.webkitURL || window.URL;

                                    window.onload = function() {
                                        var input = document.getElementById('input');
                                        input.addEventListener('change', handleFiles, false);
                                    }

                                    function handleFiles(e) {
                                    var ctx = document.getElementById('profilepic').getContext('2d');
                                    var url = URL.createObjectURL(e.target.files[0]);
                                    var img = new Image();
                                    img.onload = function() {
                                         ctx.drawImage(img, 0, 0, img.width,    img.height,     // source rectangle
                                                                0, 0, profilepic.width, profilepic.height);    
                                     }
                                    img.src = url;
    
         
}

                                </script>
                               
				</div>
				<div id="details">
				
					<p class="label">First name 	 <input id="firstname" type="text" name="firstname"></input></p>
					<p class="label">Surname  <input id="surname" type="text" name="surname"></input></p>
					<p class="label">Telephone  <input id="telephone" type="text" name="telephone"></input></p>
					<p class="label">Post code  <input id="postcode" type="text" name="postcode"></input></p>
					<p class="label">Address  <input id="address" type="text" name="address"></input></p>
					<input id="address2" type="text" name="address2"></input> <br><br>
					<input id="address2" type="text" name="address3"></input>
					<p class="label">City  <input id="city" type="text" name="city"></input></p>
					<p class="label">Email  <input id="email" type="email" name="email"></input></p>
					<p class="label">Username  <input id="username" type="text" name="username"></input></p>
                                         <span id = "username_status"> </span>
					<p class="label">Password  <input id="password" type="password" name="password"></input></p>
					<p class="label">Confirm password  <input id="password2" type="password" name="password2"></input></p>
					<p class="label">Gender <select id="gender" name="gender">
												<option value="none">Choose...</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select> </p>
					<p class="label">Date of birth  <input id="dateofbirth" type="date" name="dateofbirth"></input></p>
				</div>
		</div>
		<div id="skills">
			<p class="subtitle">Skills</p>
                        <p id="labelskills"><strong>Main skills:</strong><br>
 
                                <?php
                                        $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
                                        $user = 'root';
                                        $password = '';

                                        $dbHandler = new PDO($dsn, $user, $password);
                                        $query = "select * from skills ORDER BY SUBSTR( title, 1, 1 )";
                                        $result = $dbHandler->query($query);
                                        $i=0;
                                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {  
                                           // print_r($row);
                                            $valueInput = str_replace(' ', '', $row['title']);
                                            $i++;
                                ?>
                                <input type="checkbox" name="<?php echo $valueInput ?>" value="<?php echo $row['id'] ?>"> <?php echo " ".$row['title'];
                                if($i%5==0) echo "<br>";
                               ?>
                                <?php
                                        }
                                        $dbHandler=null;
                                ?>
								</p>
			
                                <p id="labelskills"><strong>Secondary skills:</strong><br>
 
                                <?php
                                        $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
                                        $user = 'root';
                                        $password = '';

                                        $dbHandler = new PDO($dsn, $user, $password);
                                        $query = "select * from skills ORDER BY SUBSTR( title, 1, 1 )";
                                        $result = $dbHandler->query($query);
                                        $i=0;
                                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {  
                                           $valueInput = str_replace(' ', '', $row['title']);
                                            $i++;
                                ?>
						 <input type="checkbox" name="<?php echo $valueInput."_secondary" ?>" value="<?php echo $row['id'] ?>"> <?php echo " ".$row['title'];
                                                 if($i%5==0) echo "<br>";
                               ?>
									
                                <?php
                                        }
                                        $dbHandler=null;
                                ?>
                                
                                
								</p>
 



                                
                        <br><br><br><br>
                               
			<input id="savedetails" class="sbtn" type="submit" name="submitBtn" value="Save" ></input>
			</form>
		</div>
	</div>

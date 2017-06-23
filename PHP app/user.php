<?php

class user extends CI_Model {

        public $firstname;
        public $surname;
        public $email;
        public $telephone;
        public $address;
        public $city;
        public $postcode;
        public $username;
        public $password;
        public $gender;
        public $dateOfBirth;
        public $photo;

        public function createProfile($userObj,$photo)
        {
            $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
            $user = 'root';
            $password = '';

            $dbHandler = new PDO($dsn, $user, $password);
           
            $address=$userObj['address'].$userObj['address2'].$userObj['address3'];
            $firstname=$userObj['firstname'];
            $surname=$userObj['surname'];
            $telephone=$userObj['telephone'];
            $postcode=$userObj['postcode'];
            $city=$userObj['city'];
            $email=$userObj['email'];
            $username=$userObj['username'];
            //$passwordHash=$userObj['password'];
            $dateofbirth=$userObj['dateofbirth'];
            $gender=$userObj['gender'];
            
            $photoName=$photo['name'];
            $queryCheckUsername="select username from users where username='".$username."'";
            $resultCheckUsername=$dbHandler->query($queryCheckUsername);
            $checkUsernameOrEmail=0;
            $rows=0;
            while($rowCheckUsername=$resultCheckUsername->fetch(PDO::FETCH_ASSOC)){
                 $rows++;
               //  echo $resultCheckUsername['username'];
            }
            if($rows>0){
                  $rows;
                  $checkUsernameOrEmail=1;
                }
            
             $queryCheckEmail="select email from users where email='".$email."'";
            $resultCheckEmail=$dbHandler->query($queryCheckEmail);
            $rows=0;
            while($rowCheckEmail=$resultCheckEmail->fetch(PDO::FETCH_ASSOC)){
                $rows++;
               // echo $resultCheckUsername['email'];
            }
            if($rows>0){
                   $rows;
                   $checkUsernameOrEmail=1;
                }
            
            if($checkUsernameOrEmail==0){
            $query = "INSERT INTO users VALUES (null,'".$firstname."','".$surname."','".$telephone."','".$postcode."','".$address."','".$city."','".$email."','"
              . $username."','','".$gender."','".$dateofbirth."','".$photoName."',1,1)";
            $dbHandler->exec($query);
            $passwordHash=$this->getHash();
            $query="UPDATE users SET password='".$passwordHash."' WHERE username='".$username."'";
             $dbHandler->exec($query);
             
             
            $queryGetIdUser="select id from users where username='".$username."'";
             //$dbHandler->exec($queryGetIdUser);
             $result = $dbHandler->query($queryGetIdUser);
             while($rowIdUser = $result->fetch(PDO::FETCH_ASSOC)) {
                 $idUser=$rowIdUser['id'];
             };
             $querySkills="select * from skills ORDER BY SUBSTR( title, 1, 1 )";
            // $dbHandler->exec($query);
             $result = $dbHandler->query($querySkills);
             $skillsSet=false;
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {  
                                           $valueInput = str_replace(' ', '', $row['title']);
                                           
                                           if(isset($_POST[$valueInput])&& 
                                                    $_POST[$valueInput] == $row['id'] ) {
                                                        $skillsSet=true;
                                                        $idSkill=$row['id'];
                                                        $queryAddSkills="INSERT INTO users_skills VALUES(null,$idUser,$idSkill,'main')";
                                                        $dbHandler->exec($queryAddSkills);
              }
                                           if(!isset($_POST[$valueInput])) {
                                               if(isset($_POST[$valueInput."_secondary"]) ){
                                                         $skillsSet=true;
                                                        $idSkill=$row['id'];
                                                        $queryAddSkills="INSERT INTO users_skills VALUES(null,$idUser,$idSkill,'secondary')";
                                                        $dbHandler->exec($queryAddSkills);
                                               }
                                           }
              
                }
                
                if($skillsSet==false){
                    $query="UPDATE users SET contributing=0 WHERE username='".$username."'";
                    $dbHandler->exec($query);
            }}
            else {
                echo "Username or email already existing!";
            }
                 $dbHandler=null;
        }
        
        public function logIn($username, $passwordUser){
            $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
            $user = 'root';
            $password = '';

            $dbHandler = new PDO($dsn, $user, $password);
            $query = "SELECT  id,username,
                        password FROM users WHERE username = '" .
            $username . "'";
            $result = $dbHandler->query($query);
            //verify the password of all the usernames
            $found = false;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                if(  password_verify($passwordUser,$row['password']) ) {
                    $found = true;
                    session_start();
                   $_SESSION['id_user']=$row['id'];
                    $_SESSION['logged_in']=true;
                    break;
            }else {
               session_start();
               $_SESSION['logged_in']=false;
            }
}
         $dbHandler=null;
        }
        
          public function getHash(){
            
               $encrypt_pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
               return $encrypt_pass;
         }
         
        
        
        public function updateProfile($userObj,$photo)
        {
            $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
            $user = 'root';
            $password = '';

            $dbHandler = new PDO($dsn, $user, $password);
           
            $address=$userObj['address'].$userObj['address2'].$userObj['address3'];
            $firstname=$userObj['firstname'];
            $surname=$userObj['surname'];
            $telephone=$userObj['telephone'];
            $postcode=$userObj['postcode'];
            $city=$userObj['city'];
            $email=$userObj['email'];
            $username=$userObj['username'];
            //$passwordHash=$userObj['password'];
            $dateofbirth=$userObj['dateofbirth'];
            $gender=$userObj['gender'];
            
            $photoName=$photo['name'];
            
                if(!isset($_SESSION)){
                    session_start();
                }
            $query = "update users set first_name='".$firstname."',surname='".$surname."',telephone='".$telephone."',postcode='".$postcode."',address='".$address
                    ."',city='".$city."',email='".$email."',gender='".$gender."',date_of_birth='".$dateofbirth."',photo='".$photoName."' where id=".$_SESSION['id_user'];
            $dbHandler->exec($query);
            $passwordHash=$this->getHash();
            $query="UPDATE users SET password='".$passwordHash."' WHERE username='".$username."'";
             $dbHandler->exec($query);
             
             
            $queryGetIdUser="select id from users where username='".$username."'";
             //$dbHandler->exec($queryGetIdUser);
             $result = $dbHandler->query($queryGetIdUser);
             while($rowIdUser = $result->fetch(PDO::FETCH_ASSOC)) {
                 $idUser=$rowIdUser['id'];
             };
             $querySkills="select * from skills ORDER BY SUBSTR( title, 1, 1 )";
            // $dbHandler->exec($query);
             $result = $dbHandler->query($querySkills);
             $skillsSet=false;
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {  
                                           $valueInput = str_replace(' ', '', $row['title']);
                                           
                                           if(isset($_POST[$valueInput])&& 
                                                    $_POST[$valueInput] == $row['id'] ) {
                                                        $skillsSet=true;
                                                        $idSkill=$row['id'];
                                                        $queryAddSkills="INSERT INTO users_skills VALUES(null,$idUser,$idSkill,'main')";
                                                        $dbHandler->exec($queryAddSkills);
              }
                                           if(!isset($_POST[$valueInput])) {
                                               if(isset($_POST[$valueInput."_secondary"]) ){
                                                         $skillsSet=true;
                                                        $idSkill=$row['id'];
                                                        $queryAddSkills="INSERT INTO users_skills VALUES(null,$idUser,$idSkill,'secondary')";
                                                        $dbHandler->exec($queryAddSkills);
                                               }
                                           }
              
                }
                
                if($skillsSet==false){
                    $query="UPDATE users SET contributing=0 WHERE username='".$username."'";
                    $dbHandler->exec($query);
            }
            
                 $dbHandler=null;
        }
        

}


<?php

Class job extends CI_Model {

        public $title;
        public $address;
        public $city;
        public $county;
        public $startDate;
        public $endDate;
        public $description;
       
        
        public function addJob($job){
             $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
            $user = 'root';
            $password = '';

            $dbHandler = new PDO($dsn, $user, $password);
           
            $address=$job['address']." ".$job['address2']." ".$job['address3'];
            $title=$job['title'];
            $city=$job['city'];
            $county=$job['county'];
            $startDate=$job['dateandtime'];
            $endDate=$job['dateandtime2'];
            $description=$job['description'];
            if(!isset($_SESSION)){                session_start();
            }
            $idUser=$_SESSION['id_user'];
            $dateOfUpload=date("y:m:d");
            //$dateOfUpload= mdate($datestring);
            $this->load->helper('date');
            $datestring = ' %Y %m  %d - %h:%i %a';
$time = time();
echo  mdate($dateOfUpload, $time);
           // $dateOfUpload= now();
            $query = "INSERT INTO jobs VALUES (null,'".$title."',".$idUser.",'".$dateOfUpload."','".$city."','".$county."','".$startDate."','".$endDate."','".$description."','".$address."')";
            $dbHandler->exec($query);
            
              $queryGetIdJob="SELECT id FROM jobs where id_user='".$idUser."' ORDER BY id DESC LIMIT 1;";
             //$dbHandler->exec($queryGetIdUser);
             $result = $dbHandler->query($queryGetIdJob);
             while($rowIdJob = $result->fetch(PDO::FETCH_ASSOC)) {
                 $idJob=$rowIdJob['id'];
             };
             $querySkills="select * from skills ORDER BY SUBSTR( title, 1, 1 )";
            // $dbHandler->exec($query);
             $result = $dbHandler->query($querySkills);
             //$skillsSet=false;
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {  
                                           $valueInput = str_replace(' ', '', $row['title']);
                                           
                                           if(isset($_POST[$valueInput])&& 
                                                    $_POST[$valueInput] == $row['id'] ) {
                                                        //$skillsSet=true;
                                                        $idSkill=$row['id'];
                                                        $queryAddSkills="INSERT INTO job_skills VALUES(null,$idJob,$idSkill)";
                                                        $dbHandler->exec($queryAddSkills);
              }
                                           
                                           
              
                }
                
                
            $dbHandler=null;
        }
        
        
        public function delete($jobID){
             $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
                                        $user = 'root';
                                        $password = '';

                                        $dbHandler = new PDO($dsn, $user, $password);
                                        echo $query = "DELETE FROM jobs WHERE id = ".$jobID;
                                        $result = $dbHandler->query($query);
                                        $dbHandler=null;
        }
}

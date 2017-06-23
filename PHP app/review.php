<?php

Class review extends CI_Model {
    
     public function addReview($review){
           $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
            $user = 'root';
            $password = '';
            echo $review['id_user_giving'];
            echo $review['id_user_receiving'];
            $dbHandler = new PDO($dsn, $user, $password);
       $query = "INSERT INTO reviews VALUES (null,'".$review['title']."',".$review['id_user_giving'].",".$review['id_user_receiving'].",'".$review['message']."',".$review['rating'].")";
            $dbHandler->exec($query);
     }   
}

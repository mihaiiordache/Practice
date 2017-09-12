<div id="wrap">
<div id="jobs">
<?php
        $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
        $user = 'root';
        $password = '';
        $dbHandler = new PDO($dsn, $user, $password);
        $query = "select * from users where id=".$_GET['id'];
        $result = $dbHandler->query($query);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    ?>
    <div id="user_profile_div">
        <div id="user_profile_pic_div">
            <?php
            $image=$row['photo'];
             $dir= base_url()."images/".$image;
             echo '<img id="user_photo_profile" src="'. $dir. '" >';
             ?>
        </div>
        <div id="user_details_div">
            <br>
            <?php 
            $queryAverageRating = "select rating from reviews where id_user_receiving=".$_GET['id'];
            $resultAR = $dbHandler->query($queryAverageRating);
            $sum=0;
            $rows=0;
                    while($rowAR = $resultAR->fetch(PDO::FETCH_ASSOC)){
                        $sum=$sum+$rowAR['rating'];
                        $rows++;
                    
                    }
             $rating=$sum/$rows;
            echo "<p id='user_details_paragraphs'>". $row['first_name']." ".$row['surname']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$rating."/5</strong></p>";
            ?>
       
            
            
            <?php 
            echo "<p id='user_details_paragraphs'>Telephone: ". $row['telephone']."</p>";
            ?>
            
            <?php 
            echo "<p id='user_details_paragraphs'>Email: ". $row['email']."</p>";
            ?>
            
            <?php 
            echo "<p id='user_details_paragraphs'>Gender: ". $row['gender']."</p>";
            ?>
            
            <?php 
            $age=date("Y/m/d")-$row['date_of_birth'];
            echo "<p id='user_details_paragraphs'>Age: ". $age."</p>";
            ?>
        </div>
        <?php
        
        echo "Main skills: ";
         $queryUserSkills = "select * from users_skills where id_user=".$_GET['id']." and type='main'";
        $resultUserSkills = $dbHandler->query($queryUserSkills);
                   while( $rowUserSkills = $resultUserSkills->fetch(PDO::FETCH_ASSOC)){
                        $querySkill = "select * from skills where id=".$rowUserSkills['id_skill'];
                         $resultSkill = $dbHandler->query($querySkill);
                         while ($rowSkill = $resultSkill->fetch(PDO::FETCH_ASSOC)){
                             
                         
                         echo $rowSkill['title']."; ";
                         
                         }
                   };
        echo "<br> Secondary skills: ";
        $queryUserSkills = "select * from users_skills where id_user=".$_GET['id']." and type='secondary'";
        $resultUserSkills = $dbHandler->query($queryUserSkills);
                   while( $rowUserSkills = $resultUserSkills->fetch(PDO::FETCH_ASSOC)){
                        $querySkill = "select * from skills where id=".$rowUserSkills['id_skill'];
                         $resultSkill = $dbHandler->query($querySkill);
                         while ($rowSkill = $resultSkill->fetch(PDO::FETCH_ASSOC)){
                             
                         
                         echo $rowSkill['title']."; ";
                         
                         }
                   };
        $dbHandler=null;
        ?>
    </div>
    <div id="review">
        <p id="review_title">You can write a review for this user here:</p>
       
        <form action="<?php echo base_url(); ?>index.php/Main_page/addReview" method="post">
             <p id="rating" >Rating: 
        <input type="radio" name="rating" value="1"> 1
        <input type="radio" name="rating" value="2"> 2
         <input type="radio" name="rating" value="3"> 3
         <input type="radio" name="rating" value="4"> 4
         <input type="radio" name="rating" value="5"> 5</p> 
         <br><br>
         <p id="rating">Title
             <input type="text" name="title"></input></p>
         <br><br>
        <textarea id="review_message" name="message"></textarea>
        <input type="text" hidden name="id_user_receiving" value="<?php echo $_GET['id'] ?>"></input>
        <input type="text" hidden name="id_user_giving" value="<?php echo $_SESSION['id_user'] ?>"></input>
        <input id="review_button_submit"  type="submit" value="Post"></input><br><br>
        </form>
    </div>
    <div id="reviews_list">
        <?php
         $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
        $user = 'root';
        $password = '';
        $dbHandler = new PDO($dsn, $user, $password);
        $query_review = "select * from reviews where id_user_receiving=".$_GET['id'];
        $result_reviews = $dbHandler->query($query_review);
                    while($row_reviews = $result_reviews->fetch(PDO::FETCH_ASSOC)){
                         $query_review_user_giving = "select first_name, surname from users where id=".$row_reviews['id_user_giving'];
                         $result_reviews_user_giving = $dbHandler->query($query_review_user_giving);
                         while( $row_reviews_user_giving = $result_reviews_user_giving->fetch(PDO::FETCH_ASSOC)){
        
                                  echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$row_reviews['title']."</strong>";
                                 echo "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$row_reviews['rating']."/5";
                                 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; by ".$row_reviews_user_giving['first_name']." ";
                                 echo $row_reviews_user_giving['surname'];
                                 echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row_reviews['message']."<br>";}}
            $dbHandler=null;
        ?>
    </div>
    
</div>
<div id="sidebar">
                    <br>
                    <a href="<?php echo base_url(); ?>index.php/Main_page/index" id="button">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/home.png" alt="">Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Add_jobs/index" id="button">
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ask for help&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Update_profile/index" id="button">
                         &nbsp;Your contributions&nbsp;
                    </a><br><br>
                    <a href="" id="button">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your profile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Home/logout" id="button">
                       &nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp; 
                    </a><br><br>
		</div>
</div>
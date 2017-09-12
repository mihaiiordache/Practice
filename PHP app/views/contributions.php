
           

<?php
   // session_start();
    if(!isset($_SESSION)) { session_start(); }
    if($_SESSION['logged_in']==true){
    //header('Location:../Main_page/index'); 
        header('HTTP/1.1 401 Unauthorized');
    
?>

<div id="wrap">
		<div class="parallax-mirror" id="jobs" data-parallax="scroll" data-image-src="<?php echo base_url(); ?>images/logo-sec.jpg">
              
                    <br><br>
                    
                     <?php
                                        $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
                                        $user = 'root';
                                        $password = '';

                                        $dbHandler = new PDO($dsn, $user, $password);
                                        $query = "select * from jobs where id_user=".$_SESSION['id_user']." ORDER BY date_of_upload DESC";
                                        $result = $dbHandler->query($query);
                                        while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div>
                        <form action="<?php echo base_url();?>index.php/Contributions/delete" method="post">
                    <?php 
                        
                    ?>
                            <input name="id" type="text" hidden value="<?php echo $row['id'] ?>"></input>
                        <?php
                                            echo $row['description'].$row['id'];
                                            echo "<br>";
                                             echo "Address: ".$row['city'].", ".$row['county'].", ".$row['address'];
                                             
                                             ?>
                            <button id="<?php echo $row['id'] ?>" name="<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>">Delete</button>
                         </div>
                             <?php
                                             
                                        }
                                       
                                                ?>
                    <script>
                            var x = document.cookie;
                            alert(x);
                                                    <input type="hidden" name="test" value=></input>
                    </script>
                   
                   
                    
                                                    <br><br>
                    <?php
                                                
                                              echo '</div>';
                                              echo("<br>");
                                            echo("<br>");
                                            echo '</div>';
                                          
                                            echo("<br>");
                                             echo("<br>");
                                            echo("<br>");
                                            
                                            
                                        }
                                        $dbHandler=null;
                                        echo '<p hidden>If you click on the "Hide" button, I will disappear.</p>';
                                ?>
                   


                    <script>$('.parallax-window').parallax({imageSrc: '<?php echo base_url(); ?>images/logo-sec.jpg'});</script>
		</div>
		<div id="sidebar_contributions">
                    <br>
                    <form action="<?php echo base_url(); ?>index.php/Main_page/index">
                    <a href="<?php echo base_url(); ?>index.php/Main_page/index" id="button">
                         &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/home.png" alt="">Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a>
                    </form><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Add_jobs/index" id="button">
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ask for help&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Contributions/index" id="button">
                         &nbsp;Your contributions&nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Update_profile/index" id="button">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your profile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Home/logout" id="button">
                       &nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp; 
                    </a><br><br>
		</div>
        </div>
</div>
<?php
   

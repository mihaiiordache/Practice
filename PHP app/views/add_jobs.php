<?php
   
?>


<div id="wrap">	
                    <form id="form_jobs" action="<?php echo base_url(); ?>index.php/Add_jobs/addJob" method="post">
                        <p class="label_job">Title<input id="title" type="text" name="title"></input></p>
                        <p class="label_job">Address<input id="address3" type="text" name="address"></input><br><br>
                        <input id="address4" type="text" name="address2"></input><br><br>
                        <input id="address4" type="text" name="address3"></input></p>
                         <p class="label_job">City	 <input id="city2" type="text" name="city"></input></p>
                         <p class="label_job">County	 <input id="county" type="text" name="county"></input></p>
                         <p class="label_job">Date and time	 <input id="dateandtime" type="datetime" name="dateandtime"></input> 
                         to <input class="dateandtime2" type="datetime" name="dateandtime2"></input></p>
                         <p class="label_job"><strong>Skills needed:</strong> <br>
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
                        
                        <p class="label_job">Description<br><textarea rows="4" cols="50" id="description" name="description"></textarea>
                        </p>    <br>
                        <input id="post_job" type="submit" name="post_job" value="Post" ></input>
                    </form>
		<div id="sidebar">
                    <br><br><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Main_page/index" id="button">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/home.png" alt="">Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a><br><br>
                    <a href="" id="button">
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ask for help&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Contributions/index" id="button">
                         &nbsp;Your contributions&nbsp;
                    </a><br><br>
                    <a href="<?php echo base_url(); ?>index.php/Update_profile/index" id="button">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your profile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;
                    </a>
                    <br><br>
                    <a href="<?php echo base_url(); ?>index.php/Home/logout" id="button">
                       &nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp; 
                    </a>
		</div>
        </div>
</div>

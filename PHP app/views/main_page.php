        
<script>
function clickfunc(obj) {
    var t = $(obj).text();
    return t;
}

 function showJobDetail(id) {
        if(document.getElementById('job_detail_'+id).style.display=='none'){
                    //alert('job_detail_'+id);

            document.getElementById('job_detail_'+id).style.display = 'block';
        }
        else{
            document.getElementById('job_detail_'+id).style.display='none';
        }
    }
    
     function showContactForm(id) {
        if(document.getElementById('contact_form_'+id).style.display=='none'){
                    //alert('job_detail_'+id);

            document.getElementById('contact_form_'+id).style.display = 'block';
        }
        else{
            document.getElementById('contact_form_'+id).style.display='none';
        }
    }

$(function() {
    $("#contact .button").click(function() {
        
        var text = $("#messageEmail").val();
        var dataString = '&text=' + text;

        $.ajax({
            type: "POST",
            url: "email.php",
            data: dataString,
            success: function(){
            $('.success').fadeIn(1000);
            }
        });

        return false;
    });
});


 </script>
  <!--     <script>
           
           
$(document).ready(function(){
    $("#show").click(function(){
        $("p").show();
    });
});
</script> -->
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
                    <p  hidden>If you click on the "Hide" button, I will disappear.</p>
                     <?php
                                        $dsn ='mysql:host=127.0.0.1;dbname=help_me; ';
                                        $user = 'root';
                                        $password = '';

                                        $dbHandler = new PDO($dsn, $user, $password);
                                        $query = "select * from jobs ORDER BY date_of_upload DESC";
                                        $result = $dbHandler->query($query);
                                        while($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                                            $query_user="select first_name, surname, photo, email from users where id=".$row['id_user'];
                                            $result_user=$dbHandler->query($query_user);
                                            $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
                                            $image=$row_user['photo'];
                                            echo '<div id="job_div_list">';
                                            echo '<form action="'.base_url().'index.php/User_profile/index" method="get" class="submit_id_job">';
                                             echo '<input type="hidden" name="id" value="'.$row['id_user'].'"></input>';  
                                             echo '<div id="photo_job_user" >';
                                                     $dir= base_url()."images/".$image;
                                                    
                                                     echo '<img id="user_photo" src="'. $dir. '" >';
                                                     
                                             echo '</div>';
                                             echo '<div id="job_description_listing" >';
                                                echo "<pre id='title'>".($row['title'])."</pre>";
                                                echo (" Uploaded on ");
                                                echo ($row['date_of_upload'])." by "."<button id='user_profile_button'>".$row_user['first_name']." ".$row_user['surname']."</button>";
                                                echo("<br>");
                                                echo '</form>';
                                                echo("City: ").$row['city'].", ".$row['county'];
                                                echo("<br>");
                                                //$datestart=$row('start_date');
                                                $start_date = new DateTime($row['start_date']);
                                                $end_date=new DateTime($row['end_date']);
                                               // echo date_format($start_date,"Y/m/d H:i:s");
                                                echo("Start time and end time: ").(date_format($start_date,"Y/m/d H:i"))." to ".date_format($end_date,"Y/m/d H:i");
                                                echo("<br>");?>
                    <br><br><br><br><br>
                    
                    <?php
                                               
                                                echo "<button id='show' type='button' onclick='showJobDetail(".$row['id'].")'  value='".$row['id']."'>Details</button>";
                                                //echo '<p  hidden>If you click on the "Hide" button, I will disappear.</p>';
                                               // if (isset($_COOKIE[$cname])){
                                                    // echo $_COOKIE[$cvalue];
                                               // }
                                                //echo ($row['description']);
                                                ?>
                    <script>
                            var x = document.cookie;
                            alert(x);
                                                    <input type="hidden" name="test" value=></input>
                    </script>
                    <div id="job_detail_<?php echo $row['id']; ?>" style="display: none; margin-left: 150px; float:left; width: 1400px; margin-left: 200px; height: auto; border-bottom:2px solid black;">
                        <br><p id="description_div">Description:</p> <br>
                        <?php
                        $query_job = "select * from jobs where id=".$row['id'];
                       $result_job_detail = $dbHandler->query($query_job);
                       while($row_details = $result_job_detail->fetch(PDO::FETCH_ASSOC)){
                            echo $row_details['description'];
                            echo "<br>";
                            echo "Address: ".$row_details['city'].", ".$row_details['county'].", ".$row_details['address'];
                            $city=$row_details['city'];?>
                            <br><br><iframe
                             accesskey=""width="600"
                            height="450"
                             frameborder="0" style="border:0"
                             <?php
                               echo 'src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBU2_m_UsmtFuGFVG9qPzBEtK18t1rO2NE
                               &q='.$row_details['address'].", ".$city.'" allowfullscreen>'
                                       ?>
</iframe>
                      <?php  }?>
                        
                        
                        <br><br>
                        
                        <br><br>
                        <button id="contact_button" type="button" onclick="showContactForm(<?php echo $row['id'] ?>)"> Contact</button>
                        <br><br>
                       
                    </div>
                    <div id="contact_form_<?php echo $row['id']; ?>" style="display: none; margin-left: 0px;     width: 1000px;
    float: left;
    height: 500px; margin-left: 200px;">
                        <form method="post" action="<?php echo base_url();?>index.php/Home/index">
                        <br><p id="message_title">Message:</p> <br>
                        <textarea id="message_contact" name="messageEmail"></textarea><br><br>
                        <button id="send_message" type="submit" >Send</button>
                        </form>
                    </div>
                    
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
		<div id="sidebar">
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
    }
else{
    echo "You need to log in!";
}
?>

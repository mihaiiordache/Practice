<!DOCTYPE HTML>
<!-- Website Template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Help Me!</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style4.css?v=38" type="text/css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>parallax.js"></script>
        <script src="<?php echo base_url(); ?>jquery.infinitescroll.js"></script>
 <script>
    function setCookieTest(cvalue) {
        var cname = "test";
        var d = new Date();
         d.setTime(d.getTime() + (10*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
         document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    function showJobDetail(id) {
        if(document.getElementById('job_detail_'+id).style.display=='none'){
                    alert('job_detail_'+id);

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
    
    
    function handleImage(e){
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img,0,0);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);     
}
    
    function startUpload(){
        document.getElementById('uploadProcess').style.visibility='visible';
        document.getElementById('uploadForm').style.visibility='hidden';
        return true;
    }
    
    function stopUpload(success, uploadedFile){
        var result='';
        if(success==1){
            result='<span class="success-mag"The file was uploadded successufully!<\/span><br><br>';
            var embed=document.getElementById("UploadedFile");
            var clone=embed.cloneNode(true);
            clone.setAttribute('src',uploadedFile);
            embed.parentNode.replaceChild(clone,embed);
        }else{
            result='<span class="error-msg">There was an error during file upload!<\/span><br><br>';"
        }
        document.getElementById("uploadProcess").style.visibility='hidden';
        document.getElementById('uploadForm').innerHTML=result+'<label><v>File:</b>&nbsp;<input name="myfile" type="file" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
        document.getElementById('uploadForm').style.visibility='visible';
        return true;
    }
</script>

</head>
<body>
    <div id="content">
		<div id="header">
			<img src="<?php echo base_url(); ?>images/logo-sec.jpg" alt="">
		</div>
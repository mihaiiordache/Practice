<!DOCTYPE HTML>
<!-- Website Template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Help Me!</title>
</head>
<body>
	<?php echo $_POST["firstname"];?>
        <?php echo $_POST["surname"];?>
        <?php echo $_POST["address"];?>
        <?php echo $_POST["email"];?>
        <?php echo $_POST["telephone"];?>
        <?php //echo $_POST["input"];?>
 
    <?php echo base_url()."images"; ?>
    <?php
        $success=0;
        $uploadedFile='';
        $uploadPath= base_url()."images/";
        $targetPath=$uploadPath.basename($_FILES['myfile']['name']);
        if(@move_uploaded_file($_FILES['myfile'],['tmp_name'], $targetPath)){
            $success=1;
            $uploadedFile=$targetPath;
        }
        echo $targetPath;
        sleep(1);
    ?>
    <script type="text/javascript"> window.top.window.stopUpload(<?php echo $success; ?>,'<?php echo $uploadedFile; ?>');</script>
</body>
</html>
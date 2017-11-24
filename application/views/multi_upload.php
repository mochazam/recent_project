<html>
 <head>
    <title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('multi_upload/do_upload');?>

<input type="file" multiple name="userfile[]" size="20" />
<br />
<input type="file" multiple name="userfile[]" size="20" />
<br />


<input type="submit" value="upload" />

</form>

</body>
</html> 
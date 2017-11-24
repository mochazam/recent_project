<!DOCTYPE html>
<html>
<head>
	<title>Newsletter</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <style>
    .modal-content {
      position: relative;
      top: 80px;
      color: #fff;
      background-color: #e74c3c;
      -webkit-background-clip: padding-box;
              background-clip: padding-box;
      border: 1px solid #999;
      border: 1px solid rgba(0, 0, 0, .2);
      border-radius: 6px;
      outline: 0;
      -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
              box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    }
    .modal-header {
        background: rgba(0,0,0,0.1);
        min-height: 16.42857143px;
        padding: 10px;
        border-bottom: 1px solid #e74c3c;
    }
    .modal-title {
      margin: 0;
      padding: 0.4em;
      text-align: center;
      font-size: 2.4em;
      font-weight: 300;
      opacity: 0.8;
      border-radius: 3px 3px 0 0;
      line-height: 1.42857143;
    }
    .modal-footer {
      background-color: #e74c3c;
      padding: 15px;
      text-align: center;
      border-top: 1px solid #e74c3c;
    }
    .modal-body p {
        margin: 0;
        padding: 0.3em;
        text-align: center;
        font-size: 1.2em;
        font-weight: 350;   
    }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
    	<input type="text" id="news" name="news">
    	<button type="submit" id="btn-news" class="btn btn-primary">submit</button>
    </div>
</div>

<!--  Modal  -->
<!--
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Do you want to save changes you made to document before closing?</p>
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
-->
<!-- Button -->

    <!-- Button HTML (to Trigger Modal) -->
    <a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Launch Demo Modal</a>
    <!-- Modal HTML -->

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Newsletter</h4>
                </div>
                <div class="modal-body">
                    <p>Thank you for submiting you email !</p>
                    <p>You will recieve information about our product whithin a moment</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#btn-news").click(function(){
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('newsletter/subscriber');?>",
          data: {news:$("#news").val()},
          success: function(data){
            //alert(data);
            jQuery("#myModal").modal('show');
          }
        });
    });
});       
</script>

</body>
</html>    
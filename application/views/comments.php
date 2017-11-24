<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Eknowledgetree Comments Demo</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">  
  </head>
  <body>
    <?php foreach($query->result() as $row){ ?>
    <div class="panel panel-default">
      <input type="hidden" id="article" value="<?php echo $row->aticle_id;?>">
      <div class="panel-heading"><?php echo $row->title;?></div>
      <div class="panel-body"><?php echo $row->article_body;?></div>         
    </div>     
    <?php } ?>
  
    <div id="display_comment"></div>
 
    <div class="container-fluid" id="com"> 
      <h3>Leave a Comment</h3>
      <form class="form-horizontal" method="post" id="form">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
          </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" id="comment" name="comment"> </textarea>
            </div>
        </div>
         <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <input id="submit" name="submit" type="submit" value="Submit Comment" class="btn btn-primary">
            </div>
        </div>
   
      </form>  
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap.min.js"></script>
  </body>
</html>

<script>
         
  $(document).ready(function () {
   var article_id = $("#article").val();
    $.post('<?php echo base_url();?>index.php/welcome/displaycomments/',{
       article_id:article_id
    },
    function(data){                                         
		 $("#display_comment").html(data);
		});
  }); 
            
  $(function() {
    $("#submit").click(function() {
      var name = $("#name").val();
      var email = $("#email").val();
      var comment = $("#comment").val();
      var article_id = $("#article").val(); 
      var dataString = 'name='+ name + '&email=' + email + '&comment=' + comment+ '&article_id=' + article_id;
      if(name=='' || email=='' || comment==''){
        alert('Please Give Valid Details');
      } else {
        //$("#display_comment").show();
        $("#display_comment").fadeIn(100).html('<img src="<?php echo base_url();?>uploads/ajax-loader.gif" />Loading Comment...');
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>index.php/welcome/insert_comments/",
          data: dataString,
          cache: false,
          success: function(data){
            $("#display_comment").html(data);
            $("#display_comment").fadeIn(slow);
          }
        });
      }
      return false;

    });
  });

</script>
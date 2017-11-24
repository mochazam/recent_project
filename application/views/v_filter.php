<!DOCTYPE html>
<html>
<head>
    <title>Checkbox Filter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <label>Pilih:</label>
                <input type="checkbox" name="pilih[]" id="pilih" value="1" />
                &nbsp;
                <input type="checkbox" name="pilih[]" id="pilih" value="2" />
                &nbsp;
                <input type="checkbox" name="pilih[]" id="pilih" value="3" />
                &nbsp;
                <input type="checkbox" name="pilih[]" id="pilih" value="4" />
                &nbsp;
                <input type="checkbox" name="pilih[]" id="pilih" value="5" />
                &nbsp;<br />
            </div>
            
            <div class="buttons">
                <button type="submit" id="btn-news" class="btn btn-primary">submit</button>
            </div>
        </div>    
    </div>
</div>

<div id='result_table'>
 
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#btn-news').on('click', function() {
        var pilihan = $('input[type="checkbox"]:checked').val();
          $.ajax({
              type: "POST",
              url: "<?php echo site_url('filter_check/select_provinsi');?>",
              dataType: "json",
              data: {filter:pilihan},
              success: function(data){
                    $('#result_table').append(data).
                    alert(data);
              },
              error: function(){
                alert(pilihan);
              }
          });
    });
});       
</script>

</body>
</html>    

<!--

<!DOCTYPE html>
<html>
<head>
	<title>checkbox filter</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">

</head>
<body>

<div class="container">
    <div class="row">
    	<div class="well">
            	<div class="control-group">
                    <label class="control-label">Provinsi</label>
                    <div class="controls">
                        <select name="prov" id="prov" data-placeholder="Select Provinsi..." class="required chosen col-sm-12">
                            <option value=""></option>
                            <?php foreach($provinsi->result() as $bk ): ?>
                                <option value='<?php echo $bk->id?>'><?php echo $bk->name;?> </option>      
                            <?php endforeach; ?>
                        </select>
                    </div>    
                    <label class="control-label" >Checkbox</label>
                    <div class="controls">
                        <label class="checkbox">
                        	<input type="checkbox" id="21" class="checkbox" value="45" /> Checkbox 1
                        </label>
                        <label class="checkbox">
                        	<input type="checkbox" id="29" value="29" /> Checkbox 2
                        </label>
                        <label class="checkbox">
                        	<input type="checkbox" id="10" value="67" /> Checkbox 3
                        </label>
                    </div>
                    
                        
                </div>  
        </div>


    </div>
</div>

<div id='result_table'>
 
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js" ></script>

<script type="text/javascript">
	//chk_auto = $("#chkAutoRefresh").is(':checked');
    $("#prov").change(function(){
    	var provinsi_id = {provinsi_id:$("#prov").val()};
    	$.ajax({
    			type: "POST",
    			url: "<?php echo site_url('filter_check/select_provinsi');?>",
    			data: provinsi_id, 
    			success: function(data){
            		$('#result_table').text(data).
            		alert(data);
    			},
          		error: function(){
            		$('#result_table').text('Error2!').addClass('priceerror');
          		}
    	});
    });    

    $("#prov").click(function(){
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('filter_check/click_provinsi');?>",
                dataType: 'json', 
                success: function(data){
                    $('#result_table').append(data).
                    alert(data);
                },
                error: function(){
                    $('#result_table').text('Error!').addClass('priceerror');
                }
        });
    })

    $('input[type="checkbox"]').checked(function(){
        //var provinsi_id = {provinsi_id:$(this.id)};
        var option = $('input[type="checkbox"]:checked').val();
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('filter_check/select_provinsi');?>",
                data: {provinsi_id:option}, 
                success: function(data){
                    //$('#result_table').text(data).
                    alert(provinsi_id);
                },
                error: function(){
                    alert(option);
                }
        });
    });  

/*
    function getKotaFilterOptions(){
        var opts = [];
        $checkboxes.each(function(){
          if(this.checked){
            opts.push(this.id);
          }
        });
 
        return opts;
      }
 
      function updateProvinsi(opts){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('filter_check/select_provinsi');?>",
            data: {filterOpts: opts}, 
            success: function(data){
                $('#result_table').text(data).
                alert(data);
            },
            error: function(){
                $('#result_table').text('Error2!').addClass('priceerror');
            }
        });
      }

    var $checkboxes = $("input:checkbox");
      $checkboxes.on("change", function(){
        var opts = getKotaFilterOptions();
        updateProvinsi(opts);
      });  
*/      
</script>

</body>
</html>	
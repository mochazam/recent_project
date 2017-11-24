
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Ongkos Kirim</title>
<!-- Le styles -->
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<style type="text/css">
body{
  margin-top: 50px;
}
.invis {
  display: none;
}
.harga {
  font-size: 2em;
  font-weight: bold;
  color: #0197fd;
}
.priceerror{
  color: #b94a48;
}
</style>
</head>

<body>
          
    <div class="container">                      
        <div class="col-sm-12">
        
            <form novalidate="novalidate" class="form-horizontal" id="order-form" name="order-form" method="post" action="">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Provinsi</label>
                        <div class="col-sm-3">
                            <select class="form-control valid" id="cat_prof" name="cat_prof">
                               
                            </select>
                            <label class="error valid" generated="true" for="pcat"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kota/kabupaten</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="cat_kab" name="cat_kab">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kecamatan</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="cat_kec" name="cat_kec">

                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="cgharga">
                        <label class="control-label col-sm-2">Harga</label>
                        <div class="col-sm-3 harga text-success" id="harga"></div>
                    </div>               

                </fieldset>
            </form>

        </div> 
    </div>    


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>

      function loadlist(cb,data){
        cb.empty();
        if(data!=null){
          cb.append('<option value=""></option>');
          $.each(data,function(index,value){
            cb.append('<option value="'+value.id+'">'+value.name+'</option>');
          });
        }
      }

      $(document).ready(function() {
        loadlist($('#cat_prof'),dt);
        $('#cat_prof').change(function(){
          $('#cat_kab').empty();
          $('#cat_kec').empty();
          var $c=$(this);
          key=$c.val();
          $.each(dt,function(index,value){
            if(value.id==key){
              loadlist($('#cat_kab'),value.kota);
              $('#cat_kab').change(function(){
                var $v=$(this);
                vkey=$v.val();
                if(value.kota!=null){
                  $.each(value.kota,function(index,value){
                    if(value.id==vkey){
                      loadlist($('#cat_kec'),value.kecamatan);
                    }
                  });
                }
              });
            }
          });
        });

        
        
      });

      var dt = JSON.parse('<?php $this->m_ongkir->create(); ?>');
     
    </script>

<script type="text/javascript">

	$("#cat_kec").change(function(){
    var kecamatan_id = {kecamatan_id:$("#cat_kec").val()};
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('biaya_kirim/select_ongkir');?>",
			data: kecamatan_id, 
			success: function(data){
        $('#harga').text(data).
        alert(data);
			},
      error: function(){
        $('#harga').text('Error2!').addClass('priceerror');
      }
		});
	});	
</script>


</body>
</html>

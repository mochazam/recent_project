
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Bootstrap Form dinamis</title>
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
        
            <form novalidate="novalidate" class="form-horizontal" id="order-form" name="order-form" method="post" action="test.php">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Jenis Produk</label>
                        <div class="col-sm-3">
                            <select class="form-control valid" id="pcat" name="pcat">
                               
                            </select>
                            <label class="error valid" generated="true" for="pcat"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Provider</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="prov" name="prov">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="cgprod">
                        <label class="control-label col-sm-2" id="lbnominal">Nominal</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="prod" name="prod"></select>
                        </div>
                    </div>
                    <div class="form-group" id="cgharga">
                        <label class="control-label col-sm-2">Harga</label>
                        <div class="col-sm-3 harga text-success" id="harga"></div>
                    </div>
                    <div style="display: none;" class="form-group invis" id="ccustid">
                        <label class="control-label col-sm-2" id="lcustid">Nomor Meter</label>
                        <div class="col-sm-3">
                            <input class="form-control" id="custid" name="custid" placeholder="123..." type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" id="lphone">Nomor HP</label>
                        <div class="col-sm-3">
                            <input class="form-control" id="phone" name="phone" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Pembayaran Ke</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="bank" name="bank">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group invis" id="cgemail">
                        <label class="control-label col-sm-2">Email</label>
                        <div class="col-sm-3">
                            <input class="form-control" id="ecid" name="ecid" placeholder="email@gmail.com" type="text">
                        </div>
                    </div>
                    <input id="cc" name="cc" value="" type="hidden">
                    <input id="priceval" name="priceval" value="" type="hidden">

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-submit" name="btn-submit">Beli / Order</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div> 
    </div>    


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>

  function morph(val){
    $('#cgprod').show();
    $('#cgharga').show();
    $('#lbnominal').text('Nominal');
    $('#custid').val('');
    if(val==2){ // token pln
      $('#ccustid').show();
      $('#lcustid').text('Nomor Meter');
      $('#lphone').text('Nomor HP');
    }else if(val==3){ // voucher game
      $('#lphone').text('Nomor HP');
    }else if(val==4){ // tv langganan
      $('#ccustid').show();
      $('#cgharga').hide();
      $('#lcustid').text('Nomor Pelanggan');
      $('#lphone').text('Nomor HP');
      $('#lbnominal').text('Paket');
    }else if(val==5){ // tagihan bulanan
      $('#ccustid').show();
      $('#cgharga').hide();
      $('#lcustid').text('Nomor Pelanggan');
      $('#lphone').text('Nomor HP');
      $('#lbnominal').text('Produk');
    }else if(val==6){ // cicilan
      $('#ccustid').show();
      $('#cgharga').hide();
      $('#lcustid').text('Nomor Kontrak');
      $('#lphone').text('Nomor HP');
      $('#lbnominal').text('Produk');
    }else if(val==9){ // pulsa bolt
      $('#lphone').text('Nomor BOLT');
      $('#ccustid').hide();
    }else{
      $('#ccustid').hide();
    }
  }

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

    loadlist($('#bank'),dbank);
    loadlist($('#pcat'),dt);
    $('#pcat').change(function(){
      $('#prov').empty();
      $('#prod').empty();
      var $c=$(this);
      key=$c.val();
      $.each(dt,function(index,value){
        if(value.id==key){
          loadlist($('#prov'),value.provider);
          $('#prov').change(function(){
            var $v=$(this);
            vkey=$v.val();
            if(value.provider!=null){
              $.each(value.provider,function(index,value){
                if(value.id==vkey){
                  loadlist($('#prod'),value.product);
                }
              });
            }
          });
        }
      });
      morph(key);
    });

    

    $('#bank').change(function(){
      var $c=$(this);
      var key=$c.val();
      if(key==5){
        $('#cgemail').show();
      }else{
        $('#cgemail').hide();
      }
      loadPrice();
    });

    $.validator.addMethod("bcamintransfer", function(value, element) {
      if(value == 1 && $('#cgharga').css("display") != 'none'){
        if(parseInt($('#priceval').val())<10000){
          return false;
        }
      }
      return true;
    }, "Pembayaran via BCA minimal Rp10.000");

    $.validator.addMethod("phoneformat", function(value, element) {
        if($('#phone').val().substr(0,1)!='0'){
          return true;
        }
        return true;
      }, "Nomor telpon salah, gunakan awalan 0");

//    $("#phone").mask("9999 9999 99999",{placeholder:""});
    $('#order-form').validate(
      {
        rules:{
          pcat:{
            required: true
          },
          prov:{
            required: true
          },
          prod:{
            required: true
          },
          phone:{
            digits: true,
            phoneformat: true,
            minlength: 10,
            required: true
          },
          bank:{
            required: true,
            bcamintransfer: true
          },
          custid:{
            required: "#ccustid:visible"
          },
          ecid:{
            required: "#cgemail:visible",
            email: true
          }
        },
        highlight: function(label){
          $(label).closest('.control-group').addClass('error');
        },
        success: function(label){
          label
            .addClass('valid')
            .closest('.control-group').removeClass('error');
        }
      }
    );

  });

 var dt = JSON.parse('<?php $this->json_model->create(); ?>');
  var dbank = JSON.parse( '<?php $this->json_model->bank();
    ?>' );
</script>

<script type="text/javascript">

  $("#prod").change(function(){
    var produk_id = {produk_id:$("#prod").val()};
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('encode/select_harga');?>",
      data: produk_id, 
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

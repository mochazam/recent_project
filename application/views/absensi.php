<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absensi Mahasiswa</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

    <style type="text/css">
    #target {
        font-size: 16px;
        color: #555;
        padding-top:20px;  
    }
    .cek {
        padding-top: 15px;
        color: red;
    }
    </style>
</head>
<body>
    
    <div class="container">
        <div id="wrapper">
          
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Absensi
                            <div class="pull-right">
                                <div id="target"></div>
                            </div>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                DataTables Advanced Tables
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                    		        <div class="row container">
                    		            <div class="col-lg-12">
                    		                <div class="form-horizontal">
                    		                    <div class="form-group">
                    		                        <label for="field-1" class="col-sm-3 control-label">Nama</label>
                    		                        
                    		                        <div class="col-sm-5">
                                                        <label for="" class="control-label"><?php echo $nama_mhs;?></label>
                    		                        </div>
                    		                    </div>

                    		                    <div class="form-group">
                    		                        <label for="field-1" class="col-sm-3 control-label">NPM</label>
                    		                        
                    		                        <div class="col-sm-5">
                                                        <input type="text" class="form-control" id="id" value="<?php echo $npm;?>">
                    		                        </div>
                    		                    </div>

                                                <div class="form-group">
                                                    <label for="field-1" class="col-sm-3 control-label">Matakuliah</label>

                                                    <div class="col-sm-5">
                                                        <select name="matakuliah" id="mk" class="form-control">
                                                            <option>-- SELECT MATAKULIAH --</option>
                                                            <?php foreach($matakul as $mk ): ?>
                                                            <option value='<?php echo $mk->kode_mk?>'><?php echo $mk->nama_mk;?>, <?php echo $mk->jadwal;?>, Ruang: R.<?php echo $mk->ruang;?>, <?php echo $mk->jam;?>, Dosen: <?php echo $mk->nama_dosen;?></option>    
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <i class="cek" id="cek"></i>
                                                    </div>
                                                </div>    

                                                <div class="form-group" id="" style="display:none">
                                                    <label for="field-1" class="col-sm-3 control-label">Status</label>
                                                    
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" id="status" value="">
                                                    </div>
                                                </div>

                    		                    <div class="form-group">
                    		                        <div class="col-sm-offset-3 col-sm-5">
                    		                            <input type="submit" id="tombol" class="btn btn-danger btn-lg disabled" value="absen please!">
                                                        <div class="alert alert-success" id="alert" style="display:none">
                                                            <a href="#" class="close" data-dismiss="alert"></a>
                                                            <strong>Success!</strong>.
                                                        </div>
                    		                        </div>
                    		                    </div>

                    		                </div>
                    		            
                                            <div id="disini"></div>
                    		            </div>
                    		        </div>
                  		      </div>
              
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>


    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
   
    <script type="text/javascript">
    
    function check_availabelity(){
        $('#mk').change(function() {
            var dataString = {id:$("#id").val(), mk:$("#mk").val()};
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().'absen/kroscek'; ?>",
                data: dataString,
                success: function(resp){
                    $("#cek").text(resp);
                    if(resp == 'Belum Absen') {
                        $('input[type="submit"]#tombol').removeClass('disabled').end();
                    } else {
                        $('input[type="submit"]#tombol').addClass('disabled');
                    }
                },
                error:function(event, textStatus, errorThrown) {
                    $("#cek").text('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
                },
            });
        });    

    }

    check_availabelity();

    </script>

    <script type="text/javascript"> 

    $(document).ready(function() {

        $('#mk').change(function() {
            var selectedOption = $('#mk option:selected'),
                arrays = [],
                mata = selectedOption.text(),
                arrays = mata.toString().split(", "),
                jam = arrays[3],
                now = new Date(),
                info = '',
                warna = '',
                currHour = arrays[3],
                jam = now.getHours(),
                menit = now.getMinutes(),
                cekOn = $("i").text();               


            if (jam > currHour) {
                getLate();
            } else if (jam = currHour) {
                getInfo();
            }; 

            function getInfo() {
                if (menit > 30) {
                    info = 2;
                    warna = 'red';
                }
                else {
                    info = 1;
                    warna = 'green';
                };  
            }

            function getLate() {
                info = 3;
                warna = 'red';
            }    
            return $('#status').val(info).css({
                color : warna,
            }); 

            
        });    
        


        $('input[type="submit"]').click(function(){
            //var name = $('#name').text();
            var id = {id:$("#id").val(), mk:$("#mk").val(),  status:$("#status").val()};
            //$("#showLoad").html('<img src="<?php echo base_url();?>upload/loader_new.gif" />');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('absen/log');?>",
                data: id,
                success: function(data){
                  $("input[type='submit']").hide();
                  $("#alert").show();
                }
            });
        }); 

        function getWaktu() {
            var now = new Date();
            var dinoSaiki = now.getDay();
            var arrdays = ["Ahad", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            var jam = now.getHours();
            if (jam < 10) {
                jam = '0' + jam;
            }
            var menit = now.getMinutes();
            if (menit < 10) {
                menit = '0' + menit;
            }
            var detik = now.getSeconds();
            if (detik < 10) {
                detik = '0' + detik;
            }
            return $('#target').text(arrdays[dinoSaiki] + ',' + jam + ':' + menit + ':' + detik); 

        };
        setInterval(function() {getWaktu()}, 1000);

    });   

    
    </script>
</body>
</html>


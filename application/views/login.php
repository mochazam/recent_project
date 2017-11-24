<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

    <!-- MetisMenu CSS 
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts 
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
-->
<style type="text/css">
h3.panel-title{text-align: center;font-weight: bold;text-transform: uppercase;}
</style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="<?php echo base_url();?>login/getLogin">
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputEmail">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                </div>                          
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                <!-- warning akan muncul disini -->
								<?php
									$info = $this->session->flashdata('info'); //menampung informasi yang di lempar di mode
									if(!empty($info)) //jika info tidak kosong maka tampilkan warning
									{
										echo $info;//kita tes
									}
								?>	
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

</body>

</html>

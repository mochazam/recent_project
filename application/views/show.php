<html lang="en-US">  
    <head>  
        <title>Codeigniter Autocomplete</title>  
        <link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.css" type="text/css" media="all" />  
        <link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.theme.css" type="text/   css" media="all" />  
        <script src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js" type="text/javascript"></script>  
        <script src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>  
        <meta charset="UTF-8">  
            
        <style>  
     
            .ui-menu {  
                list-style:none;  
                padding: 2px;  
                margin: 0;  
                display:block;  
            }  
            .ui-menu .ui-menu {  
                margin-top: -3px;  
            }  
            .ui-menu .ui-menu-item {  
                margin:0;  
                padding: 0;  
                zoom: 1;  
                float: left;  
                clear: left;  
                width: 100%;  
                font-size:80%;  
            }  
            .ui-menu .ui-menu-item a {  
                text-decoration:none;  
                display:block;  
                padding:.2em .4em;  
                line-height:1.5;  
                zoom:1;  
            }  
            .ui-menu .ui-menu-item a.ui-state-hover,  
            .ui-menu .ui-menu-item a.ui-state-active {  
                font-weight: normal;  
                margin: -1px;  
            }  
        </style>  
            
        <script type="text/javascript">  
        $(this).ready( function() {  
            $("#id").autocomplete({  
 
                minLength: 1,  
                source:   
                function(req, add){  
                    $.ajax({  
                        url: "<?php echo base_url(); ?>autocomplete/lookup",//  "<?php echo base_url(); ?>index.php/autocomplete/lookup"
                        dataType: 'json',  
                        type: 'POST',  
                        data: req,  
                        success:      
                        function(data){  
                            if(data.response =="true"){  
                                add(data.message);  
                                console.log(data);
                            }  
                        },  
                    });  
                },  
                     
            });  
        });  
        </script>  
            
    </head>  
    <body>  
        Country :  
        <?php  
            echo form_input('printable_name','','id="id"');  
        ?>  
        <ul>  
            <div class="well" id="result"></div>  
        </ul>  
    </body>  
</html> 
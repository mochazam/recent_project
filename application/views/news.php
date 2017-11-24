<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $deskripsi;?>">
    <meta name="author" content="">

    <title>News</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/simplemde.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

    <style type="text/css">
    .judul {
        margin: 20px 0;
        font-weight: bold;
    }
    #editor {
        border: 1px solid #ddd;
        padding: 0 10px 10px 10px;
        margin: auto;
        width: 100%;
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .15), 0 1px 5px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .15), 0 1px 5px rgba(0, 0, 0, .075); 
    }
    </style>
</head>

<body>

    <?php $this->load->view('nav'); ?>

<div class="container">
    <div id="wrapper" class="col-lg-9">

        <?php
            if (isset($next_page)) {
                //echo "horee";

            }
    		foreach ($content->result() as $row){
    	?>

        <!-- <div class="">
            <button class="btn btn-success" id="editBtn">Edit</button>
            <button class="btn btn-danger" id="saveBtn">Save</button>
        </div> -->
        <hr>
    	<div class="" id="asli">
            <div class="judul">
                <h3><?php echo $row->nama_artikel;?></h3>
                <span><?php echo $estimasi;?></span>
            </div>
    		<?php echo $row->body;?>
    	</div>
        <!-- editable content -->
        <!-- <div class="judul2">
            <h3><?php echo $row->nama_artikel;?></h3>
        </div>
        <div contenteditable="plaintext-only" id="editor">
            <?php echo $row->body;?>
        </div>     -->
        <div>
            <nav aria-label="...">
                <ul class="pager">
                    <?php
                        if (isset($prev_page)) {
                            foreach ($prev_page->result() as $row) {
                                echo '<li class="previous"><a href="'.base_url().'artikel/show/'.$this->uri->segment(3).'/'.$row->slug.'"><span aria-hidden="true">&larr;</span> '.str_replace("-", " ", $row->slug).'</a></li>';
                            }
                        }
                    ?>
                    

                    <?php
                        if (isset($next_page)) {
                            foreach ($next_page->result() as $row) {
                                echo '<li class="next"><a href="'.base_url().'artikel/show/'.$this->uri->segment(3).'/'.$row->slug.'">'.str_replace("-", " ", $row->slug).' <span aria-hidden="true">&rarr;</span></a></li>';
                            }
                        }
                    ?>
                    
                </ul>
            </nav>
        </div>

    	<?php } ?>

    </div>

    <div class="col-lg-3">
    	<nav class="affix" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
    		<ul class="nav">

    			<?php
		    		foreach ($menu_sidebar->result() as $row){
		    	?>
		    	<li><a href="<?php echo base_url();?>artikel/show/<?php echo $this->uri->segment(3).'/'.$row->slug;?>"><?php echo ucwords($row->nama_artikel);?></a></li>
		    	<?php } ?>

    		</ul>

    	</nav>
    	

    </div>
    <!-- /#wrapper -->
</div>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({ element: $("#mark")[0] });
    </script>

<script>
    $(document).ready(function() {
        $('#editor').hide();
        $('#saveBtn').hide();
        $('.judul2').hide();
        $('#editBtn').click(function(){
            $(this).hide();
            $('#saveBtn').show();
            $('#editor').show();
            $('#asli').hide();
            $('.judul2').show();
        });
         $('#saveBtn').click(function(){
            $(this).hide();
            $('#editBtn').show();
            $('#asli').show();
            $('#editor').hide();
            $('.judul2').hide();
            // Get edit field value
            $edit = $('#editor').html();
            $.ajax({
                url: '<?php echo base_url();?>artikel/changeArtikel',
                type: 'post',
                data: {data: $edit},
                datatype: 'html',
                success: function(rsp){
                    alert(rsp);
                }
            });
        });
    });
</script>

</body>

</html>

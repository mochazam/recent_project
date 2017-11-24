<style>
    .com_img {
		float: left; 
		width: 80px; 
		height: 80px; 
		margin-right: 20px;
	}
	.com_name {
		font-size: 16px; 
		color: rgb(102, 51, 153); 
		font-weight: bold;
	}
    ol.timeline {list-style:none;font-size:1.2em;}
	ol.timeline li { display:none;position:relative;padding:.7em 0 .6em 0;}
	ol.timeline li:first-child{}
    .box {
		height:85px;
		border-bottom:#dedede dashed 1px;
		margin-bottom:20px;
        margin-left: 175px;
	}
		    
</style>

<?php foreach($comments->result() as $row) { ?>

<li class="box">
	<img src="<?php echo base_url();?>uploads/nopic_192.gif" class="com_img">
	<span class="com_name"> <?php echo $row->name; ?></span> <br />
	<span> <?php echo $row->comment; ?></span>
</li>

<?php } ?>
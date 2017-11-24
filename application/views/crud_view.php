<html>
<head>
	<title>Live CRUD</title>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>

<style type="text/css">

td {
	cursor: pointer;
}

.editor{
	display: none;
}

</style>



</head>
<body>


<div class="container">

<div class="row">
<div class="col-md-6">

<h2>Latihan live CRUD</h2>

<button class="btn btn-info" id="tambah-data"><i class="glyphicon glyphicon-plus-sign"></i> Tambah </button>

<br>
<br>
<br>

<table id="table-data" class="table table-striped">

	<thead>
		<tr>
			<th>Nama</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Hapus</th>
		</tr>
	</thead>

	<tbody id="table-body">
		<?php 

		foreach ($people as $member) {
			echo "<tr data-id='$member[id]'>
					<td><span class='span-nama caption' data-id='$member[id]'>$member[nama]</span> <input type='text' class='field-nama form-control editor' value='$member[nama]' data-id='$member[id]' /></td>
					<td><span class='span-email caption' data-id='$member[id]'>$member[email]</span> <input type='text' class='field-email form-control editor' value='$member[email]' data-id='$member[id]' /></td>
					<td><span class='span-phone caption' data-id='$member[id]'>$member[phone]</span> <input type='text' class='field-phone form-control editor' value='$member[phone]' data-id='$member[id]' /></td>
					<td><button class='btn btn-xs btn-danger hapus-member' data-id='$member[id]'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>
					</tr>";
		}


 		?>
	</tbody>

</table>

</div>
</div>

</div>







<script type="text/javascript">

$(function(){

	$.ajaxSetup({
		type:"post",
		cache:false,
		dataType: "json"
	})


	$(document).on("click","td",function(){
		$(this).find("span[class~='caption']").hide();
		$(this).find("input[class~='editor']").fadeIn().focus();
	});


	$("#tambah-data").click(function(){
		$.ajax({
			url:"<?php echo base_url('crud/create'); ?>",
			success: function(a){
				var ele="";
				ele+="<tr data-id='"+a.id+"'>";
				ele+="<td><span class='span-nama caption' data-id='"+a.id+"'></span> <input type='text' class='field-nama form-control editor'  data-id='"+a.id+"' /></td>";
				ele+="<td><span class='span-email caption' data-id='"+a.id+"'></span> <input type='text' class='field-email form-control editor' data-id='"+a.id+"' /></td>";
				ele+="<td><span class='span-phone caption' data-id='"+a.id+"'></span> <input type='text' class='field-phone form-control editor'  data-id='"+a.id+"' /></td>";
				ele+="<td><button class='btn btn-xs btn-danger hapus-member' data-id='"+a.id+"'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>";
				ele+="</tr>";

				var element=$(ele);
				element.hide();
				element.prependTo("#table-body").fadeIn(1500);

			}
		});
	});

	$(document).on("keydown",".editor",function(e){
		if(e.keyCode==13){
			var target=$(e.target);
			var value=target.val();
			var id=target.attr("data-id");
			var data={id:id,value:value};
			if(target.is(".field-nama")){
				data.modul="nama";
			} else if(target.is(".field-email")){
				data.modul="email";
			} else if(target.is(".field-phone")){
				data.modul="phone";
			}

			$.ajax({
				data:data,
				url:"<?php echo base_url('crud/update'); ?>",
				success: function(a){
				 target.hide();
				 target.siblings("span[class~='caption']").html(value).fadeIn();
				}

			})

		}

	});


	$(document).on("click",".hapus-member",function(){
		var id=$(this).attr("data-id");
		swal({
			title:"Hapus Member",
			text:"Yakin akan menghapus member ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Hapus",
			closeOnConfirm: true,
		},
			function(){
			 $.ajax({
				url:"<?php echo base_url('crud/delete'); ?>",
				data:{id:id},
				success: function(){
					$("tr[data-id='"+id+"']").fadeOut("fast",function(){
						$(this).remove();
					});
				}
			 });
		});
	});

});

</script>

</body>
</html>
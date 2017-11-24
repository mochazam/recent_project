<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<title>Creating mathematical formulas</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<script src="https://cdn.ckeditor.com/4.7.3/standard-all/ckeditor.js"></script>
</head>

<body>

	<div class="container">
		<div class="row">
			<form method="POST" action="<?php echo base_url();?>equation/storeFormula">
			  	<div class="form-group">
			    	<label for="">Judul</label>
			    	<input type="text" class="form-control" id="" placeholder="Judul" name="nama_artikel">
			  	</div>
			  	<div class="form-group">
			    	<label for="">Body</label>
			    	<textarea cols="10" id="editor1" name="isi" rows="10" >&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
					</textarea>
			  	</div> 
			  	<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>

	

	<script>
		CKEDITOR.replace( 'editor1', {
			extraPlugins: 'mathjax',
			mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
			height: 320
		} );

		if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
			document.getElementById( 'ie8-warning' ).className = 'tip alert';
		}
	</script>
</body>

</html>
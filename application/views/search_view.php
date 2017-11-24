<?php
	$sqlstate="select distinct  state_name from State_cities ";
	$querystate=$this->db->query($sqlstate);
	$sqlmake="select distinct  make_name from make_models ";
	$querymake=$this->db->query($sqlmake);
?>

<div class="bs-example">
  	<div class="panel-group">
  		<div class="panel panel-default bdrw10" >
    		<div class="panel-heading pdg0" data-toggle="collapse" data-parent="#accordion7" href="#collapseSeven">
      			<h4 class="panel-title head  innerHead">
         			<a data-toggle="collapse" data-parent="#accordion7" href="#collapseSeven">State and City</a>
      			</h4>
    		</div>
     		<div id="collapseSeven" class="panel-collapse collapse">
    			<div class="panel-body">
                    <select class="form-control" id="states" name="states"  onchange="selctcitys();viewSearch()">
                        <?php if($state!='') { ?>
                        <option value="<?=$state?>"  ><?=$state?> </option>
                           	<script type="text/javascript">
                            	selctcitys();
							</script>
                        <?php } else { ?>
						   
  						<option value="">--Select State-- </option>
                        <?php } ?>
                        <?php foreach($querystate->result() as $row) { ?>
                        <option value="<?php  echo $row->state_name; ?>"><?php  echo $row->state_name; ?></option>
                        <?php } ?>
                    </select><br/>
                    <select class="form-control" id="cities" name="cities"  onchange="viewSearch()">
                        <?php if($city!='') { ?>
                        <option value="<?=$city?>"><?=$city?> </option>
                        <?php } else { ?>
						   
  						<option value="">--Select City-- </option>
                        <?php } ?>   
                    </select>
                </div>
            </div>
        </div>
   
     	<div class="panel panel-default bdrw10" >
    		<div class="panel-heading pdg0">
      			<h4 class="panel-title  head  innerHead">
         			<a data-toggle="collapse" data-parent="#accordion8" href="#collapseEight">Make and Model</a>
      			</h4>
    		</div>
    		 <div id="collapseEight" class="panel-collapse collapse">
    			<div class="panel-body">
                    <select class="form-control" id="makes" name="makes"  onchange="selctmakemain();viewSearch()">
                       	<?php if($make!='') { ?>
                       	<option value="<?=$make?>"><?=$make?> </option>
                       	<?php } else { ?>
					   
						<option value="">--Select Make-- </option>
                        <?php } ?> 
                        <?php foreach($querymake->result() as $row) { ?>
                        <option value="<?php  echo $row->make_name; ?>"><?php  echo $row->make_name; ?> </option>
                        <?php } ?>
                    </select><br/>
                    <select class="form-control" id="model" name="model"  onchange="viewSearch()">
                       	<?php if($model!='') { ?>
                       	<option value="<?=$model?>"><?=$model?> </option>
                       	<?php } else { ?>
					   
						<option value="">--Select Model-- </option>
                        <?php } ?>
                            
                    </select>
                </div>
         	</div> 
        </div>

		<div class="panel panel-default bdrw10" >
    		<div class="panel-heading pdg0" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
      			<h4 class="panel-title head  innerHead">
        			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Your Budget</a>
      			</h4>
    		</div>
    		<div id="collapseOne" class="panel-collapse collapse">
      			<div class="panel-body">
       				<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="1 and 100000"/> Up to 1 lakh<br/>
			      	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="100000 and 300000"/> 1-3 lakhs<br/>
			      	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="300000 and 500000" /> 3-5 lakhs<br/>
			       	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="500000 and 800000"  /> 5-8 lakhs<br/>
			      	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="800000 and 1000000"/> 8-10 lakhs<br/>
			      	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="1000000 and 1500000"/> 10-15 lakhs<br/>
			      	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="1500000 and 2000000"/> 15-20 lakhs<br/>
			      	<input type="checkbox" name="Budget[]" onClick="viewSearch()" value="2000000"/> 20 lakhs or above
      			</div>
    		</div>
  		</div>
                         
        <div class="panel panel-default bdrw10" data-parent="#accordion5">
    		<div class="panel-heading pdg0" data-toggle="collapse" data-parent="#accordion5" href="#collapseFour">
      			<h4 class="panel-title head  innerHead">
        			<a data-toggle="collapse" data-parent="#accordion5" href="#collapseFour">Body Style</a>
      			</h4>
    		</div>
    		<div id="collapseFour" class="panel-collapse collapse">
      			<ul class="panel-body li_none">
        			<li>
				        <div class="fleft wid50p">
				        	<span class="clear fleft row1"><i class="bodyset cset2 flt-left"> </i> </span>
				        	<span class="fleft row1 mgnl10"> <input type="checkbox" value="Hatchback" name="bodyStyle[]" onClick="viewSearch()" id="bodyStyle" /> Hatchback </span>
				        </div>
				        <div class="fleft wid50p">
				        	<span class="clear disin"><i class="bodyset cset1 flt-left"> </i> </span>
				        	<span class="disin row1 mgnl10">  <input type="checkbox" value="Sedan" name="bodyStyle[]" onClick="viewSearch()" /> Sedan  </span>
				        </div>
				    </li>
			        <li>
				        <div class="fleft wid50p">
				        	<span class="clear disin"><i class="bodyset cset3 flt-left"> </i> </span>
				        	<span class="disin row1 mgnl10">  <input type="checkbox" value="Convertible" name="bodyStyle[]" onClick="viewSearch()" /> Convertible </span>
				        </div>
			        </li>
			        <li>
				        <div class="fleft wid50p">
				        	<span class="clear disin"><i class="bodyset cset5 flt-left"> </i></span>
				        	<span class="disin row1 mgnl10">  <input type="checkbox" value="SUV" name="bodyStyle[]" onClick="viewSearch()" /> SUV/MUV </span>
				        </div>
			        </li>
			        <li>
				        <div class="fleft wid50p">
				        	<span class="clear disin"><i class="bodyset cset6 flt-left"> </i> </span>
				        	<span class="disin row1 mgnl10"> <input type="checkbox" value="VANS" name="bodyStyle[]" onClick="viewSearch()"/> Vans  </span>
				        </div>
			        </li>  
			    </ul>
    		</div>
  		</div>

   		<div class="panel panel-default bdrw10" data-parent="#accordion1">
    		<div class="panel-heading pdg0" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
      			<h4 class="panel-title head  innerHead">
        			<a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Fuel Type</a>
      			</h4>
    		</div>
    		<div id="collapseTwo" class="panel-collapse collapse">
       			<div class="panel-body">
			      	<input type="checkbox" name="fueltype[]" onClick="viewSearch()" value="Petrol"  /> Petrol<br/>
			      	<input type="checkbox" name="fueltype[]" onClick="viewSearch()" value="CNG"/> CNG<br/>
			      	<input type="checkbox" name="fueltype[]" onClick="viewSearch()" value="Electric"/> Electric<br/>
			      	<input type="checkbox" name="fueltype[]" onClick="viewSearch()" value="Diesel" /> Diesel<br/>
			      	<input type="checkbox" name="fueltype[]" onClick="viewSearch()" value="LPG" /> LPG
			    </div>
    		</div>
  		</div>
  
	</div>
</div>

<script type="text/javascript">

	function viewSearch(){

		var states=$('#states').val();
		var make=$('#makes').val();
		var model=$('#model').val();
		
		var cities=$('#cities').val();
		var budgetarr= new Array();
		$('input[name="Budget[]"]:checked').each(function() {
	  
	   		budgetarr.push(this.value);
	  
	    });
		
		var fuelarr=new Array();
		$('input[name="fueltype[]"]:checked').each(function() {
	    	fuelarr.push(this.value);
	    });
		var sellerarr=new Array();
		$('input[name="sellerinfo[]"]:checked').each(function() {
	      	sellerarr.push(this.value);
	    });
		var tarnsArr=new Array();
		$('input[name="TransmissionType[]"]:checked').each(function() {
	   		tarnsArr.push(this.value);
	    });
		var bodyarr= new Array();
		$('input[name="bodyStyle[]"]:checked').each(function() {
	      	bodyarr.push(this.value);
	   	});
		
		var bodystr=bodyarr;
		$.post("<?php echo base_url();?>searchcon/advSearch",{
			bodyStyle : bodyarr,
			budget : budgetarr,
			fuelType : fuelarr,
			cities : cities,
			states : states,
			make  : make,
			model : model
		},
		function(data) {
			$('#searchre').html(data);
		});	
	}

	function selctcitys(){

	   	var state=$('#states').val();
		$.post('<?php echo base_url();?>searchcon/citydetailswithstate/',{
			state:state
			
		},
		function(data) {
			$('#cities').html(data);
		});	
	}

	function selctmakemain(){
	   	var make=$('#makes').val();	
		$.post('<?php echo base_url();?>searchcon/modeldetailswithmake/',{
			make:make	
		},
		function(data) {
			$('#model').html(data);
		});	
	}

</script>
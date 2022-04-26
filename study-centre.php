<?php 
include "header-link.php";
include "header.php"; 

function fetchRecords()
{
	include   ('include/dbconfig.php');	
	
	$sql	="SELECT * FROM `franchises`
			  LEFT JOIN districts ON franchises.district_id=districts.id
			  LEFT JOIN states ON franchises.state_id=states.id";
	$res	= mysqli_query($conn,  $sql);
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td>JYBCE-'.$row['code'].'</td>
				<td>'.$row['franchise_name'].'</td>
				<td>'.$row['director_name'].'</td>
				<td>'.$row['address'].'</td>
				<td>'.$row['district_name'].'</td>
				<td>'.$row['state'].'</td>
			</tr>' ;
	}
}
?>
<script type="text/javascript">
$(document).ready(function() {
	// $('#state').change(function() {
	//    var code = $('#state').val();
	// 	   if(code != "") {
	// 			$.post('http://www.jybce.org/districtList', {state_id: code}, function(data) {
	// 				 if(data == "") {
	// 					$("#dist_list").hide();
	// 					alert("No District Found. Please Select Another State");
	// 					return false;
	// 				} 
	// 				else {
	// 					  $("#dist_list").html(data);
	// 					  $("#dis_trict").show('slow');
	// 					}
	// 			});
	// 		}
	// 		else{
	// 			$("#dis_trict").hide('slow');
	// 		}
	// });
});
</script>
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="http://www.jybce.org/study-centre#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li class="active">Study Center</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Start Content -->
<section id="content" class="courses-section sec-padding" data-bg-color="#f7f7f7">
        <div class="container">
            <div class="row">
				<div class="col-md-9">
				  <!-- <div class="row">
					<form action="http://www.jybce.org/study-centre" class="bs-example form-horizontal" id="search-form" method="get">
						<input type="hidden" name="action" value="search">
						<div class="col-md-5">
						  <div class="form-group">
							<label class="col-lg-4 control-label">Select State</label>
							<div class="col-lg-7">
								<select id="state" name="state" class="form-control" required="">
									<option value="">Select</option>
																		<option value="1">ANDAMAN AND NICOBAR (AN)</option>
																		<option value="2">ANDHRA PRADESH (AP)</option>
																		<option value="3">ARUNACHAL PRADESH (AR)</option>
																		<option value="4">ASSAM (AS)</option>
																		<option value="5">BIHAR (BR)</option>
																		<option value="6">CHANDIGARH (CH)</option>
																		<option value="7">CHHATTISGARH (CG)</option>
																		<option value="8">DADRA AND NAGAR HAVELI (DN)</option>
																		<option value="9">DAMAN AND DIU (DD)</option>
																		<option value="10">DELHI (DL)</option>
																		<option value="11">GOA (GA)</option>
																		<option value="12">GUJARAT (GJ)</option>
																		<option value="13">HARYANA (HR)</option>
																		<option value="14">HIMACHAL PRADESH (HP)</option>
																		<option value="15">JAMMU AND KASHMIR (JK)</option>
																		<option value="16">JHARKHAND (JH)</option>
																		<option value="17">KARNATAKA (KA)</option>
																		<option value="18">KERALA (KL)</option>
																		<option value="19">LAKSHDWEEP (LD)</option>
																		<option value="20">MADHYA PRADESH (MP)</option>
																		<option value="21">MAHARASHTRA (MH)</option>
																		<option value="22">MANIPUR (MN)</option>
																		<option value="23">MEGHALAYA (ML)</option>
																		<option value="24">MIZORAM (MZ)</option>
																		<option value="25">NAGALAND (NL)</option>
																		<option value="26">ODISHA (OD)</option>
																		<option value="27">PUDUCHERRY (PY)</option>
																		<option value="28">PUNJAB (PB)</option>
																		<option value="29">RAJASTHAN (RJ)</option>
																		<option value="30">SIKKIM (SK)</option>
																		<option value="31">TAMIL NADU (TN)</option>
																		<option value="32">TRIPURA (TR)</option>
																		<option value="33">UTTAR PRADESH (UP)</option>
																		<option value="34">UTTARAKHAND (UK)</option>
																		<option value="35">WEST BENGAL (WB)</option>
																	</select>
							</div>
						  </div>
						</div>
						<div class="col-md-5" id="dis_trict" style="display:none;">
							<div class="form-group">
								<label class="col-lg-4 control-label">Select District</label>
								<div class="col-lg-7">
									<select id="dist_list" name="district" class="form-control">
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <div class="col-lg-offset-2 col-lg-4">
								<button type="submit" class="btn btn-s-md btn-primary">Search</button>
							  </div>
							</div>
						</div>
					</form>
				  </div> -->
				  <!-- Some Text -->
				  <table class="table rwd-table" style="margin-top:2%;">
				  <thead>
				  <tr>
						<th>Center Code</th>
						<th>Center Name</th>
						<th>Director Name</th>
						<th>Location</th>
						<th>District</th>
						<th>State</th>
				  </tr>
				  </thead>
				  <tbody>
				  	<?php echo fetchRecords(); ?>
				  	</tbody>
				 </table>
				</div>
				<div class="col-lg-3">
					<aside class="left-sidebar">
					  <div class="widget">
						<h4 class="widgetheading">Categories</h4>
						<ul class="cat">
	<li><a href="http://www.jybce.org/computer-software-and-hardware">Computer Software And Hardware</a></li>
              <li><a href="http://www.jybce.org/vocational">Vocational</a></li>
              <li><a href="http://www.jybce.org/paramedical">Paramedical</a></li>
              <li><a href="http://www.jybce.org/technical">Technical</a></li>
              <li><a href="http://www.jybce.org/nursing">Nursing &amp; Pathology</a></li>
              <li><a href="http://www.jybce.org/kg-school">KG School</a></li>
              <li><a href="http://www.jybce.org/bed-college">B.Ed &amp; D-Ed College</a></li>
              <li><a href="http://www.jybce.org/technology">Technology &amp; IT</a></li>
              <li><a href="http://www.jybce.org/travel-and-tourism">Travel &amp; Tourism</a></li>
              <li><a href="http://www.jybce.org/distance-education">Regular &amp; Distance Education</a></li>
              <li><a href="http://www.jybce.org/news-paper">Media &amp; News Paper</a></li>
              <li><a href="http://www.jybce.org/consultancy-service">Consultancy Service</a></li>
              <li><a href="http://www.jybce.org/govt-project">Govt. Project</a></li>
              <li><a href="http://www.jybce.org/sholarship">Minority</a></li>
              <li><a href="http://www.jybce.org/job-consultancy">Job Consultancy Service</a></li>
						</ul>
					  </div>
					</aside>
				</div>
				
            </div>
        </div>
    </section>
    
<?php include "footer.php"; ?>	
<?php include "footer-link.php"; ?>
<?php include "header-link.php"; ?>
<?php include "header.php"; ?>

<script type="text/javascript">
$(document).ready(function() {
	$('#state').change(function() {
	   var code = $('#state').val();
		   if(code != "") {
				$.post('http://www.jybce.org/districtList', {state_id: code}, function(data) {
					 if(data == "") {
						$("#dist_list").hide();
						alert("No District Found. Please Select Another State");
						return false;
					} 
					else {
						  $("#dist_list").html(data);
						  $("#dis_trict").show('slow');
						}
				});
			}
			else{
				$("#dis_trict").hide('slow');
			}
	});
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
				  <div class="row">
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
				  </div>
				  <!-- Some Text -->
				  <table class="table rwd-table" style="margin-top:2%;">
				  <thead>
				  <tr>
					<!--<th>Sl No</th>-->
					<th>Center Code</th>
					<th>Center Name</th>
					<th>Director Name</th>
					<th>Location</th>
					<th>District</th>
					<th>State</th>
				  </tr>
				  </thead>
				  				  <tbody><tr>
					<!--<td>1</td>-->
					<td>JYBCE-0029</td>
					<td>APOLLO COMPUTER CENTRE</td>
					<td>ARPITA KUNDU</td>
					<td>JALANNAGAR,MURSIDABAD</td>
										<td>MURSHIDABAD</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0026</td>
					<td>NYCE JATIYA YUVA COMPUTER CENTRE</td>
					<td>RAJESH KHAN</td>
					<td>BOLPUR</td>
										<td>BIRBHUM</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0028</td>
					<td>ALFA DIGITAL</td>
					<td>AVIJIT MAHANTA</td>
					<td>KUCHANPUR,NADIA</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0027</td>
					<td>JATIYA YUVA BOARD OF COMPUTER ACADEMY </td>
					<td>SOMNATH CHATTERJEE</td>
					<td>AMGHATA,NADIA</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0025</td>
					<td>DAYER BAZAR JATIYA YUVA BOARD OF COMPUTER EDUCATION</td>
					<td>SUBRATA DAS</td>
					<td>NEAR DAYER BAZAR VIDYAMANDIR</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0031</td>
					<td>GHURNI JATIYA YUVA BOARD OF COMPUTER EDUCATION</td>
					<td>SANGITA MONDAL BHATTACHARYA</td>
					<td>KRISHNAGAR</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0030</td>
					<td>RADHANAGAR JATIYA YUVA BOARD OF COMPUTER EDUCATION</td>
					<td>TANMAY MONDAL</td>
					<td>RADHANAGAR</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0033</td>
					<td>NATIONAL COMPUTER CENTRE</td>
					<td>MD KHAIRUL SHAIKH &amp; HALIM SHAIKH</td>
					<td>Sanmatinagar</td>
										<td>MURSHIDABAD</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0032</td>
					<td>DIAMOND HARBOUR JYBCE</td>
					<td>SAPTAMI MAITY</td>
					<td>Diamond Harbour</td>
										<td>SOUTH 24 PARGANAS</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0033</td>
					<td>Jatiyo Yubo Computer Centre</td>
					<td>ABDUL MOIN</td>
					<td>Dogachi</td>
										<td>MURSHIDABAD</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0034</td>
					<td>GOOGHLY JYBCE</td>
					<td>RAJU SEN</td>
					<td>HOOGHLY</td>
										<td>HOOGHLY</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0035</td>
					<td>JOYPUL JATIYA YUVA BOARD OF COMPUTER EDUCATION</td>
					<td>KALYAN NAG</td>
					<td>DATTAPUKUR</td>
										<td>NORTH 24 PARGANAS</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0036</td>
					<td>srirampur jybce</td>
					<td>Suvojit Saha</td>
					<td>Srirampur</td>
										<td>HOOGHLY</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0037</td>
					<td> A to Z Learning Center</td>
					<td>Dinesh Roy</td>
					<td>ballygunj</td>
										<td>SOUTH 24 PARGANAS</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0038</td>
					<td>S.S TECHNOLOGY</td>
					<td>SHIBNATH DUTTA</td>
					<td>KRISHNAGAR</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0039</td>
					<td>JYBCE JATIYA YUVA COMPUTER TRAINING CENTRE</td>
					<td>SUBRATA KUMAR DAS</td>
					<td>GOKULNAGAR,TEKHALI BAZAR,NANDIGRAM</td>
										<td>PURBA MEDINIPUR</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0040</td>
					<td>LEARNING COMPUTER ACADEMY</td>
					<td>HARUN RASID SK</td>
					<td>BISHNUPUR,</td>
										<td>SOUTH 24 PARGANAS</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0041</td>
					<td>NIAMATPUR  JYBCE</td>
					<td>Pankaj Jha</td>
					<td>Maldah</td>
										<td>MALDAH</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0042</td>
					<td>Bolpur Computer Center</td>
					<td>Jhuma batabyal</td>
					<td>Bolpur</td>
										<td>BIRBHUM</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0043</td>
					<td>JATIYA YUVA COMPUTER CENTER</td>
					<td>Suman ghosh</td>
					<td>BATUN</td>
										<td>DAKSHIN DINAJPUR</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0044</td>
					<td>LILUAH JATIYA YUVA</td>
					<td>Surojit dey</td>
					<td>Liluah</td>
										<td>HOWRAH</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0045</td>
					<td>MICROCHIP COMPUTER ACADEMY</td>
					<td>ALOKE KUMAR NANDY</td>
					<td>NISCHINDA</td>
										<td>HOWRAH</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0046</td>
					<td>SEEMANAGAR NATIONAL YOUTH COMPUTER CENTER</td>
					<td>RAHUL GHOSH</td>
					<td>SEEMANAGAR</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0047</td>
					<td>Bamunia Jatiya Yuva Academy</td>
					<td>Ashim Koner </td>
					<td>Purba Barddhaman,</td>
										<td>BARDHAMAN</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  				  <tr>
					<!--<td>1</td>-->
					<td>JYBCE-0048</td>
					<td>A TO Z COMPUTER TRAINING CENTRE</td>
					<td>SUMITRA BANIK BHOWMICK</td>
					<td>NABADWIP</td>
										<td>NADIA</td>
										<td>WEST BENGAL (WB)</td>
				  </tr>
				  					</tbody></table>
				  
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
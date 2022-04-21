<?php
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php'); 
$success_msg = null;
$error_msg	 = null;
function getAddress(){
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `adress` group by `id` ORDER BY `address` ";
	$res=mysqli_query($conn,  $sql);
	$option='';
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option.='<option value="'.$row['address'].'">'.$row['address'].'</option>';
		}
		echo $option;
	}
}
function getCourses()
{
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `courses` group by `course_name`";
	$res=mysqli_query($conn,  $sql);
	$option='';
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option.='<option value="'.$row['course_id'].'">'.$row['course_name'].'-'.$row['description'].'</option>';
		}
		echo $option;
	}
}
?>

<?php include('include/menu.php');?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
		<div class="row">
				<br/>
		</div>
		<div id="message"></div>
        <div class="row">
		   <div class="col-sm-12 col-md-12 col-xs-12">
				<h4 class="page-header" style="border-color:black;">New Admission</h4>
			</div>
		</div>
 <form method="post" action="#" id="admissionForm" name="admissionForm" enctype="multipart/form-data" >
	<input type="hidden" name="formid" id="formid" value="<?php htmlspecialchars($_SESSION['formid']);?>">
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-1 col-sm-1 col-xs-12" >Student's Name: <span class="required"></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12 required">
			  <input type="text" id="sname"  name="sname" required="required" class="form-control col-md-7 col-xs-12">
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Father's Name<span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="fname"  name="fname" required="required"  class="form-control col-md-7 col-xs-12"/>
		    </div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="mname">Mother's Name: <span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="mname"  name="mname"  class="form-control col-md-7 col-xs-12" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Address: <span class="required"></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12 required">
			  <select id="address"  name="address" required="required" class="form-control col-md-7 col-xs-12">
			  <option value="">--Select--</option>
			  <?php getAddress();?>
			  </select>
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="po">P.O:<span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="po"  name="po"  class="form-control col-md-7 col-xs-12" />
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="ps">P.S: <span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <input type="text" id="ps"  name="ps"  class="form-control col-md-7 col-xs-12"/>
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
	<div class="form-group">
                       <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">District: <span class="required"></span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12 required">
                          <input type="text" id="district" required  name="district" required="required" class="form-control col-md-7 col-xs-12 required">
							
						 
						</div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">PIN<span class=""></span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" id="pin"  name="pin"  required class="form-control col-md-7 col-xs-12" />
							
						
                        </div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Gender<span class=""></span>
                        </label>
						<div class="col-md-3 col-sm-3 col-xs-12">
                        <label class="radio-inline">
						  <input type="radio" name="gender" required value="MALE">Male
						</label>
						<label class="radio-inline">
						  <input type="radio" name="gender" required value="FEMALE">Female
						</label>
						</DIV>
						
    </div>
	</div>
	<P></P>
	<div class="row">
	<div class="form-group">
	   <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">DOB: <span class="required"></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12 required">
		<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
				<input class="form-control" type="text" name="dob" id="dob" required>
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="caddress">Nationality:<span class=""></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <input type="text" id="nationality"  name="nationality"  class="form-control col-md-7 col-xs-12" required />
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer_gst">Marital Status: <span class=""></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <select id="mstatus"  name="mstatus"  class="form-control col-md-7 col-xs-12" required >
				<option value="">--Select--</option>
				<option value="SINGLE">Single</option>
				<option value="Married">Married</option>
		  </select>
		  
		</div>
  </div>
 </div>
<div class="row">
	<div class="form-group">
	   <label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer">Religion: <span class="required"></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12 required">
		  <input type="text" id="religion"  name="religion" required="required" class="form-control col-md-7 col-xs-12 required">
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="customer_gst">Caste: <span class=""></span>
		</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <select  id="caste"  name="caste"  class="form-control col-md-7 col-xs-12">
			<option value="">--Select--</option>
			<option value="GENERAL">General</option>
			<option value="SC">SC</option>
			<option value="ST">ST</option>
			<option value="OBC">OBC</option>
		 </select>
		</div>
     </div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Mobile No: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="contact"  name="contact" required="required" class="form-control col-md-7 col-xs-12 required">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Addhar No:<br/><font size="2" color="red"></font><span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <input type="text" id="aadhar"  name="aadhar"  class="form-control col-md-7 col-xs-12" />
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
		   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Applicant's Occupation: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="occupation"  name="occupation" required="required" class="form-control col-md-7 col-xs-12 required">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Father's Occupation:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <input type="text" id="foccupation"  name="foccupation"  class="form-control col-md-7 col-xs-12" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Session:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="session"  name="session"  class="form-control col-md-7 col-xs-12" />
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Qualification(Last Exam): <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="qualification"  name="qualification" required="required" class="form-control col-md-7 col-xs-12 required">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Course:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select  id="course"  name="course"  class="form-control col-md-7 col-xs-12" required>
					<option value="">--Select--</option>
					<?php getCourses(); ?>
				</select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Course Fees: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
			  <input type="text" id="fees"  name="fees" required="required" class="form-control col-md-7 col-xs-12 required">
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="customer">Date: <span class="required"></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12 required">
				<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="date" id="date" >
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							
			  </div>
			  			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Amount Paid:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text"  id="paidamt"  name="paidamt"  class="form-control col-md-7 col-xs-12">
			</div>

		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Pay By:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <select  id="payby"  name="payby"  class="form-control col-md-7 col-xs-12" required>
				<option value="">--Select--</option>
				<option value="CASH">CASH  </option>
				<option value="CHEQUE">CHEQUE</option>
				<option value="CARD">  CARD   </option>
			  </select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Course Day:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<select id="courseday" name="courseday[]" multiple class="form-control" required>
					<option value="MON">MONDAY		</option>
					<option value="TUE">TUESDAY		</option>
					<option value="WED">WEDNESDAY	</option>
					<option value="THU">THURSDAY	</option>
					<option value="FRI">FRIDAY		</option>
					<option value="SAT">SATURDAY	</option>
					<option value="SUN">SUNDAY		</option>
				</select>
			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Cheque No:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <input  type="text "id="chequeno"  name="chequeno"  class="form-control col-md-7 col-xs-12">
			</div>

		</div>
	</div>
	<p></p>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">From Month:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <select id="frommonth" name="frommonth" class="form-control" required>
					<option value="1">JANUARY		</option>
					<option value="2">FEBRUARY	</option>
					<option value="3">MARCH			</option>
					<option value="4">APRIL			</option>
					<option value="5">MAY				</option>
					<option value="6">JUNE			</option>
					<option value="7">JULY			</option>
					<option value="8">AUGUST		</option>
					<option value="9">SEPTEMBER	</option>
					<option value="10">OCTOBER		</option>
					<option value="11">NOVEMBER	</option>
					<option value="12">DECEMBER	</option>
				</select>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">To Month:<span class=""></span>
			</label>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<select id="tomonth" name="tomonth" class="form-control" required>
					<option value="1">JANUARY		</option>
					<option value="2">FEBRUARY	</option>
					<option value="3">MARCH			</option>
					<option value="4">APRIL			</option>
					<option value="5">MAY				</option>
					<option value="6">JUNE			</option>
					<option value="7">JULY			</option>
					<option value="8">AUGUST		</option>
					<option value="9">SEPTEMBER	</option>
					<option value="10">OCTOBER		</option>
					<option value="11">NOVEMBER	</option>
					<option value="12">DECEMBER	</option>
				</select>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<input type="text" id="toyear" name="toyear" class="form-control" placeholder="To Year" required>

			</div>
		</div>
	</div>
	<p></p>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Registration No:<span class=""></span>
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text"  id="regno"  name="regno"  class="form-control col-md-7 col-xs-12">
			</div>
	</div>
	
	</div>
	<p><br/></p>
	<!--
	<div class="row">
		
	<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="caddress">Image:<span class=""></span>
			</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="file"  id="fileToUpload"  name="fileToUpload"  class="form-control">
			</div>
			<div class="col-md-1 col-sm-1 col-xs-12">
				<input type="button"  id="uploadbtn"  name="uploadbtn"  class="btn btn-info" value="Upload Now">
			</div>
	</div>
	</div>-->
	<p><br/></p>
	<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-offset-4 col-sm-4 col-xs-12">
				<input type="submit"  id="submit"  name="submit"  value="Submit Now" class="form-control btn btn-info col-md-7 col-xs-12"><br/>
				<p><br/></p>
			</div>
	</div>
				
</form>
		    <!-- /.col-lg-12 -->
		

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include('include/footer.php'); ?>
</body>
</html>
    <script>
 $(document).ready(function() {
var datas=$("#admissionForm").serialize();
				
	
 $('#stid').on('focus',function(e){
	 var session=$('#session').val();
	 
	 $.ajax(
		{
		url:'findmaxId.php',
		type:'post',
		data:{'session':session},
		success:function(data)
		{
			if(data)
			{
				 $('#stid').val(data); 
							
			}
		},
		
		});		
 });
  $('#address').on('change',function(e){
	 var address=$('#address').val();
	 
	 $.ajax(
		{
		url:'findAddress.php',
		type:'post',
		data:{'address':address},
		dataType:"json",
		success:function(data)
		{
			if(data)
			{
				 $('#po').val(data.po); 
				  $('#pin').val(data.pin); 
				   $('#ps').val(data.ps); 
							
			}
		},
		
		});		
 });
 $('#course').on('change',function(e){
	var courseid=$('#course').val();
	 $.ajax({
		 url:"findCourseFees.php",
		 method:"post",
		 data:{'courseid':courseid},
		 success:function(data)
		 {
			 $('#fees').val(data);
		 }
	 })
 });
 $('#regno').on('focus',function(e){
	  var fromyear = $('#session').val();
	  var frommonth= $('#frommonth').val();
	  var courseid=$('#course').val();
	  if(courseid!="" &&  fromyear!="")
	  {
	  $.ajax({
			url:"findMaxRegno.php",
			method:"post",
			data:{'fromyear':fromyear,'frommonth':frommonth,'courseid':courseid},
			success:function(data)
			{
				$('#regno').val(data);
			}
		});
	  }
  });
 $('#admissionForm').on('submit',(function(e) {
	
	 $.ajax({
			url:"admission.php",
			method:"post",
			data : $("#admissionForm").serialize(),
			dataType: 'json',
			success:function(data)
			{
				if(data.status)
				{
					$("#message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-check-circle"></i> Addmission Successfull. Student Unique ID Is : <b>'+data.studentID+'</b> And Registration Number  : <b>'+data.regno+'</b> <a target="_blank" href="printreceipt.php?id='+data.slno+'">Click Here</a> To Print The Receipt</div>');		
				//clearForm();
				
				}
				else{
				$("#message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error : Unable To Save ! </div>');		
				
				}
				
			}
 });
 e.preventDefault();
  return false;
 
 
 
 }));
	
function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	/* $(".fileinput-remove-button").click();	 */
}		    
$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
 $('#courseday').multiselect({
			   nonSelectedText:'Select Day',
			   enableFiltering:true,
			   enableCaseInsensitiveFiltering:true,
			   buttonWidth:'315px',
			   
			   });
$('input[type=file]').fileValidator({
  onInvalid:    function(type, file){ $(this).val(null); },
  type:        'image',
  maxSize:      '1m'
});
	
});     
</script>

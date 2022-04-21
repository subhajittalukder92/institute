<?php
session_start();
error_reporting(0);
include "include/no-cache.php";
include('include/menu.php');
include('include/dbconfig.php');
include "include/check-login.php";


function fetchRecords()
{
	include   'include/dbconfig.php';	
	$sql		="SELECT `note_info`.* ,payment.receipt_no,student_info.regno,payment.collect_by,payment.date,student_info.St_Name,student_info.Contact_no,pursuing_course.regno as regno FROM note_info INNER JOIN payment
	ON note_info.recpt_no=payment.receipt_no INNER JOIN student_info ON student_info.slno=note_info.student_id INNER JOIN pursuing_course ON pursuing_course.student_id=student_info.slno WHERE payment.collect_by='{$_SESSION['franchise_id']}' GROUP BY payment.receipt_no";
	/* ECHO $sql; */
	$res	   = mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$sql1 = "SELECT * FROM franchises WHERE  id='$_SESSION[franchises_id]'";
		$res1 = mysqli_query($conn, $sql1);
		$row1 = mysqli_fetch_assoc($res1);
		
		while($row= mysqli_fetch_assoc($res))
		{
			echo '<tr>
					<td style="text-align:center;">'.$row['receipt_no'].'</td>
					<td style="text-align:center;">'.date('d/m/Y',strtotime($row['date'])).'</td>
					<td style="text-align:center;">'.$row['2000_no'].'</td>
					<td style="text-align:center;">'.$row['500_no'].'</td>
					<td style="text-align:center;">'.$row['St_Name'].'</td>
					<td style="text-align:center;">'.$row['regno'].'</td>
					<td style="text-align:center;">'.$row['Contact_no'].'</td>
					<td style="text-align:center;">'.$row1['franchise_name'].'</td>
				
				</tr>';
				$admission += $row['ADMISSION'];
				$fine += $row['FINE'];
				$installment += $row['INSTALLMENT'];
				$prospectus += $row['PROSPECTUS'];
				$exam += $row['EXAM FEES'];
				$total += $row['TOTAL'] ;
		}

	}
}
function printIt($info)
{
	if($info != "0.00")
	{
		return $info;
	}
}

?>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Notes Information</h3>
			  	<div class="form-group">
						<label> Receipt No</label>
						<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Receipt No">
			
					</div>
			  		<br/>
					<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">RECEIPT NO    </th>
							<th style="text-align:center;font-size:12px;">DATE			</th>
							<th style="text-align:center;font-size:12px;">2000 NO		</th>
							<th style="text-align:center;font-size:12px;">500 NO		</th>
							<th style="text-align:center;font-size:12px;">STUDENT NAME 	</th>
							<th style="text-align:center;font-size:12px;">REGISTRATION NO</th>
							<th style="text-align:center;font-size:12px;">CONTACT NO</th>
							<th style="text-align:center;font-size:12px;">COLLECT BY	</th>
						</thead>
						<tbody id="myTable">
							<?php fetchRecords();?>
						</tbody>
					</table>
					</div>
					<!-- /col-md-6 -->
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
	 	<!-- /row -->
      </div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(e){
	function calculate()
	{
		var amount=parseFloat($.trim($('#amount').val())) || 0;
		var fine  =parseFloat($.trim($('#fine').val())) || 0;
		$('#total').val((amount + fine));
	}
	$('#amount').on('keyup',function(e){
		calculate();
	});
	$('#fine').on('keyup',function(e)
	{
		calculate();
	});
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
	$('#back').on('click',function(e)
	{
		window.location="collectform.php";
	});
});
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
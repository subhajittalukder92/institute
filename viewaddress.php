<?php session_start();
include "include/no-cache.php";
include "include/check-login.php";
function fetchRecords()
{
	include   ('include/dbconfig.php');	
	
	$sql		="SELECT * FROM `adress`
				";
	$res	   = mysqli_query($conn,  $sql);
	$no        = 0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td style="text-align:center;">'.++$no.'</td>
				<td style="text-align:center;">'.$row['id'].'</td>
				<td style="text-align:center;">'.$row['address'].'</td>
				<td style="text-align:center;">'.$row['po'].'</td>
				<td style="text-align:center;">'.$row['ps'].'</td>
				<td style="text-align:center;">'.$row['pin'].'</td>
				<td style="text-align:center;">'.$row['district'].'</td>
			</tr>';
	}
}

?>
<?php include "include/menu.php";?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Address Book</h3>
					<table id="editable_table" class="table table-bordered">
						<thead>
							<th style="text-align:center;font-size:12px;">SL NO		</th>
							<th style="text-align:center;font-size:12px;">ID		</th>
							<th style="text-align:center;font-size:12px;">ADDRESS  </th>
							<th style="text-align:center;font-size:12px;">P.O.	   </th>
							<th style="text-align:center;font-size:12px;">P.S.	   </th>
							<th style="text-align:center;font-size:12px;">PIN	    </th>
							<th style="text-align:center;font-size:12px;">DISTRICT  </th>
						
						</thead>
						<tbody>
							<?php fetchRecords();?>
						</tbody>
					</table>

		
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
	
	$('#editable_table').Tabledit({
		url:"editAddress.php",
		columns:{
			identifier:[1,"id"],
			editable:[[2,'address'],[3,'po'],[4,'ps'],[5,'pin'],[6,'district']]
			},
			restoreButton:false,
			onSuccess:function(data,status,jqXHR)
			{
				if(data.action == "delete")
				{
					if(data.result == "success")
					{
						$('#'+data.id).remove();
						
					}
					
					if(data.result == "failed")
					{
						alert("ERROR : Unable To Delete The Record.");
						
					}
				}
			}
		
	});
	
});
</script>
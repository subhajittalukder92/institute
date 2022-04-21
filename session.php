<?php session_start();
include "include/no-cache.php";
include "include/check-login.php";
function fetchRecords()
{
	include   ('include/dbconfig.php');	
	
	$sql		="SELECT * FROM `courses`
				";
	$res	   = mysqli_query($conn,  $sql);
	$no        = 0;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td style="text-align:center;">'.++$no.'</td>
				<td style="text-align:center;">'.$row['course_id'].'</td>
				<td style="text-align:center;">'.$row['course_name'].'</td>
				<td style="text-align:center;">'.$row['description'].'</td>
				<td style="text-align:center;">'.sprintf('%0' . 3 . 's', $row['course_id']).'</td>
				<td style="text-align:center;">'.$row['duration'].'</td>
				<td style="text-align:center;">'.$row['course_fee'].'</td>
				<td style="text-align:center;">'.$row['fee_type'].'</td>
			</tr>' ;
	}
}

?>
<?php include "include/menu.php";?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	          <h3 class="page-header">Session Setting</h3>
			  <button id="addMember" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add New</button><br/>
			  <p>&nbsp;</p>
			  <div class="clearfix"></div>
			  <div class="table-responsive">
					<table id="example" class="table table-stripped">
						<thead>
							<th >SL NO			        </th>
							<th >Session Description	</th>
							<th >Session Code			</th>
							<th >Status			</th>
							<th >Action			</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
		
		  		<!-- /col-md-6 -->
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
	 	<!-- /row -->
      </div>
	  <!-- Modal-->
	  
			</div>
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Session</h4>
          </div>
		  <form method="post" id="createForm" class="form-horizontal" action="sessionCreate.php">
          <div class="modal-body">
		  <div class="messages"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					 <label class="col-sm-4 control-label">Session Description</label>
					 <div class="col-sm-6">
						<input type="text" name="description" id="description" class="form-control" required>

					</div>
					
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">Session Code</label>
					 <div class="col-sm-6">
						<input type="text" name="sessionCode" id="sessionCode" class="form-control"  required>
					</div>
				</div>
				<div class="form-group">
                  <label class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-6">
                    <select class="form-control"  id="status" name="status" required="required" >
						<option value="">-Select-</option>
						<option value="ACTIVE">ACTIVE</option>
						<option value="DEACTIVE">DEACTIVE</option>
					</select>
				  </div>
                </div>
				
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" id="modalSave"  class="btn btn-primary antosubmit">Save changes</button>
          </div>
		  </form>
        </div>
      </div>
	  
    </div>
	<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Session</h4>
          </div>
		  <form method="post" id="updateMemberForm" class="form-horizontal" action="updateSession.php">
          <div class="modal-body">
		  <div class="editMessage"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">Session Description</label>
					<div class="col-sm-6">
						<input type="text" name="editDescription" id="editDescription" class="form-control" required>

					</div>
					
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">Session Code</label>
					 <div class="col-sm-6">
						<input type="text" name="editSession" id="editSession" class="form-control" required>
					</div>
				</div>
				<div class="form-group">
                  <label class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-6">
                    <select class="form-control"  id="editStatus" name="editStatus" required="required" required>
						<option value="">-Select-</option>
						<option value="ACTIVE">ACTIVE</option>
						<option value="DEACTIVE">DEACTIVE</option>
					</select>
					<input type="hidden" name="memberId" id="memberId">
				  </div>
                </div>
				
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" id="modalSave"  class="btn btn-primary antosubmit">Save changes</button>
          </div>
		  </form>
        </div>
      </div>
	  
    </div>
		<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
		  <div class="modal-dialog" role="document">
		  <div class="modal-content">
		  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title"><i class="fa fa-warning"></i> Warning</h4>
		  </div>
		  <div class="modal-body">
		  <font color="red">Do You Really Want To Remove This Info?</font>
		  </div>
		  <div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  <button type="button" class="btn btn-danger" id="removeBtn" name="removeBtn">Yes</button>
		  </div>
		  </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
	</div>
		</div>
	</div>
</div>
</div>
	    <!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">
</script>
<!--MultiSelect -->
<script type="text/javascript" src="docs/js/prettify.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
	var table= $('#example').DataTable({
		"ajax":"sessionRetrieve.php",
		"paging":false,
		"order":[]
		});
	$(document).ready(function() {
		
		$('#addMember').on('click',function(){
			$('.messages').html("");
			$('#createForm')[0].reset();
		});
		$('#sessionCode').on('focus',function(){
			 $.ajax({
				url: "getSessionCode.php",
				type: "POST",
				success:function(response)
				{
					$('#sessionCode').val(response) ;
				}
			});
		});
		
		 
		$('#createForm').unbind('submit').bind('submit',function(e){
			     
		var form	  = $(this);
		       $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType : 'json',
                    success:function(response) {
 
                        // remove the error 
                        $(".form-group").removeClass('has-error').removeClass('has-success');
 
                        if(response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
 
                            // reset the form
                            $("#createForm")[0].reset();      
 
                            // reload the datatables
                            table.ajax.reload(null, false);
                            // this function is built in function of datatables;
                        } else {
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                        } // /else
                    } // success 
                });
		

		return false;
		
	});
	});

function editMember(id = null) 
{

/* 	alert(id); */
    if(id) {

        $.ajax({
            url: 'getSelectedSession.php',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
                $("#editDescription").val(response.description);
                $("#editSession").val(response.session_code);
                $("#editStatus").val(response.status);
                $("#memberId").val(response.slno);

              
                $("#updateMemberForm").unbind('submit').bind('submit', function() {
                 
                    var form = $(this);
 
                       $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response)
							{
                                if(response.success == true) {
                                    $(".editMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                     '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');
 
                                   
                                    table.ajax.reload(null, false);
                                  
 
                                } else {
                                    $(".editMessage").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                     '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                    '</div>')
                                }
                            } // /success
                        }); // /ajax
                  
 
                    return false;
                });
 
            } 
        }); 
 
    } else {
        alert("Error : Refresh the page again");
    }
}
function removeMember(id=null)
{
	if(id)
	{
		$('#removeBtn').unbind('click').bind('click',function()
		{

			 $.ajax({
                url: 'removeQuestion.php',
                type: 'post',
                data: {member_id : id},
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {                      
                        $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
 
                        // refresh the table
                        table.ajax.reload(null, false);
 
                        // close the modal
                        $("#removeMemberModal").modal('hide');
 
                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                    }
                }
            }); 
			
		});
	}
	
}
	
</script>
</body>
</html>

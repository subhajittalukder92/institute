<?php 
session_start();
include "include/menu.php";
function getCourses()
{
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `courses` ORDER BY `course_name`";
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
function getExamName()
{
	include "include/dbconfig.php";
	
	$sql="SELECT * FROM `examinfo`";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	$option='';
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['id'].'">'.$row['exam_name'].'</option>';
	}
	echo $option;
}
?>

        <div id="page-wrapper">
		<div class="container-fluid">
					   <div class="row">
			 
            <!--    <div class="x_panel">
                   <div class="x_content"> -->
				    <h3 class="page-header">Rules and Description</h3>
			<form id="myForm" method="post" action="insertRule.php" enctype="multipart/form-data">
				<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label>Exam Name</label>
							<select class="form-control" name="examid" id="examid" required>
								<option value="">--Select--</option>
								<?php getExamName();?>
							</select>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<label>Rules & Description</label>
							<input type="text" class="form-control" name="desc" id="desc" required>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 col-md-2 col-sm-offset-5 col-md-offset-5">
							<button type="submit" class="btn btn-info form-control">Submit</button>
						</div>
					</div>
					<div class="clearfix"></div>
			</form>
				<div>&nbsp;</div>
				<div class="table-responsive">
				<table id="example" class="table table-stripped">
                         <thead>
                          <th style="text-align:left;">SLNO </th>
                          <th style="text-align:center;">Exam Name</th>
                          <th style="text-align:center;">Rules </th>
						  <th style="text-align:center;">Action </th>
                        </thead>
                      <tbody>
                      </tbody>
                  </table>
<!-- /panel -->		
			</div>
                  <!--</div>
                </div>-->
				
				</div>
				</div>

	
<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMemberModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Update Description</h4>
          </div>
		  <div id="editMessage"></div>
		  <form method="post" id="updateMemberForm" class="form-horizontal" action="updateDescription.php">
			  <div class="modal-body">
			  <div class="messages"></div>
				<div id="testmodal" style="padding: 5px 20px;">
					<div class="form-group">
					  <label class="col-sm-2 control-label">Description</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="description" name="description" required="required"> 
						<input type="hidden" id="q_id" name="q_id">
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
		  <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Warning</h4>
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
        <!-- /#page-wrapper -->


	
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
<!-- CK Editor -->
<script src="ckeditor/ckeditor.js"></script>

    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <script>
/*    CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('question'); */
//var examid=$('#examid').val();
/* 	var table= $('#example').DataTable({
		"ajax": {
			  "url": "retrieveLoginInfo.php",
			  "type": 'POST',
			  "data" : {
					'examid':$('#examid').val()
					
				}
		},
		'paging':false,
		'searching': false,
		'columnDefs': [
		  {
			  "targets": 0, // your case first column
			  "className": "text-center",
			  "width": "1%"
		 },
		 {
			  "targets": 1,
			  "className": "text-center",
		 },
		 {
			  "targets": 2,
			  "className": "text-center",
		 },
		 {
			  "targets": 3,
			  "className": "text-center",
		 },

		 ],
		"order":[]
	});	 */	
$(document).ready(function(){

	$('#updateMemberForm').unbind('submit').bind('submit',function(e){
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
                               
 
                            // reload the datatables
                           /*  table.ajax.reload(null, false); */
						   reload($('#examid').val());
						     $("#editMemberModal").modal('hide');
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
	$('#myForm').unbind('submit').bind('submit',function(e){
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
                               
 
                            // reload the datatables
                           reload($('#examid').val());
						   $('#studentid').html("");
							$('#studentid').multiselect('rebuild');
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
	$('.messages').html("");
	$('#updateMemberForm')[0].reset();
	/* alert(id); */
    if(id) 
	{

        $.ajax({
            url: 'getSelectedDescription.php',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
				/* alert(response.id); */
                $("#description").val(response.particular);
                $("#q_id").val(response.slno);
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
                url: 'removeDescription.php',
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
                        reload($('#examid').val());
 
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


$('#examid').on('change',function(e){
	 
		reload($('#examid').val());
});
function reload(examid)
{
$('#example').DataTable({
   "serverSide": true,
   "ajax": {
      "url": "retrieveDescription.php",
      "type": "POST",
      "data": {
         'examid': examid
      },
	  "destroy" : true
   },
   'columnDefs': [
		  {
			  "targets": 0, // your case first column
			  "className": "text-center",
			  "width": "1%"
		 },
		 {
			  "targets": 1,
			  "className": "text-center",
		 },
		 {
			  "targets": 2,
			  "className": "text-center",
		 },
		 {
			  "targets": 3,
			  "className": "text-center",
		 },
		 ],
		"order":[]
});
$('#example').DataTable().ajax.reload(null, false);
$("#example").dataTable().fnDestroy();
}
 
    </script>

</body>

</html>
	
	

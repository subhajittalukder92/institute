<?php 
session_start();
include "include/no-cache.php";
include "include/check-login.php";
include "include/menu.php";
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
	        <h3 class="page-header">Download Section</h3>
			<button id="addMember" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add New</button><br><p>&nbsp;</p>
			<div class="clearfix"></div>
			<div class="table-responsive">
				<table id="example" class="table table-stripped">
					<thead>
						<th>SL NO</th>
						<th>Title</th>
						<th>File</th>
						<th>Action</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
      	</div>
	</div>
<!-- insert modal -->
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Add Download</h4>
          </div>
		  <form method="post" id="createForm" enctype="multipart/form-data" class="form-horizontal" action="addDownloads.php">
	          <div class="modal-body">
			  <div class="messages"></div>
					<div class="form-group">
						 <label class="col-sm-3 control-label">Heading</label>
						 <div class="col-sm-9">
							<input type="text" name="title" id="title" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						 <label class="col-sm-3 control-label">Upload File</label>
						 <div class="col-sm-9">
							<input type="file" name="file" id="file" class="form-control"  required>
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

<!-- edit modal -->
	<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Session</h4>
          </div>
		  <form method="post" id="updateMemberForm" enctype="multipart/form-data" class="form-horizontal">
          <div class="modal-body">
          	<input type="hidden" name="memid" id="memid" class="form-control">
		  <div class="editMessage"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					<label class="col-sm-4 control-label">Heading</label>
					<div class="col-sm-6">
						<input type="text" name="title" id="editHeading" class="form-control">
					</div>
				</div>
				<div class="form-group">
					 <label class="col-sm-4 control-label">File</label>
					 <div class="col-sm-6">
						<input type="file" name="file" id="editFile" class="form-control">
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

<!-- delete modal -->
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
		"ajax":"getDownloads.php",
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
		
		$('#createForm').on('submit',function(e){
			e.preventDefault();
			     let formData = new FormData();
			     
			     formData.append("file", $('#file').prop("files")[0]);
			       formData.append("title",$('#title').val());
		 $.ajax({
                url: "addDownloads.php",
                data: formData,
                dataType: 'json',
                type: "POST",
                cache: false,
                processData: false,
                contentType: false,
                enctype: "multipart/form-data",
                success: function(response) {
                    let option = '';
                    if (response.success) {
                         $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                             '</div>');
                         $("#createForm")[0].reset(); 
                          table.ajax.reload(null, false);
                    } else {
                       
                    }
                }
            });
	});
		$("#updateMemberForm").on('submit', function(e) {

					e.preventDefault();
					let formData = new FormData();
			     	formData.append("file", $('#editFile').prop("files")[0]);
			        formData.append("title",$('#editHeading').val());
			        formData.append("id",$('#memid').val());
                 
                   
 
                       $.ajax({
			                url: "updateDownload.php",
			                data: formData,
			                dataType: 'json',
			                type: "POST",
			                cache: false,
			                processData: false,
			                contentType: false,
			                enctype: "multipart/form-data",
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
	});
function editMember(id = null) 
{
    if(id) {
        $.ajax({
            url: 'getSelectedDownload.php',
            type: 'post',
            data: {id : id},
            dataType: 'json',
            success:function(response) {
                $("#editHeading").val(response.title);
                //$("#editFile").val(response.file);
                $("#memid").val(response.id);

                
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
                url: 'removeDonload.php',
                type: 'post',
                data: {id : id},
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

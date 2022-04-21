<?php 
session_start();
include "include/menu.php";
?>

        <div id="page-wrapper">
		<div class="container-fluid">
					   <div class="row">
			 
            <!--    <div class="x_panel">
                   <div class="x_content"> -->
				    <h3 class="page-header">New Exam</h3>
				  <div class="panel panel-default" tabindex="-1">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Questions</div>
			</div> <!-- /panel-heading -->
			 <div class="table-responsive"> 
			<div class="panel-body">
			  <div class="removeMessages"></div>
				<button type="button" data-toggle="modal" id="addMember" data-target="#myModal"  class="btn btn-default pull-right"><i class="fa fa-plus-circle">  </i>   Add New</button>
				  <table id="example" class="table table-stripped">
                         <thead>
                          <th style="text-align:left;">SLNO </th>
                          <th style="text-align:center;">QUESTION </th>
                          <th style="text-align:center;">OP-A </th>
                          <th style="text-align:center;">OP-B </th>
                          <th style="text-align:center;">OP-C </th>
                          <th style="text-align:center;">OP-D </th>
                          <th style="text-align:center;">ANSWER </th>
						  <th style="text-align:center;">ACTION</th>
                        </thead>
                      <tbody>
                      </tbody>
                  </table>
					
		</div>
</div>					<!-- /panel-body -->
		</div> <!-- /panel -->		
                  <!--</div>
                </div>-->
				
				</div>
				</div>
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Question</h4>
          </div>
		  <form method="post" id="createForm" class="form-horizontal" action="questionCreate.php">
          <div class="modal-body">
		  <div class="messages"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					 <label class="col-sm-2 control-label">Set No</label>
					 <div class="col-sm-10">
						<select class="form-control"  id="set_no" name="set_no" required="required">
								<option value="">-Select-</option>
								<option value="SET-1">SET-1</option>
								<option value="SET-2">SET-2</option>
								<option value="SET-3">SET-3</option>							
						</select>
					</div>
					<input type="hidden" name="examid" id="examid" value="<?php echo $_GET['examid']?>">
				</div>
				<div class="form-group">
					 <label class="col-sm-2 control-label">Question</label>
					 <div class="col-sm-10">
						<textarea class="form-control"  name="question" id="question" required></textarea>
					</div>
				</div>
				
                <div class="form-group">
                  <label class="col-sm-2 control-label">Option A</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="op_a" name="op_a" required="required"> 
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-2 control-label">Option B</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="op_b" name="op_b" required="required"> 
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-2 control-label">Option C</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="op_c" name="op_c" required="required"> 
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-2 control-label">Option D</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="op_d" name="op_d" required="required"> 
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Answer</label>
                  <div class="col-sm-10">
                    <select class="form-control"  id="answer" name="answer" required="required">
					<option value="">-Select-</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
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
	
<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMemberModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">New Question</h4>
          </div>
		  <form method="post" id="updateMemberForm" class="form-horizontal" action="updateQuestion.php">
          <div class="modal-body">
		  <div class="messages"></div>
            <div id="testmodal" style="padding: 5px 20px;">
				<div class="form-group">
					 <label class="col-sm-2 control-label">Set No</label>
					 <div class="col-sm-10">
						<select class="form-control"  id="eset_no" name="eset_no" required="required">
								<option value="">-Select-</option>
								<option value="SET-1">SET-1</option>
								<option value="SET-2">SET-2</option>
								<option value="SET-3">SET-3</option>							
						</select>
					</div>
					<input type="hidden" id="q_id" name="q_id">
				</div>
				<div class="form-group">
					 <label class="col-sm-2 control-label">Question</label>
					 <div class="col-sm-10">
						<textarea class="form-control"  name="equestion" id="equestion" required></textarea>
					</div>
				</div>
				
                <div class="form-group">
                  <label class="col-sm-2 control-label">Option A</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="eop_a" name="eop_a" required="required"> 
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-2 control-label">Option B</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="eop_b" name="eop_b" required="required"> 
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-2 control-label">Option C</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="eop_c" name="eop_c" required="required"> 
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-2 control-label">Option D</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="eop_d" name="eop_d" required="required"> 
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Answer</label>
                  <div class="col-sm-10">
                    <select class="form-control"  id="eanswer" name="eanswer" required="required">
						<option value="">-Select-</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
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
var examid=$('#examid').val();
	var table= $('#example').DataTable({
		"ajax": {
			  "url": "retrieve.php",
			  "type": 'POST',
			  "data" : {
					'examid':examid
				}
		},
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
		 {
			  "targets": 4,
			  "className": "text-center",
		 },
		 {
			  "targets": 5,
			  "className": "text-center",
		 }, 
		 {
			  "targets": 6,
			  "className": "text-center",
		 }, 
		 {
			  "targets": 7,
			  "className": "text-center",
		 },
		 ],
		"order":[]
	});
$(document).ready(function(){
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
	$('.editMessage').html("");
	$('#updateMemberForm')[0].reset();
	/* alert(id); */
    if(id) 
	{

        $.ajax({
            url: 'getSelectedPoint.php',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
				/* alert(response.set_no); */
                $("#eset_no").val(response.set_no);
                $("#equestion").val(response.questn);
                $("#eop_a").val(response.op_a);
                $("#eop_b").val(response.op_b);
                $("#eop_c").val(response.op_c);
                $("#eop_d").val(response.op_d);
                $("#eanswer").val(response.answer);
                $("#q_id").val(response.id);

 
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
	
	

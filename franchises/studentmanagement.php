<?php session_start();
include "include/no-cache.php";
include "include/check-login.php";
function fetchRecords()
{
    include('include/dbconfig.php');

    $sql        = "SELECT * FROM `courses`
				";
    $res       = mysqli_query($conn,  $sql);
    $no        = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        echo '<tr>
				<td style="text-align:center;">' . ++$no . '</td>
				<td style="text-align:center;">' . $row['course_id'] . '</td>
				<td style="text-align:center;">' . $row['course_name'] . '</td>
				<td style="text-align:center;">' . $row['description'] . '</td>
				<td style="text-align:center;">' . sprintf('%0' . 3 . 's', $row['course_id']) . '</td>
				<td style="text-align:center;">' . $row['duration'] . '</td>
				<td style="text-align:center;">' . $row['course_fee'] . '</td>
				<td style="text-align:center;">' . $row['fee_type'] . '</td>
			</tr>';
    }
}

?>
<?php include "include/menu.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="removeMessages"></div>
            <h3 class="page-header">Student Management Setting</h3>
            <a href="newstudentadd.php" class="btn btn-default pull-right"><i class="fa fa-plus-circle"></i> Add New</a><br>
            <p>&nbsp;</p>
            <div class="clearfix"></div>
            <div class="table-responsive">
                <table id="example" class="table table-stripped">
                    <thead>
                        <th>SL NO </th>
                        <th>Student Name </th>
                        <th>Father Name </th>
                        <th>DOB </th>
                        <th>Gender </th>
                        <th>Religion </th>
                        <th>Date OF Admission </th>
                        <th>Registration No </th>
                        <th>Action </th>
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


     <!-- remove modal -->
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
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
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
<script type="text/javascript" src="../docs/js/prettify.js"></script>
<script type="text/javascript" src="../dist/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    
    var table = $('#example').DataTable({
        "ajax": "retrieveStudent.php",
        "paging": false,
        "order": []
    });
    $(document).ready(function() {


        $('#addMember').on('click', function() {
            $('.messages').html("");
            $('#createForm')[0].reset();
            $('#updateMemberForm')[0].reset();
        });
        $('#sessionCode').on('focus', function() {
            $.ajax({
                url: "getSessionCode.php",
                type: "POST",
                success: function(response) {
                    $('#sessionCode').val(response);
                }
            });
        });


        $('#createForm').unbind('submit').bind('submit', function(e) {

            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {

                    // remove the error 
                    $(".form-group").removeClass('has-error').removeClass('has-success');

                    if (response.success == true) {
                        $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');

                        // reset the form
                        $("#createForm")[0].reset();

                        // reload the datatables
                        table.ajax.reload(null, false);
                        // this function is built in function of datatables;
                    } else {
                        $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                    } // /else
                } // success 
            });


            return false;

        });
    });

    function editMember(id = null) {

        $('#editMessage').html("");
        if (id) {

            window.location="newAdmitionEdit.php?id="+id;

        } else {
            alert("Error : Refresh the page again");
        }
    }

    function removeMember(id = null) {
        if (id) {
            $('#removeBtn').unbind('click').bind('click', function() {
            
                $.ajax({
                    url: 'newAdmitionDelete.php',
                    type: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // refresh the table
                            table.ajax.reload(null, false);

                            // close the modal
                            $("#removeMemberModal").modal('hide');

                        } else {
                            $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
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
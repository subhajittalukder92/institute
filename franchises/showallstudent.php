<?php
session_start();
include "include/dbconfig.php";
include "../functions.php";
$franchises =  json_decode(getFranchises(), true);
$courses    =  json_decode(getCourses(), true);
$sessions   =  json_decode(getSessions(), true);
error_reporting(0);

?>

<?php include "include/menu.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <!--    <div class="x_panel">
                   <div class="x_content"> -->
            <h3 class="page-header">Marks Tabulation</h3>

            <!-- <form action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="POST"> -->
            <div class="form-group">

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <label>Session</label>
                    <select name="session" id="session" class="form-control">
                        <option value="">Select Session</option>
                        <?php
                        if (count($sessions['records']) > 0) {
                            foreach ($sessions['records'] as $key => $sessions) {
                                echo '<option value="' . $sessions . '">' . $sessions . '</option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <!-- <div class="col-md-3 col-sm-3 col-xs-12"> -->

                <!-- <label>Franchise</label> -->
                <!-- <select name="franchise" id="franchise" class="form-control">
                        <option value="">Select Franchise</option>
                        <?php
                        // if (count($franchises['records']) > 0) {
                        //     foreach ($franchises['records'] as $key => $franchise) {
                        //         echo '<option value="' . $franchise['id'] . '">' . $franchise['franchise_name'] . '</option>';
                        //     }
                        // }

                        ?>
                    </select> -->
                <!-- </div> -->
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <label>Course</label>
                    <select name="course" id="course" class="form-control">
                        <option value="">Select Course</option>
                        <?php
                        if (count($courses['records']) > 0) {
                            foreach ($courses['records'] as $key => $course) {
                                echo '<option value="' . $course['id'] . '">' . $course['course_name'] . '</option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <!-- <div class="col-md-3 col-sm-3 col-xs-12">
					<label>Subject</label>
					<select name="subject" id="subject" class="form-control">
						<option value="">Select Subject</option>
					</select>
				</div> -->
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <label>&nbsp;</label>
                    <button type="button" id="search" class="btn btn-info form-control">Search</button>
                </div>


                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <div class="col-sm-2 col-md-2 col-sm-offset-5 col-md-offset-5">

                </div>
            </div>
            <div class="clearfix"></div>

            <div>&nbsp;</div>
            <div class="table-responsive">
                <?php if (!empty($successMsg)) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success:</strong> <?php echo $successMsg; ?>
                    </div>
                <?php } ?>
                <!-- <input type="hidden" name="formid" id="formid" value="<?php //echo htmlspecialchars($_SESSION['formid']); ?>"> -->

                <table id="example" class="table table-stripped table-condensed">

                </table>


                <!-- /panel -->
            </div>

            <!--</div>
                </div>-->

        </div>
    </div>


    <div id="marksEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMemberModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Update Marks</h4>
                </div>
                <div id="editMessage"></div>
                <form method="post" id="updateMemberForm" class="form-horizontal" action="update-marks.php">
                    <div class="modal-body">
                        <div class="messages"></div>
                        <div id="testmodal" style="padding: 5px 20px;">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Name:</label>
                                <div class="col-sm-8">
                                    <label class="col-sm-8 control-label" id="editStudentName"></label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Registration No:</label>
                                <div class="col-sm-8">
                                    <label class="col-sm-8 control-label" id="editRegNo"></label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Full Marks:</label>
                                <div class="col-sm-8">
                                    <label class="col-sm-8 control-label " id="editFullMarks"></label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Obtained Marks:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="editObtainedMarks" name="editObtainedMarks">
                                    <input type="hidden" id="editMarksDetailId" name="editMarksDetailId">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                        <button type="submit" id="modalSave" class="btn btn-primary antosubmit">Save changes</button>
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
</div>
<!-- /#page-wrapper -->

<?php include('include/footer.php'); ?>
</body>

</html>




<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);
        });
        $(document).ajaxComplete(function() {
            $("#overlay").fadeOut(300);
        });

        $('#updateMemberForm').on('submit', function(e) {
            e.preventDefault();
            marksDetailId = $('#editMarksDetailId').val();
            obtainedMark = parseFloat($('#editObtainedMarks').val()) || 0;
            fullMarks = parseFloat($('#fullMarks' + marksDetailId).val()) || 0;

            if (obtainedMark <= fullMarks) {
                $.ajax({
                    url: "update-marks.php",
                    type: "POST",
                    data: {
                        "marks_detail_id": marksDetailId,
                        'obtained_marks': $('#editObtainedMarks').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#marksEdit').modal('hide');
                            $('#obtainedMarksData' + marksDetailId).html($('#editObtainedMarks').val());
                            $('#obtainedMarks' + marksDetailId).val($('#editObtainedMarks').val());
                        }
                    }
                });
            } else {
                alert("Obtained marks can not be greater than full marks.");
            }

            return false;
        });


        $('#search').on('click', function(e) {
            // e.preventDefault();
            $('#example tbody').html("");
            var form = $('#myForm');
            $('#example').html("");
            $.ajax({
                url: "fetch-tabulation.php",
                type: "POST",
                data: {
                    
                    "course": $('#course').val(),
                    "session": $('#session').val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '';
                    let thead = '<thead>';
                    let tbody = '<tbody>';
                    let tr = '';

                    if (response.success) {
                        for (let key in response.heads) {
                            thead += '<th style="text-align:center;">' + response.heads[key] + '</th>';
                        }
                        thead += '</thead>';
                        if (response.records.length > 0) {
                            for (i = 0; i < response.records.length; i++) {
                                console.log(response.records[i]);
                                let tempTr = '<tr>';
                                for (let key in response.records[i]) {
                                    tempTr += '<td style="text-align:center;">' + response.records[i][key] + '</td>';
                                    //console.log();
                                }
                                tempTr += '</tr>';
                                tr += tempTr;
                            }
                        }



                        tbody += tr + '</tbody>';
                    }

                    $('#example').html(thead + tbody);
                }
            });
            return false;
        });
    });




    function showModal(marksDetailId) {
        //alert(marksDetailId);
        $('#editObtainedMarks').val($('#obtainedMarks' + marksDetailId).val());
        $('#editStudentName').html($('#studentName' + marksDetailId).val());
        $('#editRegNo').html($('#regno' + marksDetailId).val());
        $('#editFullMarks').html($('#fullMarks' + marksDetailId).val());
        $('#editMarksDetailId').val(marksDetailId);

        $('#marksEdit').modal('show');
    }
</script>

</body>

</html>
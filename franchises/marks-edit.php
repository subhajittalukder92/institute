<?php
session_start();
include "include/dbconfig.php";
include "../functions.php";
$franchises =  json_decode(getFranchises(), true);
$courses    =  json_decode(getCourses(), true);
$sessions   =  json_decode(getSessions(), true);
$successMsg = "";
if (isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid']) {
    extract($_POST);
    $createdAt  = date('Y-m-d H:i:s');
    $submitBy   = $_SESSION['userid'];
    $totalMarks = getTotalMarksByCourse($course);
    $data       = json_decode(getCourses($course), true);
    $courseInfo = json_encode($data['records'][0]);
    $franchiseRecords = json_decode(getFranchises($franchise), true);
    $franchiseInfo    =  json_encode($franchiseRecords['records'][0]);

    for ($i = 0; $i < count($_POST['obtainedMarks']); $i++) {
        $obtainedMarks =  $_POST['obtainedMarks'][$i];
        $fullMarks     =  $_POST['fullMarks'][$i];
        $admissionId   =  $_POST['admissionId'][$i];
        $studentId     =  $_POST['studentId'][$i];
        $marksId       =  getMarksTable($studentId, $course, $admissionId, $franchise, $totalMarks, $courseInfo, $franchiseInfo);

        $query = "INSERT INTO `marks_details`( `marks_id`, `subject_id`, `full_marks`, `obtained_marks`) 
                 VALUES ('$marksId', '$subject', '$fullMarks', '$obtainedMarks')";
        $ress  = mysqli_query($conn, $query);

        $totalObtainedMarks = getObtainedMarks($marksId);

        $updateQuery = "UPDATE `marks` SET  `franchise_info`='$franchiseInfo', `student_id`='$studentId',
                       `course_id`='$course', `course_info`='$courseInfo', `total_marks`='$totalMarks', `obtained_marks`='$totalObtainedMarks',
                       `submit_by`='$submitBy' WHERE `id` = '$marksId'";
        $updateQueryress = mysqli_query($conn, $updateQuery);
    }
    $successMsg = "Marks saved succesfully.";

    $_SESSION['formid'] = md5(rand(0, 10000000));
} else {
    $_SESSION['formid'] = md5(rand(0, 10000000));
}

function getMarksTable($studentId, $courseId, $admissionId, $franchiseId, $totalMarks, $courseInfo, $franchiseInfo)
{
    include "include/dbconfig.php";
    require_once "functions.php";

    $createdAt = date('Y-m-d H:i:s');
    $submitBy  = $_SESSION['userid'];
    $marksId = "";


    $sql = "SELECT * FROM `marks` WHERE `admission_id`='$admissionId' AND `franchise_id`='$franchiseId' 
            AND `student_id`='$studentId' AND `course_id`='$courseId' LIMIT 1";

    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $marksId = $row['id'];
    } else {
        $sql = "INSERT INTO `marks`( `admission_id`, `franchise_id`, `franchise_info`, `student_id`, `course_id`, `course_info`, `total_marks`,`submit_by`, `created_at`) 
        VALUES ('$admissionId', '$franchiseId', '$franchiseInfo', '$studentId', '$courseId', '$courseInfo', '$totalMarks', '$submitBy', '$createdAt')";
        $res = mysqli_query($conn, $sql);
        $marksId = mysqli_insert_id($conn);
    }

    return $marksId;
}

function getObtainedMarks($marksId)
{
    include "include/dbconfig.php";

    $totalMarks = 0;

    $sql = "SELECT * FROM `marks_details` WHERE `marks_id`= '$marksId'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            extract($row);
            $totalMarks += $obtained_marks;
        }
    }

    return $totalMarks;
}
?>

<?php include "include/menu.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <!--    <div class="x_panel">
                   <div class="x_content"> -->
            <h3 class="page-header">Marks Edit</h3>

            <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> -->
            <div class="form-group">

                <div class="col-md-2 col-sm-2 col-xs-12">
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
                <input type="hidden" name="franchise" id="franchise" value="<?php echo $_SESSION['franchise_id']; ?>">
                <div class="col-md-2 col-sm-2 col-xs-12">
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
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <label>Subject</label>
                    <select name="subject" id="subject" class="form-control">
                        <option value="">Select Subject</option>
                    </select>
                </div>
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
                <input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']); ?>">
                <table id="example" class="table table-stripped">
                    <thead>
                        <th style="text-align:left;"># </th>
                        <th style="text-align:center;">Name</th>
                        <th style="text-align:center;">Registration No </th>
                        <th style="text-align:center;">Full Marks</th>
                        <th style="text-align:center;">Obtained Marks</th>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
                <!--    </form> -->

                <!-- /panel -->
            </div>

            <!--</div>
                </div>-->

        </div>
    </div>

</div>

<!-- /#page-wrapper -->


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class=" modal-title p-2">Update Marks</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="col-sm" id="myform">
                    <div>
                        <input type="hidden" class="form-control" id="m-id" style="display: none;" />
                        <input type="hidden" class="form-control" id="m-marks_id" style="display: none;" />
                        <label for="m-obtained_marks" class="form-label">Name</label>
                        <input type="number" class="form-control" id="m-obtained_marks" />
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success myWish" id="m-btnadd" data-dismiss="modal">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end Modal -->



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

<!-- modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
<script type="text/javascript">
    $(document).ready(function() {

        $('#m-btnadd').on('click', function() {
            id = $('#m-id').val();
            marks_id = $('#m-marks_id').val();
            obtained_marks = $('#m-obtained_marks').val();

            $.ajax({
                url: 'obtainMarksEdit.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': id,
                    'marks_id': marks_id,
                    'obtained_marks': obtained_marks,
                    'chk': ''
                },
                success: function(data) {
                    alert('Update Marks Successfully');
                    $('#tbody').html("");

                }
            })

        });


        $("tbody").on('click', '.btn-edit', function() {
            let id = $(this).attr("data-sid");
            $.ajax({
                url: 'obtainMarksEdit.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': id,
                    'chk': 'pre_edit'
                },
                success: function(data) {
                    $('#m-id').val(data.id);
                    $('#m-marks_id').val(data.marks_id);
                    $('#m-obtained_marks').val(data.obtained_marks);
                }
            })
            $('#obtainMarks').val()
        })

        $('#course').on('change', function(e) {
            var form = $('#myForm');
            $.ajax({
                url: "fetch-subjects.php",
                type: 'POST',
                data: {
                    "course": $('#course').val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '<option value="">Select Subject</option>';
                    if (response.success) {
                        for (i = 0; i < response.records.length; i++) {
                            option += '<option value="' + response.records[i].id + '">' + response.records[i].subject + '</option>';
                        }
                        $('#subject').html(option);
                    }
                }
            });

            return false;


        });

        $('#search').on('click', function(e) {
            // e.preventDefault();
            var form = $('#myForm');

            $.ajax({
                url: "fetch-marks.php",
                type: "POST",
                data: {
                    "franchise": $('#franchise').val(),
                    "course": $('#course').val(),
                    "session": $('#session').val(),
                    "subject": $('#subject').val()
                },
                dataType: 'json',
                success: function(response) {
                    let option = '';
                    if (response.success) {
                        for (i = 0; i < response.records.length; i++) {
                            option += '<tr>' +
                                '<td style="text-align:center;"><input type="hidden" value="' + response.records[i].pusuing_id + '"  name="admissionId[]" id="admissionId' + i + '">' + (i + 1) + '</td>' +
                                '<td style="text-align:center;"><input type="hidden" name="studentId[]" id="studentId' + response.records[i].student_id + '" value="' + response.records[i].student_id + '">' + response.records[i].St_Name + '</td>' +
                                '<td style="text-align:center;">' + response.records[i].regno + '</td>' +
                                '<td style="text-align:center;"><input type="hidden"  name="fullMarks[]" id="fullMarks' + i + '" value="' + response.records[i].full_marks + '">' + response.records[i].full_marks + '</td>' +
                                '<td style="text-align:center;"><input type="hidden" class="form-control" name="obtainedMarks[]" id="obtainedMarks' + i + '" value="' + response.records[i].obtained_marks + '">' + response.records[i].obtained_marks + '</td>' +
                                '<td style="text-align:center;"><button class="btn-sm btn btn-primary btn-edit" data-toggle="modal" data-target="#myModal"  data-sid="' + response.records[i].md_id + '" >Edit</button></td>' +
                                '</tr>';
                        }
                        $('#example tbody').html(option);
                    }
                }
            });
            return false;
        });
    });

    function editMember(id = null) {
        $('.messages').html("");
        $('#updateMemberForm')[0].reset();
        /* alert(id); */
        if (id) {

            $.ajax({
                url: 'getSelectedRecord.php',
                type: 'post',
                data: {
                    member_id: id
                },
                dataType: 'json',
                success: function(response) {
                    /* alert(response.id); */
                    $("#password").val(response.password);
                    $("#q_id").val(response.id);
                }
            });


        } else {
            alert("Error : Refresh the page again");
        }
    }

    function removeMember(id = null) {
        if (id) {
            $('#removeBtn').unbind('click').bind('click', function() {

                $.ajax({
                    url: 'removeRecord.php',
                    type: 'post',
                    data: {
                        member_id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // refresh the table
                            reload($('#examid').val(), $('#course').val(), $('#year').val(), $('#month').val());

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
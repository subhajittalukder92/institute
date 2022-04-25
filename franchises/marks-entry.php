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
    $submitBy   = $_SESSION['franchise_userid'];
    $totalMarks = getTotalMarksByCourse($course);
    $data       = json_decode(getCourses($course), true);
    $courseInfo = json_encode($data['records'][0]);
    $franchiseRecords = json_decode(getFranchises($_SESSION['franchise_id']), true);
    $franchiseInfo    =  json_encode($franchiseRecords['records'][0]);

    for ($i = 0; $i < count($_POST['obtainedMarks']); $i++) {
        $obtainedMarks =  $_POST['obtainedMarks'][$i];
        $fullMarks     =  $_POST['fullMarks'][$i];
        $admissionId   =  $_POST['admissionId'][$i];
        $studentId     =  $_POST['studentId'][$i];
        $marksId       =  getMarksTable($studentId, $course, $admissionId, $_SESSION['franchise_id'], $totalMarks, $courseInfo, $franchiseInfo);

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
    require_once "../functions.php";

    $createdAt = date('Y-m-d H:i:s');
    $submitBy  = $_SESSION['franchise_userid'];
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
            <h3 class="page-header">Marks Entry</h3>

         
                <div class="form-group">
                    <!-- <div class="col-md-3 col-sm-3 col-xs-12">

                        <label>Franchise</label>
                        <select name="franchise" id="franchise" class="form-control">
                            <option value="">Select Franchise</option>
                            <?php
                            //if (count($franchises['records']) > 0) {
                            //     foreach ($franchises['records'] as $key => $franchise) {
                            //         echo '<option value="' . $franchise['id'] . '">' . $franchise['franchise_name'] . '</option>';
                            //     }
                            // }

                            ?>
                        </select>
                    </div> -->
              
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Registration No</label>
                        <input type="text" name="regNo" id="regNo" class="form-control">
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
            <form id="marksForm" method="post" enctype="multipart/form-data" autocomplete="off" >
                <div class="table-responsive" id="insertDiv" style="display:">
                    <?php if (!empty($successMsg)) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success:</strong> <?php echo $successMsg; ?>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']); ?>">
                    <table class="table table-bordered table-condensed" id="marksTable">
                           
                    </table>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-success form-control">Save</button>
            </form>

            <!-- /panel -->
        </div>

        <!--</div>
                </div>-->

    </div>
</div>
</div>


<!-- modal -->
<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMemberModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update Password</h4>
            </div>
            <div id="editMessage"></div>
            <form method="post" id="updateMemberForm" class="form-horizontal" action="updateRecord.php">
                <div class="modal-body">
                    <div class="messages"></div>
                    <div id="testmodal" style="padding: 5px 20px;">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="password" name="password" required="required">
                                <input type="hidden" id="q_id" name="q_id">
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

<?php include('include/footer.php'); ?>
</body>

</html>


<!-- /#page-wrapper -->




<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
<script type="text/javascript">
    $(document).ready(function() {

        // $('#course').on('change', function(e) {
        //     var form = $('#myForm');
        //     $.ajax({
        //         url: "fetch-subjects.php",
        //         type: 'POST',
        //         data: {
        //             "course": $('#course').val()
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             let option = '<option value="">Select Subject</option>';
        //             if (response.success) {
        //                 for (i = 0; i < response.records.length; i++) {
        //                     option += '<option value="' + response.records[i].id + '">' + response.records[i].subject + '</option>';
        //                 }
        //                 $('#subject').html(option);
        //             }
        //         }
        //     });

        //     return false;


        // });
        
        $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);
        });
        $(document).ajaxComplete(function() {
            $("#overlay").fadeOut(300);
        });

        $('#search').on('click', function(e) {
            // e.preventDefault();
            var form = $('#myForm');

            $.ajax({
                url: "fetch-marks.php",
                type: "POST",
                data: {
                    "franchise": $('#franchise').val(),
                    "regno": $('#regNo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    let option ='';
                    let thead  ='<thead>';
                    let tbody  ='<tbody>';
                    let tr     ='';
                    if (response.success) {

                    for(let key in response.heads){
                        thead += '<th style="text-align:center;">'+response.heads[key]+'</th>';
                    }

                    thead += '</thead>';
                    if(response.records.length  > 0){
                    
                
                    for(i=0; i< response.records.length ; i++){
                        // console.log(response.records[i]);
                        let   jsonRows    = response.records[i].rows;
                        let   admissionId = response.records[i].admission_id;
                        let   studentId   = response.records[i].student_id;
                        let   marksId     = response.records[i].marks_id;
                        let   tempTr      = '<tr id="row'+(i+1)+'" class="marksRow">';
                        let   subjectCount= 1 ;
                        Object.entries(jsonRows).forEach(([key, value]) => {
                            let tempVal = value ;
                            
                            if (typeof(tempVal)=="object") {
                                let subjectDetails = '';
                                
                                Object.keys(tempVal).forEach(function (key) {
                                    if(key == "subject_id"){
                                        subjectDetails += '<input type="hidden" id="subject_id'+(i+1)+subjectCount+'" value="'+tempVal[key]+'">' ;
                                    }
                                    else if(key == "id"){
                                        subjectDetails += '<input type="hidden" id="marks_detail_id'+(i+1)+subjectCount+'" value="'+tempVal[key]+'">' ;
                                    }
                                    else if(key == "subject_name"){
                                        subjectDetails += '<input type="hidden" id="subject_name'+(i+1)+subjectCount+'" value="'+tempVal[key]+'">' ;
                                    }
                                    else if(key == "full_marks"){
                                        subjectDetails += '<input type="hidden" id="full_marks'+(i+1)+subjectCount+'" value="'+tempVal[key]+'">' ;
                                    }
                                    else if(key == "full_marks_theory"){
                                        subjectDetails += '<input type="hidden" id="subject_fm_theory'+(i+1)+subjectCount+'" value="'+tempVal[key]+'">' ;
                                    }
                                    else if(key == "marks_obtained_theory"){
                                        subjectDetails += '<table><tr><td><input type="text" placeholder="Theory Marks"  value="'+tempVal[key]+'" onkeyup="calculateTotalMarks('+(i+1)+')" class="form-control input-sm" id="subject'+(i+1)+subjectCount+'_theory"></td>' ;
                                        //  subjectDetails += '<input type="text" placeholder="Theory Marks" class="form-control input-sm" id="marks_obtained'+(i+1)+'">' ;
                                    }
                                    else if(key == "full_marks_practical"){
                                        subjectDetails += '<input type="hidden" id="subject_fm_practical'+(i+1)+subjectCount+'" value="'+tempVal[key]+'">' ;
                                    }
                                    else if(key == "marks_obtained_practical"){
                                        subjectDetails += '<td><input type="text" placeholder="Practical Marks" value="'+tempVal[key]+'"  onkeyup="calculateTotalMarks('+(i+1)+')" class="form-control input-sm" id="subject'+(i+1)+subjectCount+'_practical"></td></tr></table>';
                                    }
                                });
                                tempTr += '<td style="text-align:center;" id="td'+(i+1)+key+'">'+subjectDetails+'</td>';
                                subjectCount ++ ;
                            } 
                            else{
                                if(key == "head_0"){
                                    tempTr += '<td style="text-align:center;" id="td'+(i+1)+key+'">'+tempVal+
                                                    '<input type="hidden" id="admissionId'+(i+1)+'" value="'+admissionId+'">'+
                                                    '<input type="hidden" id="studentId'+(i+1)+'" value="'+studentId+'">'+
                                                    '<input type="hidden" id="marksId'+(i+1)+'" value="'+marksId+'">'+
                                                '</td>';
                                }
                                else{
                                    tempTr += '<td style="text-align:center;" id="td'+(i+1)+key+'">'+tempVal+'</td>';
                                }
                                
                            }
                            
                        });
                        tempTr  += '</tr>';
                        tr += tempTr ;
                        
                    }
                }
               // console.log(tr);
                     tbody +=  tr + '</tbody>';
                     $('#marksTable').html(thead + tbody);
                    }
                }
            });
            return false;
        });

        $('#marksForm').on('submit', function(e){
                e.preventDefault();
              
                let trLength = $('#marksTable tbody tr.marksRow').length;
                if(trLength > 0){
                    let arr = [];
                for(var i = 0; i < trLength ; i++){
                    let tr   = $("#marksTable tbody tr.marksRow")[i];
                    let trId = $(tr).attr('id');
                    count     = trId.substring(3);
                    let subject = [];
                    for(j =1 ; j< $("#"+trId).children('td').length -2 ; j++){
                        subject.push({"id":$('#marks_detail_id'+count+j).val(), "subject_id":$('#subject_id'+count+j).val(), "subject_name":$('#subject_name'+count+j).val(), "full_marks":$('#full_marks'+count+j).val(), "marks_obtained_theory":$('#subject'+count+j+'_theory').val(), "marks_obtained_practical":$('#subject'+count+j+'_practical').val()})
                    }
                    arr.push({"id": $('#marksId'+count).val(), "student_id":$('#studentId'+count).val(), "admission_id": $('#admissionId'+count).val(), "subjects":subject});
                }
                let jsonObj = JSON.stringify(arr);
                console.log(jsonObj);

                formData = new FormData();
                formData.append("params", jsonObj);
            
                
                $.ajax({
                    url: 'save-marks.php',
                    data: formData,
                    dataType: "json",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    async: false,
                    enctype: "multipart/form-data",
                    success: function(response) 
                    {
                        console.log(response);
                        if(response.success){
                            alert(response.message) ;
                            $('#marksTable tbody').html("")     
                        }else{
                            alert("Here") ;  
                        }
                    }
                });
                }
            
        });

    });


    function calculateTotalMarks(row)
    {
        let total = practical = theory =  0 ; 
        //alert($("#row"+row).children('td').length);
        for(j =1 ; j< $("#row"+row).children('td').length -2 ; j++){
        
            theory = parseInt($('#subject'+row+j+'_theory').val()) || 0;
            if($('#subject_fm_theory' + row + j).val() < theory)
            {
                alert("Obtained marks can not be greater than Full Marks at row - "+ (row));
                $('#subject'+row+j+'_theory').val("");
                break;
            }
            practical = parseInt($('#subject'+row+j+'_practical').val()) || 0;
            if($('#subject_fm_practical' + row + j).val() < practical)
            {
                alert("Obtained marks can not be greater than Full Marks at row - "+ (row));
                $('#subject'+row+j+'_practical').val("");
                break;
            }
            total += ( theory + practical) ;
        // alert(total);
        }
    let lastCellIndex = $("#row"+row).children('td').length-1 ;
    $('#td'+row+'head_'+lastCellIndex).html(total);
    }
</script>

</body>

</html>
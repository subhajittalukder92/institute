<?php
session_start();



function getCourses()
{
    include('include/dbconfig.php');
    $sql = "SELECT * FROM `courses` ORDER BY `course_name`";
    $res = mysqli_query($conn,  $sql);
    $option = '';
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $option .= '<option value="' . $row['id'] . '">' . $row['course_name'] . '-' . $row['description'] . '</option>';
        }
        echo $option;
    }
}


function getData(){
    include('include/dbconfig.php');

    $id=trim(mysqli_real_escape_string($conn,$_GET['id']));
    $sql="SELECT *,subjects.id as sid,courses.course_name as cname,courses.id as cid FROM subjects INNER JOIN courses on courses.id=subjects.course_id WHERE subjects.id='$id'";
    $res = mysqli_query($conn,  $sql);
    $row=mysqli_fetch_assoc($res);

    return $row;
}

include('include/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-md-10 col-xs-12">
                <h3 class="page-header">Edit Subject</h3>
                <?php $row=getData(); ?>
                <form class="form-horizontal" method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div id="add-course-messages"></div>

                    <input type="hidden" id="id" name="id" value="<?php echo $row['sid'];?>">

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="caddress">Course:<span class=""></span>
                        </label>
                        <div class="col-sm-8">
                            <select id="course_id" name="course_id" class="form-control col-md-7 col-xs-12" required style="border-color:red">
                                <option value="">--Select--</option>
                                <?php echo '<option selected value="' . $row['cid'] . '">' . $row['cname'] . '-' . $row['description'] . '</option>' ?>
                                <?php getCourses(); ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="fname" class="col-sm-4 control-label">Subject Name : </label>
                        <div class="col-sm-8">
                            <input type="text" required class="form-control" id="subjectname" name="subjectname" placeholder="Subject Name" value="<?php echo $row['subject'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class="col-sm-4 control-label">Semester Subjects : </label>
                        <div class="col-sm-8">
                            <textarea name="semSubjects" id="semSubjects"  class="form-control" required><?php echo $row['semester_subjects'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class="col-sm-4 control-label">Semester Order : </label>
                        <div class="col-sm-8">
                            <input type="number"  class="form-control" id="order" name="order" value="<?php echo $row['sem_order'];?>" placeholder="Example: 1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-sm-4 control-label">Theory Full Marks: </label>
                        <div class="col-sm-8">
                            <input type="number" required class="form-control" id="fullmarks" name="fullmarks" placeholder="Full Marks" autocomplete="off" value="<?php echo $row['full_marks'];?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dob" class="col-sm-4 control-label">Practical Full Marks: </label>
                        <div class="col-sm-8">
                            <input type="number" required class="form-control" id="practicalFullmarks" name="practicalFullmarks" placeholder="Full Marks" autocomplete="off" value="<?php echo $row['practical_marks'];?>" />
                        </div>
                    </div>





                    <div class="form-group">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md btn-block">Update</button>
                    </div>
                    <!-- /col-md-6 -->


                    <!-- /col-md-4 -->

                    <!-- /col-md-12 -->


                    <!-- /row -->
                </form>
            </div>


        </div>

        <!-- add teacher -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addCourse">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Course</h4>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->
<?php include('include/footer.php'); ?>

</body>

</html>
<!-- <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script> -->
<script>
    $(document).ready(function() {
        

        $('form').on('submit', function(e) {
            $.ajax({
                url: "updateSubject.php",
                method: "post",
                data: $("#createTeacherForm").serialize(),
    
                success: function(data) {
                    if (data) {
                       alert("Update successfully");
                       window.location="viewsubject.php";
                        

                    } else {
                        $("#add-course-messages").html('<div class="alert alert-danger alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error : Unable To Save ! </div>');

                    }

                }

            });

            return false;
        });

        
    });
</script>
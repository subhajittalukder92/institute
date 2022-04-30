<?php include "header-link.php"; ?>
<?php include "header.php"; ?>
<style type="text/css">
  .student-details-div{
    width: 57%; 
    box-shadow: 5px 5px 5px #ccc; 
    margin: auto; 
    padding: 30px; 
    background-color: lavender;
  }
  .student-pic{
    width: 200px; 
    height: 200px; 
    border:5px solid steelblue; 
    border-radius: 50%; 
    margin-bottom: 30px;
  }
  .titles{
    color: black; 
  }
  @media (max-width: 1000px){
    .student-details-div{
      width: 100%; 
    } 
  .titles{
    font-size: 14px;
  }
  .content{
    font-size: 14px;
  }
  }
</style>
<section class="welcome">
  <div class="container">
	  <div class="col-lg-12">
      <div class="big-cta">
        <div class="cta-text">
          <h1>Registration Verification</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="callaction">
  <div class="form-edu">
    <div class="container">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-md-4">
          <div class="home-veri">
            <div class="marginbot30">
              <label>Enter Your Enrollment No:</label>
              <input class="form-control" name="reg_no" id="reg_no" required type="text" placeholder="Student Enrollment No*">
              <p class="click"></p>
              <button class="btn btn-theme margintop10" id="search_btn" type="submit">Submit</button>
            </div>        
        	</div>
        </div>
        <div class="col-lg-4"></div>
      </div>
      <div align="center" id="message">
        <h4 style="color: firebrick;"></h4>
      </div>
      <div id="output" class="student-details-div" style="display: none;">
        <div align="center"><img src="images/passport.png" class="student-pic" id="student_pic"></div>
        <div class="row">
          <div class="col-sm-5">
            <h4 class="titles">Student Name :</h4>
          </div>
          <div class="col-sm-7">
            <h4 class="content" id="student_name"></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <h4 class="titles">Father Name :</h4>
          </div>
          <div class="col-sm-7">
            <h4 class="content" id="father_name"></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <h4 class="titles">Course Name :</h4>
          </div>
          <div class="col-sm-7">
            <h4 class="content" id="course_name"></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <h4 class="titles">Status :</h4>
          </div>
          <div class="col-sm-7">
            <h4 class="content" id="status"></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(e){ 
      $('#search_btn').click(function(e){
        $('#output').hide();
        $('#message').hide();
        getStudents();
      });
    });
    function show(str){
       $('#reg_no').val(str);
    }
    function getStudents(){
      var reg_no = $('#reg_no').val();
      $.ajax({
          url:"getStudents.php",
          type:"POST",
          data:{'reg_no':reg_no},
          dataType:"json",
          success: function(response){
            if(response.success){
              let result = response;
              $('#output').show();
              $('#student_pic').attr('src', result.data[0].image_name);
              $('#student_name').html(result.data[0].St_Name);
              $('#father_name').html(result.data[0].Fathers_Name);
              $('#course_name').html(result.data[0].course_name);
              $('#status').html(result.data[0].current_status);
          }else{
            $('#message').show();
            $('#message h4').html(response.message);
          }
          }
});
    }
</script>
<?php include "footer.php"; ?>	
<?php include "footer-link.php"; ?>
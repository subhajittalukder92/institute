<?php 
include "header-link.php";
include "header.php"; 

function fetchRecords()
{
  include   ('include/dbconfig.php'); 
  
  $sql    ="SELECT * FROM `courses`";
  $res     = mysqli_query($conn,  $sql);
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
            <td style="text-align:center;">'.$row['eligibility'].'</td>
            <td style="text-align:center;">'.$row['course_fee'].'</td>
          </tr>';
  }
}
?>

<section class="welcome">
  <div class="container">
	  <div class="col-lg-12">
      <div class="big-cta">
        <div class="cta-text">
          <h1>All Courses</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="callaction">
  <div class="form-edu">
    <div class="container">
      <table class="table rwd-table" style="margin-top:2%;">
        <thead>
          <tr>
            <th>Sl.No.</th>
            <th>ID</th>
            <th>COURSE NAME</th>
            <th>DESCRIPTION</th>
            <th>COURSE CODE</th>
            <th>DURATION</th>
            <th>ELIGIBILITY</th>
            <th>COURSE FEE</th>
          </tr>
        </thead>
        <tbody>
          <?php fetchRecords();?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php include "footer.php"; ?>	
<?php include "footer-link.php"; ?>
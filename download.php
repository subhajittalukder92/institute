<?php 
include "header-link.php";
include "header.php"; 

function fetchRecords()
{
	include   ('include/dbconfig.php');	
	
	$sql	="SELECT * FROM `download`";
	$res	= mysqli_query($conn,  $sql);
	$sl=1;
	while($row=mysqli_fetch_assoc($res))
	{
		echo '<tr>
				<td><b>'.$sl.'.</b></td>
				<td><b>'.$row['title'].'</b></td>
				<td><a href="downloads/'.$row['file'].'" download="downloads/'.$row['file'].'"><img src="images/pdf-download.png" width="70" height="70"></a></td>
			</tr>' ;
			$sl++;
	}
}
?>
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="http://www.jybce.org/study-centre#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li class="active">Downloads</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Start Content -->
<section id="content" class="courses-section sec-padding" data-bg-color="#f7f7f7">
        <div class="container">
            <div class="row">
				<div class="col-md-9">
				  <table class="table rwd-table" style="margin-top:2%;">
				  <thead>
				  <tr>
						<th>Sl.No.</th>
						<th>Heading</th>
						<th>File</th>
				  </tr>
				  </thead>
				  <tbody>
				  	<?php echo fetchRecords(); ?>
				  	</tbody>
				 </table>
				</div>
				<div class="col-lg-3">
					<aside class="left-sidebar">
					  <div class="widget">
						<h4 class="widgetheading">Categories</h4>
						<ul class="cat">
						<li><a href="http://www.jybce.org/computer-software-and-hardware">Computer Software And Hardware</a></li>
              <li><a href="http://www.jybce.org/vocational">Vocational</a></li>
              <li><a href="http://www.jybce.org/paramedical">Paramedical</a></li>
              <li><a href="http://www.jybce.org/technical">Technical</a></li>
              <li><a href="http://www.jybce.org/nursing">Nursing &amp; Pathology</a></li>
              <li><a href="http://www.jybce.org/kg-school">KG School</a></li>
              <li><a href="http://www.jybce.org/bed-college">B.Ed &amp; D-Ed College</a></li>
              <li><a href="http://www.jybce.org/technology">Technology &amp; IT</a></li>
              <li><a href="http://www.jybce.org/travel-and-tourism">Travel &amp; Tourism</a></li>
              <li><a href="http://www.jybce.org/distance-education">Regular &amp; Distance Education</a></li>
              <li><a href="http://www.jybce.org/news-paper">Media &amp; News Paper</a></li>
              <li><a href="http://www.jybce.org/consultancy-service">Consultancy Service</a></li>
              <li><a href="http://www.jybce.org/govt-project">Govt. Project</a></li>
              <li><a href="http://www.jybce.org/sholarship">Minority</a></li>
              <li><a href="http://www.jybce.org/job-consultancy">Job Consultancy Service</a></li>
						</ul>
					  </div>
					</aside>
				</div>
				
            </div>
        </div>
    </section>
    
<?php include "footer.php"; ?>	
<?php include "footer-link.php"; ?>
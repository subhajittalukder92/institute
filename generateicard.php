<?php
session_start();
//error_reporting(0);
function generateIdCard()
{
	include('include/dbconfig.php');
	$from=trim($_POST['date1']);
	$to  =trim($_POST['date2']);
	$courseid= trim($_POST['coursename']);
	$sql="SELECT * FROM pursuing_course
			INNER JOIN courses
			ON pursuing_course.`course_id`=courses.id
			INNER JOIN student_info 
			ON student_info.slno = pursuing_course.student_id
			WHERE pursuing_course.current_status='PURSUING'
			AND pursuing_course.date BETWEEN '$from' AND '$to'
			AND pursuing_course.course_id='$courseid'
	";
	 echo $sql ;
	$res=mysqli_query($conn,  $sql);
	$no=0;

	while($row=mysqli_fetch_assoc($res))
	{
		//$src="Student_images/".$row['image_name'];
			echo '
				<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>New Page 1</title>
</head>

<body>

<div align="left">
  <table background="Untitled.png" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="233" height="326" align="right">
    <tr>
      <td width="37" height="289" bgcolor="#9AAAF5">
      <p align="center"><b>S</b></p>
      <p align="center"><b>T</b></p>
      <p align="center"><b>U</b></p>
      <p align="center"><b>D</b></p>
      <p align="center"><b>E</b></p>
      <p align="center"><b>N</b></p>
      <p align="center"><b>T</b></td>
      <td width="221" height="289">
      <p align="center">
      <font face="revel" align="center">
	  <b><font size="6" color="red">LMiit</font></b></font><font size="6"></br>
				</font><font size="2">
				<b>Computer Education</b></br>
				<font size="2"><b>Affiliated to W.B.S.C.T.E(HO)</b><br> 
	            </font><font size="1">
      An ISO 9001-2008 Certified Institute
	            </font><font size="2">
      <br/>
				Krishnagar branch <br/>
	  <img border="0" src="../$rows[7]" align="left" width="104" height="84" vspace="7" hspace="18"></p>
                <p>&nbsp;</p>
	            </font><b><font size="2">Course:'.$row['course_name'].'</font></b><p>
      <b><font size="2">Reg No:'.$row['regno'].'</br>
      Student Name:'.$row['St_Name'].'</br>
      Father Name:'.$row['Fathers_Name'].'</br>
      Address:'.$row['Vill'].'</br>
      Pin:'.$row['Pin'].'</br>
      DOA:'.$row['DOA'].'</font></b><font size="2"></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>&nbsp;Authorised Signatory</b></font></td>
    </tr>
    <tr>
      <td width="259" height="33" colspan="2" bgcolor="#b30086">
      <p align="center"><b><font size="4">Session-'.$row['Session1'].'</font></b></td>
    </tr>
  </table>
</div>

</body>

</html>

			';
		$no++;
		if($no%2==0)
		{
			echo '<p>&nbsp;</p>';
		}
	}
}

?>
<!-- Page Content -->
<style>
.p{
	border: 1px solid black;
	height: 592px;
}

</style>
<?php include('include/menu.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
	<div class="row">
		<?php generateIdCard();?>
	</div>
	</div>
</div>
</div>
</div>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="js/file-validator.js" type="text/javascript" charset="utf-8"></script>
<script src="js/app.js"></script>
	
  <!-- Syntax Highlighting Support -->
<script src="highlighting/sh_main.min.js" type="text/javascript" charset="utf-8"></script>
<script src="highlighting/sh_javascript_dom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="highlighting/sh_html.min.js" type="text/javascript" charset="utf-8"></script>
	<!-- End -->
 <script type="text/javascript" src="docs/js/bootstrap-3.3.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
<!-- Datepick -->
<script type="text/javascript" src="datepick_api/bootstrap_date/js/bootstrap.min_date.js"></script>
<script type="text/javascript" src="datepick_api/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="datepick_api/js/locales/bootstrap-datetimepicker.en.js" charset="UTF-8"></script>
<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
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
<!--End-->
<script src="dist/js/sb-admin-2.js"></script>
<!-- Tables Edit-->
<script src="jquery-tabledit/jquery.tabledit.min.js"></script>

	

</body>
</html>
<script type="text/javascript">
$(document).ready(function(e){
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
});
</script>

<?php
session_start();

if(isset($_SESSION['myValue']))
{

error_reporting(0);


add_to_database();


}
else{
	
header("location: page3.php");
}


function add_to_database() {

	
include('include/dbconfig.php');
	
      	
	

$sql="SELECT * FROM `schoolinfo`";
		$res=mysqli_query($conn,$sql);
		$rows=mysqli_fetch_row($res);
    
	
$sql = "Select `formNo`,`sname`,`fname`,`Mname`,`Cust` from `onlineadmination` order by `formNo` ASC";
 	
	$s=mysqli_query($conn,$sql);
	//echo $sql;
	$i=1;
		while($row = mysqli_fetch_array($s))

  {
    
			
		
?>
<html 

xmlns:v="urn:schemas-microsoft-com:vml" 

xmlns:o="urn:schemas-microsoft-com:office:o

ffice" 

xmlns="http://www.w3.org/TR/REC-html40">



<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns="http://www.w3.org/TR/REC-html40">



<head>

<meta http-equiv="Content-Language" 

content="en-us">

<meta name="GENERATOR" content="Microsoft FrontPage 5.0">

<meta name="ProgId" 

content="FrontPage.Editor.Document">

<meta http-equiv="Content-Type" 

content="text/html; charset=windows-1252">


	<?php include 'include/title.php'?>

</head>



<body>



<form method="POST" action="--WEBBOT-SELF--">


<table border="1" 

cellpadding="0" cellspacing="0" 

style="border-collapse: collapse" 

bordercolor="#111111" width="26%" 

id="AutoNumber1" height="54" align="right">

    <tr>

      <td width="100%" height="11" 

bgcolor="#C0C0C0">

      <p align="center"><font size="6" color="#FFFFFF"><?php echo $rows[1];?></font></td>

    </tr>

    <tr>

      <td width="100%" height="42">

      <p align="center" style="margin-top: 

0; margin-bottom: 0"><b>

      <font face="Castellar" 

size="2">Lottery Card</font></b></p>

      <p align="center" style="margin-top: 0; 

margin-bottom: 0">    



    
      <font face="Bookman Old 



Style"> <b>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></p>



      <table border="0" cellpadding="0" 

cellspacing="0" 

style="border-collapse: collapse" 

bordercolor="#111111" width="74%" 

id="AutoNumber2" align="center">

        <tr>

          <td width="43%" 

bordercolor="#000000"> <font size="3">Form No</font></td>

          <td width="57%" 

bordercolor="#000000"> <font size="3"><b><?php  echo $row[0];?>



</b></font></td>

        </tr>

        <tr>

          <td width="43%" 

bordercolor="#000000"><font size="2" face="Bookman Old 



Style">Name of the Student</font></td>

          <td width="57%" 

bordercolor="#000000">

      <font face="Bookman Old 



Style"> <b>

      <font face="Bookman Old Style" size="2"><?php  echo $row[1];?></font></b></td>

        </tr>

        

        <tr>

          <td width="43%" 

bordercolor="#000000"><font size="2">Father's Name</font></td>

          <td width="57%" 

bordercolor="#000000"><b><font size="2"><?php  echo $row[2];?></font></b

></td>

        </tr>

        <tr>

          <td width="43%" 

bordercolor="#000000"><font size="2">Mother's Name</font></td>

          <td width="57%" 

bordercolor="#000000"><b><font size="2"><?php  echo $row[3];?></font></b></td>

        </tr>

        

        

        <tr>

          <td width="43%" 

bordercolor="#000000"><font size="2">Caste</font></td>

          <td width="57%" 

bordercolor="#000000"><b><font size="2"><?php  echo $row[4];?></font></b></td>

        </tr>

      </table>

      <p align="left" style="margin-top: -1; margin-bottom:-1"> </p>

      

     





      

     

      

      </td>

    </tr>

  </table>

      <p align="left" style="margin-top: -1; margin-bottom:-1"></p>

      

         





      

     

      

  

</form>



</body>



</html>
  <?php
   
  }
  
   
}?>
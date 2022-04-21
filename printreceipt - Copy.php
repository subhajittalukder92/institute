<?php 
session_start();
include "include/dbconfig.php";
$id=isset($_GET['id']) ? $_GET['id'] : "";
if($id!="")
{
	$sql   ="SELECT student_info.*,payment.* , courses.*  FROM `student_info`
			INNER JOIN 	payment
			ON student_info.slno=payment.admission_slno
			INNER JOIN courses
			ON payment.course_id=courses.course_id
			WHERE student_info.slno='$id'";
	$res= mysqli_query($conn,  $sql);
	$row= mysqli_fetch_assoc($res);
}
function getIndianCurrency($amount)
{
	$number=$amount;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3'  => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7'  => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
 echo $result . "Rupees  " . $points . " Only";
}
?>
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12" style="border-bottom:1px solid black;text-align:center;padding-left:0px;padding-right:0px;">
				<font size="6" face="revel" align="center" >CHAPRA JAWAHARLAL NEHRU YOUTH COMPUTER TRAINING CENTER<br/></font>
				<font size="3" ><b>ATC of Jawaharlal Nehru Computer Literacy Drive <sup>TM</sup></b></font><br> 
				<font size="4" >Islamgonj High Madrasah School Road, Chapra, Dist-Nadia</font> <br/>
				<font size="4" >Mobile : 9933382397 // 9046633560</font> 
				<font size="4"><b>ADMISSION RECEIPT </b></font>
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12" style="padding-top:2%;text-align:center;">
				
		</div>
			<div class="col-sm-6 col-md-6 col-xs-6" style="font-size: 16px;padding-top:5%;">
				<B>Form No : <?php echo $row['slno'];?></b>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-6" style="text-align: right;font-size: 16px;padding-top:5%;">
				<b>Reg. No : </b><?php echo $row['regno'];?>
			</div>
			<table class="table table-bordered">
				<tr>
					<td colspan="2"><b>Student Name : </b></td>
					<td ><b>Reg No: </b></td>
				</tr>
				<tr>
					<td colspan="2"><b>Course : </b></td>
					<td ><b>Payment Date: </b></td>
				</tr>
				<tr>
					<td ><b>Sl No</b></td>
					<td ><b>Description</b></td>
					<td ><b>Amount Paid</b></td>
				</tr>
			</table>
			<div class="col-sm-12 col-md-12 col-xs-12" style="font-size: 18px;padding-left:62%;padding-top:9%;">
				
				<div style="padding-left:16%;font-size: 16px;text-align:center">Authorized Signatory<br/><small>CJNYCTC</small></div>
			</div>
			<div class="col-sm-12 col-md-12 col-xs-12" style="margin-top:5%;font-size: 11px;text-align: center; border:1px solid black;padding:8px;">
				<b>Documents Attached : </b>(A) Aadhar Card, (B) Madhyamik Admit,Mark Sheet(Self attested Xerox Copy) 1 Copy of Passport Size and 1 copy Stamp Size Photo.
			</div>
			
		</div>
	 </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include('include/footer.php'); ?>
</body>
</html>
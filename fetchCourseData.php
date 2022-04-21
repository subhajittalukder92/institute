<?php 
include "include/dbconfig.php";
$sql="SELECT * FROM `courses`";
$res=mysqli_query($conn,  $sql);
//;
$result = array('data' => array());
$data = array();
/* while()
{
	echo $row['course_name'];
} */
while($row=mysqli_fetch_assoc($res)) 
{
	/*  $result['data'][$key] =
	array(
			$value['coursename'],
			$value['description'],
			$value['duration'],
			$value['unit'],
			$value['course_fee'],
			$value['fee_type']
		); */
	$sub_array=		array();
	$sub_array=		$row['course_name'];
	$sub_array=		$row['description'];
	$sub_array=		$row['duration'];
	$sub_array=		$row['unit'];
	$sub_array=		$row['course_fee'];
	$sub_array=		$row['fee_type'];
	$data[] = $sub_array;
	/* $data[] = $row; */
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_total_all_records(),
 "recordsFiltered" => 4,
 "data"    => $data
);
echo json_encode($output);
/* echo json_encode($data); */
//print_r($data);
/* var_dump($data);  */
function get_total_all_records()
{
 include('include/dbconfig.php');
 $sql="SELECT count(*) AS totatno FROM `courses`";
 $res=mysqli_query($conn,  $sql);
 $row=mysqli_fetch_assoc($res);
 return $row['totatno'] ;
}

?>
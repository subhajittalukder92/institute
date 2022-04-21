<?php 
include "include/dbconfig.php";
$input		= filter_input_array(INPUT_POST);
$sp	 		= trim($input["selling_price"]);

if($input["action"] === 'edit')
{
	$query = " UPDATE `pricelist` SET `selling_price`='$sp'  WHERE `slno`='$input[slno]'
		";
	/* echo $query; */
	$res= mysqli_query($conn,$query);
	if($res)
	{
		$input['result']="success";
	}

}

echo json_encode($input);

?>
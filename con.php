<?php 
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'image_ajaxcurd');
if($con){
	echo "Connected!";
}else{
	echo "Not Connected!";
}
?>
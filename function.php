<?php 
include("con.php");

//add products
if($_REQUEST['action'] == 'Add_Product_Form'){
	$name = $_POST['Addname'];
	$category = $_POST['Addcategory'];
	$price = $_POST['Addprice'];
	//image
	$img = $_FILES['Addimage'];
	$img_name = $img['name']; //name
	$img_path = $img['tmp_name']; //path
	$upload_img = 'images/'.$img_name;
	move_uploaded_file($img_path, $upload_img);

	$sql = "INSERT INTO `products`(`name`, `category`, `price`, `image`) VALUES ('$name','$category','$price','$upload_img ')";
	$result = mysqli_query($con,$sql);
	if($result){
		// echo "data inserted!";
	}else{
		echo "Error!While adding data";
	}
}

//fetch data
if($_REQUEST['action'] == 'fetch_data'){
	$id = $_GET['id'];
	$sql = "SELECT * FROM `products` WHERE id=$id";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	echo json_encode($row);
	exit;
}

//edit products
if($_REQUEST['action'] == 'Edit_Product_Form'){
	$id = $_POST['EditId'];
	$name = $_POST['EditName'];
	$category = $_POST['EditCategory'];
	$price = $_POST['EditPrice'];
	// $img = $_FILES['EditImage'];
	
	//check if new image add
	if($_FILES['EditImage']['size']>0){
		$img = $_FILES['EditImage'];
		$img_name = $img['name'];
		$img_path = $img['tmp_name'];
		$upload_img = 'images/'.$img_name;
		move_uploaded_file($img_path,$upload_img);

		$sql = "UPDATE `products` SET `name`='$name',`category`='$category',`price`='$price',`image`='$upload_img' WHERE id=$id";
 	}else{
 		$sql = "UPDATE `products` SET `name`='$name',`category`='$category',`price`='$price' WHERE id=$id";
 	}
 	$result = mysqli_query($con,$sql);
	if($result){
		// echo "data Updated!";
	}else{
		echo "Error!While adding data";
	}
}

//delete products
if(isset($_GET['deleteId'])){
	$id = $_GET['deleteId'];
	$sql = "DELETE FROM `products` WHERE id=$id";
	$result = mysqli_query($con,$sql);
	if($result){
		header('location:http://localhost/Image_AjaxCURD');
	}else{
		echo "Error!While adding data";
	}
}
?>

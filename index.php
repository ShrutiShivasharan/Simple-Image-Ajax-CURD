<?php
include('con.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Image Ajax CURD Operations</title>
	<!-- bootstrap cdn -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style>
	img{
		width: 100px;
	}
</style>
<body>
	<div class="container m-5 p-5">
		<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#AddModal">Add Products
		</button>
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Image</th>
		      <th scope="col">Name</th>
		      <th scope="col">Category</th>
		      <th scope="col">Price</th>
		      <th scope="col">Edit</th>
		      <th scope="col">Delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  		$sql = "SELECT * FROM `products`";
		  		$result = mysqli_query($con,$sql);
		  		if($result){
		  			$index = 1;
		  			while ($row = mysqli_fetch_assoc($result)) {
		  				// print_r($row); //array
		  				$id = $row['id'];
		  				$name = $row['name'];
		  				$category = $row['category'];
		  				$price = $row['price'];
		  				$img = $row['image'];

		  				echo '
		  					<tr>
								  <th scope="row">'.$index.'</th>
								  <td><img src='.$img.'></td>
								  <td>'.$name.'</td>
								  <td>'.$category.'</td>
								  <td>'.$price.'</td>
								  <td>
								  	<button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#EditModal" onClick="openeditModalByID('.$id.')">Edit
										</button>
								  </td>
								  <td>
								  	<button type="button" class="btn btn-danger"><a class="text-light" href="function.php?deleteId='.$id.'">Delete</a></button>
								  </td>
								</tr>
		  				';
		  				$index++;
		  			}
		  		}
		  	?>
		  </tbody>
		</table>
	</div>
</body>
</html>


<!-- Add Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="Add_Product_Form">
	      <div class="modal-body">
				  <div class="form-group">
				    <label>Enter Name</label>
				    <input type="text" class="form-control" placeholder="Enter your name" name="Addname">
				  </div>
				  <div class="form-group">
				    <label>Enter Category</label>
				    <input type="text" class="form-control" placeholder="Enter your category" name="Addcategory">
				  </div>
				  <div class="form-group">
				    <label>Enter Price</label>
				    <input type="number" class="form-control" placeholder="Enter your price" name="Addprice">
				  </div>
				  <div class="form-group">
				    <label>Product Image</label>
				    <input type="file" class="form-control" name="Addimage">
				  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="Edit_Product_Form">
	      <div class="modal-body">
	      	<div class="form-group">
			    <label>ID</label>
			    <input type="text" class="form-control" placeholder="Enter your id" name="EditId" id="EditId" readonly>
			  </div>
			  <div class="form-group">
			    <label>Enter Name</label>
			    <input type="text" class="form-control" placeholder="Enter your name" name="EditName" id="EditName">
			  </div>
			  <div class="form-group">
			    <label>Enter Category</label>
			    <input type="text" class="form-control" placeholder="Enter your category" name="EditCategory" id="EditCategory">
			  </div>
			  <div class="form-group">
			    <label>Enter Price</label>
			    <input type="text" class="form-control" placeholder="Enter your price" name="EditPrice" id="EditPrice">
			  </div>
			   <div class="form-group">
			    <label>Product Image</label>
			    <input type="file" class="form-control" name="EditImage" id="EditImage">
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- ajax start -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- add product -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#Add_Product_Form').submit(function(event){
			event.preventDefault();
			var addForm = new FormData(this);

			$.ajax({
				type:"POST",
				url:"function.php?action=Add_Product_Form",
				data:addForm,
				catche:false,
				processData:false,
				contentType:false,
				success:function(response){
					window.location.href="http://localhost/Image_AjaxCURD";
				},
				error:function(xhr,status,error){
					alert("error!while adding products");
				}
			});
		});
	});
</script>

<!-- fetch data -->
<script type="text/javascript">
	function openeditModalByID(id) {
		$.ajax({
			type:"GET",
			url:"function.php",
			data:{action:'fetch_data',id:id},
			success:function(response){
				if(response.startsWith('Connected!')){
					response = response.substring('Connected!'.length).trim();
				}
				try{
					var data = JSON.parse(response);
					// console.log("data",data);
					$('#EditId').val(data.id);
					$('#EditName').val(data.name);
					$('#EditCategory').val(data.category);
					$('#EditPrice').val(data.price);
					// $('#EditImage').val(data.image);
					$('#EditImage').attr("src",data.image);
				}catch(error){
					alert("Error!while fetching datas");
				}
			},
			error:function(){
				alert("error!While fetching data");
			}

		})
	}
</script>

<!-- Edit product -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#Edit_Product_Form').submit(function(event){
			event.preventDefault();
			var addForm = new FormData(this);

			$.ajax({
				type:"POST",
				url:"function.php?action=Edit_Product_Form",
				data:addForm,
				catche:false,
				processData:false,
				contentType:false,
				success:function(response){
					window.location.href="http://localhost/Image_AjaxCURD";
				},
				error:function(xhr,status,error){
					alert("error!while Editing products");
				}
			});
		});
	});
</script>
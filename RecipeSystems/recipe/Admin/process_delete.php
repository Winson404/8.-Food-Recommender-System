<?php 
	include '../config.php';

	// DELETE DIET
	if(isset($_POST['delete_diet_Id'])) {
		$diet_Id = $_POST['diet_Id'];

		$delete = mysqli_query($conn, "DELETE FROM diet WHERE diet_Id='$diet_Id'");
		if($delete) {
			$_SESSION['success']  = "Diet has been deleted!";
	        header("Location: diet.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: diet.php");
		}
	}


	// DELETE RECIPE
	if(isset($_POST['recipe_Id'])) {

		$recipe_Ids = $_POST['Id'];

		$delete = mysqli_query($conn, "DELETE FROM recipe WHERE recipe_Id='$recipe_Ids' ");
		if($delete) {
	        $_SESSION['message']  = "Recipe has been deleted!";
	        $_SESSION['text'] = "Deletion successful";
	        $_SESSION['status'] = "success";
	        header("Location: recipe.php");
	    } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
	        header("Location: recipe.php");
	    }
	}



	// DELETE RECIPE - recipe_user_uploads_delete.php
	if(isset($_POST['recipe_Id_user_upload'])) {

		$recipe_Ids = $_POST['Id'];

		$delete = mysqli_query($conn, "DELETE FROM recipe WHERE recipe_Id='$recipe_Ids' ");
		if($delete) {
	        $_SESSION['message']  = "Recipe has been deleted!";
	        $_SESSION['text'] = "Deletion successful";
	        $_SESSION['status'] = "success";
	        header("Location: recipe_user_uploads.php");
	    } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
	        header("Location: recipe_user_uploads.php");
	    }
	}







	// DELETE RECIPE
	if(isset($_POST['delete_user'])) {

		$id = $_POST['id'];

		$delete = mysqli_query($conn, "DELETE FROM users_account WHERE id='$id' ");
		if($delete) {
	        $_SESSION['message']  = "Customer record has been deleted!";
	        $_SESSION['text'] = "Deletion successful";
	        $_SESSION['status'] = "success";
	        header("Location: users.php");
	    } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record.";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
	        header("Location: users.php");
	    }
	}




?>
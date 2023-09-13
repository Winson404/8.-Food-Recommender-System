<?php 
    include '../config.php';
    date_default_timezone_set('Asia/Manila');


    if(isset($_POST['recipe_id']) && isset($_POST['user_id'])) {
        $user_id    = $_POST['user_id'];
        $recipe_id = $_POST['recipe_id'];
        $date_added = date('Y-m-d');

        $delete = mysqli_query($conn, "DELETE FROM favorites WHERE user_id='$user_id' AND recipe_id='$recipe_id'");
        if($delete) {
            $response = 'Recipe has been removed from favorites lists.';
            echo json_encode($response);
        } else {
            $response = 'Something went wrong while removing this recipe from your favorites.';
            echo json_encode($response);
        }
    }


    if(isset($_GET['recipe_Id']) && isset($_GET['meal_plan'])) {
        $recipe_Id = $_GET['recipe_Id'];
        $meal_plan = $_GET['meal_plan'];

        $delete = mysqli_query($conn, "DELETE FROM recipe WHERE recipe_Id='$recipe_Id'");
        if($delete) {
          $_SESSION['message']  = "Recipe has been deleted.";
          $_SESSION['text'] = "Success";
          $_SESSION['status'] = "success";
          header("Location: HistoryRecipe.php?meal_plan=".$meal_plan);
        } else {
          $_SESSION['message'] = "Something went wrong while deleting the record.";
          $_SESSION['text'] = "Please try again.";
          $_SESSION['status'] = "error";
          header("Location: HistoryRecipe.php?meal_plan=".$meal_plan);
        }
    }


?>
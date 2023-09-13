<?php 

    include '../config.php';

    require '../vendor/autoload.php';
    use GuzzleHttp\Psr7\Request;

    // recipe.php?recipe=4

     if(isset($_POST['predict_diet'])) {
        print("<pre>".print_r($_POST,true)."</pre>");

        // $client = new GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:8000/']);

      //  $cuisine_type = empty($_POST['cuisine_type_text']) ? 'american' : $_POST['cuisine_type_text'];
        $protein = empty($_POST['protein']) ? 0 : $_POST['protein']; 
        $carbs = empty($_POST['carbs']) ? 0 : $_POST['carbs']; 
        $fat = empty($_POST['fat']) ? 0 : $_POST['fat']; 
        $predict_diet_type = '';

        $diets_type = mysqli_query($conn, "SELECT * FROM predict_diet_type  where (protein between  ($protein - 10) and  ($protein + 10)) and  (carbs between  ($carbs - 10) and  ($carbs + 10)) and  (fat between  ($fat - 10) and  ($fat + 10)) ORDER BY RAND()");
        $predict_diet_type = mysqli_fetch_array($diets_type);

        // $response = $client->post('http://127.0.0.1:8000/v2/predict_diet_type', [
        //         GuzzleHttp\RequestOptions::JSON => ['protein' => $protein, 'carbs' => $carbs, 'fat' => $fat] // or 'json' => [...]
        //     ]);

        // $predicted_diet_type_response = json_decode($response->getBody(), true);
            
        // domain
        // hosting s
        // database  - mysql
    
        $diet_name = $predict_diet_type['diet_type'];
        
        if( !empty($diet_name) ) {
         
            $diets_query = mysqli_query($conn, "SELECT * FROM diet  where LOWER(diet_name) = '$diet_name' ");
            $meal_plan = mysqli_fetch_array($diets_query);

            // echo 'diet id: ' . $diets['diet_Id'];
            $_SESSION['settingDiet'] = $meal_plan['diet_Id'];
            $_SESSION['protein'] = $protein;
            $_SESSION['carbs'] = $carbs;
            $_SESSION['fat'] = $fat;
            $_SESSION['modalShown'] = false;
            header('Location: recipe.php?meal_plan=' . $meal_plan['diet_Id']);
        }else {
            header('Location: index.php');
        }

        // echo 'predicted diet: ' . $predict_diet_type . '<br>';

        
//         Diet_type    
// mediterranean    1753
// dash             1745
// vegan            1522
// keto             1512
// paleo            1274
        // $fname           = $_POST['fname'];
        // $lname           = $_POST['lname'];
        // $email           = $_POST['email'];
        // $password        = $_POST['password'];
        // $cpassword       = $_POST['cpassword'];
        // $date_registered = date('Y-m-d');



        // $select = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email'"); 
        // if(mysqli_num_rows($select) > 0) {
        //     echo '<script>alert ("E-mail is already taken. Please try again.");
        //                 window.history.go(-1);
        //           </script>';
        // } else {
        //     if($password != $cpassword) {
        //         echo '<script>alert ("Password does not matched. Please try again.");
        //                 window.history.go(-1);
        //           </script>';
        //     } else {
                
        //         $register = mysqli_query($conn, "INSERT INTO users_account (fname, lname, email, password, date_created) VALUES('$fname', '$lname', '$email', '$password', '$date_registered')");
        //         if($register) {
        //             $_SESSION['success']  = "Registration successful. Please login.";
        //             header("Location: SignIn.php");
        //         } else {
        //             echo '<script>alert ("Something went wrong while saving the data.");
        //                         window.history.go(-1);
        //                   </script>';
        //         }

        //     }
        // }
    }



    


?>
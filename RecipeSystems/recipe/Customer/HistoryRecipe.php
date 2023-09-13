<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>
   .dataTables_filter input[type=search]  {
    width: 130px !important;
    height: 20px !important; /* set the desired width */ 
    padding: 5px !important; /* set the desired padding */ 
    color: black;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<!-- Bootstrap JS -->
	<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<?php 
      
      if(isset($_GET['meal_plan'])) 
      $meal_plan = $_GET['meal_plan'];
      include('navbar.php');
      $user_ID = $_SESSION['user_id'];
      
?>

<body  onload="myFunction()">
    <main class="page">
      <div class="recipe-page">
        <section >
        <table id="myTable" class="display" width="100%">
    <thead>

        <tr>
            <th>Recipe Image</th>
            <th>Recipe Name</th>
            <th>Recipe Status</th>
            <th>Reason for rejection</th>
            <th>Action</th>
        </tr>

    </thead>
    <tbody>
    <?php
    $q_e = $conn->query("SELECT * FROM `recipe` WHERE `recipe_uploaded_by`='$user_ID' ORDER by `recipe_Id` DESC");
    while($f_e=$q_e->fetch_array()){
    ?>
        <tr>
            <td>
                <img src="../images-recipe/<?php echo $f_e['recipe_image']?>" style="width:80px; height:80px;">
            </td>
            <td><?php echo $f_e['recipe_name']?></td>
            <td>
                <?php if($f_e['recipe_status']=="0"): ?>
                    <span class="badge" style="background-color: #ff0000;width: auto; height: auto;">Pending</span>
                <?php elseif($f_e['recipe_status']=="1"): ?>
                    <span class="badge" style="background-color: #29a329;width: auto; height: auto;">Approved</span>
                <?php else: ?>
                    <span class="badge" style="background-color: grey;width: auto; height: auto;">Rejected</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($f_e['recipe_status']=="0"): ?>
                    <span class="badge" style="background-color: #ff0000;width: auto; height: auto;">NA</span>
                <?php elseif($f_e['recipe_status']=="1"): ?>
                    <span class="badge" style="background-color: #29a329;width: auto; height: auto;">NA</span>
                <?php else: ?>
                    <?php echo $f_e['decline_reason']?>
                <?php endif; ?>
            </td>
            <td>
                <a href="uploadingRecipe_update.php?recipe_Id=<?php echo $f_e['recipe_Id'] ?>&&meal_plan=<?php echo $meal_plan; ?>" class="btn" style=" width: auto; height: auto;">Update</a>
                <button class="btn" onclick="confirmDelete(<?php echo $f_e['recipe_Id'] ?>, <?php echo $meal_plan ?>)" style="width: auto; height: auto;">Delete</button>
            </td>
        </tr>
    <?php } 
        
    
    ?>
    </tbody>
</table>
        </section>
      </div>
    </main>


<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script type="text/javascript">
  var $j = jQuery.noConflict();
  $j(document).ready(function() {
    $j('#myTable').DataTable();
  });
  
</script>
 
<?php include 'footer.php'; ?>
  </body>
<script>
    function confirmDelete(recipe_Id, meal_plan) {
    var result = confirm("Are you sure you want to delete this row?");
    if (result) {
        window.location.href = "process_delete.php?recipe_Id=" + recipe_Id + "&meal_plan=" + meal_plan;
    }
}
</script>
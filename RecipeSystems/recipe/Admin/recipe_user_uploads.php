<title>Recipe | Recipick</title>


<?php 

  include 'navbar.php'; 
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Recipe</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Recipe</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm text-sm">
                  <thead>
                  <tr>
                    <th>Recipe image</th>
                    <th>Recipe name</th>
                    <!-- <th>Recipe description</th> -->
                    <th>Diet category</th>
                    <th>Cuisine Type</th>
                    <th>Meal Type</th>
                    <th>Status</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM recipe JOIN diet ON recipe.recipe_diet_Id=diet.diet_Id WHERE recipe_uploaded_by != '$id' AND recipe_status !=1 ");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td>
                          <img src="../images-recipe/<?php echo $row['recipe_image']; ?>" class="img-circle d-block m-auto"  alt="" style="height: 30px; width: 30px;">
                        </td>
                        <td><?php echo $row['recipe_name']; ?></td>
                        <!-- <td><?php// echo $row['recipe_description']; ?></td> -->
                        <td><?php echo $row['diet_name']; ?></td>
                        <td><?php echo $row['cuisine_type'];?></td>
                        <td><?php echo $row['meal_type'];?></td>
                        <td>
                          <?php if($row['recipe_status'] == 0): ?>
                            <span class="badge badge-warning pt-1">Pending</span>
                          <?php elseif($row['recipe_status'] == 1): ?>
                            <span class="badge badge-success pt-1">Approved</span>
                          <?php else: ?>
                            <span class="badge badge-danger pt-1">Rejected</span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <a href="recipe_update.php?recipe_Id=<?php echo $row['recipe_Id']; ?>"><i class="fa-solid fa-pen-to-square text-success"></i></a>
                            <i class="fa-solid fa-trash-can text-danger" data-toggle="modal" data-target="#delete<?php echo $row['recipe_Id']; ?>"></i>
                             <?php if($row['recipe_status'] == 0): ?>
                              <i class="fa-solid fa-thumbs-up text-primary" data-toggle="modal" data-target="#approve<?php echo $row['recipe_Id']; ?>"></i>
                              <i class="fa-solid fa-thumbs-down text-dark" data-toggle="modal" data-target="#disapprove<?php echo $row['recipe_Id']; ?>"></i>
                              <?php endif; ?>

                              <?php if($row['recipe_status'] == 2): ?>
                                <i class="fa-solid fa-thumbs-up text-warning" data-toggle="modal" data-target="#approve<?php echo $row['recipe_Id']; ?>"></i>
                              <?php endif; ?>
                        </td> 
                    </tr>

                    <?php include 'recipe_user_uploads_delete.php';  }  ?>

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>Recipe image</th>
                        <th>Recipe name</th>
                        <!-- <th>Recipe description</th> -->
                        <th>Diet category</th>
                        <th>Cuisine Type</th>
                        <th>Meal Type</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




 <?php include 'footer.php'; ?>
 






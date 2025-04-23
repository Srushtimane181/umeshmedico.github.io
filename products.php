<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <style>
        .custom-color {
            color: #16a085;
        }
        .custom-bg {
            background-color: #16a085;
        }
    </style>
    <!-- Correct Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        function fun() {
            alert("Product Added!");
        }

        function showDeleteModal(id) {
            let deleteBtn = document.getElementById("confirmDeleteBtn");
            deleteBtn.setAttribute("href", "delete.php?ID=" + id); // Correctly set the href attribute
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show(); // Show the modal
        }
    </script>
</head>
<body>
  <div class="container">
   <div class="row">
     <div class="col-md-6 m-auto border border-secondary mt-3">
       <form action="pinsert.php" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
           <p class="text-center fw-bold fs-3 custom-color">Product Details</p>
         </div>
         <a href="mystore.php" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px;">Back</a>
         <div class="mb-3">
           <label for="name" class="form-label">Product Name</label>
           <input type="text" name="Pname" class="form-control" id="name">
         </div>
         <div class="mb-3">
           <label for="price" class="form-label">Product Price</label>
           <input type="text" name="Pprice" class="form-control" id="price">
         </div>
         <div class="mb-3">
           <label for="productimage" class="form-label">Product Image</label>
           <input type="file" name="Pimage" class="form-control" id="productimage">
         </div>
         <div class="mb-3">
           <label for="category" class="form-label">Select Product Category</label>
           <select class="form-select" name="Pcategory">
             <option selected>Open this select menu</option>
             <option value="Prescriptions Medications">Prescriptions Medications</option>
             <option value="OTC">OTC</option>
             <option value="Vaccines">Vaccines</option>
             <option value="Herbal Supplements">Herbal Supplements</option>
             <option value="Vitamins and Minerals">Vitamins and Minerals</option>
             <option value="Topical treatments">Topical treatments</option>
             <option value="Pain Relief Medications">Pain Relief Medications</option>
             <option value="Antibiotics">Antibiotics</option>
             <option value="Chronic conditions">Chronic conditions</option>
             <option value="Emergency Medications">Emergency Medications</option>
           </select>
         </div>
         <button class="custom-bg fs-4 fw-bold my-3 form-control text-white" name="submit" onclick="fun()">Add</button>
       </form>
     </div>
   </div>
  </div>

  <!-- Fetch Data -->
  <div class="container">
    <div class="row">
      <div class="col-md-8 m-auto">
        <table class="table border border-success my-5 table-hover">
          <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Delete</th>
            <th>Update</th>
          </thead>
          <tbody>
            <?php
              include 'config.php';
              $Record = mysqli_query($con, "SELECT * FROM `tblproduct` ORDER BY `Id` DESC");
              while($row = mysqli_fetch_array($Record)) {
                echo "
                  <tr>
                    <td>$row[Id]</td>
                    <td>$row[PName]</td>
                    <td>$row[PPrice]</td>
                    <td><img src='$row[PImage]' height='90px' width='200px'></td>
                    <td>$row[PCategory]</td>
                    <td>
                      <button class='btn btn-danger' onclick='showDeleteModal($row[Id])'>Delete</button>
                    </td>
                    <td>
                      <a href='update.php?ID=$row[Id]' class='btn btn-success'>Update</a>
                    </td>
                  </tr>
                ";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript -->
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'umeshmedico');
    $Record = mysqli_query($con, "SELECT * FROM tbluser");
    $row_count = mysqli_num_rows($Record);
    ?>
    
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-10">
        <a href="mystore.php" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px;">Back</a>  
    <table class="table table-secondary table-bordered">
        <thead class="text-center text-success">
            <th>S.N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Delete</th>
        </thead>
        <tbody class="text-center">
        <?php
        $i = 0;
        while( $row = mysqli_fetch_array($Record)) {
             echo "
            <tr>
            <td>" . ++$i . "</td>
            <td>$row[UserName]</td>
            <td>$row[Email]</td>
            <td>$row[Number]</td>
            <td>  
                <button class='btn btn-outline-danger' onclick='confirmDelete($row[Id])'>Delete</button>
            </td>
            </tr>
            ";
         }
        ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-2 pr-5 text-center">
        <h3 class="text-success">Total</h3>
        <h1 class="bg-success text-white"><?php echo $row_count; ?></h1>
    </div>
    </div>   
    </div>

    <!-- Delete Confirmation Modal -->
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
            <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
      function confirmDelete(id) {
          let deleteBtn = document.getElementById("confirmDeleteBtn");
          deleteBtn.setAttribute("href", "deleteuser.php?ID=" + id); 
          let deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
          deleteModal.show();
      }
    </script>

</body>
</html>

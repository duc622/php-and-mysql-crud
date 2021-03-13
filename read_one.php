<!-- include header -->
<?php
include 'header-footer/header.php';
?>

<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1><a href="index.php">HOME</a></h1>
      <h1>Read One Product</h1>
    </div>
    <!-- PHP read one record will be here -->
    <?php
    // get passed parameter value, in this case, the record ID
    // isset() is a PHP function used to verify if a value is there or not \
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID is not found');
    //include database connection
    include 'config/database.php';
    //read currrent record's data
    try {
      //prepare select query
      $query = 'select id, name, description, price, image from products where id = ? limit 0,1';
      $stmt = $con->prepare($query);
      //this is the first question mark
      $stmt->bindParam(1, $id);
      //execute our query
      $stmt->execute();
      //store retrieved row to a variable
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //value to fill up our form
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
      $image = $row['image'];
    } catch (PDOException $exception) {
      die("ERROR:$exception->getMessage()");
    }
    ?>
    <!-- HTML read one record table will be here -->
    <table class="table table-hover table-responsive table-bordered">
      <tr>
        <td>Name</td>
        <td><?= htmlspecialchars($name, ENT_QUOTES); ?></td>
      </tr>
      <tr>
        <td>Description</td>
        <td><?= htmlspecialchars($description, ENT_QUOTES); ?></td>
      </tr>
      <tr>
        <td>Price</td>
        <td><?= htmlspecialchars($price, ENT_QUOTES); ?></td>
      </tr>
      <tr>
        <td>Image</td>
        <td><?= $image ? "<img src='uploads/$image' style='max-width: 100%;height: auto;' />" : "No image found" ?></td>
      </tr>
      <tr>
        <td></td>
        <td><a href="index.php" class="btn btn-danger">Back to read products</a></td>
      </tr>
    </table>
  </div>
</body>
<!-- include footer -->
<?php
include 'header-footer/footer.php';
?>
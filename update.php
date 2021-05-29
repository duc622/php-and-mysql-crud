<!-- include header -->
<?php
include 'header-footer/header.php';
?>

<body>
  <div class="container">
    <div class="page-header">
      <h1><a href="index.php">HOME</a></h1>
      <h1>Update Product</h1>
    </div>
    <!-- PHP read record will be here -->
    <?php
    // get passed parameter value, in this case, the record ID
    // isset() is a PHP function used to verify if a value is there or not \
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID is not found');
    //include database connection
    include 'config/database.php';
    //read currrent record's data
    try {
      //prepare select query
      $query = 'select * from products where id = ? limit 0,1';
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
    <!-- PHP update record will be here -->
    <?php
    //check if form was sumitted
    if ($_POST) {
      try {
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE products 
                        SET name=:name, description=:description, price=:price , image=:image
                        WHERE id = :id";

        // prepare query for excecution
        $stmt = $con->prepare($query);

        // posted values
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $description = htmlspecialchars(strip_tags($_POST['description']));
        $price = htmlspecialchars(strip_tags($_POST['price']));
        // random string
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $image = !empty($_FILES['image']['name'])
          ? str_shuffle($permitted_chars)  . '-' . basename($_FILES['image']['name'])
          : $image;
        $image = htmlspecialchars(strip_tags($image));
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':image', $image);
        // Execute the query
        if ($stmt->execute()) {
          echo "<div class='alert alert-success'>Record was updated.</div>";
        } else {
          echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
        //check imgage
        include('check_image.php');
      }
      // show errors
      catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
      }
    }
    ?>
    <!-- we have our html form here where new record information can be updated -->
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . "?id=$id"); ?>" method="post"
      enctype="multipart/form-data">
      <table class="table table-hover table-responsive table-bordered">
        <tr>
          <td>Name</td>
          <td>
            <input value="<?= htmlspecialchars($name, ENT_QUOTES); ?>" name="name" class="form-control">
          </td>
        </tr>
        <tr>
          <td>Description</td>
          <td>
            <input value="<?= htmlspecialchars($description, ENT_QUOTES); ?>" name="description" class="form-control">
          </td>
        </tr>
        <tr>
          <td>Price</td>
          <td>
            <input value="<?= htmlspecialchars($price, ENT_QUOTES); ?>" name="price" class="form-control">
          </td>
        </tr>
        <tr>
          <td>Image</td>
          <td>
            <input type="file" name="image">
            <?= $image ? "<img src='uploads/$image' style='max-width: 100%;height: auto;' />" : "No image found" ?>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input value="Save Changes" type="submit" class="btn btn-primary">
            <a href="index.php" class="btn btn-danger">Back to read products</a>
          </td>
        </tr>
      </table>
    </form>

  </div>
</body>
<!-- include footer -->
<?php
include 'header-footer/footer.php';
?>
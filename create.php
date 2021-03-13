<!-- include header -->
<?php
include 'header-footer/header.php';
?>

<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1><a href="index.php">HOME</a></h1>
      <h1>Create Product</h1>
    </div>
    <!-- PHP INSERT CODE WILL BE HERE -->
    <?php
		if ($_POST) {
			//include database connection
			include 'config/database.php';
			try {
				//insert query
				$query = "insert into products set name=:name, description=:description, price=:price, image=:image, created=:created ";
				//prepare query for execution
				$stmt = $con->prepare($query);
				//posted values
				$name = htmlspecialchars(strip_tags($_POST['name']));
				$description = htmlspecialchars((strip_tags($_POST['description'])));
				$price = htmlentities(strip_tags($_POST['price']));
				// random string
				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
				// new 'image' field
				$image = !empty($_FILES['image']['name'])
					? str_shuffle($permitted_chars)  . '-' . basename($_FILES['image']['name'])
					: '';
				$image = htmlspecialchars(strip_tags($image));
				//bind the parameters
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':price', $price);
				//image
				$stmt->bindParam(':image', $image);
				//specify when this record was inserted to the database
				$created = date('Y-m-d H:i:s');
				$stmt->bindParam(':created', $created);
				//execute the query
				if ($stmt->execute())
					echo '<div class="alert alert-success">Record was saved.</div>';
				else echo "<div class='alert alert-danger'>Unable to saved record. Please try again.</div>";
				//check image
				include('check_image.php');
			} catch (PDOException $exception) {
				die("ERROR: $exception->getMessage()");
			}
		}
		?>
    <!-- html form here where the product information will be entered-->
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <table class="table table-hover table-responsive table-bordered">
        <tr>
          <td>Name</td>
          <td><input name="name" class="form-control"></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><input name="description" class="form-control"></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><input name="price" class="form-control"></td>
        </tr>
        <tr>
          <td>Image</td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input value="Save" type="submit" class="btn btn-primary">
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
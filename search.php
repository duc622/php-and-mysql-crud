<!-- include header -->
<?php
include 'header-footer/header.php';
?>

<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h1><a href="index.php">HOME</a></h1>
      <h1>Search Products</h1>
      <!--PHP code search-->
      <?php
      if (isset($_GET['name']) || isset($_GET['description'])) {
        if (isset($_GET['name']))
          $s = $_GET['name'];
        if (isset($_GET['description']))
          $s = $_GET['description'];
        // include database connection 
        include 'config/database.php';
        // PAGINATION VARIABLES
        // page is the current page, if there's nothing set, default is page 1
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // set records or rows of data per page
        $records_per_page = 5;
        // calculate for the query LIMIT clause  
        $from_record_num = ($records_per_page * $page) - $records_per_page;
        // delete message prompt will be here
        $action = isset($_GET['action']) ? $_GET['action'] : "";
        //if it was redirected from delete.php
        if ($action == 'delete')
          echo '<div class="alert alert-success">Record was deleted</div>';
        // select data for current page
        if (isset($_GET['name']))
          $query = "select id, name, description, price from products where name like '%$s%' order by id desc limit :from_record_num, :records_per_page";
        if (isset($_GET['description']))
          $query = "select id, name, description, price from products where description like '%$s%' order by id desc limit :from_record_num, :records_per_page";
        $stmt = $con->prepare($query);
        $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        //this is how to get number of rows returned
        $num = $stmt->rowCount();
        //link to create record form
        echo
        '<a href="create.php" class="btn btn-primary">Create New Product</a>
    <div class="pull-right">
        <form action="search.php" method="get">
            <input type="text" placeholder="Search by description" name="description" />
        </form>
    </div>
    <div class="pull-right">
        <form action="search.php" method="get">
            <input type="text" placeholder="Search by name" name="name" />
        </form>
    </div>
    ';
        //check if more than 0 record found
        if ($num > 0) {
          //data from database will be here
          echo '
    <table class="table table-hover table-responsive table-bordered">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Action</th>
      </tr>';
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //extract row
            //this will make $row['firstname'] to just $firstname only
            extract($row);
            //creating new table row per second
            echo
            "<tr>
        <td>$id</td>
        <td>$name</td>
        <td>$description</td>
        <td>$price</td>
        <td>
          <a href='read_one.php?id=$id' class='btn btn-info'>Read</a>
          <a href='update.php?id=$id' class='btn btn-primary'>Edit</a>
          <a href='#' onclick='delete_user($id)' class='btn btn-danger'>Delete</a>
        </td>
      </tr>";
          }
          echo '
    </table>';
          // PAGINATION
          // count total number of rows
          if (isset($_GET['name']))
            $query = "select count(*) as total_rows from products where name like '%$s%'";
          if (isset($_GET['description']))
            $query = "select count(*) as total_rows from products where description like '%$s%'";
          $stmt = $con->prepare($query);
          //execute query
          $stmt->execute();
          //get total rows
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $total_rows = $row['total_rows'];
          //paginate records
          if (isset($_GET['name']))
            $page_url = "search.php?name=$s&";
          if (isset($_GET['description']))
            $page_url = "search.php?description=$s&";
          include_once 'paging.php';
        }
        //if no records found
        else {
          echo '<div class="alert alert-danger">No records found</div>';
        }
      } else {
        header('location:index.php');
      }
      ?>
    </div>
  </div>
  <!-- confirm delete record will be here -->
  <script>
  const delete_user = (id) => {
    const answer = confirm('Are you sure?')
    if (answer) {
      //if user clicked ok
      //pass the id to delete.php and execute the delete query
      window.location = 'delete.php?id=' + id
    }
  }
  </script>
</body>
<!-- include footer -->
<?php
include 'header-footer/footer.php';
?>
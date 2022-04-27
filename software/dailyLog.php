<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Workplace Attendance Management System</title>
    <link rel="stylesheet" href="manageUsers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
      <input type="checkbox" id="check">
      <label for="check">
        <i class="fa fa-navicon" id="btn"></i>
        <i class="fa fa-times" id="cancel"></i>
      </label>
      <div class="sidebar">
        <header>Dashboard</header>
        <a href="dailyLog.php" class="active">
          <i class="fa fa-list-alt"></i>
          <span>User logs</span>
        </a>
        <a href="users.php">
          <i class="fa fa-user"></i>
          <span>Users</span>
        </a>
        <a href="manageUsers.php">
          <i class="fa fa-edit"></i>
          <span>Manage Users</span>
        </a>
        <a href="login.php">
          <i class="fa fa-arrow-circle-left"></i>
          <span>Logout</span>
        </a>
      </div>
      <div>
        <div id="center-text">
          <h1>WORKPLACE ATTENDANCE MANAGEMENT SYSTEM</h1>
        </div>
        <div class="search__container mb-3">
          <form>
            <input type="text" name="" placeholder="Search..." class="search-input">
            <button type="submit" class="button"> <i class="fa fa-search"></i> </button>
          </form>
      </div>
      <div class="display mb-3">
        <div class="info1">
        <!-- <a href="./controller/beds.php?export=excel" class="btn btn-success m-1 mr-1 ml-2">
          <i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Export to Excel</a> -->

          <a href="./controller/dailyLog.php?export=excel" class="btn btn-success mr-1 ml-2">
          <i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Export Excel</a>
        </div>
      </div>
      <div class="home-content">
        <div class="table-card mt-1">
        <hr>
        <div class="table-responsive px-1" id="showUser">

        </div>
        </div>
        </div>
      </div>

      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 
<script type="text/javascript">
  $(document).ready(function() {
    ShowAllUsers();

    function ShowAllUsers() {
          $.ajax({
              url: ["./controller/dailyLog.php"],
              type: "POST",
              data: {
                  action: "view"
              },
              success:function(response) {
                  // console.log(response);
                  $("#showUser").html(response);
                  $("table").DataTable();
              }
          });
      }

  })
</script>

</body>
</html>

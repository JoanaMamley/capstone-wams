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
        <a href="dailyLog.php">
          <i class="fa fa-list-alt"></i>
          <span>User logs</span>
        </a>
        <a href="users.php">
          <i class="fa fa-user"></i>
          <span>Users</span>
        </a>
        <a href="manageUsers.php" class="active">
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
        <div class="search__container">
          <form>
            <input type="text" name="" placeholder="Search..." class="search-input">
            <button type="submit" class="button"> <i class="fa fa-search"></i> </button>
          </form>
      </div>
      <div class="display mb-3">
        <div class="info1">
          <div class="btn btn-success mr-1 ml-2" data-toggle="modal"
        data-target="#addModal">
          <i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add Employee</div>
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

 <!-- Add new user  -->
 <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add new Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="form-data">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="gender" placeholder="Gender" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone_number" placeholder="Phone Number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="fingerprint_id" placeholder="Fingerprint ID" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" value="Add User" placeholder="Firstname"
                                class="btn btn-success btn-block">
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>

 <!-- Edit user  Modal-->
 <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Employee Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="edit-form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="gender" id="gender" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone_number" id="phone_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" id="update" value="Update" placeholder="Firstname"
                                class="btn btn-success btn-block">
                        </div>
                    </form>
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
              url: ["./controller/manage-users.php"],
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


        // insert ajax request
        $("#insert").click(function(e) {
          if ($("#form-data")[0].checkValidity) {
              e.preventDefault();
              $.ajax({
                  url: ["./controller/manage-users.php"],
                  type: "POST",
                  data: $("#form-data").serialize() + "&action=insert",
                  success: function(response) {

                      Swal.fire({
                      title: 'User added successfully!',
                      showConfirmButton: false,
                      type: 'success',
                      icon: 'success',
                      timer: 500,
                      timerProgressBar: true,
                  })

                  $("#addModal").modal("hide");
                  $("#form-data")[0].reset();
                  ShowAllUsers();

                    }
                });
            }
      });

      // Edit user
      $("body").on("click", ".editBtn", function(e) {
          // console.log("working");
          e.preventDefault();
          edit_id = $(this).attr("id");
          $.ajax({
            url: "./controller/manage-users.php",
            type: "POST",
            data: {
              edit_id: edit_id
              },
            success: function(response) {
              console.log(response);
              data = JSON.parse(response);
              // console.log(data);
              $("#id").val(data.id);
              $("#name").val(data.name);
              $("#email").val(data.email);
              $("#gender").val(data.gender);
              $("#phone_number").val(data.phone_number);
            }
            });
        });

        // Update ajax request
        $("#update").click(function(e) {
        if ($("#edit-form-data")[0].checkValidity) {
            e.preventDefault();
            $.ajax({
            url: ["./controller/manage-users.php"],
            type: "POST",
            data: $("#edit-form-data").serialize() + "&action=update",
            success: function(response) {

              Swal.fire({
                  title: 'Employee details updated successfully!',
                  showConfirmButton: false,
                  type: 'success',
                  icon: 'success',
                  timer: 800,
                  //timerProgressBar: true,
              })

              $("#editModal").modal("hide");
              $("#edit-form-data")[0].reset();
              ShowAllUsers();
            }
            });
          }
        });

    // Delete ajax request 
    $("body").on("click", ".delBtn", function(e) {
          e.preventDefault();
          var tr = $(this).closest("tr");
          del_id = $(this).attr("id");
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: './controller/manage-users.php',
                  type: 'POST',
                  data: {
                    del_id: del_id
                  },
                success: function(response) {
                  tr.css('background-color', '#ff6666');
                  Swal.fire({
                    title: 'Employee deleted successfully!',
                    showConfirmButton: false,
                    type: 'success',
                    icon: 'success',
                    timer: 900,
                    //timerProgressBar: true,
                  })
                  ShowAllUsers();
                        }
                    });

                }
            })

        });


        // Show users detail  page
        $("body").on("click",".infoBtn",function(event){
          event.preventDefault();
          info_id = $(this).attr("id");
          $.ajax({
            url: "./controller/manage-users.php",
            type: "POST",
            data: {info_id: info_id},
            success: function(response) {
              //console.log(response);
              data = JSON.parse(response);
              Swal.fire({
                title: '<strong>User info : ID '+data.id+'</strong>',
                type: 'info',
                html: '<b>Name:</b> '+data.name + '<br>' + 
                      '<b>Email:</b> '+data.email + '<br>' + 
                      '<b>Gender:</b> '+data.gender + '<br>' +
                      '<b>Phone number:</b> '+ data.phone_number + '<br>' + 
                      '<b>Fingerprint ID:</b> '+data.fingerprint_id
              })
            }
          });
      });

  })
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Chat Vago</title>
  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

      <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
</head>

<body>
  <div style="margin-top: 20px;">
    <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Send Message</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <label for="exampleInputEmail1">Message</label>
          <textarea name="send_message_text" class="form-control" rows="5" id="send_message_text"></textarea>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="sendMessage">Send</button>
        </div>
        
      </div>
    </div>
  </div>
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
  <div class="card card-register mx-auto mt-5">
      <div class="card-body">
        <form action="chatbox.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Route : </label>
            <span>https://chatvago.tier5-development.us/send.php?psid=<PSID></span>
            <label for="exampleInputEmail1">Access Token </label>
            <input class="form-control" id="access_token" name="access_token" type="text" aria-describedby="emailHelp" placeholder="Access Token">
          </div>
          <br>
          <input type="submit" class= "btn btn-primary px-5" name="signup_submit" value="Save"><br>
        </form>
      </div>
    </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Profile Pic</th>
                  <th>First Name </th>
                  <th>Last Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                ini_set('display_errors', '1');
                include_once('inc/connection.php');
                include_once('inc/functions.php');
                $find_user = mysqli_query($conDB, "SELECT * FROM `users`");
                if (mysqli_num_rows($find_user) != 0) {
                while($row = mysqli_fetch_array($find_user)) {
                ?>

                <tr>
                <td><input type="checkbox" name="checkUser" id="checkUser" value="<?php echo $row['fb_id']?>"></td>
                <td><img src="<?php echo $row['profile_pic']?>" width="80" height="80"></td>
                <td><?php echo $row['first_name']?></td>
                <td><?php echo $row['last_name']?></td>
                <td><a href="chatbox.php?deleteId=<?php echo $row['id']?>">Delete</td>
                </tr>
                <?php 
                }
              }?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
  <button type="button" class="btn btn-primary px-5" data-toggle="modal" data-target="#myModal">
   Send Message
  </button>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#sendMessage").click(function(){
            var chooseUser = [];
            $.each($("input[name='checkUser']:checked"), function(){            
                chooseUser.push($(this).val());
            });
            console.log("My favourite sports are: " + chooseUser.join(", "));

            var getMesg = $('#send_message_text').val();

            $.post('message.php', {getMesg: getMesg, chooseUser: chooseUser.join(", ")}, function(data){
             
            alert(data);
             
           }).fail(function(data) {
         
            // just in case posting your form failed
            console.log(data);
             
            });
        });
    });
    </script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
      <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>

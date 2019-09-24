<?php
 include("includes/DatabaseConfig.php");
 $query ="SELECT first_name,last_name,phone,email,birthdate FROM users";
 $result = mysqli_query($con, $query);
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>admin monitor</title>
           <script src="jquery/jquery-2.2.0.js"></script>
           <link href ='bootstrap-3.3.6/bootstrap.min.css' rel='stylesheet' type='text/css'>
           <script src="jquery/jquery.dataTables.min.js"></script>
           <script src="jquery/dataTables.bootstrap.min.js"></script>
           <link rel="stylesheet" href="bootstrap-3.3.6/dataTables.bootstrap4.min.css" />

      </head>
      <style>
      #body-bg
      {
        background-color: #ECEBEB;
      }
      </style>
      <body id='body-bg' >
        <div class='jumbotron' style ='background-color: #918888; margin-top:0px; padding-top:20px; padding-bottom:20px'>
        <a href='Login.php'><button class="btn btn-outline-success" style='margin-left: 20px; margin-right:20px'><b><font color='black'>Home Page</font></b></button></a>

      </div>
           <br />
           <div class="container">
                <h3 align="center"><u>User List</u></h3>
                <br />
                <div class="table-responsive">
                     <table id="employee_data" class="table table-striped table-bordered">
                          <thead>
                               <tr>
                                    <td>Name</td>
                                    <td>Age</td>
                                    <td>Email</td>
                                    <td>Phone</td>

                               </tr>
                          </thead>
                          <?php
                          while($row = mysqli_fetch_array($result))
                          {
                            $dateOfBirth= $row["birthdate"];
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            //echo 'Age is '.$diff->format('%y');
                               echo '
                               <tr>
                                    <td>'.ucfirst($row["first_name"]).' '.ucfirst($row["last_name"]).'</td>
                                    <td>'.$diff->format('%y'). '</td>
                                    <td>'.$row["email"].'</td>
                                    <td>'.$row["phone"].'</td>
                               </tr>
                               ';
                          }
                          ?>
                     </table>
                </div>
           </div>
      </body>
 </html>
 <script>
 $(document).ready(function(){
      $('#employee_data').DataTable();
 });
 </script>

<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
  <html>
   <?php

      session_start();
      if (isset($_SESSION['Login']))
       {
         
          unset($_SESSION["TestCriteria"]);
          unset( $_SESSION["FindId"]);
          unset( $_SESSION["MasterData"]);
          unset( $_SESSION["Login"]);
       }

      include("header.php");
      require("Connection.php");
      include("HTMLHelperMethod.php");
      $conn=connection();



      if (isset($_POST['btnLogin']))
      { 
          $varEmailAddress=$_POST['txtEmailAddress'];
          $varPassword=$_POST['txtPassword'];
          
          $query="Select * From tblRegistration Where EmailAddress='".$varEmailAddress."' and Password='".$varPassword."'";
          
          $result=mysqli_query($conn,$query);
         
         $row=mysqli_fetch_array($result);
         if ($row['EmailAddress']==$varEmailAddress && $row['Password']==$varPassword)
         {
               
             $_SESSION["UserId"]=$row['UserId'];
             $_SESSION["FirstName"]=$row['FirstName'];
             $_SESSION["userType"]=$row['userType'];
             $_SESSION["Login"]=$row['FirstName'];
            echo "<script> location.href='ProductType.php' </script>";
          }
          
          else{
            echo "<script>alert ('INVALID USERID OR PASSWORD')</script>";
          }

      }

     
     
  ?>
  <body>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

                <h2 > User Login</h2>
              </div>
                <form method="post" action="index.php">
                    <div class="card-body mx-auto" style="width: 700px;" >
                    


                        <div class="row">

                          <!--
                          <div class="col-md-5 pr-md-1">
                            <div class="form-group">
                              <label>Company (disabled)</label>
                              <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                            </div>    
                          </div>
                        -->
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label>Email Address</label>
                              <input type="text" class="form-control" placeholder="Enter Email Address" name="txtEmailAddress" id="txtEmailAddress" >
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Password</label>
                              <input type="Password" class="form-control" placeholder="Enter Password" name="txtPassword" id="txtPassword" >
                            </div>
                          </div>
                        </div>
                        
                      
                    
                  <div class="card-footer mx-auto" style="width: 500px;">
                    <button type="submit" class="btn btn-fill btn-primary" name="btnLogin" >Login</button>
                  </div>
              </form>
            </div>
          </div>
         
        </div>
      </div>
      
</body>

<?php
    include ("footer.php");
    include ("coreJSBelowFooter.php");
?>

<script type="text/javascript">

    function myMessage(){
    alert "test successful";
  }
</script>

</html>
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
    <?php

            session_start();
        
    
             include("header.php");
              require("Connection.php");
             include("HTMLHelperMethod.php");
        



              if (isset($_POST["btnRegister"]))
              {

                $varFirstName=$_POST["txtFirstName"];
                $varLastName=$_POST["txtLastName"];
                $varEmailAddress=$_POST["txtEmailAddress"];
                $varPassword=$_POST["txtPassword"];
                $varUserName=$_POST["txtUserName"];
                $varUserType=$_POST["cmbUserType"];
                
                  $result=add_row("tblRegistration",array("firstName"=>"'$varFirstName'", "lastName"=> "'$varLastName'","EmailAddress"=>"'$varEmailAddress'","Password"=>"'$varPassword'","UserName"=>"'$varUserName'","UserType"=>"'$varUserType'"));


                  
                  if($result)
                  
                  {
                    echo showMessage("Record Inserted..");
                    echo redirect("register.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('REGISTERATION FAILED') </script>";
                  }
                  
                
                
              }


    ?>
    
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">User Registration</h5>
              </div>
              <form method="post" action="Register.php">
                  <div class="card-body">
                 
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
                            <label>User name</label>
                            <input type="text" class="form-control" placeholder="Enter Username" name="txtUserName" id="txtUserName" >
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="txtPassword" id="txtPassword">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="Enter First Name" name="txtFirstName" id="txtFirstName" >
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name" name="txtLastName" id="txtLastName" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="Email" class="form-control" placeholder="Enter Email Address" name="txtEmailAddress" id="txtEmailAddress">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label>User Type</label>
                            <Select class="form-control" name="cmbUserType" Id="cmbUserType">
                                   <option style="background-color: #27293D">Admin</option>
                                    <option style="background-color: #27293D"   >Local</option>
                            </Select>
                            
                          </div>
                        </div>
                        
                    </form>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary" name="btnRegister">Register</button>
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

</html>
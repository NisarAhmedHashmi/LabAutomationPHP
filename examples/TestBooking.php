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

         
         
          //session_destroy();
        function unSetAll()
        {
          unset($_SESSION["TestCriteria"]);
            unset( $_SESSION["FindId"]);
          unset( $_SESSION["MasterData"]);

        }

        
       

       header('Cache-Control: no-store, no-cache, must-revalidate');
      include("header.php");
      include("links.php");
      require("Connection.php");
      include("HTMLHelperMethod.php");

      $conn=connection();


      if (isset($_POST["btnNew"]))
      {
        unSetAll();
       
      }

     elseif (isset($_POST["btnSave"]))
      {   $row_Value='';
            $varBookingId = $_POST["txtBookingId"];
         $varBookingDate = $_POST["txtBookingDate"];
        $varProductId = $_POST["cmbProductName"];
         $varProductName = $_POST["txtProductNameHolder"];
      
         

                 $result=add_Booking_Record("BookingMaster","BookingDetail",array("BookingDate"=>"'$varBookingDate'","ProductId"=>"'$varProductId'"),"BookingId",$_SESSION["TestCriteria"]);

                  if($result)
                  
                  {
                      
                    echo showMessage("Test booked successfully..");
                    unSetAll();
                    echo redirect("TestBooking.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Record not saved') </script>";
                  }

      }

      elseif (isset($_POST["btnUpdate"]))

          {
      
           $row_Value='';
        $varBookingId = $_POST["txtBookingId"];
         $varBookingDate = $_POST["txtBookingDate"];
        $varProductId = $_POST["cmbProductName"];
         $varProductName = $_POST["txtProductNameHolder"];

         //   $result=update_row("Product",array("ProductName"=>"'$varProduct'","ProductTypeId"=>"'$varProductTypeId'"),"ProductId="."'".$varProductId."'");

             $result=Update_Booking_Record("BookingMaster","BookingDetail",array("ProductId"=>"'".$varProductId."'", "BookingDate"=>"'$varBookingDate'"),"BookingId",$_SESSION["TestCriteria"],"BookingId=$varBookingId",$varBookingId);


                 if($result)
                  
                  {
                    
                    echo showMessage("Test Booking updated..");
                     unSetAll();
                    echo redirect("TestBooking.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Test Booking not updated...Please check...!') </script>";
                  }
          }


     
     elseif (isset($_GET["Find"]))
     { $_SESSION["FindId"]=$_GET["id"];
          
          $result=fetch_Selected_Row_MT("BookingMaster","BookingDetail","Product","TestMaster",array("BookingMaster.BookingId"=>$_GET["id"]),"BookingId","ProductId","TestId");
    
         //mysqli_fetch_assoc by using this method data can only be fetchd using field name but not from index number
    
             //mysqli_fetch_array by using this method data can be fetchd using field name and index number both

            if ($result)
              
             { $SrNo=0;
              $_SESSION["TestCriteria"]=array();
              $_SESSION["MasterData"]=array();

              // $foundRow=mysqli_fetch_array($myResult);
             
               while ($row=mysqli_fetch_assoc($result))
               {
                 
                  array_push($_SESSION["TestCriteria"], array("SrNo"=>$SrNo,"BookingId"=>$row["BookingId"],"BookingDetailId"=>$row["BookingDetailId"],"TestId"=>$row["TestId"],"TestName"=>$row["TestName"],"Status"=>$row["Status"]));  
                  $SrNo=$SrNo+1;

                  array_push($_SESSION["MasterData"], array("BookingId"=>$row["BookingId"],"BookingDate"=>$row["BookingDate"],"ProductId"=>$row["ProductId"],"ProductName"=>$row["ProductName"],"Status"=>$row["Status"])); 


               }

                             

                     $result=fetch_Selected_Row_MT("BookingMaster","BookingDetail","Product","TestMaster",array("BookingMaster.BookingId"=>$_GET["id"]),"BookingId","ProductId","TestId");
                  $row=mysqli_fetch_array($result);
                
             }
            else
              {
                echo "<script>  alert ('Result doest not exist') </script>";
          
            }
            
             
     }
     
      elseif (isset($_POST["btnDelete"]))
      {
         $varBookingId=$_POST["txtBookingId"];


                  $result=delete_row_MT("BookingMaster","BookingDetail",array("BookingId"=>"'$varBookingId'"));

                  if($result)
                  
                  {
                    
                    echo showMessage("Test Booking deleted..");
                    unSetAll();
                    echo redirect("TestBooking.php");
                    
                }
                  
                  
                  else
                  {
                      
                    echo "<script>  alert ('Record not deleted') </script>";
                  }

      }


      else if(isset($_POST["btnAdd"]))  
      {


         $varBookingId = $_POST["txtBookingId"];
         $varBookingDate = $_POST["txtBookingDate"];
        $varProductId = $_POST["cmbProductName"];
         $varProductName = $_POST["txtProductNameHolder"];
         $varTestId = $_POST["cmbTestName"];
          $varTestName = $_POST["txtTestNameHolder"];
       // $varCriteriaId = $_POST["txtCriteriaId"];
       // $varCriteria= $_POST["txtCriteria"];
       
        if(isset($_SESSION["TestCriteria"]))
        {
          $t_count = count($_SESSION["TestCriteria"]);
          array_push($_SESSION["TestCriteria"], array("SrNo"=>$t_count, "BookingId"=>"","BookingDetailId"=>"","TestId"=>"$varTestId","TestName"=>$varTestName,"Status"=>""));    
        }
        else
        {
          $t_count=0;
          $_SESSION["TestCriteria"] = array(
            array("SrNo"=>$t_count, "BookingId"=>"","BookingDetailId"=>"","TestId"=>"$varTestId","TestName"=>$varTestName,"Status"=>"")
          );
        }   


      if(isset($_SESSION["MasterData"]))
        {
         
          unset( $_SESSION["MasterData"]);

           $_SESSION["MasterData"] = array(
             array("BookingId"=> "","BookingDate"=> "","ProductId"=>"","ProductName"=>"","Status"=>"")
          );

          array_push($_SESSION["MasterData"], array("BookingId"=> $varBookingId,"BookingDate"=> $varBookingDate,"ProductId"=>$varProductId,"ProductName"=>$varProductName,"Status"=>""));    

          
        } 
        else
        {
         
          $_SESSION["MasterData"] = array(
             array("BookingId"=> $varBookingId,"BookingDate"=> $varBookingDate,"ProductId"=>$varProductId,"ProductName"=>$varProductName,"Status"=>"")
          );

        
           

         }

      }
        

        else if(isset($_GET["Select"]))
        { 
          $id = $_GET["SrNo"];
           $BookingDetailId = $_GET["BookingDetailId"];
         
          foreach($_SESSION["TestCriteria"] as $value)
          { 
           
           // if($value["id"] == $id)
            if($value["SrNo"] == $id)
            { echo "<script> alert ('Mil gaya') </script>";

              if (!empty($BookingDetailId))
              {
                 

                  $result=fetch_Selected_Row_MT("BookingMaster","BookingDetail","Product","TestMaster",array("BookingMaster.BookingId"=>$_SESSION["FindId"]),"BookingId","ProductId","TestId");


                //  $result=fetch_Selected_Row_MT("TestMaster","TestDetail","TestType",array("TestMaster.BookingId"=>$_SESSION["FindId"]),"BookingId","TestTypeId");


                  $row=mysqli_fetch_array($result);
              }
                  break;
             //echo redirect("Test.php");
              
            }
          }
        

        }

else if(isset($_GET["Remove"]))
        { 
          $id = $_GET["SrNo"];
          $BookingDetailId = $_GET["BookingDetailId"];
           

         foreach($_SESSION["TestCriteria"] as $value)
          { 
           
           // if($value["id"] == $id)
            if($value["SrNo"] == $id)
            {

                  

           //   unset($_SESSION["TestCriteria"][$id]);
               sort($_SESSION["TestCriteria"]);
                if (!empty($BookingDetailId))
                {
                    $result=fetch_Selected_Row_MT("BookingMaster","BookingDetail","Product","TestMaster",array("BookingMaster.BookingId"=>$_SESSION["FindId"]),"BookingId","ProductId","TestId");



                  $row=mysqli_fetch_array($result);

                 
                    $result=delete_row("BookingDetail",array("BookingDetailId"=>$BookingDetailId));
                    if ($result){
                      echo "<script> alert ('Test Removed')</script";
                    }
                }
                  
                  break;

                           
            }
          }
        

        }

        else if (isset($_POST["btnEditDetail"]))
        {
          
          $varBookingId = $_POST["txtBookingId"];
         $varBookingDate = $_POST["txtBookingDate"];
        $varProductId = $_POST["cmbProductName"];
         $varProductName = $_POST["txtProductNameHolder"];
        $varBookingDetailId = $_POST["txtDetailBookingDetailId"];
        $TestId = $_POST["cmbTestName"];
         $TestName = $_POST["txtTestNameHolder"];
        $DetailStatus = $_POST["txtDetailStatus"];
        

             $id = $_POST["txtDetailSrNo"];


            foreach($_SESSION["TestCriteria"] as $value)
            { 
             
             // if($value["id"] == $id)
              if($value["SrNo"] == $id)
              {


                   
                    //$value["CriteriaId"]=$varCriteria;
                    
                 unset($_SESSION["TestCriteria"][$id]);
                 // array_push($_SESSION["TestCriteria"], array("SrNo"=>count($_SESSION["TestCriteria"])+1,"BookingId"=>$varBookingId,"BookingDetailId"=>$varBookingDetailId,"TestId"=>$varCriteriaId,"Criteria"=>$varCriteria));   

                  array_push($_SESSION["TestCriteria"], array("SrNo"=>count($_SESSION["TestCriteria"])+1, "BookingId"=>$varBookingId,"BookingDetailId"=>$varBookingDetailId,"TestId"=>$TestId,"TestName"=>$TestName,"Status"=>$DetailStatus));  

              // sort($_SESSION["TestCriteria"]);
                  $result=fetch_Selected_Row_MT("BookingMaster","BookingDetail","Product","TestMaster",array("BookingMaster.BookingId"=>$_SESSION["FindId"]),"BookingId","ProductId","TestId");

                    $row=mysqli_fetch_array($result);
                    break;
                //echo redirect("Test.php");
                
              }
            }

        }
       
  

    ?>

  <body>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

                <h2 >Test Booking</h2>
              </div>
                <form method="post" action="TestBooking.php">
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
                           <!--   <label>Product Type Id</label> -->

                            <?php  
                              $BookingId=0;
                               $BookingDate="";
                              $ProductId=0;
                              $ProductName="";
                              $Status="";

                                // if (isset($_GET["Remove"])|| isset($_GET["Select"]) ||isset($_GET["btnEditDetail"]))
                              if (isset($_GET["id"]) || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"])))
                                { 
                                  
                                  $BookingId= $row["BookingId"];
                                  //echo $BookingId;
                                }
                              else if (isset($_POST["txtBookingId"]) || isset($_POST["btnUpdate"])) 
                                {
                                   
                                    $BookingId= $_POST["txtBookingId"];
                                }
                              else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"])) 
                                {
                                   
                                   sort($_SESSION["MasterData"]);
                                    foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                       $BookingId= $Mastervalue["BookingId"];
                                     
                                    }
                                   
                                }
                              
                               ?>

                              <input type="hidden" class="form-control" placeholder="Auto Id" name="txtBookingId" id="txtTestBookingId"   value=<?php echo $BookingId ?>  >
                            </div>
                          </div>
                        </div>

                       <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <LABEL>Booking Date</LABEL>

                            <?php  
                              if (isset($_GET["id"]) || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"])))

                                {  
                                  
                                  $BookingDate= $row["BookingDate"];
                                }
                              else if (isset($_POST["btnAdd"]) || isset($_POST["btnUpdate"]) || isset($_POST["btnEditDetail"])) 
                                {  
                                    
                                     $BookingDate= $_POST["txtBookingDate"];
                                }

                            else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"])) 
                                {
                                   
                                    sort($_SESSION["MasterData"]);
                                    foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                        $BookingDate= $Mastervalue["BookingDate"];
                                        
                                    }
                                   
                                }
                           ?>


                              <input type="Date" class="form-control" name="txtBookingDate" id="txtBookingDate"  value=<?php echo "'".$BookingDate."'"; ?>  >
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Productd Name</label>
                                 <select name="cmbProductName" Id="cmbProductName" class="form-control" class="input-xlarge"   onchange=" getText()">

                                  <?php if (isset($_GET["id"])  || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"]))) {

                                      $varProductName=$row["ProductName"];

                                     

                                  ?>
                                    <option  style="background-color: #27293D" value="<?php echo $row["ProductId"]; ?>">  <?php echo $row["ProductName"];?>  
                                  </option>

                                  <?php 
                                  }

                                  else if (isset($_POST["btnAdd"]) || isset($_POST["btnUpdate"]) || isset($_POST["btnEditDetail"]))
                                  {
                                    
                                  ?>

                           <option  style="background-color: #27293D" value="<?php echo $_POST["cmbProductName"]; ?>">  <?php echo $_POST["txtProductNameHolder"]; ?>  
                                  </option>
                                <?php      
                                  }

                                  else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"]))
                                  {
                                    
                                      sort($_SESSION["MasterData"]);

                                      foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                       $ProductId= $Mastervalue["ProductId"];
                                       $varProductName= $Mastervalue["ProductName"];
                                       
                                    }
                                  ?>

                                    <option  style="background-color: #27293D" value="<?php echo $ProductId; ?>">  <?php echo $varProductName; ?>  
                                  </option>
                                <?php      
                                  }


                                  else
                                  { 
                                   ?> 

                                    <option  style="background-color: #27293D">--Select--</option>


                                      <?php 
                                       }

                                           $conn=Connection();
                                          $query="Select * from Product";
                                          $PTresult=mysqli_query($conn,$query);

                                          while ($row=mysqli_fetch_assoc($PTresult))
                                      { ?>
                               `
                                         <option  style="background-color: #27293D" value="<?php echo $row['ProductId'];?>"> <?php echo $row["ProductName"]; ?> </option>

                                      <?php
                                      }



                                      ?>
                                </select>
                              
                                <?php 
                                  if (isset($_POST["btnAdd"]))
                                  { 
                                ?>
                                   <input type="hidden" class="form-control" placeholder="Product Holder" name="txtProductNameHolder" id="txtProductNameHolder"  value=<?php  echo "'".$_POST["txtProductNameHolder"]."'"; ?>  >
                                <?php

                                  }

                                  else
                                { 
                                  ?>

                                 <input type="hidden" class="form-control" placeholder="Product Holder" name="txtProductNameHolder" id="txtProductNameHolder"  value=<?php if(!empty($varProductName)) echo "'".$varProductName."'" ;?> >
                                <?php
                                }
                                ?>
                             </div>
                          </div>
                        </div>


                       <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Status</label>

                            <?php  
                              if (isset($_GET["id"]) || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"])))

                                {  
                                  
                                  $Status= $row["Status"];
                                }
                              else if (isset($_POST["btnAdd"]) || isset($_POST["btnUpdate"]) || isset($_POST["btnEditDetail"])) 
                                {  
                                   
                                    $Status= $_POST["txtStatus"];
                                }

                            else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"])) 
                                {
                                   
                                    sort($_SESSION["MasterData"]);
                                    foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                       $Status= $Mastervalue["Status"];
                                        
                                    }
                                   
                                }
                           ?>


                              <input type="text" class="form-control" placeholder="Status" name="txtStatus" id="txtStatus"  value=<?php echo "'".$Status."'"; ?>  >
                            </div>
                          </div>
                        </div>
                      
         
                    <div class="form-group" >
                       <table class="table table-hover table-dark table-responsive"   style="font-size: 16px;" width="100%" border="0">
                           
                              <thead style="text-align: center;">
                                  <tr>
                                    <th style="visibility: hidden;">SrNo</th>
                                    <th style="visibility: hidden;">BookingDetailId</th>
                                      <th style="visibility: hidden;">Booking Id</th>
                                      <th>Test Name</th>
                                       <th style="visibility: hidden;">Test Name Holder</th>
                                        <th>Status</th>
                                          <th>Action</th>
                                          <th>Action</th>
                                  </tr>   
                              </thead>
                              <tbody>
                                   <tr>
                                    <td>

                                      <?php
                                            $DetailSrNo=0;

                                          if (isset($_GET["Select"]))
                                          {
                                            $DetailSrNo=$value["SrNo"];
                                          }



                                      ?>
                                        <input type="hidden" class="form-control" placeholder="SrNo" name="txtDetailSrNo" id="txtDetailSrNo" value=<?php echo $DetailSrNo ?>   >
                                    </td>

                                     <?php
                                            $DetailBookingDetailId="";
                                          if (isset( $_GET["Select"]))
                                          {

                                            
                                            $DetailBookingDetailId=$value["BookingDetailId"];
                                          }
                                          else
                                          {
                                             $DetailBookingDetailId="";
                                            

                                          }

                                      ?>

                                      <td>
                                        <input type="hidden" class="form-control" placeholder="Booking Detail Id" name="txtDetailBookingDetailId" id="txtDetailBookingDetailId" value=<?php echo $DetailBookingDetailId ?>    >
                                      </td>


                                        <?php
                                            $DetailBookingId="";
                                          if (isset( $_GET["Select"]))
                                          {

                                            
                                            $DetailBookingId=$value["BookingId"];
                                          }
                                          else
                                          {
                                             $DetailBookingId="";
                                            

                                          }

                                      ?>

                                      <td>
                                        <input type="hidden" class="form-control" placeholder="Auto Booking Id" name="txtDetailBookingId" id="txtDetailBookingId" value=<?php echo $DetailBookingId ?>    >
                                      </td>

                                     
                                      <td colspan="2" style="width: 150px;">
                                         <select name="cmbTestName" Id="cmbTestName" class="form-control" class="input-xlarge"   onchange=" getTestText()">   

                                          <?php if (isset($_GET["id"])  || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"]))) {

                                              $varTestName=$row["TestName"];

                                              
                                     

                                           ?>
                                                  <option  style="background-color: #27293D" value="<?php echo $row["TestId"]; ?>">  <?php echo $row["TestName"];?>  
                                                </option>

                                              <?php 
                                              }

                                              else if (isset($_POST["btnAdd"]) || isset($_POST["btnUpdate"]) || isset($_POST["btnEditDetail"]))
                                              {
                                              
                                              ?>

                                         <option  style="background-color: #27293D" value="<?php echo $_POST["cmbTestName"]; ?>">  <?php echo $_POST["txtTestNameHolder"]; ?>  
                                                </option>
                                        <?php      
                                          }

                                        else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"]))
                                        {
                                           
                                           // sort($_SESSION["MasterData"]);

                                           // foreach($_SESSION["TestCriteria"] as $value)
                                           //{        
                                             $TestId= $value["TestId"];
                                             $varTestName= $value["TestName"];
                                             
                                          //}
                                        ?>

                                        <option  style="background-color: #27293D" value="<?php echo $TestId; ?>">  <?php echo $varTestName; ?>  
                                        </option>
                                      <?php      
                                        }


                                      else
                                      { 
                                       ?> 

                                        <option  style="background-color: #27293D">--Select--</option>


                                          <?php 
                                           }

                                               $conn=Connection();
                                              $query="Select * from TestMaster";
                                              $PTresult=mysqli_query($conn,$query);

                                              while ($row=mysqli_fetch_assoc($PTresult))
                                          { ?>
                                   `
                                             <option  style="background-color: #27293D" value="<?php echo $row['TestId'];?>"> <?php echo $row["TestName"]; ?> </option>

                                          <?php
                                          }



                                          ?>
                                     </select>
                                    </td>


                                        <?php 
                                  if (isset($_POST["btnAdd"]))
                                  { 
                                ?>
                                   <td>
                                       <input type="hidden" class="form-control" placeholder="Test Holder" name="txtTestNameHolder" id="txtTestNameHolder"  value=<?php  echo "'".$_POST["txtTestNameHolder"]."'"; ?>  >
                                  </td>
                                <?php

                                  }

                                  else
                                { 
                                  ?>
                                  <td>
                                       <input type="hidden" class="form-control" placeholder="Test Holder" name="txtTestNameHolder" id="txtTestNameHolder"  value=<?php if(!empty($varTestName)) echo "'".$varTestName."'" ;?> >
                                  </td>
                                <?php
                                }
                                ?>


                                       <?php
                                            $DetailStatus="";
                                          if (isset( $_GET["Select"]))
                                          {
                                            
                                            $DetailStatus="'".$value["Status"]."'";
                                          }

                                          else
                                          {
                                            $DetailStatus="";
                                          }

                                      ?>
                                      <td>
                                         <input type="text" class="form-control" placeholder="Status" name="txtDetailStatus" id="txtDetailStatus" value=<?php echo $DetailStatus ?>>
                                       </td>




                                      <?php
                                      
                                        if(isset($_GET["Select"]))
                                        {

                                       ?>   

                                          <td> <button type="submit" class="btn btn-fill btn-link" name="btnEditDetail" >Add It</button></td>
                                        <?php
                                        }

                                        else
                                        {
                                        ?>

                                            <td> <button type="submit" class="btn btn-fill btn-link" name="btnAdd" >Add </button></td>

                                        <?php
                                           }
                                         ?>  
                                </tr>

                                <?php 
                                if(isset($_SESSION["TestCriteria"]))
                                { 
                                  foreach($_SESSION["TestCriteria"] as $value)
                                  {
                                  ?>
                                  <tr>
                                    <td style="visibility: hidden;"><?php echo $value["SrNo"] ?></td>
                                    <td style="visibility: hidden;"><?php echo $value["BookingDetailId"] ?></td>
                                    <td style="visibility: hidden;"><?php echo $value["BookingId"] ?></td>
                                    <td style="visibility: hidden;"><?php echo $value["TestId"] ?></td>
                                    <td style="visibility: visible;"><?php echo $value["TestName"] ?></td>
                                    <td style="visibility: visible;"><?php echo $value["Status"] ?></td>
                                   

                                  

                                    <td><a href="TestBooking.php?Remove&SrNo=<?php echo $value["SrNo"]?>&BookingDetailId=<?php echo $value["BookingDetailId"]?>" onClick="return confirm('Are You Sure to remove item')"><img src="../Images/Delete4.png" width="30px" height="30px" style="background-image:none!important";></a>
                                    </td>
                                    <td>

                                      <a href="TestBooking.php?Select&SrNo=<?php echo $value["SrNo"]?>&BookingDetailId=<?php echo $value["BookingDetailId"]?>" ><img src="../Images/Select1.jpg" width="30px" height="30px"></a></td>
                                  </tr>
                                  <?php 
                                    }
                                    }
                                ?> 

                            </tbody>
                       </table>
                    </div>


                  <div class="card-footer mx-auto" style="width: 600px;">
                     <button type="submit" class="btn  btn-warning" name="btnNew" onclick="clearFields()">New</button>
                    <?php
                      if (isset($_SESSION["FindId"]))

                      {
                    ?>
                    <button type="submit" class="btn btn-fill btn-primary" name="btnUpdate" >Update</button>

                    <?php
                     }

                    else
                    { 
                    ?>
                        <button type="submit" class="btn btn-fill btn-primary" name="btnSave" >Save</button>

                     
                     <?php

                    }
                    ?>

                    <button type="submit" class="btn  btn-danger " name="btnDelete"  onClick="return confirm('Are You Sure to remove item')">Delete</button>
                   
                    <button type="button" class="btn  btn-success"  data-target="#myModal" data-toggle="modal" > Find </button>
                  </div>


              </form>
            </div>
          </div>
         
        </div>

      </div>

 

   <div class="container">
  

  <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Test Booking Search</h4>
           
        </div>
        <div class="modal-body">
      
               <center><input class="form-control" id="search" type="text" style="width: 80%; color:black" placeholder="Search.."></center><br>
       
                                      <div>
                                                <table class="table table-hover table-dark table-bordered" style="font-size: 16px;">
                                                    <thead >
                                                        <tr>
                                                            <th>Booking Date</th>
                                                            <th>Booking Id</th>
                                                             <th>Product</th>
                                                        </tr>   
                                                    </thead>
                                                    <tbody id="myTable">
                                                        <?php 


                                                           // $result=fetch_row("ProductType","");
                                                             $conn=Connection();
                                                             $query="Select a.BookingDate,a.BookingId, b.ProductName from BookingMaster a, Product b Where a.ProductId=b.ProductId order by a.BookingId";
                                                                                                                                             
                                                                          
                                                            $result=mysqli_query($conn,$query);

                                                             $sno = mysqli_num_rows($result);
                                                           while($row=mysqli_fetch_array($result))
                                                            {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?php echo $row["BookingDate"]; ?></td>
                                                            <td><?php echo $row["BookingId"]; ?></td>
                                                            <td><?php echo $row["ProductName"]; ?></td>
                                                            <!-- <td><?php //echo $row["p_address"]; ?></td> -->
                                                            <td>
                                                                <a name="SearchProductType" class="btn btn-info" title="Select" href="TestBooking.php?Update&Find&id=<?php echo $row["BookingId"]; ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                <!-- <button class="btn btn-success" title="Select" type="submit"><i class="fa fa-check-square-o" aria-hidden="true"></i></button> -->
                                                            </td>
                                                        </tr>
                                                                
                                                       <?php
                                                          }
                                                       ?>     
                                                    </tbody>
                                                </table>
                                                 <script>
                                                    $(document).ready(function(){
                                                        $("#search").on("keyup", function() {
                                                            var value = $(this).val().toLowerCase();
                                                            $("#myTable tr").filter(function() {
                                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                            });
                                                        });
                                                    });
                                                </script>
                                                
                                            </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>


 <!--Modal Form -->
      <!-- Modal -->
 <?php
    include ("footer.php");

    include ("coreJSBelowFooter.php");

?>


<script>
    function clearFields()
   {  
      document.getElementById('txtBookingId').value = "";
      document.getElementById('txtProductName').value = "";
       document.getElementById('cmbTestType').selectedIndex = 0;
       window.location.href="Test.php";
      // window.location.href="TestType.php";
       //load("TestType.php");
       //location.reload();
   }

   function getText(){
    var vSkill = document.getElementById('cmbProductName');

     var vSkillText = vSkill.options[vSkill.selectedIndex].innerHTML;
    document.getElementById('txtProductNameHolder').value=vSkillText;

  //alert(vSkillText);
   }
   

    function getTestText(){
    var vSkill = document.getElementById('cmbTestName');

     var vSkillText = vSkill.options[vSkill.selectedIndex].innerHTML;
    document.getElementById('txtTestNameHolder').value=vSkillText;

  //alert(vSkillText);
   }
 
</script>


</html>
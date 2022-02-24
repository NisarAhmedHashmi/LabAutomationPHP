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
       header('Cache-Control: no-store, no-cache, must-revalidate');
      include("header.php");
      include("links.php");
      require("Connection.php");
      include("HTMLHelperMethod.php");

      $conn=connection();
      
      if (isset($_POST["btnUpdate"]))

          {
      
            $varProductId=$_POST["txtProductId"];
            $varProduct=$_POST["txtProduct"];
           $varProductTypeId=$_POST["cmbProductType"];

            $result=update_row("Product",array("ProductName"=>"'$varProduct'","ProductTypeId"=>"'$varProductTypeId'"),"ProductId="."'".$varProductId."'");


                 if($result)
                  
                  {
                    
                    echo showMessage("Product updated..");
                    echo redirect("Product.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Product not updated...Please check...!') </script>";
                  }
          }


      elseif (isset($_POST["btnSave"]))
      { 
          $varProduct=$_POST["txtProduct"];
          $varProductTypeId=$_POST["cmbProductType"];

          //$max = mysqli_query($conn,"SELECT MAX(ProductCode)+1,MAX(ReviseCode)+1,MAX(ManufactureCode)+1 FROM Product");
           $max = mysqli_query($conn,"SELECT MAX(ProductCode)+1 FROM Product");
          $max_row = mysqli_fetch_row($max);

          if($max_row[0] != null)
          {
              $ProductCode = $max_row[0];
          }
          else{
              $ProductCode = 1;
          }

          

               if (strlen($ProductCode)==1) 
                  { $ProductCode="000".$ProductCode;
                  }

              else if (strlen($ProductCode)==2) 
                  { $ProductCode="00".$ProductCode;
                  }
              else if (strlen($ProductCode)==3) 
                  { $ProductCode="0".$ProductCode;
                  }
              else
                  {
                    $ProductCode=$ProductCode;
                  }

                   $ManufactureCode="001";
                   $ReviseCode="001"; 
                  echo $ProductId="001-001-".$ProductCode;
                 $result=add_row("Product",array("ProductId"=>"'$ProductId'","ProductName"=>"'$varProduct'","ProductTypeId"=>"'$varProductTypeId'","ReviseCode"=>"'$ReviseCode'","ManufactureCode"=>"'$ManufactureCode'","ProductCode"=>"'$ProductCode'"));


                  
                  if($result)
                  
                  {
                    
                    echo showMessage("Product created successfully..");
                    echo redirect("Product.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Record not saved') </script>";
                  }

      }

     elseif (isset($_GET["Find"]))
     {
          

          $result=fetch_Selected_Row_MT("Product","ProductType",Null,Null,array("ProductId"=>"'".$_GET["id"]."'"),"ProductTypeId",Null,Null);

          
    
    
         //mysqli_fetch_assoc by using this method data can only be fetchd using field name but not from index number
    
             //mysqli_fetch_array by using this method data can be fetchd using field name and index number both
             $row=mysqli_fetch_assoc($result);
             //$Type=$row["ProductTypeId"];
            // echo "<script>  alert ($Type) </script>";
             
     }
     
      elseif (isset($_POST["btnDelete"]))
      {
         $varProductId=$_POST["txtProductId"];


                  $result=delete_row("Product",array("ProductId"=>"'$varProductId'"));


                  
                  if($result)
                  
                  {
                    
                    echo showMessage("Product deleted..");
                    echo redirect("Product.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Record not deleted') </script>";
                  }

      }


    ?>

  <body>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

                <h2 > Product Setup</h2>
              </div>
                <form method="post" action="Product.php">
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
                              <input type="hidden" class="form-control" placeholder="Auto Id" name="txtProductId" id="txtProductId"   value=<?php  if (isset($_GET["id"]))  echo $row["ProductId"]; ?>  >
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Product Name</label>
                              <input type="text" class="form-control" placeholder="Enter Product" name="txtProduct" id="txtProduct"  value=<?php  if (isset($_GET["id"]))  echo $row["ProductName"]; ?>  >
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Product Type</label>
                                 <select name="cmbProductType" Id="cmbProductType" class="form-control">

                                  <?php if (isset($_GET["id"])) {
                                  ?>
                                    <option  style="background-color: #27293D" value="<?php echo $row["ProductTypeId"]; ?>">  <?php echo $row["ProductType"];?>  </option>

                                  <?php 
                                  }

                                  else
                                  {
                                   ?> 

                                    <option  style="background-color: #27293D">--Select--</option>


                                      <?php 
                                       }

                                           $conn=Connection();
                                          $query="Select * from ProductType";
                                          $PTresult=mysqli_query($conn,$query);

                                          while ($row=mysqli_fetch_assoc($PTresult))
                                      { ?>
                               `
                                         <option  style="background-color: #27293D" value="<?php echo $row['ProductTypeId'];?>"> <?php echo $row["ProductType"];?> </option>

                                      <?php
                                      }



                                      ?>
                                </select>
                             </div>
                          </div>
                        </div>
                      
                    
                  <div class="card-footer mx-auto" style="width: 600px;">
                     <button type="button" class="btn  btn-warning" name="btnCancel" onclick="clearFields()">New</button>
                    <?php
                      if (isset($_GET["Find"]))

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

                    <button type="submit" class="btn  btn-danger " name="btnDelete" >Delete</button>
                   
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
          <h4 class="modal-title">Product Search</h4>
           
        </div>
        <div class="modal-body">
      
               <center><input class="form-control" id="search" type="text" style="width: 80%; color:black" placeholder="Search.."></center><br>
       
                                      <div>
                                                <table class="table table-hover table-dark table-bordered" style="font-size: 16px;">
                                                    <thead >
                                                        <tr>
                                                            <th>Product Id</th>
                                                            <th>Product Name</th>
                                                             <th>Product Type</th>
                                                        </tr>   
                                                    </thead>
                                                    <tbody id="myTable">
                                                        <?php 


                                                           // $result=fetch_row("ProductType","");
                                                             $conn=Connection();
                                                             $query="Select b.ProductId,b.ProductName,a.ProductType,a.ProductTypeId from ProductType a, Product b Where a.ProductTypeId=b.ProductTypeId";
                                                                                                                                             
                                                                          
                                                            $result=mysqli_query($conn,$query);

                                                             $sno = mysqli_num_rows($result);
                                                           while($row=mysqli_fetch_array($result))
                                                            {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?php echo $row["ProductId"]; ?></td>
                                                            <td><?php echo $row["ProductName"]; ?></td>
                                                            <td><?php echo $row["ProductType"]; ?></td>
                                                            <!-- <td><?php //echo $row["p_address"]; ?></td> -->
                                                            <td>
                                                                <a name="SearchProductType" class="btn btn-info" title="Select" href="Product.php?Update&Find&id=<?php echo $row["ProductId"]; ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
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
      document.getElementById('txtProductId').value = "";
      document.getElementById('txtProduct').value = "";
       document.getElementById('cmbProductType').selectedIndex = 0;
       window.location.href='Product.php';
      // window.location.href="TestType.php";
       //load("TestType.php");
       //location.reload();
   }
   
</script>


</html>
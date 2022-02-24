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
      
             $varProductTypeId=$_POST["txtProductTypeId"];
             $varProductType=$_POST["txtProductType"];

              $result=update_row("ProductType",array("ProductType"=>"'$varProductType'"),"ProductTypeId=$varProductTypeId");


                 if($result)
                  
                  {
                    
                    echo showMessage("Product Type updated..");
                    echo redirect("ProductType.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Product Type not updated...Please check...!') </script>";
                  }
          }


      elseif (isset($_POST["btnSave"]))
      { 
         $varProductType=$_POST["txtProductType"];
                
                  $result=add_row("ProductType",array("ProductType"=>"'$varProductType'"));


                  
                  if($result)
                  
                  {
                    
                    echo showMessage("Product Type created successfully..");
                    echo redirect("ProductType.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Record not saved') </script>";
                  }

      }

     elseif (isset($_GET["Find"]))
     {
          $varFindProductTypeId=$_GET["id"];


          //$result=fetch_Selected_Row("ProductType",Null,array("ProductTypeId"=>$_GET["id"]));
          $result=fetch_Selected_Row_MT("ProductType",Null,Null,Null,array("ProductTypeId"=>$_GET["id"]),Null,Null,Null);

         
         //mysqli_fetch_assoc by using this method data can only be fetchd using field name but not from index number
    
             //mysqli_fetch_array by using this method data can be fetchd using field name and index number both
             $row=mysqli_fetch_assoc($result);
     }
     
      elseif (isset($_POST["btnDelete"]))
      {
         $varProductTypeId=$_POST["txtProductTypeId"];


                  $result=delete_row("ProductType",array("ProductTypeId"=>"'$varProductTypeId'"));


                  
                  if($result)
                  
                  {
                    
                    echo showMessage("Product Type deleted..");
                    echo redirect("ProductType.php");
                    
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

                <h2 > Product Type Setup</h2>
              </div>
                <form method="post" action="ProductType.php">
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
                              <input type="hidden" class="form-control" placeholder="Auto Id" name="txtProductTypeId" id="txtProductTypeId"   value=<?php  if (isset($_GET["id"]))  echo $row["ProductTypeId"]; ?>  >
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Product Type</label>
                              <input type="text" class="form-control" placeholder="Enter Product Type" name="txtProductType" id="txtProductType"  value=<?php  if (isset($_GET["id"]))  echo $row["ProductType"]; ?>  >
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
          <h4 class="modal-title">Product Type Search</h4>
           
        </div>
        <div class="modal-body">
      
               <center><input class="form-control" id="search" type="text" style="width: 80%; color:black" placeholder="Search.."></center><br>
       
                                      <div>
                                                <table class="table table-hover table-dark table-bordered" style="font-size: 16px;">
                                                    <thead >
                                                        <tr>
                                                            <th>Type Id</th>
                                                            <th>Type Name</th>
                                                        </tr>   
                                                    </thead>
                                                    <tbody id="myTable">
                                                        <?php 


                                                           // $result=fetch_row("ProductType","");
                                                             $conn=Connection();
                                                             $query="Select * from ProductType";
                                                                                                                                             
                                                                          
                                                            $result=mysqli_query($conn,$query);

                                                             $sno = mysqli_num_rows($result);
                                                           while($row=mysqli_fetch_array($result))
                                                            {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?php echo $row["ProductTypeId"]; ?></td>
                                                            <td><?php echo $row["ProductType"]; ?></td>
                                                            <!-- <td><?php //echo $row["p_address"]; ?></td> -->
                                                            <td>
                                                                <a name="SearchProductType" class="btn btn-info" title="Select" href="ProductType.php?Updatet&Find&id=<?php echo $row["ProductTypeId"]; ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
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
      document.getElementById('txtProductTypeId').value = "";
      document.getElementById('txtProductType').value = "";
      window.location.href='ProductType.php';
   }
   
</script>


</html>
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

         
        function unSetAll()
        {
          unset($_SESSION["TestCriteria"]);
            unset( $_SESSION["FindId"]);
          unset( $_SESSION["MasterData"]);

        }

  
         
      //session_destroy();
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
          $varTestName=$_POST["txtTestName"];
          $varTestTypeId=$_POST["cmbTestType"];

         

                 $result=add_Test_Record("TestMaster","TestDetail",array("TestName"=>"'$varTestName'","TestTypeId"=>"$varTestTypeId"),"TestId",$_SESSION["TestCriteria"]);

                  if($result)
                  
                  {
                    
                    echo showMessage("Test created successfully..");
                    unSetAll();
                    echo redirect("Test.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Record not saved') </script>";
                  }

      }

      elseif (isset($_POST["btnUpdate"]))

          {
      
           $row_Value='';
            $varTestId=$_POST["txtTestId"];
          $varTestName=$_POST["txtTestName"];
          $varTestTypeId=$_POST["cmbTestType"];
         $varTestTypeName = $_POST["txtTestTypeNameHolder"];

         //   $result=update_row("Product",array("ProductName"=>"'$varProduct'","ProductTypeId"=>"'$varProductTypeId'"),"ProductId="."'".$varProductId."'");

             $result=Update_Test_Record("TestMaster","TestDetail",array("TestName"=>"'$varTestName'","TestTypeId"=>"$varTestTypeId"),"TestId",$_SESSION["TestCriteria"],"TestId=$varTestId",$varTestId);


                 if($result)
                  
                  {
                    
                    echo showMessage("Test updated..");
                     unSetAll();
                    echo redirect("Test.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Test not updated...Please check...!') </script>";
                  }
          }


     
     elseif (isset($_GET["Find"]))
     { $_SESSION["FindId"]=$_GET["id"];
          // echo "<script>  alert (".$_GET["id"].") </script>";
          $result=fetch_Selected_Row_MT("TestMaster","TestDetail","TestType",Null,array("TestMaster.TestId"=>$_GET["id"]),"TestId","TestTypeId",Null);
    
         //mysqli_fetch_assoc by using this method data can only be fetchd using field name but not from index number
    
             //mysqli_fetch_array by using this method data can be fetchd using field name and index number both

            if ($result)
              
             { $SrNo=0;
              $_SESSION["TestCriteria"]=array();
              $_SESSION["MasterData"]=array();

              // $foundRow=mysqli_fetch_array($myResult);
             
               while ($row=mysqli_fetch_assoc($result))
               {
                 
                  array_push($_SESSION["TestCriteria"], array("SrNo"=>$SrNo,"TestId"=>$row["TestId"],"CriteriaId"=>$row["CriteriaId"],"Criteria"=>$row["Criteria"]));  
                  $SrNo=$SrNo+1;

                  array_push($_SESSION["MasterData"], array("TestId"=>$row["TestId"],"TestName"=>$row["TestName"],"TestTypeId"=>$row["TestTypeId"],"TestTypeName"=>$row["TestTypeName"])); 


               }

                

              

                  $result=fetch_Selected_Row_MT("TestMaster","TestDetail","TestType",Null,array("TestMaster.TestId"=>$_GET["id"]),"TestId","TestTypeId",Null);
                  $row=mysqli_fetch_array($result);
                
             }
            else
              {echo "<script>  alert ('Result doest not exist') </script>";
          
            }
            
             
     }
     
      elseif (isset($_POST["btnDelete"]))
      {
         $varTestId=$_POST["txtTestId"];


                  $result=delete_row_MT("TestMaster","TestDetail",array("TestId"=>"'$varTestId'"));

                  if($result)
                  
                  {
                    
                    echo showMessage("Test deleted..");
                    unSetAll();
                    echo redirect("Test.php");
                    
                }
                  
                  
                  else
                  {
                    echo "<script>  alert ('Record not deleted') </script>";
                  }

      }


      else if(isset($_POST["btnAdd"]))  
      {


        $varTestId = $_POST["txtTestId"];
        $varTestName = $_POST["txtTestName"];
         $varTestTypeId = $_POST["cmbTestType"];
          $varTestTypeName = $_POST["txtTestTypeNameHolder"];
        $varCriteriaId = $_POST["txtCriteriaId"];
        $varCriteria= $_POST["txtCriteria"];
       
        if(isset($_SESSION["TestCriteria"]))
        {
          $t_count = count($_SESSION["TestCriteria"]);
          array_push($_SESSION["TestCriteria"], array("SrNo"=>$t_count, "TestId"=>"","CriteriaId"=>"","Criteria"=>$varCriteria));    
        }
        else
        {
          $t_count=0;
          $_SESSION["TestCriteria"] = array(
            array("SrNo"=>$t_count, "TestId"=>"","CriteriaId"=>"","Criteria"=>$varCriteria)
          );
        }   


      if(isset($_SESSION["MasterData"]))
        {
         
          unset( $_SESSION["MasterData"]);

           $_SESSION["MasterData"] = array(
             array("TestId"=> "","TestName"=>"","TestTypeId"=>"","TestTypeName"=>"")
          );

          array_push($_SESSION["MasterData"], array("TestId"=> $varTestId,"TestName"=>$varTestName,"TestTypeId"=>$varTestTypeId,"TestTypeName"=>$varTestTypeName));    

          
             
           
        }
        else
        {
         
          $_SESSION["MasterData"] = array(
             array("TestId"=> $varTestId,"TestName"=>"'$varTestName'","TestTypeId"=>$varTestTypeId,"TestTypeName"=>$varTestTypeName)
          );

         
        
             
         //echo $value["TestId"]." ".$value["TestName"]." ".$value["TestTypeId"]." ".$value["TestTypeName"];

           

         }

      }
        

        else if(isset($_GET["Select"]))
        { 
          $id = $_GET["SrNo"];
          $varCriteriaId = $_GET["CriteriaId"];
          foreach($_SESSION["TestCriteria"] as $value)
          { 
           
           // if($value["id"] == $id)
            if($value["SrNo"] == $id)
            {

              if (!empty($varCriteriaId))
              {
                  $result=fetch_Selected_Row_MT("TestMaster","TestDetail","TestType",Null,array("TestMaster.TestId"=>$_SESSION["FindId"]),"TestId","TestTypeId",Null);
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
          $varCriteriaId = $_GET["CriteriaId"];
           

         foreach($_SESSION["TestCriteria"] as $value)
          { 
           
           // if($value["id"] == $id)
            if($value["SrNo"] == $id)
            {

                 

              unset($_SESSION["TestCriteria"][$id]);
               sort($_SESSION["TestCriteria"]);
                if (!empty($varCriteriaId))
                {
                  $result=fetch_Selected_Row_MT("TestMaster","TestDetail","TestType",Null,array("TestMaster.TestId"=>$_SESSION["FindId"]),"TestId","TestTypeId",Null);
                  $row=mysqli_fetch_array($result);

                 
                    $result=delete_row("TestDetail",array("CriteriaId"=>$varCriteriaId));
                }
                  
                  break;

                           
            }
          }
        

        }

        else if (isset($_POST["btnEditDetail"]))
        {
        
            $varTestId = $_POST["txtDetailTestId"];
            $varTestName = $_POST["txtTestName"];
           $varTestTypeId=$_POST["cmbTestType"];
           $varTestTypeName = $_POST["txtTestTypeNameHolder"];
            $varCriteriaId = $_POST["txtCriteriaId"];
             $varCriteria= $_POST["txtCriteria"];

        

             $id = $_POST["txtDetailSrNo"];


            foreach($_SESSION["TestCriteria"] as $value)
            { 
             
             // if($value["id"] == $id)
              if($value["SrNo"] == $id)
              {


                    
                    //$value["CriteriaId"]=$varCriteria;
                   
                 unset($_SESSION["TestCriteria"][$id]);
                  array_push($_SESSION["TestCriteria"], array("SrNo"=>count($_SESSION["TestCriteria"])+1,"TestId"=>$varTestId,"CriteriaId"=>$varCriteriaId,"Criteria"=>$varCriteria));   
              // sort($_SESSION["TestCriteria"]);
                 $result=fetch_Selected_Row_MT("TestMaster","TestDetail","TestType",Null,array("TestMaster.TestId"=>$_SESSION["FindId"]),"TestId","TestTypeId",Null);
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

                <h2 >Test Setup</h2>
              </div>
                <form method="post" action="Test.php">
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
                              $Testid=0;
                              $TestName="";

                                // if (isset($_GET["Remove"])|| isset($_GET["Select"]) ||isset($_GET["btnEditDetail"]))
                              if (isset($_GET["id"]) || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"])))
                                { 
                                 
                                  $Testid= $row["TestId"];
                                }
                              else if (isset($_POST["txtTestId"]) || isset($_POST["btnUpdate"])) 
                                {
                                   
                                    $Testid= $_POST["txtTestId"];
                                }
                              else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"])) 
                                {
                                   
                                   sort($_SESSION["MasterData"]);
                                    foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                       $Testid= $Mastervalue["TestId"];
                                      
                                    }
                                   
                                }
                              
                           ?>

                              <input type="hidden" class="form-control" placeholder="Auto Id" name="txtTestId" id="txtTestId"   value=<?php echo $Testid ?>  >
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Test Name</label>

                            <?php  
                              if (isset($_GET["id"]) || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"])))

                                {  
                                  
                                  $TestName= $row["TestName"];
                                }
                              else if (isset($_POST["btnAdd"]) || isset($_POST["btnUpdate"]) || isset($_POST["btnEditDetail"])) 
                                {  
                                   
                                    $TestName= $_POST["txtTestName"];
                                }

                            else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"])) 
                                {
                                   
                                    sort($_SESSION["MasterData"]);
                                    foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                       $TestName= $Mastervalue["TestName"];
                                        
                                    }
                                   
                                }
                           ?>


                              <input type="text" class="form-control" placeholder="Enter Test" name="txtTestName" id="txtTestName"  value=<?php echo "'".$TestName."'"; ?>  >
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Test Type</label>
                                 <select name="cmbTestType" Id="cmbTestType" class="form-control" class="input-xlarge"   onchange=" getText()">

                                  <?php if (isset($_GET["id"])  || (isset($_GET["SrNo"]) && isset($_SESSION["FindId"]) && isset($_SESSION["Remove"]))) {

                                      $varTestTypeName=$row["TestTypeName"];

                                     

                                  ?>
                                    <option  style="background-color: #27293D" value="<?php echo $row["TestTypeId"]; ?>">  <?php echo $row["TestTypeName"];?>  
                                  </option>

                                  <?php 
                                  }

                                  else if (isset($_POST["btnAdd"]) || isset($_POST["btnUpdate"]) || isset($_POST["btnEditDetail"]))
                                  {
                                    
                                  ?>

                           <option  style="background-color: #27293D" value="<?php echo $_POST["cmbTestType"]; ?>">  <?php echo $_POST["txtTestTypeNameHolder"]; ?>  
                                  </option>
                                <?php      
                                  }

                                  else if (isset($_GET["Select"]) || isset($_GET["Remove"]) || isset($_POST["btnSave"]))
                                  {
                                     
                                      sort($_SESSION["MasterData"]);

                                      foreach($_SESSION["MasterData"] as $Mastervalue)
                                     {        
                                       $TestTypeId= $Mastervalue["TestTypeId"];
                                       $varTestTypeName= $Mastervalue["TestTypeName"];
                                      
                                    }
                                  ?>

 <option  style="background-color: #27293D" value="<?php echo $TestTypeId; ?>">  <?php echo $varTestTypeName; ?>  
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
                                          $query="Select * from TestType";
                                          $PTresult=mysqli_query($conn,$query);

                                          while ($row=mysqli_fetch_assoc($PTresult))
                                      { ?>
                               `
                                         <option  style="background-color: #27293D" value="<?php echo $row['TestTypeId'];?>"> <?php echo $row["TestTypeName"]; ?> </option>

                                      <?php
                                      }



                                      ?>
                                </select>
                              
                                <?php 
                                  if (isset($_POST["btnAdd"]))
                                  { 
                                ?>
                                   <input type="hidden" class="form-control" placeholder="Test Holder" name="txtTestTypeNameHolder" id="txtTestTypeNameHolder"  value=<?php  echo "'".$_POST["txtTestTypeNameHolder"]."'"; ?>  >
                                <?php

                                  }

                                  else
                                { 
                                  ?>

                                 <input type="hidden" class="form-control" placeholder="Test Holder" name="txtTestTypeNameHolder" id="txtTestTypeNameHolder"  value=<?php if(!empty($varTestTypeName)) echo "'".$varTestTypeName."'" ;?> >
                                <?php
                                }
                                ?>
                             </div>
                          </div>
                        </div>
                      
         
                    <div class="form-group" >
                       <table class="table table-hover table-dark table-responsive"   style="font-size: 16px;" width="100%" border="0">
                           
                              <thead style="text-align: center;">
                                  <tr>
                                    <th style="visibility: hidden;">SrNo</th>
                                      <th style="visibility: hidden;">Test Id</th>
                                      <th style="visibility: hidden;">Criteria Id</th>
                                       <th>Criteria</th>
                                        <th>Remove</th>
                                          <th>Select</th>
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
                                            $DetailTestId="";
                                          if (isset( $_GET["Select"]))
                                          {

                                            
                                            $DetailTestId=$value["TestId"];
                                          }
                                          else
                                          {
                                             $DetailTestId="";
                                            

                                          }

                                      ?>

                                      <td>
                                        <input type="hidden" class="form-control" placeholder="Auto Test Id" name="txtDetailTestId" id="txtDetailTestId" value=<?php echo $DetailTestId ?>    >
                                      </td>

                                       <?php
                                            $DetailCriteriaId="";
                                          if (isset( $_GET["Select"]))
                                          {
                                          
                                            $DetailCriteriaId=$value["CriteriaId"];
                                          }
                                          else
                                          {
                                              $DetailCriteriaId="";
                                          }

                                      ?>
                                      <td>
                                        <input type="hidden" class="form-control" placeholder="Auto Criteria Id" name="txtCriteriaId" id="txtCriteriaId" value=<?php echo $DetailCriteriaId ?>  >
                                      </td>
                                       <?php
                                            $DetailCriteria="";
                                          if (isset( $_GET["Select"]))
                                          {
                                            
                                            $DetailCriteria="'".$value["Criteria"]."'";
                                          }

                                          else
                                          {
                                            $DetailCriteria="";
                                          }

                                      ?>
                                      <td>
                                         <input type="text" class="form-control" placeholder="Criteria" name="txtCriteria" id="txtCriteria" value=<?php echo $DetailCriteria ?>>
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
                                   <td style="visibility: hidden;"><?php echo $value["TestId"] ?></td>
                                    <td style="visibility: hidden;"><?php echo $value["CriteriaId"] ?></td>
                                    <td><?php echo $value["Criteria"] ?></td>

                                  

                                    <td><a href="Test.php?Remove&SrNo=<?php echo $value["SrNo"]?>&CriteriaId=<?php echo $value["CriteriaId"]?>" onClick="return confirm('Are You Sure to remove item')"><img src="../Images/Delete4.png" width="30px" height="30px" style="background-image:none!important";></a>
                                    </td>
                                    <td>

                                      <a href="Test.php?Select&SrNo=<?php echo $value["SrNo"]?>&CriteriaId=<?php echo $value["CriteriaId"]?>" ><img src="../Images/Select1.jpg" width="30px" height="30px"></a></td>
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
          <h4 class="modal-title">Test Search</h4>
           
        </div>
        <div class="modal-body">
      
               <center><input class="form-control" id="search" type="text" style="width: 80%; color:black" placeholder="Search.."></center><br>
       
                                      <div>
                                                <table class="table table-hover table-dark table-bordered" style="font-size: 16px;">
                                                    <thead >
                                                        <tr>
                                                            <th>Test Id</th>
                                                            <th>Test Name</th>
                                                             <th>Test Type</th>
                                                        </tr>   
                                                    </thead>
                                                    <tbody id="myTable">
                                                        <?php 


                                                           // $result=fetch_row("ProductType","");
                                                             $conn=Connection();
                                                             $query="Select b.TestId,b.TestName,a.TestTypeName from TestType a, TestMaster b Where a.TestTypeId=b.TestTypeId order by b.TestId";
                                                                                                                                             
                                                                          
                                                            $result=mysqli_query($conn,$query);

                                                             $sno = mysqli_num_rows($result);
                                                           while($row=mysqli_fetch_array($result))
                                                            {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?php echo $row["TestId"]; ?></td>
                                                            <td><?php echo $row["TestName"]; ?></td>
                                                            <td><?php echo $row["TestTypeName"]; ?></td>
                                                            <!-- <td><?php //echo $row["p_address"]; ?></td> -->
                                                            <td>
                                                                <a name="SearchProductType" class="btn btn-info" style="background-color: #3399ff;" title="Select" href="Test.php?Find&id=<?php echo $row["TestId"]; ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
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
      document.getElementById('txtTestId').value = "";
      document.getElementById('txtTestName').value = "";
       document.getElementById('cmbTestType').selectedIndex = 0;
       window.location.href="Test.php";
      // window.location.href="TestType.php";
       //load("TestType.php");
       //location.reload();
   }

   function getText(){
    var vSkill = document.getElementById('cmbTestType');

     var vSkillText = vSkill.options[vSkill.selectedIndex].innerHTML;
    document.getElementById('txtTestTypeNameHolder').value=vSkillText;

  //alert(vSkillText);
   }
   
 
</script>


</html>
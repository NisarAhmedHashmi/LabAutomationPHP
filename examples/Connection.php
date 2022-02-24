<?php


	function connection()
	{
		$host="localhost";
		$userName="root";
		$password="";
		$dataBase="eLab";
		
		$conn=mysqli_connect($host,$userName,$password,$dataBase);
		return $conn;
	}
	
	function closeConnetion()
	{
		  $conn -> close();
		
	}
	
	function update_row($table_Name,$update_Array,$condition)
	{ 	$conn=connection();
		 $update_Value="";
		 
		 foreach ($update_Array as $key => $value)
		 {
			 $update_Value=$update_Value." $key = $value, ";

			 
		 }
		  $update_Value=rtrim($update_Value,", ");
		$query="Update $table_Name Set $update_Value Where $condition";
		 $result=mysqli_query($conn,$query);
		 return $result;

	
	}
	
/*	function fetch_row($tableName)
	{
		$conn=connection();
		$query="Select * from $tableName";
		$result=mysqli_query($conn,$query);
		return $result;
	}
	
	*/
	function fetch_row($tableNameA,$tableNameB)
	{
		$conn=connection();
		
		if (isset($tableNameA) && isset($tableNameB))
		{
				 $query="Select $tableNameB.ComplaintId, $tableNameA.FirstName,$tableNameA.Designation, $tableNameB.IPAddress, $tableNameB.EntryDate, $tableNameB.Complain , $tableNameB.Comment from $tableNameA,$tableNameB Where $tableNameA.UserId=$tableNameB.UserId ";
		}
		
		else
		{
				  $query="Select * from $tableNameA ";
		}
		
		
	   $result=mysqli_query($conn,$query);
		return $result;
	}
	
	
	
	function fetch_Selected_Row($tableNameA,$tableNameB, $Condition_array)
	{
		$conn=connection();
		$condition="";
		foreach($Condition_array as $key => $value)
		{
//			$condition .= " and ".$key. "=".$value; 
			$condition .= $key. "=".$value; 
			
		}
//		echo $query="Select * from $tableName Where 1=1 $condition";

		if (isset($tableNameA) && isset($tableNameB))

		{
			 $query="Select $tableNameA.*,$tableNameB.* from $tableNameA,$tableNameB Where $condition";
			
		}
		else
		{
			 $query="Select * from $tableNameA Where $condition";
		}
	  	


	
		$result=mysqli_query($conn,$query);

		return $result;
		
	}


	function fetch_Selected_Row_MT($tableNameA,$tableNameB,$tableNameC,$tableNameD, $Condition_array,$compareField1,$compareField2,$compareField3)
	{
		$conn=connection();
		$condition="";
		foreach($Condition_array as $key => $value)
		{
//			$condition .= " and ".$key. "=".$value; 
			$condition .= $key. "=".$value; 
			
		}

		
//		echo $query="Select * from $tableName Where 1=1 $condition";

		if (isset($tableNameA) && isset($tableNameB)  && isset($tableNameC) && isset($tableNameD))

		{
			

			$condition.=" and ".$tableNameA.".".$compareField1." = ".$tableNameB.".".$compareField1." and ".$tableNameA.".".$compareField2." = ".$tableNameC.".".$compareField2." and ".$tableNameB.".".$compareField3." = ".$tableNameD.".".$compareField3;

			  $query="Select $tableNameA.*,$tableNameB.*,$tableNameC.*,$tableNameD.* from $tableNameA,$tableNameB,$tableNameC ,$tableNameD Where $condition";

			 		
			
		}

		else if (isset($tableNameA) && isset($tableNameB)  && isset($tableNameC))

		{
			

			$condition.=" and ".$tableNameA.".".$compareField1." = ".$tableNameB.".".$compareField1." and ".$tableNameA.".".$compareField2." = ".$tableNameC.".".$compareField2;
			  $query="Select $tableNameA.*,$tableNameB.*,$tableNameC.* from $tableNameA,$tableNameB,$tableNameC Where $condition";
			
		}

		else if (isset($tableNameA) && isset($tableNameB))

		{
			
			$condition.=" and ".$tableNameA.".".$compareField1." = ".$tableNameB.".".$compareField1;
			  $query="Select $tableNameA.*,$tableNameB.* from $tableNameA,$tableNameB Where $condition";
		}


		else
		{
			$query="Select * from $tableNameA Where $condition";
		}
	  	

		//echo $query;
	
		$result=mysqli_query($conn,$query);

		return $result;
		
	}



	
	function add_row ($table_Name,$row_Array)
	{ $conn=connection();
		$query="";
		$col_Name="";
		$row_Value="";
		foreach ($row_Array as $key=>$value)
		{
			$col_Name.=$key.",";
			$row_Value.=$value.",";
		}
		
		$col_Name=rtrim($col_Name,",");
		$row_Value=rtrim($row_Value,",");
		echo $query="Insert into $table_Name($col_Name) values($row_Value)";
		$result=mysqli_query($conn,$query);
		return $result;
		
	
	}
	
	
	function delete_row($table_Name,$condition_Array)
	{ $conn=connection();
		$condition="";
		foreach ($condition_Array as $key=>$value)
		{
			$condition= $condition." $key = $value and";
		}
		$condition=rtrim($condition,"and");
		 echo $query="Delete from $table_Name Where $condition"	;
		$result=mysqli_query($conn,$query);
		return $result;
		}
		

	function delete_row_MT($table_NameA,$table_NameB,$condition_Array)
	{ $conn=connection();
		$condition="";
		foreach ($condition_Array as $key=>$value)
		{
			$condition= $condition." $key = $value and";
		}
		$condition=rtrim($condition,"and");
		 $query="Delete from $table_NameB Where $condition;"	;
		 $query.="Delete from $table_NameA Where $condition;"	;

		 //echo $query;
		$result=mysqli_multi_query($conn,$query);
		return $result;
		}
		

		
		function add_Test_Record($table_Name,$detailTable,$row_Array,$PrimaryKey,$sessionVariable)
		{ 
			$conn=connection();
			$query="";
			$col_Name="";
			$row_Value="";

			//Generating Max id
			$query="Select Max($PrimaryKey)+1 from $table_Name";
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_array($result);

			 if (!empty($row[0]) ){
	            $varMaxId = $row[0];
	            echo "Max value found";
	        } 
	 		else if (isset($row[0]) ){
	            $varMaxId = $row[0];
	            echo "Max value is set";
	        }
	        else {
	            $varMaxId = 1;
	            echo "Max value not found";
	        }


			foreach ($row_Array as $key=>$value)
			{
				$col_Name.=$key.",";
				$row_Value.=$value.",";
			}
			// Adding Primary key and value in query
			$col_Name.=$PrimaryKey;
			$row_Value.=$varMaxId;

			$col_Name=rtrim($col_Name,",");
			$row_Value=rtrim($row_Value,",");

			 $query="Insert into $table_Name($col_Name) values($row_Value);";
			$row_Value='';
			


 						foreach($sessionVariable as $value)
 								
                                  { //$query.="Insert into $detailTable(TestId,Criteria) values($varMaxId,$value['Criteria'])";
                              		 $query.="Insert into $detailTable(TestId,Criteria) values($varMaxId,"."'".$value['Criteria']."'".");";
                                                              
                                  }

                                 
                                $result=mysqli_multi_query($conn,$query);
								return $result;			


		}		


	
		
		
		function Update_Test_Record($table_Name,$detailTable,$row_Array,$PrimaryKey,$sessionVariable,$condition,$PrimaryKeyValue)
		{ 
			$conn=connection();
			$query="";
			$col_Name="";
			$row_Value="";
			//************************************************

		$update_Value="";
		 
		 foreach ($row_Array as $key => $value)
		 {
			 $update_Value=$update_Value." $key = $value, ";

			 
		 }
		  $update_Value=rtrim($update_Value,", ");
		$query="Update $table_Name Set $update_Value Where $condition;";

		$row_Value='';
		foreach($sessionVariable as $value)
 								
             { 
             	if (!empty($value["CriteriaId"]))

             	{//$query.="Insert into $detailTable(TestId,Criteria) values($varMaxId,$value['Criteria'])";
                	$query.="Update  $detailTable Set Criteria="."'".$value['Criteria']."' Where CriteriaId=".$value['CriteriaId'].";";
                }
                else
                {
					$query.="Insert into $detailTable(TestId,Criteria) values(".$PrimaryKeyValue.","."'".$value['Criteria']."'".");";
                }
                                                              
              }

          echo $query;
		 $result=mysqli_multi_query($conn,$query);
		 return $result;

			//************************************************
					
			
		}


	function add_Booking_Record($table_Name,$detailTable,$row_Array,$PrimaryKey,$sessionVariable)
		{ 
			$conn=connection();
			$query="";
			$col_Name="";
			$row_Value="";

			//Generating Max id
			$query="Select Max($PrimaryKey)+1 from $table_Name";
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_array($result);

			 if (!empty($row[0]) ){
	            $varMaxId = $row[0];
	           // echo "Max value found";
	        } 
	 		else if (isset($row[0]) ){
	            $varMaxId = $row[0];
	            //echo "Max value is set";
	        }
	        else {
	            $varMaxId = 1;
	            //echo "Max value not found";
	        }

			$col_Name.=$PrimaryKey.",";
			$row_Value.=$varMaxId.",";
			foreach ($row_Array as $key=>$value)
			{
				$col_Name.=$key.",";
				$row_Value.=$value.",";
			}
			// Adding Primary key and value in query
			

			$col_Name=rtrim($col_Name,",");
			$row_Value=rtrim($row_Value,",");

			 $query="Insert into $table_Name($col_Name) values($row_Value);";
		//	$row_Value='';
			


 						foreach($sessionVariable as $value)
 								
                                  { //$query.="Insert into $detailTable(TestId,Criteria) values($varMaxId,$value['Criteria'])";
                              		 $query.="Insert into $detailTable(BookingId,TestId) values($varMaxId,".$value['TestId'].");";
                                                              
                                  }

                                echo $query;
                                $result=mysqli_multi_query($conn,$query);
								return $result;			


		}		


function Update_Booking_Record($table_Name,$detailTable,$row_Array,$PrimaryKey,$sessionVariable,$condition,$PrimaryKeyValue)
		{ 
			$conn=connection();
			$query="";
			$col_Name="";
			$row_Value="";
			//************************************************

		$update_Value="";
		 
		 foreach ($row_Array as $key => $value)
		 {
			 $update_Value=$update_Value." $key = $value, ";

			 
		 }
		  $update_Value=rtrim($update_Value,", ");
		$query="Update $table_Name Set $update_Value Where $condition;";

		$row_Value='';
		foreach($sessionVariable as $value)
 								
             { 
             	if (!empty($value["BookingDetailId"]))

             	{//$query.="Insert into $detailTable(TestId,Criteria) values($varMaxId,$value['Criteria'])";
                	$query.="Update  $detailTable Set TestId=".$value['TestId']." Where BookingDetailId=".$value['BookingDetailId'].";";
                }
                else
                {
					$query.="Insert into $detailTable (TestId,BookingId) values(".$value['TestId'].",".$PrimaryKeyValue.");";
                }
                                                              
              }

          echo $query;
		 $result=mysqli_multi_query($conn,$query);
			 return $result;

			//************************************************
					
			
		}
	
?>
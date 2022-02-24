<?php



	function lineBreak($number)
	{
		$data = "";
		for ($count=0; $count<$number;$count++)
		{
			$data.="<br/>";
		}
		return $data;
		
	}
	
	function setHeading($number,$data)
	{
			return "<h$number>$data</h$number>";

		
	}
	
	function showMessage($message)
	{
		return "<script>alert('$message')</script>";

	}
	
	function redirect($pageName)
	{
		return "<script>location.href='$pageName'</script>";
	}

	function createObject ($array)
	{
		$designObject="";
		foreach($array as $key=>$value)
		{
					$designObject=$designObject.$key."=".'"'.$value.'"';
			

		}
					return "<input $designObject/>" ;
	}

	


	
?>
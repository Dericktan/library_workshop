<?php
    include 'config.php';

    function getAllFaculty()
    {
		global $con;
		
		$sql = "SELECT * FROM tb_faculty";
		
		$query = $con->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$con->close();
    }
?>
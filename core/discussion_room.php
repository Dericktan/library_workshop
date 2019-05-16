<?php
    include 'config.php';

    function getAllDiscussionRoom()
    {
		global $con;
		
		$sql = "SELECT * FROM tb_roomdiscussion WHERE available=1";
		
		$query = $con->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$con->close();
    }

    function getTotalAvailableRoom()
    {
        global $con;
		
		$sql = "SELECT count(id) as total FROM tb_roomdiscussion WHERE available=1";
		
		$query = $con->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
            $result = $query->fetch_assoc();
            return $result['total'];
		} else {
			return false;
		}

		$con->close();
    }

    if(isset($_POST['addBooking'])){
        global $con;
        $user_id = $_POST['user_id'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $room_id = $_POST['room_id'];

        $sql = "INSERT INTO tb_booking_room (user_id, date, start_time, end_time, room_id, approved) VALUES ('$user_id','$date', '$start_time', '$end_time', '$room_id', FALSE)";
        
        $exec = mysqli_query($con,$sql);
        if($exec == TRUE){
            
            $update = "UPDATE tb_roomdiscussion set available=FALSE where id='$room_id'";
            $sql = mysqli_query($con,$update);

            echo "<script> alert('Your booking has been submitted');</script>";
            $url = "/pages/web/index.php?page=DiscussionRoom";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
        }
    }
?>

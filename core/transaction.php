<?php
    include 'config.php';
    function getBookBookingRequest($id)
    {
        global $con;
        $select = "SELECT tb_booking_book.created_at, tb_lecturer.lecturer_no as user_no, tb_lecturer.name as user_name, tb_booking_book.id from tb_booking_book
        INNER JOIN tb_users on tb_users.id = tb_booking_book.user_id
        INNER JOIN tb_lecturer on tb_lecturer.lecturer_no = tb_users.username
        UNION ALL
        SELECT  tb_booking_book.created_at, tb_student.student_no as user_no, tb_student.name as user_name, tb_booking_book.id from tb_booking_book
        INNER JOIN tb_users on tb_users.id = tb_booking_book.user_id
        INNER JOIN tb_student on tb_student.student_no = tb_users.username
        WHERE tb_booking_book.id ='$id'";
        $check = mysqli_query($con,$select);
        if($check->num_rows >0){
            return $check->fetch_assoc();
        }
        return false;
    }

    function getAllBooks($id)
    {
        global $con;
        $select = "SELECT tb_book.title from tb_booking_book_details
        INNER JOIN tb_book on tb_book.id = tb_booking_book_details.book_id
        WHERE tb_booking_book_details.booking_book_id ='$id'";
        $check = mysqli_query($con,$select);
        if($check->num_rows >0){
            return $check->fetch_assoc();
        }
        return false;
    }

    if(isset($_POST['approveBook']))
    {
        global $con;
        $id = $_POST['booking_id'];
        $created_at = $_POST['created_at']; 
        $length_of_booking= $_POST['length_of_booking'];

		$getReturnDate = "SELECT date_add(tb_booking_book.created_at, interval 5 day) as return_date from tb_booking_book where tb_booking_book.id='$id';";
		$execute = mysqli_query($con, $getReturnDate);
		$result = mysqli_fetch_array($execute);
		date_default_timezone_set('Asia/Kuala_Lumpur');
        $date_clicked= date('Y-m-d H:i:s') ;
		$query ="UPDATE tb_booking_book set start_date='$date_clicked', length_of_booking='$length_of_booking', return_date='$result[0]', returned=FALSE, approved='1' where tb_booking_book.id='$id'";
		$sql = mysqli_query($con,$query);
		if($sql)
		{
			echo "<script> alert('Successfully Approved');</script>";
			$url = "/pages/admin/index.php?page=BookBooking";
			$link = $baseUrl . $url;
			echo '<script> window.location.replace("'. $link .'");</script>';
			return true;
		}
		else
		{
			echo "<script> alert('Fail to Approved');</script>";
			$url = "/pages/admin/index.php?page=BookBooking";
			$link = $baseUrl . $url;
			echo '<script> window.location.replace("'. $link .'");</script>';
			return false;
		}
	}
	
	if(isset($_POST['declineBookRequest']))
	{
		global $con;
        $id = $_POST['id'];
        $sql = "UPDATE tb_booking_book set approved='2' where id='$id'";
        $query = mysqli_query($con,$sql);
        if($query == TRUE){	
            echo "<script> alert('Successfully Decline the Booking');</script>";
            $url = "/pages/admin/index.php?page=BookBooking";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to Decline the Booking');</script>";
            $url = "/pages/admin/index.php?page=BookBooking";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
	}

	if(isset($_POST['approveRoom']))
    {
        global $con;
		$id = $_POST['id'];
		
		$sql = "UPDATE tb_booking_room set approved='1' where id='$id'";

		$query = mysqli_query($con,$sql);
        if($query == TRUE){	
            echo "<script> alert('Successfully Approved the Booking');</script>";
            $url = "/pages/admin/index.php?page=RoomBooking";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to Approved the Booking');</script>";
            $url = "/pages/admin/index.php?page=RoomBooking";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
	}

	if(isset($_POST['declineRoom']))
    {
        global $con;
		$id = $_POST['id'];
		
		$sql = "UPDATE tb_booking_room set approved='3' where id='$id'";

		$query = mysqli_query($con,$sql);
        if($query == TRUE){	
            echo "<script> alert('Successfully Decline the Booking');</script>";
            $url = "/pages/admin/index.php?page=RoomBooking";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to Decline the Booking');</script>";
            $url = "/pages/admin/index.php?page=RoomBooking";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
	}

?>
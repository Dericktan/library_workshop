<?php
    include 'config.php';
    function getBookBookingRequest($id)
    {
        global $con;
        $select = "SELECT tb_booking_book.created_at, tb_lecturer.lecturer_no as user_no, tb_lecturer.name as user_name, tb_booking_book.id from tb_booking_book
        INNER JOIN tb_users on tb_users.id = tb_booking_book.user_id
        INNER JOIN tb_lecturer on tb_lecturer.lecturer_no = tb_users.username
        WHERE tb_booking_book.id ='$id'
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
            $select = "SELECT book_id from tb_booking_book_details where booking_book_id='$id'";
            $exec = mysqli_query($con,$select);
            
            while($tampung = mysqli_fetch_array($exec))
            {
                $book_id = $tampung['book_id'];
                $updatebook = "UPDATE tb_book set available=TRUE where id='$book_id'";
                $exec2 = mysqli_query($con,$updatebook);
            }
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
        $sql = "UPDATE tb_booking_room set approved='2' where id='$id'";
		$query = mysqli_query($con,$sql);
        if($query == TRUE){	
            $select = "SELECT tb_booking_room.room_id from tb_booking_room where id='$id'";
            $exec = mysqli_query($con,$select);

            $tampung = mysqli_fetch_array($exec);
            $room_id = $tampung[0];

            $updateroom = "UPDATE tb_roomdiscussion set available = true where room_id='$room_id'";
            $exec = mysqli_query($con,$updateroom);

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

	if(isset($_POST['returnBook']))
    {
		global $con;
		date_default_timezone_set('Asia/Kuala_Lumpur');
        $date_clicked= date('Y-m-d H:i:s') ;

		$id = $_POST['id'];
		$select = "SELECT return_date from tb_booking_book where id='$id'";
		$execute = mysqli_query($con,$select);
		$date_return = mysqli_fetch_row($execute)[0];
		$date_return = date($date_return);
		if($date_clicked > $date_return)
		{
			$late = true;
			$today = date_create($date_clicked);
			$date_to_return = date_create($date_return);
			$diff = date_diff($today,$date_to_return);
			$diff->format("%R%a");
			$fine = 0.5 * $diff;
		}
		else{
			$diff = NULL;
			$fine = NULL;
			$late = false;
			$latedays = 0;
		}

		$sql = "UPDATE tb_booking_book set returned=TRUE, late='$diff', fine='$fine' where id='$id'";

		$query = mysqli_query($con,$sql);
        if($query == TRUE){
            $selectBookId="SELECT tb_book.id FROM tb_book
            INNER JOIN tb_booking_book_details on tb_booking_book_details.book_id = tb_book.id
            where tb_booking_book_details.booking_book_id = '1'";
            $sql2 = mysqli_query($con,$selectBookId);

            while($data=mysqli_fetch_array($sql2))
            {
                $book_id = $data['id'];
                $update = "UPDATE tb_book set available=TRUE where id='$book_id'";
                $execute = mysqli_query($con,$update);
            }

            echo "<script> alert('Successfully Updated the Booking');</script>";
            $url = "/pages/admin/index.php?page=BorrowedBook";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to Update the Booking');</script>";
            $url = "/pages/admin/index.php?page=BorrowedBook";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
	}

	if(isset($_POST['returnRoomKey']))
    {
        global $con;
        $id = $_POST['id'];
        $room_id = $_POST['room_id'];
        $query = "UPDATE tb_booking_room set approved='3' where tb_booking_room.id='$id'";
		$sql = mysqli_query($con,$query);
        if($query == TRUE){	
            $room = "UPDATE tb_roomdiscussion set available=TRUE where tb_roomdiscussion.id='$room_id'";
            echo "<script> alert('Successfully Update the Data');</script>";
            $url = "/pages/admin/index.php?page=BorrowedRoom";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to Update the Data');</script>";
            $url = "/pages/admin/index.php?page=BorrowedRoom";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
	}
?>
<?php
    include '../../core/config.php';
    include '../../core/transaction.php';
    $user_id = $_SESSION['id'];    
?>
<div class="align-center">
	<h1 class="title">My Book Booking List</h1>
</div>
<div class="wide-container">
	<table style="background-color: white;">
		<thead>
			<tr>
                <th>No</th>
				<th>List of Book</th>
				<th>Date of Request</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
        <?php 
        $list = "SELECT tb_booking_book.id, tb_booking_book.created_at from tb_booking_book where user_id='$user_id' and tb_booking_book.approved=0";
        $exec = mysqli_query($con,$list);
        $i =0;
        if(isset($exec) && $exec->num_rows > 0)
        {
            while($result = mysqli_fetch_assoc($exec))
            {
                $i++;
                $date = $result['created_at'];
                $book_booking_id = $result['id'];
        ?>
            <tr>
                <td> <?php echo $i;?></td>
                <td>
                <ul>
                    <?php
                        $book = "SELECT tb_book.title from tb_booking_book_details
                        INNER JOIN tb_book on tb_book.id = tb_booking_book_details.book_id
                        INNER JOIN tb_booking_book on tb_booking_book.id = tb_booking_book_details.booking_book_id
                        WHERE tb_booking_book.id ='$book_booking_id' AND tb_booking_book.approved=0";
                        $query = mysqli_query($con,$book);
                        
                        if(isset($query) && $query->num_rows > 0)
                        {
                            while($data = mysqli_fetch_array($query))
                            {
                                $title = $data['title'];
                                ?>
                                <li>
                                    <?php echo $title;?>
                                </li>
                    <?php } } ?>
                    </ul>
                </td>
                <td>
                    <?php echo $date;?>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $book_booking_id;?>">
                        <input class="btn btn-primary" type="submit" name="UserdeclineBookRequest" Value="Decline">
                    </form>
                </td>
            </tr>
        <?php
            }
        }
        ?>
		</tbody>
	</table>
</div>


<div class="align-center">
	<h1 class="title">My Room Booking List</h1>
</div>
<div class="wide-container">
	<table style="background-color: white;">
		<thead>
			<tr>
                <th>No</th>
				<th>Room </th>
				<th>Date of Request</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
        <?php 
        $room = "SELECT tb_booking_room.*, concat(tb_roomdiscussion.room_no,' - ', tb_roomdiscussion.room_type) as room  from tb_booking_room
        INNER JOIN tb_roomdiscussion on tb_roomdiscussion.id =  tb_booking_room.room_id
        where user_id='$user_id' and tb_booking_room.approved=0";
        $exec = mysqli_query($con,$room);
        $i =0;
        if(isset($exec) && $exec->num_rows > 0)
        {
            while($resultt = mysqli_fetch_assoc($exec))
            {
                $i++;
                $date = $resultt['created_at'];
                $room = $resultt['room'];
                $room_booking_id = $resultt['id'];
        ?>
            <tr>
                <td> <?php echo $i;?></td>
                <td> <?php echo $room;?></td>
                <td> <?php echo $date;?>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $room_booking_id;?>">
                        <input class="btn btn-primary" type="submit" name="UserdeclineRoom" Value="Decline">
                    </form>
                </td>
            </tr>
        <?php
            }
        }
        ?>
		</tbody>
	</table>
</div>
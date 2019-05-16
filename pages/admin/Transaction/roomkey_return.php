<?php
    include '../../core/config.php';
?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Room</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    <?php
     $query ="SELECT tb_roomdiscussion.id as room_id, tb_lecturer.lecturer_no as user_no, tb_lecturer.name as user_name,tb_booking_room.start_time, tb_booking_room.end_time, tb_booking_room.id, tb_roomdiscussion.room_no, tb_roomdiscussion.room_type from tb_booking_room
     INNER JOIN tb_users on tb_users.id = tb_booking_room.user_id
     INNER JOIN tb_lecturer on tb_lecturer.lecturer_no = tb_users.username
     INNER JOIN tb_roomdiscussion on tb_roomdiscussion.id = tb_booking_room.room_id
	 WHERE tb_booking_room.approved ='1'
     UNION ALL
     SELECT tb_roomdiscussion.id as room_id, tb_student.student_no as user_no, tb_student.name as user_name,tb_booking_room.start_time, tb_booking_room.end_time, tb_booking_room.id, tb_roomdiscussion.room_no, tb_roomdiscussion.room_type from tb_booking_room
     INNER JOIN tb_users on tb_users.id = tb_booking_room.user_id
	 INNER JOIN tb_student on tb_student.student_no = tb_users.username
     INNER JOIN tb_roomdiscussion on tb_roomdiscussion.id = tb_booking_room.room_id
     WHERE tb_booking_room.approved ='1'";
     $sql = mysqli_query($con, $query);
     
     if(mysqli_num_rows($sql)==0)
        {
            echo "<tr> <td colspan='6'> <center>Sorry! There is no data in the database now.</center> </td> </tr>";
        }
        else
        {
            $i=0;
            while($data = mysqli_fetch_array($sql))
            {
                $i++;
                $user_no = $data['user_no'];
                $user_name = $data['user_name'];
                $room_no = $data['room_no'];
                $room_type = $data['room_type'];
                $start = $data['start_time'];
                $end = $data['end_time'];
                $room_booking_id = $data['id'];
                $room_id = $data['room_id'];
    ?>
        <tr>
        <tr>
            <td> <?php echo $i;?></td>
            <td> <?php echo $user_no." - ".$user_name;?></td>
			<td> <?php echo $room_no."- ".$room_type;?></td>
            <td> <?php echo $start." - ".$end;?></td>
            <td> <?php echo $room_no." - ".$room_type;?></td>
            <td> 
            <form action="../../core/transaction.php" method="post">
                <input type="hidden" name="room_id" value="<?php echo $room_id;?>">
                <input type="hidden" name="id" value="<?php echo $room_booking_id;?>">
                <input class="btn btn-primary" type="submit" name="returnRoomKey" Value="Key Returned">
            </form>
            </td>
        </tr>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
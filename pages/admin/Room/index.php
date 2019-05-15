<?php
    include '../../core/config.php';
?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Room No</th>
            <th>Room Type</th>
            <th>Available</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    <?php
     $query ="SELECT * FROM tb_roomdiscussion";
     $sql = mysqli_query($con, $query);
     
     if(mysqli_num_rows($sql)==0)
        {
            echo "<tr> <td colspan='5'> <center>Sorry! There is no data in the database now.</center> </td> </tr>";
        }
        else
        {
            $i=0;
            while($data = mysqli_fetch_array($sql))
            {
                $i++;
                $id = $data['id'];
                $room_no = $data['room_no'];
                $room_type = $data['room_type'];
                $available = $data['available'];
    ?>
        <tr>
            <td> <?php echo $i;?></td>
            <td> <?php echo $room_no;?></td>
            <td> <?php echo $room_type?></td>
            <td> <?php if($available==TRUE){echo "Yes";}else{echo "No";};?></td>
            <td> <a class="btn btn-primary" href="index.php?page=RoomForm&id=<?php echo $id;?>">Edit</a></td>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
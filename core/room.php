<?php
    include'config.php';
    function checkRoomNo()
    {
        global $con;
        $room_no = $_POST['room_no'];
        $select = "SELECT * FROM tb_roomdiscussion where room_no='$room_no'";
        $check = mysqli_query($con,$select);
        if($check->num_rows > 0){
            return false;
        }
        return true;
    }

    function getRoom($id)
    {
        global $con;
        $select = "SELECT * FROM tb_roomdiscussion where id ='$id'";
        $check = mysqli_query($con,$select);
        if($check->num_rows >0){
            return $check->fetch_assoc();
        }
        return false;
    }
    
    if(isset($_POST['addRoom'])){
        global $con;
        $room_no = $_POST['room_no'];
        $room_type = $_POST['room_type'];
        $sql = "INSERT INTO tb_roomdiscussion (room_no,room_type,available) VALUES ('$room_no','$room_type',TRUE)";
        if(checkRoomNo() == TRUE)
        {
            $exec = mysqli_query($con,$sql);
            if($exec == TRUE){
                echo "<script> alert('Successfully Added a new Room');</script>";
                $url = "/pages/admin/index.php?page=RoomList";
                $link = $baseUrl . $url;
                echo '<script> window.location.replace("'. $link .'");</script>';
                return true;
            }
            else{
                echo "<script> alert('Duplicate Room No Detected');</script>";
                $url = "/pages/admin/index.php?page=RoomForm";
                $link = $baseUrl . $url;
                echo '<script> window.location.replace("'. $link .'");</script>';
                return false;
            }    
        }
        else
        {
            echo "<script> alert('Duplicate Room No Detected');</script>";
            $url = "/pages/admin/index.php?page=RoomForm";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
    }

    if(isset($_POST['updateRoom'])){
        global $con;
        $id = $_POST['id'];
        $room_type = $_POST['room_type'];
        $sql = "UPDATE tb_roomdiscussion set room_type='$room_type' where id='$id'";
        $query = mysqli_query($con,$sql);
        if($query == TRUE){
            echo "<script> alert('Successfully Updated the Room');</script>";
            $url = "/pages/admin/index.php?page=RoomList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to update the Room');</script>";
            $url = "/pages/admin/index.php?page=RoomList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
    }
?>
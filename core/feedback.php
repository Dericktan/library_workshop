<?php
    include'config.php';
    
    if(isset($_POST['addFeedback'])){
        global $con;
        $user_id = $_POST['user_id'];
        $content = $_POST['content'];
        $sql = "INSERT INTO tb_feedback (user_id, content) VALUES ('$user_id','$content')";
        $exec = mysqli_query($con,$sql);
        if($exec == TRUE){
            echo "<script> alert('Your feedback has been submitted');</script>";
            $url = "/pages/web/index.php?page=Feedback";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
        }
    }
?>
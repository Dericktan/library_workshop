<?php
    include 'config.php';
    
    if(isset($_POST['student_register']))
    {
        $student_no = $_POST['student_no'];
        $name = $_POST['name'];
        $faculty_id = $_POST['faculty_id'];
        $course_id = $_POST['course_id'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $password = $_POST['password'];

        $register = "INSERT INTO tb_student (student_no,name,email,faculty_id,course_id,contact_no) VALUES ('$student_no','$name','$email','$faculty_id','$course_id','$contact_no')";
        $query = mysqli_query($con,$register);

        if($register)
        {
            $insert = "INSERT INTO tb_users (username,password,role) VALUES ('$student_no','$password','2')";
            $sql = mysqli_query($con,$insert);
            if($insert)
            {
                echo "<script> alert('Successfully Registered as Student');</script>";
                $url = "/login.php";
                $link = $baseUrl . $url;
                echo '<script> window.location.replace("'. $link .'");</script>';
                return true;
            }

        }

    }

    if(isset($_POST['lecturer_register']))
    {
        $lecturer_no = $_POST['lecturer_no'];
        $name = $_POST['name'];
        $faculty_id = $_POST['faculty_id'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $register = "INSERT INTO tb_lecturer (lecturer_no,name,faculty_id,email) VALUES ('$lecturer_no','$name','$faculty_id','$email')";
        $query = mysqli_query($con,$register);
        if($register)
        {
            $insert = "INSERT INTO tb_users (username,password,role) VALUES ('$lecturer_no','$password','3')";
            $sql = mysqli_query($con,$insert);
            if($insert)
            {
                echo "<script> alert('Successfully Registered as Lecturer');</script>";
                $url = "/login.php";
                $link = $baseUrl . $url;
                echo '<script> window.location.replace("'. $link .'");</script>';
                return true;
            }

        }

    }

?>
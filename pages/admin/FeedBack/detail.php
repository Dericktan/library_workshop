<?php
    include '../../../core/config.php';
    $id = $_GET['id'];
    $sql = "SELECT tb_users.role,tb_feedback.* from tb_feedback
    INNER JOIN tb_users on tb_users.id = tb_feedback.user_id
    WHERE tb_feedback.id='$id'";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    if($data[0]=="2")
    {
        $student = "SELECT tb_student.name, tb_feedback.created_at, tb_feedback.content from tb_feedback
        INNER JOIN tb_users on tb_users.id = tb_feedback.user_id
        INNER JOIN tb_student on tb_student.student_no = tb_users.username
        WHERE tb_feedback.id ='$id'";
        
        $exec = mysqli_query($con,$student);
        if($exec)
		{
            $data = mysqli_fetch_row($exec);
            echo "Name :".$data[0]."<br>";
            echo "Created on :".$data[1]."<br>";
            echo "Content :".$data[2]."<br>";
		}
		else if($exec)
		{
			echo "Data not found";
		}
    }
    else{
        $lecturer = "SELECT tb_lecturer.name, tb_feedback.created_at, tb_feedback.content from tb_feedback
        INNER JOIN tb_users on tb_users.id = tb_feedback.user_id
        INNER JOIN tb_lecturer on tb_lecturer.lecturer_no = tb_users.username
        WHERE tb_feedback.id ='$id'";
        
        $exec = mysqli_query($con,$lecturer);
        $details = mysqli_fetch_row($exec);

        echo "Name</td><td>:</td><td>".$details[0]."<br>";
        echo "Created on</td><td>:</td><td>".$details[1]."<br>";
        echo "Content</td><td>:</td><td>".$details[2]."<br>";
    }

?>
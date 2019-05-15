<?php
    include '../../core/config.php';
?>
<table style="bordered">
    <thead>
        <tr>
			<th>feedback id</th>
            <th>No</th>
            <th>User No</th>
            <th>Name</th>
            <th>FeedBack</th>
            <th>Posted On</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    <?php
     $query ="SELECT tb_feedback.id, tb_lecturer.lecturer_no as user_no, tb_lecturer.name as user_name, tb_feedback.user_id, tb_users.role, tb_feedback.content, tb_feedback.created_at as time FROM tb_feedback
	 INNER JOIN tb_users on tb_users.id = tb_feedback.user_id
	 INNER JOIN tb_lecturer on tb_lecturer.lecturer_no = tb_users.username
	 UNION ALL
	 select tb_feedback.id, tb_student.student_no, tb_student.name, tb_feedback.user_id, tb_users.role, tb_feedback.content, tb_feedback.created_at FROM tb_feedback
	 INNER JOIN tb_users on tb_users.id = tb_feedback.user_id
	 INNER JOIN tb_student on tb_student.student_no = tb_users.username
	 ORDER BY time DESC;";
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
				$id = $data['id'];
                $user_no = $data['user_no'];
                $user_name = $data['user_name'];
				$content = $data['content'];
                $time = $data['time'];
    ?>
        <tr>
			<td> <?php echo $id;?></td>
            <td> <?php echo $i;?></td>
            <td><?php echo $user_no;?></td>
			<td><?php echo $user_name;?></td>
			<td><?php if(strlen($content) > 30){echo substr($content,0,30);}else{echo $content;};?></td>
			<td><?php echo $time;?></td>
			<td><a href="../../pages/admin/feedback/detail.php?id=<?php echo $id;?>" target="_blank" rel="noopener noreferrer"> View Details </a></td>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
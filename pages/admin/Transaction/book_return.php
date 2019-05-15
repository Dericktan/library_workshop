<?php
    include '../../core/config.php';
?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Books</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    <?php
     $query ="SELECT tb_lecturer.lecturer_no as user_no, tb_lecturer.name as user_name, tb_booking_book.id from tb_booking_book
     INNER JOIN tb_users on tb_users.id = tb_booking_book.user_id
     INNER JOIN tb_lecturer on tb_lecturer.lecturer_no = tb_users.username
	 WHERE tb_booking_book.approved ='1' AND tb_booking_book.returned IS NULL
     UNION ALL
     SELECT tb_student.student_no as user_no, tb_student.name as user_name, tb_booking_book.id from tb_booking_book
     INNER JOIN tb_users on tb_users.id = tb_booking_book.user_id
	 INNER JOIN tb_student on tb_student.student_no = tb_users.username
	 WHERE tb_booking_book.approved ='1' AND tb_booking_book.returned IS NULL";
     $sql = mysqli_query($con, $query);
     
     if(mysqli_num_rows($sql)==0)
        {
            echo "<tr> <td colspan='4'> <center>Sorry! There is no data in the database now.</center> </td> </tr>";
        }
        else
        {
            $i=0;
            while($data = mysqli_fetch_array($sql))
            {
                $i++;
                $user_no = $data['user_no'];
                $user_name = $data['user_name'];
                $book_booking_id = $data['id'];
    ?>
        <tr>
            <td> <?php echo $i;?></td>
            <td> <?php echo $user_no." - ".$user_name;?></td>
			<td>
				<ul>
				<?php
					$books = "SELECT tb_book.title from tb_booking_book_details
					INNER JOIN tb_book on tb_book.id = tb_booking_book_details.book_id
					WHERE tb_booking_book_details.booking_book_id ='$book_booking_id'";
					$query = mysqli_query($con,$books);

					while($data = mysqli_fetch_array($query))
					{
						$title = $data['title'];
						?>
						<li>
							<?php echo $title;?>
						</li>
				<?php } ?>
				</ul>
			</td>
            <td>
            <form action="../../core/transaction.php" method="post">
                <input type="hidden" name="id" value="<?php echo $book_booking_id;?>">
                <input class="btn btn-primary" type="submit" name="returnBook" Value="Returned">
            </form>
            </td>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
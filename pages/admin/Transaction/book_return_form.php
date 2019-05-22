<?php
	include '../../core/config.php';
	include '../../core/transaction.php';

    if (isset($_GET["id"]))
    {
        $bookbooking = getBookBookingRequest($_GET["id"]);
        $allBooks = getAllBooks($_GET["id"]);
    }
?>

<form action="" method="POST">
	<?php
        echo "<input type='hidden' name='id' value='" . $bookbooking["id"] . "'>";
        echo "<input type='hidden' name='created_at' value='" . $bookbooking["created_at"] . "'>";

    ?>
	<input type="hidden" name="booking_id" value="<?php echo $bookbooking['id']; ?>" required>
	<br>
	User Name:<br>
	<input type="text" name="user_name" disabled value="<?php echo $bookbooking['user_name']; ?>" required>
    <br>
    User No:<br>
	<input type="text" name="user_no" disabled value="<?php echo $bookbooking['user_no']; ?>" required>
    <br>
    Books :<br>
    <table style="bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query ="SELECT tb_book.title, tb_book.id as book_id, tb_booking_book.id as booking_id, tb_booking_book_details.id as booking_detail_id FROM tb_booking_book_details
        INNER JOIN tb_book on tb_book.id = tb_booking_book_details.book_id
        INNER JOIN tb_booking_book on tb_booking_book.id = tb_booking_book_details.booking_book_id
        WHERE tb_booking_book.id='".$_GET['id']."'";
        $sql = mysqli_query($con, $query);
        
        if(mysqli_num_rows($sql)==0)
            {
                echo "<tr> <td colspan='8'> <center>Sorry! There is no data in the database now.</center> </td> </tr>";
            }
            else
            {
                $i=0;
                while($data = mysqli_fetch_array($sql))
                {
                    $i++;
                    $id = $data['book_id'];
                    $booking_detail_id = $data['booking_detail_id'];
                    $title = $data['title'];
        ?>
            <tr>
                <td> <?php echo $i;?></td>
                <td> <?php echo $title;?></td>
                <td>
                    <input type="hidden" name="books_id[]" value="<?php echo $id; ?>">
                    <input type="hidden" name="booking_details_id[]" value="<?php echo $booking_detail_id; ?>">
                    <select name="booking_details_status[]" class="form-control">
                        <option value="0">Bad</option>
                        <option value="1" selected>Good</option>
                    </select>
                </td>
            </tr>
        <?php
                }
            }
        ?>
        </tbody>
    </table>
    <br>
	<input type="submit" name="returnBook" value="Returned">
</form>
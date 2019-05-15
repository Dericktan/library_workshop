<?php
	include '../../core/config.php';
	include '../../core/transaction.php';

    if (isset($_GET["id"]))
    {
        $bookbooking = getBookBookingRequest($_GET["id"]);
        $allBooks = getAllBooks($_GET["id"]);
    }
?>

<form action="../../core/transaction.php" method="POST">
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
    <textarea name="title" disabled cols="30" rows="10"><?php echo $allBooks['title']?>
    </textarea>
	<br>
    Length of Booking :<br>
	<input type="text" name="length_of_booking" required> days
    <br>
    <br>
	<input type="submit" name="approveBook" value="Approve">
</form>
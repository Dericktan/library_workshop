<?php
	include '../../core/config.php';
?>

<form action="../../core/book.php" method="POST">
	Book No:<br>
	<input type="text" name="book_no" required>
	<br>
	Title:<br>
	<input type="text" name="title" required>
	<br>
	Author:<br>
	<input type="text" name="author" required>
	<br>
	Location:<br>
	<input type="text" name="book_location" required>
	<br>
	Book Category:<br>
	<select name="book_category">
		<option value="Knowledge">Knowledge</option>
		<option value="Education">Education</option>
		<option value="Magazine">Magazine</option>
		<option value="Novel">Novel</option>
		<option value="Fiction">Fiction</option>
		<option value="Fiction">Non-Fiction</option>
	</select>
	<br>
	<br>
	<input type="submit" name="addBook" value="Add New Book">
</form>
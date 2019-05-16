<?php 
	require '../../core/config.php';
	require '../../core/cart.php';
?>
<div class="zoom"style="position: absolute; right:120px; top:15px; z-index: 999;">
	<a class="btn btn-primary text-right" href="index.php?page=Cart">Cart</a>
</div>
<div class="align-center">
	<h1 class="title">Books in Cart</h1>
</div>
<div class="form-container">
	<table style="background-color: white;">
		<thead>
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$no=0;
			if (isset($_SESSION["books_title"]) && count($_SESSION["books_title"]) > 0)
			{
		?>
		<form action="" method="POST">
		<?php
			foreach($_SESSION["books_title"] as $key => $value)
			{
				$no++;
		?>
			<tr>
				<td> <?php echo $no; ?></td>
				<td> <input type="hidden" name="book_id" value="<?php echo $_SESSION["books_id"][$key]; ?>"><?php echo $value; ?></td>
				<td> <button type="submit" value="Delete" name="delete" class="modal-effect modal-activate btn btn-success">Delete</button></td>
			</tr>
		<?php }	?>
		</form>
		<?php }	?>
		</tbody>
	</table>
	<?php 
		if(isset($_SESSION["books_title"]) && count($_SESSION["books_title"]) > 0)
		{
	?>
	<form action="" method="POST">
		<button type="submit" name="checkout" id="btn-check-out" class="btn btn-primary mt-30">Check Out!</button>
	</form>
	<?php }; ?>

</div>

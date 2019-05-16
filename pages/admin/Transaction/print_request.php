<?php
	include '../../core/config.php';
	include '../../core/printing.php';
?>
<div class="content-container" style="background-color: #ffffff;">
	<table style="background-color: white;">
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Date Requested</th>
				<th>Total Pages</th>
				<th>Grayscale</th>
				<th>Price</th>
				<th>File</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$result = getAllPrinting();
				$no = 0;
				if ($result != false)
				{
					while($row = $result->fetch_assoc())
					{
						$no++;
						$id = $row["id"];
						$username = $row["username"];
						$date_of_request = $row["date_of_request"];
						$total_pages = $row["total_pages"];
						$grayscale = $row["grayscale"];
						$price = $row["price"];
						$file = $row["file"];
						$paid = $row["paid"];
			?>
			<tr>
				<th scope="row"><?php echo $no; ?></th>
				<td><?php echo $username; ?></td>
				<td><?php echo $date_of_request; ?></td>
				<td><?php echo $total_pages; ?></td>
				<td><?php if($grayscale == 1) {echo "Yes"; }else{ echo "No";} ?></td>
				<td><?php echo $price; ?></td>
				<td>
					<a class="btn btn-primary" href="../../download.php?file=<?php echo urlencode($file); ?>">Download</a>
				</td>
				<td>
					<form action="" method="POST">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<button type="submit" class="btn btn-primary" <?php if ($paid){echo "disabled";} else {echo "";}?> name="updatePaid">
							<?php
								if ($paid)
								{
									echo "Paid";
								} else {
									echo "Update as Paid";
								}
							?>
						</button>
					</form>
				</td>
			</tr>
			<?php
					}
				} else {
					
				
			?>
				<tr>
					<td colspan="6"><center>No data available</center></td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>
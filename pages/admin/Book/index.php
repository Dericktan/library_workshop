<?php
    include '../../core/config.php';
?>
<table style="bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Book No</th>
            <th>Title</th>
            <th>Author</th>
            <th>Location</th>
            <th>Book Category</th>
            <th>Available</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    <?php
     $query ="SELECT * FROM tb_book";
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
                $id = $data['id'];
                $book_no = $data['book_no'];
                $title = $data['title'];
                $author = $data['author'];
                $location = $data['book_location'];
                $category =$data['book_category'];
                $available = $data['available'];
    ?>
        <tr>
            <td> <?php echo $i;?></td>
            <td> <?php echo $book_no;?></td>
            <td> <?php echo $title;?></td>
            <td> <?php echo $author;?></td>
            <td> <?php echo $location;?></td>
            <td> <?php echo $category;?></td>
            <td> <?php if($available==TRUE){echo "Yes";}else{echo "No";}?></td>
            <td> <a class="btn btn-primary" href="index.php?page=BookForm&id=<?php echo $id;?>">Edit</a></td>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
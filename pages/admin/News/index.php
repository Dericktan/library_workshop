<?php
    include '../../core/config.php';
?>
<table style="bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Date Created</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    <?php
     $query ="SELECT * FROM tb_news";
     $sql = mysqli_query($con, $query);
     
     if(mysqli_num_rows($sql)==0)
        {
            echo "<tr> <td colspan='5'> <center>Sorry! There is no data in the database now.</center> </td> </tr>";
        }
        else
        {
            $i=0;
            while($data = mysqli_fetch_array($sql))
            {
                $i++;
                $id = $data['id'];
                $title = $data['title'];
                $content = $data['content'];
                $date_created = $data['date_created'];
    ?>
        <tr>
            <td> <?php echo $i;?></td>
            <td> <?php echo $title;?></td>
            <td> <?php if(strlen($content) > 20){echo substr($content,0,20);}else{echo $content;}; ?></td>
            <td> <?php echo $date_created;?></td>
            <td> <a class="btn btn-primary" href="index.php?page=NewsForm&id=<?php echo $id;?>">Edit</a></td>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
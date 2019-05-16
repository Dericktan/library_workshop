<?php
    include 'config.php';
    
    if(isset($_POST['addToCart']))
    {
        global $con;
        $id = $_POST['addToCart'];
        $select = "SELECT title FROM tb_book where id='$id'";
        $query = mysqli_query($con,$select);
        while($data=mysqli_fetch_array($query)){
            $book_title = $data['title'];
        }
        if (isset($_SESSION["books_title"]) && count($_SESSION["books_title"]) > 0)
        {
            array_push($_SESSION["books_title"], $book_title);
            array_push($_SESSION["books_id"], $id);
            echo "<script> alert('Successfully Added to the Cart');</script>";
            $url = "/pages/web/index.php?page=SearchBook";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;  
        } else {
            $_SESSION["books_title"] = array($book_title);
            $_SESSION["books_id"] = array($id);
            echo "<script> alert('Successfully Added to the Cart');</script>";
            $url = "/pages/web/index.php?page=SearchBook";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;  
        }
    }

    if(isset($_POST['delete']))
    {
        $book_id = $_POST['book_id'];
    
        foreach ($_SESSION["books_id"] as $key => $value)
        {
            if ($value == $book_id)
            {
                unset($_SESSION["books_id"][$key]);
                unset($_SESSION["books_title"][$key]);	
            }
        }
        $url = "/pages/web/index.php?page=Cart";
        $link = $baseUrl . $url;
        echo '<script> window.location.replace("'. $link .'");</script>';
    }

    if(isset($_POST['checkout']))
    {
        $insert1 = "INSERT INTO tb_booking_book (user_id) VALUES ('$user_id')";
        $tb_booking_book_id = "SELECT LAST_INSERT_ID()";
    
        $sql = mysqli_query($con,$insert1);
        $sql1 = mysqli_query($con,$tb_booking_book_id);
        $tb_booking_book_id = mysqli_fetch_row($sql1)[0];
    
        foreach($_SESSION["books_id"] as $key => $value)
        {
            $insert2="INSERT INTO tb_booking_book_details (booking_book_id,book_id) values ('$tb_booking_book_id','$value')";
            $exec = mysqli_query($con,$insert2);
            
            $update2 = "UPDATE tb_book set available=FALSE where id='$value'";
            $exec2= mysqli_query($con,$update2);	
                    
            unset($_SESSION["books_id"][$key]);
            unset($_SESSION["books_title"][$key]);	
    
        }
    }

?>
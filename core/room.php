<?php
    include'config.php';
    function checkRoomNo()
    {
        global $con;
        $book_no = $_POST['book_no'];
        $select = "SELECT * FROM tb_roomdiscussion where room_no='$room_no'";
        $check = mysqli_query($con,$select);
        if($check->num_rows > 0){
            return false;
        }
        return true;
    }

    function getBook($id)
    {
        global $con;
        $select = "SELECT * FROM tb_book where tb_book.id ='$id'";
        $check = mysqli_query($con,$select);
        if($check->num_rows >0){
            return $check->fetch_assoc();
        }
        return false;
    }
    
    if(isset($_POST['addBook'])){
        global $con;
        $book_no = $_POST['book_no'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $book_location = $_POST['book_location'];
        $book_category = $_POST['book_category'];
        $sql = "INSERT INTO tb_book (book_no,title,author,book_location,book_category,available) VALUES ('$book_no','$title','$author','$book_location','$book_category',TRUE)";
        if(checkBookNo() == TRUE)
        {
            $exec = mysqli_query($con,$sql);
            if($exec == TRUE){
                echo "<script> alert('Successfully Added a new Book');</script>";
                $url = "/pages/admin/index.php?page=BookList";
                $link = $baseUrl . $url;
                echo '<script> window.location.replace("'. $link .'");</script>';
                return true;
            }
            else{
                echo "<script> alert('Duplicate Book No Detected');</script>";
                $url = "/pages/admin/index.php?page=BookForm";
                $link = $baseUrl . $url;
                echo '<script> window.location.replace("'. $link .'");</script>';
                return false;
            }    
        }
        else
        {
            echo "<script> alert('Duplicate Book No Detected');</script>";
            $url = "/pages/admin/index.php?page=BookForm";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
    }

    if(isset($_POST['updateBook'])){
        global $con;
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $book_location = $_POST['book_location'];
        $book_category = $_POST['book_category'];
        $sql = "UPDATE tb_book set title='$title', author ='$author', book_location='$book_location', book_category='$book_category' where tb_book.id='$id'";
        $query = mysqli_query($con,$sql);
        if($query == TRUE){
            echo "<script> alert('Successfully Updated the Book');</script>";
            $url = "/pages/admin/index.php?page=BookList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to update the Book');</script>";
            $url = "/pages/admin/index.php?page=BookList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
    }

    


?>
<?php
    include'config.php';
    
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
                // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
            }    
        }
        else
        {
            // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
        }
    }

    function checkBookNo()
    {
        global $con;
        $book_no = $_POST['book_no'];
        $select = "SELECT * FROM tb_book where book_no='$book_no'";
        $check = mysqli_query($con,$select);
        if($check->num_rows > 0){
            return false;
        }
        return true;
    }
    
    function insertBook(){
        
    }


?>
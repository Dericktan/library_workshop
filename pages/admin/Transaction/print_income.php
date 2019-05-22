<?php 
    include '../../../core/config.php';
    
    $total = "SELECT SUM(tb_printing.total_pages) as total_pages, SUM(tb_printing.price)as price from tb_printing where tb_printing.paid = TRUE";
    $query = mysqli_query($con,$total);
    $data_total = mysqli_fetch_array($query);

    $grayscale = "SELECT SUM(tb_printing.total_pages) as total_pages, SUM(tb_printing.price)as price from tb_printing where tb_printing.paid = TRUE AND tb_printing.grayscale=TRUE" ;
    $query2 = mysqli_query($con,$grayscale);
    $data_totall = mysqli_fetch_array($query2);

    $color = "SELECT SUM(tb_printing.total_pages) as total_pages, SUM(tb_printing.price)as price from tb_printing where tb_printing.paid = TRUE AND tb_printing.grayscale=FALSE" ;
    $query3 = mysqli_query($con,$color);
    $data_totalll = mysqli_fetch_array($query3);
    
?>
<h1> Printing Income </h1>
<table style="bordered" border="1">
    <tr>
        <td>Total Pages</td>
        <td> <?php echo $data_total[0];?></td>
    </tr>
    <tr>
        <td> Total Income</td>
        <td> <?php echo $data_total[1];?></td>        
    </tr>
</table>

<h1> Printing Income for Grayscale </h1>
<table style="bordered" border="1">
    <tr>
        <td>Total Pages</td>
        <td> <?php echo $data_totall[0];?></td>
    </tr>
    <tr>
        <td> Total Income</td>
        <td> <?php echo $data_totall[1];?></td>        
    </tr>
</table>

<h1> Printing Income for Color </h1>
<table style="bordered" border="1">
    <tr>
        <td>Total Pages</td>
        <td> <?php echo $data_totalll[0];?></td>
    </tr>
    <tr>
        <td> Total Income</td>
        <td> <?php echo $data_totalll[1];?></td>        
    </tr>
</table>
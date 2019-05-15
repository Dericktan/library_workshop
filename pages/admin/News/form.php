<?php
	include '../../core/config.php';
	include '../../core/news.php';

	$edit = false;
    if (isset($_GET["id"]))
    {
        $edit = true;
        $news = getNews($_GET["id"]);
    }
?>

<form action="../../core/news.php" method="POST">
	<?php
        if ($edit)
        {
            echo "<input type='hidden' name='id' value='" . $news["id"] . "'>";
        }
    ?>
	Title:<br>
	<input type="text" name="title"  value="<?php if($edit){ echo $news['title']; } else { echo ''; }; ?>" required>
	<br>
	Content:<br>
	<textarea  rows="10" cols="120" name="content"><?php if($edit){ echo $news['content']; } else { echo ''; }; ?></textarea> 
	<br>
	<br>
	<input type="submit" name="<?php if($edit){ echo 'updateNews'; } else { echo 'addNews'; }; ?>" value="<?php if($edit){echo 'Update News';} else{echo 'Add News';};?>">
</form>
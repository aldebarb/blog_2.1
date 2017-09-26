<?php
$editForum = new Forum($_GET['postId']);
$editForum->loadPost($mysqli);

if (isset($_POST['submit'])) {
	$inputArray = array_map('removeMaliciousCode', $_POST);

	if (empty($inputArray['postTitle']) || empty($inputArray['postContent'])) {
		echo "Invalid Post";

	} else {
		$editForum->setUserId($_SESSION['userId']);
		$editForum->setPostTitle($inputArray['postTitle']);
		$editForum->setPostContent($inputArray['postContent']);
		$editForum->setPostDate(strftime("%B %d, $Y"));
		$editForum->setPostTime(strftime("%X"));
		$editForum->updatePost($mysqli);
		header("location: home.php");
	}
}
?>

<form method="post" action="">
	<caption>Title:</caption>
	<input type="text" name="postTitle" maxlength="32" value="<?php echo $editForum->getPostTitle();?>"><br><br>
	<caption>Post:</caption>
	<textarea name="postContent" rows="3", cols="40" maxlength="120"><?php echo $editForum->getPostContent();?></textarea>
	<input type="submit" name="submit" value="Edit Post">
</form>
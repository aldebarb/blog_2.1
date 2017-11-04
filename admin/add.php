<?php
/*
    Filter user input and use the Forum class to add the post to the database
*/

if (isset($_POST['submit'])) {
	$inputArray = array_map('removeMaliciousCode', $_POST);

	if (empty($inputArray['postTitle']) || empty($inputArray['postContent'])) {
		echo "<p>Invalid Post</p>";
		
	} else {
		$addForum = new Forum(0);
		$addForum->setUserId($_SESSION['userId']);
		$addForum->setPostTitle($inputArray['postTitle']);
		$addForum->setPostContent($inputArray['postContent']);
		$addForum->setPostDate(strftime("%B %d, %Y"));
		$addForum->setPostTime(strftime("%X"));
		$addForum->save($mysqli);
		header("location: home.php");
	}
}
?>

<form method="post" action="">
	<caption>Title:</caption>
	<input type="text" name="postTitle" maxlength="32"><br><br>
	<caption>Post:</caption>
	<textarea name="postContent" rows="3", cols="40" maxlength="120"></textarea>
	<input type="submit" name="submit" value="Post">
</form>

<?php
//Schema 
//Forum(post_id, user_id, post_title, post_blog, post_date, post_time)
$result = $mysqli->query("SELECT forum.post_title, user_login.email_address, forum.post_date, forum.post_time, forum.post_blog, forum.post_id FROM forum JOIN user_login ON forum.user_id = user_login.user_id ORDER BY forum.post_id DESC");

if ($result->num_rows > 0) {
	print "<hr/>";
	while ($row = $result->fetch_assoc()) {
		print "<h2>" . $row['post_title'] . "</h2>
		       <p1>" . $row['post_blog'] . "</p1><br><br>
		       <p1>Posted by " . $row['email_address'] . " on " . $row['post_date'] . " at " . $row['post_time'] . "</p1>
		       <form method='post' action='admin/delete.php?postId=" . $row['post_id'] . "'>
		       <input type='submit' name='delete' value='Delete'>
		       <a href='home.php?p=edit&postId=" . $row['post_id'] . "'>Edit Post?</a>
		       </form><hr/>";
	}
	
} else {
	echo "Result should be empty";
}
?>
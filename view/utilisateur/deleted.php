<?php
	echo "<p>L'utilisateur a bien été supprimer !</p>";
	$arr = array('view','utilisateur','list.php');
	require_once File::build_path($arr);
?>
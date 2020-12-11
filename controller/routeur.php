<?php
$action ='readAll';

if (isset($_GET['controller'])) {
	$controller = $_GET['controller'];
	$controller_class = "Controller" . ucfirst(strtolower($controller));
}else {
	$controller_class = "ControllerOffres";
}

$arr = array('controller',"$controller_class.php");
if(!file_exists(File::build_path($arr))) {
	$controller_class = "ControllerOffres";
	$arr = array('controller',"$controller_class.php");
}
require_once File::build_path($arr);

if(class_exists($controller_class)) {
	if(isset($_GET['action'])) {
		//vérifier que l'action existe
		$class_methods = get_class_methods($controller_class);
		if(in_array($_GET['action'], $class_methods)) {
			//existe donc affecté get
			$action = $_GET['action'];
		}else {
			$controller_class = "ControllerOffres";
		}
	}else {
		$controller_class = "ControllerOffres";
	}
}else {
	$controller_class = "ControllerOffres";
}

	$arr = array('controller',"$controller_class.php");
	require_once File::build_path($arr);
	$controller_class::$action();

?>
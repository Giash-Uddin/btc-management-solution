<?php
$project_folder = explode("/", str_replace($_SERVER["DOCUMENT_ROOT"], "", $_SERVER["SCRIPT_FILENAME"]));
include ($_SERVER["DOCUMENT_ROOT"] . "/" . $project_folder[1] . "/database/LoginAccess.php");
$data_access = new LoginAccess();
$data_access->logout();
?>

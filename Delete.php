<?php
 
$data = json_decode(file_get_contents('php://input'), TRUE);
 
if (isset($data['id'])) {
    require_once("database/DataAccess.php");
    $task_id = (isset($data['task']) ? $data['task'] : NULL);
    echo $task_id;
    $data_access = new DataAccess();
    $data_access->delete('branch', 'id=15');
}
 
?>

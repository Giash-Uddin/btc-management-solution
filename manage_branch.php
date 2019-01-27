<?php
session_start();
$session_validity = $_SESSION['valid'];
if (!$session_validity) {
    header('Location: login.php');
}
require_once("Head.php");
require_once("Sidebar.php");
require_once("database/DataAccess.php");
$data_access = new DataAccess();
$branch_number = $data_access->getCount("branch", null);
$active_branch = $data_access->getCount("branch", 1);
$branch = $data_access->select('branch', '*', '');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $branch = [];
    $branch['branch_name'] = $_POST['branch_name'];
    $branch['branch_id'] = $_POST['branch_id'];
    $branch['status'] = $_POST['status'];
    $result = $data_access->insert('branch', $branch);
    if ($result > 0) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Greate!","Data Saved Successfully !","success");';
        echo '}, 1000);</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("OOPs! ...","Data Not Saved !","warning");';
        echo '}, 1000);</script>';
    }
}
?>

<div class="row-fluid">
    <script>
        var manageBranchApp = angular.module("manageBranchApp", []);

        manageBranchApp.controller('manageBranchController', function($scope) {
        $scope.delete = function(id) {
        return $http({
        method: 'POST',
                data: { 'id' : id },
                url: 'http://localhost/sb-blood-search/delete.php'
        });
        });
                function deletee(id){
<?php
require_once("database/DataAccess.php");
$data_access = new DataAccess();
$id = 'id';
//$result = $data_access->delete('branch', 'id=' . $id);
echo $result;
?>

                }
    </script>
    <div class="btn-group">
        <button type="button" class="btn">Total Branch <span class="label label-danger"><?php echo $branch_number['count'] ?></span></button>
        <button type="button" class="btn">Active Branch<span class="label label-warning"><?php echo $active_branch['count'] ?></span></button>
    </div> 
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Add New Branch</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12" >

                <div class="row-fluid" ng-app = "manageBranchApp" ng-controller = "manageBranchController">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>Branch Name</th>
                                <th>Branch ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($branch) {
                                foreach ($branch as $row) {
                                    $status = ($row["status"] == 1) ? 'Active' : 'Inactive';
                                    $status_icon = ($row["status"] == 1) ? 'icon-remove' : 'icon-ok';
                                    $id = $row["id"];
                                    echo "<tr class='odd gradeX'> <td>" . $row["branch_name"] . "</td> <td>" . $row["branch_id"] . "</td><td class='center'>" . $status . "</td>"
                                    . "<td><div class='btn-group'>"
                                    . "<button class='btn btn-success'><i class='icon-user'></i></button> "
                                    . "<button class='btn btn-info'><i class='icon-pencil'></i></button>"
                                    . "<button class='btn btn-warning' value='" . $id . "' onclick='set_active(this.value)'><i class='" . $status_icon . "'></i></button>"
                                    . "<button class='btn btn-danger' value='" . $id . "' ng-click='delete(8)'><i class='icon-trash'></i></button></div></td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>
<?php
require_once("Footer.php");
?>

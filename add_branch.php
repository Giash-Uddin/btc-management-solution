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
    }else{
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("OOPs! ...","Data Not Saved !","warning");';
        echo '}, 1000);</script>';
    }
}
?>
<div class="row-fluid">
    <script>
        var mainApp = angular.module("mainApp", []);

        mainApp.controller('branchController', function($scope) {
            $scope.reset = function() {
            }

            $scope.reset();
        });
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

                <div class="row-fluid" ng-app = "mainApp" ng-controller = "branchController" >
                    <form name = "branchForm" novalidate class="" action='<?php $_PHP_SELF ?>' method="POST">
                        <table>
                            <tr>
                                <td><label>Branch Name :</label></td>
                                <td><input type="text" class="input-block-level" name="branch_name" ng-model = "branch_name"  required></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span style = "color:red" ng-show = "branchController.branch_name.$dirty && branchController.branch_name.$invalid">
                                        <span ng-show = "branchController.branch_name.$error.required">branch name is required.</span>
                                    </span> 
                                </td>
                            </tr>
                            <tr>
                                <td><label>Branch ID :</label></td>
                                <td><input type="text" class="input-block-level" name="branch_id" ng-model = "branch_id"/></td>
                            </tr>
                            <tr>
                                <td><label> Branch Status: </label></td>
                                <td>
                                    <select class="input-block-level" name="status" ng-model = "status" >
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span style = "color:red" ng-show = "branchController.status.$dirty && branchController.status.$invalid">
                                        <span ng-show = "branchController.status.$error.required">status is required.</span>
                                    </span> 
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><button class="btn btn-large btn-success" 
                                            ng-disabled = "branchController.branch_name.$dirty && branchController.branch_name.$invalid ||
                                                        branchController.status.$dirty && branchController.status.$invalid"
                                            type="submit">Submit</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>
<?php
require_once("Footer.php");
?>

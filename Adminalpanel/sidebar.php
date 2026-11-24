<?php
session_start();
include("modelqueries.php");
$obj=new queries();

if (isset($_SESSION["userEmail"])) {
    $res = $obj->userbyEmail($_SESSION["userEmail"]);

    if ($res && $res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
?>

<!-- Start sidebar-wrapper -->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">

    <div class="brand-logo">
        <a href="index.php">
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Dashtreme Admin</h5>
        </a>
    </div>

    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>

        <li>
            <a href="index.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php if ($row["status"] == 1) { ?>

        <li>
            <a href="addproduct.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>Add Product</span>
            </a>
        </li>

        <li>
            <a href="veiwproduct.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>View Product</span>
            </a>
        </li>
        <li>
            <a href="veiwuser.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>View User</span>
            </a>
        </li>
        <li>
            <a href="veiworder.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>View order</span>
            </a>
        </li>
         <li>
            <a href="profile.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>View Your Profile</span>
            </a>
        </li>

        <li>
            <a href="../index.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>Back to Home</span>
            </a>
        </li>

        <li class="sidebar-header">LABELS</li>

        <li>
            <a href="javascript:void(0);">
                <i class="zmdi zmdi-coffee text-danger"></i>
                <span>Important</span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);">
                <i class="zmdi zmdi-chart-donut text-success"></i>
                <span>Warning</span>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);">
                <i class="zmdi zmdi-share text-info"></i>
                <span>Information</span>
            </a>
        </li>

        <?php }
        if ($row["status"] == 0) {
         ?>
        <li>
            <a href="veiworder.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>View Your Orders</span>
            </a>
        </li>
        <li>
            <a href="profile.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>View Your Profile</span>
            </a>
        </li>

        <li>
            <a href="../index.php">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>Back to Home</span>
            </a>
        </li>
      
<?php
        }
?>
    </ul>

</div>
<!-- End sidebar-wrapper -->

<?php
        }
    }
}
?>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Electro</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="assets/css/sidebar-menu.css" rel="stylesheet">
    <link href="assets/css/app-style.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        /* Keep the sidebar's original DashTreme positioning */
        #sidebar-wrapper {
            background-color: #090b1c !important;
            color: #fff;
        }

        #sidebar-wrapper .brand-logo {
            background-color: #000 !important;
        }

        #sidebar-wrapper .sidebar-menu li a {
            color: #fff;
        }

        #sidebar-wrapper .sidebar-menu li a i {
            color: #f3a847;
        }

        #sidebar-wrapper .sidebar-menu .sidebar-header {
            color: #aaa;
        }

        #sidebar-wrapper .sidebar-menu li a:hover {
            background-color: #292929;
            color: #f3a847;
        }

        /* Profile layout */
        .profile-content {
            margin-left: 250px;
            padding: 25px;
            min-width: 0;
        }

        .profile-heading {
            background: #fff;
            padding: 22px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
        }

        .profile-heading h2 {
            margin: 0 0 5px;
            font-size: 25px;
            font-weight: 600;
        }

        .profile-heading p {
            margin: 0;
            color: #777;
        }

        .profile-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            overflow: hidden;
        }

        .profile-card-header {
            padding: 22px 25px;
            border-bottom: 1px solid #eee;
        }

        .profile-card-header h4 {
            margin: 0 0 5px;
            font-size: 18px;
            font-weight: 600;
        }

        .profile-card-header p {
            margin: 0;
            color: #888;
            font-size: 13px;
        }

        .profile-details {
            padding: 10px 25px;
        }

        .profile-row {
            display: grid;
            grid-template-columns: 180px minmax(0, 1fr);
            gap: 15px;
            padding: 18px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-row:last-child {
            border-bottom: none;
        }

        .profile-label {
            color: #777;
            font-size: 14px;
        }

        .profile-value {
            color: #333;
            font-size: 14px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .account-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            background: #e6f7ed;
            color: #16834a;
            font-size: 12px;
        }

        .profile-footer {
            padding: 0 25px 25px;
        }

        .profile-btn {
            display: inline-block;
            background: #f3a847;
            color: #222;
            text-decoration: none;
            padding: 10px 17px;
            border-radius: 5px;
            font-weight: 600;
            margin: 0 8px 8px 0;
        }

        .profile-btn:hover {
            background: #e99a31;
            color: #222;
        }

        .profile-btn.secondary {
            background: #edf0f3;
        }

        @media (max-width: 768px) {
            .profile-content {
                margin-left: 0;
                padding: 15px;
            }

            .profile-row {
                grid-template-columns: 1fr;
                gap: 7px;
            }
        }
    </style>
</head>

<body>

    <?php include("sidebar.php");
    $email=$_SESSION["userEmail"];
    ?>

    <div class="profile-content">

        <div class="profile-heading">
            <h2>My Profile</h2>
            <p>View your account information.</p>
        </div>
        <?php
        $res=$obj->userbyEmail($email);
        if($res->num_rows>0){
            while($row=mysqli_fetch_assoc($res)){

        ?>

        <section class="profile-card">

            <div class="profile-card-header">
                <h4>Personal Information</h4>
                <p>Your account details</p>
            </div>

            <div class="profile-details">

                <div class="profile-row">
                    <div class="profile-label">Full Name</div>
                    <div class="profile-value"><?php echo $row["name"];?></div>
                </div>

                <div class="profile-row">
                    <div class="profile-label">Email Address</div>
                    <div class="profile-value"><?php echo $row["email"];?></div>
                </div>

                <div class="profile-row">
                    <div class="profile-label">ADDRESS</div>
                    <div class="profile-value"><?php echo $row["address"];?></div>
                </div>

                <div class="profile-row">
                    <div class="profile-label">Account Status</div>
                    <div class="profile-value">
                        <span class="account-status">Active</span>
                    </div>
                </div>


            </div>

            
            <?php
            }
        }
    
            ?>

        </section>

    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>

</body>
</html>

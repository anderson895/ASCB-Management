<?php
include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}

$profile_id = $_GET['profile_id'];

$get_user_info = $admin_db->get_user_info($profile_id);
$admin = $get_user_info->fetch_array();

$fullname = $admin['fname'] . ' ' . $admin['mname'] . ' ' . $admin['lname'];
$email = $admin['email'];
?>
<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <h4 class="mb-0"><?=ucfirst($admin['fname'])?>'s Profile</h4>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <img src="../assets/admin_upload/<?=$admin['profile_img'];?>" class="img-fluid rounded-circle mb-3 shadow-sm" alt="Profile Image" style="width: 150px; height: 150px;">
            <h5 class="fw-bold mb-1"><?php echo $fullname; ?></h5>
            <p class="text-muted"><?php echo $email; ?></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="frmUpdateProfile" enctype="multipart/form-data" class="needs-validation" novalidate>

            <input type="hidden" name="update_profile_id" id="update_profile_id" value="<?=$profile_id?>">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm border-0" id="update_profile_fname" placeholder="Enter First Name" name="update_profile_fname" value="<?=$admin['fname']?>" required>
                    <label for="update_profile_fname">First Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm border-0" id="update_profile_mname" placeholder="Enter Middle Name" name="update_profile_mname" value="<?=$admin['mname']?>">
                    <label for="update_profile_mname">Middle Name (Optional)</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm border-0" id="update_profile_lname" placeholder="Enter Last Name" name="update_profile_lname" value="<?=$admin['lname']?>" required>
                    <label for="update_profile_lname">Last Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control shadow-sm border-0" id="update_profile_email" placeholder="Enter Email" name="update_profile_email" value="<?=$admin['email']?>" required>
                    <label for="update_profile_email">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-sm border-0" id="update_profile_username" placeholder="Enter Username" name="update_profile_username" value="<?=$admin['username']?>" required>
                    <label for="update_profile_username">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-sm border-0" id="update_profile_password" placeholder="Enter New Password" name="update_profile_password" required>
                    <label for="update_profile_password">For new password only</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="file" class="form-control shadow-sm border-0" name="update_profile_img" id="update_profile_img" required>
                    <label for="update_profile_img">Profile Image</label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg shadow-sm border-0" id="btnUpdateProfile">Save Info</button>
                    <div class="loading-spinner mt-3" id="loading-spinner" style="display:none;">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<?php
include('../components/admin-footer.php');
?>

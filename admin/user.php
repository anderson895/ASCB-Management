<?php



include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}?>

<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4>Manage Admins</h4>

    
  </div>
</nav>



<!-- START -->


<button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".add-user-modal">Add New</button>


<div class="table-responsive">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>USER ID</th>
                <th>First Name</th>
                <th>Middle Name (Optional)</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <h2 class="text-center">List of Users</h2>
            <?php 
                $get_All_user = $admin_db->get_All_user();
                while ($user = $get_All_user->fetch_array()):
                
                    if ($user['type'] == 'super_admin') {
                        $type = "Super Admin"; 
                    } else {
                        $type = $user['type'];
                    }
                    
                ?>
                <tr>
                    <td><?=$user['admin_id']; ?></td>
                    <td><?=$user['fname']; ?></td>
                    <td><?=$user['mname']; ?></td>
                    <td><?=$user['lname']; ?></td>
                    <td><?=$user['email']; ?></td>
                    <td><?=$user['username']; ?></td>
                    <td><?=$type ?></td>
              
                    <td>
                        <div id="delLoad-<?=$user['admin_id']?>">
                            <!-- Update Button -->
                            <button type="button" class="btn btn-secondary TogglerUpdateUser" data-toggle="modal" 
                            data-target=".edit-user-modal" 
                            data-admin_id="<?=$user['admin_id']?>"  
                            data-fname="<?=$user['fname']?>" 
                            data-mname="<?=$user['mname']?>" 
                            data-lname="<?=$user['lname']?>"
                            data-email="<?=$user['email']?>"
                            data-username="<?=$user['username']?>"
                            data-type="<?=$user['type']?>"
                            data-profile_img="<?=$user['profile_img']?>"
                            > <i class="fa fa-pencil"></i></button>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger TogglerDeleteUser" data-admin_id="<?=$user['admin_id']?>"> <i class="fa fa-trash"></i></button>
                        </div>

                     

                    </td>
                </tr>
            <?php endwhile; ?>
                        
        </tbody>
    </table>
</div>

<!-- END  -->



</div>



<?php

include('../components/admin-footer.php');


?>


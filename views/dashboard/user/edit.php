<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Managements</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <?php if(isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error'] ?>
                </div>
            <?php endif; ?>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseEditUser" aria-expanded="true" aria-controls="collapseEditUser">
                Edit User
            </button>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsePasswordUser" aria-expanded="true" aria-controls="collapsePasswordUser">
                Change Password User
            </button>
            <div class="collapse mt-2" id="collapseEditUser">
                <form action="<?= url('/dashboard/user/'. $id .'/update') ?>" method="post">
                    <div class="form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= $user->email ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputname">Fullname</label>
                        <input type="text" class="form-control" id="inputname" placeholder="sung sang" name="name" value="<?= $user->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputRole">Roles</label>
                        <select id="inputRole" class="form-control" name="role">
                            <option <?= $user->role != 'user' ?: 'selected' ?> value="user">User</option>
                            <option <?= $user->role != 'admin' ?: 'selected' ?> value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="collapse mt-2" id="collapsePasswordUser">
                <form action="<?= url('/dashboard/user/'. $id .'/update?change=true') ?>" method="post">
                    <div class="form-group">
                        <label for="inputNewPassword">New Password</label>
                        <input type="password" class="form-control" id="inputNewPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

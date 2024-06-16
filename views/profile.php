<?php 
    $user = user();
?>

<div class="col-lg-8">
    <div class="container border mb-3 py-2 rounded">
        <h3 class="text-center mb-2">Change Photo Profile</h3>
        <div class="d-flex align-items-center justify-content-center">
            <img class="rounded-circle" style="height: 200px;width: 200px;" src="<?= asset($user->profile) ?>">
        </div>
        <?php if(isset($_SESSION['error']['profile'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error']['profile'] ?>
            </div>
        <?php endif; ?>
        <form action="<?= url('/user/profile/profile') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Photo profile</label>
                <input class="form-control" type="file" id="formFile" name="profile">
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
    <div class="container border mb-3 py-2 rounded">
        <h3 class="text-center mb-2">Change Profile</h3>
        <?php if(isset($_SESSION['error']['data'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error']['data'] ?>
            </div>
        <?php endif; ?>
        <form action="<?= url('/user/profile/data') ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" value="<?= $user->email ?>" placeholder="name@example.com" disabled>
            </div>
            <div class="mb-3">
                <label for="inputname" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputname" name="name" value="<?= $user->name ?>" placeholder="sungsang">
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
    <div class="container border mb-3 py-2 rounded">
        <h3 class="text-center mb-2">Change Password</h3>
        <?php if(isset($_SESSION['error']['password'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error']['password'] ?>
            </div>
        <?php endif; ?>
        <form action="<?= url('/user/profile/password') ?>" method="post">
            <div class="mb-3">
                <label for="inputoldpassword" class="form-label">Old Password</label>
                <input type="password" class="form-control" id="inputoldpassword" name="oldpassword" placeholder="********">
            </div>
            <div class="mb-3">
                <label for="inputnewpassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="inputnewpassword" name="password" placeholder="********">
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
</div>
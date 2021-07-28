<?php
require 'init.php';
if (!isset($_SESSION['user'])) {
    go('index.php');
    die();
}
if ($_SESSION['user']) {
    $user = $_SESSION['user'];
    $user = getOne("select * from users where id=?", [$user->id]);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $new_password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
    $old_password = $_REQUEST['old_password'];
    if (!$user) {
        setError('Email Not Found');
        go("edit.php");
        die();
    }
    if ($user) {
        $ver = password_verify($old_password, $user->password);
        if (!$ver) {
            setError("Wrong old Password");
            go("edit.php");
            die();
        }
    }
    if (!hasError()) {
        query("update users set name=?,email=?,password=? where id=?", [$name, $email, $new_password, $user->id]);
        setMsg("Updated users successfully");
        go('index.php');
        die();
    }
}
require 'include/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/argon-design-system.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <title>Hello, world!</title>
</head>

<body class="bg-dark">
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-4 offset-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">Edit User</div>
                    <div class="card-body text-white bg-dark">
                        <?php
                        showError();
                        showMsg();
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Enter User Name</label>
                                <input type="text" name="name" value="<?= $user->name; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Email</label>
                                <input type="email" value="<?= $user->email; ?>" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Enter New password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <input type="submit" name="update" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'include/footer.php';
    ?>
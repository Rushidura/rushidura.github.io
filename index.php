<?php

include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop</title>
    <!-- css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- logo-icon -->
    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="main-body">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to eShop!</p>
                    </div>
                </div>
            </div>
            <!-- header end -->

            <!-- content  -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>

                    <!-- signUpBox -->
                    <div class="col-12 col-lg-6 d-none" id="signUpBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02">Create New Account</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="msg">

                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="Ex: John" id="fname" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Ex: Doe" id="lname" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Ex: john@gmail.com" id="email" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="password" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" placeholder="Ex: 0771115558" id="mobile" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">
                                    <?php
                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $data = $rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $data["gender_id"]; ?>">
                                            <?php echo $data["gender_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signup();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">Already Have An Account? Sign In</button>
                            </div>
                        </div>
                    </div>
                    <!-- signUpBox end -->
                    <!-- signinBox -->
                    <div class="col-12 col-lg-6" id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv1">
                                <div class="alert alert-danger" role="alert" id="msg1">
                                </div>
                            </div>
                            <?php
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }
                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input value="<?php echo $email; ?>" type="email" class="form-control" id="email2" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input value="<?php echo $password; ?>" type="password" class="form-control" id="password2" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" />
                                    <label class="form-check-label fw-bold">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a class="link-primary fw-bold" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign in</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to eShop? Sign Up</button>
                            </div>
                            <div class="col-12 d-grid">
                                <button class="btn btn-success">Go To eShop Admins</button>
                            </div>
                        </div>
                    </div>
                    <!-- signinBox end -->

                </div>
            </div>
            <!-- content end -->

            <!-- modal -->
            <div class="modal min-body" tabindex="-1" id="fpmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" />
                                        <button class="btn btn-outline-danger" type="button" id="npb" onclick="showPassword1();"><i class='bi bi-eye-slash'></i></button>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rp" />
                                        <button class="btn btn-outline-danger" type="button" id="rpb" onclick="showPassword2();"><i class='bi bi-eye-slash'></i></button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-label">Verfication Code</div>
                                    <input type="text" class="form-control" id="vccode">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal end -->
                <!-- footer -->
                <div class="col-12 fixed-bottom">
                    <p class="text-center">&copy; 2024 eShop.lk || All Rights Reserves</p>
                    <p class="text-center fw-bold">Designed By : 2020 Rhino Batch</p>
                </div>
                <!-- footer end  -->

            </div>
        </div>

        <!-- script -->

        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>

</body>

</html>
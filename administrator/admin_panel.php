<?php
session_start();

if($_SESSION['user_name'] == ''){

    $_SESSION['exception'] = "Username/Password is wrong!";
    header("Location: ./index.php");

}

$header_title = $_GET['header_title'];

include_once("./header.php");
?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <!-- Approach -->
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Welcome to Admin Panel.....</h6>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->


<?php include_once("./footer.php");?>

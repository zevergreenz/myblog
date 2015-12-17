<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if (isset($_GET['Message'])) {
        echo "<script type='text/javascript'>alert(".$_GET['Message'].");</script>";
    }
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="static/css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">My Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-9">

                <h1 class="page-header">
                    Newest Blog posts
                    <small>Secondary Text</small>
                </h1>

                <?php
                    $user_name = "root";
                    $pass_word = "";
                    $database = "myblog";
                    $server = "127.0.0.1";
                    $tbl_name = "blogpost";

                    // Create connection
                    $conn = mysqli_connect($server, $user_name, $pass_word);
                    if (!$conn) {
                        die("Connection failed: ".mysqli_connect_error());
                    } 

                    $db_select = mysqli_select_db($conn, $database);
                    if (!$db_select) {
                        die("Database selection failed: ".mysqli_error());
                    }

                    $sql = "SELECT * FROM $tbl_name WHERE 1 ORDER BY time DESC";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_array($result)) {
                        echo '
                            <h2>
                                <a href="#">'.$row["title"].'</a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php">'.$row["writer"].'</a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on '.$row["time"].'</p>
                            <br>
                            <p>'.$row["content"].'</p>
                            <hr>';
                    }
                    mysqli_close($conn);
                ?>

                <!-- Pager -->
                <ul class="pager">      
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <!-- Blog Log in -->
				<div class="account-wall">
                    <?php 
                        if (!empty($_SESSION['username'])) {
                            echo "<p>Hello ".$_SESSION['username']."</p>"; 
                            echo '       
                            <form class="form-signin" action="http://localhost/myblog/model/logout.php" method="POST">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">
                                    Log out</button>
                                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                            </form>
                            <br>
                            <form class="form-signin" action="http://localhost/myblog/view/newpost.php" method="POST">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">
                                    New Post</button>
                            </form>';
                        } else {
                            echo '<p>You are not logged in </p>
                            <h4>Log in: </h4>
                            <form class="form-signin" action="model/login.php" method="POST">
                                <input type="text" class="form-control" placeholder="User name" name="ID" required autofocus>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">
                                    Sign in</button>
                                <label class="checkbox pull-left">
                                    <input type="checkbox" value="remember-me">
                                    Remember me
                                </label>
                                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                            </form>';
                        }
                    ?>
            	</div>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

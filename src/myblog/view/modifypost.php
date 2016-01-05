<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modify Blog Post</title>

    <!-- Bootstrap Core CSS -->
    <link href="/myblog/static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/myblog/static/css/blog-home.css" rel="stylesheet">

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
                <a class="navbar-brand" href="/myblog/index.php">My Blog</a>
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
                    Modify Blog Post
                    <!-- <small>Secondary Text</small> -->
                </h1>

                <?php 
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    if (!empty($_SESSION['username'])) {
                        echo '       
                        <form class="form-signin" action="../model/modify.php" method="POST">
                            <input type="hidden" name="title" value="'.$title.'">
                            <input type="hidden" name="content" value="'.$content.'">
                            <input type="text" class="form-control" name="newtitle" value="'.$title.'" required autofocus>
                            <br>
                            <textarea class="form-control" rows="20" name="newcontent">'.$content.'</textarea>
                            <br>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>
                        </form>';
                    } else {
                        echo '<p>You are not logged in </p>';
                    }
                ?>

                <hr>

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
                        include "../model/user.php";
                        login();
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

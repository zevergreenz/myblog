<?php 
	function login() {
		if (!empty($_SESSION['username'])) {
            echo "<p>Hello ".trim($_SESSION['username'], "'")."</p>"; 
            echo '       
            <form class="form-signin" action="/myblog/model/logout.php" method="POST">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Log out</button>
            </form>
            <br>
            <form class="form-signin" action="/myblog/view/newpost.php" method="POST">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    New Post</button>
            </form>';
        } else {
            echo '<p>You are not logged in </p>
            <h4>Log in: </h4>
            <form class="form-signin" action="/myblog/model/login.php" method="POST">
                <input type="text" class="form-control" placeholder="User name" name="ID" required autofocus>
                <br>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
            </form>
            <hr>
            <h4>Create new user: </h4>
            <form class="form-signin" action="/myblog/model/signup.php" method="POST">
                <input type="text" class="form-control" placeholder="User name" name="ID" required autofocus>
                <br>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign up</button>
            </form>';
        }
	}
?>
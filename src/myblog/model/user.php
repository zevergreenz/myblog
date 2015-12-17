<?php 
	function delete_post($title, $writer, $time, $content) {
		//==========================================
		//	CONNECT TO THE LOCAL DATABASE
		//==========================================
		$user_name = "root";
		$pass_word = "";
		$database = "myblog";
		$server = "127.0.0.1";
		$tbl_name = "blogpost";

		// Create connection
		$conn = mysqli_connect($server, $user_name, $pass_word, $database);
		if (!$conn) {
			die("Connection failed: ".mysqli_connect_error());
		}

		$sql = "DELETE FROM `blogpost` WHERE title=$title AND writer=$writer AND time=$time AND content=$content";

		if (mysqli_query($conn, $sql)) {
		    header("Location: http://localhost/myblog/index.php?Message='Detele Post Sucessful'");
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>
<?PHP
session_start();
$errorMessage = "";
//==========================================
//	ESCAPE DANGEROUS SQL CHARACTERS
//==========================================
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$title = $_POST['title'];
	$content = $_POST['content'];
	$newtitle = $_POST['newtitle'];
	$newcontent = $_POST['newcontent'];

	$title = htmlspecialchars($title);
	$content = htmlspecialchars($content);
	$newtitle = htmlspecialchars($newtitle);
	$newcontent = htmlspecialchars($newcontent);
	$writer = trim($_SESSION['username'],"'");

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

	$sql = "UPDATE $tbl_name SET title = '$newtitle', content = '$newcontent' WHERE title = '$title' AND content = '$content' AND writer = '$writer'";

	if (mysqli_query($conn, $sql)) {
	    header("Location: ../index.php?Message='Modify Sucessful'");
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}
?>
<?PHP
session_start();
$uname = "";
$pword = "";
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
	$uname = $_POST['ID'];
	$pword = $_POST['password'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$user_name = "blogacc";
	$pass_word = "blogacc";
	$database = "myblog";
	$server = "127.0.0.1";
	$tbl_name = "login";

	// Create connection
	$conn = mysqli_connect($server, $user_name, $pass_word, $database);
	if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	//Check if username exist
	$sql = "SELECT * FROM $tbl_name WHERE ID = '$uname'";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	echo $num_rows;

	if ($num_rows>0) {
		header("Location: /myblog/index.php?Message='Username alreadly exists. Please choose another username.'");
	} else if ((strpos($uname, ' ') !== false) || (strpos($uname, '&quot;') !== false) || (strpos($uname, '\'') !== false)) {
		header("Location: /myblog/index.php?Message='Username must not contain blank characters, double quotes and single quotes'");
	} else {
		$sql = "INSERT INTO $tbl_name(`ID`, `password`) VALUES ('$uname', '$pword')";

		if (mysqli_query($conn, $sql)) {
		    header("Location: /myblog/index.php?Message='Create User Sucessful'");
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	mysqli_close($conn);
}
?>
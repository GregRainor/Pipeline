<?php
require_once "config.php";
// Initialize the session
session_start();
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$type = $description = $dateachat = $prix = $fournisseur = "";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$searchby = trim($_POST["searchby"]);
	$search = trim($_POST["search"]);
	$count=0;
//	$sql = "INSERT INTO matos (type, description, dateachat, prix, fournisseur) VALUES (:type, :description, :dateachat, :prix, :fournisseur)";
	
	if ($searchby=="all"){
		$stmt = $pdo->query("SELECT * FROM users");
		while ($row = $stmt->fetch()) {
			echo "<br> ID: ". $row["id"]. " - First name: ". $row["firstname"]." - Last name: ". $row["lastname"]. "<br>";
			$count=1;
    }
}
	if ($searchby=="id"){
		$sql= "SELECT * FROM users"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			if ($row["id"]==$search){
				echo "<br> ID: ". $row["id"]. " - First name: ". $row["firstname"]." - Last name: ". $row["lastname"]. "<br>";
				$count=1;
			}			
		}
	}
	if ($searchby=="firstname"){
		$sql= "SELECT * FROM users"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			if ($row["firstname"]==$search){
				echo "<br> ID: ". $row["id"]. " - First name: ". $row["firstname"]." - Last name: ". $row["lastname"]. "<br>";
				$count=1;
			}			
		}
	}
	if ($searchby=="lastname"){
		$sql= "SELECT * FROM users"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			if ($row["lastname"]==$search){
				echo "<br> ID: ". $row["id"]. " - First name: ". $row["firstname"]." - Last name: ". $row["lastname"]. "<br>";
				$count=1;
			}			
		}
	}
	if ($count ==0){
		echo "No user found with these criteria";
	}

}	
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
     <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
		<script type="text/javascript" async="" src="./Authentication_files/recaptcha__fr.js.téléchargement"></script><script type="text/javascript" async="" src="./Authentication_files/recaptcha__fr.js(1).téléchargement"></script><script src="./Authentication_files/api.js.téléchargement" async="" defer=""></script>
		
		<!-- Custom Stylesheet -->
		<link href="./Authentication_files/css.css" rel="stylesheet" type="text/css">

			<link rel="stylesheet" href="./Authentication_files/animate.css">
			
			<link rel="stylesheet" href="./Authentication_files/style_ague.css">
			
			<script src="./Authentication_files/jquery.min.js.téléchargement"></script>    <meta charset="UTF-8">
    <title>Loan management</title>

</head>
<body>
    <div style="text-align:right; font-weight: normal;">
        <p>Logged in as : <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
    </div>	
	<div class="container" id="main">
		<div>				
			<h1 id="title" class="hidden"><span id="logo" class="animated fadeInDown">Loan management<span></span></span></h1>
		</div>											
			<div class="login-box animated fadeInUp">
		</br>
		<p>First name and last name format : uppercase on the first letter then lowercase</p>

		</br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Search by</label>
				<select id="searchby" name="searchby">
				<option value="id">ID</option>
				<option value="firstname">First name</option>
				<option value="lastname">Last name</option>
				<option value="all">All</option>
				</select>
				<input name="search" class="form-control" value="">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   
		
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>



				
			<p>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
			</p>
			<p>
			<a href="user.php" class="btn btn-danger">Return</a>
			</p>
			</div>

			</div>
			
		</div>
	
	
	

</body>
</html>
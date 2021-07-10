<?php
require_once "config.php";
// Initialize the session
session_start();
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = trim($_POST["id"]);
// verify that there is stuff with this id
	$nRows = $pdo->query("select count(*) from matos WHERE id = '$id'")->fetchColumn(); 
	if($nRows == 0){
	echo "There is no stuff with this id.";
	} else{
//	

//	$sql = "INSERT INTO matos (type, description, dateachat, prix, fournisseur) VALUES (:type, :description, :dateachat, :prix, :fournisseur)";
		$sql = "DELETE FROM matos WHERE id=:id";
			if($stmt = $pdo->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
				// Set parameters
				$param_id = $id;
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Redirect to login page
					echo "Element deleted";
				} else{
					echo "Something went wrong. Please try again later.";
				}

				// Close statement
				unset($stmt);		
			}
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
			<p>Please give the id of the element you want to delete.</p></br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>id</label>
                <input type="int" name="id" class="form-control" value="">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>					
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>



				
			<p>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
			</p>
			<p>
			<a href="matos.php" class="btn btn-danger">Return</a>
			</p>
			</div>

			</div>
			
		</div>
	
	
	

</body>
</html>
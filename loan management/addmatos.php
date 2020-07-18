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
	$type = trim($_POST["type"]);
	$description = trim($_POST["description"]);
	$dateachat = trim($_POST["dateachat"]);
	$prix = trim($_POST["price"]);
	$fournisseur = trim($_POST["provider"]);
	$sql = "INSERT INTO matos (type, description, dateachat, prix, fournisseur) VALUES (:type, :description, :dateachat, :prix, :fournisseur)";
        if($stmt = $pdo->prepare($sql)){
		    // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":type", $param_type, PDO::PARAM_STR);
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
			$stmt->bindParam(":dateachat", $param_dateachat, PDO::PARAM_STR);
			$stmt->bindParam(":prix", $param_prix, PDO::PARAM_INT);
			$stmt->bindParam(":fournisseur", $param_fournisseur, PDO::PARAM_STR);
            
            // Set parameters
            $param_type = $type;
			$param_description = $description;
			$param_dateachat = $dateachat;
			$param_prix = $prix;
			$param_fournisseur = $fournisseur;
			// Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo "Element added";
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);		
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

			<p>Please fill this form to add an element.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>type</label>
				<select id="type" name="type">
				<option value="phone">Phone</option>
				<option value="laptop">Laptop</option>
				</select>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   
			</br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>buying date</label>
                <input type="date" name="dateachat" class="form-control" value="<?php echo date("Y/m/d"); ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>price</label>
                <input type="int" name="price" class="form-control" value="">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>provider</label>
                <input type="varchar" name="provider" class="form-control" value="">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>description</label>
                <input type="varchar" name="description" class="form-control" value="">
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
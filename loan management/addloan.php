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
	$loanerid = trim($_POST["loanerid"]);
	$matosid = trim($_POST["matosid"]);
	$datedebut = trim($_POST["datedebut"]);
	$datefin = trim($_POST["datefin"]);
	$occupation = 1;


// search loaner name by id	
	$sql= "SELECT * FROM users"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row){
		if ($row["id"]==$loanerid){
			$loanername = $row["lastname"];
		}			
	}
	
	
//	

	$sql = "INSERT INTO loan (loanerid, loanername, matosid, datedebut, datefin) VALUES (:loanerid, :loanername, :matosid, :datedebut, :datefin)";
    if($stmt = $pdo->prepare($sql)){
	// Bind variables to the prepared statement as parameters
        $stmt->bindParam(":loanerid", $param_loanerid, PDO::PARAM_STR);
        $stmt->bindParam(":loanername", $param_loanername, PDO::PARAM_STR);
        $stmt->bindParam(":matosid", $param_matosid, PDO::PARAM_STR);
        $stmt->bindParam(":datedebut", $param_datedebut, PDO::PARAM_STR);  
        $stmt->bindParam(":datefin", $param_datefin, PDO::PARAM_STR);           
		
        // Set parameters
        $param_loanerid = $loanerid;
		$param_loanername = $loanername;
        $param_matosid = $matosid;
		$param_datedebut = $datedebut;
		$param_datefin = $datefin;
		// Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect to login page
            echo "Loan added";
        } else{
            echo "Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);		
	}
	$sql = "UPDATE matos SET occupation = 1 WHERE id = $matosid";	
	if($stmt = $pdo->prepare($sql)){
		$stmt->bindParam(":occupation", $param_occupation, PDO::PARAM_INT);
		$param_occupation = 1;
		if($stmt->execute()){
            // Redirect to login page
            echo "<br> Stuff occupation udpated";
        } else{
            echo "<br> Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
	}
	
	
	$sql = "UPDATE matos SET loueur =? WHERE id =? ";	
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$loanername, $matosid]);
	
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

			<p>Please fill this form to add a loan.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  
			</br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Loaner ID</label>
                <input type="loanerid" name="loanerid" class="form-control" value="">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Stuff ID</label>
                <input type="matosid" name="matosid" class="form-control" value="">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Starting date</label>
                <input type="datedebut" name="datedebut" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Ending date</label>
                <input type="datefin" name="datefin" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>



				
			<p>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
			</p>
			<p>
			<a href="pret.php" class="btn btn-danger">Return</a>
			</p>
			</div>

			</div>
			
		</div>
	
	
	

</body>
</html>
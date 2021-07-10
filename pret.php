<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
			<div >
				
			
					
				
				<h1 id="title" class="hidden"><span id="logo" class="animated fadeInDown">Loan management<span></span></span></h1>
			</div>
			
					
			
			<div class="login-box animated fadeInUp">
				
				</br></br>
				<button style="width:250px;" onclick="window.location.href='./searchloan.php';">
				search loan
				</button>
				</br></br></br>
				<button style="width:250px;" onclick="window.location.href='./addloan.php';">
				start loan
				</button>
				</br></br></br>
				<button style="width:250px;" onclick="window.location.href='./delloan.php';">
				end loan
				</button>
				</br>
				<p>
				<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
				</p>
				<p>
				<a href="welcome.php" class="btn btn-danger">Return</a>
				</p>
			</div>

			</div>
			
		</div>
	
	
	

</body>
</html>
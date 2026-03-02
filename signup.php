<?php
$message = "";

if(isset($_POST["signup"])){
    include_once "common/connection.php";

    //2) Collect data from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    

    //3 a)Check if the username is available to be used
    $getRecord = $connection->prepare('SELECT * FROM account WHERE (account_username = ?  OR account_email = ?) AND account_role=?');

    $getRecord->execute([$username,$email,$role]);

    //3 c)Collect the record retrieved from the table using the SQL
    $getRecordResult = $getRecord->fetch();

    if($getRecordResult){
          if ($getRecordResult['account_username'] === $username) {
            $message = "Account username already exists.";
        } else
        if ($getRecordResult['account_email'] === $email) {
            $message = "Email already exists.";
        } else {
            $message = "Account already exists.";
        }
    }
    
    else{
        //Encrypt the password
        $encrypted_pwd = password_hash($password,PASSWORD_DEFAULT);
        //insert the record
        $insertRecord = $connection->prepare('INSERT INTO account(account_username,account_email,account_password,account_role) VALUES(?,?,?,?)');


        $insertResult = $insertRecord->execute([$username,$email,$encrypted_pwd,$role]);

        if($insertResult){
           $message = "account created";
			
        }

        else{
            $message = "failed to create account";
        }

    }
}

?>
<!doctype html>
<html lang="en">
   <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Sign In</title>
        <link href="css/bootstrap.css" rel="stylesheet" >
     <link rel="stylesheet" href="css/style.css">        
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
    <style>
    .mySlides {display:none;}
    </style>
       
  </head>
  <body>
	  <nav class="navbar navbar-expand-lg bg-blue fixed-top" >
	<div class="container">
<a class=" navbar-brand title" href="index.php" ><img src="image/carat_craft_logo.png"
		  style="height: 30px" alt="logo">Carat Craft</a></div>
<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="offcanvas offcanvas-end " tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
<div class="offcanvas-header bg-blue">
	<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Carat Craft</h5>
	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body bg-blue">
	<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle rcorners1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			 About
			</a>
			<ul class="dropdown-menu bg-pink ">
			  <li><a class="dropdown-item" href="about/about.seventeen.php">Seventeen</a></li>
			  <li><a class="dropdown-item" href="about/seventeen_achievement.php">Seventeen's Achievement</a></li>

			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link active rcorners1 " aria-current="page" href="event/event.php">Event</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle rcorners1 " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			 Craft Categories
			</a>
			<ul class="dropdown-menu bg-pink">
			  <li><a class="dropdown-item dropdown_box" href="categories/keychain.php">Keychain</a></li>
			  <li><a class="dropdown-item dropdown_box" href="categories/poster.php">Poster</a></li>
				<li><a class="dropdown-item dropdown_box" href="categories/illustration.php">illustration</a></li>
			  <li><a class="dropdown-item dropdown_box" href="categories/other.php">Other</a></li>

			</ul>
		</li>
	   <li class="nav-item">
		<?php if (!isset($_SESSION['account_id'])): ?>
			<!-- 1. Not logged in -->
			<a class="nav-link active rcorners1" href="signin.php">Login/Register</a>

		<?php else: ?>
			<!-- 2 & 3. Logged in -->
			<a href="user/user_profile.php">
				<?php if (!empty($profile['profile_photo'])): ?>
					<!-- 3. Has uploaded photo -->
					<img src="<?= htmlspecialchars($profile['profile_photo']); ?>" 
						 alt="profile_image" 
						 style="width:40px; height:40px; border-radius:50%;">
				<?php else: ?>
					<!-- 2. No uploaded photo → default image -->
					<img src="image/default.png" 
						 alt="default_profile_image" 
						 style="width:40px; height:40px; border-radius:50%;">
				<?php endif; ?>
			</a>
		<?php endif; ?>
	</li>


	</ul>

  </div>
</div>
</nav>
	  <div style="height:70px"></div>
    <div class="container">
        <div class="row signinbox user-profile-box">
            <div class="col">
                <form id="signup_form" action="" method="post">
                    <h1>Sign Up</h1>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input 
                               type="text" 
                               class="form-control" 
                               id="username"   
                               name="username"
                               placeholder="Put your username here" required>
                    </div> 
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                               type="email" 
                               class="form-control" 
                               id="email"   
                               name="email"
                               placeholder="Put your email here"required >
                        
                    </div> 
                
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                               type="password" 
                               class="form-control" 
                               id="password"   
                               name="password"
                               placeholder="Put your password here" required>
                    </div> 
                    
                    <input type="hidden" id="role" name="role" value="DES">
                    <br>
                      <div class="d-flex justify-content-center align-items-center">
                        <input 
                            type="submit" 
                            id="signup" 
                            name="signup" 
                            class="btn center-button">
                    </div>

                    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
                    
                    
                </form>
            </div>
        </div>
         <div class="row">
            <img src="image/Footer_pic.png" class="img-fluid"  alt="footer_pic">
        
        </div>
      </div>
    <script src="js/bootstrap.bundle.min.js" >
      </script>
  </body>
</html>

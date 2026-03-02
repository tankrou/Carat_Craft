<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    $profile = getProfile($account_id, $connection);
}
else {
    header("Location: ../signin.php");
    exit();
}


if (!isset($_GET['event_id'])) {
    die("Invalid event ID");
}

$event_id = $_GET['event_id'];

// 取活动详情
$stmt = $connection->prepare("
    SELECT e.*, p.profile_name, p.profile_photo
    FROM event e
    JOIN profile p ON e.account_id = p.account_id
    WHERE e.event_id = ?
");
$stmt->execute([$event_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die("Event not found");
}

$message = "";

if (isset($_POST["signup"])) {
    $event_id = $_POST["event_id"];
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $phone    = $_POST["phone"];

    try {
        $stmt = $connection->prepare("
            INSERT INTO event_signup (event_id, name, email, phone) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$event_id, $name, $email, $phone]);
        $message = "✅ 你已成功报名！";
    } catch (Exception $e) {
        $message = "❌ 出现错误，请重试。";
    }
}


// 取照片
$photoStmt = $connection->prepare("SELECT photo_path FROM event_photo WHERE event_id = ?");
$photoStmt->execute([$event_id]);
$photos = $photoStmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Bootstrap demo</title>
        <link href="../css/bootstrap.css" rel="stylesheet" >
     <link rel="stylesheet" href="../css/style.css">        
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
    <style>
    .mySlides {display:none;}
    </style>
       
  </head>
  
  <body>
     
        <!-- nav start-->
  
 <nav class="navbar navbar-expand-lg bg-blue fixed-top" >
        <div class="container">
  <a class=" navbar-brand title" href="../index.php" ><img src="../image/carat_craft_logo.png"
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
                  <li><a class="dropdown-item" href="../about/about.seventeen.php">Seventeen</a></li>
                  <li><a class="dropdown-item" href="../about/seventeen_achievement.php">Seventeen's Achievement</a></li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link active rcorners1 " aria-current="page" href="../event/event.php">Event</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle rcorners1 " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Craft Categories
                </a>
                <ul class="dropdown-menu bg-pink">
                  <li><a class="dropdown-item dropdown_box" href="../categories/keychain.php">Keychain</a></li>
                  <li><a class="dropdown-item dropdown_box" href="../categories/poster.php">Poster</a></li>
                    <li><a class="dropdown-item dropdown_box" href="../categories/illustration.php">illustration</a></li>
                  <li><a class="dropdown-item dropdown_box" href="../categories/other.php">Other</a></li>

                </ul>
            </li>
           <li class="nav-item">
			<?php if (!isset($_SESSION['account_id'])): ?>
				<!-- 1. Not logged in -->
				<a class="nav-link active rcorners1" href="../signin.php">Login/Register</a>

			<?php else: ?>
				<!-- 2 & 3. Logged in -->
				<a href="../user/user_profile.php">
					<?php if (!empty($profile['profile_photo'])): ?>
						<!-- 3. Has uploaded photo -->
						<img src="../<?= htmlspecialchars($profile['profile_photo']); ?>" 
							 alt="profile_image" 
							 style="width:40px; height:40px; border-radius:50%;">
					<?php else: ?>
						<!-- 2. No uploaded photo → default image -->
						<img src="../image/default.png" 
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
   
      <!-- nav end-->
<div style="height: 70px;"></div>    
    
  <div class="container my-5">
  <div class="card shadow user-profile-box">
     <div class="card-header d-flex align-items-center" style="margin:0 -3%;">
	  <?php if (isset($_SESSION['account_id'])): ?>
		<!-- Logged in: link to user profile -->
		<a href="../user/user_profile.php?account_id=<?= $event['account_id']; ?>">
		  <img src="../<?= $event['profile_photo'] ?>" 
			   alt="User Photo" 
			   class="rounded-circle" 
			   style="width:70px; height:70px; object-fit:cover;">
		</a>

	  <?php else: ?>
		<!-- Not logged in: link to login page -->
		<a href="../signin.php">
		  <img src="../<?= $event['profile_photo'] ?>" 
			   alt="User Photo" 
			   class="rounded-circle" 
			   style="width:70px; height:70px; object-fit:cover;">
		</a>
	  <?php endif; ?>
	  <span class="ms-2"><?= $event['profile_name'] ?></span>
	</div>
	  
    <div class="card-body " style="padding-left:50px; padding-right:50px;">
      <h1 class="card-title"><?= htmlspecialchars($event['event_name']); ?></h1>
      <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']); ?></p>
      <p><strong>Venue:</strong> <?= htmlspecialchars($event['event_venue']); ?></p>
     
      <p class="card-text"><?= nl2br(htmlspecialchars($event['event_desc'])); ?></p>
    
     <div class="row ">
		  <?php if ($photos) { ?>   
			  <?php foreach ($photos as $p) { ?>
				<div class="col-md-4 mb-3">
				  <div style="width: 100%; aspect-ratio: 3/4; overflow: hidden;">
					<img src="../<?= htmlspecialchars($p['photo_path']); ?>" 
						 class="w-100 h-100 rounded" 
						 style="object-fit: cover;">
				  </div>
				</div>
			  <?php } ?>
		  <?php } ?>  
		</div>


      <hr>

      <!-- 报名表单 -->
			  <div class="event-container" style="padding:0 2%">
			  <h2>SIGN UP FOR THIS EVEN 𓂂𓈒𓏸 𓇼 ⭒˚ ✩*</h2>
			  <form action="event_signup.php" method="POST">
				<input type="hidden" name="event_id" value="<?= $event_id ?>">
				<div class="mb-3">
				  <label class="form-label">Your Name</label>
				  <input type="text" name="name" class="form-control" required>
				</div>
				<div class="mb-3">
				  <label class="form-label">Email</label>
				  <input type="email" name="email" class="form-control" required>
				</div>
				<div class="mb-3">
				  <label class="form-label">Phone</label>
				  <input type="text" name="phone" class="form-control">
				</div>
				 <div class="d-flex justify-content-center align-items-center">
                        <input 
                            type="submit" 
                            id="signup" 
                            name="signup" 
                            class="btn center-button">
                    </div>

                   <?php if (!empty($_GET["message"])): ?>
                    <div class="alert alert-info text-center">
                        <?= htmlspecialchars($_GET["message"]) ?>
                    </div>
                <?php endif; ?>
				  
			  </form>
			</div>
		
		 <h6>Posted on:<?= htmlspecialchars($event['event_time']); ?></h6>



        
    </div>
  </div>
</div>
	  <div style="height:40px;"></div>
	<footer class="site-footer">
  <div class="container-flex">
    <div class="row align-items-start">
      
      <!-- 左边：图片（小屏幕时占一行，上方显示） -->
      <div class="col-12 col-md-7 footer-logo mb-4 mb-md-0">
        <img src="../image/Footer_pic.png" alt="Seventeen Characters" class="img-fluid">
      </div>

      <!-- 右边：内容（小屏幕时在下方） -->
      <div class="col-12 col-md-5 footer-links ">
        <div class="footer-column">
			<a href="../index.php">
          <h3>Home</h3></a>
        </div>

        <div class="footer-column">
			<a href="../event/event.php">
          <h3>Event</h3></a>
        </div>

        <div class="footer-column">
          <h3>About </h3>
          <ul>
            <li><a href="../about/about.seventeen.php">Seventeen Info</a></li>
            <li><a href="../about/seventeen_achievement.php">Seventeen Achievement</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Categories</h3>
          <ul>
            <li><a href="../categories/keychain.php">Keychain</a></li>
            <li><a href="../categories/illustration.php">Illustration</a></li>
            <li><a href="../categories/poster.php">Poster</a></li>
            <li><a href="../categories/other.php">Other</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <?php if (!isset($_SESSION['account_id'])): ?>
				<!-- 1. Not logged in -->
				<a class=" active " href="../signin.php"><h3>Login/Register</h3></a>

			<?php else: ?>
				<!-- 2 & 3. Logged in -->
				<a href="../user/user_profile.php">
					<?php if (!empty($profile['profile_photo'])): ?>
						<!-- 3. Has uploaded photo -->
						<img src="../<?= htmlspecialchars($profile['profile_photo']); ?>" 
							 alt="profile_image" 
							 class="d-flex justify-content-end align-items-end nav-photo" style="width:80px; height:80px; border-radius:50%;border:1px solid #F9DCDE">
					<?php else: ?>
						<!-- 2. No uploaded photo → default image -->
						<img src="../image/default.png" 
							 alt="default_profile_image" 
							 class="d-flex justify-content-end align-items-end nav-photo" style="width:80px; height:80px; border-radius:50%;border:1px solid #F9DCDE">
					<?php endif; ?>
				</a>
			<?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</footer>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>



  </body>
</html>
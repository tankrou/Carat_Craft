<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    $profile = getProfile($account_id, $connection);
}


// 从 URL 获取 event_id
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    // 有输入关键字时，模糊查询
    $getRecord = $connection->prepare('SELECT event.*, profile.profile_photo, profile.profile_name
        FROM event
        LEFT JOIN profile ON event.account_id = profile.account_id
        WHERE event.event_name LIKE :search');
    $getRecord->execute([':search' => "%$search%"]);
} else {
    // 没输入时，显示全部
    $getRecord = $connection->prepare('SELECT event.*, profile.profile_photo, profile.profile_name
        FROM event
        LEFT JOIN profile ON event.account_id = profile.account_id');
    $getRecord->execute();
}
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

   
      
        <div class="w3-content w3-section" style="max-width:300%; align-item:center ;">
          <img class="mySlides" src="../image//EventUpSlide_photo1.jpg" style="width:100%">
          <img class="mySlides" src="../image//EventUpSlide_photo2.jpg" style="width:100%">
          <img class="mySlides" src="../image/EventUpSlide_photo3.jpg" style="width:100%">
        </div>
    
    <div class="albums-title" style="color: #ffffff;padding-top:50px;-webkit-text-stroke:0.5px black">🎧⋆˙♪⋆.✮ EVENT ✮⋆♪˙⋆˙🎧</div>
	  <div class="container my-4" style="	max-width: 50%;justify-content: center;margin: 0 auto;">
		  <form method="GET" action="event.php" class="d-flex">
			<input 
			  type="text" 
			  name="search" 
			  class="form-control me-2" 
			  placeholder="Search events..." 
			  value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
			<button type="submit" class="btn search-btn">Search</button>
			  <?php if (isset($_GET['search']) && $_GET['search'] !== ''): ?>
      		<a href="event.php" class="btn search-btn">Cancel</a>
    <?php endif; ?>
		  </form>
		</div>

        
        <div class="container">
         <?php 
			$events = $getRecord->fetchAll(PDO::FETCH_ASSOC);
			if ($events) {
				foreach ($events as $event) { 
			?>
            <div class="card mb-4 shadow-sm card-event " style="background:rgba(255, 255, 255, 0.62);border-radius:20px;">

              <div class="card-header d-flex align-items-center" style="margin:0 -2%">
					  <?php if (isset($_SESSION['account_id'])): ?>
						<!-- Logged in: link to user profile -->
						<a href="../user/user_profile.php?account_id=<?= $event['account_id']; ?>">
						  <img src="../<?= $event['profile_photo'] ?>" 
							   alt="User Photo" 
							   class="rounded-circle" 
							   style="width:57px; height:50px; object-fit:cover;">
						</a>
                
					  <?php else: ?>
						<!-- Not logged in: link to login page -->
						<a href="../signin.php">
						  <img src="../<?= $event['profile_photo'] ?>" 
							   alt="User Photo" 
							   class="rounded-circle" 
							   style="width:57px; height:50px; object-fit:cover;">
						</a>
					  <?php endif; ?>
					  <span class="ms-2"><?= $event['profile_name'] ?></span>
					</div>


              <!-- event photos -->
             <div class="row">
				 <div class="col-sm-7">
              <?php
                $photoStmt = $connection->prepare("SELECT photo_path FROM event_photo WHERE event_id = ?");
                $photoStmt->execute([$event["event_id"]]);
                $photos = $photoStmt->fetchAll(PDO::FETCH_ASSOC);

                if ($photos) {
                  echo '<div class="event-photos">';
                  $count = 0;
                  foreach ($photos as $p) {
                    if ($count >= 3) break;
                    echo '<div class="photo-box">
                            <img src="../'.htmlspecialchars($p["photo_path"]).'" alt="event photo">
                          </div>';
                    $count++;
                  }
                  echo '</div>';
                } else {
                  echo '<div class="event-photos">
                          <div class="photo-box">
                            <img src="../image/default_event.jpg" alt="default">
                          </div>
                        </div>';
                }
              ?>
              </div>
				 
             <div class="event-info col-sm-5 d-flex flex-column" >
              <div class="card-body">
               
                <h2 class="card-title" style="font-weight:bold;"><?= htmlspecialchars($event["event_name"]); ?></h2>
                <p class="card-text">
                  <strong>Date:</strong> <?= htmlspecialchars($event["event_date"]); ?><br>
                  <strong>Venue:</strong> <?= htmlspecialchars($event["event_venue"]); ?>
                </p>
                <p class="card-text"><?= nl2br(htmlspecialchars($event["event_desc"])); ?></p>
            
              </div>
          
		
             <div class="mt-auto d-flex justify-content-end ">
			  <?php if (isset($_SESSION['account_id'])): ?>
				<!-- User logged in -->
                <div class="d-flex justify-content-end " >
				<a href="event_details.php?event_id=<?= $event["event_id"]; ?>" 
				   class="btn btn-sm search-btn" style="width:150px;margin:20px;">View Details</a>
			  <?php else: ?>
				<!-- User not logged in -->
                   <div class="d-flex justify-content-end align-content-end" >
				<a href="../signin.php" 
				   class="btn  btn-sm search-btn" style="width:150px;margin:20px;">Login to View</a>
			  <?php endif; ?></div>
               </div>
          		</div>   
			</div>
        </div>
		<?php 
			} 
		} else { 
		?>
			<div class="alert alert-warning text-center">No events found.</div>
          
             <!-- 每一个 event 的 card -->
          <?php } ?>
          </div>
        </div>

       <script>
      /* When the user clicks on the button,
      toggle between hiding and showing the dropdown content */
      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }

      function filterFunction() {
        const input = document.getElementById("myInput");
        const filter = input.value.toUpperCase();
        const div = document.getElementById("myDropdown");
        const a = div.getElementsByTagName("a");
        for (let i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
          } else {
            a[i].style.display = "none";
          }
        }
      }
      </script>
       <!-- Side show start-->
       <script>
        var myIndex = 0;
        carousel();

        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 2000); // Change image every 2 seconds
        }
        </script>
     <!-- Side show end-->
    
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
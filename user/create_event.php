<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    $profile = getProfile($account_id, $connection);
}

$message = "";



$isOwnProfile = isset($_SESSION['account_id']) && $_SESSION['account_id'] == $account_id;

if(isset($_POST["upload"])) {
    include_once "../common/connection.php";

    $assumed_id   = $_SESSION["account_id"];
    $event_name   = trim($_POST["event_name"]);
    $event_date   = $_POST["event_date"];
    $event_venue  = trim($_POST["event_venue"]);
    $event_desc   = trim($_POST["event_desc"]);

    // Validate required fields
    if(empty($event_name) || empty($event_date) || empty($event_venue) || empty($event_desc)) {
        $message = "Please fill in all required fields.";
    } else {
        // Insert event only if all fields are filled
        $insertEvent = $connection->prepare('INSERT INTO event(account_id,event_name,event_date,event_venue,event_desc) VALUES(?,?,?,?,?)');
        $insertEvent->execute([$assumed_id, $event_name, $event_date, $event_venue, $event_desc]);

        // Get last inserted event_id
        $event_id = $connection->lastInsertId();

        // File upload code here (unchanged)...
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        $target_folder = "image/event/";

        foreach ($_FILES['event_photo']['name'] as $key => $filename) {
            if (!empty($filename)) {
                $file_tmp  = $_FILES['event_photo']['tmp_name'][$key];
                $file_ext  = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (in_array($file_ext, $allowed_ext)) {
                    $new_name = $target_folder . "event_" . time() . "_" . $key . "." . $file_ext;
                    if (move_uploaded_file($file_tmp, "../" . $new_name)) {
                        $insertPhoto = $connection->prepare('INSERT INTO event_photo(event_id, photo_path) VALUES(?, ?)');
                        $insertPhoto->execute([$event_id, $new_name]);
                    }
                }
            }
        }

        $message = "Event created successfully!";
    }
}


?>
<!doctype html>
<html lang="en">
   <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Bootstrap demo</title>
        <link href="../css/bootstrap.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css"> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
       <link rel="stylesheet" href="../css/style.css"> 
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
       
  </head>
  <body>

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
    <div style="height: 50px;"></div>   
        <div class="container-flex  " >
            <div class="row">
                        
                        <div class="col-sm-2 profile1">
                              <?php 
                                if(isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) {

                            ?>
                           
                             <?php if ($profile): ?>
                            <div class="image-box">
                           <img src="../<?= $profile["profile_photo"] ?>">
                            </div>
                            <?php endif; ?>
                            <div class="profile_nav">
                            
                            <a class="profile_btn" href="../user/user_profile.php">User Profile</a>
                          <div class="profile_nav">
							<?php if ($isOwnProfile): ?>
								<a class="profile_btn" href="../user/create_event.php">Create Event</a>
								<a class="profile_btn" href="../user/create_craft.php">Create Craft</a>
							  <a class="profile_btn" 
								 href="../logout.php">Logout</a>
							<?php endif; ?>
						</div>
                            
                             </div>
                             <?php
                               } 
                        ?>
                        </div>
                        <div class="col-sm-10 pr-box">
							 <br>
                           <?php 
                                if(isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) {

                            ?>
                             <div class="user-profile-box">  
								 <h2>Upload Event</h2>
                           <form id="upload_form" action="" method="post" enctype="multipart/form-data">
				  <div class="upload-container">

					<!-- LEFT: Upload Photo -->
					<div class="upload-box" style="height:350px; text-align:center;">
					  <label for="event_photo" class="upload-label" id="upload_label">
						<i class="fa fa-cloud-upload-alt upload-icon" id="upload_icon" style="margin-top:50px;"></i>
						<p id="upload_text" style="color:white;">UPLOAD PHOTO</p>
					  </label>
					  <input 
						type="file" 
						id="event_photo"   
						name="event_photo[]" 
						hidden
						multiple
						accept="image/*"/>

					  <!-- 预览容器 -->
					  <div id="preview_container" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px; justify-content:center;"></div>
					</div>

                      

                        <!-- RIGHT: Profile + Description + Dropdowns + Button -->
                            <div class="info-box">
                                <div class="mb-3">
                                <label for="event_name" class="form-label">Event Name</label>
                                    <input 
                                           type="text" 
                                           class="form-control" 
                                           id="event_name"   
                                           name="event_name"/>
                                </div>         


                                <div class="mb-3 ">
                                    <label for="event_date" >Event Date:</label>
                                    <input type="date" id="event_date" name="event_date" class="date-box">

                                 </div> 

                                <div class="mb-3">
                                    <label for="event_venue" class="form-label">Event Venue</label>
                                    <input 
                                           type="text" 
                                           class="form-control" 
                                           id="event_venue"   
                                           name="event_venue"/>
                                </div>


                                <div class="mb-3">
                                    <label for="event_desc" class="form-label">Event info</label>
                                    <input 
                                           type="text" 
                                           class="form-control" 
                                           id="event_desc"   
                                           name="event_desc"/>
                                </div> 
                                <input type="hidden" id="role" name="role" value="DES">

                                    <button 
                            type="submit" 
                            id="upload" 
                            name="upload" 
                            class="post-btn">POST</button>

                        </div>
                      </div>

                      <!-- Success / Error Messages -->
                      <?php if ($message): ?>
                        <div class="alert alert-info mt-2"><?= htmlspecialchars($message) ?></div>
                      <?php endif; ?>
                    </form>

                <?php
                           } 
                ?>

                    
                        </div>
					</div>
                </div>
        </div>
          
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
      
    <script src="js/bootstrap.bundle.min.js" ></script>
	  <script>
	  document.getElementById("event_photo").addEventListener("change", function(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById("preview_container");
    const icon = document.getElementById("upload_icon");
    const text = document.getElementById("upload_text");

    previewContainer.innerHTML = ""; // 清空上一次的预览

    if (files.length > 0) {
        icon.style.display = "none"; // 隐藏icon
        text.style.display = "none"; // 隐藏文字

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.width = "100px";
                img.style.height = "100px";
                img.style.objectFit = "cover";
                img.style.borderRadius = "8px";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    } else {
        // 如果取消选择，恢复原始状态
        icon.style.display = "block";
        text.style.display = "block";
    }
});

	  </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>

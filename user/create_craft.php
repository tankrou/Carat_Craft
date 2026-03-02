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

if(isset($_POST["upload"])){
    //1)make connection to database
    include_once "../common/connection.php";
    
    //2)check if there is file to upload
    if(empty($_FILES["post_photo"]["name"])){
        $message = "Please select a file to upload";
    }
    else{
        //3)to set the folder where u are to upload the file to
        $target_folder = "image/post/";
        
        //4)set the full path to the file on server
        //e.g. images/kairou.jpg
        $target_path = $target_folder . basename($_FILES["post_photo"]["name"]);
        $message = $target_path;
        
        //5)Set allowed file types
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        
        //6)Get the extension of the file to upload
        $file_ext = strtolower(pathinfo($target_path,PATHINFO_EXTENSION));
        
        $new_name = $target_folder . "craftpost_" . time() . "." . $file_ext;
        
        if(in_array($file_ext,$allowed_ext)){
            //upload
            //6a)Upload the file (Move file from memory of the server to actual location)
            if(move_uploaded_file($_FILES["post_photo"]["tmp_name"], "../" . $new_name)){
                //make connection
                include_once "../common/connection.php";
                //testing set account id =1
               $assumed_id = $_SESSION["account_id"];
                $post_desc = $_POST["post_desc"];
                $member_id = $_POST["member_id"] ; 
                $categories_id = $_POST["categories_id"] ; 
                
                //insert
                 $insertRecord = $connection->prepare('INSERT INTO post(account_id,post_desc,post_photo,member_id,categories_id) VALUES(?,?,?,?,?)');


               $insertResult = $insertRecord->execute([$assumed_id, $post_desc, $new_name, $member_id, $categories_id]);

                    if($insertResult){
                       $message = "portfolio info created";
                    }

                    else{
                        $message = "failed to create portfolio info";
                    }

                
                $message .= "File uploaded sucussfully";
            }
            else{
                $message = "Failed to upload file";
            }
        }
        else{
            $message = "File type not allowed";
        }
      
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
								 <h2>Upload Craft Photo</h2>
                           <form id="upload_form" action="" method="post" enctype="multipart/form-data">
				  <div class="upload-container">

					<!-- LEFT: Upload Photo -->
					<!-- 上传框 -->
					<div class="upload-box">
					  <label for="post_photo" class="upload-label" id="upload_label">
						<i class="fa fa-cloud-upload-alt upload-icon" id="upload_icon"></i>
						<p id="upload_text" style="color:white;">UPLOAD PHOTO</p>
						<!-- 预览图 -->
						<img id="preview" src="" alt="Preview" style="display:none; max-width:150px; margin-top:10px;">
					  </label>
					  <input 
						type="file" 
						id="post_photo"   
						name="post_photo" 
						accept="image/*"
						hidden>
					</div>


					<!-- RIGHT: Profile + Description + Dropdowns + Button -->
					<div class="info-box">
					  <!-- Profile Row -->
					       <div class="me-3  mb-2 ">
                        <a href="user_profile.php?account_id=<?= $post['account_id'] ?>">
                            <img src="../<?= $profile['profile_photo'] ?>" class="rounded-circle" style="width:57px;height:50px;object-fit:cover;">
                        </a>
                        <span><?= htmlspecialchars($profile['profile_name']) ?></span>
                    </div>

					  <!-- Description -->
					  <textarea 
						class="event-desc" 
						id="post_desc"   
						name="post_desc" 
						placeholder="Write about your craft..."></textarea>

					  <!-- Dropdowns -->
					  <div class="dropdown-row">
						<select id="categories_id" name="categories_id" class="dropdown-member">
						  <option value="1">Keychain</option>
						  <option value="2">Illustration</option>
						  <option value="3" selected>Poster</option>
						  <option value="4">Others</option>
						</select>

						<select id="member_id" name="member_id" class="dropdown-member">
						  <option value="1">Seventeen</option>
						  <option value="2">Mingyu</option>
						  <option value="3">Yoon Jeonghan</option>
						  <option value="4">Wonwoo</option>
						  <option value="5">Hoshi</option>
						  <option value="6">The8</option>
						  <option value="7">Woozi</option>
						  <option value="8">DK</option>
						  <option value="9">Joshua Hong</option>
						  <option value="10">Wen Junhui</option>
						  <option value="11">S.Coups</option>
						  <option value="12">Vernon</option>
						  <option value="13">Seungkwan</option>
						  <option value="14">Dino</option>
						</select>
					  </div>

					  <!-- Submit Button -->
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
	document.getElementById("post_photo").addEventListener("change", function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("preview");
    const icon = document.getElementById("upload_icon");
    const text = document.getElementById("upload_text");

    if (file) {
        // 显示预览图
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = "block"; // 显示图片
            icon.style.display = "none";     // 隐藏原来的 icon
            text.style.display = "none";     // 隐藏文字
        };
        reader.readAsDataURL(file);
    } else {
        // 如果取消选择 → 恢复初始状态
        preview.style.display = "none";
        icon.style.display = "block";
        text.style.display = "block";
    }
});
</script>
	  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>

<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

$profile = null;

if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    $profile = getProfile($account_id, $connection);
}

$posts = [];

$member_id = isset($_GET['member_id']) ? intval($_GET['member_id']) : null;
$category_id = 2; // Keychain

if ($member_id) {
    $stmt = $connection->prepare("
        SELECT post.*, profile.profile_photo, profile.profile_name,
               (SELECT COUNT(*) FROM post_like WHERE post_like.craft_post_id = post.craft_post_id) AS like_count
        FROM post
        LEFT JOIN profile ON post.account_id = profile.account_id
        WHERE post.member_id = ? AND post.categories_id = ?
 
    ");
    $stmt->execute([$member_id, $category_id]);
} else {
    $stmt = $connection->prepare("
        SELECT post.*, profile.profile_photo, profile.profile_name,
               (SELECT COUNT(*) FROM post_like WHERE post_like.craft_post_id = post.craft_post_id) AS like_count
        FROM post
        LEFT JOIN profile ON post.account_id = profile.account_id
        WHERE post.categories_id = ?
   
    ");
    $stmt->execute([$category_id]);
}

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
<div style="height: 70px;"></div>    	
<div class="container mt-4">
  
    <div class="keychain" style="padding:20px;">
         <h1 style="text-align: center; padding:8px; padding-bottom:20px;font-weight:bold;  color: #ffffff; -webkit-text-stroke:0.8px black; ">🎧⋆˙♪⋆✮ ILLUSTRATION ✮⋆♪˙⋆🎧</h1>
     <div class="row">
 
           <div class="col-sm-12">
            <div class="row">
                <?php foreach ($posts as $post): ?>
              <?php if ($post['categories_id'] == 2):  ?>
              

                <div class="col-md-3 px-3">
                  <div class="card mb-3 card-keychain">
                      <div class="card-header d-flex align-items-center">
								  <?php if (isset($_SESSION['account_id'])): ?>
									<!-- Logged in: link to user profile -->
									<a href="../user/user_profile.php?account_id=<?= $post['account_id']; ?>">
									  <img src="../<?= $post['profile_photo'] ?>" 
										   alt="User Photo" 
										   class="rounded-circle" 
										   style="width:57px; height:50px; object-fit:cover;">
									</a>
								  <?php else: ?>
									<!-- Not logged in: link to login page -->
									<a href="../signin.php">
									  <img src="../<?= $post['profile_photo'] ?>" 
										   alt="User Photo" 
										   class="rounded-circle" 
										   style="width:57px; height:50px; object-fit:cover;">
									</a>
								  <?php endif; ?>
								  <span class="ms-2"><?= $post['profile_name'] ?></span>
								</div>

                     <a href="../craft_post_details.php?craft_post_id=<?= $post['craft_post_id'] ?>">
                      <img src="../<?= $post['post_photo']; ?>" 
                            class="card-img-top" style="aspect-ratio: 3/4 ;object-fit:cover;width:80%;">
                    </a>

                     <div class="card-body" >
                        <p><?= $post['post_desc']; ?></p>
                      </div>
                    <div class="d-flex justify-content-end align-content-end" style=padding:12px;>
                         <?php if (isset($_SESSION['account_id'])): ?>
						  <!-- User logged in: show real like button -->
						  <button class="btn btn-outline-primary like-btn btn-sm" 
								  data-postid="<?= $post['craft_post_id']; ?>" 
								  data-owner="<?= $post['account_id']; ?>">
							<i class="bi bi-heart"></i>
							<span id="like-count-<?= $post['craft_post_id']; ?>">
							  <?= $post['like_count'] ?? 0 ?>
							</span>
						  </button>
						<?php else: ?>
						  <!-- User not logged in: show login button -->
						  <a href="../signin.php" class="btn btn-outline-primary btn-sm">
							Login to Like
						  </a>
						<?php endif; ?>
                    </div>
                    </div>
                </div>
              
              <?php endif; ?>
            <?php endforeach; ?>
            </div>
           </div>
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
    <script>
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".like-btn").forEach(button => {
    button.addEventListener("click", function() {
      const postId = this.dataset.postid;
      const postOwner = this.dataset.owner;
      const icon = this.querySelector("i"); // 找到里面的 <i> 图标

      fetch("../like.php?craft_post_id=" + postId + "&postOwner=" + postOwner)
        .then(response => response.json())
        .then(data => {
          if (data.status === "Liked") {
          
            icon.classList.remove("bi-heart");
            icon.classList.add("bi-heart-fill");
            this.classList.add("btn-primary");
            this.classList.remove("btn-outline-primary");
          } else if (data.status === "Unliked") {
        
            icon.classList.remove("bi-heart-fill");
            icon.classList.add("bi-heart");
            this.classList.add("btn-outline-primary");
            this.classList.remove("btn-primary");
          }

          // 更新数量
          document.getElementById("like-count-" + postId).innerText = data.likes;
        })
        .catch(err => console.error(err));
    });
  });
});
</script>
	<script>
document.querySelectorAll(".like-btn").forEach(button => {
  button.addEventListener("click", function () {
    <?php if (!isset($_SESSION['account_id'])): ?>
      // Not logged in → redirect to signin page
      window.location.href = "../signin.php";
    <?php else: ?>
      // Logged in → normal like function
      const postId = this.dataset.postid;
      const ownerId = this.dataset.owner;
      const likeCountSpan = document.getElementById("like-count-" + postId);

      fetch("like.php?craft_post_id=" + postId + "&account_id=" + ownerId)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            likeCountSpan.textContent = data.like_count;
          }
        });
    <?php endif; ?>
  });
});
</script>

	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();
include_once "../common/connection.php";
include_once "../common/nav_profile.php";

// 检查管理员
if (!isset($_SESSION["account_id"]) || strtoupper($_SESSION["account_role"]) !== "ADM") {
    header("Location: admin_signin.php");
    exit();
}

$account_id = $_SESSION["account_id"];

$getRecord = $connection->prepare("SELECT * FROM profile WHERE account_id = ?");
$getRecord->execute([$account_id]);
$profile = $getRecord->fetch(PDO::FETCH_ASSOC);

$per_page = 6;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start_from = ($page - 1) * $per_page;

// ✅ 搜索条件
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

$params = [];
$where = "";

if ($search !== "") {
    $where = "WHERE event.event_id = :search_id
              OR profile.profile_name LIKE :search_name";
    $params[":search_id"]   = $search;
    $params[":search_name"] = "%$search%";
}

// ✅ 查询事件 + 分页
$sqlEvent = "
    SELECT event.*, profile.profile_photo, profile.profile_name
    FROM event
    JOIN profile ON event.account_id = profile.account_id
    $where
    ORDER BY event.event_id DESC
    LIMIT :start_from, :per_page
";
$stmtEvent = $connection->prepare($sqlEvent);

// 绑定参数
foreach ($params as $key => $value) {
    $stmtEvent->bindValue($key, $value);
}
$stmtEvent->bindValue(":start_from", $start_from, PDO::PARAM_INT);
$stmtEvent->bindValue(":per_page", $per_page, PDO::PARAM_INT);
$stmtEvent->execute();
$eventPosts = $stmtEvent->fetchAll(PDO::FETCH_ASSOC);

// ✅ 统计总数
$countSql = "
    SELECT COUNT(*) 
    FROM event
    JOIN profile ON event.account_id = profile.account_id
    $where
";
$countStmt = $connection->prepare($countSql);
$countStmt->execute($params);
$totalAccounts = $countStmt->fetchColumn();
$totalPages = ceil($totalAccounts / $per_page);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Bootstrap demo</title>
        <link href="../css/bootstrap.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css"> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
				<a href="../admin/admin_profile.php">
					<?php if (!empty($profile['profile_photo'])): ?>
						<!-- 3. Has uploaded photo -->
						<img src="../<?= htmlspecialchars($profile['profile_photo']); ?>" 
							 alt="profile_image" 
							class="nav-photo" style="width:40px; height:40px; border-radius:50%;">
					<?php else: ?>
						<!-- 2. No uploaded photo → default image -->
						<img src="../image/default.png" 
							 alt="default_profile_image" 
							 class="nav-photo" style="width:40px; height:40px; border-radius:50%;">
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</li>

         
        </ul>
        
      </div>
  </div>
</nav>
 <div style="height: 50px;"></div> 
	 
        <div class="container-flex">
  <div class="row">
    <div class="col-sm-2 profile1">
      <?php 
      if (isset($_SESSION["account_id"]) && isset($_SESSION["account_username"])) {
          if (!empty($profile)) { ?>
            <div class="image-box">
              <img src="../<?= $profile["profile_photo"] ?>">
            </div>
          <?php } ?>

          <div class="profile_nav">
			<a class="profile_btn" href="admin_profile.php">Admin Profile</a>
			<a class="profile_btn" href="manage_user_account.php">Manage Account</a>
			<a class="profile_btn" href="manage_post.php">Manage Post</a>
			<a class="profile_btn" href="manage_event.php">Manage Event</a>
			<a class="profile_btn" href="../logout.php">Logout</a>
		</div>
      <?php } ?>
    </div>    

    <div class="col-sm-10 pr-box">
		<br>
		<div class="user-profile-box ">  
			<h2>Manage Event</h2>
			
		<div class="table-container">
			<form method="get" class="mb-3 d-flex">
				<input type="text" name="search" class="form-control me-2" 
					   placeholder="Search by event ID or profile name" 
					   value="<?= htmlspecialchars($search) ?>">
				<button type="submit" class="btn search-btn me-2">Search</button>
				<?php if ($search !== ''): ?>
					<a href="manage_event.php" class="btn search-btn">Cancel</a>
				<?php endif; ?>
			</form>

               <div class="tab-pane fade show active " id="event">
				<div class="row">
					<?php foreach ($eventPosts as $event): ?>
						<div class="col-mb-12 mb-3">
							<div class="card p-3 h-100" style="border-radius:10px;">
								<div class="d-flex flex-column flex-md-row justify-content-between align-items-start">

									<!-- User Photo + Name -->
									

									<div class="d-flex align-items-center mb-2 mb-md-0" style="min-width:120px;">
										<a href="../user/user_profile.php?account_id=<?= $event['account_id']; ?>">
											<img src="../<?= $event['profile_photo'] ?>" 
												 alt="User Photo" 
												 class="rounded-circle me-2"
												 style="width:57px; height:50px; object-fit:cover;">
										</a>
										<span><?= $event['profile_name'] ?></span>
									</div>


									<!-- Event Photos -->
									<div class="d-flex mb-2 mb-md-0 justify-content-center">
										<?php
										$photoStmt = $connection->prepare("SELECT photo_path FROM event_photo WHERE event_id = ?");
										$photoStmt->execute([$event["event_id"]]);
										$photos = $photoStmt->fetchAll(PDO::FETCH_ASSOC);

										if ($photos) {
											$count = 0;
											foreach ($photos as $p) {
												if ($count >= 3) break;
												echo '<img src="../'.htmlspecialchars($p["photo_path"]).'" alt="event photo" class="me-2" style="width:120px; aspect-ratio:3/4; object-fit:cover;">';
												$count++;
											}
										}
										?>
									</div>

									<!-- Event Info -->
									<div class=" mb-2 "  >
										<h5><strong>Event ID:</strong> <?= htmlspecialchars($event["event_id"]) ?></h5>
										<p><?= htmlspecialchars($event["event_name"]) ?></p>
										
										<p class="mb-1"><strong>Date:</strong> <?= htmlspecialchars($event["event_date"]) ?></p>
										<p class="mb-1"><strong>Venue:</strong> <?= htmlspecialchars($event["event_venue"]) ?></p>
									</div>

									<!-- Edit / Delete Buttons -->
									<div class="text-end mt-2">
										<!-- Edit icon -->
										<a href="edit_event.php?id=<?= $event['event_id'] ?>" class=" btn-sm btn-primary me-1" title="Edit">
											<i class="bi bi-pencil-square"></i>
										</a>

										<!-- Delete icon -->
										<a href="delete_event.php?id=<?= $event['event_id'] ?>" class=" btn-sm btn-danger me-1" onclick="return confirm('Are you sure?')" title="Delete">
											<i class="bi bi-trash-fill"></i>
										</a>

										<!-- Participants icon -->
										<a href="view_event_participants.php?event_id=<?= $event['event_id'] ?>" class=" btn-sm btn-info" title="Participants">
											<i class="bi bi-people-fill"></i>
										</a>
									</div>


								</div>
							</div>
						</div>
					<?php endforeach; ?>	
						</div>
					<nav>
				<ul class="pagination justify-content-end" >
					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
					<li class="page-item <?= ($i==$page)?'active':'' ?>" >
						<a class="page-link page-btn " href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
					</li>
				<?php endfor; ?>

				</ul>
			</nav>
		
          </div>
			</div>
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
       
    <script src="js/bootstrap.bundle.min.js" >
      </script>
  </body>
</html>

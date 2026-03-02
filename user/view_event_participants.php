<?php
include_once "../common/connection.php";

$event_id = $_GET['event_id'] ?? 0;

// Get event info
$eventStmt = $connection->prepare("SELECT event_name FROM event WHERE event_id = ?");
$eventStmt->execute([$event_id]);
$event = $eventStmt->fetch();

// Get participants
$signupStmt = $connection->prepare("SELECT * FROM event_signup WHERE event_id = ?");
$signupStmt->execute([$event_id]);
$participants = $signupStmt->fetchAll(PDO::FETCH_ASSOC);
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
                  <li><a class="dropdown-item" href="../about/about.seventeen.html">Seventeen</a></li>
                  <li><a class="dropdown-item" href="../about/seventeen_achievement.html">Seventeen's Achievement</a></li>

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
	<div class="container user-profile-box mt-4">
		<h1>Participants for Event:<strong> <?= htmlspecialchars($event['event_name']) ?></strong></h1>
		
		<div class="table-container" style="padding:20px">
		<?php if ($participants): ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($participants as $index => $p): ?>
						<tr>
							<td><?= $index + 1 ?></td>
							<td><?= htmlspecialchars($p['name']) ?></td>
							<td><?= htmlspecialchars($p['email']) ?></td>
							<td><?= htmlspecialchars($p['phone']) ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<p>No participants have signed up for this event yet.</p>
		<?php endif; ?>
		</div>
		<br>
		<a href="user_profile.php" class="btn search-btn mb-3">Back</a>
	</div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

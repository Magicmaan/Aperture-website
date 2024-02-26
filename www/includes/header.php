<div class="header-container">
	<div class="header">
		<div class="logo-container">
			<img class="icon" src="../icon.png">
			<p class="name unselectable">APERTURE</p>
		</div>
		<div class="buttons-container">
			<a href="../index.php" class="button button-large">Home</a>
			<?php
				

				if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) { //if logged in do this else that 
					echo '<a href="../dashboard.php" class="button button-large">Dashboard</a>';
					echo '<a href="../courses/courses.php" class="button button-large">Courses</a>';
				} else {
					echo '<a class="button button-large" href="enrol.php">Enrol</a>';
					echo '<a class="button button-large" href="login.php">Login</a>';
				}
			?>
			
			
			<?php
				
			?>

			</div>
			
			
			<div id = "pfp" class="button button-widget Profile-picture">
				<?php
					
					//$profilepictureURL = getPFP();
					
					//echo ("<img src=" . $profilepictureURL . ">");
				?>
			</div>
			<div class="button button-widget Settings">
				<i class="fa-regular fa-circle-user fa-2xl"></i>
			</div>
		
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
			var userID = 1;

			// Make AJAX request to getData.php
			$.ajax({
				url: 'scripts/JQuery/getimage.php?img=' + userID,
				type: 'POST',
				success: function(data){
					// Update the webpage with the returned data
					// Example: $('#result').html(data);
					console.log("boo");
					console.log(data);
					$('#pfp').css('background-image', 'url(' + data + ')');
				}
			});

	
</script>
;
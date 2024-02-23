
        <div class="header-container">
            <div class="header">
				<div class="logo-container">
					<img class="icon" src="../icon.png">
					<p class="name unselectable">APERTURE</p>
				</div>
				<div class="buttons-container">
					<a class="button button-large">Home</a>
					<?php
						session_start();
						$_SESSION["isLoggedIn"] = false; //dev shit
						if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) { //if logged in do this else that 
							echo '<a class="button button-large">Dashboard</a>';
						} else {
							echo '<a class="button button-large" href="enrol.php">Enrol</a>';
							echo '<a class="button button-large" href="login.php">Login</a>';
						}
					?>
					
					
					<div class="button button-widget" id="Profile-picture">
						<i class="fa-regular fa-circle-user"></i>
					</div>
					<div class="button button-widget" id="Settings">
						<i class="fa-regular fa-circle-user fa-2xl"></i>
					</div>
                
				</div>
            </div>
        </div>

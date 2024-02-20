
        <div id="header-container">
            <div id="header">
				<div id="logo-container">
					<img id="icon" src="../icon.png">
					<img id="name" src="./images/landing/icon.png">
				</div>
				<div id="buttons-container">
					<a id="button">Home</a>
					<?php
						session_start();
						$_SESSION["isLoggedIn"] = false;
						if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
							echo '<a id="button">Dashboard</a>';
						} else {
							echo '<a id="button">Enrol</a>';
							echo '<a id="button">Login</a>';
						}
					?>
                	
					
					
					<div id="button">Contact</div>
					<div id="button">Contact</div>
                
				</div>
            </div>
        </div>

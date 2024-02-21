
        <div id="header-container">
            <div id="header">
				<div id="logo-container">
					<img id="icon" src="../icon.png">
					<p id="name">APERTURE</p>
				</div>
				<div id="buttons-container">
					<a id="button">Home</a>
					<?php
						session_start();
						$_SESSION["isLoggedIn"] = false; //dev shit
						if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) { //if logged in do this else that 
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

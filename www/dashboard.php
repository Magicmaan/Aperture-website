<?php
	$pageTitle = "Simple VLE Homepage"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
	
?>

<body>
<div id="page-contents">
	<div id="page-header">
        <h1 id="page-title">Dashboard</h1>

    </div>

    <div class="card">
        <h2 class="card-title">Assignments</h2>
        <div class="card-contents card-subsection">
        
        </div>
        <div class="card-divider"></div>
        <div class="card-files card-subsection">
            <a href="default-pfp.png" download>Boo<a>
        </div>
    </div>


    <div class="card-divider-vport"></div>
    
    

    <div class="card">
        <h2 class="card-title">Assignments</h2>
        <div class="card-contents card-subsection">
        
        </div>
        <div class="card-divider"></div>
        <div class="card-subsection card-files">
            <a href="default-pfp.png" download>Boo<a>
        </div>
    </div>

</div>
</body>
<?php
	require_once("includes/footer.php");
	require_once("includes/postamble.php");
?>
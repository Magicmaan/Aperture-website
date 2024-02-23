<?php
	$pageTitle = "Simple VLE Homepage"; 
	require_once("includes/preamble.php");
	require_once("includes/header.php");
	require_once("includes/menu.php");
	require_once("scripts/functions.php");
	
?>

<body>
<div id="page-contents">
	<div id="page-header">
        <h1 id="page-title">Dashboard</h1>

    </div>

    <div id="card">
        <h2 id="card-title">Assignments</h2>
        <div id="card-contents" class="card-subsection">
        
        </div>
        <div id="card-divider"></div>
        <div id="card-files" class="card-subsection">
            <a href="default-pfp.png" download>Boo<a>
        </div>
    </div>


    <div id="card-divider" class="thick-divide"></div>
    
    

    <div id="card">
        <h2 id="card-title">Assignments 2</h2>
        <div id="card-files" class="card-subsection">
            <a href="default-pfp.png" download>Boo<a>
        </div>
        <div id="card-files" class="card-subsection">
            <a href="default-pfp.png" download>Boo<a>
        </div>
    </div>

</div>
</body>
<?php
	require_once("includes/footer.php");
	require_once("includes/postamble.php");
?>
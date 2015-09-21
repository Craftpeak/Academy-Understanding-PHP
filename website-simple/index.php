<?php
// set the page_title in the global scope
$page_title = "My Awesome Website";

include_once __DIR__ . "/header.php";

?>
<!-- main content -->
<div class="col-sm-9">
	<h1><?php echo $page_title; ?></h1>
	<main>
		<p>Welcome to my home page! This is where I do fun stuff.</p>
	</main>
</div>
<?php

include_once __DIR__ . "/sidebar.php";
include_once __DIR__ . "/footer.php";
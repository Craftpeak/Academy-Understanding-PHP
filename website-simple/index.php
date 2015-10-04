<?php
// set the page_title in the global scope
$page_title = "My Awesome Website";

// include our template functions
include_once __DIR__ . '/includes/functions.php';

get_header();
?>
<!-- main content -->
<div class="col-sm-9">
	<h1><?php echo $page_title; ?></h1>
	<main>
		<p>Welcome to my home page! This is where I do fun stuff.</p>
	</main>
</div>
<?php

get_sidebar();
get_footer();
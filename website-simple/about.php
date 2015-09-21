<?php
// set the page_title in the global scope
$page_title = "About Me";

include_once __DIR__ . "/header.php";

?>
<!-- main content -->
<div class="col-sm-9">
	<h1><?php echo $page_title; ?></h1>
	<main>
		<p>I do lots of stuff! Here is a short list of some things I like.</p>
		<ul>
			<li>Programming</li>
			<li>Dungeons &amp; Dragons</li>
			<li>Birds</li>
		</ul>
	</main>
</div>
<?php

include_once __DIR__ . "/sidebar.php";
include_once __DIR__ . "/footer.php";
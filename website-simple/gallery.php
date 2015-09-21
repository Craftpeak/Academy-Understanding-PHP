<?php
// set the page_title in the global scope
$page_title = "Gallery";

include_once __DIR__ . "/header.php";
?>
<!-- main content -->
<div class="col-sm-9">
	<h1><?php echo $page_title; ?></h1>
	<div class="row">
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/mountains-1s800.jpg"/></div>
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/mountains-2s800.jpg"/></div>
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/dog-1s800.jpg"/></div>
	</div>
	<div class="row">
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/ocean-1s800.jpg"/></div>
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/ocean-2s800.jpg"/></div>
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/ocean-3s800.jpg"/></div>
	</div>
	<div class="row">
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/bamboo-1s800.jpg"/></div>
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/surf-1s800.jpg"/></div>
		<div class="col-sm-4"><img class="img-responsive img-thumbnail" src="http://public.daggerhart.com/images/flower-1s800.jpg"/></div>
	</div>
</div>
<?php

include_once __DIR__ . "/sidebar.php";
include_once __DIR__ . "/footer.php";
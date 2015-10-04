<?php

// see if the contact form was submitted
if ( !empty( $_POST ) &&
     isset( $_POST['name'] ) &&
     isset( $_POST['email'] ) &&
     isset( $_POST['comment'] )
)
{

	// setup our email variables
	$to = 'jonathan@daggerhart.com';
	$subject =  "New contact form submission from {$_POST['name']}";
	$message = "{$_POST['comment']} \n\nFrom: {$_POST['name']} - {$_POST['email']}";

	// try to send the email
	$submission_success = mail( $to, $subject, $message );

	if ( $submission_success ) {
		// email successfully sent
		$submission_message = "Thank you for your submission!";
	}
	else {
		// email failed
		$submission_message = "There was a problem with your submission, please try again.";
	}

}

// set the page_title in the global scope
$page_title = "Contact Me";

// include our template functions
include_once __DIR__ . '/includes/functions.php';

get_header();
?>
<!-- main content -->
<div class="col-sm-9">
	<h1><?php echo $page_title; ?></h1>
	<main>

		<?php if ( isset( $submission_message ) ) { ?>

			<p class="alert alert-<?= $submission_success ? 'success' : 'danger'; ?>">
				<?php echo $submission_message; ?>
			</p>

		<?php } else { ?>


		<!-- Contact Form -->

		<form action="" method="post">
			<div class="form-group">
				<label for="name-field">Name: <span
						class="text-danger">*</span></label>

				<input type="text"
				       name="name"
				       id="name-field"
				       class="form-control" required>
			</div>

			<div class="form-group">
				<label for="email-field">Email: <span
						class="text-danger">*</span></label>

				<input type="email"
				       name="email"
				       id="email-field"
				       class="form-control" required>
			</div>

			<div class="form-group">
				<label for="comment-field">Message: <span
						class="text-danger">*</span></label>

				<textarea name="comment"
		                  id="comment-field"
		                  class="form-control"
		                  rows="8"
		                  required></textarea>
			</div>

			<button type="submit" class="btn btn-default">Submit</button>
		</form>

		<!-- end Contact form -->
		<?php } ?>
	</main>
</div>
<?php

get_sidebar();
get_footer();
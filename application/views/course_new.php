<html>
<head>
	<title>Courses - New</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#new_course').submit(function(){
				var form = $(this);
				$.post(form.attr('action'), form.serialize(), function(data){
					console.log(data);
					if(data.status)
						form.parent().next().next().prepend(data.html);
				}, 'json');
				return false;
			});

			$('#accordion').on("click", ".delete_course button", function(event){
				var form = $(this).parent();
				$.post(form.attr('action'), form.serialize(), function(data){
					console.log(data);
					if(data.status)
						form.parent().parent().parent().fadeOut();
				}, 'json');

				event.preventDefault();
			});

		});
	</script>
</head>
<body>
	<div class="span4 well">
	    <form action="courses/course_new" method="post" id="new_course">
	    	<input type="text" name="title" placeholder="Title" required>
	    	<input type="hidden" name="form_action" value="create_course">
	        <textarea class="span4" id="description" name="description"
	        placeholder="Description" rows="5" required></textarea>
	        <button class="btn btn-info" type="submit">Submit</button>
	    </form>
	</div>
	<div style="clear: both;"></div>

	<div class="accordion span8" id="accordion">
<? 	foreach($courses as $course) 
	{ ?>
		<div class="accordion-group">
			<div class="accordion-heading" id="course_group<?= $course['id']; ?>">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#course<?= $course['id']; ?>"><?= $course['title']; ?></a>
			</div>
			<div id="course<?= $course['id']; ?>" class="accordion-body collapse">
				<div class="accordion-inner">
					<p><?= $course['description']; ?></p>
					<form action="courses/delete_course" method="post" class="delete_course pull-right">
						<input type="hidden" name="form_action" value="delete_course">
						<input type="hidden" name="course_id" value="<?= $course['id']; ?>">
						<button class="delete">delete</button> 
					</form>
					<form action="courses/delete_course" method="post" class="pull-right">
						<input type="hidden" name="form_action" value="delete_course">
						<input type="hidden" name="course_id" value="<?= $course['id']; ?>">
						<input type="hidden" name="course_title" value="<?= $course['title']; ?>">
						<input type="hidden" name="course_description" value="<?= $course['description']; ?>">
						<button class=" edit" style="margin-right: 5px;">edit</button>
					</form>
				</div>
			</div>
		</div>
<? 	} ?>
	</div>
</body>
</html>
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

	<div class="accordion span8" id="accordion2">
<? 		foreach($courses as $course) 
		{ ?>
			<div class="accordion-group">
				<div class="accordion-heading" id="course_group<?= $course['id']; ?>">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#course<?= $course['id']; ?>"><?= $course['title']; ?></a>

				</div>
				<div id="course<?= $course['id']; ?>" class="accordion-body collapse">
					<div class="accordion-inner">
						<p><?= $course['description']; ?></p>
						<p><a href="" class="pull-right">delete</a> <a href="" class="pull-right" style="margin-right: 5px;">edit</a></p>
					</div>
				</div>
			</div>
<? 		} ?>
	</div>
</body>
</html>
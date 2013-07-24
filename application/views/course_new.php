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

			$('.edit').click(function(){
				var edit = $(this);
				var description_text = edit.parent().siblings().text();
				var description_location = edit.parent().siblings();
				var title_text = edit.parent().parent().parent().siblings().children().text();
				var title_location = edit.parent().parent().parent().siblings().children();


				if (title_location[0]['localName'] == 'a' && description_location[0]['localName'] == 'p')
				{
					description_location.html($('<textarea />',{'value' : description_text}).val(description_text));
					title_location.html($('<input />', {'value' : title_text}).val(title_text));
					edit.text("Save");					
				}
				else
				{
					description_location.html($('<p />',{'value' : description_text}).val(description_text));
					title_location.html($('<a>', {'value' : title_text}).val(title_text));
					edit.text("Save");						
				}


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
						<p><button class="pull-right delete">delete</button> <button class="pull-right edit" style="margin-right: 5px;">edit</button></p>
					</div>
				</div>
			</div>
<? 		} ?>
	</div>
</body>
</html>
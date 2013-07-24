<html>
<head>
	<title>Courses - New</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>
</head>
<body>
	<div class="span4 well">
	    <form action="courses/course_new" method="post">
	    	<input type="text" name="title" placeholder="Title" required>
	    	<input type="hidden" name="form_action" value="create_course">
	        <textarea class="span4" id="description" name="description"
	        placeholder="Description" rows="5" required></textarea>
	        <button class="btn btn-info" type="submit">Submit</button>
	    </form>
	</div>
	<div style="clear: both;"></div>
	<div class="accordion span8" id="accordion2">
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
	        Collapsible Group Item #1
	      </a>
	    </div>
	    <div id="collapseOne" class="accordion-body collapse in">
	      <div class="accordion-inner">
	        Anim pariatur cliche...
	      </div>
	    </div>
	  </div>
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
	        Collapsible Group Item #2
	      </a>
	    </div>
	    <div id="collapseTwo" class="accordion-body collapse">
	      <div class="accordion-inner">
	        Anim pariatur cliche...
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>
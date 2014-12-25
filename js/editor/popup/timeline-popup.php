<?php
	require_once('../../../../../../wp-load.php');
?>
<!DOCTYPE html>
<head>
	<title>Timeline</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="../tiny_mce_popup.js"></script>
	<link rel="stylesheet" href="../../../styles/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../../../icons/icons.css">

	<style type="text/css">
		label { font-size: 12px; }
		input[type="text"] { padding: 5px; height: 25px; }
		.vimeo {
			border: 1px solid #ccc;
			overflow: hidden;
			background-color: #000;
			background-position: center;
			background-repeat: no-repeat;
			background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMTQwIDQwIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE0MHB4IiBoZWlnaHQ9IjQwcHgiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaW5ZTWluIG5vbmUiPgoJPGc+CgkJPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTMxLjI3NywxOC44MzJjLTAuMTQsMy4wNTItMi4yNyw3LjIyOS02LjM5LDEyLjUzMWMtNC4yNTksNS41MzYtNy44NjMsOC4zMDYtMTAuODExLDguMzA2Yy0xLjgyNSwwLTMuMzcxLTEuNjg3LTQuNjMzLTUuMDU5Yy0wLjg0My0zLjA5Mi0xLjY4Ni02LjE4NS0yLjUyOS05LjI3NWMtMC45MzgtMy4zNzItMS45NDMtNS4wNi0zLjAxOS01LjA2Yy0wLjIzNCwwLTEuMDU0LDAuNDk0LTIuNDU4LDEuNDc3bC0xLjQ3NC0xLjkwMWMxLjU0Ni0xLjM1OCwzLjA3MS0yLjcxNyw0LjU3Mi00LjA3OGMyLjA2Mi0xLjc4MywzLjYwOS0yLjcyLDQuNjQyLTIuODE0YzIuNDM4LTAuMjM0LDMuOTM4LDEuNDMzLDQuNTAyLDUuMDAxYzAuNjA4LDMuODUxLDEuMDMsNi4yNDYsMS4yNjYsNy4xODJjMC43MDQsMy4xOTUsMS40NzYsNC43OTEsMi4zMjEsNC43OTFjMC42NTcsMCwxLjY0MS0xLjAzNywyLjk1NC0zLjEwOGMxLjMxMi0yLjA3MiwyLjAxNS0zLjY0OSwyLjEwOS00LjczMmMwLjE4OC0xLjc4OS0wLjUxNi0yLjY4Ni0yLjEwOS0yLjY4NmMtMC43NSwwLTEuNTIyLDAuMTczLTIuMzE4LDAuNTE0YzEuNTQtNS4wNDQsNC40ODEtNy40OTUsOC44MjMtNy4zNTVDMjkuOTQ1LDEyLjY2MSwzMS40NjIsMTQuNzUsMzEuMjc3LDE4LjgzMnoiLz4KCQk8cGF0aCBmaWxsPSIjZmZmIiBkPSJNNTAuNjEzLDI4LjcxM2MtMS4zMTMsMi40ODQtMy4xMTksNC43MzMtNS40MTcsNi43NDhjLTMuMTQzLDIuNzE4LTYuMjg1LDQuMDc2LTkuNDI1LDQuMDc2Yy0xLjQ1NiwwLTIuNTctMC40NjktMy4zNDMtMS40MDZjLTAuNzczLTAuOTM4LTEuMTM3LTIuMTUzLTEuMDktMy42NTNjMC4wNDUtMS41NDgsMC41MjYtMy45MzgsMS40NDEtNy4xNzNjMC45MTQtMy4yMzIsMS4zNzMtNC45NjcsMS4zNzMtNS4yMDFjMC0xLjIxOC0wLjQyMy0xLjgyOC0xLjI2Ni0xLjgyOGMtMC4yODIsMC0xLjA3OSwwLjQ5NC0yLjM5MywxLjQ3N2wtMS42MTgtMS45MDFjMS41MDEtMS4zNTgsMy4wMDEtMi43MTcsNC41MDItNC4wNzhjMi4wMTctMS43ODMsMy41MTgtMi43Miw0LjUwNC0yLjgxNGMxLjU0Ni0wLjE0LDIuNjg0LDAuMzE0LDMuNDExLDEuMzY3YzAuNzI2LDEuMDUyLDAuOTk2LDIuNDE3LDAuODEsNC4wOThjLTAuNjEsMi44NTItMS4yNjgsNi40NzItMS45NzIsMTAuODY0Yy0wLjA0NiwyLjAxLDAuNjgxLDMuMDE0LDIuMTgyLDMuMDE0YzAuNjU2LDAsMS44MjctMC42OTMsMy41MTgtMi4wODNjMS40MDYtMS4xNTYsMi41NTUtMi4yNDMsMy40NDctMy4yNjJMNTAuNjEzLDI4LjcxM3ogTTQ0LjQ5MywzLjY5N2MtMC4wNDcsMS4xNjgtMC42MzMsMi4yODgtMS43NiwzLjM2MWMtMS4yNjYsMS4yMTItMi43NjcsMS44Mi00LjUwMSwxLjgyYy0yLjY3MiwwLTMuOTYzLTEuMTY2LTMuODY5LTMuNDk5YzAuMDQ1LTEuMjEzLDAuNzYtMi4zODEsMi4xNDQtMy41MDFjMS4zODQtMS4xMTksMi45MTktMS42OCw0LjYwOS0xLjY4YzAuOTg0LDAsMS44MDUsMC4zODcsMi40NjIsMS4xNTVDNDQuMjM0LDIuMTI1LDQ0LjUzOSwyLjkwNiw0NC40OTMsMy42OTd6Ii8+CgkJPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTk0LjU0MywyOC43MTNjLTEuMzE0LDIuNDg0LTMuMTE3LDQuNzMzLTUuNDE2LDYuNzQ4Yy0zLjE0NSwyLjcxOC02LjI4NSw0LjA3Ni05LjQyNiw0LjA3NmMtMy4wNTEsMC00LjUyNy0xLjY4Ny00LjQzMi01LjA2YzAuMDQ1LTEuNTAxLDAuMzM4LTMuMzA2LDAuODc3LTUuNDE1YzAuNTM5LTIuMTA4LDAuODMyLTMuNzQ4LDAuODc5LTQuOTIxYzAuMDQ5LTEuNzc5LTAuNDkyLTIuNjczLTEuNjIzLTIuNjczYy0xLjIyMywwLTIuNjgyLDEuNDU2LTQuMzc1LDQuMzYyYy0xLjc4OCwzLjA1LTIuNzU0LDYuMDAzLTIuODk0LDguODYxYy0wLjA5NSwyLjAyLDAuMTAzLDMuNTY4LDAuNTkyLDQuNjQ1Yy0zLjI3MiwwLjA5Ni01LjU2NS0wLjQ0NC02Ljg3My0xLjYxN2MtMS4xNzEtMS4wMzItMS43MDgtMi43NDItMS42MTQtNS4xMzVjMC4wNDUtMS41MDEsMC4yNzYtMy4wMDEsMC42OS00LjUwMmMwLjQxNC0xLjUsMC42NDQtMi44MzcsMC42OS00LjAxMWMwLjA5NS0xLjczNC0wLjU0LTIuNjA0LTEuOS0yLjYwNGMtMS4xNzcsMC0yLjQ0NCwxLjMzOS0zLjgwNiw0LjAxMWMtMS4zNjEsMi42NzMtMi4xMTMsNS40NjUtMi4yNTMsOC4zNzFjLTAuMDk0LDIuNjI3LDAuMDc0LDQuNDU2LDAuNTAzLDUuNDg2Yy0zLjIxOSwwLjA5Ni01LjUwNS0wLjU4Mi02Ljg1Ny0yLjAzNWMtMS4xMjItMS4yMTQtMS42MzQtMy4wNi0xLjUzOS01LjU0YzAuMDQ0LTEuMjE0LDAuMjU4LTIuOTExLDAuNjQ1LTUuMDg0YzAuMzg2LTIuMTc1LDAuNjAzLTMuODcsMC42NDctNS4wODdjMC4wOTMtMC44NDEtMC4xMTktMS4yNjMtMC42MzMtMS4yNjNjLTAuMjgxLDAtMS4wNzksMC40NzUtMi4zOTMsMS40MjRsLTEuNjg3LTEuOTAxYzAuMjM0LTAuMTg0LDEuNzEtMS41NDUsNC40MzItNC4wNzhjMS45NjktMS44MjgsMy4zMDYtMi43NjYsNC4wMDktMi44MTJjMS4yMTktMC4wOTUsMi4yMDQsMC40MDksMi45NTQsMS41MTFzMS4xMjYsMi4zOCwxLjEyNiwzLjgzNGMwLDAuNDY5LTAuMDQ3LDAuOTE1LTAuMTQsMS4zMzZjMC43MDMtMS4wNzcsMS41MjMtMi4wMTcsMi40NjMtMi44MTRjMi4xNTYtMS44NzQsNC41NzItMi45MzEsNy4yNDUtMy4xNjZjMi4yOTgtMC4xODcsMy45MzgsMC4zNTIsNC45MjUsMS42MTdjMC43OTUsMS4wMzMsMS4xNywyLjUxMSwxLjEyNSw0LjQzM2MwLjMyOS0wLjI4LDAuNjgxLTAuNTg2LDEuMDU2LTAuOTE1YzEuMDc4LTEuMjY3LDIuMTMzLTIuMjczLDMuMTY0LTMuMDIzYzEuNzM2LTEuMjY3LDMuNTQxLTEuOTcsNS40MTgtMi4xMTJjMi4yNS0wLjE4NywzLjg2NywwLjM1LDQuODUyLDEuNjExYzAuODQ0LDEuMDI4LDEuMjE5LDIuNSwxLjEyNyw0LjQxNWMtMC4wNDcsMS4zMDktMC4zNjMsMy4yMTMtMC45NDksNS43MTJjLTAuNTg4LDIuNTAxLTAuODc5LDMuOTM2LTAuODc5LDQuMzFjLTAuMDQ5LDAuOTgyLDAuMDQ3LDEuNjU5LDAuMjc5LDIuMDM0YzAuMjM2LDAuMzczLDAuNzk3LDAuNTU5LDEuNjg5LDAuNTU5YzAuNjU2LDAsMS44MjYtMC42OTMsMy41MTgtMi4wODNjMS40MDYtMS4xNTYsMi41NTUtMi4yNDMsMy40NDctMy4yNjJMOTQuNTQzLDI4LjcxM3oiLz4KCQk8cGF0aCBmaWxsPSIjZmZmIiBkPSJNMTIwLjkyMiwyOC42NDJjLTEuMzYxLDIuMjQ5LTQuMDMzLDQuNDk1LTguMDIsNi43NDNjLTQuOTcxLDIuODU2LTEwLjAxMiw0LjI4NC0xNS4xMjUsNC4yODRjLTMuNzk3LDAtNi41Mi0xLjI2Ny04LjE2LTMuNzk3Yy0xLjE3Mi0xLjczNS0xLjczNC0zLjc5Ny0xLjY4OC02LjE4OWMwLjA0NS0zLjc5NywxLjczNi03LjQwNyw1LjA2NC0xMC44MzJjMy42NTgtMy43NSw3Ljk3My01LjYyNywxMi45NDUtNS42MjdjNC41OTYsMCw3LjAzMywxLjg3Myw3LjMxNCw1LjYxNWMwLjE4OCwyLjM4NC0xLjEyNSw0Ljg0Mi0zLjkzOCw3LjM2OGMtMy4wMDQsMi43Ni02Ljc4MSw0LjUxNS0xMS4zMjgsNS4yNjNjMC44NDIsMS4xNjksMi4xMDksMS43NTIsMy43OTksMS43NTJjMy4zNzUsMCw3LjA1OS0wLjg1NSwxMS4wNDUtMi41NzRjMi44NTktMS4yMDcsNS4xMTEtMi40NjEsNi43NTQtMy43NkwxMjAuOTIyLDI4LjY0MnogTTEwNC45NTMsMjEuMjk3YzAuMDQ1LTEuMjU5LTAuNDY5LTEuODktMS41NDctMS44OWMtMS40MDYsMC0yLjgzLDAuOTY5LTQuMjgzLDIuOTA2Yy0xLjQ1MSwxLjkzNi0yLjIwMSwzLjc4OS0yLjI0OCw1LjU2MmMtMC4wMjUsMC0wLjAyNSwwLjMwNSwwLDAuOTExYzIuMjk1LTAuODM5LDQuMjg3LTIuMTIyLDUuOTcxLTMuODQ5QzEwNC4yMDMsMjMuNDQ2LDEwNC45MDYsMjIuMjMsMTA0Ljk1MywyMS4yOTd6Ii8+CgkJPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE0MC4wMTgsMjMuOTI2Yy0wLjE4OSw0LjMxLTEuNzgxLDguMDMxLTQuNzgzLDExLjE2OWMtMy4wMDIsMy4xMzctNi43Myw0LjcwNi0xMS4xODYsNC43MDZjLTMuNzA1LDAtNi41Mi0xLjE5NS04LjQ0MS0zLjU4NWMtMS40MDQtMS43NzctMi4xODItNC4wMDEtMi4zMi02LjY2OGMtMC4yMzYtNC4wMjksMS4yMTctNy43MjksNC4zNjEtMTEuMTAxYzMuMzc3LTMuNzQ2LDcuNjE5LTUuNjE4LDEyLjczMi01LjYxOGMzLjI4MSwwLDUuNzY2LDEuMTAyLDcuNDU3LDMuMzAxQzEzOS40MzIsMTguMTQ1LDE0MC4xNTgsMjAuNzQ0LDE0MC4wMTgsMjMuOTI2eiBNMTMyLjA2OCwyMy42NjJjMC4wNDctMS4yNjktMC4xMjktMi40MzQtMC41MjctMy40OWMtMC40LTEuMDU3LTAuOTc1LTEuNTg3LTEuNzI1LTEuNTg3Yy0yLjM5MSwwLTQuMzYxLDEuMjkzLTUuOTA2LDMuODc3Yy0xLjMxNiwyLjExNS0yLjAyLDQuMzcxLTIuMTExLDYuNzY2Yy0wLjA0OSwxLjE3NiwwLjE2NCwyLjIxLDAuNjMzLDMuMTA0YzAuNTE0LDEuMDMyLDEuMjQyLDEuNTQ5LDIuMTgyLDEuNTQ5YzIuMTA5LDAsMy45MTQtMS4yNDQsNS40MTYtMy43MzVDMTMxLjI5NywyOC4wNzgsMTMxLjk3NSwyNS45MTYsMTMyLjA2OCwyMy42NjJ6Ii8+Cgk8L2c+Cjwvc3ZnPg==);
		}
		#vimeo-view { font-size: 20px; cursor: pointer; color: #000; }
		#vimeo-view:hover { text-decoration: none; }


	</style>

	<script type="text/javascript">

		// ----------------------------------------------------
		// Timeline dialog script
		// ----------------------------------------------------
		var TimeDialog = {
			local_ed : 'ed',
			init : function(ed) {
				TimeDialog.local_ed = ed;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert : function insertTime(ed) {

				// Try and remove existing style / blockquote
				tinyMCEPopup.execCommand('mceRemoveNode', false, null);

				// set up variables to contain our input values
				var time 	= jQuery('#time-dialog select#time-name').val();
				var width 	= jQuery('#time-dialog input#time-width').val();
				var height 	= jQuery('#time-dialog input#time-height').val();

				var output 	= '';

				// setup the output of our shortcode
				output = '[timeline';
					if(time) 	output += ' name="' + time + '"';
					if(width) 		output += ' width="' + width + '"';
					if(height) 		output += ' height="' + height + '"';

				// check to see if the TEXT field is blank
					output += ']';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);

				// Return
				tinyMCEPopup.close();
			}
		};
		tinyMCEPopup.onInit.add(TimeDialog.init, TimeDialog);

		function showVideo(e) {
			var newurl = jQuery('#vimeo-id').val();
			jQuery('#vimeo-frame').attr('src', 'http://player.vimeo.com/video/' + newurl);
		}

	</script>

</head>
<body>
	<div id="time-dialog">

		<form action="/" method="get" accept-charset="utf-8" class="form-horizontal">
			<div class="container">
				<h3>
					<i class="icon-history"></i>
					Insert Timeline<br>
					<small>Insert a timeline in the contents</small>
				</h3>
				<hr>

				<!-- Timeline -->
				<div class="form-group">
					<label class="col-xs-4 control-label" for="time-name">Timeline</label>
					<div class="col-xs-8">
						<select class="form-control" name="time-name" id="time-name" size="1">
							<option value="" selected="selected">Select a timeline</option>
							<?php

							$terms = get_terms( 'timelines', 'orderby=count&hide_empty=1' );
							foreach ($terms as $term) {
								echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
							} ?>
						</select>
					</div>
				</div>

				<!-- Width -->
				<div class="form-group">
					<label class="col-xs-4 control-label" for="time-width">Width</label>
					<div class="col-xs-4">
						<input class="form-control" type="text" name="time-width" value="" id="time-width" />
					</div>
				</div>

				<!-- Height -->
				<div class="form-group">
					<label class="col-xs-4 control-label" for="time-height">Height</label>
					<div class="col-xs-4">
						<input class="form-control" type="text" name="time-height" value="" id="time-height" />
					</div>
				</div>

				<hr>
				<!-- Insert button -->
				<p>
					<a class="btn btn-block btn-default" href="javascript:TimeDialog.insert(TimeDialog.local_ed)" id="inserto">Insert</a>
				</p>
			</form>
		</div>
	</div>
</body>
</html>

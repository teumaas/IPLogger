<!DOCTYPE html>
<html lang="en">
<head>
  <title>IPLogs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
	<table class="table table-striped table-responsive">
	</table>
	<script>
		jQuery(document).ready(
			function ($)
			{				
				$('.table').footable({
					"paging": {
						"enabled": true,
						"size": 20
					},
					"filtering": {
						"enabled": true
					},
					"sorting": {
						"enabled": true
					},
					"columns": $.get("headers.json"),
					"rows": $.get("data.json")
				})
				
				$( "#refresh" ).click(function() {
				  Refresh();
				});
				
				function Refresh() {
					$('.table').footable({
						"paging": {
							"enabled": true,
							"size": 20
						},
						"filtering": {
							"enabled": true
						},
						"sorting": {
							"enabled": true
						},
						"columns": $.get("headers.json"),
						"rows": $.get("data.json")
					});
				}
			}
		);
	</script>
</body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.4/footable.bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.4/footable.min.js"></script>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Template • TodoMVC</title>
	<link rel="stylesheet" href="../assets/base.css">
	<!-- CSS overrides - remove if you don't need it -->
	<link rel="stylesheet" href="css/app.css">
	<!--[if IE]>
	<script src="../assets/ie.js"></script>
	<![endif]-->
	<?php
	$con=mysqli_connect("your.databasehost.com","dbUser","dbPassword","dbName");
	// Check connection
	if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	 
	if (isset($_POST["note"])) {
		$sql="INSERT INTO notes (note, status) VALUES ('$_POST[note]', 'temp')";
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error());
		}
		echo "1 record added";
echo "<script>queryDB();</script>";
	}
	if (isset($_POST["id"])) {
		$sql="DELETE FROM notes where id=$_POST[id];";
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error());
		}
		echo "1 record removed";
echo "<script>queryDB();</script>";
	}
	?>
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
setInterval(function(){queryDB()},5000);
</script>
	<script type="text/javascript">        
	function insert()
	{
		var noteValues = $('#new-todo').serialize();
	 
		$.ajax({
			type: "POST",
			url: "index.php",
			data: noteValues
		})
	
		queryDB();
	
		$('#new-todo').val("");
	
	}
	</script>
	
	<script type="text/javascript">        
	function deleteNote(id)
	{	 
		$.ajax({
			type: "POST",
			url: "index.php",
			data: "id="+id
		})
	
		queryDB();	
	}
	</script>
	
	<script type="text/javascript">        
	function queryDB()
	{
	 
		$.ajax({
			type: "POST",
			url: "dbEngine.php",
			data: "keyword=read",
			success: function(server_response)
			{
				$('#todo-list').html(server_response).show();
			}
		})
	}
	</script>
	
	<script>
	$("#new-todo").keyup(function (e) {
    if (e.keyCode == 13) {
        insert();
    }
	});
	</script>
	
</head>
<body onLoad="queryDB();">
	<section id="todoapp">
		<header id="header">
			<h1>todos</h1>
			<input id="new-todo" name="note" placeholder="What needs to be done?" autofocus onkeypress = "if(event.keyCode == 13)insert();">
		</header>
		<!-- This section should be hidden by default and shown when there are todos -->
		<section id="main">
			<input id="toggle-all" type="checkbox">
			<label for="toggle-all">Mark all as complete</label>
			<ul id="todo-list">
				<!-- These are here just to show the structure of the list items -->
				<!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
				<li class="completed">
					<div class="view">
						<input class="toggle" type="checkbox" checked>
						<label>Create a TodoMVC template</label>
						<button class="destroy"></button>
					</div>
					<input class="edit" value="Create a TodoMVC template">
				</li>
				<li>
					<div class="view">
						<input class="toggle" type="checkbox">
						<label>Rule the web</label>
						<button class="destroy"></button>
					</div>
					<input class="edit" value="Rule the web">
				</li>
			</ul>
		</section>
		<!-- This footer should hidden by default and shown when there are todos -->
		<footer id="footer">
		</footer>
	</section>
	<footer id="info">
		<!-- Remove the below line &#8595; -->
		<p>Template by <a href="http://github.com/sindresorhus">Sindre Sorhus</a></p>
		<!-- Change this out with your name and url &#8595; -->
		<p>Created by <a href="http://alexdglover.com">Alex Glover</a></p>
		<p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
	</footer>
	<!-- Scripts here. Don't remove this &#8595; -->
	<script src="../assets/base.js"></script>
	<script src="js/app.js"></script>
</body>
</html>

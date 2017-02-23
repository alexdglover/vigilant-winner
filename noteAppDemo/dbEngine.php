<?php
$con=mysqli_connect("your.databasehost.com","dbUser","dbPassword","dbName");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST["keyword"]))
{
	$keyword = $_POST["keyword"];
	if($keyword=="read")
	{
		$query = "SELECT * FROM notes order by id desc";
		if($result = $con->query($query)) 
		{		
			while ($row = $result->fetch_row())
			{
				echo '<li class="' . $row[2] . '"><div class="view"><input class="toggle" type="checkbox" checked><label>' . $row[1] . '</label><button class="destroy" onClick="deleteNote(' . $row[0] . ')"></button></div><input class="edit" value="' . $row[1] . '"></li>';
			}	
			
			$result->close();
		}
		else
		{
			echo 'No Results for :"'.$_POST['keyword'].'"';
		}
	}

}
/* determine our thread id */
$thread_id = $con->thread_id;

/* Kill connection */
$con->kill($thread_id);

/* Close connection */
$con->close();
?>

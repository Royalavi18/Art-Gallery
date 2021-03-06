<?php
	$userid = $_REQUEST["q"];
	$page="profile";
	$title="Profile";
	require_once('header.php');
	$servername = "localhost";
	$username = "Gurmeet";
	$password = "WINDOWSTEN";
	$dbname="art_gallery";
	$con=mysqli_connect($servername,$username,$password,$dbname);
	$sql = "select * from user where Id = ".$userid;
	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($res);
?>
<div class="container-fluid cart-container">
	<div class="panel panel-default">
		<div class="panel-heading" style="text-align:center;"><h1>Hi, <?php echo $row["Name"]; ?></h1></div>
			<div class="row panel-body">
				<div class="col-md-4">
					<div class="container">
						<h1 style="position:relative;left:100px;">Profile Info</h1><br>
						<img src="images/pic.png" alt="profile">
						<span><button type="button" class="btn btn-default" style="font-size:120%;padding:10px;">Upload Profile Photo</button></span><br>
					</div>
					<div class="container" style="font-size:150%;position:relative;left:30px;">
						<h2>Name : <?php echo $row["Name"]; ?></h2><br>
						<h2>Email : <?php echo $row["Email"]; ?></h2><br>
						<h2>Phone : <?php echo $row["Phone"]; ?></h2><br>
						<h2>Username : <?php echo $row["Username"]; ?></h2><br>
						<h2>Total Spent : Rs. <?php echo $row["Spent"]; ?></h2><br><br><br>
						<button onclick="window.location.href = 'http://localhost/Art/'" type="button" class="btn btn-default" style="font-size:120%;padding:10px;position:relative;left:20px;">Log Out</button>
						<button data-toggle="modal" data-target="#squarespaceModal" type="button" class="btn btn-default" style="font-size:120%;padding:10px;position:relative;left:30px;">Edit Details</button>
					</div>
				</div>
				<div class="col-md-4"  style="border-right: 2px solid #fff;border-left: 2px solid #fff;">
					<div class="container">
						<h1 style="position:relative;left:100px;">Liked Paintings</h1><br>
						<?php

						$sql2 = "select Art from liked where Id = ".$userid;
						$res2 = mysqli_query($con, $sql2);
						if (mysqli_num_rows($res2) > 0) {
							while($row = mysqli_fetch_assoc($res2)) {
								echo '<div class="container" style="position:relative;left:100px;">
								<img src="images/'.$row["Art"].'.jpg" class="img-thumbnail home_img" width="500px" alt="Painting">
								<span><h1 style="width:200px;text-align:center;">'.$row["Art"].'</h1></span><br>
								<span style="position:relative;left:60px;"><button onclick="unlike(\''.$row["Art"].'\')" type="button" class="btn btn-default unlike" style="font-size:120%;padding:10px;">Unlike</button></span>
								</div>
								<br><br>';
							}
						}

						?>
					</div>
				</div>
				<div class="col-md-4">
				<div class="container">
						<h1 style="position:relative;left:100px;">Bought Paintings</h1><br>
						<?php

						$sql3 = "select Name, Price from art where Bought_by = ".$userid;
						$res3 = mysqli_query($con, $sql3);
						if (mysqli_num_rows($res3) > 0) {
							while($row = mysqli_fetch_assoc($res3)) {
								echo '<div class="container" style="position:relative;left:100px;">
								<img src="images/'.$row["Name"].'.jpg" class="img-thumbnail home_img" width="500px" alt="Painting">
								<span><h1 style="width:200px;text-align:center;">'.$row["Name"].'</h1></span>
								<span style="position:relative;left:60px;"><h3> Rs. '.$row["Price"].'</h3></span><br>
								</div>
								<br><br>';
							}
						}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">My Modal</h3>
		</div>
		<div class="modal-body">

            <!-- content goes here -->
			<form method="post" action="http://localhost/Art/edit.php?q=<?php echo $userid; ?>">
			<div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
              </div>
			  <div class="form-group">
                <input name="ph" type="text" class="form-control" placeholder="Enter Phone number" required>
              </div>
              <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Enter email" required>
              </div>
			  <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username" required>
              </div>
              <button name="edit" type="submit" class="btn btn-default">Edit Details</button>
            </form>

		</div>
		<div class="modal-footer">
			<div class="btn-group btn-group-justified" role="group" aria-label="group button">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
				</div>
				<div class="btn-group btn-delete hidden" role="group">
					<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
				</div>

			</div>
		</div>
	</div>
  </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
function unlike(x){
	var id = <?php echo $userid; ?>;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var msg = this.responseText;
		location.reload();
		}
	};
	xmlhttp.open("GET", "http://localhost/Art/dellike.php?q="+x+"&p="+id, true);
	xmlhttp.send();
}

</script>

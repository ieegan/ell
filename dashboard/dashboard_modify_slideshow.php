<!DOCTYPE HTML>
<html>
	<head>
		<title>Administrator Dashboard</title>
		<link rel="stylesheet" type="text/css" href="dashboard_style.css"/>
		<script src="../jquery-1.11.1.min.js"></script>
		<script src="dashboard_script.js"></script>
	</head>
	<body>
		
		<?php include("dashboard_nav.php"); ?>
		
		<main>
			<div id="content">
				<h4>Modify Slideshow</h4>
				<?php
				include("../connection.php");
				
				if(isset($_POST['modify_slide'])){
					$id=$_POST['id'];
					$link=$_POST['link'];
					$description=$_POST['description'];
					
					if($_FILES['slide']['size']!==0){
						$temp_filename=$_FILES['slide']['tmp_name'];
						$original_filename=$_FILES['slide']['name'];
						$new_filename=md5($original_filename).mt_rand().".jpg";//change to allow more image types
						$destination="../home_slides/".$new_filename;
						$image_path="home_slides/".$new_filename;
						if(move_uploaded_file($temp_filename, $destination)){
							$result=mysqli_query($con,"SELECT Slide FROM slideshow WHERE ID='$id'");
							$old_slide=mysqli_fetch_array($result);
							unlink("../".$old_slide['Slide']);
						}
						
						$query="UPDATE slideshow SET Link='$link', Description='$description',Slide='$image_path' WHERE ID='$id'";
					}else{
						$query="UPDATE slideshow SET Link='$link', Description='$description' WHERE ID='$id'";
					}
					
					if(!mysqli_query($con,$query)){
						echo "<p class='failed'>Submission failed. Please try again.</p>";
					}else{
						echo "<p class='success'>Database updated successfully!</p>";
					}
				}
				
				$query="SELECT * FROM slideshow";
				$result=mysqli_query($con,$query);
				while($row=mysqli_fetch_array($result)){
					?>
					<div class="modify_slide">
						<form method="POST" action="" enctype="multipart/form-data" id="modify_slide">
							<table>
								<tr>
									<td>Image :</td>
									<td>
										<label>
											<img src="../<?php echo $row['Slide'] ?>" alt="slide" height='100'/>
											<input type="file" name="slide"/>
										</label>
									</td>
								</tr>
								<tr>
									<td>Link :</td>
									<td><input type="text" name="link" value="<?php echo $row['Link'] ?>"/></td>
								</tr>
								<tr>
									<td>Description :</td>
									<td><input type="text" name="description" value="<?php echo $row['Description'] ?>"/></td>
								</tr>
							</table>
							<input type="hidden" name="id" value="<?php echo $row['ID'];?>"/>
							<input type="hidden" name="modify_slide"/> 
							<input type="submit" value="Update"/>
						</form>
					</div>
					<?php
				}
				?>
			</div>	
		</main>
	</body>
</html>
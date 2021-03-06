<!DOCTYPE HTML>
<html>
	<head>
		<title>Ell Mobile</title>
		<?php include("head.php"); ?>
	</head>
	<body>
		<?php include("header.php"); ?>
		
		<main>
			<div id="content">
				<div id="see_more">
				<?php
				include("connection.php");
				
				if(isset($_GET['type'])){
					$type=$_GET['type'];
					if($type=="Mobile Phones" || $type=="Tablets" || $type="TV" || $type="Audio" || $type="Video"){
						$product_ID=$_GET['product_ID'];
						$query="SELECT Name,Price,Description,Specifications FROM products WHERE ID='$product_ID'";
						$result=mysqli_query($con,$query);
						
						while($row=mysqli_fetch_array($result)){
							?>
							<div id="slideshow_see_more">
								<div id="slides">
								<?php
									$slide_query="SELECT Slide FROM product_slides WHERE Product_ID='$product_ID'";
									$slide_result=mysqli_query($con,$slide_query);
									while($slide_row=mysqli_fetch_array($slide_result)){
										?>
											<div>
												<img src="<?php echo $slide_row['Slide'] ?>" alt="slide"/>
											</div>
										<?php
									}
								?>
								</div>
							</div>
							<h2><?php echo $row['Name']?></h2>
							<p class="price">Rf. <?php echo $row['Price']?></p><br />
							<p><?php echo $row['Description']?></p><br /><br />
							<h3>Specifications</h3>
							<p><?php echo $row['Specifications']?></p>
							<?php
						}
					}elseif($type=="Mobile Accessories"){
						$product_ID=$_GET['product_ID'];
						$query="SELECT Name,Description,Thumbnail FROM products WHERE ID='$product_ID'";
						$result=mysqli_query($con,$query);
						
						while($row=mysqli_fetch_array($result)){
							?>
								<img src="<?php echo $row['Thumbnail']?>" height="250"/>
								<h2><?php echo $row['Name']?></h2><br />
								<p><?php echo $row['Description']?></p><br /><br />
							<?php
						}
					}
				}
				?>
				</div>
			</div>
		</main>
		
		<?php include("footer.php"); ?>
	</body>
</html>
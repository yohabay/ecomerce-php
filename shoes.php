<?php include 'inc/header.php';?>

 <div class="main">
    <div class="content">

    <div class="content_top">
    		<div class="heading">
    		<h3>Men Shoes<r/h3>
    		</div>
    		<div class="clear"></div>
    	</div>

			<div class="section group">
            <?php
	      	$getTop4 = $pd->getwomenshoes();
	      	if ($getTop4) {
	      		while ($result = $getTop4->fetch_assoc()) { 
	      
	      			
	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				      <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>

			</div>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Women Shoes<r/h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php
	      	$getTop1 = $pd->getbrandmenshoes();
	      	if ($getTop1) {
	      		while ($result = $getTop1->fetch_assoc()) { 
	      
	      			
	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				      <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
				
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>kids Shoes</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
            <?php
	      	$getTop2 = $pd->getbrandkidsshoes();
	      	if ($getTop2) {
	      		while ($result = $getTop2->fetch_assoc()) { 
	      
	      			
	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				      <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
				
			</div>
 </div>
<?php include 'inc/footer.php';?>
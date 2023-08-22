<?php include 'inc/header.php';?>

<style>
.images_1_of_4 h2 {
    margin: 10px 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
} 
.images_1_of_4 {
	height:400px
}
.images_1_of_4 .button a{
	 color:black;
    margin-bottom:10px;
    padding:10px 30px;
    border-radius:10px;
    background: orange;
}>
</style>
 <div class="main">
    <div class="content">

    <div class="content_top">
    		<div class="heading">
    		<h3>Fashion<r/h3>
    		</div>
    		<div class="clear"></div>
    	</div>

			<div class="section group">
            <?php
	      	$getTop4 = $pd->getTopbrandFashion();
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
    		<h3>shoes<r/h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php
	      	$getTop1 = $pd->getTopbrandShoes();
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
    		<h3>electronics</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
            <?php
	      	$getTop2 = $pd->getTopbrandElectronics();
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
	<div class="content_bottom">
    		<div class="heading">
    		<h3>beauty</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">


					<?php
	      	$getTop3 = $pd->getTopbrandBeauty();
	      	if ($getTop3) {
	      		while ($result = $getTop3->fetch_assoc()) { 
	      
	      			
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
 </div>
<?php include 'inc/footer.php';?>
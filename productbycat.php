<?php include 'inc/header.php';?>
<style>
    .ethio-section-group {
        display: flex;
        flex-wrap: wrap;
        margin-top: 0;
    }

    .ethio-grid-1-of-4:first-child {
        margin-left: 18px;
    }

    .ethio-grid-1-of-4 {
        width: 23%;
        padding: 0 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        background-color: #f5f5f5;
    }

    /* .ethio-images-1-of-4 img {
        width: 100%;
        height: auto;
        object-fit: cover;
        object-position: center;
        max-height: 200px; /* Adjust this value as needed */
    /* } */

    /* .ethio-images-1-of-4 h2 {
        font-size: 12px;
        line-height: 1.2;
        max-height: 2.4em;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }  */

    /* .ethio-images-1-of-4 p {
        font-size: 12px;
    } */

    /* .ethio-images-1-of-4 p.price {
        font-weight: bold;
        font-size: 16px;
    } */

    /* .ethio-images-1-of-4 .button {
        margin-top: 10px;
    } */
    .content h2 {
        margin: 10px 0;
        font-size:16px;
        line-height:1rem;
        color:red;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.ethio-grid-1-of-4{
    display:flex;
    align-items:center;
    text-align:center;
    flex-direction:column;
    
}


.content img{
    margin-top:10px;
    height:200px;
    background:transparent;
   
}
.button{
    margin:10px;
    padding:10px 20px;
    border-radius:5px;
    background:orange;
}
.price{
    color:red;
} 
</style>



<?php 

if (!isset($_GET['catname']) || $_GET['catname'] == NULL) {
   
   echo "<script>window.location='404.php';</script>";
   
} else {

    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catname']);
}


 ?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="ethio-section-group">

	      	<?php 
	      	$productbycat = $pd->productByCat($id);
	      	if ($productbycat) {
	      		while ($result = $productbycat->fetch_assoc()) {
	      	

	      	 ?>
				<div class="ethio-grid-1-of-4">
				<a href="details.php?proid=<?php echo $result['productId']; ?>"><img class="img1" src="admin/<?php echo $result['image']; ?>" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],30); ?></p>
					 <p class="price">$<?php echo $result['price']; ?></p>
					 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>

			
			<?php }}else{
				header("location:404.php");
			} ?>
			</div>

	
	
    </div>
 </div>
<?php include 'inc/footer.php';?>

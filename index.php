<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<style>
.section.group {
    display: flex;
    flex-wrap: wrap;
    margin-top: 0;
}

.grid_1_of_4:first-child {
    margin-left: 18px;
}
.grid_1_of_4 {
    width: 300px;
    padding: 0 10px;
    box-sizing: border-box;
}

.images_1_of_4 img {
    width: 100%;
    height: 200px;
    object-fit: contain;
}

.images_1_of_4 h2 {
    margin: 10px 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.images_1_of_4 p.price {
    font-weight: bold;
}

.images_1_of_4 .button {
    margin-top: 10px;
   
}
.images_1_of_4 .button a {
    color:black;
    margin-bottom:10px;
    padding:10px 30px;
    border-radius:10px;
    background: orange;
}

</style>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getFpd = $pd->getFeaturedProduct();
            if ($getFpd) {
                while ($result = $getFpd->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p><?php echo $fm->textShorten($result['body'],120); ?></p>
                    <p class="price">$<?php echo $result['price']; ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
                </div>
            <?php 
                } 
            } ?>
        </div>
        <div class="content_top">
            <div class="heading">
                <h3>General Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getFpd = $pd->getgeneralProduct();
            if ($getFpd) {
                while ($result = $getFpd->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p><?php echo $fm->textShorten($result['body'],120); ?></p>
                    <p class="price">$<?php echo $result['price']; ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
                </div>
            <?php 
                } 
            } ?>
        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getNpd = $pd->getNewProduct();
            if ($getNpd) {
                while ($result = $getNpd->fetch_assoc()) { 
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId']; ?>"><img class="img1" src="admin/<?php echo $result['image']; ?>" /></a>
                    <h2><?php echo $result['productName']; ?></h2>
                    <p class="price">$<?php echo $result['price']; ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
                </div>
            <?php 
                } 
            } ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>

<?php include 'inc/header.php';?>
<?php include '../classess/Product.php';?>
<?php include '../classess/Category.php';?>
<style>
    .selectcat{
        display:flex;
       background:white;
       height:90vh; 
       padding:3% 10%;
    }
    .selectcat #select{
        padding:10px;
        font-size:20px;
    }
    .selectcat input{
       padding:10px 25px;
       background:orange;
       margin-top:15px;
       border:none;
       border-radius:10px;
       color:white;
       cursor:pointer;
    }
</style>
 
<div class="selectcat">
<form action="" method="post">

              <div>  <select id="select" name="catname">
                    <option>Select Category</option>
                    <?php 
                    $cat = new Category();
                    $getCat = $cat->getAllCat();
                    if ($getCat) {
                        while ($result = $getCat->fetch_assoc()) {
                            ?>
                        
                    <option class="selectoption" value="<?php echo $result['catName'];?>"><?php echo $result['catName'];?></option>
                <?php } } ?>
                    
               </select></div>
               <div><input type="submit" name="submit" Value="Go To Product Add" /></div>
               <a href="fashionadd.php">enter</a>
</form>
</div>
<?php include 'inc/footer.php';?>
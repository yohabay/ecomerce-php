<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Color.php';?>
<?php
$color = new Color();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $colorName = $_POST['colorName'];
    $insertcolor = $color->colorInsert($colorName);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Color</h2>
               <div class="block copyblock"> 

<?php
if (isset($insertcolor)){
echo $insertcolor;

}

        ?>
                 <form action="color-add.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="colorName" placeholder="Enter Color Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
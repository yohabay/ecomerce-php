<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Category.php';?>
<?php include '../classess/Size.php';?>
<?php include '../classess/Color.php';?>
<?php
$Size = new Size();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SizeName = $_POST['SizeName'];
    $insertSize = $Size->SizeInsert($SizeName);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Size</h2>
               <div class="block copyblock"> 

<?php
if (isset($insertSize)){
echo $insertSize;

}

        ?>
                 <form action="size_add.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="SizeName" placeholder="Enter Size Type..." class="medium" />
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
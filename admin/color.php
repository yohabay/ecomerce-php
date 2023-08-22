<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Color.php';?>
<?php
$color = new Color();

if (isset($_GET['delcolor'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcolor']);
	$delcat = $cat->delcolorById($id);
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Color List</h2>
                <div class="block">   

                	<?php 

                	if (isset($delcolor)) {
                		echo $delcolor;
                	}

                	?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Color Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
				$getcolor = $color->getAllcolor();
				if ($getcolor) {
					$i = 0;
					while ($result = $getcolor->fetch_assoc()) {
						$i++;
				

				?>			
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['colorName'];?></td>
							<td><a href="color-edit.php?colorName=<?php echo $result['colorName'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?color-delete=<?php echo $result['colorName'];?>">Delete</a></td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Size.php';?>
<?php
$cat = new Size();

if (isset($_GET['deleSize'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['deleSize']);
	$deleSize = $cat->deleSizeById($id);
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Size List</h2>
                <div class="block">   

                	<?php 

                	if (isset($deleSize)) {
                		echo $deleSize;
                	}

                	?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Size name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

				<?php
				$getCat = $cat->getAllSize();
				if ($getCat) {
					$i = 0;
					while ($result = $getCat->fetch_assoc()) {
						$i++;
				

				?>		
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['SizeName'];?></td>
							<td><a href="size-edit.php?SizeName=<?php echo $result['SizeName'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?deleSize=<?php echo $result['SizeName'];?>">Delete</a></td>
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


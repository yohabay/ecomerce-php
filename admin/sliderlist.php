
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/Slider.php';?>
<?php
$slider = new Slider();


if (isset($_GET['delslider'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delslider']);
	$delslider= $slider->delsliderById($id);

}

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">   

                	<?php 

                
                	if (isset($delbrand)) {
                		echo $delbrand;
                	}

					
                	?>

					<table class="data display datatable" id="example">
					<thead>
					<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
					</tr>
					</thead>
					<tbody>

				<?php
				$getSlider = $slider->getAllSlider();
				if ($getSlider) {
					$i = 0;
					while ($result = $getSlider->fetch_assoc()) {
						$i++;
				

				?>		
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['title'];?></td>
							<td><img src="<?php echo $result['image'] ;?>" height="40px" width="60px" ></td>
							<td><a href="slideredit.php?id=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?delslider=<?php echo $result['id'];?>">Delete</a></td>
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


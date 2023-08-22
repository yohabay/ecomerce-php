<?php
$slider = new Slider();

if (isset($_GET['id'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['id']);
	$delslider = $slider->delsliderById($id);
}

$productbycat = $slider->getAllSlider();
if ($productbycat) {
?>
	<div class="header_bottom">
		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php while ($result = $productbycat->fetch_assoc()) { ?>
						<li>
							<div class="banner-image">
								<div class='image'><img src="admin/<?php echo $result['image']; ?>" /></div>
								<div class="banner-title"><?php echo $result['title']; ?></div>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</section>
	</div>
	<div class="clear"></div>
<?php
}
?>
<!-- Include necessary CSS and JavaScript for FlexSlider -->
<link rel="stylesheet" href="path-to-flexslider.css">
<style>
	/* Custom CSS for navigation arrows */
.flex-direction-nav a {
    background: transparent; /* Remove background color */
    color: #000; /* Set arrow color */
    font-size: 24px; /* Adjust font size as needed */
}

.header_bottom {
    background-color: rgba(0, 100, 200, 0.3);
}

/* Add custom CSS for banner image and title */
.banner-image {
    position: relative;
    height: 500px;
    display: flex;
}

.banner-image {
    position: relative;
    height: 400px;
    display: flex;
}

.banner-image .image {
    align-self: flex-start; /* Align the image to the top */
    margin-right: 0px; /* Adjust the margin to create space between image and title */
    height: 400px;
    width: 400px;
    margin-top: 2%;
	background-color: transparent;
}

.banner-image img {
    height: 200px;
    width: 300px;
    margin-top: 4%;
	margin-left:3%;
    object-fit: contain;
	background-color: transparent;
}

.banner-title {
    position: absolute;
    top: 10px;
    width: 60%; /* Decrease the width of the title */
    font-size: 66px;
    color: blue;
    text-align: right; /* Align the title to the right */
    right: 40px; /* Adjust the right position to align the title */
    padding: 60px;
    box-sizing: border-box;
}


.flex-direction-nav .flex-next {
    margin-left: 10px; /* Adjust spacing between arrows */
}

.flex-direction-nav .flex-prev {
    margin-right: 10px; /* Adjust spacing between arrows */
}

</style>
<script src="path-to-jquery.js"></script>
<script src="path-to-flexslider.js"></script>
<script>
	// Activate FlexSlider
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			slideshowSpeed: 5000, // Adjust the speed as needed
			directionNav: true, // Set to true to display navigation arrows
			prevText: "<", // Customize the text/icon for the previous slide
			nextText: ">", // Customize the text/icon for the next slide
			pauseOnHover: true // Set to false if you want to disable pausing on hover
		});
	});
</script>

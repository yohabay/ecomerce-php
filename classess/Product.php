<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Formate.php');

class Product
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $files)
    {
        $productName = $this->fm->validation($data['productName']);
        $catname = $this->fm->validation($data['catname']);
        $brandname = $this->fm->validation($data['brandname']);
        $body = $this->fm->validation($data['body']);
        $price = $this->fm->validation($data['price']);
		$color = $this->fm->validation($data['color']);
		$size = $this->fm->validation($data['size']);
        $type = $this->fm->validation($data['type']);

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catname = mysqli_real_escape_string($this->db->link, $data['catname']);
        $brandname = mysqli_real_escape_string($this->db->link, $data['brandname']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $color = mysqli_real_escape_string($this->db->link, $data['color']);
        $size = mysqli_real_escape_string($this->db->link, $data['size']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $uploaded_images = [];

        foreach ($files['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = $files['images']['name'][$key];
            $file_size = $files['images']['size'][$key];
            $file_temp = $tmp_name;

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/" . $unique_image;

            if ($file_size > 1048567) {
                $msg = "<span class='error'>Image Size should be less than 1MB!</span>";
                return $msg;
            } elseif (in_array($file_ext, $permited) === false) {
                $msg = "<span class='error'>You can upload only: " . implode(', ', $permited) . "</span>";
                return $msg;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $uploaded_images[] = $uploaded_image;
            }
        }

        if (
            $productName == "" || $catname == "" || $brandname == "" ||
            $body == "" || $price == "" || $color == "" || $size == "" ||
            empty($uploaded_images) || $type == ""
        ) {
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        } else {
            $images = implode(',', $uploaded_images);
            $query = "INSERT INTO tbl_product(productName, catname, brandname, body, price, color, size, image, type)
                      VALUES('$productName', '$catname', '$brandname', '$body', '$price', '$color', '$size', '$images', '$type')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Product inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not inserted.</span>";
                return $msg;
            }
        }
    }

    public function getAllProduct()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }


public function getProById($id){

	$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
	$result = $this->db->select($query);
	return $result;

}

public function productUpdate($data,$file,$id){

$productName = $this->fm->validation($data['productName']);
$catname = $this->fm->validation($data['catname']);
$brandname = $this->fm->validation($data['brandname']);
$body = $this->fm->validation($data['body']);
$price = $this->fm->validation($data['price']);
$type = $this->fm->validation($data['type']);

$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
$catname       = mysqli_real_escape_string($this->db->link, $data['catname']);
$brandname     = mysqli_real_escape_string($this->db->link, $data['brandname']);
$body        = mysqli_real_escape_string($this->db->link, $data['body']);
$price       = mysqli_real_escape_string($this->db->link, $data['price']);
$type        = mysqli_real_escape_string($this->db->link, $data['type']);



    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

if ($productName == "" || $catname == "" || $brandname == "" || $body == "" || $price == "" ||$type == "") {
	
	$msg = "<span class='error'>Fields must not be empty !</span>";
	return $msg;


}else{
if (!empty($file_name)) {
	



if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";


}else{

	 move_uploaded_file($file_temp, $uploaded_image);


	 $query = "UPDATE tbl_product 
	 SET
	 productName = '$productName',
	 catname       = '$catname',
	 brandname     = '$brandname',
	 body        = '$body',
	 price       = '$price',
	 image       = '$uploaded_image',
	 type        = '$type'
	 WHERE productId = '$id'";

	 $updatedted_row = $this->db->update($query);
			if ($updatedted_row) {
				$msg = "<span class='success'>Product Updated Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product Not Updated.</span>";
				return $msg;
		}
		}
}else{

	 $query = "UPDATE tbl_product 
	 SET
	 productName = '$productName',
	 catname       = '$catname',
	 brandname     = '$brandname',
	 body        = '$body',
	 price       = '$price',
	 type        = '$type'
	 WHERE productId = '$id'";

	 $updatedted_row = $this->db->update($query);
			if ($updatedted_row) {
				$msg = "<span class='success'>Product Updated Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product Not Updated.</span>";
				return $msg;
		}
}

}
}

public function delProById($id){
$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
$getData = $this->db->select($query);
if ($getData) {
while ($delImg = $getData->fetch_assoc()) {
$dellink = $delImg['image'];
unlink($dellink);

}

}

$delquery = "DELETE FROM tbl_product where productId = '$id'";
$deldata = $this->db->delete($delquery);
	if ($deldata) {
		$msg = "<span class='success'>Product Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Product Not Deleted !</span>";
				return $msg;

	}

}// Define the removeProduct function in your code
public function getremoveProduct($productId) {
    // Implement the logic to remove the product from the database
    // For example, you can use a SQL query to delete the product from the cart table
    $sql = "DELETE FROM cart WHERE productId = $productId";
    // Execute the query using your database connection
    $result = $conn->query($sql);
    
    // Check if the query was successful
    if ($result) {
        // Product removed successfully
        echo "Product removed from the cart.";
    } else {
        // Product removal failed
        echo "Failed to remove the product from the cart.";
    }
}


public function getFeaturedProduct(){

	$query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 12";
	$result = $this->db->select($query);
	return $result;
}
public function getgeneralProduct(){

	$query = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 12";
	$result = $this->db->select($query);
	return $result;
}

public function getNewProduct(){
   $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 12";
	$result = $this->db->select($query);
	return $result;

}

public function getSingleProduct($id){

	$query = "SELECT p.*,c.catName,b.brandName
FROM tbl_product as p,tbl_category as c, tbl_brand as b
WHERE p.catname = c.catname AND p.brandname = b.brandname AND p.productId = '$id'";
	$result = $this->db->select($query);
	return $result;
}


public function latestFromFashion(){
	$query = "SELECT * FROM tbl_product WHERE catname = 'fashion' ORDER BY productId DESC LIMIT 8";
	$result = $this->db->select($query);
	return $result;
}
public function latestFromShoes(){
	$query = "SELECT * FROM tbl_product WHERE catname = 'shoes' ORDER BY productId DESC LIMIT 8";
	$result = $this->db->select($query);
	return $result;
}
public function latestFromElectronics(){
	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 8";
	$result = $this->db->select($query);
	return $result;
}
public function latestFromBeauty(){
	$query = "SELECT * FROM tbl_product WHERE catname = 'beauty' ORDER BY productId DESC LIMIT 8";
	$result = $this->db->select($query);
	return $result;
}

public function productByCat($id){
$catname       = mysqli_real_escape_string($this->db->link,$id);
$query       = "SELECT * FROM tbl_product WHERE catname = '$catname'";
$result      = $this->db->select($query);
return $result;	
}

public function insertCompareData($cmprid,$cmrId){
	$cmrId     = mysqli_real_escape_string($this->db->link,$cmrId);
	$productId = mysqli_real_escape_string($this->db->link,$cmprid);

	$cquery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId'";
	$check = $this->db->select($cquery);
	if ($check) {
		$msg = "<span class='error'>Already Added !</span>";
				return $msg;
	}
	$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
	$result = $this->db->select($query)->fetch_assoc();
	if ($result) {
		$productId = $result['productId'];
		$productName = $result['productName'];
		$price = $result['price'];
		$image = $result['image'];

		$query = "INSERT INTO tbl_compare(cmrId,productId,productName,price,image)VALUES
			('$cmrId','$productId','$productName','$price','$image')";
			$inserted_row = $this->db->insert($query);

			if ($inserted_row) {
				
	$msg = "<span class='success'>Added ! Check Compare Page</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Not Added !</span>";
				return $msg;

	}
	}
}

public function getCompareData($cmrId){
	$query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id desc";
	$result = $this->db->select($query);
	return $result;
}

public function delCompareData($cmrId){
	$query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
	$deldata = $this->db->delete($query);
}

public function saveWishListData($id,$cmrId){


	$cquery = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$id'";
	$check = $this->db->select($cquery);
	if ($check) {
		$msg = "<span class='error'>Already Added !</span>";
				return $msg;
	}
	$pquery = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($pquery)->fetch_assoc();
		if ($result) {
				$productId = $result['productId'];
				$productName = $result['productName'];
				$price = $result['price'];
				$image = $result['image'];

				$query = "INSERT INTO tbl_wlist(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image') ";
			$inserted_row = $this->db->insert($query);

	if ($inserted_row) {
				
	$msg = "<span class='success'>Added ! Check wishlist Page</span>";
		return $msg;
	}else{
   $msg = "<span class='error'>Not Added !</span>";
		return $msg;
	}
 }
}

public function checkWlistData($cmrId){
	$query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id desc";
	$result = $this->db->select($query);
	return $result;	
}
public function delWlistData($cmrId, $productId){
	$query = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
	$delete = $this->db->delete($query);
}


public function getTopbrandFashion(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'fashion' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getTopbrandShoes(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'shoes' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}

public function getTopbrandElectronics(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}

public function getTopbrandBeauty(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'health and beauty' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
// ................write the script for Fashion list ..............................
// ................write the script for Fashion list ..............................

public function getTopbrandwomen(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'fashion' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getTopbrandmen(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'fashion' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getTopbrandkids(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'fashion' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
// ................write the script for Shoes list ..............................
// ................write the script for Shoes list ..............................

public function getwomenshoes(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'shoes' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getbrandmenshoes(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'shoes' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getbrandkidsshoes(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'shoes' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
// ................write the script for electronics list ..............................
// ................write the script for electronics list ..............................

public function getcomputer(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getmobile(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getcamera(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function gettablete(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getglass(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'electronics' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
// ................write the script for Beauty and Health Care list ..............................
// ................write the script for Beauty and Health Care list ..............................

public function getWellness(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'health and beauty' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getSkincare(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'health and beauty' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getMakeup(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'health and beauty' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getHaircare(){

	$query = "SELECT * FROM tbl_product WHERE catname = 'health and beauty' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}


}

?>
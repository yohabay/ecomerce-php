
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Formate.php');

?>

<?php

class Color 
{
	

private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}

public function colorInsert($colorName){
		$colorName = $this->fm->validation($colorName);
        $colorName = mysqli_real_escape_string($this->db->link, $colorName);


if (empty($colorName) ) {
	
	$msg = "<span class='error'>color field must not be empty !</span>";
	return $msg;
		} else{
			$query = "INSERT INTO tbl_color(colorName) VALUES('$colorName') ";
			$colorinsert = $this->db->insert($query);
			if ($colorinsert) {
				$msg = "<span class='success'>color inserted Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>color Not inserted.</span>";
				return $msg;
			}

		}
	}

	public function getAllcolor()
	{
	$query = "SELECT * FROM tbl_color  ORDER BY colorName DESC";
	$result = $this->db->select($query);
	return $result;
	}

 public function getcolorById($id){
$query = "SELECT * FROM tbl_color WHERE id='$id'";
	$result = $this->db->select($query);
	return $result;

 }

 public function colorUpdate($colorName,$id){

 	$colorName = $this->fm->validation($colorName);
    $colorName = mysqli_real_escape_string($this->db->link, $colorName);
    $id = mysqli_real_escape_string($this->db->link, $id);


if (empty($colorName) ) {
	
	$msg = "<span class='error'>color field must not be empty !</span>";
	return $msg;
} else{

	$query = "UPDATE tbl_color

	SET
	colorName = '$colorName' 
	WHERE colorName = '$id'";

	$updated_row = $this->db->update($query);
	if ($updated_row) {
		$msg = "<span class='success'>color Updated Successfully.</span>";
				return $msg;
	} else{
			$msg = "<span class='error'>color Not Updated !</span>";
				return $msg;
	}
}
 }

 public function delcolorById($id){
 	$query = "DELETE FROM tbl_color WHERE colorName = '$id'";
	$deldata = $this->db->delete($query);
	if ($deldata) {
		$msg = "<span class='success'>color Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>color Not Deleted !</span>";
				return $msg;

	}
     }
	}
?>
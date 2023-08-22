
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Formate.php');

?>

<?php

class Size 
{
	

private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}

public function SizeInsert($SizeName){
		$SizeName = $this->fm->validation($SizeName);
        $SizeName = mysqli_real_escape_string($this->db->link, $SizeName);


if (empty($SizeName) ) {
	
	$msg = "<span class='error'>Size field must not be empty !</span>";
	return $msg;
		} else{
			$query = "INSERT INTO tbl_size(SizeName) VALUES('$SizeName') ";
			$Sizeinsert = $this->db->insert($query);
			if ($Sizeinsert) {
				$msg = "<span class='success'>Size inserted Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Size Not inserted.</span>";
				return $msg;
			}

		}
	}

	public function getAllSize()
	{
	$query = "SELECT * FROM tbl_size ORDER BY SizeName DESC";
	$result = $this->db->select($query);
	return $result;
	}

 public function getSizeById($id){
$query = "SELECT * FROM tbl_size WHERE id='$id'";
	$result = $this->db->select($query);
	return $result;

 }

 public function sizeUpdate($SizeName,$id){

 	$SizeName = $this->fm->validation($SizeName);
    $SizeName = mysqli_real_escape_string($this->db->link, $SizeName);
    $id = mysqli_real_escape_string($this->db->link, $id);


if (empty($SizeName) ) {
	
	$msg = "<span class='error'>Brand field must not be empty !</span>";
	return $msg;
} else{

	$query = "UPDATE tbl_brand

	SET
	SizeName = '$SizeName' 
	WHERE SizeName = '$id'";

	$updated_row = $this->db->update($query);
	if ($updated_row) {
		$msg = "<span class='success'>Size Updated Successfully.</span>";
				return $msg;
	} else{
			$msg = "<span class='error'>Size Not Updated !</span>";
				return $msg;
	}
}
 }

 public function delSizeById($id){
 	$query = "DELETE FROM tbl_Size WHERE SizeName = '$id'";
	$deldata = $this->db->delete($query);
	if ($deldata) {
		$msg = "<span class='success'>Size Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Size Not Deleted !</span>";
				return $msg;

	}
     }
	}
?>
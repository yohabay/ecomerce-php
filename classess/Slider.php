<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Formate.php');

?>

<?php

class Slider{
	
private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function sliderInsert($data, $file)
{
    $slidertitle = $this->fm->validation($data);
    $slidertitle = mysqli_real_escape_string($this->db->link, $data);

    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_temp = $file['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if (empty($slidertitle)) {
        $msg = "<span class='error'>Fields must not be empty!</span>";
        return $msg;
    } elseif ($file_size > 1048567) {
        $msg = "<span class='error'>Image size should be less than 1MB!</span>";
        return $msg;
    } elseif (!in_array($file_ext, $permited)) {
        $msg = "<span class='error'>You can only upload: " . implode(', ', $permited) . "</span>";
        return $msg;
    } else {
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO slider (title, image) VALUES ('$slidertitle', '$uploaded_image')";

        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
            $msg = "<span class='success'>Slider inserted successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Slider not inserted.</span>";
            return $msg;
        }
    }
}


public function getAllSlider(){

$query = "SELECT * FROM slider ORDER BY id DESC";
	$result = $this->db->select($query);
	return $result;
}

public function getSliderById($id){

	$query = "SELECT * FROM slider WHERE id = '$id'";
	$result = $this->db->select($query);
	return $result;

}

public function sliderUpdate($data,$file,$id){

$slidertitle = $this->fm->validation($data['title']);


$slidertitle = mysqli_real_escape_string($this->db->link, $data['title']);




    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

if ($slidertitle == "" ) {
	
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


	 $query = "UPDATE slider 
	 SET
	 title = '$slidertitle',
	 image       = '$uploaded_image',
	 WHERE id = '$id'";

	 $updatedted_row = $this->db->update($query);
			if ($updatedted_row) {
				$msg = "<span class='success'>Slider Updated Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Slider Not Updated.</span>";
				return $msg;
		}
		}
}else{

	 $query = "UPDATE slider 
	 SET
	 title = '$slidertitle',,
	 WHERE id = '$id'";

	 $updatedted_row = $this->db->update($query);
			if ($updatedted_row) {
				$msg = "<span class='success'>slider Updated Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Slider Not Updated.</span>";
				return $msg;
		}
}

}
}

public function delSliderById($id){
$query = "SELECT * FROM slider WHERE id = '$id'";
$getData = $this->db->select($query);
if ($getData) {
while ($delImg = $getData->fetch_assoc()) {
$dellink = $delImg['image'];
unlink($dellink);

}

}

$delquery = "DELETE FROM slider where id = '$id'";
$deldata = $this->db->delete($delquery);
	if ($deldata) {
		$msg = "<span class='success'>Slider Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Slider Not Deleted !</span>";
				return $msg;

	}

}

}
?>
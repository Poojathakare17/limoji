<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class slider_model extends CI_Model
{
public function create($name,$text,$order,$status,$image,$type)
{
$data=array("name" => $name,"text" => $text,"order" => $order,"status" => $status,"image" => $image,"type" => $type);
$query=$this->db->insert( "linuji_slider", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("linuji_slider")->row();
return $query;
}
   public function gettypedropdown()
	{
		$return=array(
			""=>"Select",
			"1"=>"Enable",
			"2"=>"Disable"
		);
		
		return $return;
	}
function getsingleslider($id){
$this->db->where("id",$id);
$query=$this->db->get("linuji_slider")->row();
return $query;
}
function getAllSliderWithoutPagination()
{
    $query=$this->db->query("SELECT * FROM `linuji_slider` WHERE `status`='1' AND `type`='1' ORDER BY `order`")->result();
    if($query){
        return $query;
    }
    else{
        return false;
    }
   
}

function getSpecialProductSlider()
{
    $query=$this->db->query("SELECT * FROM `linuji_product` WHERE `status`='1' AND `is_special`='1' ORDER BY `order`")->result();
    if($query){
        return $query;
    }
    else{
        return false;
    }
   
}

public function edit($id,$name,$text,$order,$status,$image,$type)
{
if($image=="")
{
$image=$this->slider_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"text" => $text,"order" => $order,"status" => $status,"image" => $image,"type" => $type);
$this->db->where( "id", $id );
$query=$this->db->update( "linuji_slider", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `linuji_slider` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `linuji_slider` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `linuji_slider` ORDER BY `id` 
                    ASC")->result();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
}
?>

<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class enquirydetail_model extends CI_Model
{
public function create($enquiryid,$value,$voltage,$category,$misc)
{
$data=array("enquiryid" => $enquiryid,"value" => $value,"voltage" => $voltage,"category" => $category,"misc" => $misc);
$query=$this->db->insert( "linuji_enquirydetail", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("linuji_enquirydetail")->row();
return $query;
}
function getsingleenquirydetail($id){
$this->db->where("id",$id);
$query=$this->db->get("linuji_enquirydetail")->row();
return $query;
}
public function edit($id,$enquiryid,$value,$voltage,$category,$misc)
{
if($image=="")
{
$image=$this->enquirydetail_model->getimagebyid($id);
$image=$image->image;
}
$data=array("enquiryid" => $enquiryid,"value" => $value,"voltage" => $voltage,"category" => $category,"misc" => $misc);
$this->db->where( "id", $id );
$query=$this->db->update( "linuji_enquirydetail", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `linuji_enquirydetail` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `linuji_enquirydetail` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `linuji_enquirydetail` ORDER BY `id` 
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

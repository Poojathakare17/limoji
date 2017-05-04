<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class category_model extends CI_Model
{
public function create($name,$order,$status,$text)
{
$data=array("name" => $name,"order" => $order,"status" => $status,"text" => $text);
$query=$this->db->insert( "linuji_category", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("linuji_category")->row();
return $query;
}
function getsinglecategory($id){
$this->db->where("id",$id);
$query=$this->db->get("linuji_category")->row();
return $query;
}
public function edit($id,$name,$order,$status,$text)
{
$data=array("name" => $name,"order" => $order,"status" => $status,"text" => $text);
$this->db->where( "id", $id );
$query=$this->db->update( "linuji_category", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `linuji_category` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `linuji_category` WHERE `id`='$id'")->row();
return $query;
}
public function getAllCategory()
{
$query=$this->db->query("SELECT `id`,`name` FROM `linuji_slider` WHERE `status`='1' AND `type`='1' ORDER BY `ORDER`")->result();
if($query){
    return $query;
}else{
    false;
}

}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `linuji_category` ORDER BY `id` ASC")->result();
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

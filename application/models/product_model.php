<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class product_model extends CI_Model
{
public function create($category,$is_special,$order,$status,$name,$image,$code,$text)
{
$data=array("category" => $category,"is_special" => $is_special,"order" => $order,"status" => $status,"name" => $name,"image" => $image,"code" => $code,"text" => $text);
$query=$this->db->insert( "linuji_product", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("linuji_product")->row();
return $query;
}
function getsingleproduct($id){
$this->db->where("id",$id);
$query=$this->db->get("linuji_product")->row();
return $query;
}
public function edit($id,$category,$is_special,$order,$status,$name,$image,$code,$text)
{
if($image=="")
{
$image=$this->product_model->getimagebyid($id);
$image=$image->image;
}
$data=array("category" => $category,"is_special" => $is_special,"order" => $order,"status" => $status,"name" => $name,"image" => $image,"code" => $code,"text" => $text);
$this->db->where( "id", $id );
$query=$this->db->update( "linuji_product", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `linuji_product` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `linuji_product` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `linuji_product` ORDER BY `id` 
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

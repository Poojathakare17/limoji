<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class enquiries_model extends CI_Model
{
public function create($name,$email,$contact)
{
$data=array("name" => $name,"email" => $email,"contact" => $contact);
$query=$this->db->insert( "enquiries_enquiries", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("enquiries_enquiries")->row();
return $query;
}
function getsingleenquiries($id){
$this->db->where("id",$id);
$query=$this->db->get("enquiries_enquiries")->row();
return $query;
}
public function edit($id,$name,$email,$contact)
{
if($image=="")
{
$image=$this->enquiries_model->getimagebyid($id);
$image=$image->image;
}
$data=array("name" => $name,"email" => $email,"contact" => $contact);
$this->db->where( "id", $id );
$query=$this->db->update( "enquiries_enquiries", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `enquiries_enquiries` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `enquiries_enquiries` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `enquiries_enquiries` ORDER BY `id` 
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

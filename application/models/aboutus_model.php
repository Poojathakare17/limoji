<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class aboutus_model extends CI_Model
{
public function create($name,$text)
{
$data=array("name" => $name,"text" => $text);
$query=$this->db->insert( "linuji_aboutus", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("linuji_aboutus")->row();
return $query;
}
function getsingleaboutus($id){
$this->db->where("id",$id);
$query=$this->db->get("linuji_aboutus")->row();
return $query;
}
function getAboutUsContent($id){
        $this->db->where("id",$id);
        $query=$this->db->get("linuji_aboutus")->row();
        if($query){
            return $query;
        }
        else{
            return false;
        }

}
public function edit($id,$name,$text)
{
$data=array("name" => $name,"text" => $text);
$this->db->where( "id", $id );
$query=$this->db->update( "linuji_aboutus", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `linuji_aboutus` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `linuji_aboutus` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `linuji_aboutus` ORDER BY `id` 
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

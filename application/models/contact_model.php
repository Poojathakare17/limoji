<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class contact_model extends CI_Model
{
public function create($address,$contact,$email)
{
$data=array("address" => $address,"contact" => $contact,"email" => $email);
$query=$this->db->insert( "linuji_contact", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("linuji_contact")->row();
return $query;
}
function getsinglecontact($id){
$this->db->where("id",$id);
$query=$this->db->get("linuji_contact")->row();
return $query;
}
public function edit($id,$address,$contact,$email)
{
$data=array("address" => $address,"contact" => $contact,"email" => $email);
$this->db->where( "id", $id );
$query=$this->db->update( "linuji_contact", $data );
return 1;
}
public function getContactInfo($name, $email, $contact, $row)
{
    $data=array("name" => $name,"contact" => $contact,"email" => $email);
    $query=$this->db->insert( "linuji_enquiry", $data );
    $id=$this->db->insert_id();
    for($i=0; $i<count($row); $i++){
        $data=array("value" => $row[$i]['value'],"voltage" => $row[$i]['voltage'],"category" => $row[$i]['category'],"misc" => $row[$i]['misc'],"enquiryid" => $id);
        $query1=$this->db->insert( "linuji_enquirydetail", $data );
        if($query1){
            continue;
        }
        else{
            break;
            return false;
        }
    }
    if(!$query)
    return false;
    else
    return  $query;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `linuji_contact` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `linuji_contact` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `linuji_contact` ORDER BY `id` ASC")->result();
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

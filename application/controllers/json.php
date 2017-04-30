<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getallslider()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_slider`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements[1]=new stdClass();
$elements[1]->field="`linuji_slider`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements[2]=new stdClass();
$elements[2]->field="`linuji_slider`.`text`";
$elements[2]->sort="1";
$elements[2]->header="Text";
$elements[2]->alias="text";

$elements[3]=new stdClass();
$elements[3]->field="`linuji_slider`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$elements[4]=new stdClass();
$elements[4]->field="`linuji_slider`.`status`";
$elements[4]->sort="1";
$elements[4]->header="Status";
$elements[4]->alias="status";

$elements[5]=new stdClass();
$elements[5]->field="`linuji_slider`.`image`";
$elements[5]->sort="1";
$elements[5]->header="Image";
$elements[5]->alias="image";

$elements[6]=new stdClass();
$elements[6]->field="`linuji_slider`.`Type`";
$elements[6]->sort="1";
$elements[6]->header="Type";
$elements[6]->alias="type";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_slider`");
$this->load->view("json",$data);
}
public function getsingleslider()
{
$id=$this->input->get_post("id");
$data["message"]=$this->slider_model->getsingleslider($id);
$this->load->view("json",$data);
}
public function getAllSliderWithoutPagination()
{
$data["message"]=$this->slider_model->getAllSliderWithoutPagination();
$this->load->view("json",$data);
}
public function getAboutUsContent()
{
$data["message"]=$this->aboutus_model->getAboutUsContent(1);
$this->load->view("json",$data);
}
public function getContactInfo()
{
    $data = json_decode(file_get_contents('php://input'), true);
    $name=$data['name'];
    $email=$data['email'];
    $contact=$data['contact'];
    $row=$data['row'];
    echo "row";
    print_r($row);
    $data["message"] = $this->contact_model->getContactInfo($name, $email, $contact, $row);
    $this->load->view("json", $data);
}
function getallaboutus()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_aboutus`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`linuji_aboutus`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`linuji_aboutus`.`text`";
$elements[2]->sort="1";
$elements[2]->header="Description";
$elements[2]->alias="text";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_aboutus`");
$this->load->view("json",$data);
}
public function getsingleaboutus()
{
$id=$this->input->get_post("id");
$data["message"]=$this->aboutus_model->getsingleaboutus($id);
$this->load->view("json",$data);
}

function getallenquiry()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_enquiry`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`linuji_enquiry`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`linuji_enquiry`.`email`";
$elements[2]->sort="1";
$elements[2]->header="Email";
$elements[2]->alias="email";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`linuji_enquiry`.`contact`";
$elements[3]->sort="1";
$elements[3]->header="Contact";
$elements[3]->alias="contact";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_enquiry`");
$this->load->view("json",$data);
}
public function getsingleenquiry()
{
$id=$this->input->get_post("id");
$data["message"]=$this->enquiry_model->getsingleenquiry($id);
$this->load->view("json",$data);
}
function getallcontact()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_contact`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`linuji_contact`.`address`";
$elements[1]->sort="1";
$elements[1]->header="Address";
$elements[1]->alias="address";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`linuji_contact`.`contact`";
$elements[2]->sort="1";
$elements[2]->header="Contact";
$elements[2]->alias="contact";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`linuji_contact`.`email`";
$elements[3]->sort="1";
$elements[3]->header="Email";
$elements[3]->alias="email";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_contact`");
$this->load->view("json",$data);
}
public function getsinglecontact()
{
$id=$this->input->get_post("id");
$data["message"]=$this->contact_model->getsinglecontact($id);
$this->load->view("json",$data);
}
function getallcategory()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`linuji_category`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`linuji_category`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`linuji_category`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`linuji_category`.`text`";
$elements[4]->sort="1";
$elements[4]->header="Text";
$elements[4]->alias="text";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_category`");
$this->load->view("json",$data);
}
public function getsinglecategory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->category_model->getsinglecategory($id);
$this->load->view("json",$data);
}
function getallenquirydetail()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_enquirydetail`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`linuji_enquirydetail`.`enquiryid`";
$elements[1]->sort="1";
$elements[1]->header="enquiryid";
$elements[1]->alias="enquiryid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`linuji_enquirydetail`.`value`";
$elements[2]->sort="1";
$elements[2]->header="value";
$elements[2]->alias="value";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`linuji_enquirydetail`.`voltage`";
$elements[3]->sort="1";
$elements[3]->header="voltage";
$elements[3]->alias="voltage";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`linuji_enquirydetail`.`category`";
$elements[4]->sort="1";
$elements[4]->header="category";
$elements[4]->alias="category";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`linuji_enquirydetail`.`misc`";
$elements[5]->sort="1";
$elements[5]->header="misc";
$elements[5]->alias="misc";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_enquirydetail`");
$this->load->view("json",$data);
}
public function getsingleenquirydetail()
{
$id=$this->input->get_post("id");
$data["message"]=$this->enquirydetail_model->getsingleenquirydetail($id);
$this->load->view("json",$data);
}
} ?>
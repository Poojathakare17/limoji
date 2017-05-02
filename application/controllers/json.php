<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{
    //slider api
public function getAllSliderWithoutPagination()
{
    $data["message"]=$this->slider_model->getAllSliderWithoutPagination();
    $this->load->view("json",$data);
}

        //about us api
public function getAboutUsContent()
{
    $data["message"]=$this->aboutus_model->getAboutUsContent(1);
    $this->load->view("json",$data);
}

        //enquiry form filling api
public function getContactInfo()
{
    $data = json_decode(file_get_contents('php://input'), true);
    $name=$data['name'];
    $email=$data['email'];
    $contact=$data['contact'];
    $row=$data['productEnquiry'];
    if($name!=null) {
        $data["message"] = $this->contact_model->getContactInfo($name, $email, $contact,$row);
    }else {
        $data["message"] = false;
    }
    $this->load->view("json", $data);
}
} ?>
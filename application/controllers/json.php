<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{

public function __construct( )
	{
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

//slider api
public function getAllSliderWithoutPagination()
{
    $data["message"]=$this->slider_model->getAllSliderWithoutPagination();
    $this->load->view("json",$data);
}

public function getSpecialProductSlider()
{
    $data["message"]=$this->slider_model->getSpecialProductSlider();
    $this->load->view("json",$data);
}

        //about us api
public function getAboutUsContent()
{
    $data["message"]=$this->aboutus_model->getAboutUsContent(1);
    $this->load->view("json",$data);
}
        //get all category api
public function getAllCategory()
{
    $data["message"]=$this->category_model->getAllCategory();
    $this->load->view("json",$data);
}

public function getSpecialCategory()
{
    $data["message"]=$this->category_model->getSpecialCategory();
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
        $name = $this->security->xss_clean($name);
		$email = $this->security->xss_clean($email);
        $contact = $this->security->xss_clean($contact);
        $row = $this->security->xss_clean($row);
    if($name!=null) {
        $data["message"] = $this->contact_model->getContactInfo($name, $email, $contact,$row);
    }else {
        $data["message"] = false;
    }
    $this->load->view("json", $data);
}

// products by category
public function getProductsByCategory()
{
    $categoryId=$this->input->get("category");
    $data["message"]=$this->product_model->getProductsByCategory($categoryId);
    $this->load->view("json",$data);
}

public function getSpecialProductsByCategory()
{
    $categoryId=$this->input->get("category");
    $data["message"]=$this->product_model->getSpecialProductsByCategory($categoryId);
    $this->load->view("json",$data);
}
}?>
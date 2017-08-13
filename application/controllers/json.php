<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{

public function __construct( )
	{
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
$this->load->library('email');
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
    if($name!=null) {
        $data["message"] = $this->contact_model->getContactInfo($name, $email, $contact,$row);
    }else {
        $data["message"] = false;
    }
    $this->load->view("json", $data);

    // send email
    for ($i = 0; $i < count($data['productEnquiry']); $i++){
        if($data['productEnquiry'][$i]['category']!='0')
        {
            $data['productEnquiry'][$i]['categoryName']=$this->db->query("SELECT * FROM `linuji_slider` WHERE `id`=".$data['productEnquiry'][$i]['category'])->row()->name;
        }
        else
        {
            $data['productEnquiry'][$i]['categoryName']="";
        }
    }
    $this->email->set_newline("\r\n");
    $email_body = $this->load->view("emailtemplate",$data,true);
    $this->email->from('info@ecap.net.in', 'Ecap');
    $this->email->to('ecapnetin@gmail.com');
    $subject = "Enquiry from ".$name." (".$email.")";
    $this->email->subject($subject);
    $this->email->message($email_body);
    $this->email->send();
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
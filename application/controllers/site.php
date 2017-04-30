<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);
        
    }
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['gender']=$this->user_model->getgenderdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');
            
            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            	
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`logintype`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
        $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['gender']=$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['gender']=$this->user_model->getgenderdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $phone=$this->input->post('phone');
            $billingaddress=$this->input->post('billingaddress');
            $billingcity=$this->input->post('billingcity');
            $billingstate=$this->input->post('billingstate');
            $billingcountry=$this->input->post('billingcountry');
            $billingpincode=$this->input->post('billingpincode');
            $billingcontact=$this->input->post('billingcontact');
            
            $shippingaddress=$this->input->post('shippingaddress');
            $shippingcity=$this->input->post('shippingcity');
            $shippingstate=$this->input->post('shippingstate');
            $shippingcountry=$this->input->post('shippingcountry');
            $shippingpincode=$this->input->post('shippingpincode');
            $shippingcontact=$this->input->post('shippingcontact');
            $shippingname=$this->input->post('shippingname');
            $currency=$this->input->post('currency');
            $credit=$this->input->post('credit');
            $companyname=$this->input->post('companyname');
            $registrationno=$this->input->post('registrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$firstname,$lastname,$phone,$billingaddress,$billingcity,$billingstate,$billingcountry,$billingpincode,$billingcontact,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$shippingcontact,$shippingname,$currency,$credit,$companyname,$registrationno,$vatnumber,$country,$fax,$gender)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    public function viewcart()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcart";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewcartjson?id=").$this->input->get('id');
$data["title"]="View cart";
$this->load->view("templatewith2",$data);
}
function viewcartjson()
{
    $id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_cart`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_cart`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_cart`.`quantity`";
$elements[2]->sort="1";
$elements[2]->header="Quantity";
$elements[2]->alias="quantity";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_cart`.`product`";
$elements[3]->sort="1";
$elements[3]->header="Product";
$elements[3]->alias="product";
$elements[4]=new stdClass();
$elements[4]->field="`fynx_cart`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";
    
$elements[5]=new stdClass();
$elements[5]->field="`fynx_cart`.`size`";
$elements[5]->sort="1";
$elements[5]->header="Size";
$elements[5]->alias="size";

$elements[6]=new stdClass();
$elements[6]->field="`fynx_cart`.`color`";
$elements[6]->sort="1";
$elements[6]->header="Color";
$elements[6]->alias="color";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_cart`","WHERE `fynx_cart`.`user`='$id'");
$this->load->view("json",$data);
}
    public function viewwishlist()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewwishlist";
    $data["before1"]=$this->input->get('id');
        $data["before2"]=$this->input->get('id');
        $data["before3"]=$this->input->get('id');
        $data["before4"]=$this->input->get('id');
        $data["before5"]=$this->input->get('id');
$data['page2']='block/userblock';
$data["base_url"]=site_url("site/viewwishlistjson?id=".$this->input->get('id'));
$data["title"]="View wishlist";
$this->load->view("templatewith2",$data);
}
function viewwishlistjson()
{
    $user=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`fynx_wishlist`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`fynx_wishlist`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`fynx_wishlist`.`product`";
$elements[2]->sort="1";
$elements[2]->header="Product";
$elements[2]->alias="product";
$elements[3]=new stdClass();
$elements[3]->field="`fynx_wishlist`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Timestamp";
$elements[3]->alias="timestamp";
    
$elements[4]=new stdClass();
$elements[4]->field="`fynx_product`.`name`";
$elements[4]->sort="1";
$elements[4]->header="Product Name";
$elements[4]->alias="productname";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `fynx_wishlist` LEFT OUTER JOIN `fynx_product` ON `fynx_product`.`id`=`fynx_wishlist`.`product`","WHERE `fynx_wishlist`.`user`='$user'");
$this->load->view("json",$data);
}
    
    
    
    
public function viewslider()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewslider";
$data["base_url"]=site_url("site/viewsliderjson?type=").$this->input->get('type');
$data["title"]="View slider";
$this->load->view("template",$data);
}
function viewsliderjson()
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
$elements[6]->field="`linuji_slider`.`type`";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_slider`","WHERE `linuji_slider`.`type`=".$this->input->get('type'));
$this->load->view("json",$data);
}

public function createslider()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createslider";
$data["status"]=$this->user_model->getstatusdropdown();
$data["title"]="Create slider";
$this->load->view("template",$data);
}
public function createslidersubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("text","Text","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("type","type","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createslider";
$data["title"]="Create slider";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$text=$this->input->get_post("text");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
$type=$this->input->get("type");
if($this->slider_model->create($name,$text,$order,$status,$image,$type)==0)
$data["alerterror"]="New slider could not be created.";
else
$data["alertsuccess"]="slider created Successfully.";
$data["redirect"]="site/viewslider?type=".$type;
$this->load->view("redirect2",$data);
}
}
public function editslider()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editslider";
$data["title"]="Edit slider";
$data["status"]=$this->user_model->getstatusdropdown();
$data["before"]=$this->slider_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editslidersubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("text","Text","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("type","type","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editslider";
$data["title"]="Edit slider";
$data["before"]=$this->slider_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$text=$this->input->get_post("text");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->menu_model->createImage();
$type=$this->input->get_post("type");
if($this->slider_model->edit($id,$name,$text,$order,$status,$image,$type)==0)
$data["alerterror"]="New slider could not be Updated.";
else
$data["alertsuccess"]="slider Updated Successfully.";
$data["redirect"]="site/viewslider?type=".$type;
$this->load->view("redirect2",$data);
}
}
public function deleteslider()
{
$access=array("1");
$this->checkaccess($access);
$this->slider_model->delete($this->input->get("id"));
$data["redirect"]="site/viewslider?type=".$this->input->get('type');
$this->load->view("redirect2",$data);
}
public function viewaboutus()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewaboutus";
$data["base_url"]=site_url("site/viewaboutusjson");
$data["title"]="View aboutus";
$this->load->view("template",$data);
}
function viewaboutusjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_aboutus`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`linuji_aboutus`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_aboutus`");
$this->load->view("json",$data);
}

public function createaboutus()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createaboutus";
$data["title"]="Create aboutus";
$this->load->view("template",$data);
}
public function createaboutussubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("text","Description","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createaboutus";
$data["title"]="Create aboutus";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$text=$this->input->get_post("text");
if($this->aboutus_model->create($name,$text)==0)
$data["alerterror"]="New aboutus could not be created.";
else
$data["alertsuccess"]="aboutus created Successfully.";
$data["redirect"]="site/viewaboutus";
$this->load->view("redirect",$data);
}
}
public function editaboutus()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editaboutus";
$data["title"]="Edit aboutus";
$data["before"]=$this->aboutus_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editaboutussubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("text","Description","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editaboutus";
$data["title"]="Edit aboutus";
$data["before"]=$this->aboutus_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$text=$this->input->get_post("text");
if($this->aboutus_model->edit($id,$name,$text)==0)
$data["alerterror"]="New aboutus could not be Updated.";
else
$data["alertsuccess"]="aboutus Updated Successfully.";
$data["redirect"]="site/viewaboutus";
$this->load->view("redirect",$data);
}
}
public function deleteaboutus()
{
$access=array("1");
$this->checkaccess($access);
$this->aboutus_model->delete($this->input->get("id"));
$data["redirect"]="site/viewaboutus";
$this->load->view("redirect",$data);
}
public function viewenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewenquiry";
$data["base_url"]=site_url("site/viewenquiryjson");
$data["title"]="View enquiry";
$this->load->view("template",$data);
}
function viewenquiryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_enquiry`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`linuji_enquiry`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`linuji_enquiry`.`email`";
$elements[2]->sort="1";
$elements[2]->header="Email";
$elements[2]->alias="email";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_enquiry`");
$this->load->view("json",$data);
}

public function createenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createenquiry";
$data["title"]="Create enquiry";
$this->load->view("template",$data);
}
public function createenquirysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("contact","Contact","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createenquiry";
$data["title"]="Create enquiry";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$contact=$this->input->get_post("contact");
if($this->enquiry_model->create($name,$email,$contact)==0)
$data["alerterror"]="New enquiry could not be created.";
else
$data["alertsuccess"]="enquiry created Successfully.";
$data["redirect"]="site/viewenquiry";
$this->load->view("redirect",$data);
}
}
public function editenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editenquiry";
$data["title"]="Edit enquiry";
$data["before"]=$this->enquiry_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editenquirysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("contact","Contact","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editenquiry";
$data["title"]="Edit enquiry";
$data["before"]=$this->enquiry_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$contact=$this->input->get_post("contact");
if($this->enquiry_model->edit($id,$name,$email,$contact)==0)
$data["alerterror"]="New enquiry could not be Updated.";
else
$data["alertsuccess"]="enquiry Updated Successfully.";
$data["redirect"]="site/viewenquiry";
$this->load->view("redirect",$data);
}
}
public function deleteenquiry()
{
$access=array("1");
$this->checkaccess($access);
$this->enquiry_model->delete($this->input->get("id"));
$data["redirect"]="site/viewenquiry";
$this->load->view("redirect",$data);
}
public function viewcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcontact";
$data["base_url"]=site_url("site/viewcontactjson");
$data["title"]="View contact";
$this->load->view("template",$data);
}
function viewcontactjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_contact`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`linuji_contact`.`address`";
$elements[1]->sort="1";
$elements[1]->header="Address";
$elements[1]->alias="address";
$elements[2]=new stdClass();
$elements[2]->field="`linuji_contact`.`contact`";
$elements[2]->sort="1";
$elements[2]->header="Contact";
$elements[2]->alias="contact";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_contact`");
$this->load->view("json",$data);
}

public function createcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcontact";
$data["title"]="Create contact";
$this->load->view("template",$data);
}
public function createcontactsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("address","Address","trim");
$this->form_validation->set_rules("contact","Contact","trim");
$this->form_validation->set_rules("email","Email","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcontact";
$data["title"]="Create contact";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$address=$this->input->get_post("address");
$contact=$this->input->get_post("contact");
$email=$this->input->get_post("email");
if($this->contact_model->create($address,$contact,$email)==0)
$data["alerterror"]="New contact could not be created.";
else
$data["alertsuccess"]="contact created Successfully.";
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
}
public function editcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcontact";
$data["title"]="Edit contact";
$data["before"]=$this->contact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcontactsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("address","Address","trim");
$this->form_validation->set_rules("contact","Contact","trim");
$this->form_validation->set_rules("email","Email","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcontact";
$data["title"]="Edit contact";
$data["before"]=$this->contact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$address=$this->input->get_post("address");
$contact=$this->input->get_post("contact");
$email=$this->input->get_post("email");
if($this->contact_model->edit($id,$address,$contact,$email)==0)
$data["alerterror"]="New contact could not be Updated.";
else
$data["alertsuccess"]="contact Updated Successfully.";
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
}
public function deletecontact()
{
$access=array("1");
$this->checkaccess($access);
$this->contact_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
public function viewcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcategory";
$data["base_url"]=site_url("site/viewcategoryjson");
$data["title"]="View category";
$this->load->view("template",$data);
}
function viewcategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`linuji_category`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`linuji_category`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`linuji_category`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_category`");
$this->load->view("json",$data);
}

public function createcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcategory";
$data["status"]=$this->user_model->getstatusdropdown();
$data["title"]="Create category";
$this->load->view("template",$data);
}
public function createcategorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("text","Text","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcategory";
$data["status"]=$this->user_model->getstatusdropdown();
$data["title"]="Create category";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$text=$this->input->get_post("text");
if($this->category_model->create($name,$order,$status,$text)==0)
$data["alerterror"]="New category could not be created.";
else
$data["alertsuccess"]="category created Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function editcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcategory";
$data["title"]="Edit category";
$data["status"]=$this->user_model->getstatusdropdown();
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("text","Text","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcategory";
$data["title"]="Edit category";
$data["status"]=$this->user_model->getstatusdropdown();
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$text=$this->input->get_post("text");
if($this->category_model->edit($id,$name,$order,$status,$text)==0)
$data["alerterror"]="New category could not be Updated.";
else
$data["alertsuccess"]="category Updated Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function deletecategory()
{
$access=array("1");
$this->checkaccess($access);
$this->category_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
public function viewenquirydetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewenquirydetail";
$data["base_url"]=site_url("site/viewenquirydetailjson");
$data["title"]="View enquirydetail";
$this->load->view("template",$data);
}
function viewenquirydetailjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`linuji_enquirydetail`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`linuji_enquirydetail`.`enquiryid`";
$elements[1]->sort="1";
$elements[1]->header="enquiryid";
$elements[1]->alias="enquiryid";
$elements[2]=new stdClass();
$elements[2]->field="`linuji_enquirydetail`.`value`";
$elements[2]->sort="1";
$elements[2]->header="value";
$elements[2]->alias="value";
$elements[3]=new stdClass();
$elements[3]->field="`linuji_enquirydetail`.`voltage`";
$elements[3]->sort="1";
$elements[3]->header="voltage";
$elements[3]->alias="voltage";
$elements[4]=new stdClass();
$elements[4]->field="`linuji_enquirydetail`.`category`";
$elements[4]->sort="1";
$elements[4]->header="category";
$elements[4]->alias="category";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `linuji_enquirydetail`");
$this->load->view("json",$data);
}

public function createenquirydetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createenquirydetail";
$data["title"]="Create enquirydetail";
$this->load->view("template",$data);
}
public function createenquirydetailsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("enquiryid","enquiryid","trim");
$this->form_validation->set_rules("value","value","trim");
$this->form_validation->set_rules("voltage","voltage","trim");
$this->form_validation->set_rules("category","category","trim");
$this->form_validation->set_rules("misc","misc","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createenquirydetail";
$data["title"]="Create enquirydetail";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$enquiryid=$this->input->get_post("enquiryid");
$value=$this->input->get_post("value");
$voltage=$this->input->get_post("voltage");
$category=$this->input->get_post("category");
$misc=$this->input->get_post("misc");
if($this->enquirydetail_model->create($enquiryid,$value,$voltage,$category,$misc)==0)
$data["alerterror"]="New enquirydetail could not be created.";
else
$data["alertsuccess"]="enquirydetail created Successfully.";
$data["redirect"]="site/viewenquirydetail";
$this->load->view("redirect",$data);
}
}
public function editenquirydetail()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editenquirydetail";
$data["title"]="Edit enquirydetail";
$data["before"]=$this->enquirydetail_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editenquirydetailsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("enquiryid","enquiryid","trim");
$this->form_validation->set_rules("value","value","trim");
$this->form_validation->set_rules("voltage","voltage","trim");
$this->form_validation->set_rules("category","category","trim");
$this->form_validation->set_rules("misc","misc","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editenquirydetail";
$data["title"]="Edit enquirydetail";
$data["before"]=$this->enquirydetail_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$enquiryid=$this->input->get_post("enquiryid");
$value=$this->input->get_post("value");
$voltage=$this->input->get_post("voltage");
$category=$this->input->get_post("category");
$misc=$this->input->get_post("misc");
if($this->enquirydetail_model->edit($id,$enquiryid,$value,$voltage,$category,$misc)==0)
$data["alerterror"]="New enquirydetail could not be Updated.";
else
$data["alertsuccess"]="enquirydetail Updated Successfully.";
$data["redirect"]="site/viewenquirydetail";
$this->load->view("redirect",$data);
}
}
public function deleteenquirydetail()
{
$access=array("1");
$this->checkaccess($access);
$this->enquirydetail_model->delete($this->input->get("id"));
$data["redirect"]="site/viewenquirydetail";
$this->load->view("redirect",$data);
}

}
?>

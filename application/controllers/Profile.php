<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	private $cmob;
	private $cem;
	private $cadd;
	private $clogo;
	private $webtitle;
	private $fbook;
	private $twtr;
	private $linked;
	private $gplus;
	private $instgrm;
	private $yout;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->helper('common_helper');
		$this->load->helper('security');
		
		$userTable = company_information();
		if($userTable->num_rows() >0 ){
			foreach($userTable->result() as $user);
			$this->cname=$user->company_name;
			$this->cmob=$user->fcontact;
			$this->cem=$user->email;
			$this->cadd=$user->address;
			$this->clogo=$user->logo;
			$this->webtitle=$user->webtitle;
			$this->fbook=$user->facebook;
			$this->twtr=$user->twitter;
			$this->linked=$user->linkedin;
			$this->gplus=$user->googleplus;
			$this->instgrm=$user->instagram;
			$this->yout=$user->youtube;
		}
		else{
			$this->cname='';
			$this->cmob='';
			$this->cem='';
			$this->cadd='';
			$this->clogo='';
			$this->webtitle='';
			$this->fbook='';
			$this->twtr='';
			$this->linked='';
			$this->gplus='';
			$this->instgrm='';
			$this->yout='';
		}
	}

	function index()
  	{
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
		$data['userOrder']	= $this->Index_model->getDataById('orders','customer_id',$user_id,'order_id','desc','');
		if($data['userOrder']->num_rows() > 0){
			foreach($data['userOrder']->result() as $ord){
			$oid[] = $ord->order_id;
			}
			$data['orderProduct']	= $this->Index_model->getDataByIdArray('orders_products','order_id',$oid,'id','desc','');
				foreach($data['orderProduct']->result() as $ordPro){
				$proId[] = $ordPro->product_id;
			}
			$data['orderproductList']	= $this->Index_model->getDataByIdArray('product','product_id',$proId,'product_id','desc','');
		}
			
		$data['main_content']="frontend/customer/userProfile";
		$this->load->view('template', $data);
	} 
	
	
	function updateprofile()
	{
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_edit_unique[customer.email.'.$user_id.']');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|callback_edit_unique[customer.mobile.'.$user_id.']');
		
			
		if($this->input->post('editProfile') && $this->input->post('editProfile')!=""){
			if($this->form_validation->run() != false){
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/customer/';
				$config['charset'] = "UTF-8";
				$new_name = "customer_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['photo']['name']))
					{
						if($this->upload->do_upload('photo')){
							$upload_data	= $this->upload->data();
							$customer['photo']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimg');
							$customer['photo']	= $upload_data;	
						}
					}
							
				$customer['username']		= $this->input->post('fname').' '.$this->input->post('lname');
				$customer['fname']			= $this->input->post('fname');
				$customer['lname']			= $this->input->post('lname');
				$customer['email']	    	= $this->input->post('email');
				$customer['mobile']	    	= $this->input->post('mobile');
				$customer['address']	    	= $this->input->post('address');
				$customer['company']	    	= $this->input->post('company');
				$customer['country']	    	= $this->input->post('country');
				$customer['city']	    	= $this->input->post('city');
				$customer['thana']	    	= $this->input->post('street');
				$customer['gender']	    	= $this->input->post('gender');
				$customer['zipcode']	    	= $this->input->post('postcode');
				$customer['active']	    = 1;
				$customer['created_date']	= date('Y-m-d H:i:s');
				
				$this->Index_model->update_table('customer','user_id',$user_id,$customer);
				$this->session->set_flashdata('successMsg', '<h3 class="alert alert-success">Successfully Updated </h3>');
				redirect('profile/index/updateprofile', 'refresh');
			}
			else{
				$data['main_content']="frontend/customer/updateprofile";
				$this->load->view('template', $data);
			}
		}
		else{
			$data['main_content']="frontend/customer/updateprofile";
			$this->load->view('template', $data);
		}
	}

	function changepassword()
	{
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		
		if($this->input->post('passwordChange')){
			$data['title'] = 'Error! Password Change';
	
			$outhprovider = $data['userProfile']['oauth_provider'];
			$exspassword = $data['userProfile']['password'];
			if($outhprovider=='facebook' && ($exspassword!="" || $exspassword!=NULL)){
				$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
				$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
				$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
				$old_password = sha1($this->input->post('oldpassword'));
				$queryCheck = $this->Index_model->checkOldPass('customer','email',$userMail,'password',$old_password,'user_id',$user_id);
				//echo $queryCheck->num_rows();
			}
			elseif($outhprovider=='facebook' && ($exspassword=="" || $exspassword==NULL)){
				$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
				$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
				$queryCheck = $this->Index_model->checkOldPass('customer','email',$userMail,'','','user_id',$user_id);
				//echo $queryCheck->num_rows();
			}
			else{
				$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
				$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
				$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
				$old_password = sha1($this->input->post('oldpassword'));
				$queryCheck = $this->Index_model->checkOldPass('customer','email',$userMail,'password',$old_password,'user_id',$user_id);
				//echo $queryCheck->num_rows();
			}
			
			
			if($queryCheck->num_rows() > 0 ){
				if($this->form_validation->run() != false){
					$password =sha1($this->input->post('newPass'));
					$passwordHints =$this->input->post('newPass');
					$dataUpdate = array(
						'password'		=> $password,
						'passwordHints'	=> $passwordHints,
						'modify_date'	=> date('Y-m-d H:i:s')
					);
					
					$query = $this->Index_model->updateTable('customer','user_id',$user_id,$dataUpdate);
					if($query){
						$this->session->set_flashdata('globalMsg', '<h3 class="alert alert-success">Password Change Successfully </h3>');
						redirect('profile/changepassword', 'refresh');
					}
				}
				else{
					$data['main_content']="frontend/customer/changepassword";
					$this->load->view('template', $data);
				}
			}
			else{
				$this->session->set_flashdata('globalMsg', '<dh3iv class="alert alert-danger">Old Password not match </h3>');
				redirect('profile/changepassword', 'refresh');
			}
		}
		else{
			$data['main_content']="frontend/customer/changepassword";
			$this->load->view('template', $data);
		}
	}
	function order_list()
  	{
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
		$data['shippingInfo']	= $this->Index_model->getOneItemTable('shiping_info','userid',$user_id,'id','desc');
		$data['userOrder']	= $this->Index_model->getDataById('orders','customer_id',$user_id,'order_id','desc','');
			
		$data['main_content']="frontend/customer/order_list";
		$this->load->view('template', $data);
	} 
	
	function view_order($order_id)
	 {
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
			$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		
		$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
		foreach($data['order_q']->result() as $rowq);
		$status=$rowq->status;
		
		$data['payment']= $this->Index_model->getDataById('payment_info','order_id',$order_id,'pay_id','desc','1');
		foreach($data['payment']->result() as $rowp);
		$data['pay_method']=$rowp->pay_method;
		$data['transition_id']=$rowp->transition_id;
		$customer_id=$rowp->customer_id;
		$billing_id=$rowp->billing_id;
		$shipping_id=$rowp->shipping_id;
		
		$data['customerQ']= $this->Index_model->getDataById('customer','user_id',$customer_id,'user_id','desc','1');
		$data['billing']= $this->Index_model->getDataById('billing_info','id',$billing_id,'id','desc','1');
		$data['shipping']= $this->Index_model->getDataById('shiping_info','id',$shipping_id,'id','desc','1');
		
		
		$data['customer_id']=$customer_id;
		$data['order_id']=$order_id;
		$data['status']=$status;
		$data['title']="softXmagic | Customer Order Details";
		$data['main_content']="frontend/customer/view_order";
		$this->load->view('template', $data);
	}
	
	
	function product_list()
  	{
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		
			$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
			$data['shippingInfo']	= $this->Index_model->getOneItemTable('shiping_info','userid',$user_id,'id','desc');
			$data['userOrder']	= $this->Index_model->getDataById('orders','customer_id',$user_id,'order_id','desc','');
			if($data['userOrder']->num_rows() > 0){
				foreach($data['userOrder']->result() as $ord){
				$oid[] = $ord->order_id;
				}
				$data['orderProduct']	= $this->Index_model->getDataByIdArray('orders_products','order_id',$oid,'id','desc','');
					foreach($data['orderProduct']->result() as $ordPro){
					$proId[] = $ordPro->product_id;
				}
				$data['orderproductList']	= $this->Index_model->getDataByIdArray('product','product_id',$proId,'product_id','desc','');
			}
		
		$data['main_content']="frontend/customer/productlist";
		$this->load->view('template', $data);
	} 
	
	
	
	function wishlist()
  	{
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		
			$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
			$data['shippingInfo']	= $this->Index_model->getOneItemTable('shiping_info','userid',$user_id,'id','desc');
			$data['userOrder']	= $this->Index_model->getDataById('customer_wishlist','customer_id',$user_id,'wid','desc','');
			if($data['userOrder']->num_rows() > 0){
				foreach($data['userOrder']->result() as $ord){
					$pid[] = $ord->product_id;
				}				
				$data['orderproductList']	= $this->Index_model->getDataByIdArray('product','product_id',$pid,'product_id','desc','');
			}
		
		$data['main_content']="frontend/customer/wishlist";
		$this->load->view('template', $data);
	} 
	
	
	public function edit_unique($value,$params)
	{
		//print_r($params);
		//echo $value;
		$CI =& get_instance();
		$CI->load->database();
	
		$CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
		list($table, $field, $current_id) = explode(".", $params);
		
		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();
	
		if ($query->row() && $query->row()->user_id != $current_id)
		{
			return FALSE;
		} else {
			return TRUE;
		}
		
		
		/*$value = $this->Index_model->checkcustomer($table, $field, $value);	
			
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message($field, 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}*/
	}
	
	
	/*function edit_unique($value, $params)  {
		
		$CI =& get_instance();
		$CI->load->database();
	
		$CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
	
		list($table, $field, $current_id) = explode(".", $params);
	
		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();
	
		if ($query->row() && $query->row()->id != $current_id)
		{
			return FALSE;
		} else {
			return TRUE;
		}
	}*/
	
	
}

?>

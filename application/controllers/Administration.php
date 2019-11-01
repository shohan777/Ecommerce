<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration extends CI_Controller {


	public $cname;
	private $cmob;
	private $cem;
	private $cadd;
	private $clogo;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->model('Stock_model');
		$this->load->model('Reports_model');
		$this->load->model('Pre_stock_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->helper('security');
		$this->load->helper('common_helper');
		
		$userTable = company_information();
		if($userTable->num_rows() >0 ){
			foreach($userTable->result() as $user);
			$this->cname=$user->company_name;
			$this->cmob=$user->contact;
			$this->cem=$user->email;
			$this->cadd=$user->address;
			$this->clogo=$user->logo;
		}
		else{
			$this->cname='';
			$this->cmob='';
			$this->cem='';
			$this->cadd='';
			$this->clogo='';
		}	
    }
    
	function index()
	{
		
		if($this->session->userdata('AdminAccessMail')) redirect("administration/dashboard");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
 
		
		$data['title']="Bargainnshop | Log In";
        $this->load->view('admin/index',$data);
	}

/////////////////////// Admin Part ////////////////////////////////	 
	
	/*function configuration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Admin Registration | Bargainnshop";
		$userId=$this->uri->segment(3);
		$data['configurationUpdate'] = $this->Index_model->getAllItemTable('company_info','','','','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Login Email', 'trim|required');
			
			if($this->form_validation->run() != false){
				$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
				$config['remove_spaces'] = true;
				$config['upload_path'] = './uploads/images/company/';
				$config['charset'] = "UTF-8";
				$new_name = "cmsn_".time();
				$config['file_name'] = $new_name;
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if (isset($_FILES['logo']['name']))
				{
				if($this->upload->do_upload('logo')){
						$upload_data	= $this->upload->data();
						$save['logo']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('mainImg');
						$save['logo']	= $upload_data;	
					}
				}	
						
				$save['fcontact']	= $this->input->post('fcontact');
				$save['bkash']	= $this->input->post('bkash');
				$save['company_name']	= $this->input->post('username');
				$save['contact']	    = $this->input->post('contactno');
				$save['email']	    	= $this->input->post('email');
				$save['address']	    = $this->input->post('address');
				$save['create_on']	    = date('Y-m-d');
				
				if($this->input->post('user_id')!=""){
					$user_id=$this->input->post('user_id');
					$this->Index_model->update_table('company_info','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('company_info', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/configuration', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/configuration/admin_registration";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/configuration/admin_registration";
        $this->load->view('admin_template', $data);
	}*/
	
	
	
	
	
function configuration()
	{
	
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Admin Registration | Bargainnshop";
		$userId=$this->uri->segment(3);
		$data['configurationUpdate'] = $this->Index_model->getAllItemTable('company_info','','','','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Login Email', 'trim|required');
			
			if($this->form_validation->run() != false){
				$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
				$config['remove_spaces'] = true;
				$config['upload_path'] = './uploads/images/company/';
				$config['charset'] = "UTF-8";
				$new_name = "cmsn_".time();
				$config['file_name'] = $new_name;
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if (isset($_FILES['logo']['name']))
				{
				if($this->upload->do_upload('logo')){
						$upload_data	= $this->upload->data();
						$save['logo']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('mainImg');
						$save['logo']	= $upload_data;	
					}
				}
						
				$save['fcontact']		= $this->input->post('fcontact');
				$save['bkash']			= $this->input->post('bkash');
				$save['rocket']			= $this->input->post('rocket');
				$save['company_name']	= $this->input->post('username');
				$save['contact']	    = $this->input->post('contactno');
				$save['email']	    	= $this->input->post('email');
				$save['address']	    = $this->input->post('address');
				$save['webtitle']		= $this->input->post('webtitle');
				$save['editor'] 		= $this->input->post('editor');
				$save['subeditor'] 		= $this->input->post('subeditor');
				$save['facebook'] 		= $this->input->post('facebook');
				$save['twitter'] 		= $this->input->post('twitter');
				$save['linkedin'] 		= $this->input->post('linkedin');
				$save['googleplus'] 	= $this->input->post('googleplus');
				$save['instagram'] 		= $this->input->post('instagram');
				$save['youtube'] 		= $this->input->post('youtube');
	
				$save['create_on']	    = date('Y-m-d');
				
				if($this->input->post('user_id')!=""){
					$user_id=$this->input->post('user_id');
					$this->Index_model->update_table('company_info','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('company_info', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/configuration', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/configuration/general_setting";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/configuration/general_setting";
        $this->load->view('admin_template', $data);
	}
	
	
	
	
	
	
	public function passwordChange()
	{
			$data['title'] =  'Passwored Change | Raisingbd24';
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
				if($this->input->post('changePassword')){
					$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirmpassword]');
					$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
					$old_password = sha1($this->input->post('oldpassword'));
					$usId = $this->session->userdata('AdminAccessId');
					
					$sesemail = $this->session->userdata('AdminAccessMail');
					$queryCheck = $this->Index_model->checkOldPass('users','email',$sesemail,'password',$old_password,'id',$usId);
					//echo $queryCheck->num_rows();
					if($queryCheck->num_rows() >0 ){
						if($this->form_validation->run() != false){
							$password =sha1($this->input->post('password'));
							$passwordHints =$this->input->post('password');
							$dataUpdate = array(
								'password'		=> $password,
								'pass_hints'	=> $passwordHints,
								'active'		=> 1,
								'update_date'	=> date('Y-m-d H:i:s')
							);
							
							$query = $this->Index_model->updateTable('users','id',$usId,$dataUpdate);
							if($query){
								$this->session->set_flashdata('globalMsg','<div class="alert alert-success">Password Change Successfully </div>');
								redirect($_SERVER['HTTP_REFERER'],'refresh');
							}
						}
						else{
							$data['main_content']="admin/configuration/change_password";
							$this->load->view('admin_template', $data);
						}
					}
					else{
						$this->session->set_flashdata('globalMsg', '<div class="alert alert-danger">Old Password not match </div>');
						redirect($_SERVER['HTTP_REFERER'],'refresh');
					}
				}
				else{
					$data['main_content']="admin/configuration/change_password";
					$this->load->view('admin_template', $data);
				}
	}
	
	

/////////////////////// Admin Part ////////////////////////////////	 
	
	
	
	
	
	function dashboard()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Dashboard Bargainnshop | inventory";
		$data['main_content']="admin/dashboard";
        $this->load->view('admin_template',$data);
	}
	function admin_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List Bargainnshop | inventory";
		
		if($this->session->userdata('AdminType')=="Super Admin"){
			$data['admin_list'] = $this->Index_model->getTable('users','id','desc');
		}
		elseif($this->session->userdata('AdminType')=="Sub Admin"){
			$data['admin_list'] = $this->Index_model->getCountryManager();
		}
		elseif($this->session->userdata('AdminType')=="Country Manager"){
			$data['admin_list'] = $this->Index_model->getEmployee();
		}
		
		$data['main_content']="admin/administration/admin_list";
        $this->load->view('admin_template',$data);
	} 
	
	function admin_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Admin Registration | Bargainnshop";
		$userId=$this->uri->segment(3);
		$data['adminUpdate'] = $this->Index_model->getAllItemTable('users','id',$userId,'','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($userId!=''){
				$original_value = $this->db->query("SELECT email FROM users WHERE id = ".$userId)->row()->email;
				if($this->input->post('email') != $original_value) {
				   $is_unique =  '|is_unique[users.email]';
				} else {
				   $is_unique =  '';
			}
		}
		else{
			$is_unique =  '|is_unique[users.email]';	
		}
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Login Email', 'trim|required'.$is_unique);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			
			if($this->form_validation->run() != false){
				if($this->input->post('userAccess')!=""){
				$userAccess = $this->input->post('userAccess');
					//print_r($userAccess);
				$impaccess=implode(',',$userAccess);
				}
				else{
				 $impaccess='';
				}
						
				$save['username']	    = $this->input->post('username');
				$save['contactno']	    = $this->input->post('contactno');
				$save['admin_type']	    = $this->input->post('admintype');
				$save['admin_access']	= $impaccess;
				$save['email']	    	= $this->input->post('email');
				$save['password']	    = sha1($this->input->post('password'));
				$save['pass_hints']	    = $this->input->post('password');
				$save['created_on']	    = date('Y-m-d');
				$save['active']	    	= 1;
				
				
				if($this->input->post('user_id')!=""){
					$user_id=$this->input->post('user_id');
					$this->Index_model->update_table('users','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('users', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/admin_list', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/administration/admin_registration";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/administration/admin_registration";
        $this->load->view('admin_template', $data);
	}


	public function userLogin()
     {
          $username = $this->input->post("username");
  		  $password = $this->input->post("password");
          $this->form_validation->set_rules("username", "Email", "trim|required|min_length[6]|valid_email");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('administration');
          }
          else
          {
                    $usr_result = $this->Index_model->get_AdminLogin($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
					  $sessiondata = array(
						'AdminAccessMail'=>$username,
						'AdminAccessName'=> $usr_result['username'],
						'AdminType'=> $usr_result['admin_type'],
						'AdminAccessPermission'=> $usr_result['admin_access'],
						'AdminAccessId' => $usr_result['id'],
						'password' => TRUE
					   );
						$this->session->set_userdata($sessiondata);
						redirect("administration/dashboard/");
                    }
                    else
                    {
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                     redirect('administration');
                    }
          }
     }
	 
    function logout()
  	{
	  $sessiondata = array(
				'AdminAccessMail'=>'',
				'AdminAccessName'=> '',
				'AdminType'=> '',
				'AdminAccessPermission'=> '',
				'AdminAccessId' => '',
				'password' => FALSE
		 );
	$this->session->unset_userdata($sessiondata);
	$this->session->sess_destroy();
    redirect('administration', 'refresh');
  }
  	
	
	
	////////////// Customer Query/////////////////////////////////////////////////////////
	function customerQuery_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$adminid = $this->session->userdata('AdminAccessId');
		
		$data['title']="customer List | Bargainnshop";
		$details=$this->uri->segment(3);
		$data['customer_list'] = $this->Index_model->getAllItemTable('customer_query','user_id',$adminid,'','','id','desc');
		if($details!=''){
			$mid=$this->uri->segment(4);
			$data['customerDetails'] = $this->Index_model->getAllItemTable('customer_query','user_id',$adminid,'id',$details,'id','desc');
			$data['main_content']="admin/customer_query/customerDetails";
		}
		else{
			$data['main_content']="admin/customer_query/customer_list";
		}
		$this->load->view('admin_template',$data);
	} 
	
	////////////// Customer Part/////////////////////////////////////////////////////////
	function customer_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="customer List | Bargainnshop";
		$details=$this->uri->segment(3);
		$data['customer_list'] = $this->Index_model->getTable('customer','user_id','desc');
		if($details!=''){
			$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$details,'user_id','desc');
			$data['shippingInfo']	= $this->Index_model->getOneItemTable('shiping_info','userid',$details,'id','desc');
			$data['userOrder']	= $this->Index_model->getDataById('orders','customer_id',$details,'order_id','desc','');
			$data['customerDetails'] = $this->Index_model->getAllItemTable('customer','user_id',$details,'','','user_id','desc');
			$data['main_content']="admin/customer/customerDetails";
		}
		else{
			$data['main_content']="admin/customer/customer_list";
		}
		$this->load->view('admin_template',$data);
	} 
	
	function customer_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$mid=$this->uri->segment(3);
		$data['countryAll']= $this->Index_model->getDataById('countryall','parent_id','22','name','asc','');
		$data['customerUpdate'] = $this->Index_model->getAllItemTable('customer','user_id',$mid,'','','user_id','desc');
		//print_r($data['customerUpdate']);
		$data['title']="Customer Registration | Bargainnshop";
		
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		if(isset($mid) && $mid!=""){
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_edit_unique[customer.email.'.$mid.']');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|is_unique[customer.mobile.'.$mid.']');
		}
		else{
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_edit_unique[customer.email]');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|is_unique[customer.mobile]');
		}
			
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
				
				
				if($this->input->post('customer_id')!=""){
					$customer_id=$this->input->post('customer_id');
					$this->Index_model->update_table('customer','user_id',$customer_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('customer', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				
				redirect('administration/customer_list', 'refresh');
			}
			else{
				$data['main_content']="admin/customer/customer_action";
       			$this->load->view('admin_template', $data);
			}
		}
		else{
			$data['main_content']="admin/customer/customer_action";
			$this->load->view('admin_template', $data);
		}
	}
	
	



/////////////////////// menu ////////////////////////////////	 
	function menu_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Menu List | Bargainnshopbd";
		$data['menu_list'] = $this->Index_model->getTable('menu','m_id','desc');
		$data['main_content']="admin/menu/menu_list";
        $this->load->view('admin_template',$data);
	} 
	 
   function update_sequence()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$seqence=$this->input->get('sequence');
		$id=$this->input->get('id');
		$this->Index_model->update_squnce($seqence,$id);   
		redirect('administration/menu_list', '');
	}
	
	function menu_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['menuUpdate'] = $this->Index_model->getAllItemTable('menu','m_id',$artiId,'','','m_id','desc');
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','root_id',0,'','','menu_name','asc');
		if(!$artiId){
			$data['title']="Menu Registration | Eve & Yongstar";
			$this->form_validation->set_rules('menu_name', 'menu name', 'trim|required|is_unique[menu.menu_name]');
		}
		else{
			$data['title']="menu Update | Bargainnshopbd";
			$this->form_validation->set_rules('menu_name', 'menu name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				$expval=explode(' ',$this->input->post('menu_name'));
				$impval=implode('-',$expval);
				$save['menu_name']	    = addslashes($this->input->post('menu_name'));
				$save['slug']	    = addslashes(strtolower($impval));
				$save['page_structure']	    = $this->input->post('page_structure');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('m_id')!=""){
					$m_id=$this->input->post('m_id');
					$this->Index_model->update_table('menu','m_id',$m_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('menu', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/menu_list', 'refresh');
			}
			else{
				$data['main_content']="admin/menu/menu_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/menu/menu_action";
        $this->load->view('admin_template', $data);
	}
	
	
	//'.base_url("administration/ajaxData?sroot_id='+this.value+'").'
	function ajaxData()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$url="'".base_url()."administration/ajaxData?sroot_id='+this.value+''";
			$sroot_menu = $this->Index_model->getAllItemTable('menu','root_id',$rid,'','','menu_name','asc');
			$svar='<select name="sroot_id" class="form-control" style="width:60%;" onChange="getSubMenu('.$url.')">
								<option value="">Sub Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->m_id.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('sroot_id')!=""){
			$rid=$this->input->get('sroot_id');
			$sroot_menu = $this->Index_model->getAllItemTable('menu','sroot_id',$rid,'','','menu_name','asc');
			$svar='<select name="lroot_id" class="form-control" style="width:60%;">
								<option value="">Last Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->m_id.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}


public function menu_check($str,$boutique)
	{
		$value = $this->Index_model->menu_exist($str,$boutique);		
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message('m_name', 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	
	
	/////////////////////// article ////////////////////////////////	 
	function article_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List | Bargainnshop";
		$data['article_list'] = $this->Index_model->getTable('article_manage','a_id','desc');
		$data['main_content']="admin/article/article_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function article_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','','','','','menu_name','asc');
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Article Registration | Bargainnshop";
		}
		else{
			$data['title']="Article Update | Bargainnshop";
		}
		$data['articleUpdate'] = $this->Index_model->getAllItemTable('article_manage','a_id',$artiId,'','','a_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('headline', 'Article Headline', 'trim|required');
			$this->form_validation->set_rules('details', 'Article Details', 'trim|required');
			
			if($this->form_validation->run() != false){
				$save['menu_title']	    = $this->input->post('root_id');
				$save['headline']	    = $this->input->post('headline');
				$save['details']	    	= $this->input->post('details');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('a_id')!=""){
					$a_id=$this->input->post('a_id');
					$this->Index_model->update_table('article_manage','a_id',$a_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('article_manage', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/article_list', 'refresh');
			}
			else{
				$data['main_content']="admin/article/article_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
				$data['main_content']="admin/article/article_action";
        		$this->load->view('admin_template', $data);
				}
	}


/////////////////////// Category ////////////////////////////////	 
	function category_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Category List | Bargainnshop";
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		$data['main_content']="admin/product_category/category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function category_registration()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Category List | Bargainnshop";
		$artiId=$this->uri->segment(3);
		$data['categoryUpdate'] = $this->Index_model->getAllItemTable('category','cid',$artiId,'','','cid','desc');
		
		$this->form_validation->set_rules('category_name', 'category name', 'trim|required');
		//$this->form_validation->set_rules('class_id', 'Class', 'trim|required');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/category/';
				$config['charset'] = "UTF-8";
				$new_name = "category_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
					
				$config1['allowed_types'] = '*';
				$config1['remove_spaces'] = true;
				$config1['max_size'] = '1000000';
				$config1['upload_path'] = './uploads/images/product_category/category/banner/';
				$config1['charset'] = "UTF-8";
				$new_nameb = "Banner_".time();
				$config1['file_name'] = $new_nameb;
				$this->load->library('upload', $config1);
				$this->upload->initialize($config1);
					if (isset($_FILES['banImage']['name']))
					{
						if($this->upload->do_upload('banImage')){
							$upload_data	= $this->upload->data();
							$save['banImage']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimageB');
							$save['banImage']	= $upload_data;	
						}
					}	
				
				$expval=explode(' ',$this->input->post('category_name'));
				$impval=implode('-',$expval);
				$save['homepage']	    = $this->input->post('homepage');
				$save['cat_name']	    = addslashes($this->input->post('category_name'));
				$save['caegory_title']	    = addslashes(strtolower($impval));
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				$save['seller_commission']	    = $this->input->post('seller_commission');
				
				if($this->input->post('cid')!=""){
					$cid=$this->input->post('cid');
					$this->Index_model->update_table('category','cid',$cid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/product_category/category_action";
			$this->load->view('admin_template', $data);
		}
	}
	


/////////////////////// sub_category ////////////////////////////////	 
	function sub_category_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="sub_category List | Bargainnshop";
		$data['sub_category_list'] = $this->Index_model->getTable('sub_category','scid','desc');
		$data['main_content']="admin/product_category/sub_category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function sub_category_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$artiId=$this->uri->segment(3);
		$cate=$this->input->post('category');

		$data['sub_categoryUpdate'] = $this->Index_model->getAllItemTable('sub_category','scid',$artiId,'','','scid','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		if(!$artiId){
			$data['title']="sub_category Registration | Bargainnshop";
			//$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required|is_unique[sub_category.sub_cat_name]');
			$this->form_validation->set_rules('sub_category_name', 'Sub Category name', 'callback_subcategory_check['.$cate.']');
		}
		else{
			$data['title']="sub_category Update | Bargainnshop";
			$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/sub_category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				
				$expval=explode(' ',$this->input->post('sub_category_name'));
				$impval=implode('-',$expval);
				$save['cat_id']	    = $cate;
				$save['sub_cat_name']	    = addslashes($this->input->post('sub_category_name'));
				$save['sub_cat_title']	    = addslashes(strtolower($impval));
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('scid')!=""){
					$scid=$this->input->post('scid');
					$this->Index_model->update_table('sub_category','scid',$scid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('sub_category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/sub_category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/sub_category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/product_category/sub_category_action";
        $this->load->view('admin_template', $data);
	}

	public function subcategory_check($str,$catid)
	{
		$value = $this->Index_model->subcategory_exist($str,$catid);		
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message('subcategory_check', 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	
	/////////////////////// last_category ////////////////////////////////	 
	function last_category_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']= "last_category List | Bargainnshop.shop";
		$data['last_category_list'] = $this->Index_model->getTable('last_category','id','desc');
		$data['main_content']="admin/product_category/last_category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function last_category_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$artiId=$this->uri->segment(3);

		$cate=$this->input->post('cat_id');
		$scate=$this->input->post('subcat_id');
		$data['last_categoryUpdate'] = $this->Index_model->getAllItemTable('last_category','id',$artiId,'','','id','desc');
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		if(!$artiId){
			$data['title']="last_category Registration | Bargainnshop.shop";
			//$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required|is_unique[last_category.lastcat_name]');
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required');
		}
		else{
			$data['title']="last_category Update | Bargainnshop.shop";
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/last_category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				$save['cat_id']	    = $cate;
				$save['subcat_id']	    = $scate;
				$expval=explode(' ',$this->input->post('last_category_name'));
				$impval=implode('-',$expval);
				$save['lastcat_name']	    = addslashes($this->input->post('last_category_name'));
				$save['last_cat_title']	    = addslashes($impval);
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('last_category','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('last_category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/last_category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/last_category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/product_category/last_category_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	
	function ajaxCatData()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$url="'".base_url()."administration/ajaxData?sroot_id='+this.value+''";
			$sroot_category = $this->Index_model->getAllItemTable('category','root_id',$rid,'','','category_name','asc');
			$svar='<select name="sroot_id" class="form-control" style="width:60%;" onChange="getSubcategory('.$url.')">
								<option value="">Sub category</option>';
								 foreach($sroot_category->result() as $rootcategory):
									$svar .= '<option value="'.$rootcategory->cid.'">'.$rootcategory->category_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('sroot_id')!=""){
			$rid=$this->input->get('sroot_id');
			$sroot_category = $this->Index_model->getAllItemTable('category','sroot_id',$rid,'','','category_name','asc');
			$svar='<select name="lroot_id" class="form-control" style="width:60%;">
								<option value="">Last category</option>';
								 foreach($sroot_category->result() as $rootcategory):
									$svar .= '<option value="'.$rootcategory->cid.'">'.$rootcategory->category_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}




	
	/////////////////////// banner ////////////////////////////////	 
	function banner_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="banner List | Bargainnshop";
		$data['banner_list'] = $this->Index_model->getTable('banner','b_id','desc');
		$data['main_content']="admin/banner/banner_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function banner_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");	
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Banner Registration | Bargainnshop";
		}
		else{
			$data['title']="Banner Update | Bargainnshop";
		}
		$data['bannerUpdate'] = $this->Index_model->getAllItemTable('banner','b_id',$artiId,'','','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('banner_name', 'banner name', 'trim|required');
			
			if($this->form_validation->run() != false){
				
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/banner/';
			$config['charset'] = "UTF-8";
			$new_name = "Banner_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
				if (isset($_FILES['bannerPhoto']['name']))
				{
					if($this->upload->do_upload('bannerPhoto')){
						$upload_data	= $this->upload->data();
						$save['image']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('stillimg');
						$save['image']	= $upload_data;	
					}
				}	
				
				$save['banner_name']	    = $this->input->post('banner_name');
				$save['subtitle']	    = $this->input->post('subtitle');
				$save['bg_color']	    = $this->input->post('bg_color');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('banner','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('banner', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/banner_list', 'refresh');
			}
			else{
				$data['main_content']="admin/banner/banner_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/banner/banner_action";
        $this->load->view('admin_template', $data);
	}

	function shipping_charge_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Menu List | Bargainnshopbd";
		$data['charge_list'] = $this->Index_model->getTable('shipping_charge','id','desc');
		$data['main_content']="admin/shipping_charge/shipping_charge_list";
        $this->load->view('admin_template',$data);
	} 
	 

	function shipping_charge_registration()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$artiId=$this->uri->segment(3);
		$data['chargeUpdate'] = $this->Index_model->getAllItemTable('shipping_charge','id',$artiId,'','','id','desc');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('charge', 'Charge', 'trim|required');
        
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				$save['location']	= addslashes($this->input->post('location'));
				$save['charge']		= $this->input->post('charge');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('shipping_charge','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('shipping_charge', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/shipping_charge_list', 'refresh');
			}
			else{
				$data['main_content']="admin/shipping_charge/shipping_charge_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/shipping_charge/shipping_charge_action";
        $this->load->view('admin_template', $data);
	}


/////////////////////// offer ////////////////////////////////	 
	function offer_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="offer List | Bargainnshop";
		$data['offer_list'] = $this->Index_model->getTable('offer','b_id','desc');
		$data['main_content']="admin/offer/offer_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function offer_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");	
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="offer Registration | Bargainnshop";
		}
		else{
			$data['title']="offer Update | Bargainnshop";
		}
		$data['offerUpdate'] = $this->Index_model->getAllItemTable('offer','b_id',$artiId,'','','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('position', 'offer position', 'trim|required');
			
			if($this->form_validation->run() != false){
				
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/offer/';
			$config['charset'] = "UTF-8";
			$new_name = "offer_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
				if (isset($_FILES['offerPhoto']['name']))
				{
					if($this->upload->do_upload('offerPhoto')){
						$upload_data	= $this->upload->data();
						$save['image']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('stillimg');
						$save['image']	= $upload_data;	
					}
				}	
				
				$save['offer_name']	    = $this->input->post('offer_name');
				$save['url']	   	 = $this->input->post('url');
				$save['position']	    = $this->input->post('position');
				$save['banner']	    = $this->input->post('banner');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('offer','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('offer', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/offer_list', 'refresh');
			}
			else{
				$data['main_content']="admin/offer/offer_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/offer/offer_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	
	
	/////////////////////// cupon ////////////////////////////////	 
	function cupon_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Cupon List | Bargainnshop";
		$data['cupon_list'] = $this->Index_model->getTable('cupon','id','desc');
		$data['main_content']="admin/cupon/list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function cupon_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");	
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="cupon Registration | Bargainnshop";
		}
		else{
			$data['title']="cupon Update | Bargainnshop";
		}
		
		
		
		$data['cuponUpdate'] = $this->Index_model->getAllItemTable('cupon','id',$artiId,'','','id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('cname', 'cupon name', 'trim|required');
			//$this->form_validation->set_rules('price', 'cupon price', 'trim|required');
			$this->form_validation->set_rules('code', 'cupon code', 'trim|required');
			
			if($this->form_validation->run() != false){			
				$save['cname']	    = $this->input->post('cname');
				$save['code']	   	 = $this->input->post('code');
				//$save['price']	    = $this->input->post('price');
				$save['discount']		= $this->input->post('discount');
				$save['dis_type']		= $this->input->post('dis_type');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('cupon','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('cupon', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/cupon_list', 'refresh');
			}
			else{
				$data['main_content']="admin/cupon/action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/cupon/action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	/////////////////////// cupon_user ////////////////////////////////	 
	function cupon_user_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Cupon List | Bargainnshop";
		$data['cupon_user_list'] = $this->Index_model->getTable('cupon_user','id','desc');
		$data['main_content']="admin/cupon_user/list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function cupon_user_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");	
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="cupon_user Registration | Bargainnshop";
		}
		else{
			$data['title']="cupon_user Update | Bargainnshop";
		}
		$data['cupon_list'] = $this->Index_model->getTable('cupon','id','desc');
		$data['customer_list'] = $this->Index_model->getTable('customer','user_id','desc');
		
		$data['cupon_userUpdate'] = $this->Index_model->getAllItemTable('cupon_user','id',$artiId,'','','id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('cid', 'Cupon', 'trim|required');
			//$this->form_validation->set_rules('user_id', 'Customer', 'trim|required');
			
			if($this->form_validation->run() != false){			
				$save['cid']	    	= $this->input->post('cid');
				$save['user_id']	   	= $this->input->post('user_id');
				$save['start_date']	    = date('Y-m-d',strtotime($this->input->post('start_date')));
				$save['end_date']	    = date('Y-m-d',strtotime($this->input->post('end_date')));
				$save['date']	   		= date('Y-m-d');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('cupon_user','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('cupon_user', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/cupon_user_list', 'refresh');
			}
			else{
				$data['main_content']="admin/cupon_user/action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/cupon_user/action";
        $this->load->view('admin_template', $data);
	}
	
	

	function subscription_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="review List | Bargainnshop";
		$data['subscription_list'] = $this->Index_model->getTable('subscriptions','id','desc');
		$data['main_content']="admin/subscription/subscription_list";
        $this->load->view('admin_template',$data);
	} 
	
	/////////////////////// review ////////////////////////////////	 
	function review_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="review List | Bargainnshop";
		$data['review_list'] = $this->Index_model->getTable('product_rating','id','desc');
		$data['main_content']="admin/review/review_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function review_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");	
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="review Registration | Bargainnshop";
		}
		else{
			$data['title']="review Update | Bargainnshop";
		}
		$data['reviewUpdate'] = $this->Index_model->getAllItemTable('product_rating','id',$artiId,'','','id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('pro_id', 'Product Name', 'trim|required');
			
			if($this->form_validation->run() != false){
				
				$save['pro_id']	    = $this->input->post('pro_id');
				$save['username']	    = $this->input->post('username');
				$save['review_title']	    = $this->input->post('review_title');
				$save['ratval']	    = $this->input->post('ratingVal');
				$save['review']	    = $this->input->post('review');
				$save['date']		= date('Y-m-d');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('product_rating','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('product_rating', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/review_list', 'refresh');
			}
			else{
				$data['main_content']="admin/review/review_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/review/review_action";
        $this->load->view('admin_template', $data);
	}

	




/////////////////////// size ////////////////////////////////	 
	function size_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="size List | MMK Group";
		
		
		$totalResources = $this->Index_model->getTable('size','size_id','desc');
		$config = array();
		$config['base_url'] = base_url('administration/size_list');
		$config["per_page"] = 10;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config["total_rows"] = $totalResources->num_rows();
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;			
		$data['size_list']=$this->Index_model->getDataByIdWithPagination('size','','','size_id','desc',$config['per_page'], $page);
		
		//$data['size_list'] = $this->Index_model->getTable('size','size_id','desc');
		$data['main_content']="admin/size/size_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function size_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$artiId=$this->uri->segment(3);
		$data['sizeUpdate'] = $this->Index_model->getAllItemTable('size','size_id',$artiId,'','','size_id','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		$data['title']="size Update | MMK Group";
		$this->form_validation->set_rules('size_name', 'size name', 'trim|required');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$save['size']		= $this->input->post('size_name');
				$catname_explode = explode(" ", $save['size']);
				$slug=implode("-" ,$catname_explode);
				$save['size_title']	= $slug; 
				$save['status']	= $this->input->post('status');
				$save['cat_id']	= $this->input->post('category');
				$save['create_date']		= date('Y-m-d');
				
				if($this->input->post('size_id')!=""){
					$size_id=$this->input->post('size_id');
					$this->Index_model->update_table('size','size_id',$size_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('size', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/size_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/size_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/size/size_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	
	/////////////////////// color ////////////////////////////////	 
	function color_list()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="color List | bargainnshop";
		//$data['color_list'] = $this->Index_model->getTable('color','color_id','desc');
		$totalResources = $this->Index_model->getTable('color','color_id','desc');
		$config = array();
		$config['base_url'] = base_url('administration/color_list');
		$config["per_page"] = 10;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config["total_rows"] = $totalResources->num_rows();
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;			
		$data['color_list']=$this->Index_model->getDataByIdWithPagination('color','','','color_id','desc',$config['per_page'], $page);
		//$data['color_list'] = $this->db->query("SELECT * FROM color GROUP BY cat_id ORDER BY color_id DESC");
		$data['main_content']="admin/color/color_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function color_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$artiId=$this->uri->segment(3);
		$data['colorUpdate'] = $this->Index_model->getAllItemTable('color','color_id',$artiId,'','','color_id','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		$data['title']="color Update | bargainnshop";
		$this->form_validation->set_rules('color_name', 'color name', 'trim|required');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$save['color']		= $this->input->post('color_name');
				$save['color_title']	= $this->input->post('code');
				$save['status']	= $this->input->post('status');
				$save['cat_id']	= $this->input->post('category');
				$save['create_date']		= date('Y-m-d');
				
				if($this->input->post('color_id')!=""){
					$color_id=$this->input->post('color_id');
					$this->Index_model->update_table('color','color_id',$color_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('color', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/color_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/color_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/color/color_action";
        $this->load->view('admin_template', $data);
	}
	

////////////////////////////// In Stock Product ////////////////////////////////	
///////////////////////////////////// ====^^^^^=====!!!!!!!======================///////////////////////////////////
	function product_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Product List | Bargainnshop";
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		//$data['product_list'] = $this->Index_model->getInstockProduct();
		$keywords = $this->input->post('keywords');
		$category = $this->input->post('category');
		
		$totalResources = $this->Index_model->getProductListCount($keywords,$category);
		$config = array();
		$config['base_url'] = base_url('administration/product_list');
		$config["per_page"] = 10;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config["total_rows"] = $totalResources->num_rows();
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;			
		$data['product_list'] = $this->Index_model->getProductList($keywords,$category,$config["per_page"],$page);
		
		$data['main_content']="admin/product/product_list";
        $this->load->view('admin_template',$data);
	}


	/* product range */

	function bonusRange()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['successMsg'] = $this->session->flashdata('successMsg');
		 
		if (!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title'] = "Product List | Bargainnshop";
		 
		$fromamount = $this->input->post('from_pro_amount');
		if($fromamount){
			$save['from_pro_amount']= $fromamount;
			$save['to_pro_amount']	= $this->input->post('to_pro_amount');
			$save['bonus_amount']	= $this->input->post('bonus_amount');
			$save['status']		=    $this->input->post('status');
			$this->Index_model->inertTable('bonusrange', $save);
			$this->session->set_flashdata('successMsg', 'Successfully  ');
			redirect("Administration/bonusRange");
		}
		
		$data['main_content'] = "admin/product/bonusrange";
		$this->load->view('admin_template', $data);

		
	}
/* bonus range list */
	function bonusrangelist()
	{

		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if (!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title'] = "Product List | Bargainnshop";
		 
		//$data['product_list'] = $this->Index_model->getInstockProduct();
		$keywords = $this->input->post('keywords');
		$category = $this->input->post('category');

		$totalResources = $this->Index_model->getProductListCount($keywords, $category);
		$config = array();
		$config['base_url'] = base_url('administration/bonusrangelist');
		$config["per_page"] = 10;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	
		$config["total_rows"] = $totalResources->num_rows();
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['pageSl'] = $page;
		$data['product_list'] = $this->Index_model->getProductList($keywords, $category, $config["per_page"], $page);
		// echo "<pre>";
		// print_r($data['product_list']->result());
		// die;
		$data['main_content'] = "admin/product/bonusrangelist";
		$this->load->view('admin_template', $data);
	}

	 
	function product_registration()
	{
		 
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Product Insert | Bargainnshop";
		}
		else{
			$data['title']="Product Update | Bargainnshop";
		}
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
        $data['productUpdate'] = $this->Index_model->getAllItemTable('product','product_id',$artiId,'','','product_id','desc');
        
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
		if($artiId!=""){
			$this->form_validation->set_rules('pro_code', 'Product Code', 'trim|required');
			$this->form_validation->set_rues('pro_name', 'Product Name', 'trim|required');
		}
		else{
			$this->form_validation->set_rules('pro_code', 'Product Code', 'trim|required|is_unique[product.pro_code]');
			$this->form_validation->set_rules('pro_name', 'Product Name', 'trim|required|is_unique[product.product_name]');
		}
		
		$this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
		$this->form_validation->set_rules('full_description', 'Product Details', 'trim|required');
		/*if (empty($_FILES['main_images']['name']))
		{
			$this->form_validation->set_rules('main_images', 'Product Image', 'required');
		}*/
		
		if ($this->form_validation->run() != FALSE){
				ini_set( 'memory_limit', '200M' );
				ini_set('max_input_time', 3600);  
				ini_set('max_execution_time', 3600);

				$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
				$config['remove_spaces'] = true;
				$config['upload_path'] = './uploads/images/product/main_img/';
				$config['charset'] = "UTF-8";
				$new_name = "Bargainnshop_".time();
				$config['file_name'] = $new_name;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
			
				if (isset($_FILES['main_images']['name']))
				{
					if($this->upload->do_upload('main_images')){
						$upload_data	= $this->upload->data();
						$save['main_image']	= $upload_data['file_name'];
						$this->_CreatePageThumbnail($upload_data['file_name'], $config['upload_path'],250,300);			
						$save['thumb'] = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
					}
					else{
						$upload_data	= $this->input->post('mainImg');
						$save['thumb']=$this->input->post('thumbImg');
						$save['main_image']	= $upload_data;	
					}
				}	
			
				$config2['allowed_types'] = '*';
				$config2['remove_spaces'] = true;
				$config2['max_size'] = '1000000';
				$config2['upload_path'] = './uploads/images/product/photo1/';
				$config2['charset'] = "UTF-8";
				$new_name2 = "Bargainnshop_".time();
				$config2['file_name'] = $new_name2;
				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
			
				if (isset($_FILES['photo1']['name']))
				{
				if($this->upload->do_upload('photo1')){
						$upload_data	= $this->upload->data();
						$save['photo1']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('photo1');
						$save['photo1']	= $upload_data;	
					}
				}
			
				$config3['allowed_types'] = '*';
				$config3['remove_spaces'] = true;
				$config3['max_size'] = '1000000';
				$config3['upload_path'] = './uploads/images/product/photo2/';
				$config3['charset'] = "UTF-8";
				$new_name3 = "Bargainnshop_".time();
				$config3['file_name'] = $new_name3;
				$this->load->library('upload', $config3);
				$this->upload->initialize($config3);
				
				if (isset($_FILES['photo2']['name']))
				{
				if($this->upload->do_upload('photo2')){
						$upload_data	= $this->upload->data();
						$save['photo2']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('photo2');
						$save['photo2']	= $upload_data;	
					}
				}
			
				
				$config4['allowed_types'] = '*';
				$config4['remove_spaces'] = true;
				$config4['max_size'] = '1000000';
				$config4['upload_path'] = './uploads/images/product/photo3/';
				$config4['charset'] = "UTF-8";
				$new_name4 = "Bargainnshop_".time();
				$config4['file_name'] = $new_name4;
				$this->load->library('upload', $config4);
				$this->upload->initialize($config4);
				
				if (isset($_FILES['photo3']['name']))
				{
				if($this->upload->do_upload('photo3')){
						$upload_data	= $this->upload->data();
						$save['photo3']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('photo3');
						$save['photo3']	= $upload_data;	
					}
				}	
					
				$config5['allowed_types'] = '*';
				$config5['remove_spaces'] = true;
				$config5['max_size'] = '1000000';
				$config5['upload_path'] = './uploads/images/product/photo3/';
				$config5['charset'] = "UTF-8";
				$new_name5 = "Bargainnshop_".time();
				$config5['file_name'] = $new_name5;
				$this->load->library('upload', $config5);
				$this->upload->initialize($config5);
				
				if (isset($_FILES['photo4']['name']))
				{
				if($this->upload->do_upload('photo4')){
						$upload_data	= $this->upload->data();
						$save['photo4']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('photo4');
						$save['photo4']	= $upload_data;	
					}
				}
					
				$pro_size = $this->input->post('pro_size');
				if($pro_size!=""){
					$proSize=join(',', $pro_size);
				}
				else{
					$proSize="";
				}
				$pro_color = $this->input->post('pro_color');
				if($pro_color!=""){
					$procolor=join(',', $pro_color);
				}
				else{
					$procolor="";
				}
		
		  		$productCode = $this->input->post('pro_code');
				$save['product_name']	    = addslashes($this->input->post('pro_name'));
				$proTitle = explode(' ',$this->input->post('pro_name'));
				$proUrl = implode("-",$proTitle);
				$save['slug']		= str_replace('/', '', strtolower($proUrl));
				$save['pro_code']		= $productCode;
				$save['cat_id']	    = $this->input->post('cat_id');
				$save['scat_id']	    = $this->input->post('subcat_id');
				$save['lcat_id']	    = $this->input->post('lastcat_id');
				$save['details']	    = addslashes($this->input->post('full_description'));
				$save['size']	    = $proSize;
				$save['color']	    = $procolor;
				$save['seo_title']		= $this->input->post('seo_title');
				$save['keyword']	    = $this->input->post('keyword');
				$save['seo_details']	= $this->input->post('meta_details');
				$save['status']		=    $this->input->post('status');
				$save['product_bonus']		=    $this->input->post('product_bonus');

				$save['supplier']		=    $this->input->post('supplier');
				$save['preorder']		=    $this->input->post('preorder');
				$save['purchase_price']		=    $this->input->post('purchase_price');
				$save['price']		=    $this->input->post('price');
				$save['market_price']		=    $this->input->post('market_price');
				$save['preorder']		=    $this->input->post('preorder');
				$save['discount']		= $this->input->post('discount');
				$save['dis_type']		= $this->input->post('dis_type');
				$save['entry_date']		= date('Y-m-d');
				$save['product_video']	= $this->input->post('product_video');
                
                 
				if($this->input->post('product_id')!=""){
					$b_id=$this->input->post('product_id');
					$query = $this->Index_model->update_table('product','product_id',$b_id,$save);
					$productInfo= $this->Index_model->getDataById('stock','pro_id',$b_id,'s_id','desc','');
						$data_array=array(
								'pro_id'=>$b_id,
								'pro_code'=>$this->input->post('pro_code'),
								'pro_qty'=>$this->input->post('quantity')
							);
						if($productInfo->num_rows() > 0){
							foreach($productInfo->result() as $val);
							$this->Index_model->update_table('stock','pro_id',$b_id,$data_array);
						}
						else{
							$this->Index_model->inertTable('stock', $data_array);	
						}
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully Updated</h2>');
					redirect('administration/product_list', 'refresh');
				}
				else{
					$query = $this->Index_model->inertTable('product', $save);
					$data_array=array(
						'pro_id'=>$query,
						'pro_code'=>$this->input->post('pro_code'),
						'pro_qty'=>$this->input->post('quantity')
					);
					$this->Index_model->inertTable('stock', $data_array);
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Failed to Inserted</h2>');
					redirect('administration/product_list', 'refresh');
				}
				
				
			}
			else{
				$data['main_content']="admin/product/product_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/product/product_action";
			$this->load->view('admin_template', $data);
		}
	}
		
///////////  Stock, Acocunt and Orders///////////////////////

	function order_list()
	 {
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		
		$data['orderinfo'] = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');
		$data['title']="Bargainnshop | Customer Order List";
		if($this->session->userdata('AdminType') && $this->session->userdata('AdminType')=='Fenance Officer'){
			$data['main_content']="admin/order/account_order_list";
		}
		else{
			$data['main_content']="admin/order/order_list";
		}
	    $this->load->view('admin_template', $data);
	}
	
	function order_filter_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			if($this->input->get('key')!=""){
				$keyword = $this->input->get('key');
				$sessiondata = array(
							'keyval'=>$keyword
						   );
				$this->session->set_userdata($sessiondata);
				$orderNo=$this->session->userdata('keyval');
				$sql=$this->db->query("select * from orders where order_number='".$orderNo."' order by order_id desc");
			}			
			elseif($this->input->get('tdate')!=""){
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
				$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate
						   );
				$this->session->set_userdata($sessiondata);
				$fromdate=$this->session->userdata('fromDate');
				$todate=$this->session->userdata('toDate');
				$sql=$this->db->query("select * from orders where (date between '$fromdate' and '$todate') order by order_id desc");
			}			
			
		$data['orderinfo'] = $sql;
		$this->load->view('admin/order/order_list_ajax',$data);
	} 
	
	/*function order_list_ajax()
	 {
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['orderinfo'] = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');


		if($this->session->userdata('AdminType') && $this->session->userdata('AdminType')=='Fenance Officer'){
			$data['main_content']="admin/order/account_order_list";
		}
		else{
			$data['main_content']="admin/order/order_list";
		}
	    $this->load->view('admin_template', $data);
	}*/
	
	function view_order($order_id)
	 {  
		 
		 if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		 	$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		
			$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');

			
			foreach($data['order_q']->result() as $rowq);
			$status=$rowq->status;
			$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
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
			$data['title']="Bargainnshop | Customer Order Details";
			$data['main_content']="admin/order/view_order";
			$this->load->view('admin_template', $data);
	}
	
	function update_quantity()
	{
		$oid = $this->input->post('opid');
		$product_id = $this->input->post('product_id');
		$cqty = $this->input->post('cqty');
		$cprice = $this->input->post('cprice');
		
		$orderid = $this->input->post('oid');
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			
			$sqlu = "SELECT * FROM orders_products WHERE id = ? AND product_id = ?";
			$orderstatusd = $this->db->query($sqlu,array($oid,$product_id));
			
			if($orderstatusd->num_rows() > 0){				
				$save['qty']=$cqty;
				$save['unit_price']=$cprice;
				$save['total_price']=$cqty*$cprice;
				$query = $this->Index_model->update_table('orders_products','id',$oid,$save);
				
				$sqltotal = "SELECT SUM(total_price) AS total FROM orders_products WHERE order_id = ?";
				$opsqltotal = $this->db->query($sqltotal,array($orderid));
				$updateTotal = $opsqltotal->row_array();
				$orderdetails = $this->Index_model->getDataById('orders','order_id',$orderid,'order_id','desc','1');
				if($orderdetails->num_rows() > 0){
					$totalprice = $updateTotal['total'];
					
					$ordin = $orderdetails->row_array();					
					$paidamount = $ordin['paid_amount'];
					$saveorder['total_price']=$totalprice;
					$this->Index_model->update_table('orders','order_id',$orderid,$saveorder);
					
					/*$customerPayment=array(
						'sale_amount'=>$totalprice
						);*/
					//$this->Index_model->updateTable('customer_payment','order_id',$orderid, $customerPayment);	
				}
			}
			
		
		
		if($query){	
			$jsondata = array('jsonmsg'=>'Successfully Updated','color'=>'#0e9a46');
		}
		else{
			$jsondata = array('jsonmsg'=>'Failed to Update','color'=>'#ff0000');
		}
		

		echo json_encode($jsondata);
	}
	
	function final_order()
	 {
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$ost = base64_decode($this->input->get('s'));
		if(isset($ost) && $ost!=""){
			switch ($ost) {
				case "success":
					$status = "Delivered";
					break;
				case "return":
					$status = "Return";
					break;
				case "miss":
					$status = "Miss Delivery";
					break;
				case "demage":
					$status = "Damage Delivery";
					break;
				case "cancel":
					$status = "Cancelled";
					break;
				default:
					echo "No Match";
			}
			$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$status',status) <> 0 ORDER BY id DESC");
				
			if($getOrderSta->num_rows() > 0){
				foreach($getOrderSta->result() as $ordst){
					$getOrderId[] = $ordst->order_id;
				}
				$arraord = join(',',$getOrderId);
				$data['orderinfo'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($arraord) ORDER BY order_id DESC");
				$data['title']="Bargainnshop | Final Order List";
				$data['main_content']="admin/order/order_list";
				$this->load->view('admin_template', $data);
			}
			else{
				show_404();
			}
		}
		else{
			show_404();
		}
	}
	
	
	function cancel_order()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$oid = $this->input->post('orderid');
		$pid = $this->input->post('proid');
		$status = $this->input->post('status');

		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		
		$ords['status']=$status;
		
		$sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
		$orderstatusd = $this->db->query($sqlu,array($oid,$pid));
			
		foreach($orderstatusd->result() as $ordr);
		$id = $ordr->id;
		$finalStatus = $ordr->status.','.$status;
		$save['product_id']=$pid;
		$save['order_id']=$oid;
		$save['status']=$finalStatus;
		$save['ret_type']=$status;
		
		$query = $this->Index_model->update_table('stock_order_product_status','id',$id,$save);
		//$query = $this->Index_model->update_table('stock_order_product_status','order_id',$oid,$save);
		if($query){
			$this->Index_model->update_table('orders','order_id',$oid,$ords);
		}
	}
	
	
	function payment_refund()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$oid = $this->input->post('orderid');
		$pid = $this->input->post('proid');
		$status = $this->input->post('status');

		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		
		$ords['status']=$status;
		
		$sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
		$orderstatusd = $this->db->query($sqlu,array($oid,$pid));
			
		foreach($orderstatusd->result() as $ordr);
		$id = $ordr->id;
		$finalStatus = $ordr->status.','.$status;
		$save['product_id']=$pid;
		$save['order_id']=$oid;
		$save['status']=$finalStatus;
		$save['ret_type']=$status;
		
		$query = $this->Index_model->update_table('stock_order_product_status','id',$id,$save);
		//$query = $this->Index_model->update_table('stock_order_product_status','order_id',$oid,$save);
		if($query){
			$this->Index_model->update_table('orders','order_id',$oid,$ords);
		}
	}
	
	
	function update_order_status_action()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$oid = $this->input->post('orderid');
		$product_id = $this->input->post('product_id');
		$status = $this->input->post('status');
		$quantity = $this->input->post('quantity');
		//$rettype = $this->input->post('rettype');
		//$remarks = $this->input->post('remarks');

		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			//$existingData =  $this->Index_model->getDataById('stock_order_product_status','product_id',$oid,'id','desc','1'); 
			//$exisStatus = $existingData->row_array();
			
			$sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
			$orderstatusd = $this->db->query($sqlu,array($oid,$product_id));
			
			if($orderstatusd->num_rows() > 0){
				foreach($orderstatusd->result() as $ords);
				$id = $ords->id;
				$finalStatus = $ords->status.','.$status;
				$save['product_id']=$product_id;
				$save['order_id']=$oid;
				$save['status']=$finalStatus;
				//$save['ret_type']=$rettype;
				$query = $this->Index_model->update_table('stock_order_product_status','id',$id,$save);
			}
			else{
				$finalStatus = $status;
				$save['product_id']=$product_id;
				$save['order_id']=$oid;
				$save['status']=$finalStatus;
				$query = $this->Index_model->inertTable('stock_order_product_status', $save);
			}
			
			if($status=='Return'){
				$sqls = "SELECT pro_qty FROM stock WHERE pro_id = ?";
				$orderstatusd = $this->db->query($sqls,array($product_id));
				
				$exisqtyrow = $orderstatusd->row_array();
				$exisqty = $exisqtyrow['pro_qty'];
				$updateQty = $exisqty + $quantity;
				$stockval = array("pro_qty"=>$updateQty,"date"=>date('Y-m-d'));
				$this->Index_model->update_table('stock','pro_id',$product_id,$stockval);
			}
			if($query){	
				$jsondata = array('jsonmsg'=>'Successfully Updated','color'=>'#0e9a46');
			}
			else{
				$jsondata = array('jsonmsg'=>'Failed to Update','color'=>'#ff0000');
			}
			echo json_encode($jsondata);
	}
	
	
	
	
	function update_closed_order()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$oid = $this->input->post('orderid');
		$status = $this->input->post('ordstatus');

		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$save['status']=$status;
		$save['date']=date('Y-m-d');
		$query = $this->Index_model->update_table('orders','order_id',$oid,$save);
			
		
		if($query){	
			$jsondata = array('jsonmsg'=>'Successfully Updated','color'=>'#0e9a46');
		}
		else{
			$jsondata = array('jsonmsg'=>'Failed to Update','color'=>'#ff0000');
		}
		echo json_encode($jsondata);
	}
	
	
	
	function update_order_status()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Eve & Youngstar | Inventory History";

		$productid =  $this->input->post('product_id');
		$orderid =  $this->input->post('orderid');
		
		$data['quantity']= $this->input->post('quantity');
		$data['orderdate']= $this->input->post('orderdate');
		$data['ord_status']= $this->input->post('status');
		$data['orderid']= $orderid;
		$data['productid']= $productid;
		$data['ord_product_id']=$productid;
		
		$data['returnorderpro']= $this->Index_model->getAllItemTable('ret_missd_dd_prodcut','order_id',$orderid,'old_product',$productid,'order_id','desc');
		if($data['returnorderpro']->num_rows() > 0){
			$retPro = $data['returnorderpro']->row_array();
			$rOldProid = $retPro['old_product'];
			$rNewProid = $retPro['new_product'];
			$new_qty = $retPro['new_qty'];
			$old_qty = $retPro['old_qty'];
			$back_amount = $retPro['back_amount'];
			$order_id = $retPro['order_id'];
			$data['old_pro'] = $rOldProid;
			$data['new_pro'] = $rNewProid;
			$data['old_qty'] = $old_qty;
			$data['new_qty'] = $new_qty;
			
			// Old Product
			$productinfoOld= $this->Index_model->getDataById('product','product_id',$rOldProid,'product_id','desc','1');
			if($productinfoOld->num_rows() > 0){
			//echo $productinfoOld->num_rows();
				foreach($productinfoOld->result() as $pro);
				$data['productCode'] = $pro->pro_code;
				$data['productName'] = $pro->product_name;
				$data['main_image'] = $pro->main_image;
				
				$pricesql = "SELECT (SUM(china_unit_cost)+SUM(photography_unit_cost)+SUM(import_unit_cost)+SUM(packing_unit_cost)+SUM(sda_unit_cost)+SUM(delivery_unit_cost)
				+SUM(cashhandle_unit_cost)+SUM(officeexp_unit_cost)+SUM(profit_unit_cost)+SUM(customer_unit_cost)) 
				AS total FROM product_price WHERE product_id = ?";
				$fpricequery = $this->db->query($pricesql,$rOldProid);
				$product_price	= $fpricequery->row_array();
				$data['pro_price']=$product_price['total'];
			}
			else{
				$data['productName']='';
				$data['productCode']='';
				$data['main_image']='';
				$data['pro_price']='';
			}
			
			// New Product
			$productinfon= $this->Index_model->getDataById('product','product_id',$rNewProid,'product_id','desc','1');
			if($productinfon->num_rows() > 0){
				foreach($productinfon->result() as $pro);
				$data['productCodeN'] = $pro->pro_code;
				$data['productNameN'] = $pro->product_name;
				$data['main_imageN'] = $pro->main_image;
				
				$pricesql = "SELECT (SUM(china_unit_cost)+SUM(photography_unit_cost)+SUM(import_unit_cost)+SUM(packing_unit_cost)+SUM(sda_unit_cost)+SUM(delivery_unit_cost)
				+SUM(cashhandle_unit_cost)+SUM(officeexp_unit_cost)+SUM(profit_unit_cost)+SUM(customer_unit_cost)) 
				AS total FROM product_price WHERE product_id = ?";
				$fpricequery = $this->db->query($pricesql,$rNewProid);
				$product_price	= $fpricequery->row_array();
				$data['pro_priceN']=$product_price['total'];
			}
			else{
				$data['productNameN']='';
				$data['productCodeN']='';
				$data['main_imageN']='';
				$data['pro_priceN']='';
			}
		}
		else{
			$data['productNameN']='';
			$data['productCodeN']='';
			$data['main_imageN']='';
			$data['pro_priceN']='';
			$data['productName']='';
			$data['productCode']='';
			$data['main_image']='';
			$data['pro_price']='';
			$data['old_pro'] = '';
			$data['new_pro'] = '';
		}
		
        $this->load->view('admin/order/update_order_status', $data);
    }
	
	
	function getProductInfo()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$product_id = $this->input->post('product_id');		
				
			$productinfo= $this->Index_model->getDataById('product','product_id',$product_id,'product_id','desc','1');
			foreach($productinfo->result() as $pro);
			$productCode = $pro->pro_code;
			$main_image = $pro->main_image;
			
			$pricesql = "SELECT (SUM(china_unit_cost)+SUM(photography_unit_cost)+SUM(import_unit_cost)+SUM(packing_unit_cost)+SUM(sda_unit_cost)+SUM(delivery_unit_cost)
			+SUM(cashhandle_unit_cost)+SUM(officeexp_unit_cost)+SUM(profit_unit_cost)+SUM(customer_unit_cost)) 
			AS total FROM product_price WHERE product_id = ?";
			$fpricequery = $this->db->query($pricesql,$product_id);
			$product_price	= $fpricequery->row_array();
			$pro_price=$product_price['total'];
		
			$proimage = "<img src=".base_url()."uploads/images/product/main_img/".$main_image." style='width:100px; height:auto'/>";
		
			$colorsize = '
			<table width="80%" class="ordertable" align="center">
				<tr class="trTitle">
					<td>Color</td>
					<td>Size</td>
				</tr>';			 
            
			$procolorsize= $this->Index_model->getDataById('product_color_size_qty','product_id',$product_id,'id','desc','');
			foreach($procolorsize->result() as $procs){
				$color = $procs->color;
				$size = $procs->size;
				$colorsize .= '
				<tr>
					<td align="center" style="padding:10px">'.$color.'</td>
					<td align="center" style="padding:10px">'.$size.'</td>
				</tr>
				';
			}
			
         $colorsize .= '</table>';
		
			$jsondata = array('p_code'=>$productCode,'p_rice'=>$pro_price,'p_image'=>$proimage,'colorsize'=>$colorsize);
			echo json_encode($jsondata);
	}
	
	 
	
	function update_new_order()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$oid = $this->input->post('orderid');
			$status = $this->input->post('status');
			$savedata['back_type']=$this->input->post('back_type');
			$savedata['order_id']=$oid;
			$savedata['old_product']=$this->input->post('oldpro');
			$savedata['new_product']=$this->input->post('newpro');
			$savedata['old_qty']=$this->input->post('oldqty');
			$savedata['new_qty']=$this->input->post('newqty');
			$savedata['status']=$status;
			$savedata['back_amount']=$this->input->post('retamount');
			$savedata['user_id']=$this->session->userdata('AdminAccessId');
			$savedata['order_date']=$this->input->post('orderdate');
			$savedata['update_date']=date('Y-m-d H:i:s');
			
			$query = $this->Index_model->inertTable('ret_missd_dd_prodcut', $savedata);		
			if($query){
				$save['ret_type']=$status;
				$ords['status']=$status;
			    $this->Index_model->update_table('stock_order_product_status','order_id',$oid,$save);
				$this->Index_model->update_table('orders','order_id',$oid,$ords);
				$jsondata = array('jsonmsg'=>'Successfully Updated','color'=>'#0e9a46');
			}		
			else{
				$jsondata = array('jsonmsg'=>'Failed to Update','color'=>'#ff0000');
			}	

		echo json_encode($jsondata);
	}
	
	
	function new_return_invoice(){
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$order_id = $this->input->post('order_id');
		$ord_status = $this->input->post('ord_status');
		$old_pro = $this->input->post('old_pro');
		$new_pro = $this->input->post('new_pro');
		$old_quantity = $this->input->post('old_quantity');
		$new_quantity = $this->input->post('new_quantity');
		
		$ordq= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
		$orow = $ordq->row_array();
		$orderno = $orow['order_number'];
		
		$payment= $this->Index_model->getDataById('payment_info','order_id',$order_id,'pay_id','desc','1');
		if($payment->num_rows() > 0){
			foreach($payment->result() as $rowp);
			$customer_id=$rowp->customer_id;
			$pay_id=$rowp->pay_id;
			$shipping_id=$rowp->shipping_id;
		}
		else{
			$customer_id='';
			$pay_id='';
			$shipping_id='';
		}
			
		if($this->input->post('invoiceCreate')!=""){
			$insertTranstion=array(
					'cust_id'=>$customer_id,
					'ship_id'=>$shipping_id,
					'status'=>$ord_status,
					'pay_id'=>$pay_id,
					'order_num'=>$orderno,
					'new_pro'=>$new_pro,
					'old_quantity'=>$old_quantity,
					'new_quantity'=>$new_quantity,
					'return_product'=>$old_pro,
					'order_id'=>$order_id,
					'create_date'=>date('Y-m-d h:i:s'),
					'date'=>date('Y-m-d')
					);
			$query = $this->Index_model->inertTable('invoice', $insertTranstion);
			redirect('administration/invoice_return/'.$query);
		}
		else{
			 $this->session->set_flashdata('failedMsg', '<div class="alert alert-danger text-center">Failed To insert</div>');
			 redirect('administration/order_list/', 'refresh');	
		}
			
	}
	
	function invoice_return($inpoiceId)
	 {
		 
		 if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
			
		 	if(!$inpoiceId) redirect('error');
		 	$data['invoiceData']= $this->Index_model->getDataById('invoice','inv_id',$inpoiceId,'inv_id','desc','1');
			foreach($data['invoiceData']->result() as $invoiceData);
			$order_id = $invoiceData->order_id;
			$return_product = $invoiceData->return_product;
			$new_pro = $invoiceData->new_pro;
			$status = $invoiceData->status;
			$old_quantity = $invoiceData->old_quantity;
			$new_quantity = $invoiceData->new_quantity;
			
		 	$data['order_id']=$order_id;
			$data['inv_id']=$inpoiceId;
			$data['status']=$status;
			$data['return_product']=$return_product;
			$data['new_pro']=$new_pro;
			$data['old_quantity']=$old_quantity;
			$data['new_quantity']=$new_quantity;
			$data['title']="Bargainnshop | Customer Order Details";
			
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
			
			if($this->input->get('status') && $this->input->get('status')!=""){
				$this->load->view('admin/order/invoice_return_print', $data);
			}
			else{
				$data['main_content']="admin/order/invoice_return";
				$this->load->view('admin_template', $data);
			}
	}
	
	
	function new_invoice(){
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
			

		if($this->input->post('invoiceCreate')!=""){
		
			$cust_id=$this->input->post('cust_id');
			$order_id=$this->input->post('order_id');
			
				if($this->input->post('paid_amount')!="" || $this->input->post('paid_amount')!=0){
					$totalPrice = $this->input->post('total_price');
					$paid_amount = $this->input->post('paid_amount');
					$due_amount = $totalPrice - $paid_amount;
					if($totalPrice == $paid_amount){
						$paystatus = "Full Paid";
					}
					else{
						$paystatus = "Partial Paid";
					}
					$saveorder['paid_amount'] = $paid_amount;
					$saveorder['due_amount'] = $due_amount;
					$saveorder['payment_status'] = $paystatus;
					$this->Index_model->updateTable('orders','order_id',$order_id, $saveorder);
				}
		
		
			$insertTranstion=array(
					'cust_id'=>$cust_id,
					'ship_id'=>$this->input->post('ship_id'),
					'pay_id'=>$this->input->post('payId'),
					'order_num'=>$this->input->post('orderNumber'),
					'order_id'=>$order_id,
					'create_date'=>date('Y-m-d h:i:s'),
					'date'=>date('Y-m-d')
					);
			$query = $this->Index_model->inertTable('invoice', $insertTranstion);
			redirect('administration/invoice/'.$query);
		}
		else{
			 $this->session->set_flashdata('failedMsg', '<div class="alert alert-danger text-center">Failed To insert</div>');
			 redirect('administration/view_order/'.$order_id, 'refresh');	
		}
			
	}
	
	function invoice($inpoiceId)
	{
		 
        if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
        $data['cname'] = $this->cname;
        $data['cmob'] = $this->cmob;
        $data['cem'] = $this->cem;
        $data['cadd'] = $this->cadd;
        $data['clogo'] = $this->clogo;
        

        if(!$inpoiceId) redirect('error');
        $data['invoiceData']= $this->Index_model->getDataById('invoice','inv_id',$inpoiceId,'inv_id','desc','1');
        foreach($data['invoiceData']->result() as $invoiceData);
        $order_id = $invoiceData->order_id;
        $data['order_id']=$order_id;
        $data['inv_id']=$inpoiceId;
        $data['title']="Bargainnshop | Customer Order Details";
        
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
        
        if($this->input->get('status') && $this->input->get('status')!=""){
            $this->load->view('admin/order/invoice_print', $data);
        }
        else{
            $data['main_content']="admin/order/invoice";
            $this->load->view('admin_template', $data);
        }
	}
	
	
	
	function update_status()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		
		
		
		$status=$this->input->get('status');
		$view_order=$this->input->get('view_order');
		$table=$this->input->get('table');
		$id=$this->input->get('id');
		$seller_id=$this->input->get('seller_id');
		$product_id=$this->input->get('product_id');
		$total_price=$this->input->get('total_price');
	    $finalStatus = $status;


        
        if($table === 'Bargainnshop_seller_order') {
            
            echo 'loading...';
            if($finalStatus == 'Delivered') {
                // Commission
                $seller_balance = $this->Index_model->seller_balance((int)$seller_id);
                $get_seller_balance = $seller_balance->row_array();
                $get_category_data = $this->Index_model->get_category($product_id);
                $get_category_data = $get_category_data->row_array();
                $current_product_sell_commission = ((float)$total_price * (float)$get_category_data['seller_commission']) / 100;
                $return_balance_seller = (float)$total_price;
                
                $update_balance_data['commission'] = (float)$get_seller_balance['commission'] + $current_product_sell_commission;
                $update_balance_data['balance'] = (float)$get_seller_balance['balance'] + $return_balance_seller;
                
                $this->Index_model->update_table('Bargainnshop_seller_balance', 'seller_id', (int)$seller_id, $update_balance_data);

                
            }
        }
        
        if($table === 'orders') {
            
            // Send Mail
            //Email content
            $htmlContent = '<h1>Sending email via SMTP server</h1>';
            $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

            
            $frommail= "bargainnshop@gmail.com";
            $list = array($tomail,$this->cem);
            $subject="Your order has been processed successfully.";
            //Load email library
            $this->load->library('email');

            //SMTP & mail configuration
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'shohan.st27@gmail.com',
                'smtp_pass' => 'ISlaM?$&^$$8662',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");

            //Email content
            $htmlContent = '<h1>Thank you for your recent purchase at Bargainnshop!</h1>';

            $this->email->to($tomail);
            $this->email->from($frommail);
            $this->email->subject($subject);
            $this->email->message($htmlContent);

            //Send email
            $this->email->send();

        }
		
		$adminid = $this->session->userdata('AdminAccessId');
		$order_number=$this->input->get('order_number');
		$customer_id=$this->input->get('customer_id');
		$total_price=$this->input->get('total_price');
		$shipping_id=$this->input->get('shipid');
		$pay_id=$this->input->get('payid');

		$this->Index_model->update_status($table,$finalStatus,$id); 
		
		
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	/////////////////////// Account part ////////////////////////////////	 
	function asset_investment_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="asset_investment List | Bargainnshopbd";
		$data['asset_investment_list'] = $this->Index_model->getTable('asset_investment','par_id','desc');
		$data['main_content']="admin/asset_investment/asset_investment_list";
        $this->load->view('admin_template',$data);
	} 
	 
 	
	function asset_investment_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['asset_investmentUpdate'] = $this->Index_model->getAllItemTable('asset_investment','par_id',$artiId,'','','par_id','desc');
		$data['root_asset_investment'] = $this->Index_model->getAllItemTable('asset_investment','','','','','asset_investment_name','asc');
		$data['title']="asset_investment Registration | Bargainnshopbd";
		$this->form_validation->set_rules('asset_investment_name', 'asset_investment name', 'trim|required');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
			$expval=explode(' ',$this->input->post('asset_investment_name'));
			$impval=implode('-',$expval);
				$save['asset_investment_name']	    = addslashes($this->input->post('asset_investment_name'));
				$save['subimition_date']	    = date('Y-m-d');
				
				if($this->input->post('par_id')!=""){
					$par_id=$this->input->post('par_id');
					$this->Index_model->update_table('asset_investment','par_id',$par_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('asset_investment', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/asset_investment_list', 'refresh');
			}
			else{
				$data['main_content']="admin/asset_investment/asset_investment_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/asset_investment/asset_investment_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	///////////////////////internal_cost ////////////////////////////////	 
	function internal_cost_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="internal_cost List | Bargainnshopbd";
		$data['payment_list'] = $this->Index_model->getTable('internal_cost','pay_id','desc');
		$data['main_content']="admin/internal_cost/payment_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function internal_cost_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="payment Registration | Bargainnshopbd";
		}
		else{
			$data['title']="payment Update | Bargainnshopbd";
		}
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('internal_cost','pay_id',$artiId,'','','pay_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
				
				$digits = 4;
				 $serial = rand(pow(10, $digits-1), pow(10, $digits)-1);
				 
				if($this->input->post('registration')){
					$assetinvest = $this->input->post('assetinvest');
					$serial_no = $serial;
					$amount = $this->input->post('investamount');
					$pay_date = $this->input->post('pay_date');
					$amount_in_word = $this->input->post('amount_in_word');
					$cost_by = $this->input->post('cost_by');
					$dateconv=date('Y-m-d',strtotime($pay_date));
				}
				else{
					$assetinvest=$this->session->userdata('assetinvest');
					$serial_no=$this->session->userdata('serial_no');
					$amount=$this->session->userdata('investamount');
					$amount_in_word=$this->session->userdata('amount_in_word');
					$cost_by=$this->session->userdata('cost_by');
					$dateconv=$this->session->userdata('pay_date');
				}
					$sessionSearchdata = array(
								  'assetinvest' => $assetinvest,
								  'cost_by' => $cost_by,
								  'serial_no' => $serial_no,
								  'amount_in_word' => $amount_in_word,
								  'investamount' => $amount,
								  'pay_date' => $dateconv,
							 );
				$this->session->set_userdata($sessionSearchdata);

				$save['amount_in_word']	    = $amount_in_word;
				$save['cost_by']	    = $cost_by;
				$save['serial_no']	    = $serial_no;
				$save['paymentfor']	    = $assetinvest;
				$save['total_amount']	    = $amount;
				$save['payment_date']	    = $dateconv;
				
				if($this->input->post('pay_id')!=""){
					$pay_id=$this->input->post('pay_id');
					$this->Index_model->update_table('internal_cost','pay_id',$pay_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('internal_cost', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/internal_cost_print', 'refresh');
		}
		else{
		  $data['main_content']="admin/internal_cost/payment_action";
		  $this->load->view('admin_template', $data);
		  }
	}
	
	
	
	function internal_cost_print()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				
		$printsegment=$this->uri->segment(3);
		$data['cost_by']=$this->session->userdata('cost_by');
		$data['amount_in_word']=$this->session->userdata('amount_in_word');
		$data['serial_no']=$this->session->userdata('serial_no');
		$data['paymentfor']=$this->session->userdata('assetinvest');
		$data['amount'] = $this->session->userdata('investamount');
		$data['pay_date'] =  $this->session->userdata('pay_date');
		
		$data['title']="Payment Print | Bargainnshopbd";
		if(!$printsegment){
			$data['main_content']="admin/internal_cost/payment_print";
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/internal_cost/payment_print_form',$data);
		}
	} 
	

	
	
	
	
//////////////////////////===============================//////////  Reports Information ///////////////////////==============================/////////////////////////////
////////////  Active Reports///////////////////////

	/*function active_reports_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
	
		$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
		$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		
		//$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','','','date',$fromdate,$todate,'order_id','desc');
		$data['datewisOrder'] = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');
///////////////////////// ///////////////////////////////////////////Pending Option///////////////////////////////////////////////////////////////////////////////////		
//////////////////////////////////////////////// Delivered //////////////////////////////////////////////////////
		
		$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Dispatch',status) AND NOT FIND_IN_SET('Delivered',status) ORDER BY id DESC");
		if($getOrderSta->num_rows() > 0){
			foreach($getOrderSta->result() as $ordst){
				$getOrderId[] = $ordst->order_id;
				$getproId[] = $ordst->product_id;
			}
			$delOID = join(',',$getOrderId);
			$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($delOID) ORDER BY order_id DESC");
			$data['pendDelivered'] = $ordreinfo->num_rows();
		  }
		  else{
			$data['pendDelivered'] = 0;
		  }
		  
		////////////////////////// Success Delivered ///////////////////////////
		$getOrderSD = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Delivered',status) ORDER BY id DESC");
		if($getOrderSD->num_rows() > 0){
			foreach($getOrderSD->result() as $ordst){
				$getSO[] = $ordst->order_id;
				$getproId[] = $ordst->product_id;
			}
			$sdOi = join(',',$getSO);
			$soinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($sdOi) ORDER BY order_id DESC");
			$data['succDelivered'] = $soinfo->num_rows();
		  }
		  else{
			$data['succDelivered'] = 0;
		  }
		  
		$this->load->view('admin/reports/active_reports/dateWiseReportAjax',$data);
	} */
	
	function active_reports() 
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Daily Sale Reports | Bargainnshopbd";
		$today=date('Y-m-d');
		$partOrd = '';
		$partTotalOrd = '';
		$totalorders = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');
		foreach($totalorders->result() as $tord){
			// $osSql = "SELECT status,order_id, COUNT(order_id) AS tOrd FROM stock_order_product_status WHERE order_id = ?  GROUP BY status HAVING COUNT(*) > 0";
			//$osSql = "SELECT * FROM stock_order_product_status WHERE order_id = 6 GROUP BY status HAVING COUNT(status) > 0";
			$osSql = "SELECT *, COUNT(order_id) AS tOrd FROM stock_order_product_status WHERE order_id = ? AND status NOT IN 
			(SELECT status FROM stock_order_product_status GROUP BY order_id HAVING COUNT(order_id) > 1)";
			$ordQuery = $this->db->query($osSql,$tord->order_id);
			
			foreach($ordQuery->result() as $partrow){
				//$ordsProducts = $ordQuery->row_array();
				$pTotalId = $partrow->tOrd;
				$partProid = $partrow->product_id;
				$partOrid = $partrow->order_id;
				
				$partTotalOrd += $pTotalId;
				$partOrd .= $partOrid.',';
			}
		}
	   
		$data['partTotal'] = $partTotalOrd;
		$data['partOrd'] = rtrim($partOrd, ',');
		
		
		$data['datewisOrder'] = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');
	
	///////////////////////// ///////////////////////////////////////////Approved Option///////////////////////////////////////////////////////////////////////////////////		
////////////////////////// Approved ///////////////////////////
		$sqlp = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Approved',status) ORDER BY id DESC");
		if($sqlp->num_rows() > 0){
			foreach($sqlp->result() as $pr){
				$poid[] = $pr->order_id;
				$ppid[] = $pr->product_id;
			}
			$poArr = join(',',$poid);
			$poi = $this->db->query("SELECT * FROM orders WHERE order_id IN($poArr) ORDER BY order_id DESC");
			$totalapp = $poi->num_rows();
			$data['pApp'] = $data['datewisOrder']->num_rows() - $totalapp;
		  }
		  else{
			$data['pApp'] = $data['datewisOrder']->num_rows();
		  }
		  
		$sql1 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Approved',status) ORDER BY id DESC");
		if($sql1->num_rows() > 0){
			foreach($sql1->result() as $r1){
				$oid1[] = $r1->order_id;
				$pid1[] = $r1->product_id;
			}
			$poArr1 = join(',',$oid1);
			$oi1 = $this->db->query("SELECT * FROM orders WHERE order_id IN($poArr1) ORDER BY order_id DESC");
			$data['App'] = $oi1->num_rows();
		  }
		  else{
			$data['App'] = 0;
		  }
		  
		  
		

///////////////////////// ///////////////////////////////////////////Checking & Packing Option///////////////////////////////////////////////////////////////////////////////////		
////////////////////////// Checking & Packing ///////////////////////////
		$sql2 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Approved',status) 
		AND NOT FIND_IN_SET('Checking & Packing',status) ORDER BY id DESC");
		if($sql2->num_rows() > 0){
			foreach($sql2->result() as $r2){
				$oid2[] = $r2->order_id;
				$pid2[] = $r2->product_id;
			}
			$oArr2 = join(',',$oid2);
			$oi2 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr2) ORDER BY order_id DESC");
			$data['Chkpk'] = $oi2->num_rows();
		  }
		  else{
			$data['Chkpk'] = 0;
		  }		  
		  
		$sql3 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Checking & Packing',status) ORDER BY id DESC");
		if($sql3->num_rows() > 0){
			foreach($sql3->result() as $r3){
				$oid3[] = $r3->order_id;
				$pid3[] = $r3->product_id;
			}
			//print_r($ocid);
			$oArr3 = join(',',$oid3);
			$oi3 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr3) ORDER BY order_id DESC");
			$data['sChkpk'] = $oi3->num_rows();
		  }
		  else{
			$data['sChkpk'] = 0;
		  }		  
///////////////////////// ///////////////////////////////////////////Dispatch Option///////////////////////////////////////////////////////////////////////////////////		
////////////////////////// Dispatch ///////////////////////////
		$sql4 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Checking & Packing',status) 
		AND NOT FIND_IN_SET('Dispatch',status) ORDER BY id DESC");
		if($sql4->num_rows() > 0){
			foreach($sql4->result() as $r4){
				$oid4[] = $r4->order_id;
				$pid4[] = $r4->product_id;
			}
			$oArr4 = join(',',$oid4);
			$oi4 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr4) ORDER BY order_id DESC");
			$data['dispatchP'] = $oi4->num_rows();
		  }
		  else{
			$data['dispatchP'] = 0;
		  }		  
		  
		$sql5 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Checking & Packing',status) 
		AND FIND_IN_SET('Dispatch',status) ORDER BY id DESC");
		if($sql5->num_rows() > 0){
			foreach($sql5->result() as $r5){
				$oid5[] = $r5->order_id;
				$pid5[] = $r5->product_id;
			}
			$oArr5 = join(',',$oid5);
			$oi5 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr5) ORDER BY order_id DESC");
			$data['dispatchS'] = $oi5->num_rows();
		  }
		  else{
			$data['dispatchS'] = 0;
		  }		  
///////////////////////// ///////////////////////////////////////////Delivered Option///////////////////////////////////////////////////////////////////////////////////		
////////////////////////// Pending Delivered ///////////////////////////
		$sql6 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Dispatch',status) AND NOT FIND_IN_SET('Delivered',status) ORDER BY id DESC");
		if($sql6->num_rows() > 0){
			foreach($sql6->result() as $r6){
				$oid6[] = $r6->order_id;
				$pid6[] = $r6->product_id;
			}
			$oArr6 = join(',',$oid6);
			$oi6 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr6) ORDER BY order_id DESC");
			$data['pendDelivered'] = $oi6->num_rows();
		  }
		  else{
			$data['pendDelivered'] = 0;
		  }

		////////////////////////// Success Delivered ///////////////////////////
		$sql7 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Delivered',status) ORDER BY id DESC");
		if($sql7->num_rows() > 0){
			foreach($sql7->result() as $r7){
				$oid7[] = $r7->order_id;
				$pid7[] = $r7->product_id;
			}
			$oArr7 = join(',',$oid7);
			$oi7 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr7) ORDER BY order_id DESC");
			$data['succDelivered'] = $oi7->num_rows();
		  }
		  else{
			$data['succDelivered'] = 0;
		  }


	///////////////////////// ///////////////////////////////////////////Pending Paid for Delivery //////////////////////////////////////////////////////////////////////////		
////////////////////////// Pending  ///////////////////////////
	$sql61 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Dispatch',status) AND NOT FIND_IN_SET('Paid for Delivery',status) ORDER BY id DESC");
		if($sql61->num_rows() > 0){
			foreach($sql61->result() as $r61){
				$oid61[] = $r61->order_id;
				$pid61[] = $r61->product_id;
			}
			$oArr61 = join(',',$oid61);
			$oi61 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr61) ORDER BY order_id DESC");
			$data['pendPaidDelivered'] = $oi61->num_rows();
		  }
		  else{
			$data['pendPaidDelivered'] = 0;
		  }

		////////////////////////// Success Delivered ///////////////////////////
		$sql71 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Paid for Delivery',status) ORDER BY id DESC");
		if($sql71->num_rows() > 0){
			foreach($sql71->result() as $r71){
				$oid71[] = $r71->order_id;
				$pid71[] = $r71->product_id;
			}
			$oArr71 = join(',',$oid71);
			$oi71 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr71) ORDER BY order_id DESC");
			$data['succPaidDelivered'] = $oi71->num_rows();
		  }
		  else{
			$data['succPaidDelivered'] = 0;
		  }
		  
///////////////////////// ///////////////////////////////////////////Delivered Option///////////////////////////////////////////////////////////////////////////////////		
////////////////////////// Pending Delivered ///////////////////////////
		$sql8 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Delivered',status) AND NOT FIND_IN_SET('Payment Received',status) ORDER BY id DESC");
		if($sql8->num_rows() > 0){
			foreach($sql8->result() as $r8){
				$oid8[] = $r8->order_id;
				$pid8[] = $r8->product_id;
			}
			$oArr8 = join(',',$oid8);
			$oi8 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr8) ORDER BY order_id DESC");
			$data['pendPayment'] = $oi8->num_rows();
		  }
		  else{
			$data['pendPayment'] = 0;
		  }

		////////////////////////// Success Delivered ///////////////////////////
		$sql9 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Payment Received',status) ORDER BY id DESC");
		if($sql9->num_rows() > 0){
			foreach($sql9->result() as $r9){
				$oid9[] = $r9->order_id;
				$pid9[] = $r9->product_id;
			}
			$oArr9 = join(',',$oid9);
			$oi9 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr9) ORDER BY order_id DESC");
			$data['succPayment'] = $oi9->num_rows();
		  }
		  else{
			$data['succPayment'] = 0;
		  }



///////////////////////// ///////////////////////////////////////////Return Option///////////////////////////////////////////////////////////////////////////////////	
////////////////////////// Pending Return ///////////////////////////
		$sql10 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Return',status) AND (ret_type IS NULL OR ret_type!='') ORDER BY id DESC");
		if($sql10->num_rows() > 0){
			foreach($sql10->result() as $r10){
				$oid10[] = $r10->order_id;
				$pid10[] = $r10->product_id;
			}
			$oArr10 = join(',',$oid10);
			$oi10 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr10) ORDER BY order_id DESC");
			$data['pendReturn'] = $oi10->num_rows();
		  }
		  else{
			$data['pendReturn'] = 0;
		  }

////////////////////////// Success Return ///////////////////////////
		$sql11 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Return',status) AND ret_type='Return' ORDER BY id DESC");
		if($sql11->num_rows() > 0){
			foreach($sql11->result() as $r11){
				$oid11[] = $r11->order_id;
				$pid11[] = $r11->product_id;
			}
			$oArr11 = join(',',$oid11);
			$oi11 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr11) ORDER BY order_id DESC");
			$data['succReturn'] = $oi11->num_rows();
		  }
		  else{
			$data['succReturn'] = 0;
		  }	  


///////////////////////// ///////////////////////////////////////////Miss delivery Option///////////////////////////////////////////////////////////////////////////////////	
////////////////////////// Pending Miss delivery ///////////////////////////
		$sql12 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Miss Delivery',status) AND (ret_type IS NULL OR ret_type!='') ORDER BY id DESC");
		if($sql12->num_rows() > 0){
			foreach($sql12->result() as $r12){
				$oid12[] = $r12->order_id;
				$pid12[] = $r12->product_id;
			}
			$oArr12 = join(',',$oid12);
			$oi12 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr12) ORDER BY order_id DESC");
			$data['pendMiss'] = $oi12->num_rows();
		  }
		  else{
			$data['pendMiss'] = 0;
		  }

////////////////////////// Success Miss delivery ///////////////////////////
		$sql13 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Miss Delivery',status) AND ret_type='Miss Delivery' ORDER BY id DESC");
		if($sql13->num_rows() > 0){
			foreach($sql13->result() as $r13){
				$oid13[] = $r13->order_id;
				$pid13[] = $r13->product_id;
			}
			$oArr13 = join(',',$oid13);
			$oi13 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr12) ORDER BY order_id DESC");
			$data['succMiss'] = $oi13->num_rows();
		  }
		  else{
			$data['succMiss'] = 0;
		  }	  



///////////////////////// ///////////////////////////////////////////Miss delivery Option///////////////////////////////////////////////////////////////////////////////////	
////////////////////////// Pending Miss delivery ///////////////////////////
		$sql14 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Damage Delivery',status) AND (ret_type IS NULL OR ret_type!='') ORDER BY id DESC");
		if($sql14->num_rows() > 0){
			foreach($sql14->result() as $r14){
				$oid14[] = $r14->order_id;
				$pid14[] = $r14->product_id;
			}
			$oArr14 = join(',',$oid14);
			$oi14 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr14) ORDER BY order_id DESC");
			$data['pendDemage'] = $oi14->num_rows();
		  }
		  else{
			$data['pendDemage'] = 0;
		  }

////////////////////////// Success Miss delivery ///////////////////////////
		$sql15 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Damage Delivery',status) AND ret_type='Damage Delivery' ORDER BY id DESC");
		if($sql15->num_rows() > 0){
			foreach($sql15->result() as $r15){
				$oid15[] = $r15->order_id;
				$pid12[] = $r15->product_id;
			}
			$oArr15 = join(',',$oid15);
			$oi15 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr12) ORDER BY order_id DESC");
			$data['succDemage'] = $oi15->num_rows();
		  }
		  else{
			$data['succDemage'] = 0;
		  }	  



///////////////////////// ///////////////////////////////////////////Return Recieved Option///////////////////////////////////////////////////////////////////////////////////	
////////////////////////// Pending Return Recieved ///////////////////////////
		$sql166 = $this->db->query("SELECT * FROM stock_order_product_status WHERE (FIND_IN_SET('Return',status) OR FIND_IN_SET('Damage Delivery',status) OR FIND_IN_SET('Miss Delivery',status)) AND NOT FIND_IN_SET('Refund',status) ORDER BY id DESC");
		if($sql166->num_rows() > 0){
			foreach($sql166->result() as $r166){
				$oid166[] = $r166->order_id;
				$pid166[] = $r166->product_id;
			}
			$oArr166 = join(',',$oid166);
			$oi166 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr166) ORDER BY order_id DESC");
			$data['pendRef'] = $oi166->num_rows();
		  }
		  else{
			$data['pendRef'] = 0;
		  }

////////////////////////// Success Return Recieved ///////////////////////////
		$sql188 = $this->db->query("SELECT * FROM stock_order_product_status WHERE (FIND_IN_SET('Return',status) 
		OR FIND_IN_SET('Damage Delivery',status) 
		OR FIND_IN_SET('Miss Delivery',status)) 
		AND FIND_IN_SET('Refund',status) ORDER BY id DESC");
		if($sql188->num_rows() > 0){
			foreach($sql188->result() as $r188){
				$oid188[] = $r188->order_id;
				$pid188[] = $r188->product_id;
			}
			$oArr188 = join(',',$oid188);
			$oi188 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr188) ORDER BY order_id DESC");
			$data['payRef'] = $oi188->num_rows();
		  }
		  else{
			$data['payRef'] = 0;
		  }	  

	
	
	/*// Payment Refund
			$getPayRef = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Refund',status) <> 0 ORDER BY id DESC");
			if($getPayRef->num_rows() > 0){
				foreach($getPayRef->result() as $ordst){
					$getOrderId[] = $ordst->order_id;
				}
				$sarid = join(',',$getOrderId);
				$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) ORDER BY order_id DESC");
				$data['payRef'] = $ordreinfo->num_rows();
		      }
			  else{
			  	$data['payRef'] = 0;
			  }*/
			  
			  
	
	///////////////////////// ///////////////////////////////////////////Return Recieved Option///////////////////////////////////////////////////////////////////////////////////	
////////////////////////// Pending Return Recieved ///////////////////////////
		$sql144 = $this->db->query("SELECT * FROM stock_order_product_status WHERE (FIND_IN_SET('Return',status) OR FIND_IN_SET('Damage Delivery',status) OR FIND_IN_SET('Miss Delivery',status)) AND NOT FIND_IN_SET('Receive',status) ORDER BY id DESC");
		if($sql144->num_rows() > 0){
			foreach($sql144->result() as $r144){
				$oid144[] = $r144->order_id;
				$pid144[] = $r144->product_id;
			}
			$oArr144 = join(',',$oid144);
			$oi144 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr144) ORDER BY order_id DESC");
			$data['pendReceived'] = $oi144->num_rows();
		  }
		  else{
			$data['pendReceived'] = 0;
		  }

////////////////////////// Success Return Recieved ///////////////////////////
		$sql155 = $this->db->query("SELECT * FROM stock_order_product_status WHERE (FIND_IN_SET('Return',status) 
		OR FIND_IN_SET('Damage Delivery',status) 
		OR FIND_IN_SET('Miss Delivery',status)) 
		AND FIND_IN_SET('Receive',status) ORDER BY id DESC");
		if($sql155->num_rows() > 0){
			foreach($sql155->result() as $r155){
				$oid155[] = $r155->order_id;
				$pid155[] = $r155->product_id;
			}
			$oArr155 = join(',',$oid155);
			$oi155 = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr155) ORDER BY order_id DESC");
			$data['succReceived'] = $oi155->num_rows();
		  }
		  else{
			$data['succReceived'] = 0;
		  }	  

	
	
	
			  
			  
///////////////////////// ///////////////////////////////////////////Cancelled Delivery Option///////////////////////////////////////////////////////////////////////////////////	
////////////////////////// Pending Cancelled Delivery ///////////////////////////

	$getOrderC = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Cancelled',status) ORDER BY id DESC");
		if($getOrderC->num_rows() > 0){
			foreach($getOrderC->result() as $ordC){
				$getCOId[] = $ordC->order_id;
				$getproId[] = $ordC->product_id;
			}
			$retCID = join(',',$getCOId);
			$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($retCID) ORDER BY order_id DESC");
			$data['pendCancelled'] = $ordreinfo->num_rows();
		  }
		  else{
			$data['pendCancelled'] = 0;
		  }
		 
		if(!$printsegment){
			$data['main_content']='admin/reports/active_reports/default';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/active_reports/default_print',$data);
		}
	} 
	
	
	
	
	function order_reports_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
	
		if($this->input->get('action')!="" && $this->input->get('action')=='ajax'){
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$orstatus=$this->input->get('orst');
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate,
							'orst'=> $orstatus
						   );
			$this->session->set_userdata($sessiondata);
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$orstatus=$this->session->userdata('orst');
		}
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');	
	
	//echo $orstatus;
///////////////////////// ///////////////////////////////////////////Deliverd Option///////////////////////////////////////////////////////////////////////////////////		

//AND date BETWEEN '$fromdate' and '$todate'
	   if($orstatus=='allOrder'){
			//$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','','','date',$fromdate,$todate,'order_id','desc');
				$data['datewisOrder'] = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
		}
		///////////////////////// ///////////////////////////////////////////Approved Option///////////////////////////////////////////////////////////////////////////////////		
		elseif($orstatus=='pApp'){
				////////////////////////// Pending Approved ///////////////////////////
				$sqlp = $this->db->query("SELECT * FROM stock_order_product_status ORDER BY id DESC");
				if($sqlp->num_rows() > 0){
					foreach($sqlp->result() as $pr){					
						$poid[] = $pr->order_id;
						$ppid[] = $pr->product_id;
					}
					$poArr = join(',',$poid);					
					$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id NOT IN($poArr) ORDER BY order_id DESC");
					$data['totalrecords'] = $data['datewisOrder']->num_rows();
				  }
				  else{
				  	$data['datewisOrder'] = $this->Index_model->getAllItemTable('orders','','','','','order_id','desc');
					$data['totalrecords'] = $data['datewisOrder']->num_rows();
				  }
		 }
		 elseif($orstatus=='appS'){
		 	////////////////////////// Approved ///////////////////////////
			$sql1 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Approved',status) ORDER BY id DESC");
			if($sql1->num_rows() > 0){
				foreach($sql1->result() as $r1){
					$oid1[] = $r1->order_id;
					$pid1[] = $r1->product_id;
				}
				$poArr1 = join(',',$oid1);
				$data['datewisOrder'] =  $this->db->query("SELECT * FROM orders WHERE order_id IN($poArr1) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='pChkp'){
				$sql2 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Approved',status) 
				AND NOT FIND_IN_SET('Checking & Packing',status) ORDER BY id DESC");
			if($sql2->num_rows() > 0){
				foreach($sql2->result() as $r2){
					$oid2[] = $r2->order_id;
					$pid2[] = $r2->product_id;
				}
				$oArr2 = join(',',$oid2);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr2) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }		 
		  }
		  elseif($orstatus=='chkpS'){
		  		$sql3 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Checking & Packing',status) ORDER BY id DESC");
				if($sql3->num_rows() > 0){
					foreach($sql3->result() as $r3){
						$oid3[] = $r3->order_id;
						$pid3[] = $r3->product_id;
					}
					//print_r($ocid);
					$oArr3 = join(',',$oid3);
					$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr3) ORDER BY order_id DESC");
					$data['totalrecords'] = $data['datewisOrder']->num_rows();
				  }
				  else{
					$data['totalrecords'] = 0;
				  }		
		  }
		  elseif($orstatus=='pDis'){
		  		$sql4 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Checking & Packing',status) 
				AND NOT FIND_IN_SET('Dispatch',status) ORDER BY id DESC");
				if($sql4->num_rows() > 0){
					foreach($sql4->result() as $r4){
						$oid4[] = $r4->order_id;
						$pid4[] = $r4->product_id;
					}
					$oArr4 = join(',',$oid4);
					$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr4) ORDER BY order_id DESC");
					$data['totalrecords'] = $data['datewisOrder']->num_rows();
				  }
				  else{
					$data['totalrecords'] = 0;
				  }		  
		  }
		  elseif($orstatus=='sDis'){
			$sql5 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Checking & Packing',status) 
				AND FIND_IN_SET('Dispatch',status) ORDER BY id DESC");
			if($sql5->num_rows() > 0){
				foreach($sql5->result() as $r5){
					$oid5[] = $r5->order_id;
					$pid5[] = $r5->product_id;
				}
				$oArr5 = join(',',$oid5);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr5) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }		
		  }
		  
		  elseif($orstatus=='pDel'){
		  	$sql6 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Dispatch',status) AND NOT FIND_IN_SET('Delivered',status) ORDER BY id DESC");
			if($sql6->num_rows() > 0){
				foreach($sql6->result() as $r6){
					$oid6[] = $r6->order_id;
					$pid6[] = $r6->product_id;
				}
				$oArr6 = join(',',$oid6);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr6) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  
		  elseif($orstatus=='sDel'){
		   	$sql7 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Delivered',status) ORDER BY id DESC");
			if($sql7->num_rows() > 0){
				foreach($sql7->result() as $r7){
					$oid7[] = $r7->order_id;
					$pid7[] = $r7->product_id;
				}
				$oArr7 = join(',',$oid7);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr7) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  
		  elseif($orstatus=='pRet'){
		  	$sql10 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Return',status) AND ret_type!='Return' ORDER BY id DESC");
			if($sql10->num_rows() > 0){
				foreach($sql10->result() as $r10){
					$oid10[] = $r10->order_id;
					$pid10[] = $r10->product_id;
				}
				$oArr10 = join(',',$oid10);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr10) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='sRet'){
		   $sql11 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Return',status) AND ret_type='Return' ORDER BY id DESC");
			if($sql11->num_rows() > 0){
				foreach($sql11->result() as $r11){
					$oid11[] = $r11->order_id;
					$pid11[] = $r11->product_id;
				}
				$oArr11 = join(',',$oid11);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr11) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }	  
		  }
		  
		  elseif($orstatus=='pMis'){
		  	$sql12 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Miss Delivery',status) AND ret_type!='Miss Delivery' ORDER BY id DESC");
			if($sql12->num_rows() > 0){
				foreach($sql12->result() as $r12){
					$oid12[] = $r12->order_id;
					$pid12[] = $r12->product_id;
				}
				$oArr12 = join(',',$oid12);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr12) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='sMis'){
		   	$sql13 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Miss Delivery',status) AND ret_type='Miss Delivery' ORDER BY id DESC");
			if($sql13->num_rows() > 0){
				foreach($sql13->result() as $r13){
					$oid13[] = $r13->order_id;
					$pid13[] = $r13->product_id;
				}
				$oArr13 = join(',',$oid13);
				$data['datewisOrder']= $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr12) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }	  
		  }
		  
		  elseif($orstatus=='pDem'){
		  	$sql14 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Damage Delivery',status) 
			AND ret_type!='Damage Delivery' ORDER BY id DESC");
			if($sql14->num_rows() > 0){
				foreach($sql14->result() as $r14){
					$oid14[] = $r14->order_id;
					$pid14[] = $r14->product_id;
				}
				$oArr14 = join(',',$oid14);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr14) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='sDem'){
		   	$sql15 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Damage Delivery',status) 
			AND ret_type='Damage Delivery' ORDER BY id DESC");
			if($sql15->num_rows() > 0){
				foreach($sql15->result() as $r15){
					$oid15[] = $r15->order_id;
					$pid12[] = $r15->product_id;
				}
				$oArr15 = join(',',$oid15);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr12) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }	  
		  }
		  
		  elseif($orstatus=='pRec'){
		  	$sql8 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Delivered',status) 
			AND NOT FIND_IN_SET('Payment Received',status) ORDER BY id DESC");
			if($sql8->num_rows() > 0){
				foreach($sql8->result() as $r8){
					$oid8[] = $r8->order_id;
					$pid8[] = $r8->product_id;
				}
				$oArr8 = join(',',$oid8);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr8) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='sRec'){
		   	$sql9 = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Payment Received',status) ORDER BY id DESC");
			if($sql9->num_rows() > 0){
				foreach($sql9->result() as $r9){
					$oid9[] = $r9->order_id;
					$pid9[] = $r9->product_id;
				}
				$oArr9 = join(',',$oid9);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($oArr9) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  
		  elseif($orstatus=='pRef'){
		  	
		  }
		  elseif($orstatus=='sRef'){
		   	$getPayRef = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Refund',status) <> 0 ORDER BY id DESC");
			if($getPayRef->num_rows() > 0){
				foreach($getPayRef->result() as $ordst){
					$getOrderId[] = $ordst->order_id;
				}
				$sarid = join(',',$getOrderId);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
		      }
			  else{
			  	$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='sCan'){
		  	$getOrderC = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('Cancelled',status) ORDER BY id DESC");
			if($getOrderC->num_rows() > 0){
				foreach($getOrderC->result() as $ordC){
					$getCOId[] = $ordC->order_id;
					$getproId[] = $ordC->product_id;
				}
				$retCID = join(',',$getCOId);
				$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($retCID) ORDER BY order_id DESC");
				$data['totalrecords'] = $data['datewisOrder']->num_rows();
			  }
			  else{
				$data['totalrecords'] = 0;
			  }
		  }
		  elseif($orstatus=='partial'){
		   
		  }
			
		
		$this->load->view('admin/reports/active_reports/orderReportAjax',$data);
	} 
	
	
	
	////////////  Active Reports///////////////////////
	function closed_reports()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Daily Sale Reports | Bargainnshopbd";
		$today=date('Y-m-d');

		// Closed Orders
		$data['closedOrder'] = $this->Index_model->getAllItemTable('orders','date',$today,'status','Closed','order_id','desc');
		
		$arraystatus = array('Delivered','Return','Miss Delivery','Damage Delivery','Cancelled');
		$succss = $arraystatus[0];
		$ret 	= $arraystatus[1];
		$miss 	= $arraystatus[2];
		$dem 	= $arraystatus[3];
		$can 	= $arraystatus[4];
		// Success Delivered
		$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$succss',status) <> 0 ORDER BY id DESC");
		foreach($getOrderSta->result() as $ordst){
			$getOrderId[] = $ordst->order_id;
		}
		$sarid = join(',',$getOrderId);
		$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) AND date = '$today' ORDER BY order_id DESC");
		$data['successOrders'] = $ordreinfo->num_rows();
		
		// Return Orders
		$rgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$ret',status) <> 0 ORDER BY id DESC");
		foreach($rgetOrderSta->result() as $rordst){
			$rgetOrderId[] = $rordst->order_id;
		}
		$rarid = join(',',$rgetOrderId);
		$ordreinfor = $this->db->query("SELECT * FROM orders WHERE order_id IN($rarid) AND date = '$today' ORDER BY order_id DESC");
		$data['returnOrders'] = $ordreinfor->num_rows();

		// Miss Delivered Orders
		$mgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$miss',status) <> 0 ORDER BY id DESC");
		foreach($mgetOrderSta->result() as $mordst){
			$mgetOrderId[] = $mordst->order_id;
		}
		$marid = join(',',$mgetOrderId);
		$ordreinfom = $this->db->query("SELECT * FROM orders WHERE order_id IN($marid) AND date = '$today' ORDER BY order_id DESC");
		$data['missOrders'] = $ordreinfom->num_rows();
		
		// Demaged Delivered Orders
		$dgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$dem',status) <> 0 ORDER BY id DESC");
		foreach($dgetOrderSta->result() as $dordst){
			$dgetOrderId[] = $dordst->order_id;
		}
		$darid = join(',',$dgetOrderId);
		
		$ordreinfod = $this->db->query("SELECT * FROM orders WHERE order_id IN($darid) AND date = '$today' ORDER BY order_id DESC");
		$data['demOrders'] = $ordreinfod->num_rows();
		
		// Cancelled Orders
		$cgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$can',status) <> 0 ORDER BY id DESC");
		foreach($cgetOrderSta->result() as $cordst){
			$cgetOrderId[] = $cordst->order_id;
		}
		$carid = join(',',$cgetOrderId);
		$ordreinfoc = $this->db->query("SELECT * FROM orders WHERE order_id IN($carid) AND date = '$today' ORDER BY order_id DESC");
		$data['canOrders'] = $ordreinfoc->num_rows();
		
		if(!$printsegment){
			$data['main_content']='admin/reports/closed_reports/default';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/closed_reports/default_print',$data);
		}
	} 
	
	
	
	function closed_reports_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			if($this->input->get('printdata')!="" && $this->input->get('printdata')=='print'){
				$fromdate=$this->input->get('fdate');
				$todate=$this->input->get('tdate');
			}
			else{
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		
		// Closed Orders
		$data['closedOrder'] = $this->Index_model->getItemBetween('orders','status','Closed','date',$fromdate,$todate,'order_id','desc');
		
			$arraystatus = array('Delivered','Return','Miss Delivery','Damage Delivery','Cancelled');
			$succss = $arraystatus[0];
			$ret 	= $arraystatus[1];
			$miss 	= $arraystatus[2];
			$dem 	= $arraystatus[3];
			$can 	= $arraystatus[4];
			// Success Delivered
			$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$succss',status) <> 0 ORDER BY id DESC");
			foreach($getOrderSta->result() as $ordst){
				$getOrderId[] = $ordst->order_id;
			}
			$sarid = join(',',$getOrderId);
			$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['successOrders'] = $ordreinfo->num_rows();
			
			// Return Orders
			$rgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$ret',status) <> 0 ORDER BY id DESC");
			foreach($rgetOrderSta->result() as $rordst){
				$rgetOrderId[] = $rordst->order_id;
			}
			$rarid = join(',',$rgetOrderId);
			$ordreinfor = $this->db->query("SELECT * FROM orders WHERE order_id IN($rarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['returnOrders'] = $ordreinfor->num_rows();

			// Miss Delivered Orders
			$mgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$miss',status) <> 0 ORDER BY id DESC");
			foreach($mgetOrderSta->result() as $mordst){
				$mgetOrderId[] = $mordst->order_id;
			}
			$marid = join(',',$mgetOrderId);
			$ordreinfom = $this->db->query("SELECT * FROM orders WHERE order_id IN($marid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['missOrders'] = $ordreinfom->num_rows();
			
			// Demaged Delivered Orders
			$dgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$dem',status) <> 0 ORDER BY id DESC");
			foreach($dgetOrderSta->result() as $dordst){
				$dgetOrderId[] = $dordst->order_id;
			}
			$darid = join(',',$dgetOrderId);
			
			$ordreinfod = $this->db->query("SELECT * FROM orders WHERE order_id IN($darid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['demOrders'] = $ordreinfod->num_rows();
			
			// Cancelled Orders
			$cgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$can',status) <> 0 ORDER BY id DESC");
			foreach($cgetOrderSta->result() as $cordst){
				$cgetOrderId[] = $cordst->order_id;
			}
			$carid = join(',',$cgetOrderId);
			$ordreinfoc = $this->db->query("SELECT * FROM orders WHERE order_id IN($carid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['canOrders'] = $ordreinfoc->num_rows();
			
			$this->load->view('admin/reports/closed_reports/dateWiseReportAjax',$data);
	} 
	
	
	
	function closed_order_reports_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			if($this->input->get('printdata')!="" && $this->input->get('printdata')=='print'){
				$fromdate=$this->input->get('fdate');
				$todate=$this->input->get('tdate');				
			}
			else{
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
		$orst=$this->input->get('orst');
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate,
						'orst'=> $orst
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		$orstatus=$this->session->userdata('orst');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');	
		
		$arraystatus = array('Delivered','Return','Miss Delivery','Damage Delivery','Cancelled');
		$succss = $arraystatus[0];
		$ret 	= $arraystatus[1];
		$miss 	= $arraystatus[2];
		$dem 	= $arraystatus[3];
		$can 	= $arraystatus[4];
			
	    if($orstatus=='closedOrder'){
			// Total Orders
			$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','status','Closed','date',$fromdate,$todate,'order_id','desc');
		}	
		elseif($orstatus=='successOrder'){
			// Success Delivered
			$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$succss',status) <> 0 ORDER BY id DESC");
			foreach($getOrderSta->result() as $ordst){
				$getOrderId[] = $ordst->order_id;
			}
			$sarid = join(',',$getOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='returnOrder'){
			// Return Delivered
			$rgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$ret',status) <> 0 ORDER BY id DESC");
			foreach($rgetOrderSta->result() as $rordst){
				$rgetOrderId[] = $rordst->order_id;
			}
			$rarid = join(',',$rgetOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($rarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='missOrder'){
			// Miss Delivered
			$mgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$miss',status) <> 0 ORDER BY id DESC");
			foreach($mgetOrderSta->result() as $mordst){
				$mgetOrderId[] = $mordst->order_id;
			}
			$marid = join(',',$mgetOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($marid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='demageOrder'){
			// Success Delivered
			$dgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$dem',status) <> 0 ORDER BY id DESC");
			foreach($dgetOrderSta->result() as $dordst){
				$dgetOrderId[] = $dordst->order_id;
			}
			$darid = join(',',$dgetOrderId);
			$data['datewisOrder']  = $this->db->query("SELECT * FROM orders WHERE order_id IN($darid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='cancelOrder'){
			// Success Delivered
			$cgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$can',status) <> 0 ORDER BY id DESC");
			foreach($cgetOrderSta->result() as $cordst){
				$cgetOrderId[] = $cordst->order_id;
			}
			$carid = join(',',$cgetOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($carid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		$this->load->view('admin/reports/closed_reports/orderReportAjax',$data);
	} 
	
	
	
	
	
////////////  Finance Active Reports///////////////////////
	function active_reports_finance()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Daily Sale Reports | Bargainnshopbd";
		$today=date('Y-m-d');
		
		$data['todayOrder'] = $this->Index_model->getAllItemTable('orders','date',$today,'','','order_id','desc');
		$data['totalamount'] = $this->Index_model->getTotalSumToday('orders','','','total_price','date',$today,'order_id','desc');
		$data['paidamount'] = $this->Index_model->getTotalSumToday('orders','','','paid_amount','date',$today,'order_id','desc');
		
		if(!$printsegment){
			$data['main_content']='admin/reports/finance/active_reports/default';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/finance/active_reports/default_print',$data);
		}
	} 
	
	
	
	function active_reports_finance_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
	
		$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
		$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		// Total Orders
		$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','','','date',$fromdate,$todate,'order_id','desc');
		$data['totalamount'] = $this->Index_model->getTotalSum('orders','','','total_price','date',$fromdate,$todate,'order_id','desc');
		$data['paidamount'] = $this->Index_model->getTotalSum('orders','','','paid_amount','date',$fromdate,$todate,'order_id','desc');
		$this->load->view('admin/reports/finance/active_reports/dateWiseReportAjax',$data);
	} 
	
	function order_reports_finance_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			if($this->input->get('printdata')!="" && $this->input->get('printdata')=='print'){
				$fromdate=$this->input->get('fdate');
				$todate=$this->input->get('tdate');				
			}
			else{
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
		$orst=$this->input->get('orst');
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate,
						'orst'=> $orst
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		$orstatus=$this->session->userdata('orst');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');	
		
		$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','','','date',$fromdate,$todate,'order_id','desc');
		$this->load->view('admin/reports/finance/active_reports/orderReportAjax',$data);
	} 
	
	
	
	////////////  Active Reports///////////////////////
	function closed_reports_finance()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Daily Sale Reports | Bargainnshopbd";
		$today=date('Y-m-d');

		// Closed Orders
		$data['closedOrder'] = $this->Index_model->getAllItemTable('orders','date',$today,'status','Closed','order_id','desc');
		$data['ctotalamount'] = $this->Index_model->getTotalSumToday('orders','status','Closed','total_price','date',$today,'order_id','desc');
		$data['cpaidamount'] = $this->Index_model->getTotalSumToday('orders','status','Closed','paid_amount','date',$today,'order_id','desc');
		
		$arraystatus = array('Delivered','Return','Miss Delivery','Damage Delivery','Cancelled');
		$succss = $arraystatus[0];
		$ret 	= $arraystatus[1];
		$miss 	= $arraystatus[2];
		$dem 	= $arraystatus[3];
		$can 	= $arraystatus[4];

		// Success Delivered
		$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$succss',status) <> 0 ORDER BY id DESC");
		foreach($getOrderSta->result() as $ordst){
			$getOrderId[] = $ordst->order_id;
		}
		$sarid = join(',',$getOrderId);
		$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) AND date = '$today' ORDER BY order_id DESC");
		$data['successOrders'] = $ordreinfo->num_rows();
		
		$succesamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($sarid) 
		AND date = '$today' ORDER BY order_id DESC");	
		$samr = $succesamount->row_array();
		$data['stotala'] = $samr['total'];
		$data['spaida'] = $samr['paid'];
				
		
		// Return Orders
		$rgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$ret',status) <> 0 ORDER BY id DESC");
		foreach($rgetOrderSta->result() as $rordst){
			$rgetOrderId[] = $rordst->order_id;
		}
		$rarid = join(',',$rgetOrderId);
		$ordreinfor = $this->db->query("SELECT * FROM orders WHERE order_id IN($rarid) AND date = '$today' ORDER BY order_id DESC");
		$data['returnOrders'] = $ordreinfor->num_rows();

		$retamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($rarid) 
		AND date = '$today' ORDER BY order_id DESC");	
		$ramr = $retamount->row_array();
		$data['rtotala'] = $ramr['total'];
		$data['rpaida'] = $ramr['paid'];
		
		
		// Miss Delivered Orders
		$mgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$miss',status) <> 0 ORDER BY id DESC");
		foreach($mgetOrderSta->result() as $mordst){
			$mgetOrderId[] = $mordst->order_id;
		}
		$marid = join(',',$mgetOrderId);
		$ordreinfom = $this->db->query("SELECT * FROM orders WHERE order_id IN($marid) AND date = '$today' ORDER BY order_id DESC");
		$data['missOrders'] = $ordreinfom->num_rows();
		
		$missamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($marid) 
		AND date = '$today' ORDER BY order_id DESC");	
		$mamr = $missamount->row_array();
		$data['mtotala'] = $mamr['total'];
		$data['mpaida'] = $mamr['paid'];
		
		// Demaged Delivered Orders
		$dgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$dem',status) <> 0 ORDER BY id DESC");
		foreach($dgetOrderSta->result() as $dordst){
			$dgetOrderId[] = $dordst->order_id;
		}
		$darid = join(',',$dgetOrderId);
		
		$ordreinfod = $this->db->query("SELECT * FROM orders WHERE order_id IN($darid) AND date = '$today' ORDER BY order_id DESC");
		$data['demOrders'] = $ordreinfod->num_rows();
		
		$demamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($darid) 
		AND date = '$today' ORDER BY order_id DESC");	
		$damr = $demamount->row_array();
		$data['dtotala'] = $damr['total'];
		$data['dpaida'] = $damr['paid'];
		
		
		// Cancelled Orders
		$cgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$can',status) <> 0 ORDER BY id DESC");
		foreach($cgetOrderSta->result() as $cordst){
			$cgetOrderId[] = $cordst->order_id;
		}
		$carid = join(',',$cgetOrderId);
		$ordreinfoc = $this->db->query("SELECT * FROM orders WHERE order_id IN($carid) AND date = '$today' ORDER BY order_id DESC");
		$data['canOrders'] = $ordreinfoc->num_rows();
		
		$canamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($carid) 
		AND date = '$today' ORDER BY order_id DESC");	
		$camr = $canamount->row_array();
		$data['ctotala'] = $camr['total'];
		$data['cpaida'] = $camr['paid'];
		
		if(!$printsegment){
			$data['main_content']='admin/reports/finance/closed_reports/default';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/finance/closed_reports/default_print',$data);
		}
	} 
	
	
	
	function closed_reports_finance_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			if($this->input->get('printdata')!="" && $this->input->get('printdata')=='print'){
				$fromdate=$this->input->get('fdate');
				$todate=$this->input->get('tdate');
			}
			else{
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		
		// Closed Orders
		$data['closedOrder'] = $this->Index_model->getItemBetween('orders','status','Closed','date',$fromdate,$todate,'order_id','desc');
		$data['ctotalamount'] = $this->Index_model->getTotalSum('orders','status','Closed','total_price','date',$fromdate,$todate,'order_id','desc');
		$data['cpaidamount'] = $this->Index_model->getTotalSum('orders','status','Closed','paid_amount','date',$fromdate,$todate,'order_id','desc');
		
		

			$arraystatus = array('Delivered','Return','Miss Delivery','Damage Delivery','Cancelled');
			$succss = $arraystatus[0];
			$ret 	= $arraystatus[1];
			$miss 	= $arraystatus[2];
			$dem 	= $arraystatus[3];
			$can 	= $arraystatus[4];
			// Success Delivered
			$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$succss',status) <> 0 ORDER BY id DESC");
			foreach($getOrderSta->result() as $ordst){
				$getOrderId[] = $ordst->order_id;
			}
			$sarid = join(',',$getOrderId);
			$ordreinfo = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['successOrders'] = $ordreinfo->num_rows();
			
			$succesamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($sarid) 
			AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");	
			$samr = $succesamount->row_array();
			$data['stotala'] = $samr['total'];
			$data['spaida'] = $samr['paid'];
					
			
			// Return Orders
			$rgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$ret',status) <> 0 ORDER BY id DESC");
			foreach($rgetOrderSta->result() as $rordst){
				$rgetOrderId[] = $rordst->order_id;
			}
			$rarid = join(',',$rgetOrderId);
			$ordreinfor = $this->db->query("SELECT * FROM orders WHERE order_id IN($rarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['returnOrders'] = $ordreinfor->num_rows();

			$retamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($rarid) 
			AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");	
			$ramr = $retamount->row_array();
			$data['rtotala'] = $ramr['total'];
			$data['rpaida'] = $ramr['paid'];
			
			
			// Miss Delivered Orders
			$mgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$miss',status) <> 0 ORDER BY id DESC");
			foreach($mgetOrderSta->result() as $mordst){
				$mgetOrderId[] = $mordst->order_id;
			}
			$marid = join(',',$mgetOrderId);
			$ordreinfom = $this->db->query("SELECT * FROM orders WHERE order_id IN($marid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['missOrders'] = $ordreinfom->num_rows();
			
			$missamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($marid) 
			AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");	
			$mamr = $missamount->row_array();
			$data['mtotala'] = $mamr['total'];
			$data['mpaida'] = $mamr['paid'];
			
			// Demaged Delivered Orders
			$dgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$dem',status) <> 0 ORDER BY id DESC");
			foreach($dgetOrderSta->result() as $dordst){
				$dgetOrderId[] = $dordst->order_id;
			}
			$darid = join(',',$dgetOrderId);
			
			$ordreinfod = $this->db->query("SELECT * FROM orders WHERE order_id IN($darid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['demOrders'] = $ordreinfod->num_rows();
			
			$demamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($darid) 
			AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");	
			$damr = $demamount->row_array();
			$data['dtotala'] = $damr['total'];
			$data['dpaida'] = $damr['paid'];
			
			
			// Cancelled Orders
			$cgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$can',status) <> 0 ORDER BY id DESC");
			foreach($cgetOrderSta->result() as $cordst){
				$cgetOrderId[] = $cordst->order_id;
			}
			$carid = join(',',$cgetOrderId);
			$ordreinfoc = $this->db->query("SELECT * FROM orders WHERE order_id IN($carid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
			$data['canOrders'] = $ordreinfoc->num_rows();
			
			$canamount = $this->db->query("SELECT SUM(total_price) AS total,SUM(paid_amount) AS paid FROM orders WHERE order_id IN($carid) 
			AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");	
			$camr = $canamount->row_array();
			$data['ctotala'] = $camr['total'];
			$data['cpaida'] = $camr['paid'];
		
			$this->load->view('admin/reports/finance/closed_reports/dateWiseReportAjax',$data);
	} 
	
	
	
	function closed_order_reports_finance_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			if($this->input->get('printdata')!="" && $this->input->get('printdata')=='print'){
				$fromdate=$this->input->get('fdate');
				$todate=$this->input->get('tdate');				
			}
			else{
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
		$orst=$this->input->get('orst');
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate,
						'orst'=> $orst
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		$orstatus=$this->session->userdata('orst');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');	
		
		$arraystatus = array('Delivered','Return','Miss Delivery','Damage Delivery','Cancelled');
		$succss = $arraystatus[0];
		$ret 	= $arraystatus[1];
		$miss 	= $arraystatus[2];
		$dem 	= $arraystatus[3];
		$can 	= $arraystatus[4];
			
	    if($orstatus=='closedOrder'){
			// Total Orders
			$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','status','Closed','date',$fromdate,$todate,'order_id','desc');
		}	
		elseif($orstatus=='successOrder'){
			// Success Delivered
			$getOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$succss',status) <> 0 ORDER BY id DESC");
			foreach($getOrderSta->result() as $ordst){
				$getOrderId[] = $ordst->order_id;
			}
			$sarid = join(',',$getOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($sarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='returnOrder'){
			// Return Delivered
			$rgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$ret',status) <> 0 ORDER BY id DESC");
			foreach($rgetOrderSta->result() as $rordst){
				$rgetOrderId[] = $rordst->order_id;
			}
			$rarid = join(',',$rgetOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($rarid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='missOrder'){
			// Miss Delivered
			$mgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$miss',status) <> 0 ORDER BY id DESC");
			foreach($mgetOrderSta->result() as $mordst){
				$mgetOrderId[] = $mordst->order_id;
			}
			$marid = join(',',$mgetOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($marid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='demageOrder'){
			// Success Delivered
			$dgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$dem',status) <> 0 ORDER BY id DESC");
			foreach($dgetOrderSta->result() as $dordst){
				$dgetOrderId[] = $dordst->order_id;
			}
			$darid = join(',',$dgetOrderId);
			$data['datewisOrder']  = $this->db->query("SELECT * FROM orders WHERE order_id IN($darid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		elseif($orstatus=='cancelOrder'){
			// Success Delivered
			$cgetOrderSta = $this->db->query("SELECT * FROM stock_order_product_status WHERE FIND_IN_SET('$can',status) <> 0 ORDER BY id DESC");
			foreach($cgetOrderSta->result() as $cordst){
				$cgetOrderId[] = $cordst->order_id;
			}
			$carid = join(',',$cgetOrderId);
			$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE order_id IN($carid) AND date BETWEEN '$fromdate' and '$todate' ORDER BY order_id DESC");
		}	
		$this->load->view('admin/reports/finance/closed_reports/orderReportAjax',$data);
	} 
	
	
	
	function ragular_finance_reports()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$pagetype=$this->uri->segment(3);
		
		$data['title']="Daily Sale Reports | Bargainnshopbd";
		$today=date('Y-m-d');
		$data['orderinfo'] = $this->Index_model->getAllItemTable('orders','status','Closed','','','order_id','desc');
		$printsegment=$this->uri->segment(4);
		if(!$printsegment){
			if($pagetype == 'paid_for_product'){
				$data['main_content']='admin/reports/ragularFinance/paidForProductReport';
			}
			elseif($pagetype == 'paid_for_delivery'){
				$data['main_content']='admin/reports/ragularFinance/paidForDeliveryReport';
			}
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			if($pagetype == 'paid_for_product'){
				$dprintpage='admin/reports/ragularFinance/paidForProductReportPrint';
			}
			elseif($pagetype == 'paid_for_delivery'){
				$dprintpage='admin/reports/paidForDeliveryReport/paidForDeliveryReportPrint';
			}
			
			$this->load->view($dprintpage,$data);
		}
	} 
	
	
	
	
	
	function today_reports()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Today Reports | Bargainnshopbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/todayReports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/todayReportsPrint',$data);
		}
	} 
	
	function datewise_reports()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Date Wise Reports| Bargainnshopbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/dateWiseReports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/dateWiseReportsPrint',$data);
		}
	} 
	
	
	function datewise_reports_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
	    $todate=date('Y-m-d',strtotime($this->input->get('tdate')));
		$sessiondata = array(
						'toDate'=>$fromdate,
						'fromDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$data['fromdate']=$this->session->userdata('toDate');
		$data['todate']=$this->session->userdata('fromDate');
		$this->load->view('admin/reports/dateWiseReportAjax',$data);
	} 
	
	
	function purchasereport()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['title']="Purchase Invoice Reports| Bargainnshopbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/purchaseinvoice_report';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/purchaseinvoice_reportPrint',$data);
		}
	} 
	
	function purchase_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
	    $todate=date('Y-m-d',strtotime($this->input->get('tdate')));

		$sessiondata = array(
						'toDate'=>$fromdate,
						'fromDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$data['fromdate']=$this->session->userdata('toDate');
		$data['todate']=$this->session->userdata('fromDate');
		$this->load->view('admin/reports/purchaseReportAjax',$data);
	} 
	
	
	
	//============================== Purchase ===================================
	
	
	
	
	function purchase()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
	
		$data['title']		= "Dashboard Bargainnshop | inventory";
		$data['inv_no']		= $this->Stock_model->purchaseinvoice();
		$data['product'] = $this->Index_model->getInstockProduct();
		
		$data['main_content']="admin/purchase/purchase_invoice_view";
        $this->load->view('admin_template',$data);
	
	}
	
	
	function purchasestock()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']			= "Stock";
		$data['product_list'] = $this->Index_model->getInstockProduct();
		
		$data['main_content']="admin/purchase/stock";
        $this->load->view('admin_template',$data);
	
	}
	
	function finditem()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$itemname = $this->input->post('pro_name');
		$data = $this->Stock_model->finditem_($itemname);
		echo $data;
	}
	
	public function purchaseinvoice()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$invNO=$this->input->post('invoice');
		
		$date=$this->input->post('date');
		list($month,$day,$year)=explode('/',$date);
		$mainDate=$year.'-'.$month.'-'.$day;
		
		$minvoice=$this->input->post('minvoice');

		$net_total=$this->input->post('net_total');

		$pro_code 		= $this->input->post('pro_code1');
		$pro_name	 	= $this->input->post('pro_name1');
		$pro_id			= $this->input->post('pro_id1');
		$qty			= $this->input->post('qty1');
		$price 			= $this->input->post('price1');
		$net			= $this->input->post('net1');
		
		$this->Stock_model->invoice_submit($invNO,$mainDate,$mainDeliDate,$net_total,$pro_code,$pro_name,$pro_id,$qty,$price,$net,$minvoice);
		
		redirect('Stockmanagement/purchase');
	}
	
	function stock_update()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;	
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$update['pro_id']=$this->input->post('product_id');
		
			$query = $this->db->query("select * from stock where pro_id ='".$update['pro_id']."'");
			if($query->num_rows() > 0){
				foreach($query->result() as $row);
				$qty = $row->pro_qty; 
			}
			else{
				$qty=0;	
			}	
		$add = $this->input->post('add');
		$minus = $this->input->post('minus');
		$return = $this->input->post('return');
		
			if(isset($add) && $add=='Add'){
				//$update['increase']=$this->input->post('pluse_qty');
				//$update['increase_note']=$this->input->post('pluse_note');
				$update['pro_qty']=$qty + $this->input->post('pluse_qty');
				$update['date']=date('Y-m-d');
				$save="";
				$status = 'stockin';
			}
			elseif(isset($minus) && $minus=='Minus'){
				//$update['decrease']=$this->input->post('minus_qty');
				//$update['decrease_note']=$this->input->post('minus_note');
				$update['pro_qty']=$qty - $this->input->post('minus_qty');
				$update['date']=date('Y-m-d');
				
				$save['pro_id']=$this->input->post('product_id');
				$save['buy_type']="Whole Sale";
				$save['buyername']=$this->input->post('buyername');
				$save['buyercontact']=$this->input->post('buyercontact');
				$save['buyeremail']=$this->input->post('buyeremail');
				$save['pro_qty']=$this->input->post('minus_qty');
				$save['remarks']=$this->input->post('remarks');
				$save['out_date']=date('Y-m-d');
				$status = 'stockout';
			}
			elseif(isset($return) && $return=='Return'){
				//$update['return_qty']=$this->input->post('return_qty');
				//$update['return_notes']=$this->input->post('return_notes');
				$update['pro_qty']=$qty + $this->input->post('return_qty');
				$update['date']=date('Y-m-d');
				
				$save['pro_id']=$this->input->post('product_id');
				$save['invoiceno']=$this->input->post('invoiceno');
				$save['sell_type']=$this->input->post('sell_type');
				$save['buyername']=$this->input->post('buyername');
				$save['buyercontact']=$this->input->post('buyercontact');
				$save['buyeremail']=$this->input->post('buyeremail');
				$save['pro_qty']=$this->input->post('return_qty');
				$save['remarks']=$this->input->post('remarks');
				$save['ret_date']=date('Y-m-d');
				$status = 'return';
			}
		$this->Index_model->stock_update($update,$save,$status); 
		redirect('administration/stockin_reports', '');
	}
	
	

	
	function stockin_reports()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$printsegment=$this->uri->segment(3);
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		$data['title']="Current Stock Reports | Bargainnshopbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/stockin/stockinReport';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/stockin/stockinReportPrint',$data);
		}
	} 
	
	
	function stockin_reports_ajax()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			if($this->input->get('key')!=""){
				$keyword = $this->input->get('key');
				$keytype = $this->input->get('keytype');
				$sessiondata = array(
							'keyval'=>$keyword,
							'keytype'=>$keytype
						   );
				$this->session->set_userdata($sessiondata);
				$proKey=$this->session->userdata('keyval');
				$keytype=$this->session->userdata('keytype');
					if($keytype=='product'){
						$sqlPeo=$this->db->query("select * from product where (product_name LIKE '%$proKey%' OR pro_code LIKE '%$proKey%') order by product_id desc");
					}
					elseif($keytype=='category'){
						$sqlPeo=$this->db->query("select * from product where cat_id='".$proKey."' order by product_id desc");
					}
				
				foreach($sqlPeo->result() as $pr){
					$proid[] = $pr->product_id;
				}
				$arrPro = join(',',$proid);
				$sql=$this->db->query("select * from stock where pro_id IN($arrPro) order by s_id desc");
			}
			
			elseif($this->input->get('currentstock')!=""){
				$sql=$this->db->query("select * from stock order by s_id desc");
			}
			elseif($this->input->get('tdate')!=""){
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
				$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate
						   );
				$this->session->set_userdata($sessiondata);
				$fromdate=$this->session->userdata('fromDate');
				$todate=$this->session->userdata('toDate');
				$sql=$this->db->query("select * from stock where (date between '$fromdate' and '$todate') order by s_id desc");
			}
			
			
		$data['stockreport'] = $sql;
		$this->load->view('admin/reports/stockin/stockinReportAjax',$data);
	} 
	
	
//////////////////////////////////////////Common for all/////////*****************************/////////////////////////////////////////
////////////////////===========================++++++++++++++++++=======================================================///	
	
	
	function cleareCachDate()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$sessiondata = array(
						'toDate'=>'',
						'fromDate'=> ''
					   );
		$this->session->set_userdata($sessiondata);
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	} 
	
	

	
	
	function _CreatePageThumbnail($filename, $dir,$w,$h) {
        $config['image_library']    = "gd2";      
        $config['source_image']     = $dir.$filename; 
		$config['new_image']		= $dir.'thumnail';
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = TRUE;      
        $config['width'] = $w;      
        $config['height'] = $h;
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize()):
            echo $this->image_lib->display_errors();
       	endif;   
    }
		



		
///////////  All  Delete///////////////////////
public function deleteOrder(){
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$oid = $this->input->get('deleteId');
		$this->Index_model->order_delete($oid);
	}
	
public function deleteData($tableName,$colId){
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
	}
	
public function pre_deleteData($tableName,$colId){
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
	}	
	
	function ajaxMenu()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if($this->input->get('menu_id')!=""){
			$rid=$this->input->get('menu_id');
			$sroot_menu = $this->Index_model->getAllItemTable('menu','','','','','menu_name','asc');
			$svar='<select name="root_id" id="root_id" class="form-control">
								<option value="">Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->slug.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	
	function ajaxCategory()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if($this->input->get('cat_id')!=""){
			$rid=$this->input->get('cat_id');
			$url="'".base_url()."administration/ajaxCategory?subcat_id='+this.value+''";
			//$urlsize="'".base_url()."administration/ajaxCategorySize?cat_id='+this.value+'&&size='+size'";
			$sroot_menu = $this->Index_model->getAllItemTable('sub_category','cat_id',$rid,'','','sub_cat_name','asc');
			$svar='<select name="subcat_id" id="subcat_id" class="form-control" onChange="getSubCategory('.$url.');">
								<option value="">Sub Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->sub_cat_title.'">'.$rootmenu->sub_cat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('subcat_id')!=""){
			$rid=$this->input->get('subcat_id');
			$sroot_menu = $this->Index_model->getAllItemTable('last_category','subcat_id',$rid,'','','lastcat_name','asc');
			$svar='<select name="lastcat_id" id="lastcat_id" class="form-control">
								<option value="">Last Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->last_cat_title.'">'.$rootmenu->lastcat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	
	function ajaxSisterConcern()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if($this->input->get('sist_id')!=""){
			$rid=$this->input->get('sist_id');
			$sroot_menu = $this->Index_model->getAllItemTable('menu','urlname',$rid,'','','menu_name','asc');
			$svar='<select name="root_id" id="root_id" class="form-control">
								<option value="">Sister Concern</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->slug.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	
	function ajaxCategorySize()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		//if($this->input->get('cat_id')!="" && $this->input->get('size')=="size"){
			$cat_id=$this->input->get('cat_id');
			$catSize = $this->Index_model->getAllItemTable('size','cat_id',$cat_id,'','','size','asc');
			$svar='<select name="pro_size[]" id="size_id" class="form-control"  multiple="multiple" style="min-height:150px">';
					   foreach($catSize->result() as $sizeval):
						  $svar .= '<option value="'.$sizeval->size.'">'.$sizeval->size.'</option>';
					  endforeach;
				$svar .= '</select>';
			echo $svar;
		//}
	}
	
	
	function ajaxCategoryColor()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		//if($this->input->get('cat_id')!="" && $this->input->get('color')=="color"){
			$cat_id=$this->input->get('cat_id');
			$catSize = $this->Index_model->getAllItemTable('color','cat_id',$cat_id,'','','color','asc');
			$svar='<select name="pro_color[]" id="color_id" class="form-control"  multiple="multiple" style="min-height:150px">';
					   foreach($catSize->result() as $sizeval):
						  $svar .= '<option value="'.$sizeval->color_title.'">'.$sizeval->color.'</option>';
					  endforeach;
				$svar .= '</select>';
			echo $svar;
		//}
	}
	
	
	
	
	function approve()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$approve_val[]=$this->input->get('approve_val');
		$tablename=$this->input->get('tablename');
		$id=$this->input->get('id');
		$status=$this->input->get('status');
		$this->Index_model->get_approve($approve_val,$tablename,$id,$status);   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	function deapprove()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$approve_val[]=$this->input->get('approve_val');
		$tablename=$this->input->get('tablename');
		$id=$this->input->get('id');
		$status=$this->input->get('status');
		$this->Index_model->get_deapprove($approve_val,$tablename,$id,$status);   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	function deapprovedCategory()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$deapprove_val[]=$this->input->get('deapprove_val');
		$this->Index_model->get_category_deapprove($deapprove_val,'');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
		
	
	function approved()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$approve_val[]=$this->input->get('approve_val');
		$this->Index_model->get_category_approve($approve_val,'customer');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	function deapproved()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$deapprove_val[]=$this->input->get('deapprove_val');
		$this->Index_model->get_category_deapprove($deapprove_val,'customer');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	public function ajaxdata_()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$idSelect =$this->input->get('q');
        $this->Stock_model->ajaxdata_($idSelect);
	}	
	
	public function preajaxData_()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$idSelect =$this->input->get('q');
        $this->Pre_stock_model->ajaxData_($idSelect);
	}
	
	public function datapro()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$pro_name =$this->input->get('pro_name');
        $data=$this->Stock_model->datapro($pro_name);
 		echo $data;
	}
	public function predatapro()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$pro_name =$this->input->get('pro_name');
        $data=$this->Pre_Pre_stock_model->datapro($pro_name);
 		echo $data;
	}
	
	
	function sequenceManage()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$tbl=$this->input->get('tbl');
		$tid=$this->input->get('tid');
		$seqence=$this->input->get('sequence');
		$id=$this->input->get('id');
		
		$query = $this->db->query("select * from ".$tbl." where sequence='".$seqence."'");
			foreach($query->result() as $row);
			$sequenceVal=$row->sequence;
			$nid=$row->$tid;
			
			if($seqence!=$sequenceVal){
				$update=$this->db->query("update ".$tbl." set sequence='".$seqence."' where ".$tid."='".$id."'");
			}
			else{
				$query1 = "select * from ".$tbl." where ".$tid."='".$id."'";
				$results1 = $this->db->query($query1);
				foreach($results1->result() as $row1);
				$sequenceVal1=$row1->sequence;
				$nid1=$row1->$tid;
			
				$update=$this->db->query("update ".$tbl." set sequence='".$sequenceVal1."' where ".$tid."='".$nid."'");
				$update1=$this->db->query("update ".$tbl." set sequence='".$seqence."' where ".$tid."='".$id."'");
			}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	
	public function deleteOneImage(){
	if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$id = $this->input->get('id');
		$table = $this->input->get('table');
		$colum = $this->input->get('colum');
		$this->Index_model->get_delete_image($table, $id, $colum);
	}
	
	
	/////////////// Accounting //////////////////////
	
	
	function opening_asset()
		{
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
			$data['title']="MMRK Group";
				$data['opening_asset_list'] = $this->Index_model->getAllItemTable('opening_asset','','','','','emh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['amount']	    = addslashes($this->input->post('amount'));
						$save['subimition_date']	    = date('Y-m-d');
						
						if($this->input->post('emh_id')!=""){
							$id=$this->input->post('emh_id');
							$this->Index_model->update_table('opening_asset','emh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('opening_asset', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/opening_asset', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/opening/asset";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/opening/asset";
					$this->load->view('admin_template',$data);
				}
			}



	function opening_liabilities()
		{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
				$data['opening_liabilities_list'] = $this->Index_model->getAllItemTable('opening_liabilities','','','','','emh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['amount']	    = addslashes($this->input->post('amount'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('emh_id')!=""){
							$id=$this->input->post('emh_id');
							$this->Index_model->update_table('opening_liabilities','emh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('opening_liabilities', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/opening_liabilities', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/opening/liablities";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/opening/liablities";
					$this->load->view('admin_template',$data);
				}
			}
		
		
		
	/////////////////////// Current Asset part ////////////////////////////////	 
	function current_asset_master_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['current_asset_master_head_list'] = $this->Index_model->getAllItemTable('current_asset_master_head','','','','','camh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('camh_id')!=""){
							$id=$this->input->post('camh_id');
							$this->Index_model->update_table('current_asset_master_head','camh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('current_asset_master_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/current_asset_master_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/asset/current_asset/master_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/asset/current_asset/master_head";
					$this->load->view('admin_template',$data);
				}
			}
	 
 	
	
	function current_asset_sub_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['current_asset_sub_head_list'] = $this->Index_model->getAllItemTable('current_asset_sub_head','','','','','cash_id','desc');
				$data['master_head_list'] = $this->Index_model->getAllItemTable('current_asset_master_head','','','','','camh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['master_head'] = $this->input->post('master_head');
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('cash_id')!=""){
							$id=$this->input->post('cash_id');
							$this->Index_model->update_table('current_asset_sub_head','cash_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('current_asset_sub_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/current_asset_sub_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/asset/current_asset/sub_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/asset/current_asset/sub_head";
					$this->load->view('admin_template',$data);
				}
			}



/////////////////////// Fixed Asset ////////////////////////////////	 


function fixed_asset_master_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['fixed_asset_master_head_list'] = $this->Index_model->getAllItemTable('fixed_asset_master_head','','','','','famh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('famh_id')!=""){
							$id=$this->input->post('famh_id');
							$this->Index_model->update_table('fixed_asset_master_head','famh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('fixed_asset_master_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/fixed_asset_master_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/asset/fixed_asset/master_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/asset/fixed_asset/master_head";
					$this->load->view('admin_template',$data);
				}
			}



function fixed_asset_sub_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['fixed_asset_sub_head_list'] = $this->Index_model->getAllItemTable('fixed_asset_sub_head','','','','','fash_id','desc');
				$data['master_head_list'] = $this->Index_model->getAllItemTable('fixed_asset_master_head','','','','','famh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['master_head'] = $this->input->post('master_head');
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('fash_id')!=""){
							$id=$this->input->post('fash_id');
							$this->Index_model->update_table('fixed_asset_sub_head','fash_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('fixed_asset_sub_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/fixed_asset_sub_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/asset/fixed_asset/sub_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/asset/fixed_asset/sub_head";
					$this->load->view('admin_template',$data);
				}
			}
	
	
	
	
	
	
	/////////////////////// Current liabilities part ////////////////////////////////	 
	function current_liabilities_master_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['current_liabilities_master_head_list'] = $this->Index_model->getAllItemTable('current_liabilities_master_head','','','','','clmh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('clmh_id')!=""){
							$id=$this->input->post('clmh_id');
							$this->Index_model->update_table('current_liabilities_master_head','clmh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('current_liabilities_master_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/current_liabilities_master_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/liabilities/current_liabilities/master_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/liabilities/current_liabilities/master_head";
					$this->load->view('admin_template',$data);
				}
			}
	 
 	
	
	function current_liabilities_sub_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['current_liabilities_sub_head_list'] = $this->Index_model->getAllItemTable('current_liabilities_sub_head','','','','','clsh_id','desc');
				$data['master_head_list'] = $this->Index_model->getAllItemTable('current_liabilities_master_head','','','','','clmh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['master_head'] = $this->input->post('master_head');
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('clsh_id')!=""){
							$id=$this->input->post('clsh_id');
							$this->Index_model->update_table('current_liabilities_sub_head','clsh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('current_liabilities_sub_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/current_liabilities_sub_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/liabilities/current_liabilities/sub_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/liabilities/current_liabilities/sub_head";
					$this->load->view('admin_template',$data);
				}
			}



/////////////////////// Fixed liabilities////////////////////////////////	 


function longterm_liabilities_master_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['longterm_liabilities_master_head_list'] = $this->Index_model->getAllItemTable('longterm_liabilities_master_head','','','','','flmh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('flmh_id')!=""){
							$id=$this->input->post('flmh_id');
							$this->Index_model->update_table('longterm_liabilities_master_head','flmh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('longterm_liabilities_master_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/longterm_liabilities_master_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/liabilities/longterm_liabilities/master_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/liabilities/longterm_liabilities/master_head";
					$this->load->view('admin_template',$data);
				}
			}



function longterm_liabilities_sub_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['longterm_liabilities_sub_head_list'] = $this->Index_model->getAllItemTable('longterm_liabilities_sub_head','','','','','flsh_id','desc');
				$data['master_head_list'] = $this->Index_model->getAllItemTable('longterm_liabilities_master_head','','','','','flmh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['master_head'] = $this->input->post('master_head');
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('flsh_id')!=""){
							$id=$this->input->post('flsh_id');
							$this->Index_model->update_table('longterm_liabilities_sub_head','flsh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('longterm_liabilities_sub_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/longterm_liabilities_sub_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/liabilities/longterm_liabilities/sub_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/liabilities/longterm_liabilities/sub_head";
					$this->load->view('admin_template',$data);
				}
			}
	
	
	
	function equity_master_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['equity_master_head_list'] = $this->Index_model->getAllItemTable('equity_master_head','','','','','emh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('emh_id')!=""){
							$id=$this->input->post('emh_id');
							$this->Index_model->update_table('equity_master_head','emh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('equity_master_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/equity_master_head', 'refresh');
					}
				else{
					$data['main_content']="admin/accounts/equity/master_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/equity/master_head";
					$this->load->view('admin_template',$data);
				}
			}



function equity_sub_head()
		{
		
		$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
		$data['title']="MMRK Group";
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="MMRK Group";
				
				 
				$data['equity_sub_head_list'] = $this->Index_model->getAllItemTable('equity_sub_head','','','','','esh_id','desc');
				$data['master_head_list'] = $this->Index_model->getAllItemTable('equity_master_head','','','','','emh_id','desc');
				
				$this->form_validation->set_rules('title', 'Method Name', 'trim|required');
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$save['master_head'] = $this->input->post('master_head');
						$save['title']	    = addslashes($this->input->post('title'));
                        $save['code']	    = addslashes($this->input->post('code'));
                        $save['details']	    = addslashes($this->input->post('details'));
						$save['subimition_date']	    = date('Y-m-d');
						 
						
						if($this->input->post('esh_id')!=""){
							$id=$this->input->post('esh_id');
							$this->Index_model->update_table('equity_sub_head','esh_id',$id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('equity_sub_head', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/equity_sub_head', 'refresh');
					}
				else{

					$data['main_content']="admin/accounts/equity/sub_head";
					$this->load->view('admin_template',$data);
					}
				}
				else{
					$data['main_content']="admin/accounts/equity/sub_head";
					$this->load->view('admin_template',$data);
				}
			}
		
/////////////////////// Revenue ////////////////////////////////			
	public function revenue()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title'] =  'Passwored Change | MMRK Group';
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$artiId=$this->uri->segment(3);
			if(!$artiId){
				$data['title']="payment Registration | Institute BD";
			}
			else{
				$data['title']="payment Update | Institute BD";
			}
			$data['revenueList'] = $this->Index_model->getAllItemTable('revenue','','','','','r_id','desc');
			if($this->input->post('registration') && $this->input->post('registration')!=""){
					
					$digits = 4;
					 $serial = rand(pow(10, $digits-1), pow(10, $digits)-1);
					 
					if($this->input->post('registration')){
						$liabilities 	= 	$this->input->post('liabilities');
						$master_head 	=  	$this->input->post('master_head');
						$sub_head 		=  	$this->input->post('sub_head');
						$amount 		= 	$this->input->post('amount');
						$amount_in_word = 	$this->input->post('amount_in_word');
						$received_by 	= 	$this->input->post('received_by');
						$received_date	=	$this->input->post('received_date');
						$voucher	=	$this->input->post('voucher');
					}
					else{
						$liabilities 	= 	$this->session->userdata('liabilities');
						$master_head 	=  	$this->session->userdata('master_head');
						$sub_head 		=  	$this->session->userdata('sub_head');
						$amount 		= 	$this->session->userdata('amount');
						$amount_in_word = 	$this->session->userdata('amount_in_word');
						$received_by 	= 	$this->session->userdata('received_by');
						$received_date	=	$this->session->userdata('received_date');
						$voucher	=	$this->session->userdata('voucher');
					}
						$sessionSearchdata = array(
									  'liabilities' => $liabilities,
									  'master_head' => $master_head,
									  'sub_head' => $sub_head,
									  'amount' => $amount,
									  'amount_in_word' => $amount_in_word,
									  'received_by' => $received_by,
									  'received_date' => $received_date,
									  'voucher' => $voucher
								 );
					$this->session->set_userdata($sessionSearchdata);
					
					//echo date('Y-m-d',strtotime($received_date));
					
					 
					$save['voucher']	    = $voucher;
					$save['liabilities']	    = $liabilities;
					$save['master_head']	    = $master_head;
					$save['sub_head']	    	= $sub_head;
					$save['amount']	    		= $amount;
					$save['amount_in_word']	  	= $amount_in_word;
					$save['received_by']	    = $received_by;
					$save['received_date']	    = date('Y-m-d', strtotime($received_date));
					$save['subimition_date']	= date('Y-m-d');
					
					if($this->input->post('r_id')!=""){
						$bd_id=$this->input->post('r_id');
						$this->Index_model->update_table('revenue','r_id',$bd_id,$save);
						$s='Updated';
					}
					else{
						$query = $this->Index_model->inertTable('revenue', $save);
						$s='Inserted';
						}
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
					redirect('administration/revenue_print', 'refresh');
			}
			else{
			  $data['main_content']="admin/accounts/revenue/revenue";
			  $this->load->view('admin_template', $data);
		    }
	}
	
	
	
	public function revenue_print()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title'] =  'Passwored Change | MMRK Group';
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			 
				
			$printsegment=$this->uri->segment(3);
			
			$liabilities 	= 	$this->session->userdata('liabilities');
			$master_head 	=  	$this->session->userdata('master_head');
			$sub_head 		=  	$this->session->userdata('sub_head');
			
			if($liabilities==1){
				$liab = 'Current Liabilities';
			}
			elseif($liabilities==2){
				$liab = 'Long Term Liabilities';
			}
			$queryMas  =$this->db->query("SELECT * FROM current_liabilities_master_head WHERE clmh_id='".$master_head."'");
			$rowM = $queryMas->row_array();
			
			$querySub  =$this->db->query("SELECT * FROM current_liabilities_sub_head WHERE clsh_id='".$sub_head."'");
			$rowS = $querySub->row_array();
			
			
			$data['liabilities'] 	= 	$liab;
			$data['master_head'] 	=  	$rowM['title'];
			$data['sub_head']		=  	$rowS['title'];
			$data['voucher'] 		= 	$this->session->userdata('voucher');
			$data['amount'] 		= 	$this->session->userdata('amount');
			$data['amount_in_word'] = 	$this->session->userdata('amount_in_word');
			$data['received_by'] 	= 	$this->session->userdata('received_by');
			$data['received_date']	=	$this->session->userdata('received_date');
			$data['title']="Print | Institute BD";
			
	} 
	
	
	
	function ajaxAccountsData()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title'] =  'Passwored Change | MMRK Group';
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				//////////////////// For Revenue Insert ///////////////////
				if($this->input->get('liabilities')!=""){
					$liabilities=$this->input->get('liabilities');			
					if($this->input->get('liabilities')=="1"){
					    //$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";	
						$url="'".base_url("administration/ajaxAccountsData")."'";
						$group_data = $this->Index_model->getAllItemTable('current_liabilities_master_head','','','','','clmh_id','desc');
						$svar='<select name="master_head" id="master_head" required class="form-control col-md-7 col-xs-12" onchange="getSubHeadList('.$url.')">
								<option value="">Master Head</option>';
								foreach($group_data->result() as $tgro){
									$svar .= '<option value="'.$tgro->clmh_id.'">'.$tgro->title.'</option>';
								}
							$svar .= '</select>';
						echo $svar;
					}	
					elseif($this->input->get('liabilities')=="2"){
						 //$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";
						$url="'".base_url("administration/ajaxAccountsData")."'";
						$group_data = $this->Index_model->getAllItemTable('longterm_liabilities_master_head','','','','','flmh_id','desc');
						$svar='<select name="master_head" id="master_head" class="form-control col-md-7 col-xs-12" onchange="getSubHeadList('.$url.')">
								<option value="">Master Head</option>';
								foreach($group_data->result() as $tgro){
									$svar .= '<option value="'.$tgro->flmh_id.'">'.$tgro->title.'</option>';
								}
							$svar .= '</select>';
						echo $svar;
					}	
				}
				elseif($this->input->get('liab_id')!="" && $this->input->get('masterH')!=""){
					$masterH	=	$this->input->get('masterH');
					$liab_id	=	$this->input->get('liab_id');
					
						if($liab_id=="1"){
							$group_data = $this->Index_model->getAllItemTable('current_liabilities_sub_head','master_head',$masterH,'','','clsh_id','desc');
							$svar='<select name="sub_head" id="sub_head" required class="form-control col-md-7 col-xs-12">
									<option value="">Sub Head</option>';
									foreach($group_data->result() as $tgro){
										$svar .= '<option value="'.$tgro->clsh_id.'">'.$tgro->title.'</option>';
									}
								$svar .= '</select>';
							echo $svar;
						}	
						elseif($liab_id=="2"){
							$group_data = $this->Index_model->getAllItemTable('longterm_liabilities_sub_head','master_head',$masterH,'','','flsh_id','desc');
							$svar='<select name="sub_head" id="sub_head" class="form-control col-md-7 col-xs-12">
									<option value="">Sub Head</option>';
									foreach($group_data->result() as $tgro){
										$svar .= '<option value="'.$tgro->flsh_id.'">'.$tgro->title.'</option>';
									}
								$svar .= '</select>';
							echo $svar;
						}	
				}
				
				
				
				
				//////////////////// For Revenue Update ///////////////////
				if($this->input->get('liabilitiesE')!=""){
					$liabilities=$this->input->get('liabilitiesE');			
					if($this->input->get('liabilitiesE')=="1"){
					    //$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";	
						$url="'".base_url("administration/ajaxAccountsData")."'";
						$group_data = $this->Index_model->getAllItemTable('current_liabilities_master_head','','','','','clmh_id','desc');
						$svar='<select name="master_head" id="master_headE"  required class="form-control col-md-7 col-xs-12" onchange="getSubHeadListEdit('.$url.')">
								<option value="">Master Head</option>';
								foreach($group_data->result() as $tgro){
									$svar .= '<option value="'.$tgro->clmh_id.'">'.$tgro->title.'</option>';
								}
							$svar .= '</select>';
						echo $svar;
					}	
					elseif($this->input->get('liabilitiesE')=="2"){
						 //$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";
						$url="'".base_url("administration/ajaxAccountsData")."'";
						$group_data = $this->Index_model->getAllItemTable('longterm_liabilities_master_head','','','','','flmh_id','desc');
						$svar='<select name="master_head" id="master_headE" class="form-control col-md-7 col-xs-12" onchange="getSubHeadListEdit('.$url.')">
								<option value="">Master Head</option>';
								foreach($group_data->result() as $tgro){
									$svar .= '<option value="'.$tgro->flmh_id.'">'.$tgro->title.'</option>';
								}
							$svar .= '</select>';
						echo $svar;
					}	
				}
				elseif($this->input->get('liab_idE')!="" && $this->input->get('masterHE')!=""){
					$masterH	=	$this->input->get('masterHE');
					$liab_id	=	$this->input->get('liab_idE');
					
						if($liab_id=="1"){
							$group_data = $this->Index_model->getAllItemTable('current_liabilities_sub_head','master_head',$masterH,'','','clsh_id','desc');
							$svar='<select name="sub_head" id="E required class="form-control col-md-7 col-xs-12">
									<option value="">Sub Head</option>';
									foreach($group_data->result() as $tgro){
										$svar .= '<option value="'.$tgro->clsh_id.'">'.$tgro->title.'</option>';
									}
								$svar .= '</select>';
							echo $svar;
						}	
						elseif($liab_id=="2"){
							$group_data = $this->Index_model->getAllItemTable('longterm_liabilities_sub_head','master_head',$masterH,'','','flsh_id','desc');
							$svar='<select name="sub_head" id="sub_headE" class="form-control col-md-7 col-xs-12">
									<option value="">Sub Head</option>';
									foreach($group_data->result() as $tgro){
										$svar .= '<option value="'.$tgro->flsh_id.'">'.$tgro->title.'</option>';
									}
								$svar .= '</select>';
							echo $svar;
						}	
				}
		}
	
	
	

/////////////////////// expenses ////////////////////////////////			
	
	
	
	
	public function expenses()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
        $data['title'] =  'Passwored Change | MMRK Group';
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
        
        $artiId=$this->uri->segment(3);
        if(!$artiId){
            $data['title']="payment Registration | Institute BD";
        }
        else{
            $data['title']="payment Update | Institute BD";
        }
        $data['expensesList'] = $this->Index_model->getAllItemTable('expenses','','','','','r_id','desc');
        if($this->input->post('registration') && $this->input->post('registration')!=""){
                
                $digits = 4;
                 $serial = rand(pow(10, $digits-1), pow(10, $digits)-1);
                 
                if($this->input->post('registration')){
                    $asset 	= 	$this->input->post('asset');
                    $master_head 	=  	$this->input->post('master_head');
                    $sub_head 		=  	$this->input->post('sub_head');
                    $amount 		= 	$this->input->post('amount');
                    $amount_in_word = 	$this->input->post('amount_in_word');
                    $received_by 	= 	$this->input->post('received_by');
                    $received_date	=	$this->input->post('received_date');
                    $voucher	=	$this->input->post('voucher');
                }
                else{
                    $asset 	= 	$this->session->userdata('asset');
                    $master_head 	=  	$this->session->userdata('emaster_head');
                    $sub_head 		=  	$this->session->userdata('esub_head');
                    $amount 		= 	$this->session->userdata('eamount');
                    $amount_in_word = 	$this->session->userdata('eamount_in_word');
                    $received_by 	= 	$this->session->userdata('payment_by');
                    $received_date	=	$this->session->userdata('payment_date');
                    $voucher	=	$this->session->userdata('evoucher');
                }
                    $sessionSearchdata = array(
                                  'asset' => $asset,
                                  'emaster_head' => $master_head,
                                  'esub_head' => $sub_head,
                                  'eamount' => $amount,
                                  'eamount_in_word' => $amount_in_word,
                                  'payment_by' => $received_by,
                                  'payment_date' => $received_date,
                                  'evoucher' => $voucher
                             );
                $this->session->set_userdata($sessionSearchdata);
                
                //echo date('Y-m-d',strtotime($received_date));
                
                 
                $save['voucher']	    = $voucher;
                $save['asset']	    = $asset;
                $save['master_head']	    = $master_head;
                $save['sub_head']	    	= $sub_head;
                $save['amount']	    		= $amount;
                $save['amount_in_word']	  	= $amount_in_word;
                $save['received_by']	    = $received_by;
                $save['received_date']	    = date('Y-m-d', strtotime($received_date));
                $save['subimition_date']	= date('Y-m-d');
                
                if($this->input->post('r_id')!=""){
                    $bd_id=$this->input->post('r_id');
                    $this->Index_model->update_table('expenses','r_id',$bd_id,$save);
                    $s='Updated';
                }
                else{
                    $query = $this->Index_model->inertTable('expenses', $save);
                    $s='Inserted';
                    }
                $this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
                redirect('administration/expenses_print', 'refresh');
        }
        else{
          $data['main_content']="admin/accounts/expenses/expenses";
          $this->load->view('admin_template', $data);
        }
	}
	
	
	
	public function expenses_print()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
				
				
				
				
			$printsegment=$this->uri->segment(3);
			
			$asset 	= 	$this->session->userdata('asset');
			$master_head 	=  	$this->session->userdata('emaster_head');
			$sub_head 		=  	$this->session->userdata('esub_head');
			
			if($asset==1){
				$liab = 'Current asset';
			}
			elseif($asset==2){
				$liab = 'Fixed asset';
			}
			$queryMas  =$this->db->query("SELECT * FROM current_asset_master_head WHERE camh_id='".$master_head."'");
			$rowM = $queryMas->row_array();
			
			$querySub  =$this->db->query("SELECT * FROM current_asset_sub_head WHERE cash_id='".$sub_head."'");
			$rowS = $querySub->row_array();
			
			
			$data['asset'] 	= 	$liab;
			$data['master_head'] 	=  	$rowM['title'];
			$data['sub_head']		=  	$rowS['title'];
			$data['voucher'] 		= 	$this->session->userdata('evoucher');
			$data['amount'] 		= 	$this->session->userdata('eamount');
			$data['amount_in_word'] = 	$this->session->userdata('eamount_in_word');
			$data['received_by'] 	= 	$this->session->userdata('payment_by');
			$data['received_date']	=	$this->session->userdata('payment_date');
			$data['title']="Print | Institute BD";
			/*if(!$printsegment){
				$data['main_content']="admin/accounts/expenses/payment_print";
				$this->load->view('admin_template',$data);
			}
			elseif($printsegment=='print'){*/
				$this->load->view('admin/accounts/expenses/payment_print_form',$data);
			//}
		
	} 
	
	
	
	function ajaxExpAccountsData()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="MMRK Group";
		//////////////////// For expenses Insert ///////////////////
		if($this->input->get('asset')!=""){
			$asset=$this->input->get('asset');			
			if($this->input->get('asset')=="1"){
				//$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";	
				$url="'".base_url("administration/ajaxExpAccountsData")."'";
				$group_data = $this->Index_model->getAllItemTable('current_asset_master_head','','','','','camh_id','desc');
				$svar='<select name="master_head" id="master_head" required class="form-control col-md-7 col-xs-12" onchange="getSubHeadList('.$url.')">
						<option value="">Master Head</option>';
						foreach($group_data->result() as $tgro){
							$svar .= '<option value="'.$tgro->camh_id.'">'.$tgro->title.'</option>';
						}
					$svar .= '</select>';
				echo $svar;
			}	
			elseif($this->input->get('asset')=="2"){
				 //$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";
				$url="'".base_url("administration/ajaxExpAccountsData")."'";
				$group_data = $this->Index_model->getAllItemTable('fixed_asset_master_head','','','','','famh_id','desc');
				$svar='<select name="master_head" id="master_head" class="form-control col-md-7 col-xs-12" onchange="getSubHeadList('.$url.')">
						<option value="">Master Head</option>';
						foreach($group_data->result() as $tgro){
							$svar .= '<option value="'.$tgro->famh_id.'">'.$tgro->title.'</option>';
						}
					$svar .= '</select>';
				echo $svar;
			}	
		}
		elseif($this->input->get('liab_id')!="" && $this->input->get('masterH')!=""){
			$masterH	=	$this->input->get('masterH');
			$liab_id	=	$this->input->get('liab_id');
			
				if($liab_id=="1"){
					$group_data = $this->Index_model->getAllItemTable('current_asset_sub_head','master_head',$masterH,'','','cash_id','desc');
					$svar='<select name="sub_head" id="sub_head" required class="form-control col-md-7 col-xs-12">
							<option value="">Sub Head</option>';
							foreach($group_data->result() as $tgro){
								$svar .= '<option value="'.$tgro->cash_id.'">'.$tgro->title.'</option>';
							}
						$svar .= '</select>';
					echo $svar;
				}	
				elseif($liab_id=="2"){
					$group_data = $this->Index_model->getAllItemTable('fixed_asset_sub_head','master_head',$masterH,'','','fash_id','desc');
					$svar='<select name="sub_head" id="sub_head" class="form-control col-md-7 col-xs-12">
							<option value="">Sub Head</option>';
							foreach($group_data->result() as $tgro){
								$svar .= '<option value="'.$tgro->fash_id.'">'.$tgro->title.'</option>';
							}
						$svar .= '</select>';
					echo $svar;
				}	
		}
		
		
		
		
		//////////////////// For expenses Update ///////////////////
		if($this->input->get('assetE')!=""){
			$asset=$this->input->get('assetE');			
			if($this->input->get('assetE')=="1"){
				//$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";	
				$url="'".base_url("administration/ajaxExpAccountsData")."'";
				$group_data = $this->Index_model->getAllItemTable('current_asset_master_head','','','','','camh_id','desc');
				$svar='<select name="master_head" id="master_headE"  required class="form-control col-md-7 col-xs-12" onchange="getSubHeadListEdit('.$url.')">
						<option value="">Master Head</option>';
						foreach($group_data->result() as $tgro){
							$svar .= '<option value="'.$tgro->camh_id.'">'.$tgro->title.'</option>';
						}
					$svar .= '</select>';
				echo $svar;
			}	
			elseif($this->input->get('assetE')=="2"){
				 //$url="'".base_url($urlname)."/ajaxAccountsData?master_head='+this.value+''";
				$url="'".base_url("administration/ajaxExpAccountsData")."'";
				$group_data = $this->Index_model->getAllItemTable('fixed_asset_master_head','','','','','famh_id','desc');
				$svar='<select name="master_head" id="master_headE" class="form-control col-md-7 col-xs-12" onchange="getSubHeadListEdit('.$url.')">
						<option value="">Master Head</option>';
						foreach($group_data->result() as $tgro){
							$svar .= '<option value="'.$tgro->famh_id.'">'.$tgro->title.'</option>';
						}
					$svar .= '</select>';
				echo $svar;
			}	
		}
		elseif($this->input->get('liab_idE')!="" && $this->input->get('masterHE')!=""){
			$masterH	=	$this->input->get('masterHE');
			$liab_id	=	$this->input->get('liab_idE');
			
				if($liab_id=="1"){
					$group_data = $this->Index_model->getAllItemTable('current_asset_sub_head','master_head',$masterH,'','','cash_id','desc');
					$svar='<select name="sub_head" id="E required class="form-control col-md-7 col-xs-12">
							<option value="">Sub Head</option>';
							foreach($group_data->result() as $tgro){
								$svar .= '<option value="'.$tgro->cash_id.'">'.$tgro->title.'</option>';
							}
						$svar .= '</select>';
					echo $svar;
				}	
				elseif($liab_id=="2"){
					$group_data = $this->Index_model->getAllItemTable('fixed_asset_sub_head','master_head',$masterH,'','','fash_id','desc');
					$svar='<select name="sub_head" id="sub_headE" class="form-control col-md-7 col-xs-12">
							<option value="">Sub Head</option>';
							foreach($group_data->result() as $tgro){
								$svar .= '<option value="'.$tgro->fash_id.'">'.$tgro->title.'</option>';
							}
						$svar .= '</select>';
					echo $svar;
				}	
		}
	}
	
	
	
	
	/////////////////////// protfolio ////////////////////////////////	 
	function protfolio_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			$data['title']="Protfolio List | dot3bd";
			$data['protfolio_list'] = $this->Index_model->getAllItemTable('protfolio','','','','','protfolio_id','desc');
			
			$data['main_content']="admin/protfolio/protfolio_list";
			$this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function protfolio_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				$artiId=$this->uri->segment(3);
				
				$data['protfolioUpdate'] = $this->Index_model->getAllItemTable('protfolio','protfolio_id',$artiId,'','','protfolio_id','desc');
				if(!$artiId){
					$data['title']="Protfolio Registration | institute Management System";
					$this->form_validation->set_rules('protfolio_headline', 'protfolio name', 'trim|required');
				}
				else{
					$data['title']="Protfolio Update | institute Management System";
					$this->form_validation->set_rules('protfolio_headline', 'protfolio name', 'trim|required');
				}
				if($this->input->post('registration') && $this->input->post('registration')!=""){
					if($this->form_validation->run() != false){
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000000';
						$config['upload_path'] = './uploads/images/protfolio/';
						$config['charset'] = "UTF-8";
						$new_name = "protfolio_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['ad_photo']['name']))
							{
								if($this->upload->do_upload('ad_photo')){
									$upload_data	= $this->upload->data();
									$save['image']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= $this->input->post('stillimg');
									$save['image']	= $upload_data;	
								}
							}
							
							
						$expval=explode(' ',$this->input->post('protfolio_headline'));
						$impval=implode('-',$expval);
						
						$save['update_type']	    = $this->input->post('update_type');
						$save['protfolio_headline']	    = addslashes($this->input->post('protfolio_headline'));
						$save['url']	    = addslashes($this->input->post('url'));
						$save['protfolio_details']	    = addslashes($this->input->post('details'));
						$save['slug']	    = addslashes(strtolower(str_replace('/','_',$impval)));						
						$save['date_time']	    = date('Y-m-d H:i:s');
						
						if($this->input->post('protfolio_id')!=""){
							$protfolio_id=$this->input->post('protfolio_id');
							$this->Index_model->update_table('protfolio','protfolio_id',$protfolio_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('protfolio', $save);
							$s='Inserted';
							}
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('administration/protfolio_list', 'refresh');
					}
					else{
						$data['main_content']="admin/protfolio/protfolio_action";
						$this->load->view('admin_template', $data);
						}
				}
				else{
					$data['main_content']="admin/protfolio/protfolio_action";
					$this->load->view('admin_template', $data);
				}
	}
	
	
	/////////////////////// clients ////////////////////////////////	 
	function clients_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Clients List | Agninet";
		$data['clients_list'] = $this->Index_model->getTable('clients','link_id','desc');
		$data['main_content']="admin/clients/clients_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function clients_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		
		$data['clientsUpdate'] = $this->Index_model->getAllItemTable('clients','link_id',$artiId,'','','link_id','desc');
		if(!$artiId){
			$data['title']="Clients Registration | Agninet";
			$this->form_validation->set_rules('headline', 'Link Title', 'trim|required|is_unique[clients.headline]');
			$this->form_validation->set_rules('link_url', 'Link URL', 'trim|required|is_unique[clients.link_url]');
		}
		else{
			$data['title']="Clients Update | Agninet";
			$this->form_validation->set_rules('headline', 'Link Title', 'trim|required');
			$this->form_validation->set_rules('link_url', 'Link URL', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
			
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/clients/';
				$config['charset'] = "UTF-8";
				$new_name = "photogallery_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['images']['name']))
					{
						if($this->upload->do_upload('images')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= "";
							$save['image']	= $upload_data;	
						}
					}
				
				
				$expval=explode(' ',$this->input->post('headline'));
				$impval=implode('-',$expval);
				$save['headline']	    = addslashes($this->input->post('headline'));
				$save['link_url']	    = addslashes($this->input->post('link_url'));
				$save['slug']	    = addslashes(strtolower($impval));
				$save['date_time']	    = date('Y-m-d H:i:s');
				
				if($this->input->post('link_id')!=""){
					$link_id=$this->input->post('link_id');
					$this->Index_model->update_table('clients','link_id',$link_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('clients', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/clients_list', 'refresh');
			}
			else{
				$data['main_content']="admin/clients/clients_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/clients/clients_action";
        	$this->load->view('admin_template', $data);
		}
	}
	
	
	

/////////////////////// ourservices ////////////////////////////////	 
	function ourservices_list()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Service List | dot3bd";
		$data['ourservices_list'] = $this->Index_model->getTable('ourservices','b_id','desc');
		$data['main_content']="admin/ourservices/ourservices_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function ourservices_registration()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Service Registration | dot3bd";
		}
		else{
			$data['title']="Service Update | dot3bd";
		}
		$data['ourservicesUpdate'] = $this->Index_model->getAllItemTable('ourservices','b_id',$artiId,'','','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('ourservices_name', 'ourservices name', 'trim|required');
			
			if($this->form_validation->run() != false){
				
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/ourservices/';
			$config['charset'] = "UTF-8";
			$new_name = "Banner_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
				if (isset($_FILES['ourservicesPhoto']['name']))
				{
					if($this->upload->do_upload('ourservicesPhoto')){
						$upload_data	= $this->upload->data();
						$save['image']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= "";
						$save['image']	= $upload_data;	
					}
				}	
				
				$save['ourservices_name']	    = $this->input->post('ourservices_name');
				$expval=explode(' ',$this->input->post('ourservices_name'));
			    $impval=implode('-',$expval);
				$save['slug']	    = addslashes(strtolower($impval));
				$save['details']	    = $this->input->post('details');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('ourservices','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('ourservices', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('administration/ourservices_list', 'refresh');
			}
			else{
				$data['main_content']="admin/ourservices/ourservices_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/ourservices/ourservices_action";
        $this->load->view('admin_template', $data);
	}
	
function getProductAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('keyword')!=""){
			$key=$this->input->post('keyword');
				$str='';
				
				$str .= '<ul class="autocomplete">';
					$querypay=$this->db->query("SELECT * FROM product WHERE product_name LIKE '%$key%' OR pro_code LIKE '%$key%'");
						foreach($querypay->result() as $payrow):
							$pro_id=$payrow->product_id;
							$product_name=$payrow->product_name;
							$passval = '"'.$product_name.'"';
							$str .='<li onclick=ajaxProduct('.$pro_id.');>'.$product_name.'</li>
							<input type="hidden" value="'.$product_name.'" name="proname" id="proname'.$pro_id.'">';
							
						endforeach;
			
			$str .= '</ul>';	
			$arrayData = array("prodlist"=>$str);
			echo json_encode($arrayData);
		}

	}

	function course()
	{
		
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List Bargainnshop | inventory";
		
		
		$uri_segment = $this->uri->segment(3);
		
		if($this->input->post('category_submit') && $this->input->post('category_submit') == 'save') {
			$save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/course/category/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['cat_image']['name'])) {

				if($this->upload->do_upload('cat_image')){
					$upload_data	= $this->upload->data();
					$cat_image	= $upload_data['file_name'];
					// $this->_CreatePageThumbnail($upload_data['file_name'], $config['upload_path'],250,300);			
					// $save['thumb'] = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
					}
					else{
						$upload_data	= $this->input->post('cat_image');
						// $save['thumb']=$this->input->post('cat_image');
						$cat_image	= $upload_data;	
					}
			}
			$save = $this->input->post();
			unset($save['category_submit']);
			$save['cat_image'] = $cat_image;
			$save['status'] = 1;
			$save['create_date'] = date('Y-m-d');
			
			$status = $this->Index_model->inertTable('ngo_course_category', $save);
			if($status) {
				redirect('administration/course/category', 'refresh');
			}
				
		} elseif($this->input->post('category_edit') && $this->input->post('category_edit') == 'edit') {
				
			$save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/course/category/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$cat_id = $this->input->post('edit_id');
			if (isset($_FILES['cat_image']['name']) && !empty($_FILES['cat_image']['name'])) {
				
				if($this->upload->do_upload('cat_image')) {
					$upload_data	= $this->upload->data();
					$cat_image	= $upload_data['file_name'];
				}
				else {
					$upload_data	= $this->input->post('cat_image');
					// $save['thumb']=$this->input->post('cat_image');
					$cat_image	= $upload_data;	
				}

				$save = $this->input->post();
				unset($save['category_edit']);
				unset($save['edit_id']);
				$save['cat_image'] = $cat_image;
				$status = $this->Index_model->update_table('ngo_course_category', 'id', $cat_id, $save);

			} else {
				
				$save = $this->input->post();
				unset($save['category_edit']);
				unset($save['edit_id']);
				
				$status = $this->Index_model->update_table('ngo_course_category', 'id', $cat_id, $save);
			}
			
			if($status) {
				redirect('administration/course/category', 'refresh');
			}
				
		} elseif($this->input->post('course_add') && $this->input->post('course_add') == 'course_add') {
			$save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/course/course/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['course_image']['name'])) {

				if($this->upload->do_upload('course_image')){
					$upload_data	= $this->upload->data();
					$course_image	= $upload_data['file_name'];

				}else{
						$upload_data	= $this->input->post('course_image');
						// $save['thumb']=$this->input->post('course_image');
						$course_image	= $upload_data;	
				}
			}
			$save = $this->input->post();
			
			unset($save['course_add']);

			$save['image'] = $course_image;
			$save['status'] = 1;
			$save['create_date'] = date('Y-m-d');
						
			$status = $this->Index_model->inertTable('ngo_courses', $save);
			if($status) {
				redirect('administration/course/courses_list', 'refresh');
			}
				
		} elseif($this->input->post('course_edit') && $this->input->post('course_edit') == 'course_edit') {
			$save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/course/course/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$course_id = $this->input->post('course_edit_flag');
			if (isset($_FILES['course_image']['name']) && !empty($_FILES['course_image']['name'])) {
				
				if($this->upload->do_upload('course_image')){
					$upload_data	= $this->upload->data();
					$course_image	= $upload_data['file_name'];

				}else{
						$upload_data	= $this->input->post('course_image');
						$course_image	= $upload_data;	
				}

				$save = $this->input->post();
				unset($save['course_edit']);
				unset($save['course_edit_flag']);
				$save['image'] = $course_image;
				$status = $this->Index_model->update_table('ngo_courses', 'id', $course_id, $save);

			} else {
				
				$save = $this->input->post();
				unset($save['course_edit']);
				unset($save['course_edit_flag']);
				$status = $this->Index_model->update_table('ngo_courses', 'id', $course_id, $save);
			}		
			
			if($status) {
				redirect('administration/course/courses_list', 'refresh');
			}
				
		} else {
			if($uri_segment == 'category') {
				$data['categories'] = $this->Index_model->getCategories();
				$data['image_path'] = base_url().'uploads/images/course/category/';
				$data['main_content']="admin/course/categories_list";
				$this->load->view('admin_template',$data);
			} elseif($uri_segment == 'category_add') {
				$data['main_content']="admin/course/category_add";
				$this->load->view('admin_template',$data);
			} elseif($uri_segment == 'category_edit') {
				$uri_segment_cat_id = $this->uri->segment(4);
				$data['categories'] = $this->Index_model->getCategories($uri_segment_cat_id);
				
				$data['main_content']="admin/course/category_edit";
				$this->load->view('admin_template',$data);
			} elseif($uri_segment == 'course_add') {
				$data['categories'] = $this->Index_model->getCategories();
				$data['main_content']="admin/course/course_add";
				$this->load->view('admin_template',$data);
			} elseif($uri_segment == 'course_edit') {
				$uri_segment_course_id = $this->uri->segment(4);
				$data['course'] = $this->Index_model->getCourses($uri_segment_course_id);
				$data['categories'] = $this->Index_model->getCategories();
				$data['main_content']="admin/course/course_edit";
				$this->load->view('admin_template',$data);
			} else {
				$data['courses'] = $this->Index_model->getCourses();
				$data['image_path'] = base_url().'uploads/images/course/course/';
				$data['main_content']="admin/course/courses_list";
				$this->load->view('admin_template',$data);
			}
		}
	}

	// Course Registration list
	function registration_list() {

		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List Bargainnshop | inventory";
	
		$uri_segment = $this->uri->segment(3);

		$data['registration_list'] = $this->Index_model->getRegistrationList();
		$data['image_path'] = base_url().'uploads/images/course/registration/';

		$data['main_content']="admin/course/registration_list";
		$this->load->view('admin_template',$data);
    }
    
    // Member Module
    function memberList() {

		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List Bargainnshop | inventory";
	
		$uri_segment = $this->uri->segment(3);

		$data['member_list'] = $this->Index_model->getMembers(null, true);
		$data['image_path'] = base_url().'uploads/images/member/';
        
		$data['main_content']="admin/member/member_list";
		$this->load->view('admin_template',$data);
    }
    
    function memberAdd() {

		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List Bargainnshop | inventory";
	
		$uri_segment = $this->uri->segment(3);

		$data['registration_list'] = $this->Index_model->getRegistrationList();
        $data['image_path'] = base_url().'uploads/images/course/registration/';
        
        // $this->input->post();

        if($this->input->post() && $this->input->post('member_submit') == 'member_add') {

            

            $save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/member/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_member-".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['member_photo']['name'])) {

				if($this->upload->do_upload('member_photo')){
                        $upload_data	= $this->upload->data();
                        $member_photo	= $upload_data['file_name'];
                }
                else{
                    $upload_data	= $this->input->post('member_photo');
                    $member_photo	= $upload_data;	
                }
            }
            $save = $this->input->post();
            $save['photo'] = $member_photo;
            $save['create_date'] = date('Y-m-d');
            $save['status'] = 1;

            unset($save['member_submit']);
            unset($save['social_link']);
            // social
            $save['social'] = serialize($this->input->post('social_link'));

            // echo "<pre>";
            // print_r($save);
            // die;
            $insert_member = $this->Index_model->inertTable('ngo_members', $save);

            
            redirect('administration/memberList');
            
        } elseif($this->input->post() && $this->input->post('member_submit') == 'member_update') {

            $save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/member/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_member-".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['member_photo']['name'])) {

				if($this->upload->do_upload('member_photo')){
                        $upload_data	= $this->upload->data();
                        $member_photo	= $upload_data['file_name'];
                }
                else{
                    $upload_data	= $this->input->post('member_photo');
                    $member_photo	= $upload_data;	
                }
            }
            $save = array_merge($this->input->post(), array('photo'=> $member_photo));
            echo "<pre>";
            print_r('update');
            die;
        } else {
            $data['main_content']="admin/member/member_add";
		    $this->load->view('admin_template',$data);
        }
		
    }
    
    function memberUpdate() {

		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['title']="Article List Bargainnshop | inventory";
	
		$uri_segment = $this->uri->segment(3);

		$data['registration_list'] = $this->Index_model->getRegistrationList();
        $data['image_path'] = base_url().'uploads/images/course/registration/';
        
        // $this->input->post();

        if($this->input->post() && $this->input->post('member_submit') == 'member_update') {

            $save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/member/';
			$config['charset'] = "UTF-8";
			$new_name = "karushoili_member-".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
            
            $save = $this->input->post();
			if(isset($_FILES['member_photo']['name']) && !empty($_FILES['member_photo']['name'])) {
                if (isset($_FILES['member_photo']['name'])) {

				if($this->upload->do_upload('member_photo')){
                    $upload_data	= $this->upload->data();
                    $member_photo	= $upload_data['file_name'];
                }
                else{
                    $upload_data	= $this->input->post('member_photo');
                    $member_photo	= $upload_data;	
                }

                    $save['photo'] = $member_photo;
                }
            } else {
                unset($save['photo']);
            }
            
            
            $save['create_date'] = date('Y-m-d');
            $save['status'] = (int)$this->input->post('status');

            unset($save['member_submit']);
            unset($save['social_link']);
            unset($save['member_id']);
            // social
            $save['social'] = serialize($this->input->post('social_link'));

            
            $insert_member = $this->Index_model->updateTable('ngo_members', 'id', $this->input->post('member_id'), $save);

            
            redirect('administration/memberList');
            
        } else {
            $get_memeber_id = $this->input->get('member_id');
            $data['get_memeber'] = $this->Index_model->getMembers($get_memeber_id);
            $data['member_social'] = unserialize($data['get_memeber']['social']);
            $data['image_path'] = base_url().'uploads/images/member/';
            
            $data['main_content']="admin/member/member_update";
		    $this->load->view('admin_template',$data);
        }
		
	}
    // Member Module END

    // Seller
    function seller()
	{
        if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$slug=urldecode($this->uri->segment(2));
		$expval=explode('-',$slug);
		$impval=implode(' ',$expval);
		$data['title'] = ucfirst('Member List');
        $data['footermenu']	= $this->Index_model->getAllMenu();

        $update_status = $this->input->post('update_status');
        $seller_pass = $this->input->post('seller_pass');
        $balance = $this->input->post('balance');

        $get_seller_data_by_id = $this->Index_model->getSellerApplication($this->input->post('seller_id'));
        
        
        if($update_status || $seller_pass || $balance) {
            
            $mobile = $get_seller_data_by_id['mobile'];
            
            if($get_seller_data_by_id['seller_code'] == '') {
                $mob = substr($mobile, -4);
                $date = substr(time(), -4);
                $seller_code = 'SB-'.$mob.$date;
                $update_data = array('status'=> $update_status, 'seller_code' => $seller_code);
            } else {
                $update_data = array('status'=> $update_status);
            }

            if(isset($seller_pass) && !empty($seller_pass)) {
                $update_data['seller_pass'] = sha1($seller_pass);
                if(isset($seller_code)) {
                    
                    //Email content
                    $htmlContent = "<p>Your Seller Code: $seller_code</p>";
                    $htmlContent .= "<p>Your Password: $seller_pass</p>";
                    $htmlContent .= "<p>Click on the link below for login</p>";
                    $htmlContent .= "<p><a href='".base_url('seller')."'>Click Here</a></p>";
                    $subject="Your account has been approved";
                    echo $htmlContent;
                    die;
                } else {
                    
                    //Email content
                    $htmlContent .= "<p>Your Password: $seller_pass</p>";
                    $htmlContent .= "<p>Click on the link below for login</p>";
                    $htmlContent .= "<p><a href='".base_url('seller')."'>Click Here</a></p>";
                    $subject="Your password was changed";
                    echo $htmlContent;
                    die;
                }
                // Send Mail
                //********************************

					$tomail=$get_seller_data_by_id['email'];
					$frommail="info@Bargainnshop.com";
					$list = array($tomail,$this->cem);
					
					//Load email library
					$this->load->library('email');

					//SMTP & mail configuration
					$config = array(
						'protocol'  => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'shohan.st27@gmail.com',
						'smtp_pass' => 'ISlaM?$&^$$8662',
						'mailtype'  => 'html',
						'charset'   => 'utf-8'
					);
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");


					$this->email->to($tomail);
					$this->email->from($frommail);
					$this->email->subject($subject);
					$this->email->message($htmlContent);

					//Send email
					$this->email->send();
					//********************************** END
            }
            
            $seller_id = $this->Index_model->update_table('Bargainnshop_seller_registration', 'id', (int)$this->input->post('seller_id'), $update_data);
            
            if($seller_id == 1) {
                $seller_balance_data['seller_id'] = (int)$this->input->post('seller_id');
                $seller_balance_data['commission'] = 0;
                $seller_balance_data['balance'] = 0;
                $seller_balance_data['update_date'] = date('Y-m-d');

                $check_seller_exist = $this->Index_model->seller_balance((int)$this->input->post('seller_id'));
                
                if($check_seller_exist->num_rows() == 0 ) {
                    $this->Index_model->inertTable('Bargainnshop_seller_balance', $seller_balance_data);
                }
                
                $get_seller_balance = $check_seller_exist->row_array();

                if(isset($balance) && !empty($balance)) {
                    $update_balance_data['balance'] = (float)$get_seller_balance['balance'] + (float)$balance;
                    $this->Index_model->update_table('Bargainnshop_seller_balance', 'seller_id', (int)$this->input->post('seller_id'), $update_balance_data);
                }
                
                redirect('Administration/seller');
            }
        }
        
        $data['seller_application'] = $this->Index_model->getSellerApplication();
        
        $data['main_content']="admin/seller/seller_list";
		$this->load->view('admin_template', $data);
        
    }

    public function seller_order() {
        if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
        $data['clogo'] = $this->clogo;
        $data['title']="Profile";
        $seller_id = $this->session->userdata('SellerID');

                
        // Product Query
        $totalResources = $this->Index_model->getSellerOrderHistory();
		$config = array();
		$config['base_url'] = base_url('seller/order_list');
		$config["per_page"] = 10;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config["total_rows"] = $totalResources->num_rows();
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;			
		$data['product_list'] = $this->Index_model->getSellerOrderHistory(null, null,true,$config["per_page"],$page);
        
        
        $data['main_content']="admin/seller/order_history";
        $this->load->view('admin_template',$data);
    }

    function seller_view_order($order_id)
	{
		 if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		 	$data['cname'] = $this->cname;
			$data['cmob'] = $this->cmob;
			$data['cem'] = $this->cem;
			$data['cadd'] = $this->cadd;
			$data['clogo'] = $this->clogo;
    

            $seller_order_data = $this->Index_model->getSellerOrderHistory((int)$order_id);
            
			
			$data['seller_order_data'] = $seller_order_data;
			$data['title']="Bargainnshop | Customer Order Details";
			$data['main_content']="admin/seller/view_order";
			$this->load->view('admin_template', $data);
	}

    function seller_invoice($inpoiceId)
	 {
        if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
        $data['cname'] = $this->cname;
        $data['cmob'] = $this->cmob;
        $data['cem'] = $this->cem;
        $data['cadd'] = $this->cadd;
        $data['clogo'] = $this->clogo;
        

        if(!$inpoiceId) redirect('error');
        $data['invoiceData']= $this->Index_model->getDataById('invoice','inv_id',$inpoiceId,'inv_id','desc','1');
        foreach($data['invoiceData']->result() as $invoiceData);
        $order_id = $invoiceData->order_id;
        $data['order_id']=$order_id;
        $data['inv_id']=$inpoiceId;
        $data['title']="Bargainnshop | Customer Order Details";
        
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
        
        if($this->input->get('status') && $this->input->get('status')!=""){
            $this->load->view('admin/order/invoice_print', $data);
        }
        else{
            $data['main_content']="admin/order/invoice";
            $this->load->view('admin_template', $data);
        }
	}

    
}

?>

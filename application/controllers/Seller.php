<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seller extends CI_Controller {

    public $cname;
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
		$this->load->model('Stock_model');
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
		if($this->session->userdata('SellerCode')) redirect("seller/dashboard");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="CMSN BD | Inventory Management System";
        $this->load->view('user/index',$data);
	}


/////////////////////// Admin Part ////////////////////////////////	 
		
	function seller()
	{
		if(!$this->session->userdata('SellerCode')) redirect("seller");
		$data['title']="Article List CMSN BD | inventory";
		$data['title']="Mlm user List | Amar Dokan";
		$mid=$this->session->userdata('SellerID');
		$all_ref_id = $this->Index_model->getRefIdByCol('customer_id',$mid);
		$ref_unique_id = array();
		$i = 0;
		foreach($all_ref_id as $id) {
			$all_unique_transaction_data = $this->Index_model->getMlmTransactionValue($id['ref_id']);
			foreach($all_unique_transaction_data as $unique_data) {
				$ref_unique_id[$i] = $unique_data['id'];
			}
			$i++;
		}
		$transaction_unique_id_coma_separate = implode(',', $ref_unique_id);
		$data['mlm_user_list'] = $this->Index_model->mlm_user_list($transaction_unique_id_coma_separate);
		// Total Wallet
		$data['mlm_total_wallet'] = $this->Index_model->getBalance($mid)->row_array();
		$data['main_content']="user/mlm_users/mlm_user_list";
        $this->load->view('user_template',$data);

        // print_r($data);
	} 


	function dashboard()
	{
		if(!$this->session->userdata('SellerCode')) redirect("seller");
		$data['title']="Dashboard Sbgift";
        $data['main_content']="user/dashboard";
        
        $data['clogo'] = $this->clogo;
        
        $this->load->view('user_template',$data);
	}
	
	public function userLogin()
    {
        $username = $this->input->post("username");
  		$password = $this->input->post("password");
        // $this->form_validation->set_rules("username", "Email", "trim|required|min_length[6]|valid_email");
        $this->form_validation->set_rules("username", "Email", "trim|required");
        $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('seller');
          }
          else
          {
            $usr_result = $this->Index_model->getSellerLogin($username, $password);
            if ($usr_result > 0) //active user record is present
            {
                $sessiondata = array(
                'SellerCode'=>$username,
                'SellerName'=> $usr_result['full_name'],
                'SellerEmail'=> $usr_result['email'],
                'SellerID' => $usr_result['id'],
                'SellerImage' => $usr_result['profile_image'],
                'password' => TRUE
                );
                $this->session->set_userdata($sessiondata);
                redirect("seller/dashboard/");
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                redirect('seller');
            }
        }
    }
	 
    function logout()
  	{
	  $sessiondata = array(
				'SellerCode'=>'',
				'SellerName'=> '',
				'SellerEmail'=> '',
				'SellerID' => '',
				'password' => FALSE
		 );
        $this->session->unset_userdata($sessiondata);
        $this->session->sess_destroy();
        redirect('seller', 'refresh');
    }
  
    function profile() {
        if(!$this->session->userdata('SellerCode')) redirect("seller/dashboard");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
        $data['clogo'] = $this->clogo;
        $data['title']="Profile";
        $seller_id = $this->session->userdata('SellerID');
        
        
        $submit_seller_data = $this->input->post();
        if($submit_seller_data) {
            // For Image
            $config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
            $config['remove_spaces'] = true;
            $config['upload_path'] = './uploads/images/seller/profile/';
            $config['charset'] = "UTF-8";
            $new_name = "sbgift_".time();
            $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if (isset($_FILES['profile_image']['name']))
            {
                if($this->upload->do_upload('profile_image')){

                    $upload_data	= $this->upload->data();
                    $submit_seller_data['profile_image'] = $upload_data['file_name'];

                } else{
                    $upload_data	= $this->input->post('mainImg');
                    $submit_seller_data['profile_image']	= $upload_data;	
                }
            }
            // Image End
            $update_id = $this->Index_model->update_table('sbgift_seller_registration', 'id', $seller_id, $submit_seller_data);
            if($update_id) {
                $data['status'] = 'Successfully updated';
            }
        }

        $data['seller_data'] = $this->Index_model->getSellerApplication($seller_id);
        $data['main_content']="user/profile";
        $this->load->view('user_template',$data);
    }

    function application()
	{
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
		
		$slug=urldecode($this->uri->segment(2));
		$expval=explode('-',$slug);
		$impval=implode(' ',$expval);
		$data['title'] = ucfirst('Member List');
        $data['footermenu']	= $this->Index_model->getAllMenu();
        
        // $data['members'] = $this->Index_model->getMembers();
        

        $get_application_data = $this->input->post();
        
        $ins_data = $this->Index_model->inertTable('sbgift_seller_registration', $get_application_data);

        if($ins_data) {
            $data['status'] = 'Application Submited Successfully';
        }

        $data['main_content']="frontend/seller-application";
		$this->load->view('template', $data);
        
    }

    public function product_list() {
        if(!$this->session->userdata('SellerCode')) redirect("seller/dashboard");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
        $data['clogo'] = $this->clogo;
        $data['title']="Profile";
        $seller_id = $this->session->userdata('SellerID');

        $sell_product_data = $this->input->post();
        
        if($sell_product_data) {
            
            $sell_product_data['seller_id'] = $this->session->userdata('SellerID');
            $sell_product_data['order_date'] = date('Y-m-d');

            if($sell_product_data['pro_qty'] > 0) {
                
// **********************
                $seller_balance = $this->Index_model->seller_balance((int)$this->session->userdata('SellerID'));
                
                if($seller_balance->num_rows() !=0 ) {
                    
                    $get_seller_balance = $seller_balance->row_array();
                    if((float)$get_seller_balance['balance'] >= (float)$sell_product_data['total_price']) {

                        // Check Product exist
                        $check_product_has_quantity = $this->Index_model->check_stock($sell_product_data['pro_id']);
                        $check_product_has_quantity = $check_product_has_quantity->row_array();
                        
                        if($check_product_has_quantity['pro_qty'] >= $sell_product_data['pro_qty']) {
                            // Inset Order record
                            $this->Index_model->inertTable('sbgift_seller_order', $sell_product_data);
                            // Decrease balance
                            $update_balance_data['balance'] = (float)$get_seller_balance['balance'] - (float)$sell_product_data['total_price'];
                                                        
                            $this->Index_model->update_table('sbgift_seller_balance', 'seller_id', (int)$this->session->userdata('SellerID'), $update_balance_data);
                            // Stock Update
                            $this->Index_model->update_stock($sell_product_data['pro_id'], $sell_product_data['pro_qty']);
                            $data['status'] = 'Order Completed';
                            $data['status_outlook'] = 'alert-success';
                        } else {
                            $data['status'] = "Sorry! Product has not enough quantity";
                            $data['status_outlook'] = 'alert-warning';
                        }
                        

                    } else {
                        $data['status'] = 'You don\'t have sufficient balance';
                        $data['status_outlook'] = 'alert-danger';
                    }
                } else {
                    $data['status'] = "somethign is wrong";
                    $data['status_outlook'] = 'alert-danger';
                }
// **********************
            } else {
                $data['status'] =  "Please select Quantity";
            }


        }
        
        // Product Query
        $totalResources = $this->Index_model->getProductListCount(null, null);
		$config = array();
		$config['base_url'] = base_url('seller/product_list');
		$config["per_page"] = 12;
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
		$data['product_list'] = $this->Index_model->getProductList(null,null,$config["per_page"],$page);
        // Product Query END
        
        $data['main_content']="user/product_list";
        $this->load->view('user_template',$data);
    }

    public function order_list() {
        if(!$this->session->userdata('SellerCode')) redirect("seller/dashboard");
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
		$data['product_list'] = $this->Index_model->getSellerOrderHistory(null, $seller_id,true,$config["per_page"],$page);
                
        $data['main_content']="user/order_history";
        $this->load->view('user_template',$data);
    }

    function commission_rate() {
        if(!$this->session->userdata('SellerCode')) redirect("seller/dashboard");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
        $data['clogo'] = $this->clogo;
        $data['title']="Profile";
        $seller_id = $this->session->userdata('SellerID');
        $category_data = $this->Index_model->get_category();
        
        $data['commission_rates'] = $category_data;
        $data['main_content']="user/commission_rate";
        $this->load->view('user_template',$data);
    }
  	
}

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
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
     	$this->load->library('facebook');
		$this->load->library('google');
		$this->load->helper('url');
		$this->load->model('User');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
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
	
	
	public function index(){
        $userData = array();$data['cname'] = $this->cname;
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
        $userData = array();
		$data['title'] = "Login";
        // Check if user is logged in
		echo $this->facebook->is_authenticated();
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,locale,cover,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $fbUserProfile['id'];
            $userData['first_name'] = $fbUserProfile['first_name'];
            $userData['last_name'] = $fbUserProfile['last_name'];
            $userData['email'] = $fbUserProfile['email'];
            $userData['gender'] = $fbUserProfile['gender'];
            $userData['locale'] = $fbUserProfile['locale'];
            $userData['cover'] = $fbUserProfile['cover']['source'];
            $userData['picture'] = $fbUserProfile['picture']['data']['url'];
            $userData['link'] = $fbUserProfile['link'];
            $data['userData'] = $userData;
            /*// Insert or update user data
            $userID = $this->user->checkUser($userData);
            
            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }
            
            // Get logout URL
            $data['logoutURL'] = $this->facebook->logout_url();
			
			
			$queryCheck = $this->Index_model->checkExistingEmail('customer','email',$userProfile['email']);
			if($queryCheck->num_rows() > 0 ){
				$exsrow = $queryCheck->row_array();
				$esuid = $exsrow['user_id'];
				$reduserid = $this->Index_model->updateTable('customer','user_id',$esuid,$save);
			}
			else{
				$reduserid = $this->Index_model->inertTable('customer', $save);
			}
           
				$sessiondata = array(
				  'userAccessMail'=>$userProfile['email'],
				  'userAccessType'=>'customer',
				  'userAccessName'=> $userProfile['username'],
				  'userAccessId' => $reduserid,
				  'password' => TRUE
				 );
				  $this->session->set_userdata($sessiondata);
				  redirect("profile");
            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();*/
			
        }else{
            // Get login URL
            $data['authURL'] =  $this->facebook->login_url();
        }
        
		
        	$data['footermenu']	= $this->Index_model->getAllMenu();
			$data['main_content']="frontend/login";
			$this->load->view('template', $data);
    }

   /* public function logout() {
        // Remove local Facebook session
        $this->facebook->destroy_session();
        // Remove user data from session
        $this->session->unset_userdata('userData');
        // Redirect to login page
        redirect('/user_authentication');
    }*/
	
	
	/*public function index(){$data['cname'] = $this->cname;
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
        $userData = array();
		$data['title'] = "Login";
       
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
			$save['oauth_provider']	    = 'facebook';
			$save['oauth_uid']	    = $userProfile['id'];
			$save['username']	    = $userProfile['first_name'].' '.$userProfile['last_name'];
			$save['mobile']	    = $userProfile['last_name'];
			$save['gender']	    = $userProfile['gender'];
			$save['email']	    = $userProfile['email'];
			$save['profile_url']	    = 'https://www.facebook.com/'.$userProfile['id'];
			$save['picture_url']	    = $userProfile['picture']['data']['url'];
			$save['created_date']	    = date('Y-m-d');
			$save['active']	    = 1;
			
			$queryCheck = $this->Index_model->checkExistingEmail('customer','email',$userProfile['email']);
			if($queryCheck->num_rows() > 0 ){
				$exsrow = $queryCheck->row_array();
				$esuid = $exsrow['user_id'];
				$reduserid = $this->Index_model->updateTable('customer','user_id',$esuid,$save);
			}
			else{
				$reduserid = $this->Index_model->inertTable('customer', $save);
			}
           
				$sessiondata = array(
				  'userAccessMail'=>$userProfile['email'],
				  'userAccessType'=>'customer',
				  'userAccessName'=> $userProfile['username'],
				  'userAccessId' => $reduserid,
				  'password' => TRUE
				 );
				  $this->session->set_userdata($sessiondata);
				  redirect("profile");
            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        }
		
		
		
        $data['loginURL'] = $this->google->loginURL();
		
            $fbuser = '';

            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
			$data['footermenu']	= $this->Index_model->getAllMenu();
			$data['main_content']="frontend/login";
			$this->load->view('template', $data);
       
		
    }*/
	public function profile(){
        //redirect to login page if user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect('/login/');
        }
        
        //get user info from session
        $data['userData'] = $this->session->userdata('userData');
        
        //load user profile view
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['main_content']="frontend/profile";
		$this->load->view('template', $data);
    }
    
    public function googlelogout(){
        //delete login status & user info from session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        
        //redirect to login page
        redirect('/login/');
    }
	
	public function userLogin()
     {$data['cname'] = $this->cname;
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
			
		  $data['title'] =  "User Login | Aalmirah";
          $username = $this->input->post("email");
  		  $password = $this->input->post("password");
		  $usertype = 'customer';
          $this->form_validation->set_rules("email", "Email Address Or Mobile No", "trim|required");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('index');
          }
          else
          {
			  $responseres = $this->Index_model->get_userLogin($username, $password,$usertype);
			  if ($responseres->num_rows() > 0) //active user record is present
			  {
			  	$usr_result = $responseres->row_array();
				$sessiondata = array(
				  'userAccessMail'=>$username,
				  'userAccessType'=>'customer',
				  'userAccessName'=> $usr_result['fname'].' '.$usr_result['lname'],
				  'userAccessId' => $usr_result['user_id'],
				  'password' => TRUE
				 );
				  $this->session->set_userdata($sessiondata);
				  redirect("profile");
			  }
			  else
			  {
				$this->session->set_flashdata('invalidmsg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px; color:red">Invalid Email and password!</div>');
				  redirect('login');
			  }
		 }
     }
	 
	 
	
    function logout()
  	{
	  $sessiondata = array(
				'userAccessMail'=>'',
				'userAccessType'=>'',
				'userAccessName'=> '',
				'userAccessId' => '',
				'password' => FALSE
		 );
	$this->session->set_userdata($sessiondata);
	$this->facebooklogout();
    redirect($_SERVER['HTTP_REFERER'], 'refresh');
  }
  
  
  
	
    public function facebooklogout() {
        // Remove local Facebook session
        $this->facebook->destroy_session();

        // Remove user data from session
        $this->session->unset_userdata('userData');

        // Redirect to login page
        redirect('/index');
    }
	

}

?>

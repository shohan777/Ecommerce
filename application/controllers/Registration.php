<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {
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
	
	public function email_check()
    {
        if($this->input->is_ajax_request()){
			$username = $this->input->get('username');
			//$this->form_validation->set_rules('username', 'Username', 'trim|required|regex_match[/^[A-Za-z0-9_]+$/]|is_unique[edoctors.username]');
			if(!$this->form_validation->is_unique($username, 'boutiqueshop.urlname')) {
				$this->output->set_content_type('application/json')->set_output(json_encode(
				array('message' => 'The username is already Exist, Please Choose another one', 'color'=>'red')));
			}
			else{
				$this->output->set_content_type('application/json')->set_output(json_encode(
				array('message' => 'The username Aavailable', 'color'=>'green')));
				}
		}
	}
	function ajaxData()
	{
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$sroot_menu = $this->Index_model->getAllItemTable('bangladesh','district',$rid,'','','district','asc');
			$svar='<select name="thana" class="form-control" style="width:70%;">
								<option value="">Select Thana</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->thana.'">'.$rootmenu->thana.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	function index()
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
		
		$data['title'] = 'Member Registration | Bargainnshop';
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		
		$data['totaldistrict']= $this->Index_model->getAllDistrict('bangladesh','','','district','district','asc');
		$data['main_content']="frontend/registration";
        $this->load->view('template', $data);
		
	}
	
	
	
	function useraction()
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
		
		$data['title'] = 'Member Registration | Bargainnshop';
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');		
		$data['totaldistrict']= $this->Index_model->getAllDistrict('bangladesh','','','district','district','asc');

			$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[customer.email]');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[customer.mobile]');
			
			if($this->form_validation->run() != false){
				
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
				$customer['password']	    = sha1($this->input->post('password'));					
				$customer['passwordHints']	= $this->input->post('password');
				$customer['active']	    = 1;
				$customer['created_date']	= date('Y-m-d H:i:s');
				$query = $this->Index_model->inertTable('customer', $customer);
				if($query){
					
					$email=$this->input->post('email');
					$mobile = $this->input->post('mobile');
					$password=$this->input->post('password');
					$tomaila=$email;
					$frommaila="bargainnshop@gmail.com";
					$subjecta="Thank ".$this->input->post('fname').' '.$this->input->post('lname'). " for registration with bargainnshop.com";
					$config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
					$this->email->initialize($config);
					$this->email->set_newline('\r\n');
					$email_bodya ="
					<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
					border:2px solid #f00; border-radius:13px; padding-left:20px;'>
					<tr style='background-color:#fff'>
					<th width='26%' height='79' align='center'> 
					<img src='".base_url('uploads/images/company/'.$this->clogo)."' />
					<th colspan='2' align='left'></th>
					</tr>
					<tr>
					<th height='37' colspan='3' align='left' 
						style='font-size:22px; color:#333; text-decoration:none;'>Login Information</th>
					</tr>
					<tr>
					<td height='137' colspan='3' align='right' valign='top'>
					<table width='100%' border='0' cellspacing='0' cellpadding='0'>
					<tr>
						<td width='37%' height='31'><strong>Email</strong></td>
						<td width='3%'><strong>:</strong></td>
						<td width='60%'>$email</td>
					</tr>
					<tr>
						<td width='37%' height='31'><strong>Mobile</strong></td>
						<td width='3%'><strong>:</strong></td>
						<td width='60%'>$mobile</td>
					</tr>
					<tr>
					<td height='29'><strong>Password</strong></td>
					<td><strong>:</strong></td>
					<td>$password</td>
					</tr>
					
					<tr>
					  <td colspan='3'> You can update your profile. For more help please contact Bargainnshop.<br />
								Our Support Team Contact : bargainnshop@gmail.com : '".$this->cmob."'</td>
					  </tr>
					<tr>
					  <td colspan='3'>&nbsp;</td>
					  </tr>
					</table></td>
					</tr>
					</table>";
				
					$this->email->from($frommaila, 'Bargainnshop');
					$this->email->to($tomaila);
					//$this->email->bcc();
					$this->email->subject($subjecta);
					$this->email->message($email_bodya);
					$this->email->send();
					$this->session->set_userdata('newmemberId',$query);
					redirect('registration/registrationSuccess', '');
				}
			}
			else{
				$data['main_content']="frontend/registration";
				$this->load->view('template', $data);
			}
	}
	
	
	public function registrationSuccess(){
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
		
		$data['title'] = 'Successfully Registration | Bargainnshop';
		$mid=$this->session->userdata('newmemberId');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['member'] = $this->Index_model->getOneItemTable('customer','user_id',$mid,'user_id','desc');
		$data['main_content']="frontend/registrationSuccess";
        $this->load->view('template', $data);
	}
	
	
	

}

?>

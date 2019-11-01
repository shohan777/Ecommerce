<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class course extends CI_Controller {
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
		$this->load->library('pagination');
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
		$data['title'] = ucfirst('Courses List');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['courses'] = $this->Index_model->getCourses();
        $data['main_content']="frontend/course/courses_list";
		$this->load->view('template', $data);
        
		
	}

	function detail() {

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
		
		$slug = urldecode($this->uri->segment(3));
		$expval=explode('-',$slug);
		$impval=implode(' ',$expval);
		// $data['title'] = ucfirst($impval);
		$data['footermenu']	= $this->Index_model->getAllMenu();

		if($this->input->post('course_registration') && $this->input->post('course_registration') == 'course_registration') {
			
			$save = array();
			$config = array();
			// Upload Image
			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/course/registration/';
			$config['charset'] = "UTF-8";
			$new_name = "student".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (isset($_FILES['std_image']['name'])) {

				if($this->upload->do_upload('std_image')){
					$upload_data	= $this->upload->data();
					$image	= $upload_data['file_name'];

				} else {
					$upload_data	= $this->input->post('std_image');
					$image	= $upload_data;	
				}

				$save = $this->input->post();
			
				unset($save['course_registration']);
				$save['image'] = $image;
				$save['status'] = 1;
				$save['create_date'] = date('Y-m-d');

			} else {
				$save = $this->input->post();
				unset($save['course_registration']);
				$save['status'] = 1;
				$save['create_date'] = date('Y-m-d');
			}
					
			$status = $this->Index_model->inertTable('ngo_courses_registration', $save);
			$redirect_url = 'course/detail/'.$this->input->post('course_id');
			if($status) {
				redirect($redirect_url, 'refresh');
			}
		}

		$data['course_detail'] = $this->Index_model->getCourses($slug);
		$data['course_id'] = $data['course_detail']['course_name'];
		$data['title'] = $data['course_detail']['course_name'];
		$data['image_path'] = base_url().'uploads/images/course/course/';

        $data['main_content']="frontend/course/course_detail";
		$this->load->view('template', $data);
	}


}

?>

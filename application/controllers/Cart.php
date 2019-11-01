<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_model');
		$this->load->model('Index_model');
		$this->load->library('MY_Cart');
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
		
		$data['title']	= 'Shopping Cart';
		$data['footermenu']	= $this->Index_model->getAllMenu();
		if (!$this->cart->contents()){
			$this->data['message'] = '<p>Your cart is empty!</p>';
		}else{
			$this->data['message'] = $this->session->flashdata('message');
		}
		$this->session->set_flashdata('cartMsg', '<div class="alert alert-success">Your Item added into Shopping Cart</div>');
		redirect($_SERVER['HTTP_REFERER']);
		/*$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getNotIdData('supplier','','','','','user_id','desc','');
		$data['main_content']="frontend/shopping_cart";
        $this->load->view('template', $data);*/
	}

	function shopping_cart()
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
		
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['title']	= 'Shopping Cart';
		$data['message']	= '<p>Your cart is empty!</p>';
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		//$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['main_content']="frontend/shopping_cart";
        $this->load->view('template', $data);
	}
			
	
	function view_trolly()
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
		
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['page_title']	= 'View Trolly';
		$data['message']	= '<p>Your cart is empty!</p>';
		$this->load->view('frontend/viewTrolly', $data);
	}
	
	function add()
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
		
		if($this->input->post('productQuantity')!=""){
			$qty=$this->input->post('productQuantity');
		}
		else{
			$qty=1;
		}
		$bounsid = $this->input->post('bonusid');
       
        
		$insert_room = array(
			'id'=> $this->input->post('id'),
			'bonus_id'=> $bounsid,
			'name'=> preg_replace("/'/", '', $this->input->post('name')),
			'price' => $this->input->post('price'),
			'qty' => $qty,
			'options' => array(
					'size' => $this->input->post('size'),'color' => $this->input->post('color'))
		     );

        
        // For Image
        $image = array();
        if($this->input->post('check_custom_order')) {
            if (isset($_FILES['custom_images']['name'])) {
                            
                $ImageCount = count($_FILES['custom_images']['name']);
                for($i = 0; $i < $ImageCount; $i++){
                    $_FILES['file']['name']       = $_FILES['custom_images']['name'][$i];
                    $_FILES['file']['type']       = $_FILES['custom_images']['type'][$i];
                    $_FILES['file']['tmp_name']   = $_FILES['custom_images']['tmp_name'][$i];
                    $_FILES['file']['error']      = $_FILES['custom_images']['error'][$i];
                    $_FILES['file']['size']       = $_FILES['custom_images']['size'][$i];

                    // File upload configuration
                    $uploadPath = './uploads/images/custom_order/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgData[$i] = $imageData['file_name'];
                    }
                }

                if (isset($uploadImgData) && !empty($uploadImgData)) {
                    $custom_images = implode(',', $uploadImgData);
                    $insert_room['custom_order_images'] = $custom_images;
                }
                if($this->input->post('custom_order_text') && $this->input->post('custom_order_text') != '') {
                    $insert_room['custom_order_text'] = $this->input->post('custom_order_text');
                }
            }
        }
        // Image End
        
		$this->cart->insert($insert_room);
        
        if($this->input->post('submit_type') == 'gocheckout') {
            redirect(base_url('checkout'));
        } else {
            redirect('index');
        }
		
	}
	
	function remove($rowid) {
		if ($rowid=="all"){
			$this->cart->destroy();
			redirect('index');
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
			redirect('index');
		}
		
		
	}	

	
	function update_cart(){
			$qty = $this->input->post('qty');
			$rowid = $this->input->post('rowid');
			$price = $this->input->post('price');
			$amount = $price * $qty;
				
			$this->Cart_model->update_cart($rowid, $qty, $price, $amount);
	}

}

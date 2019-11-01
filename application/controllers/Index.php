<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('common_helper');
		
		$this->load->library('facebook');
		
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
		
		$data['title'] = "Bargainshop | The Largest Online eCommerce Market in Bangladesh";
		$data['bannerslider']	= $this->Index_model->getDataById('banner','','','b_id','desc',10);
		$data['offerslider']	= $this->Index_model->getDataById('offer','banner','1','b_id','asc',10);
		$data['menu']	= $this->Index_model->getAllMenu();

		$data['leftcategory']	= $this->Index_model->getDataById('category','status','1','cid','desc','2');
		if($data['leftcategory']->num_rows() > 0){
			foreach($data['leftcategory']->result() as $catr){
				$catid[] = $catr->cid;
			}
		}
		else{
			$catid[] ='';
		}
		$data['rightcategory']	= $this->Index_model->getNotIdData('category','status','0','cid',$catid,'cid','desc',2);
		if($data['rightcategory']->num_rows() > 0){
			foreach($data['rightcategory']->result() as $catr1){
				$catid1[] = $catr1->cid;
			}
		}
		else{
			$catid1[] ='';
		}
		//print_r($catid1);
		$arraymarge = array_merge($catid,$catid1);
		//print_r($arraymarge);
		$data['allcategory']	= $this->Index_model->getNotIdData('category','status','0','cid',$arraymarge,'cid','desc',12);
        $category_title = '"love-gift","wedding-gift","wooden-craft"';
        $data['get_category_by_title'] = $this->Index_model->getCategoryByTitle($category_title);
		
		$data['leftoffer']	= $this->Index_model->getDataById('offer','position','left','b_id','asc',2);
		$data['rightoffer']	= $this->Index_model->getDataById('offer','position','right','b_id','asc',2);
		$data['bottomleftoffer']	= $this->Index_model->getDataById('offer','position','bottom1','b_id','asc',1)->row_array();
		$data['bottomrightoffer']	= $this->Index_model->getDataById('offer','position','bottom2','b_id','asc',1)->row_array();
		
		$data['topproduct']	= $this->Index_model->getDataById('product','status','1','product_id','desc',12);
		$data['newproduct']	= $this->Index_model->getDataByNotBonus(50,0);
	 
		$data['bonusproduct']	= $this->Index_model->getDataByNotBonus(6,1);
		 
		$data['featuredwproduct']	= $this->Index_model->getDataById('product','status','1','pro_code','desc',12);

        $data['top_sale'] = $this->Index_model->topSale();
        $data['top_sale_id'] = $data['top_sale']->result_array();
        $top_sale_ids = array();
        $z = 0;
        foreach($data['top_sale_id'] as $id) {
            $top_sale_ids[$z] = $id['product_id'];
            $z++;
        }
        $top_sale_ids_str = implode(',', $top_sale_ids);
        $data['top_sale_product'] = $this->Index_model->getProductByids($top_sale_ids_str);
        
		
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['slider']				= $this->Index_model->get_newSrrival();
		$data['main_content']="frontend/index";
        $this->load->view('template', $data);
	}
	
	function video()
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
        $this->load->view('frontend/video');
	}
	
	function search_data()
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
		
		$keyword=$this->input->post('keyword');
		/*$category=$this->input->post('pro_category');
		$boutiqueshop=$this->input->post('boutiqueshop');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		if($keyword!=""){
				$save=array(
					'keywords'=>$keyword,
					'date'=>date('Y-m-d')
				);
				$query = $this->Index_model->inertTable('search_keywords', $save);
		}*/

		
		$data['slug'] =ucfirst($keyword);
		$data['title'] = $keyword." | bargainnshop.com";
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		//$data['productgallery']	= $this->Index_model->searchdata($keyword,$category,$boutiqueshop);
		$data['productgallery']	= $this->Index_model->searchdata($keyword,'','');
		$data['main_content']="frontend/product_search";
        $this->load->view('template', $data);
	}
	
  function subscription()
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
		
		 $this->form_validation->set_rules("subcribe", "Email Address", "trim|required|is_unique[subscriptions.email]");
          if ($this->form_validation->run() == FALSE)
          {
		 	 $this->session->set_flashdata('globalMsg', '<div class="alert alert-danger" style=" background:#fff; color:green">Subscription Failed</div>');
			  redirect($_SERVER['HTTP_REFERER']);	
		 }
		else{
			$email = $this->input->post('subcribe');
			$promotion = array(
					  'email'		 => $email,
					  'created_at'	 => date('Y-m-d')
				  );
			$query = $this->Index_model->inertTable('subscriptions',$promotion);
			if($query){
			$this->session->set_flashdata('globalMsg', '<div class="alert alert-success" style=" background:#fff; color:green">Successfully Subscription</div>');
			$tomaila=$email.', wasim.html@gmail.com';
			$frommaila="info@bargainnshop.com";
			$subjecta="Thank You for Subscription";
			$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
			$this->email->initialize($config);
			$this->email->set_newline('\r\n');
			$email_bodya ="
			<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
			border:2px solid #FC0; border-radius:13px; padding-left:20px;'>
			<tr style='background-color:#fff'>
			<th width='26%' height='79' align='center'> 
			<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
			<th colspan='2' align='left'></th>
			</tr>
			<tr>
			<th height='25' colspan='3' align='left' 
				style='font-size:22px; color:#333; text-decoration:none;'>&nbsp;</th>
			</tr>
			<tr>
			<td height='137' colspan='3' align='right' valign='top'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
			<tr>
			  <td width='100%' height='44'  align='center'><h2>Thank you for Subscription</h2></td>
			  </tr>
			<tr>
			  <td>You will get all latest collections & offers from bargainnshop.com</td>
			  </tr>
			</table></td>
			</tr>
			</table>";
		
			$this->email->from($frommaila, 'bargainnshop.com');
			$this->email->to($tomaila);
			$this->email->subject($subjecta);
			$this->email->message($email_bodya);
			$this->email->send();
			redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	
	
	function wishlistProduct($productId)
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
		
		if(!$this->session->userdata('userAccessId')){
			redirect('index', '');
		}
		else{
			$customerId=$this->session->userdata('userAccessId');
			$wishlistquery = $this->Index_model->getAllItemTable('customer_wishlist','customer_id',$customerId,'product_id',$productId,'wid','desc');
			if($wishlistquery->num_rows() == 0){
				$save=array('customer_id'=>$customerId, 'product_id'=>$productId,'date'=>date('Y-m-d'));
				$this->Index_model->wishlistProductSave($save);
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function removeWishlistProduct()
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
		
		$wid=$this->input->get('wid');
		$this->Index_model->deletetable_row('customer_wishlist', 'wid',$wid);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}

?>

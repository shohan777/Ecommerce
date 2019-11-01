<?php defined('BASEPATH') OR exit('No direct script access allowed');
				
class Reports extends CI_Controller { 
	public $cname;
	private $cmob;
	private $cem;
	private $cadd;
	private $clogo;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->model('Reports_model');
		$this->load->library('pagination');
		$this->load->helper('download');
		$this->load->library('form_validation');
		$this->load->helper('url');
        $this->load->library('email');
		$this->load->library('excel');//load PHPExcel library 
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
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
		$data['main_content']="admin/reports/default";
		$this->load->view('admin_template',$data);
	} 
	
	///////////////////// Student Reports //////////////////////////////
	function product()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
		//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['sisterconcern'] = $this->Index_model->getAllItemTable('category','','','','','cid','asc');
		$data['title']="Student Filtering | MMRK Group";
		$data['main_content']="admin/reports/product/filtering";
		$this->load->view('admin_template',$data);
	} 
	
	function product_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
				$data['title']="Product Filtering | MMRK Group";
				//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				
				if($this->input->post('all_product') && $this->input->post('all_product')!=""){
					$data['product_list'] = $this->Index_model->getAllItemTable('product','','','','','product_id','asc');
				}
				elseif($this->input->post('search_product') && $this->input->post('search_product')!=""){
					$cat_id = $this->input->post('cat_id');
					
				$sessiondata = array('cat_id'=> $cat_id);
				$this->session->set_userdata($sessiondata);
				$cat_id=$this->session->userdata('cat_id');
				
				$data['product_list'] = $this->Reports_model->productFiltering($cat_id);
			}
			else{
				$cat_id=$this->session->userdata('cat_id');
				
				$data['product_list'] = $this->Reports_model->productFiltering($cat_id);
			}
			
			$printseg = $this->uri->segment(3);
			if(isset($printseg) && $printseg=='print'){
				$this->load->view('admin/reports/product/print',$data);
			}
			elseif(isset($printseg) && $printseg=='downloads'){
				$stdresult = $data['product_list']->result();
				$this->downloads('product',$stdresult);
			}
			else{			
				$data['main_content']="admin/reports/product/action";
				$this->load->view('admin_template',$data);
			}
		}



	function orders()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
		//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['sisterconcern'] = $this->Index_model->getAllItemTable('category','','','','','cid','asc');
		$data['title']="Student Filtering | MMRK Group";
		$data['main_content']="admin/reports/orders/filtering";
		$this->load->view('admin_template',$data);
	} 
	
	function orders_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
		//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		
		if($this->input->post('all_orders') && $this->input->post('all_orders')!=""){
			$data['orders_list'] = $this->Index_model->getAllItemTable('orders','','','','','orders_id','asc');
		}
		elseif($this->input->post('search_orders') && $this->input->post('search_orders')!=""){
			$cat_id = $this->input->post('cat_id');
			
		$sessiondata = array('cat_id'=> $cat_id);
		$this->session->set_userdata($sessiondata);
		$cat_id=$this->session->userdata('cat_id');
		
		$data['orders_list'] = $this->Reports_model->ordersFiltering($cat_id);
	}
	else{
		$cat_id=$this->session->userdata('cat_id');
		
		$data['orders_list'] = $this->Reports_model->ordersFiltering($cat_id);
	}
	
	$printseg = $this->uri->segment(3);
	if(isset($printseg) && $printseg=='print'){
		$this->load->view('admin/reports/orders/print',$data);
	}
	elseif(isset($printseg) && $printseg=='downloads'){
		$stdresult = $data['orders_list']->result();
		$this->downloads('orders',$stdresult);
	}
	else{			
		$data['main_content']="admin/reports/orders/action";
		$this->load->view('admin_template',$data);
	}
}
		
		
		
		///////////////////// Student Reports //////////////////////////////
	function customer()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
		//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['sisterconcern'] = $this->Index_model->getAllItemTable('category','','','','','cid','asc');
		$data['title']="Student Filtering | MMRK Group";
		$data['main_content']="admin/reports/customer/filtering";
		$this->load->view('admin_template',$data);
	} 
	
	function customer_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
				$data['title']="Product Filtering | MMRK Group";
				//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				
				if($this->input->post('all_customer') && $this->input->post('all_customer')!=""){
					$data['customer_list'] = $this->Index_model->getAllItemTable('customer','','','','','user_id','asc');
				}
				elseif($this->input->post('search_customer') && $this->input->post('search_customer')!=""){
					$username = $this->input->post('username');
					$email = $this->input->post('email');
					$mobile = $this->input->post('mobile');
					
				$sessiondata = array('username'=> $username,'email'=> $email,'mobile'=> $mobile);
				$this->session->set_userdata($sessiondata);
				$username=$this->session->userdata('username');
				$email=$this->session->userdata('email');
				$mobile=$this->session->userdata('mobile');
				
				$data['customer_list'] = $this->Reports_model->customerFiltering($username,$email,$mobile);
			}
			else{
				$username=$this->session->userdata('username');
				$email=$this->session->userdata('email');
				$mobile=$this->session->userdata('mobile');
				
				$data['customer_list'] = $this->Reports_model->customerFiltering($username,$email,$mobile);
			}
			
			$printseg = $this->uri->segment(3);
			if(isset($printseg) && $printseg=='print'){
				$this->load->view('admin/reports/customer/print',$data);
			}
			elseif(isset($printseg) && $printseg=='downloads'){
				$stdresult = $data['customer_list']->result();
				$this->downloads('customer',$stdresult);
			}
			else{			
				$data['main_content']="admin/reports/customer/action";
				$this->load->view('admin_template',$data);
			}
		}
	
	///////////////////// Transaction Reports //////////////////////////////
	function transaction()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
			//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			$data['main_content']="admin/reports/transaction/filtering";
			$this->load->view('admin_template',$data);
		}
	
	function transaction_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			$data['title']="Product Filtering | MMRK Group";
				
				//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				$today = date('Y-m-d');
				if($this->input->post('alltran') && $this->input->post('alltran')!=""){
					$data['wherecluse'] = "";
					$data['whereclusefee'] = "";
				}
				elseif($this->input->post('todaytran') && $this->input->post('todaytran')!=""){
					$data['wherecluse'] = "where received_date='".$today."'";
					$data['whereclusefee'] = "where submit_date='".$today."'";
				}
				elseif($this->input->post('search_tran') && $this->input->post('search_tran')!=""){
					$from_date = $this->input->post('from_date');
					$to_date = $this->input->post('to_date');
					
					$sessiondata = array(
							'from_date'=> $from_date,
							'to_date'=> $to_date,
						   );
				$this->session->set_userdata($sessiondata);
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['wherecluse'] = "where received_date between '".$from_date."' and '".$to_date."'";
				$data['whereclusefee'] = "where date between '".$from_date."' and '".$to_date."'";
			}
			else{
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['wherecluse'] = "where received_date between '".$from_date."' and '".$to_date."'";
				$data['whereclusefee'] = "where date between '".$from_date."' and '".$to_date."'";
			}
			
			$printseg = $this->uri->segment(3);
			if(isset($printseg) && $printseg=='print'){
				$this->load->view('admin/reports/transaction/print',$data);
			}			
			else{			
				$data['main_content']="admin/reports/transaction/action";
				$this->load->view('admin_template',$data);
			}
		}
	
	
	
	
	
	
	///////////////////// Transaction Reports //////////////////////////////
	function expanse()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
			//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			$data['main_content']="admin/reports/expanse/filtering";
			$this->load->view('admin_template',$data);
		}
	
	function expanse_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
				
				//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				$today = date('Y-m-d');
				if($this->input->post('alltran') && $this->input->post('alltran')!=""){
					$data['wherecluse'] = "";
					$data['whereclusefee'] = "";
				}
				elseif($this->input->post('todaytran') && $this->input->post('todaytran')!=""){
					$data['wherecluse'] = "where received_date='".$today."'";
					$data['whereclusefee'] = "where submit_date='".$today."'";
				}
				elseif($this->input->post('search_tran') && $this->input->post('search_tran')!=""){
					$from_date = $this->input->post('from_date');
					$to_date = $this->input->post('to_date');
					
					$sessiondata = array(
							'from_date'=> $from_date,
							'to_date'=> $to_date,
						   );
				$this->session->set_userdata($sessiondata);
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['wherecluse'] = "where received_date between '".$from_date."' and '".$to_date."'";
				$data['whereclusefee'] = "where submit_date between '".$from_date."' and '".$to_date."'";
			}
			else{
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['wherecluse'] = "where received_date between '".$from_date."' and '".$to_date."'";
				$data['whereclusefee'] = "where submit_date between '".$from_date."' and '".$to_date."'";
			}
			
			$printseg = $this->uri->segment(3);
			if(isset($printseg) && $printseg=='print'){
				$this->load->view('admin/reports/expanse/print',$data);
			}			
			else{			
				$data['main_content']="admin/reports/expanse/action";
				$this->load->view('admin_template',$data);
			}
		}
	
	
	///////////////////// Transaction Reports //////////////////////////////
	function collection()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			$data['title']="Product Filtering | MMRK Group";
			//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			$data['main_content']="admin/reports/collection/filtering";
			$this->load->view('admin_template',$data);
		}
	
	function collection_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
				
				//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				$today = date('Y-m-d');
				if($this->input->post('alltran') && $this->input->post('alltran')!=""){
					$data['wherecluse'] = "";
					$data['whereclusefee'] = "";
				}
				elseif($this->input->post('todaytran') && $this->input->post('todaytran')!=""){
					$data['wherecluse'] = "where received_date='".$today."'";
					$data['whereclusefee'] = "where submit_date='".$today."'";
				}
				elseif($this->input->post('search_tran') && $this->input->post('search_tran')!=""){
					$from_date = $this->input->post('from_date');
					$to_date = $this->input->post('to_date');
					
					$sessiondata = array(
							'from_date'=> $from_date,
							'to_date'=> $to_date,
						   );
				$this->session->set_userdata($sessiondata);
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['wherecluse'] = "where received_date between '".$from_date."' and '".$to_date."'";
				$data['whereclusefee'] = "where submit_date between '".$from_date."' and '".$to_date."'";
			}
			else{
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['wherecluse'] = "where received_date between '".$from_date."' and '".$to_date."'";
				$data['whereclusefee'] = "where submit_date between '".$from_date."' and '".$to_date."'";
			}
			
			$printseg = $this->uri->segment(3);
			if(isset($printseg) && $printseg=='print'){
				$this->load->view('admin/reports/collection/print',$data);
			}			
			else{			
				$data['main_content']="admin/reports/collection/action";
				$this->load->view('admin_template',$data);
			}
		}
	
	
	///////////////////// Transaction Reports //////////////////////////////
	function stock()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
			//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
			
			$data['main_content']="admin/reports/stock/filtering";
			$this->load->view('admin_template',$data);
		}
	
	function stock_reports()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product Filtering | MMRK Group";
				
				//if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
				$today = date('Y-m-d');
				if($this->input->post('currentstock') && $this->input->post('currentstock')!=""){
					$data['stocklist'] = $this->Index_model->getTable('product','product_id','desc');
				}
				/*elseif($this->input->post('stockin') && $this->input->post('stockin')!=""){
					$data['stocklist'] = $this->Reports_model->stockFiltering($from_date,$to_date,$inst_id);
				}
				elseif($this->input->post('stockout') && $this->input->post('stockout')!=""){
					$data['stocklist'] = $this->Reports_model->stockFiltering($from_date,$to_date,$inst_id);
				}*/
				elseif($this->input->post('search_stock') && $this->input->post('search_stock')!=""){
					$from_date = $this->input->post('from_date');
					$to_date = $this->input->post('to_date');
					
					$sessiondata = array(
							'from_date'=> $from_date,
							'to_date'=> $to_date,
						   );
				$this->session->set_userdata($sessiondata);
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');
				
				$data['stocklist'] = $this->Reports_model->stockFiltering($from_date,$to_date);
			}
			else{
				$from_date=$this->session->userdata('from_date');
				$to_date=$this->session->userdata('to_date');				
				$data['stocklist'] = $this->Reports_model->stockFiltering($from_date,$to_date);
			}
			
			$printseg = $this->uri->segment(3);
			if(isset($printseg) && $printseg=='print'){
				$this->load->view('admin/reports/stock/print',$data);
			}			
			else{			
				$data['main_content']="admin/reports/stock/action";
				$this->load->view('admin_template',$data);
			}
	}
	
	
	
	
	
	
//////////////////// Downloads//////////////////////////////	
	public function downloads($filename,$query){
      // get data from databse
	   $this->excel->setActiveSheetIndex(0);
        //$data = $this->Index_model->getAllItemTable('student','','','','','student_id','asc');
		//$stdresult = $data->result();
 		
        $this->excel->stream($filename.'.xls', $query);
     }
	
	
}
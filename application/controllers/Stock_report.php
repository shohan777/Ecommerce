<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Stock_report_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Requi_model');
		$this->check_isvalidated();
	}
	
	public function check_isvalidated()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("administration");
	}
	
	public function index()
	{
		$data['onload']='stock_report';
		$data['main_content']='stock_delivery_view';
		$data['count']=$this->Dashboard_model->messageCount();
		$data['requ']=$this->Requi_model->re_count();
		$this->load->view('template',$data);
	}
	
	public function report()
	{
		$from_date=$this->input->get('from_date');
		$to_date=$this->input->get('to_date');
		$item=$this->input->get('item');
		$type=$this->input->get('type');
		
		$data['item']=$item;
		$data['type']=$type;
		
		$data['data_stock']=$this->Stock_report_model->stock_data($from_date,$to_date,$item,$type);
		$data['stock_plus']=$this->Stock_report_model->stock_plus($from_date,$to_date,$item);
		$data['stock_minus']=$this->Stock_report_model->stock_minus($from_date,$to_date,$item);
		
		$data['main_content']='stock_report_view';
		
		
		$this->load->view('stock_report_view',$data,$from_date,$to_date);
		//$result=$this->Stock_model->stockReport();
		
		//echo $result;
	}
	
	public function outreport()
	{
		$from_date=$this->input->get('from_date1');
		$to_date=$this->input->get('to_date1');
		$branch=$this->input->get('branch');
		$masudrana=$this->input->get('masudrana');
		$itemid=$this->input->get('itemid');
		
		if($itemid==''){
			$data['branch']=$branch;
			$data['data_stock']=$this->Stock_report_model->stock_outdata($from_date,$to_date,$branch,$masudrana);
			
			$data['main_content']='stock_outreport_view';
			$this->load->view('stock_outreport_view',$data,$from_date,$to_date);
		}
		else
		{
			$data['branch']=$branch;
			$data['data_stock']=$this->Stock_report_model->stock_outitem($from_date,$to_date,$branch,$masudrana,$itemid);
			
			$data['main_content']='stockout_sales_item';
			$this->load->view('stockout_sales_item',$data,$from_date,$to_date);
		}

	}
	
	public function view_invoice()
	{
		$invid=$this->input->get('inv');
		$data['invoice']=$this->Stock_report_model->stock_invoice($invid);
		$data['invoiceDetails']=$this->Stock_report_model->stock_details($invid);
		
		$data['main_content']='branch_invoice_view';
		
		
		$this->load->view('branch_invoice_view',$data);
	}
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

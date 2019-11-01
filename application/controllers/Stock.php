<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Stock_model');
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
		$data['onload']='stock';
		$data['main_content']='stock_view';
		$search=$this->input->post('search');
		$data['business_data']=$this->Stock_model->get_data($search);
		//$data['stockqty']=$this->Stock_model->check_data();
		$data['count']=$this->Dashboard_model->messageCount();
		$data['requ']=$this->Requi_model->re_count();
		$data['check_data']=$this->Stock_model->check_data();
		
		$this->load->view('template',$data);
	}
	
	public function stock_view()
	{
		$id=$this->input->get('id');
		$data['stock_pro']=$this->Stock_model->stock_pro($id);
		
		$this->load->view('stock_add',$data);
	}
	
	public function stock_minis()
	{
		$id=$this->input->get('id');
		$data['stock_pro']=$this->Stock_model->stock_pro($id);
		
		$data['stock']=$this->Stock_model->stock_pro_stock($id);
		
		$this->load->view('stock_minis',$data);
	}
	
	public function checkStock()
	{
		$product_id=$this->input->get('product_id');
		$qty=$this->input->get('stock_qty');
		$data=$this->Stock_model->stock_check($product_id,$qty);
		
		echo $data;
		//$this->load->view('stock_minis',$data);
	}
	
	public function stock_add()
	{
		$product_id=$this->input->post('product_id');
		$as_procatid=$this->input->post('procatid');
		$as_qty=$this->input->post('stock_qty');
		$as_challan=$this->input->post('challan');
		
		list($month,$day,$year)=explode('/',$this->input->post('sdate'));
		$stockdate=$year.'-'.$month.'-'.$day;
		
		$as_date=$stockdate;
		$as_vd=date('d F Y');
		
		$this->Stock_model->stock_insert($product_id,$as_procatid,$as_qty,$as_challan,$as_date,$as_vd);
		
		redirect('stock');
	}
	
	
	public function stock_minus()
	{
		$product_id=$this->input->post('product_id');
		$as_procatid=$this->input->post('procatid');
		$as_qty=$this->input->post('stock_qty');
		$as_challan=$this->input->post('challan');
		list($month,$day,$year)=explode('/',$this->input->post('sdate'));
		$stockdate=$year.'-'.$month.'-'.$day;
		
		$as_date=$stockdate;
		$as_vd=date('d F Y');
		
		$this->Stock_model->stock_update($product_id,$as_procatid,$as_qty,$as_challan,$as_date,$as_vd);
		
		redirect('stock');
	}
	
	
	public function out()
	{
		$data['onload']='stock_out';
		$data['main_content']='stock_out_view';
		$data['count']=$this->Dashboard_model->messageCount();
		$data['check_data']=$this->Stock_model->check_data();
		$data['check_hub']=$this->Stock_model->check_hub();
		$data['inv_no']=$this->Stock_model->invoice();
		
		$this->load->view('template',$data);
	}
	
	public function view()
	{
		$data['business_data']=$this->Stock_model->view_data();
		$this->load->view('stock_current_view',$data);
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

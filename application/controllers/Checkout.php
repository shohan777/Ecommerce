<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

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
	private $bkash;
	private $rocket;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Checkout_model');
		$this->load->model('Index_model');
		$this->load->helper('common_helper');
		$this->load->library('email');
		
		$userTable = company_information();
		if($userTable->num_rows() >0 ){
			foreach($userTable->result() as $user);
			$this->cname=$user->company_name;
			$this->cmob=$user->fcontact;
			$this->bkash=$user->bkash;
			$this->rocket=$user->rocket;
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
			$this->bkash='';
			$this->rocket='';
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
		if(!$this->cart->contents()){
			redirect('index');
		}
	}
	
	
	function index()
	{
		//if($this->session->userdata('userAccessMail')) redirect('checkout/ordersubmitted');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['bkash'] = $this->bkash;
		$data['rocket'] = $this->rocket;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$useraccessid = $this->session->userdata('userAccessId');
		$userAccessType = $this->session->userdata('userAccessType');
		$data['billinginfo']= $this->Index_model->getDataById('billing_info','userid',$useraccessid,'id','desc','');
		$data['shippingmethod']= $this->Index_model->getDataById('shipping_charge','','','id','asc','');
		$data['districts']= $this->Index_model->getDataById('districts','','','id','asc','')->result();
		
		$data['title'] = "Checkout : Bargainnshop";
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['main_content']="frontend/checkout";
		$this->load->view('template', $data);
	}
	
	
	
	function guest_mode()
	{
		//if($this->session->userdata('userAccessMail')) redirect('checkout/ordersubmitted');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['bkash'] = $this->bkash;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = "Checkout : Bargainnshop";
		$data['footermenu']	= $this->Index_model->getAllMenu();

		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[customer.email]');
		$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[customer.mobile]');
		
		if($this->form_validation->run() != false){
			$save['username']		= $this->input->post('fname').' '.$this->input->post('lname');
			$save['fname']	    	= $this->input->post('fname');
			$save['lname']	    	= $this->input->post('lname');
			$save['mobile']	    	= $this->input->post('mobile');
			$save['address']	    = $this->input->post('address');
			$save['email']	    	= $this->input->post('email');
			$save['cust_type']		= 'Guest';
			$save['active']	    	= 0;
			$save['created_date']	= date('Y-m-d H:i:s');
			$query = $this->Index_model->inertTable('customer', $save);
			
			$sessiondata = array(
						  'userAccessMail'=>$this->input->post('email'),
						  'userAccessType'=>'guest',
						  'userAccessName'=> $this->input->post('fname').' '.$this->input->post('lname'),
						  'userAccessId' => $query
						 );
			$this->session->set_userdata($sessiondata);
			if($query){
				echo "Registered as guest";
			}
			else{
				echo "Failed to Registration";
			}
		}
		else{
			echo form_error('fname', '<p style="color:#ff0000;margin:0;">', '</p>');
			echo form_error('lname', '<p style="color:#ff0000;margin:0;">', '</p>');
			echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>');
			echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>');
			echo form_error('address', '<p style="color:#ff0000;margin:0;">', '</p>');
		}
		
		
					
	}
	
	
	
	
    function new_user()
	{
		//if($this->session->userdata('userAccessMail')) redirect('checkout/ordersubmitted');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['bkash'] = $this->bkash;
		$data['rocket'] = $this->rocket;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = "Checkout : Bargainnshop";
		$data['totalcountry']= $this->Index_model->getDataById('countryall','parent_id',0,'location_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		//$active = array('status'=>'active');
		$customer['username']		= $this->input->post('fname');
		$customer['fname']			= $this->input->post('fname');
		$customer['email']	    	= $this->input->post('email');
		$customer['mobile']	    	= $this->input->post('mobile');
		$customer['address']	    = $this->input->post('address');
		$customer['country']	    = $this->input->post('country');
		$customer['city']	    	= $this->input->post('city');
		$customer['password']	    = sha1($this->input->post('password'));					
		$customer['passwordHints']	= $this->input->post('password');
		$customer['cust_type']	= 'Customer';
		$customer['active']	    = 1;
		$customer['created_date']	= date('Y-m-d H:i:s');
		$query = $this->Index_model->inertTable('customer', $customer);		
		
		  $sessiondata = array(
			  'userAccessMail'=>$this->input->post('email'),
			  'userAccessType'=>'customer',
			  'userAccessName'=> $this->input->post('fname').' '.$this->input->post('lname'),
			  'userAccessId' => $query
			 );
	 	$this->session->set_userdata($sessiondata);
		  
		  
		if($query){
			//Load email library
			$this->load->library('email');

			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'bargainnshop@gmail.com',
				'smtp_pass' => 'Techdhaka17',
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
			);
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

			//Email content
			$htmlContent = '<h1>Thank you '. $customer['fname'] .'</h1>';

			$this->email->to($this->input->post('email'));
			$this->email->from('shohan.3w@gmail.com','Bargainnshop');
			$this->email->subject('Bargainnshop Registration Successfully');
			$this->email->message($htmlContent);

			//Send email
			$this->email->send();
			
			echo "Registered as Bargainnshop Honorable Customer";
		}
		else{
			echo "Failed to Registration";
		}
	}
	
	 function login()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['bkash'] = $this->bkash;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = "Checkout Login : Bargainnshop";
			if($this->input->post('userlogin')){
			  $usertype = 'customer';
			  $username = $this->input->post("email");
			  $password = $this->input->post('password');
			 
			  $usr_result = $this->Index_model->get_userLogin($username, $password);
			  $usr_result = $usr_result->row_array();
              
			  if ($usr_result && !empty($usr_result)) //active user record is present
			  {
				$sessiondata = array(
				  'userAccessMail'=>$username,
				  'userAccessType'=>$usertype,
				  'userAccessName'=> $usr_result['username'],
				  'userAccessId' => $usr_result['user_id'],
				  'password' => TRUE
				 );
			  $this->session->set_userdata($sessiondata);
			  redirect("checkout");
			 }
			 else
			  {
				$this->session->set_flashdata('invalidmsg', 
				'<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px; color:red">Invalid Email and password!</div>');
				  redirect('checkout');
			  }
		}	
	}
	
	 function ordersubmitted()
	 {
		if(!$this->session->userdata('userAccessMail')) redirect('checkout');
		// echo $this->input->post('bonus_id');
		// die;
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['bkash'] = $this->bkash;
		$data['clogo'] = $this->clogo;		
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		
        
		$data['title'] = "Order Checkout : Bargainnshop";
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$customername=$this->session->userdata('userAccessName');	
		$custId=$this->session->userdata('userAccessId');
		
			if($this->input->post('confirmorder')){				
				if($this->input->post('same_billing')=='1'){
					$exstcustid = $this->session->userdata('userAccessId');
					$cinfo = $this->Index_model->getOneItemTable('customer','user_id',$exstcustid,'user_id','desc');			
					
					$bill['userid']		= $custId;
					$bill['fname']		= $cinfo['fname'];
					$bill['lname']		= $cinfo['lname'];
					$bill['address1']	= $cinfo['address'];
					$bill['address2']   = $cinfo['address'];
					$bill['street']	    = $cinfo['thana'];
					$bill['country']	= $cinfo['country'];
					$bill['city']	    = $cinfo['city'];
					$bill['postcode']	= $cinfo['zipcode'];
					$bill['mobile']	    = $cinfo['mobile'];
					$bill['company']	= $cinfo['company'];
					$bill['active']	    = 1;			
					$bill['created_date']	    = date('Y-m-d H:i:s');

				// print "<pre>";
				// print_r($data);
					$existingship = $this->Index_model->getAllItemTable('shiping_info','','','userid',$exstcustid,'id','desc');
					if($existingship->num_rows() > 0){
						$shiparray = $existingship->row_array();
						$shipping_id = $shiparray['id'];
						$billinginfo = $this->Index_model->updateTable('shiping_info','id',$shipping_id,$bill);
					}
					else{
						$billinginfo = $this->Index_model->inertTable('shiping_info', $bill);
						$shipping_id = $billinginfo;
					}					
				}
				else{					
					$ship['userid']		= $custId;
					$ship['fname']		= $this->input->post('sfname');
					$ship['lname']		= $this->input->post('slname');
					$ship['address1']	= $this->input->post('saddress1');
					$ship['address2']   = $this->input->post('saddress2');
					$ship['street']	    = $this->input->post('sstreet');
					$ship['country']	= $this->input->post('scountry');
					$ship['city']	    = $this->input->post('scity');
					$ship['postcode']	= $this->input->post('spostcode');
					$ship['mobile']	    = $this->input->post('smobile');
					$ship['company']	= $this->input->post('scompany');
					$ship['active']	    = 1;			
					$ship['created_date']	    = date('Y-m-d H:i:s');
					$shipinginfo = $this->Index_model->inertTable('shiping_info', $ship);					
					$shipping_id = $shipinginfo;		
				}	
					
					$order['customer_id']		= $this->session->userdata('userAccessId');
					$order['order_number']		= $this->input->post('order_number');
					$order['paid_amount']		= 0;
					$order['due_amount']		= $this->input->post('total_price');
					$order['payment_status']	= "Not Paid";
					$order['total_price']		= $this->input->post('total_price');
					$order['shipping']		= $this->input->post('shipVal');
					$order['product_discount']		= $this->input->post('totaldiscount');
					$order['cupon_discount']		= $this->input->post('cuponprice');
					$order['amount']		= $this->input->post('withoutSip');
					$order['status']	= "Pending";
					$order['order_time']	= date('Y-m-d H:i:s');
					$order['date']	= date('Y-m-d');
                    
					$orderId = $this->Index_model->inertTable('orders', $order);
					
					$payinfo['customer_id']	    = $custId;
					$payinfo['shipping_id']	    = $shipping_id;
					$payinfo['transition_id']	= ($this->input->post('bkash_trnasitionId') != '') ? $this->input->post('bkash_trnasitionId') : $this->input->post('rocket_trnasitionId');
					$payinfo['comment']	    	= $this->input->post('comment');
					$payinfo['pay_method']	    = $this->input->post('paymentMethod');
					$payinfo['order_id']	    = $orderId;
					$payId = $this->Index_model->inertTable('payment_info', $payinfo);
					
					$data['order_q']= $this->Index_model->getDataById('orders','order_id',$orderId,'order_id','desc','1');
					$data['payment']= $this->Index_model->getDataById('payment_info','order_id',$orderId,'pay_id','desc','1');
					$data['customerQ']= $this->Index_model->getDataById('customer','user_id',$custId,'user_id','desc','1');
					$insertTranstion=array(
							'cust_id'=>$custId,
							'ship_id'=>$shipping_id,
							'pay_id'=>$payId,
							'order_num'=>$this->input->post('order_number'),
							'order_id'=>$orderId,
							'create_date'=>date('Y-m-d h:i:s'),
							'date'=>date('Y-m-d')
							);
					$invoiceid = $this->Index_model->inertTable('invoice', $insertTranstion);
					$data['inv_id'] = $invoiceid;
					$productId = $this->input->post('productId');
					$array=explode(',', $productId);
					$count = count($array);
					$check_id = $this->session->userdata('userAccessId');						
					$totalprice=$this->input->post('total_price');
					$shipVal=$this->input->post('shipVal');
					$withoutSip=$this->input->post('withoutSip');
					
					for($i=0; $i<=$count; $i++){
						$product_id[] = $this->input->post('product_id'.$i);
						$pcolor[]=$this->input->post('procolor'.$i);
				        $bonus_id[]=$this->input->post('bonus_id'.$i);	
						$psize[]=$this->input->post('prosize'.$i);
						$qty[] = $this->input->post('qty'.$i);
						$unit_price[] = $this->input->post('unit_price'.$i);
						$total_price[] = $this->input->post('sub_total'.$i);
						$custom_order_text[] = ($this->input->post('custom_order_text'.$i)) ? $this->input->post('custom_order_text'.$i) : null;
						$custom_order_images[] = ($this->input->post('custom_order_images'.$i)) ? $this->input->post('custom_order_images'.$i) : null;
						$date = date('Y-m-d');
					}
					
					
                    if($product_id!='' && $product_id!=0){
                        $this->Checkout_model->save($orderId,$productId,$pcolor,$psize,$check_id,$product_id,$qty,$unit_price,$total_price,$custom_order_text,$custom_order_images,$date, $bonus_id);
                    }
					//********************************
					$emailmsg = $this->load->view('frontend/invoice_print', $data, true); 
					$tomail=$this->session->userdata('userAccessMail');
					$frommail= "bargainnshop@gmail.com";
					$list = array($tomail,$this->cem);
					$subject="New Order Request Submitted from ".$customername;
					//Load email library
					$this->load->library('email');

					//SMTP & mail configuration
					$config = array(
						'protocol'  => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'bargainnshop@gmail.com',
						'smtp_pass' => 'Techdhaka17',
						'mailtype'  => 'html',
						'charset'   => 'utf-8'
					);
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");

					//Email content
					$htmlContent = '<h1>Sending email via SMTP server</h1>';
					$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

					$this->email->to($tomail);
					$this->email->from($frommail);
					$this->email->subject($subject);
					$this->email->message($emailmsg);

					//Send email
					$this->email->send();
					//********************************** END
                    
					
					redirect('checkout/payment_confirm', 'refresh');
				}
				else{
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
	}
	
	function payment_confirm()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;	
		$data['bkash'] = $this->bkash;	
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$data['title'] = "Payment Confirm : Bargainnshop";
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['main_content']="frontend/payment_confirm";
     	$this->load->view('template', $data);
	}
	
	
	function checkcupon()
	{
		//if($this->session->userdata('userAccessMail')) redirect('checkout/ordersubmitted');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;	
		$data['bkash'] = $this->bkash;	
		$data['webtitle'] = $this->webtitle;
		$data['fbook'] = $this->fbook;
		$data['twtr'] = $this->twtr;
		$data['linked'] = $this->linked;
		$data['gplus'] = $this->gplus;
		$data['instgrm'] = $this->instgrm;
		$data['yout'] = $this->yout;
		
		$useraccessid = $this->session->userdata('userAccessId');
		$cupon = $this->input->post('cupon');
		$totalprice = $this->input->post('tprice');

		$cuopnChecked = $this->Index_model->getAllItemTable('cupon_user','user_id',$useraccessid,'status',1,'id','desc');
		if($cuopnChecked->num_rows() > 0){
			$ccrow = $cuopnChecked->row_array();
			$cid = $ccrow['cid'];
			$checkCode = $this->Index_model->getAllItemTable('cupon','id',$cid,'code',$cupon,'id','desc');
			if($checkCode->num_rows() > 0){
				$cuponrow = $checkCode->row_array();
				$cuponPrice = $cuponrow['price'];
				$grandtotal = $totalprice - $cuponPrice;
				$msg = '<div style="text-align:center;color:#009900; margin-top:5px; float:left">You got '.$cuponPrice.' Tk Discount</div>';
			}
			else{
				$msg = '<div style="text-align:center;color:#ff0000; margin-top:5px; float:left">Invalid Cupon Code</div>';
				$grandtotal = $totalprice;
				$cuponPrice = 0;
			}
		}
		else{
			$msg = '<div style="text-align:center;color:#FF9900; margin-top:5px; float:left">You have no any cupon.</div>';
			$grandtotal = $totalprice;
			$cuponPrice = 0;
		}
		$gtotl =  number_format($grandtotal,2); 
		$arrayjosn = array("msg"=>$msg,"grandtotal"=>$gtotl,"cuponprice"=>$cuponPrice);
		echo json_encode($arrayjosn);
	}

    function test_mail() {
         
		//Load email library
	$this->load->library('email');

	//SMTP & mail configuration
	$config = array(
		'protocol'  => 'smtp',
		'smtp_host' => 'ssl://smtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => 'bargainnshop@gmail.com',
		'smtp_pass' => 'Techdhaka17',
		'mailtype'  => 'html',
		'charset'   => 'utf-8'
	);
	$this->email->initialize($config);
	$this->email->set_mailtype("html");
	$this->email->set_newline("\r\n");

	//Email content
	$htmlContent = '<h1>Sending email via SMTP server</h1>';
	$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

	$this->email->to('haidarcse2017@gmail.com');
	$this->email->from('shohan.3w@gmail.com','MyWebsite');
	$this->email->subject('How to send email via SMTP server in CodeIgniter');
	$this->email->message($htmlContent);

	//Send email
	$this->email->send();
    }
	
}

?>

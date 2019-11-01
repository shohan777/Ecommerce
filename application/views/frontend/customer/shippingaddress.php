<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
	
	function getCity(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
function newuserFunc(){
	///////////////Guest Mode Reg ////////////////
$(document).ready(function(){ 
var firstname = $("#firstname").val();
var lastname = $("#lastname").val();
var mobile = $("#mobile").val();
var email = $("#email").val();
var address1 = $("#address1").val();
var address2 = $("#address2").val();
var fax = $("#fax").val();
var country = $("#country").val();
var city = $("#city").val();
var street = $("#street").val();
var postcode = $("#postcode").val();
var password = $("#password").val();	
var company = $("#company").val();
//alert(lastname);
	$.ajax({
	  type:'POST',
	  url: "<?php echo base_url('checkout/new_user');?>",
	  data: {
	  		fname:firstname,
	  		lname:lastname,
			mobile:mobile,
			email:email,
			address1:address1,
			address2:address2,
			fax:fax,
			country:country,
			company:company,
			city:city,
			street:street,
			postcode:postcode,
			password:password
			},
		  success: function(data) {
			//alert('Success');
			$("#userStatus").html(data);
			window.location.reload();
		  },
		  error: function() {
			 alert('Error');
		  }
	});	
});
}		
</script>
<style>
	.form-group{
		margin-bottom:0px;
		float:left;
		width:100%;
	}
</style>
		<div class="row" style="width:100%; background:#FFF;  z-index:-1; position:relative; float:left">
			<div class="container" style="margin:20px auto;">
				<div class="col-sm-3">
					<?php include("leftSidebar.php");?>
				</div>
				<div class="col-sm-9">
                		<div class="row">
                        	<div class="col-sm-12">
                                <h2 id="userStatus" style="color:#009900; text-align:center;"></h2>
                                <h2 style="text-align:right">
                                	<button onclick="newuserFunc();" class="btn btn-primary" style="margin-top:20px; font-size:18px; padding:10px; border-radius:5px;">
                              <i class="fa fa-save"></i>&nbsp;&nbsp;Save Changes</button>
                                </h2>
                            </div>
                       </div>
                        <div class="panel panel-default">                            
                              <div class="panel-heading" id="optoin_bar">
                                <h4 class="panel-title">Personal Information</h4>
                              </div>
                              <div id="collapse-checkout-option"  role="heading">
                                <div class="panel-body">  
                                         <div class="col-sm-6">
                                            <fieldset id="account">
                                                <legend>Your Personal Details</legend>
                                                
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="firstname" placeholder="First Name"  name="firstname">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="lastname" placeholder="Last Name"  name="lastname">
                                                    </div>
                                                </div>    
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="company" placeholder="Company"  name="company">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="address1" placeholder="Address 1"  name="address_1">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="address2" placeholder="Address 2"  name="address_2">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="country" placeholder="Country" name="country">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="city" placeholder="City" name="city">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="street" placeholder="Street" name="street">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="postcode" placeholder="Post Code"  name="postcode">
                                                    </div>
                                                </div>                                
                                                <div class="form-group">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="fax" placeholder="Fax"  name="fax">
                                                    </div>
                                                </div>
                                            </fieldset>
                                         </div>                             
                                         <div class="col-sm-6">
                                            <fieldset>
                                                <legend>Login Details</legend>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="email" placeholder="E-Mail"  name="email">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="tel" class="form-control" id="mobile" placeholder="Phone"  name="mobile">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="password" placeholder="Password"  name="password">
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="confirmpassword" placeholder="Password Confirm"  name="confirmpassword">
                                                    </div>
                                                </div>
                                            </fieldset>                                            
                                         </div>   
                                </div>
                              </div>                          
                        </div>
                        <div class="panel panel-default">
                              <div class="panel-heading" id="optoin_bar">
                                <h4 class="panel-title">Delivery Details</h4>
                              </div>
                              <div id="collapse-shipping-address" role="heading">
                                <div class="panel-body">                                
                                    <div class="col-sm-8 col-sm-offset-2">
                                      <div class="form-group required">
                                        <label for="input-payment-firstname" class="col-sm-3 control-label">First Name</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="sfirstname" placeholder="First Name" value="" name="sfirstname">
                                        </div>
                                      </div>
                                      <div class="form-group required">
                                        <label for="input-payment-lastname" class="col-sm-3 control-label">Last Name</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="slastname" placeholder="Last Name" value="" name="slastname">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="input-payment-company" class="col-sm-3 control-label">Company</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="scompany" placeholder="Company" value="" name="scompany">
                                        </div>
                                      </div>
                                      <div class="form-group required">
                                        <label for="input-payment-address-1" class="col-sm-3 control-label">Address 1</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="saddress1" placeholder="Address 1" value="" name="saddress1">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="input-payment-address-2" class="col-sm-3 control-label">Address 2</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="saddress2" placeholder="Address 2" value="" name="saddress2">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group required">
                                        <label for="input-payment-country" class="col-sm-3 control-label">Country</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="scountry" id="scountry" class="form-control" value="Bangladesh" readonly="readonly"/>
                                        </div>
                                      </div>
                                      <div class="form-group required">
                                      <label for="input-payment-country" class="col-sm-3 control-label">Districts</label>
                                            <div class="col-sm-9">
                                                <select name="city" class="form-control" id="districts" onchange="shippingCharge(this.value)">
                                                    <?php foreach($districts as $dist):?>
                                                    <option value="<?php echo $dist->name;?>"><?php echo $dist->name;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                      <div class="form-group required">
                                        <label for="input-payment-zone" class="col-sm-3 control-label">Street</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="sstreet" id="sstreet" class="form-control"/>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="input-payment-postcode" class="col-sm-3 control-label">Post Code</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="spostcode" placeholder="Post Code" value="" name="spostcode">
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        <div class="buttons">
                            <div class="pull-right">
                              <button onclick="newuserFunc();" class="btn btn-primary" style="margin-top:20px; font-size:18px; padding:10px; border-radius:5px;">
                              <i class="fa fa-save"></i>&nbsp;&nbsp;Save Changes</button>
                            </div>
                          </div>
				</div>

			</div>
		</div>

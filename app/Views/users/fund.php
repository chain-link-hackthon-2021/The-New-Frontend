<?= $this->extend('layouts/index') ?>

<?= $this->section('contents') ?>

    <!-- BEGIN: Top Bar -->
        <div class="top-bar">
            <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                    <a class="breadcrumb--active">User Home</a>
                </div>
            <!-- END: Breadcrumb -->
            
            <!-- BEGIN: Notifications -->
                <div class="intro-x dropdown relative mr-auto sm:mr-6">
                    <div class="dropdown-toggle notification notification--bullet cursor-pointer">
                        <i data-feather="bell" class="notification__icon dark:text-gray-300"></i>
                    </div>
                    <div class="notification-content dropdown-box mt-8 absolute top-0 left-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
                        <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                            <div class="notification-content__title">Notifications</div>
                        </div>
                    </div>
                </div>
            <!-- END: Notifications -->

            <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8 relative">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img alt="profile-image" src="<?= $user->display_picture; ?>">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                            <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                                <div class="font-medium"></div>
                                <div class="text-xs text-theme-41 dark:text-gray-600">
                                    <a>What is this ?</a>
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url(route_to('profile')); ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                                </a>
                            </div>
                            <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                                <a href="<?= base_url(route_to('logout')); ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END: Account Menu -->
        </div>
    <!-- END: Top Bar -->

    <!-- content -->
        <!-- Content Wrapper. Contains page content -->
            <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Fund Wallet
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-12">
                        <!-- BEGIN: Input -->
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Fund your wallet <span style="color: #f00;">(All field mark asterisk (*) are compulsory)</span>
                                </h2>
                            </div>
                            <div class="p-5" id="input">
                                <form class="preview">
                                    <div>
                                        <label for="inputpayment">Payment Method</label>
                                        <select class="input w-full border mt-2" onchange="return Segment(this.value);">
                                            <option value="">Select</option>
                                            <option value="1">ATM Card</option>
                                            <option value="6">Manual Funding</option>
                                        </select>
                                    </div>
                                    <div id="card" style="display: none;" class="mt-5">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 xl:col-span-6 mt-3">
                                                <div>
                                                    <div class="flex flex-col sm:flex-row mt-5">
                                                        <div class="flex items-center text-gray-700 dark:text-gray-500 mr-2 mt-2">
                                                            <input type="radio" class="input border mr-2" id="paystack" name="gateway" value="1">
                                                            <label class="cursor-pointer select-none" for="paystack">Paystack</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-6">
                                                <div>
                                                    <label>Amount <span style="color: #f00;">*</span></label>
                                                    <input type="number" class="input w-full border mt-2" id="gateway_amount" placeholder="Enter Amount">
                                                </div>
                                            </div>
                                            <div class="flex justify-start mt-4">
                                                <button type="button" class="button bg-theme-1 text-white mt-5" id="pay">Proceed</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="manual" style="display: none;" class="mt-5">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 xl:col-span-12">
                                                <div class="col-span-12 xl:col-span-5">
                                                    <h2 class="text-lg font-medium text-theme-1 dark:text-theme-10 mt-2 mr-auto ">
                                                       MANUAL FUNDING
                                                    </h2>
                                                    <hr>
                                                    <br>
                                                    <label for="inputAmount">Enter amount you like to fund then Proceed <span style="color: #f00;">*</span></label>
                                                    <input type="number" class="input w-full border mt-2" id="transfer_amount" placeholder="Enter Amount">
                                                </div>
                                                <div class="col-span-12 xl:col-span-1"></div>
                                            </div>
                                            <div class="modal" id="modal-center-trans-1">
                                                <div class="modal__content">
                                                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                                        <h2 class="font-medium text-base mr-auto">
                                                            Bank Transfer
                                                        </h2>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <p class="mb-5">Kindly make a transfer or deposit to any of our available Banks</p>
                                                            <p class="well no-shadow" style="margin:-6px 0px 0px 0px; padding: 2px 2px; line-height: 22px;">
                                                                <strong> BANK: <span class="bankName">United Bank for Africa</span></strong><br>
                                                                <strong>ACCT NAME: <span class="accName">OLADEJO JESUJUWON ISAAC</span></strong><br>
                                                                <strong>ACCT NO: <span class="accNo">3158736683</span></strong><br>
                                                            </p>
                                                            <hr style="height: 12px; border-top: 1px solid black; width: 120px"><br>
                                                            <p class="well no-shadow" style="margin:-6px 0px 0px 0px; padding: 2px 2px; line-height: 22px;">
                                                                <strong> BANK: <span class="bankName">Wema Bank</span></strong><br>
                                                                <strong>ACCT NAME: <span class="accName">OLADEJO JESUJUWON ISAAC</span></strong><br>
                                                                <strong>ACCT NO: <span class="accNo">0251248765</span></strong><br>
                                                            </p>                                                                                 </div>
                                                    </div>
                                                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                                                        <a type="button" data-dismiss="modal" class="button border bg-theme-1 text-white" style="background-color: red;">Cancel</a>
                                                        <a type="button" class="button bg-theme-1 text-white" data-toggle="modal" data-target="#modal-center-trans-2" data-dismiss="modal" id="data_topup_button">I have made payment</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal" id="modal-center-trans-2">
                                                <div class="modal__content">
                                                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                                        <h2 class="font-medium text-base mr-auto">
                                                            Evidence of Payment
                                                        </h2>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <div>
                                                                <label for="inputAmount">Please select the account number you transferred to <span style="color: #f00;">*</span></label>
                                                                <select class="input w-full border mt-2" name="acct_transferred_to" id="acct_transferred_to">
                                                                    <option value="">-- select --</option>
                                                                    <option value="3158736683 (First Bank)">3158736683 (First Bank)</option>
                                                                    <option value="0251248765 (Wema Bank)">0251248765 (Wema Bank)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <div>
                                                                <label for="inputAmount">Please Enter the account number you transfer from <span style="color: #f00;">*</span></label>
                                                                <input type="number" class="input w-full border mt-2" onblur="return ResolveAccount();" maxlength="10" id="transfer_account_no" placeholder="Enter Account No">
                                                            </div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12">
                                                            <div>
                                                                <label for="inputNetwork">Please select the bank you transfer from <span style="color: #f00;">*</span></label>
                                                                <select class="input border w-full mt-2" onchange="return ResolveAccount();" id="transfer_bank">
                                                                    <option value="">Select</option>
                                                                    <option value="Access Bank">Access Bank</option>
                                                                    <option value="Citibank Nigeria">Citibank Nigeria</option>
                                                                    <option value="Access (Diamond) Bank">Access (Diamond) Bank</option>
                                                                    <option value="Ecobank Nigeria">Ecobank Nigeria</option>
                                                                    <option value="Fidelity Bank">Fidelity Bank</option>
                                                                    <option value="First Bank of Nigeria">First Bank of Nigeria</option>
                                                                    <option value="First City Monument Bank">First City Monument Bank</option>
                                                                    <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
                                                                    <option value="Heritage Bank">Heritage Bank</option>
                                                                    <option value="Keystone Bank">Keystone Bank</option>
                                                                    <option value="Polaris Bank">Polaris Bank</option>
                                                                    <option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
                                                                    <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                                                    <option value="Sterling Bank">Sterling Bank</option>
                                                                    <option value="Suntrust Bank">Suntrust Bank</option>
                                                                    <option value="Union Bank of Nigeria">Union Bank of Nigeria</option>
                                                                    <option value="United Bank For Africa">United Bank For Africa</option>
                                                                    <option value="Unity Bank">Unity Bank</option>
                                                                    <option value="Wema Bank">Wema Bank</option>
                                                                    <option value="Zenith Bank">Zenith Bank</option>
                                                                    <option value="Enterprise Bank">Enterprise Bank</option>
                                                                    <option value="MainStreet Bank">MainStreet Bank</option>
                                                                    <option value="ALAT by WEMA">ALAT by WEMA</option>
                                                                    <option value="ASO Savings and Loans">ASO Savings and Loans</option>
                                                                    <option value="CEMCS Microfinance Bank">CEMCS Microfinance Bank</option>
                                                                    <option value="Ekondo Microfinance Bank">Ekondo Microfinance Bank</option>
                                                                    <option value="Globus Bank">Globus Bank</option>
                                                                    <option value="Hasal Microfinance Bank">Hasal Microfinance Bank</option>
                                                                    <option value="Jaiz Bank">Jaiz Bank</option>
                                                                    <option value="Kuda Bank">Kuda Bank</option>
                                                                    <option value="Parallex Bank">Parallex Bank</option>
                                                                    <option value="Providus Bank">Providus Bank</option>
                                                                    <option value="Rubies MFB">Rubies MFB</option>
                                                                    <option value="Sparkle Microfinance Bank">Sparkle Microfinance Bank</option>
                                                                    <option value="TCF MFB">TCF MFB</option>
                                                                    <option value="TCF MFB">TCF MFB</option>
                                                                    <option value="Titan Bank">Titan Bank</option>
                                                                    <option value="VFD">VFD</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-span-12 xl:col-span-12"><p style="font-weight: bold;" id="account_name"></p></div>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <div>
                                                                <label for="inputNetwork">Please pick the date and time which the transfer was made <span style="color: #f00;">*</span></label>
                                                                <input type="datetime-local" class="input w-full border mt-2" value="" id="swap_airtime_date_time">
                                                            </div>
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-12">
                                                            <div>
                                                                <label for="inputNetwork">Please enter additional information like debit alert for quick approval </label>
                                                                <textarea class="input w-full border mt-2" rows="3" id="transfer_remark" placeholder="Enter your notes"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                                                            <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1" style="float: left;">Cancel</button>
                                                            <button type="button" onclick="return submitTransfer();" id="submit_transfer" class="button bg-theme-1 text-white">Submit</button>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-start">
                                                <button type="button" class="button bg-theme-1 text-white mt-5" id="tranfer_button">Proceed</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END: Input -->
                    </div>
                </div>
                <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src='https://js.paystack.co/v1/inline.js'></script>
                <script type="text/javascript" src="https://sandbox.sdk.monnify.com/plugin/monnify.js"></script>
                <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                <script type="text/javascript">
              	    // global variable
              		var atm_min_amount = 100;
            	  	var atm_max_amount = 20000;
            	  	var bank_min_amount = 500;
            	  	var bank_max_amount = 5000000;
              	  	var pay_method;
              	  	
              	    function Segment(value) {
                        pay_method = value;
                        if (value == 1) {
                            $('#card').show();
                            $('#manual').hide();
                        }
                        else if (value == 6) {
                            $('#manual').show();
                            $('#card').hide();
                        }
                    }
                  	
                  	var pay_value;
                	$(document).on('click', '#pay', function(e) {
                		if (document.getElementById('paystack') != null && document.getElementById('paystack').checked) {
                			pay_value = document.getElementById('paystack').value;
                		  	Paystack();
                		} else if (document.getElementById('ravepay') != null && document.getElementById('ravepay').checked) {
                		  pay_value = document.getElementById('ravepay').value;
                
                		  payWithRave();
                		} else {
                			ValidationMessage("Validate Message", "Please check one of the payment gateway.");
                		}
                	});
                	
                	function IDGenerator() {
                        var today = new Date();
                    	var uniqueId = "HUTID" + today.getFullYear() + eval(today.getMonth()) + 1 + today.getDate() + Math.floor(Date.now() / 1000);
                      	return uniqueId;
                  	}
                  	
                  	function ValidationMessage(title, message) {
                  		swal(title, message);
                  	}
            
                    function Paystack() {
                        var amt;
                        amt = $('#gateway_amount').val();
                        amt2 = $('#gateway_amount').val();
                        if(atm_min_amount != 0){
                            if(amt < atm_min_amount){
                                ValidationMessage("Invalid Amount!", `Amount can not be less than ${atm_min_amount}`);
                                $('#gateway_amount').focus();
                                return false;
                            }
                        }
                        if(atm_max_amount != 0){
                            if(amt > atm_max_amount){
                                ValidationMessage("Invalid Amount!", `Amount can not be greater than ${atm_max_amount}`);
                                $('#gateway_amount').focus();
                                return false;
                            }
                        }
                        var chargePercentage = (1.5/100)*amt;
                
                        if(chargePercentage > 2000){
                            chargePercentage = 2000;
                        }
                        amt = parseFloat(amt);
                        if(amt < 2499){
                            amt = chargePercentage + amt;
                        } else {
                            if(chargePercentage < 2000){
                
                                amt = (chargePercentage + 100) + amt;
                            } else {
                                amt = chargePercentage + amt;
                            }
                        }
                        var tok = $('#_token').val();
                        if(amt == "" || amt < 0 || isNaN(amt))
                        {
                            ValidationMessage("Validation Message!", "Please enter a valid amount.")
                            $('#gateway_amount').focus();
                            return false;
                        }
                        amt = Math.ceil(amt * 100);
                        var ref = IDGenerator();
                        username = "<?= session()->get('username'); ?>";
                        email = "<?= session()->get('email'); ?>";
                        var handler = PaystackPop.setup({
                        key: "pk_test_78caf97d3316a904066042f1dfe71afe67b595f4",
                        email: email,
                        amount: amt,
                        currency: 'NGN',
                        ref: ref,
                        callback: function(response){
                            $("#pay").html("Processing...").attr("disabled", "disabled");
                            var dataString = {'ref_no': response.reference, 'status' : 'success', 'amount' : amt2, 'username': username, '_token': tok, 'payment_method': pay_method, 'payment_gateway': pay_value};
                            $.ajax({
                                type: "POST",
                                url: 'paymentSuccess',
                                data: dataString,
                                datatype: 'json',
                                success: function (data) {
                                    data = JSON.parse(data);
                                    if(data.status == "SUCCESS")
                                    {
                                        $('#pay').html('Proceed').attr('disabled', false);
                                        ValidationMessage("Payment Success! /n Redirects in 5 seconds!", data.msg);
                                        setTimeout(function(){
                                            window.location.href = "/all_transactions";
                                        }, 5000);
                                    }
                                    else if(data.status == "FAILURE")
                                    {
                                        $('#pay').html('Proceed').attr('disabled', false);
                                        ValidationMessage("Payment Failure!", data.msg);
                                    }
                                }
                            });
                        },
                        onClose: function(){
                            alert('window closed');
                        }
                        });
                        handler.openIframe();
                    }
                
                    function payWithRave(){
                
                        var amt;
                        amt = $('#gateway_amount').val();
                        if(atm_min_amount != 0){
                            if(amt < atm_min_amount){
                                ValidationMessage("Invalid Amount!", `Amount can not be less than ${atm_min_amount}`);
                                $('#gateway_amount').focus();
                                return false;
                            }
                        }
                
                        if(atm_max_amount != 0){
                            if(amt > atm_max_amount){
                                ValidationMessage("Invalid Amount!", `Amount can not be greater than ${atm_max_amount}`);
                                $('#gateway_amount').focus();
                                return false;
                            }
                        }
                
                        var tok = $('#_token').val();
                        if(amt == "" || amt < 0 || isNaN(amt))
                        {
                            ValidationMessage("Validation Message!", "Please enter a valid amount.")
                            $('#gateway_amount').focus();
                            return false;
                        }
                        amt = Math.ceil(amt);
                        var ref = IDGenerator();
                        email = "<?= session()->get('email'); ?>";
                        var API_publicKey = "FLWPUBK-55c636e9cf4560587ee055abfabbfbc3-X";
                
                        var x = getpaidSetup({
                            PBFPubKey: API_publicKey,
                            customer_email: email,
                            amount: amt,
                            customer_phone: "234099940409",
                            currency: "NGN",
                            txref: ref,
                            onclose: function() {},
                            callback: function(response) {
                                var txRef = response.data.tx.txRef; // collect txRef returned and pass to a server page to complete status check.
                                // console.log("This is the response returned after a charge", response);
                                if (
                                    response.data.data.responsecode == "00" ||
                                    response.data.data.responsecode == "0"
                                ) {
                                    // redirect to a success page
                                    $("#pay").html("Processing payment...").attr("disabled", "disabled");
                                    var dataString = {'ref_no': txRef, 'email': email, '_token': tok, 'payment_method': pay_method, 'payment_gateway': pay_value};
                
                                    $.ajax({
                                        type: "POST",
                                        url: 'paymentSuccess',
                                        data: dataString,
                                        datatype: 'json',
                                        success: function (data) {
                                            data = JSON.parse(data);
                                            if(data.status == "SUCCESS")
                                            {
                                                $('#pay').html('Proceed').attr('disabled', false);
                                                ValidationMessage("Payment Success!", data.msg);
                                                window.location.href = "all_transactions.php";
                                            }
                                            else if(data.status == "FAILURE")
                                            {
                                                $('#pay').html('Proceed').attr('disabled', false);
                                                ValidationMessage("Payment Failure!", data.msg);
                                            }
                                        }
                                    });
                
                                } else {
                                    // redirect to a failure page.
                                }
                
                                x.close(); // use this to close the modal immediately after payment.
                            }
                        });
                    }

                    var amount;
                    $(document).on('click', '#tranfer_button', function(e) {
                        amount = $('#transfer_amount').val();
                
                        if(bank_min_amount != 0){
                            if(amount < bank_min_amount){
                                ValidationMessage("Invalid Amount!", `Amount can not be less than ${bank_min_amount}`);
                                $('#gateway_amount').focus();
                                return false;
                            }
                        }
                
                        if(bank_max_amount != 0){
                            if(amount > bank_max_amount){
                                ValidationMessage("Invalid Amount!", `Amount can not be greater than ${bank_max_amount}`);
                                $('#gateway_amount').focus();
                                return false;
                            }
                        }
                
                        if(amount == "" || amount < 0 || isNaN(amount))
                        {
                            ValidationMessage("Validation Message!", "Please enter a valid amount.")
                            $('#transfer_amount').focus();
                            return false;
                        }
                        $('#modal-center-trans-1').modal('show');
                    });

                    var account_name;
                    function ResolveAccount() 	{
                        var tok = $('#_token').val();
                        var account_no = $('#transfer_account_no').val();
                        var bank = $('#transfer_bank').val();
                        if(account_no == "" || bank == "") {
                            return false;
                        }
                        $("#account_name").html("Resolving Account...");
                        var dataString = {'account_no': account_no, 'bank': bank, '_token': tok};
                        $.ajax({
                            type: "POST",
                            url: 'resolveAccount.php',
                            data: dataString,
                            datatype: 'json',
                            success: function (data) {
                                data = JSON.parse(data);
                                if(data.status == "SUCCESS")
                                {
                                    account_name = data.account_name;
                                    $('#account_name').html(data.account_name);
                                }
                                else if(data.status == "FAILURE")
                                {
                                    $('#account_name').html(data.msg);
                                }
                            }
                        });
                    }
                
                    function submitTransfer() {
                        var tok = $('#_token').val();
                        var acct_account_no = $('#acct_transferred_to').val();
                        var account_no = $('#transfer_account_no').val();
                        var bank = $('#transfer_bank').val();
                        var trans_date = $('#transfer_date_time').val();
                        var transfer_remark = $('#transfer_remark').val();
                        var ref = IDGenerator();
                        if(account_no == "" || bank == "") {
                            return false;
                        }
                        $("#submit_transfer").html("Processing...").attr('disabled', 'disabled');
                        var dataString = {'acct_account_no':acct_account_no, 'account_no': account_no, 'bank': bank, 'transfer_date_time': trans_date, 'transfer_remark': transfer_remark, 'amount': amount, 'account_name': account_name, 'ref_no': ref, 'payment_method': pay_method, '_token': tok};
                        $.ajax({
                            type: "POST",
                            url: 'paymentSuccess',
                            data: dataString,
                            datatype: 'json',
                            success: function (data) {
                                data = JSON.parse(data);
                                if(data.status == "SUCCESS")
                                {
                                    $('#submit_transfer').html('Submit').attr('disabled', false);
                                    ValidationMessage("Submission Success!", data.msg);
                                    setTimeout(function(){
                                        window.location.href = "/all_transactions";
                                    }, 5000);
                                }
                                else if(data.status == "FAILURE")
                                {
                                    $('#submit_transfer').html('Submit').attr('disabled', false);
                                    ValidationMessage("Submission Failure!", data.msg);
                                }
                            }
                        });
                    }

                    var network;
                    $(document).on('click', '#airtime_button', function(e) {
                        amount = $('#airtime_amount').val();
                        network = $('#airtime_network').val();
                        if(amount == "" || amount < 0 || isNaN(amount))
                        {
                            ValidationMessage("Validation Message!", "Please enter a valid amount.")
                            $('#airtime_amount').focus();
                            return false;
                        }
                        if(network == "")
                        {
                            ValidationMessage("Validation Message!", "Please select a network.")
                            $('#airtime_network').focus();
                            return false;
                        }
                        if((max != "" && amount > max) || (min != "" && amount < min))
                        {
                            ValidationMessage("Validation Message!", "Enter amount ranging from ₦" + min + " to ₦" + max);
                            $('#amount').focus();
                            return false;
                        }
                        $('#tamount').html(amount);
                        $('#recipient_no').html(networks[network].airtime_to_cash_phone_numbers);
                        $('#transfer_code').html("Use " + networks[network].transfer_code + " for the Transfer");
                        $('#network_image').attr("src", "https://modelc.com.ng/asset/images/" + networks[network].network + ".png");
                        $('#modal-center-airtime-1').modal('show');
                        $('#to_phone_no').empty();
                        $('#to_phone_no').append('<option value="">-- Select Number --</option>');
                        $('#to_phone_no').append(`<option value="${networks[network].airtime_to_cash_phone_numbers}">${networks[network].airtime_to_cash_phone_numbers}</option>`);
                    });
                
                    $(document).on('click', '#generateOtherbanks', function(e) {
                        var userid = "permission";
                        $("#generateOtherbanks").html("Generating....").attr('disabled', 'disabled');
                        var dataString = {'access': "permission"};
                        $.ajax({
                            type: "POST",
                            url: 'generateOtherbanks',
                            data: dataString,
                            // data: JSON.stringify(dataString),
                            datatype: 'json',
                            success: function (data) {
                                // alert(data);
                                data = JSON.parse(data);
                                if(data.status == "SUCCESS")
                                {
                                    $('#generateOtherbanks').html('Generate Other banks').attr('disabled', false);
                                    ValidationMessage("Bank Generated Success!", data.msg);
                                    window.location.href = "fund.php";
                                }
                                else if(data.status == "FAILURE")
                                {
                                    $('#generateOtherbanks').html('Generate Other banks').attr('disabled', false);
                                    ValidationMessage("Funding Failure!", data.msg);
                                }
                            }
                        });
                    });

                </script>
            <!-- // content -->

    

<?= $this->endSection() ?>

    <!-- content -->
        <!-- Content Wrapper. Contains page content -->
        	<!-- Content Header (Page header) -->
            	
                

            </div>
            <!-- END: Content -->
        </div>

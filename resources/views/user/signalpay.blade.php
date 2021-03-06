@extends('layouts.master')

@section('admin_style')
<style type="text/css">
	.time_left_class_buy{
		color: #309145 !important;
		font-size: 16px !important;
		font-weight: 400 !important;
	}
	.time_left_class_sell{
		color: #db4931 !important;
		font-size: 16px !important;
		font-weight: 400 !important;
	}
	#clockdiv{
		font-family: sans-serif;
		color: #fff;
		font-weight: 100;
		text-align: center;
		font-size: 20px;
	}

	#clockdiv > div{
		padding: 10px;
		border-radius: 3px;
		background: grey;
		display: inline-block;
	}

	#clockdiv div > span{
		padding: 10px;
		border-radius: 3px;
		background: #2d2d2d;
		display: inline-block;
	}

	.smalltext{
		padding-top: 5px;
		font-size: 14px;
	}
</style>
@endsection
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div class="content">
	<div class="container-fluid">
		
		<div class="row mr-1" id="crypto_exchange">
			<div class="col-md-3" v-for="(result, index) in results">
				<div class="card card-stats" style="background: #212832">
					<div class="card-body ">
						<div class="row" >
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-bitcoin"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category" style="font-weight: bold; font-size: 24px">@{{index}}</p>
									<h4 class="card-title">$ @{{result.USD}}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mt-1 mr-3 mb-3">
			<div style="width: 100%; height:40px; background-color: #2d2d2d; overflow:hidden; box-sizing: border-box; border-radius: 4px; text-align: right; line-height:14px; block-size:40px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #2d2d2d;padding:1px;padding: 0px; margin: 0px;"><div style="height:40px;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=" width="100%" height="36" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;border-radius: 4px; "></iframe></div></div>
		</div>

		<div id="containered" style="min-width: 310px" class="lead py-1 mx-0 bg-secondary">
			<div class="container-fluid" style = "padding-left: 0; padding-right: 0">
					<div class="col" style = "padding-left: 0">	
						<div style="background-color: #2d2d2d; overflow:hidden; box-sizing: border-box; border: 1px solid #2d2d2d; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #2d2d2d;padding:1px;padding: 0px; margin: 0px;">

							<div class="row">

								<div class="col-8 px-3">
									@include('user.qrCode')
								</div>
								<div class="col-4 pt-4 px-3">
									<div id="clockdiv">
										<div>
										    <span class="minutes"></span>
										    <div class="smalltext">Min</div>
										</div>
										<div>
										    <span class="seconds"></span>
										    <div class="smalltext">Sec</div>
										</div>
									</div>
									<div class="text-center">
										<p></p>
										<h5>Current time </h5>
										
										<p id="timeforpay"></p>
									</div>
								</div>
								
						  	</div>
						  	<div class="row" style="width: 100%">
							  	<form class="deposit-form col-12 mx-3" action="{{route('newtaxpay')}}" method="post">
						  			@csrf
						  			<div class="input-group input-text-select mb-3 mt-5">
									  	<input type="text" placeholder="Wallet Address" class="form-control crypt-input-lg" name="wallet_address">
									  	<div class="input-group-append">
										    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">Other Address</button>
										    <div class="dropdown-menu">
										      	<select class="form-control">
									      			<option></option>
											        <option>234235234</option>
											        <option>2343453453</option>
											        <option>23423423423</option>
											        <option>1231312323</option>
											        <option>2233223322</option>
											        <option>2233335555</option>
										    	</select>
										    </div>
										</div>
									</div>
									<div class="input-group input-text-select mb-3">
									  	<div class="input-group-prepend">
									    	<input placeholder="Amount to pay" type="text" class="form-control crypt-input-lg" name="tax_amount" value="234234">
									  	</div>
									  	<select class="custom-select" style = "color:yellow; font-size: 14px" name="currency_unit">
									    	<option value="USD">BTC</option>
									    	<option value="GBP">GBP</option>
									    	<option value="EUR">EUR</option>
											<option value="BTC">USD</option>
									  	</select>
									</div>
									<div class="text-center crypt-up mt-3 mb-3">
										<p>You may pay now</p>
										
									</div>
									<div class="row">
										<div class="col-6">
											<a href="#" class="crypt-button-red-full mb-3">Cancel payment</a>
										</div>
										<div class="col-6">
											<input type="submit" style="border: none" name="" value="Proceed To Payment" class="crypt-button-green-full mb-3">
										</div>
									</div>
									
								</form>
							</div>

						</div>
					</div>

			</div>
		</div>

		  
	</div>
</div>
@endsection
@section('admin_script')
<script type="text/javascript">

	const url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,LTC,BCH&tsyms=USD,EUR,GBP";

	const vm = new Vue({
	    el: '#crypto_exchange',   
	    data: {
	     results: []
	        },

	     mounted() {

	      this.upDate();
	      this.timer = setInterval(this.upDate, 1000)
	      }, 

	      methods:{
	      upDate: function() {
	            axios.get(url).then(response => {
	              this.results = response.data
	            })
	       }, 
	      cancelAutoUpdate: function(){
	            clearInterval(this.timer)
	       },

	       beforeDestroy() {
	         clearInterval(this.timer)
	       }
	    }
	});

	setInterval(function() {
		var dt = new Date();
	    document.getElementById("timeforpay").innerHTML = dt.toLocaleString();
	}, 1000);

	$('#onbuy').click( function () {
		$('#time_left').removeClass('time_left_class_sell');
		$('#time_left').addClass('time_left_class_buy');

		$('#confirm_divider').show();
		var x;
		$('#onconfirm').click( function () {

			var dis = document.getElementById('counter_init').value;
			document.getElementById('time_left').innerHTML = 'Time limit: '+dis+' min';
			$('#confirm_divider').hide();

			clearInterval(x);
			
			var distance = 60*dis;
			//document.getElementById('counter_min').innerHTML = distance;
				
			x = setInterval(function() {
			  var minutes = parseInt( distance / 60);
			  var seconds = parseInt( distance %  60);

			  // Display the result in the element with id="demo"
			  document.getElementById('counter_min').innerHTML = minutes+'min';
			  document.getElementById('counter_sec').innerHTML = seconds+'sec';

			  distance = distance - 1;

			  // If the count down is finished, write some text
			  if (distance < 0) {
			    clearInterval(x);
			    document.getElementById('counter_min').innerHTML = '0 0';
			    document.getElementById('counter_sec').innerHTML = '0 0';
			  }
			}, 1000);
		});
		$('#oncancel').click(function(){
			$('#confirm_divider').hide();
		});
	});
	$('#onsell').click( function () {

		$('#time_left').removeClass('time_left_class_buy');
		$('#time_left').addClass('time_left_class_sell');
		$('#confirm_divider').show();

		var y;
		$('#onconfirm').click( function () {

			var dis = document.getElementById('counter_init').value;
			document.getElementById('time_left').innerHTML = 'Time limit: '+dis+' min';

			$('#confirm_divider').hide();

			clearInterval(y);
			var distance = 0;
			var minutes = 0;
			var seconds = 0;
			//document.getElementById('counter_min').innerHTML = distance;
				
			y = setInterval(function() {

			  // Display the result in the element with id="demo"
			  document.getElementById('counter_min').innerHTML = minutes+'min';
			  document.getElementById('counter_sec').innerHTML = seconds+'sec';

			  distance++;
			  seconds++;

			  if (seconds > 59) {
			  	minutes++; seconds = 0;
			  }

			  // If the count down is finished, write some text
			  if (distance > 60*dis) {
			    clearInterval(y);
			    document.getElementById('counter_min').innerHTML = '0 0';
			    document.getElementById('counter_sec').innerHTML = '0 0';
			  }
			}, 1000);
		});
		$('#oncancel').click(function(){
			$('#confirm_divider').hide();
		});
	});

	function getTimeRemaining(endtime) {
	  var t = Date.parse(endtime) - Date.parse(new Date());
	  var seconds = Math.floor((t / 1000) % 60);
	  var minutes = Math.floor((t / 1000 / 60) % 60);
	  return {
	    'total': t,
	    'minutes': minutes,
	    'seconds': seconds
	  };
	}

	function initializeClock(id, endtime) {
	  var clock = document.getElementById(id);
	  var minutesSpan = clock.querySelector('.minutes');
	  var secondsSpan = clock.querySelector('.seconds');

	  function updateClock() {
	    var t = getTimeRemaining(endtime);

	    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
	    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

	    if (t.total <= 0) {
	      clearInterval(timeinterval);
	    }
	  }

	  updateClock();
	  var timeinterval = setInterval(updateClock, 1000);
	}

	var timelimit = document.getElementById('counter_init').value;
	var deadline = new Date(Date.parse(new Date()) + timelimit * 60 * 1000);
	initializeClock('clockdiv', deadline);
</script>
@endsection
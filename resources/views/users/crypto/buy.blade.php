@extends('layouts.dashboard')

@section('title', 'Buy Cryptocurrency')

@section('content')
    	<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Buy Cryptocurrency</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Buy Cryptocurrency</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Buy Cryptocurrency</div>
								</div>
									<div class="card-body">

										<div class="col-12">

											<div style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #7532a4; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #7532a4; padding: 0px; margin: 0px; width: 99%;"><div style="height:413px;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1505&graph=yes" width="100%" height="409" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing:content-box; margin: 3px 6px 10px 0px; font-family: Verdana, Tahoma, Arial, sans-serif;"><b>Powered by&nbsp;<a href="#" style="font-weight: 500; color: #FFFFFF; text-decoration:none;font-size:11px">{{config('app.name')}}</b></a></div></div>	

											<div class="card-header">
												<div class="card-title">Available Fund(s): &#8358 55 </div>
											</div>

											<div class="form-group">
												<label for="crypto">Select Cryptocurrency</label>
												<select class="form-control" id="crypto">
													<option>Bitcoin</option>
													<option>Ethereum</option>
												</select>
												@error('crypto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="amount">Enter Amount</label>
												<input type="number" class="form-control" id="amount" placeholder="Enter Amount">
												@error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="coindetails">Enter Coin Delivery Details</label>
												<small id="coindetails" class="form-text text-muted">Please enter the wallet address or account ID of the receiving coin gateway. Please specify the correct coin payment gateway below.</small>
												<textarea class="form-control" id="coindetails" rows="6"> </textarea>
												@error('coindetails')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-check">
												<label class="form-check-label">
													<input class="form-check-input" type="checkbox" value="">
													<span class="form-check-sign">Agree with terms and conditions</span>
												</label>
												<small id="details" class="form-text text-muted">Coin value is calculated in accordance with the cryptocurrency & dollar market. Brain&Paper will not be liable to any loss or delay incurred from providing wrong account details or delay in bank transfer network.</small>
											</div>											
											
										</div>
										<div class="card-action mb-4">
											<button type="submit" class="btn btn-success float-right">Buy Cryptocurrency</button>
										</div>
										
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
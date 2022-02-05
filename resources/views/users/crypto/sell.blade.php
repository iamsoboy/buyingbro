@extends('layouts.dashboard')

@section('title', 'Sell Cryptocurrency')

@section('content')

			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Sell Your Cryptocurrency</h4>
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
								<a href="#">Sell Cryptocurrency</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Sell Cryptocurrency</div>
								</div>
									<div class="card-body">

										<div class="col-md-12">
											<div style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #7532a4; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #7532a4; padding: 0px; margin: 0px; width: 99%;"><div style="height:413px;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1505&graph=yes" width="100%" height="409" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing:content-box; margin: 3px 6px 10px 0px; font-family: Verdana, Tahoma, Arial, sans-serif;"><b>Powered by&nbsp;<a href="#" style="font-weight: 500; color: #FFFFFF; text-decoration:none;font-size:11px">{{config('app.name')}}</b></a></div></div>	
											
											</div>

											<div class="card mt-4">

												<div class="card-header">
													<div class="card-title">Our Wallet Addresses</div>
												</div>

												<div class="card-body">
													<div class="flex-1 ml-3 pt-1">
														<h3 class="fw-bold mb-1">BITCOIN: <span class="text-warning pl-3">hjsdhfsdhfihewihfihsdi</span></h3>
													</div>
													<div class="flex-1 ml-3 pt-1">
														<h3 class="fw-bold mb-1">ETHEREUM: <span class="text-warning pl-3">hjsdhfsdhfihewihfihsdi</span></h3>
													</div>
												</div>

											</div>

										<div class="col-12">

											<div class="form-group">
												<label for="coin">Select Coin Type</label>
												<select class="form-control" id="coin">
													<option>Bitcoin</option>
													<option>Ethereum</option>
												</select>
												@error('coin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="coinvalue">Enter Coin Value/Amount</label>
												<small id="coinvalue" class="form-text text-muted">Please note that entering amount higher that the uploaded gift card will result to you transaction being marked as fraud.</small>
												<input type="text" class="form-control" id="coinvalue" placeholder="Unit(s) of coin E.G 0.0021">
												@error('coinvalue')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="transactionid">Enter Transaction ID</label>
												<small id="transactionid" class="form-text text-muted">Please note that entering fake transaction ID or Transaction Number will result to your transaction being marked as fraud and your account banned.</small>
												<input type="text" class="form-control" id="transactionid" placeholder="Unit(s) of coin E.G 0.0021">
												@error('transactionid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="paymentupload">Upload Payment Screenshot</label>
												<input type="file" class="form-control" id="paymentupload">
												@error('paymentupload')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="details">Receiving Account's Details</label>
												<small id="details" class="form-text text-muted">Please enter the receivers account details. For bank transfer please provide complete bank details with your bank's SWIFT code. If you want coins sales remitted to your Brain&Paper online wallet please specify below.</small>
												<textarea class="form-control" id="details" rows="4">
												</textarea>
												@error('details')
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
												<small id="details" class="form-text text-muted">Coin value is calculated in accordance with the dollar market. Brain&Paper will not be liable to any loss or delay incurred from providing wrong account details or delay in bank transfer network.</small>
											</div>											
											
										</div>
										<div class="card-action mb-4">
											<button type="submit" class="btn btn-success float-right">Sell Cryptocurrency</button>
											<button class="btn btn-danger float-left">Cancel</button>
										</div>
										
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		
@endsection
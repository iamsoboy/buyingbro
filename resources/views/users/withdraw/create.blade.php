@extends('layouts.dashboard')

@section('title', 'Withdraw Fund(s)')

@section('content')

<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Fund Withdraw</h4>
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
								<a href="#">New Withdraw</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Available Funds: {{currency($userprofile->main_balance)}} </div>
								</div>

								<div class="card-body">

									@if (session()->has('success_message'))
									<div class="alert alert-success mb-6">
										<strong>{{session()->get('success_message')}}</strong>
									</div>
									@endif

										@if ($errors->any())
											<div class="alert alert-danger">
												<ul>
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif

									<div class="row">

										<div class="col-12">
										<form action="{{ route('withdraw.store') }}" method="POST">
											@csrf
											<div class="form-group">
												<label for="method">Select Withdrawal Method</label>
												<select class="form-control" id="gateway" name="gateway">
													@foreach($gateways as $gateway)
														<option value="{{$gateway->id}}">{{$gateway->name}} <b>(Service Charge: {{currency($gateway->fixed)}} + {{$gateway->percent}}% of request )</b></option>
													@endforeach
												</select>
												@error('gateway')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="amount">Enter Amount</label>
												<input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Withdrawal Amount">
												@error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
	                                            <label class="control-label">Account Details</label>
	                                            <textarea class="form-control" row="5" id="details" name="details" placeholder="Enter your PayPal Email | Your Bank Account Details | Bitcoin Address"></textarea>
	                            				@error('details')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
                                        	</div>



										</div>



									</div>
									<div class="card-action mb-4">
											<button class="btn btn-success float-right bt-4">Withdraw Fund</button>
										</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

@endsection

@extends('layouts.dashboard')

@section('title', 'Deposit Fund')

@section('content')

<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">New Fund Deposit</h4>
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
								<a href="#">Deposit Fund</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Select Payment Method</div>
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

										<div class="accordion accordion-secondary">
										@foreach ($gateways as $gateway)
											@if($gateway->status == 1)
											<div class="card">
												<div class="card-header collapsed" id="heading{{ $gateway->id }}" data-toggle="collapse" data-target="#collapse{{ $gateway->id }}" aria-expanded="true" aria-controls="collapse{{ $gateway->id }}">
													<div class="span-icon">
													@if ($gateway->id == 5)
													<div class="fab fa-bitcoin"></div>
													@elseif($gateway->id == 4)
													<div class="fas fa-piggy-bank"></div>
													@elseif($gateway->id == 3)
													<div class="fab fa-paypal"></div>
                                                    @elseif($gateway->id == 6)
                                                        <div class="fas fa-gift"></div>
													@else
													<div class="flaticon-credit-card"></div>
													@endif
													</div>
													<div class="span-title">
														{{ $gateway->name }}
													</div>
													<div class="span-mode"></div>
												</div>

												<div id="collapse{{ $gateway->id }}" class="collapse" aria-labelledby="heading{{ $gateway->id }}" data-parent="#accordion">
													<div class="card-body">
														<h3>When you deposit using {{ $gateway->name }}, you will be charged {{currency($gateway->fixed)}} with {{$gateway->percent}}% of your deposit as deposit charge.</h3>
														@if($gateway->id == 4)
														<form action="{{ route('deposit.verify') }}" method="post">
                                                        @elseif ($gateway->id == 6)
                                                        <form action="{{ route('deposit.voucher') }}" method="post">
														@else
														<form action="{{ route('deposit.instant') }}" method="post">
														@endif
															@csrf
															<div class="form-group">
																<label for="paystack">Please Enter the Amount @if ($gateway->id == 6) and Voucher Code @endif to Deposit And Click On Proceed Button</label>
																<div class="input-group">
																	<div class="input-group-prepend">
																		<span class="input-group-text">{{currency()->getUserCurrency()}}</span>
																	</div>
																	<input type="number" class="form-control" id="amount" name="amount" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                    @if($gateway->id == 6)
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">CODE</span>
                                                                        </div>
                                                                        <input type="number" class="form-control" id="code" name="code" placeholder="" aria-label="" aria-describedby="basic-addon1">

                                                                    @endif
																	<div class="input-group-prepend">
																		<button type="submit" class="btn btn-default btn-border" type="button">Proceed</button>
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											@endif
										@endforeach



										</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection

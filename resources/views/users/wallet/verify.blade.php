@extends('layouts.dashboard')

@section('title', 'Deposit Preview')

@section('content')

            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Deposit Fund</h4>
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
								<a href="#">Deposit Verify</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Deposit Verify</div>
								</div>
								
								<div class="card-body">
									<form action="{{ route('deposit.bank') }}" method="post">
									@csrf
									<div class="table-responsive">
										<table class="table table-bordered table-bordered-bd-warning mt-4 table-hover" >
											<marquee height = "20%">
											   <b>NOTICE:</b> To use this payment gateway, visit your Bank and make deposit of <b> {{ currency($deposit->amount + $deposit->charge )}}</b> using <b>{{ $deposit->code}} </b> as the Sender's Name or ID and click on Validate when done.
											</marquee>
											<thead>
												<tr>
													<th>Payment Code</th>
													<th><span style="float: right; text-align: right;">{{ $deposit->code}}</span></th>
												</tr>
											</thead>
								
											<tbody>
												<tr>
													<td>
														<b>Account Details</b>
													</td>
													<td>
														<span style="float: right; text-align: right;">
														2114554420203<br>
														Our Bank Name: BarClays <br>
														Account Holders Name: Sherlock Holmes<br>
														Account Number: 5262 0216 3566 5746<br>
														Sort Code: 66693861<br>
														SWIFT Code: TD11 1XZ <br>
														IBAN Code: 3130752327</span>
													</td>
												</tr>
												<tr>
													<td>
														<b>Amount</b>
													</td>
													<td><span style="float: right; text-align: right;">{{ currency($deposit->amount)}}</span></td>
												</tr>
												<tr>
													<td>
														<b>Deposit Charge</b>
													</td>
													<td>
														<span style="float: right; text-align: right;">
														{{ currency($deposit->charge)}}
														</span>
													</td>
												</tr>
												<tr>
													<td>
														<b><h3>Total</h3></b>
													</td>
													<td>
														<h3>
														<span style="float: right; text-align: right;">
														<strong>{{ currency($deposit->amount + $deposit->charge )}}</strong>
														</span>
														</h3>
													</td>
												</tr>
											</tbody>
										</table>

											<div class="card-action mb-2">
											<button type="submit" class="btn btn-success float-right">Validate Payment</button>
											<a href="{{route('deposit.create')}}" class="btn btn-danger float-left">Cancel Deposit</a>
										</div>

										<input type="hidden" name="gateway" value="{{$gateways->name}}" />
											<input type="hidden" name="amount" value="{{$deposit->amount}}" />
											<input type="hidden" name="reference" value="{{$deposit->code}}" />
											<input type="hidden" name="charge" value="{{$deposit->charge}}" />
											<input type="hidden" name="net_amount" value="{{$deposit->net_amount}}" />
									</div>
										</form>
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>


@endsection
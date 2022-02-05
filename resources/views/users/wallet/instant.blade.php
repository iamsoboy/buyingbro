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
									<div class="card-title">Deposit via {{ $gateways->name }} </div>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered table-bordered-bd-warning mt-4 table-hover" >

                                            <thead>
												<tr>
													<td>
														<b>Amount</b>
													</td>
													<td><span style="float: right; text-align: right;">{{ currency($deposit->amount)}}</span></td>
												</tr>
                                            </thead>
                                            <tbody>
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

										<form action="{{ route('deposit.insert') }}" method="POST" id="deposit-form">
                                            @csrf

											<input type="hidden" name="amount" value="{{$deposit->deposit_amount}}" />

                                            @if($gateways->id == 1)

                                                <div class="card-action mb-2">
                                                    <button type="submit" class="btn btn-success float-right">Proceed to Deposit</button>

                                                </div>

										</form>







											@elseif($gateways->id == 2)

											<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
												<div class="card-action mb-2">
													<button type="submit" class="btn btn-success float-right" onClick="payWithRave()">Proceed to Deposit</button>
													<a href="{{route('deposit.create')}}"><button class="btn btn-danger float-left">Cancel Deposit</button></a>
												</div>

												<script>
													const API_publicKey = "<ADD YOUR PUBLIC KEY HERE>";

													function payWithRave() {
														var x = getpaidSetup({
															PBFPubKey: API_publicKey,
															customer_email: "{{ $user->email }}",
															amount: "{{ ($deposit->amount + $deposit->charge ) * 100 }}",
															customer_phone: "{{ $user->userprofile->mobile }}",
															currency: "NGN",
															txref: "{{ $deposit->code}}",
															meta: [{
																metaname: "Customer Name",
																metavalue: "{{ $user->userprofile->name }}"
															}],
															onclose: function() {},
															callback: function(response) {
																var txref = response.data.txRef; // collect txRef returned and pass to a server page to complete status check.
																console.log("This is the response returned after a charge", response);
																if (
																	response.data.chargeResponseCode == "00" ||
																	response.data.chargeResponseCode == "0"
																) {
																	// redirect to a success page
																	window.location='javascript: submitform()';
																} else {
																	// redirect to a failure page.
																}

																x.close(); // use this to close the modal immediately after payment.
															}
														});
													}
												</script>

											@endif

									</div>


								</div>

							</div>
						</div>
					</div>
				</div>
			</div>


@endsection

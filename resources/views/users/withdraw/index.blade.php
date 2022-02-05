@extends('layouts.dashboard')

@section('title', 'Withdrawal History')

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
								<a href="#">Withdrawals Archive</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Withdrawal History </div>
								</div>
								
								<div class="card-body">

									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
										@if(count($withdraws) > 0)
											
											<thead>
												<tr>
													<th>Withdrawal Method</th>
													<th>Amount Requested</th>
													<th>Transaction Date</th>
													<th>Reference Number</th>
													<th>Status</th>
												</tr>
											</thead>
											
											<tbody>
											@foreach ($withdraws as $withdraw)
													<tr>
														<td>{{$withdraw->method}}</td>
														<td>&#8358 {{$withdraw->amount}}</td>
														<td>{{$withdraw->created_at->diffForHumans()}}</td>
														<td>{{$withdraw->reference}}</td>
														<td>
														@if($withdraw->status == 0)
														<button class="btn btn-warning">Pending</button>
														@elseif($withdraw->status == 1)
														<button class="btn btn-success">Successful</button>
														@else
														<button class="btn btn-danger">Failed</button>
														@endif
														</td>
													</tr>
											@endforeach	
											</tbody>
											
											@else
											<h4 class="text-center">You have not made any withdrawal yet. Please ensure you have enough fund in your wallet to initiate a withdrawal process</h4>
											@endif
										</table>

									</div>
											<nav aria-label="...">
												<ul class="pagination justify-content-end mx-6">
													<li class="page-item">
														{{ $withdraws->links()}}
													</li>
												</ul>
											</nav>
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>

@endsection
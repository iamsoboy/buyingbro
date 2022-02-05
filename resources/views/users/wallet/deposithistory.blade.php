@extends('layouts.dashboard')

@section('title', 'Deposit History')

@section('content')
            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Deposit Fund History</h4>
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
								<a href="#">Deposit Archive</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Deposit History </div>
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

									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
										@if(count($deposits) > 0)
											
											<thead>
												<tr>
													<th>Deposit Method</th>
													<th>Amount Deposited</th>
													<th>Transaction Date</th>
													<th>Reference Number</th>
													<th>Status</th>
												</tr>
											</thead>
											
											<tbody>
											@foreach ($deposits as $deposit)
													<tr>
														<td>{{$deposit->gateway_name}}</td>
														<td>{{currency($deposit->amount)}}</td>
														<td>{{$deposit->created_at->diffForHumans()}}</td>
														<td>{{$deposit->transaction_id}}</td>
														<td>
														@if($deposit->status == 0)
														<button class="btn btn-warning">Pending</button>
														@elseif($deposit->status == 1)
														<button class="btn btn-success">Successful</button>
														@else
														<button class="btn btn-danger">Failed</button>
														@endif
														</td>
													</tr>
											@endforeach	
											</tbody>
											
											
											@else
											<h4 class="text-center">You have not made any deposits yet.</h4>
											@endif
										</table>

									</div>
											<nav aria-label="...">
												<ul class="pagination justify-content-end mx-6">
													<li class="page-item">
														{{ $deposits->links()}}
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
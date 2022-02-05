@extends('layouts.dashboard')

@section('title', 'My Orders')

@section('content')
            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">My Order History</h4>
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
								<a href="#">Orders Archive</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Orders History </div>
								</div>
								
								<div class="card-body">

									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
										@if(count($orders) > 0)
											
											<thead>
												<tr>
													<th>Name</th>
													<th>Price</th>
													<th>Type</th>
                                                    <th>Total Paid</th>
													<th>Reference Number</th>
													<th>Status</th>
                                                    <th>Date</th>
												</tr>
											</thead>
											
											<tbody>
											@foreach ($orders as $order)
													<tr>
														<td>
														@foreach ($order->products as $product)
														{{ $product->name }} <br>
														@endforeach
														</td>
														<td>
														@foreach ($order->products as $product)
														{{ currency($product->price) }} <br>
														@endforeach</td>
                                                        <td>
														@foreach ($order->products as $product)
														{{$product->type }} <br>
														@endforeach
														</td>
													
                                                        <td>{{ currency($order->billing_total) }}</td>
                                                        <td>{{$order->billing_transaction_id}}</td>
                                                        <td>
														@if($order->shipped == 'Pending')
														<button class="btn btn-warning">{{$order->shipped}}</button>
														@else
														<button class="btn btn-success">{{$order->shipped}}</button>
														@endif
														
														</td>
														<td>{{$order->created_at->diffForHumans()}}</td>
													
														
													</tr>
											@endforeach	
											</tbody>
											
											
											@else
											<h4 class="text-center">You have not made any orders yet.</h4>
											@endif
										</table>

									</div>
											<nav aria-label="...">
												<ul class="pagination justify-content-end mx-6">
													<li class="page-item">
													{{ $orders->links()}}
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
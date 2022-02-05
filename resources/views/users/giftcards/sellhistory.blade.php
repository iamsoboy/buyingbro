@extends('layouts.dashboard')

@section('title', 'Sales History')

@section('content')
            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Gift Cards</h4>
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
								<a href="#">Sales Archive</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Sales History </div>
								</div>

								<div class="card-body">

									<div class="table-responsive">
                                        @forelse ($customers as $customer)
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Name of Card</th>
													<th>Value</th>
													<th>Time</th>
													<th>Reference Number</th>
													<th>Status</th>
												</tr>
											</thead>


											<tbody>

                                                    <tr>
                                                        <td>{{$customer->name}}</td>
                                                        <td>{{currency($customer->value)}}</td>
                                                        <td>{{$customer->created_at->diffForHumans()}}</td>
                                                        <td>{{$customer->reference}}</td>
                                                        <td>
                                                        @if($customer->status == 'Pending')
                                                        <button class="btn btn-danger">{{$customer->status}}</button>
                                                        @else
                                                        <button class="btn btn-success">{{$customer->status}}</button>
                                                        @endif
                                                        </td>
                                                    </tr>

											</tbody>

										</table>
                                        @empty
                                            <h4 class="text-center">You have not sold any giftcard(s) yet.</h4>
                                        @endforelse

									</div>
											<nav aria-label="...">
												<ul class="pagination justify-content-end mx-6">
													<li class="page-item">
														{{ $customers->links()}}
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

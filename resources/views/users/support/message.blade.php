@extends('layouts.dashboard')

@section('title', 'My Support')

@section('content')

			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Sent Message(s)</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item active">
								<a href="#">Ticket History</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
														
								<div class="card-body">
									<a href="{{route ('support.create')}}">
									<button type="button" class="btn btn-primary btn-lg btn-block">Compose New Message</button>
									</a>

										<div class="card mt-4">
											<ul class="list-group list-group-flush">
												<li class="list-group-item mb-2" href="#">
													<div class="span-icon pr-4">
														<div class="fas fa-envelope"></div>
														<span class="notification pl-1">4</span>
													</div>
													<b>Inbox Message</b>
												</li>
											
											
												<li class="list-group-item" href="#">
													<div class="span-icon pr-4">
														<div class="fas fa-paper-plane"></div>
														<span class="notification pl-1">{{$count}}</span>
													</div>
													<b>Sent Message</b>
												</li>
											</ul>
										</div>
									
								</div>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Support Message History </div>
								</div>
								
								<div class="card-body">

									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
										@if($count > 0)
											<thead>
												<tr>
													<th>View</th>
													<th>Ticket ID</th>
													<th>Subject</th>
													<th>Date/Time</th>
													<th>Status</th>
												</tr>
											</thead>

											
												<tbody>
												@foreach ($supports as $support)
													<tr>
														<td> 
														<a href="{{route('support.show', $support['ticket'])}}" class="btn btn-outline-info" type="button"> Open
														</a></td>
														<td>{{$support['ticket']}}</td>
														<td>{{$support['subject']}}</td>
														<td>{{$support['created_at']->diffForHumans()}}</td>
														<td>
														@if($support['status'] == 'Close')
															<button class="btn btn-danger">{{$support['status']}}</button>
															@elseif($support['status'] == 'Active')
															<button class="btn btn-success">{{$support['status']}}</button>
															@else
															<button class="btn btn-warning">{{$support['status']}}</button>
														@endif
														</td>
													</tr>
												@endforeach	
												</tbody>
											@else
											<h4 class="text-center">No New Support Ticket</h4>
											@endif	
										</table>

									</div>
								
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>			

@endsection
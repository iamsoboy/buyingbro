@extends('layouts.dashboard')

@section('title', 'Purchased History')

@section('content')
<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Cryptocurrency Purchase</h4>
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
								<a href="#">Purchased Archive</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Purchase History </div>
								</div>
								
								<div class="card-body">

									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Cryptocurrency</th>
													<th>Value</th>
													<th>Reference Number</th>
													<th>Time</th>
													<th>Status</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Cryptocurrency</th>
													<th>Value</th>
													<th>Reference Number</th>
													<th>Time</th>
													<th>Status</th>
												</tr>
											</tfoot>
											<tbody>
												<tr>
													<td>Spar Gift Card</td>
													<td>&#8358 20,000</td>
													<td>61XWE234mx5S</td>
													<td>25/12/2019</td>
													<td>
														<span class="text-success">Successfull</span>
													</td>
												</tr>
											</tbody>
										</table>

									</div>
								
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
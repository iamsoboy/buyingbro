@extends('layouts.dashboard')

@section('title', 'Edit My Profile')

@section('content')

			<div class="content">
				<div class="page-inner">
					<h4 class="page-title">User Profile</h4>
					<div class="row">
						<div class="col-md-8">
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
							<div class="card card-with-nav">
								<div class="card-header">
									<div class="row row-nav-line">
										<ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
											<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#personal" role="tab" aria-selected="true">Personal Details</a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bank" role="tab" aria-selected="false">Bank Details</a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password" role="tab" aria-selected="false">Change Password</a> </li>
										</ul>
									</div>
								</div>
								<!-- Tab panes -->
                                <div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="personal">
										<div class="card-body">
											<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
											@method('patch')
											@csrf
											<div class="row mt-3">
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>Upload Profile Picture</label>
														<input type="file" class="form-control-file" name="avatar" id="avatar">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>Full Name</label>
														<input type="text" class="form-control" id="name" name="name" value="{{ old('name') ??$user->name}}" placeholder="Enter Full Name">
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-4">
													<div class="form-group form-group-default">
														<label>Email</label>
														<input type="email" class="form-control" id="email" name="email" value="{{ old('email') ??$user->email}}" placeholder="Enter Email Address">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-default">
														<label>Username</label>
														<input type="text" class="form-control" id="username" name="username" value="{{ old('username') ??$user->username}}" placeholder="Enter Username">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-default">
														<label>Phone</label>
														<input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('phone') ??$userprofile->mobile}}" placeholder="Enter Phone Number">
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>Home Address</label>
														<input type="text" class="form-control" id="address" name="address" value="{{ old('address') ?? $userprofile->address }}">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>Country</label>
														<select class="form-control" name="country" id="country" onchange="print_state('state', this.selectedIndex);">
															<option value="{{ old('country') ?? $userprofile->country }}">{{ old('country') ?? $userprofile->country }}</option>
														</select>
														<script language="javascript">print_country("country");</script>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>State</label>
														<select class="form-control" id="state" name="state">
															<option value="{{ old('state') ?? $userprofile->state }}">{{ old('state') ?? $userprofile->state }}</option>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>Postal Code</label>
														<input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') ?? $userprofile->postcode }}">
													</div>
												</div>
											</div>
											<div class="text-right mt-3 mb-3">
												<button type="submit" class="btn btn-success">Save</button>
											</div>	
											</form>								
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="bank">
										<div class="card-body">
											<form method="POST" action="{{ route('profile.bank') }}">
												@method('patch')
												@csrf
												<div class="row mt-3">
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label> Account Name</label>
															<input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{ $user->userbank->account_name ?? old('account_name') }}">
															<b class="form-text" id="taxcodeError"></b>
                                                    		<div id="recipientError1"></div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label>Bank Name</label>
															<select class="form-control" name="bank_code" id="bank_code">
																<option value="Other Banks">Other Banks</option>
																@foreach ($banks as $bank)
																<option value="{{ $bank->bankcode }}">{{ $bank->name }}</option>
																@endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="row mt-3">
													<div class="col-md-6">
														<div class="form-group form-group-default">
															<label> Account Number</label>
															<input type="number" class="form-control" name="account_number" id="account_number" placeholder="Account Number" value="{{ $user->userbank->account_number ?? old('account_number') }}">
														</div>
													</div>
												</div>
												<div class="text-right mt-3 mb-3">
													<button type="submit" class="btn btn-success">Save</button>
												</div>
											</form>									
										</div>
										<hr>
										<div class="card-body mt-4">
												<div class="table-responsive">
													<table id="basic-datatables" class="display table table-striped table-hover" >
														<tbody> 
														
															<tr>
																<td>{{ $user->userbank->account_name ?? null }}</td>
																<td>{{ $user->userbank->account_number ?? null }}</td>
																<td>{{ $user->userbank->bank_name ?? null }}</td>														
															</tr>
																									 
														</tbody>
													</table>

												</div>
												
										</div>
										
									</div>
									<div role="tabpanel" class="tab-pane" id="password">
										<div class="card-body">
											<form method="POST" action="{{ route('profile.password') }}">
												@csrf
											<div class="row mt-3">
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>New Password</label>
														<input type="password" class="form-control" name="password" placeholder="Password">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-group-default">
														<label>Confirm New Password</label>
														<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
													</div>
												</div>
											</div>
											<div class="text-right mt-3 mb-3">
												<button type="submit" class="btn btn-success">Save</button>
											</div>	
											</form>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="{{ profileImage($userprofile->avatar) }}" alt="profile picture" class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name">{{ $user->name }}, {{ $user->username }}</div>
										<div class="job">{{ $user->email }}  |  {{ $userprofile->mobile }}</div>
										<div class="desc">Joined: <b>{{ $user->created_at->diffForHumans() }}</b></div>
										<div class="social-media">
											<a class="btn btn-info btn-twitter btn-sm btn-link" href="#"> 
												<span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
											</a>
											<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
												<span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span> 
											</a>
											<a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#"> 
												<span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span> 
											</a>
											<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
												<span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span> 
											</a>
										</div>
										<div class="view-profile">
											<a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="row user-stats text-center">
										<div class="col">
											<div class="number">{{ $userprofile->main_balance }}</div>
											<div class="title">Revenue</div>
										</div>
										<div class="col">
											<div class="number">{{ $userprofile->deposit_balance }}</div>
											<div class="title">Deposit</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
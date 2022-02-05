@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('content')

<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">My Profile</h4>
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
								<a href="#">Edit Profile</a>
							</li>		
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">									
								<div class="card-header">
									<div class="card-title">Update Profile</div>
								</div>
								<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
								@method('patch')
								@csrf
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

									<div class="row">
										<div class="col-md-6 col-lg-6">
											<div class="avatar avatar-xxl">
												<img src="{{ profileImage($userprofile->avatar) }}" alt="Profile Picture" class="avatar-img rounded-circle">
											</div>
										
											<div class="form-group">
												<label for="image">Upload Profile Picture</label>
												<input type="file" class="form-control-file" name="avatar" id="avatar">
												@error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="name">Full Name</label>
												<input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name}}" placeholder="Enter Full Name">
												@error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="email">Email Address</label>
												<input type="email" class="form-control" id="email" name="email" value="{{ old('email') ??$user->email}}" placeholder="Enter Email">
												@error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="username">Username</label>
												<input type="username" class="form-control" id="username" name="username" value="{{ old('username') ??$user->username}}" placeholder="Enter Username">
												@error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											
											
											
										</div>
										<div class="col-md-6 col-lg-6">

											<div class="form-group">
												<label for="phone">Phone</label>
												<input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('phone') ??$userprofile->mobile}}" placeholder="Enter Phone Number">
												@error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="country">Country</label>
												<select onchange="print_state('state', this.selectedIndex);" class="form-control @error('country') is-invalid @enderror" name="country" id="country" value="{{ old('country') ?? $userprofile->country }}">
													<option>Choose Country</option>
													<option>...</option>
												</select>
												<script language="javascript">print_country("country");</script>
												@error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="state">State</label>
												<select class="form-control form-inline @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') ?? $userprofile->state }}">
													<option> Choose State </option>
													<option>...</option>
												</select>
												@error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="zip">Zip</label>
												<input type="text" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" value="{{ old('zip') ?? $userprofile->postcode }}">
												@error('zip')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="address">Home Address </label>
												<input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') ?? $userprofile->address }}">
												@error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>

										</div>
										
									
									</div>
									<div class="card-action mb-4">
											<button class="btn btn-success float-right">Update Profile</button>
											<button class="btn btn-danger float-left">Cancel</button>
										</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

@endsection
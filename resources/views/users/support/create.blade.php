@extends('layouts.dashboard')

@section('title', 'Send Support Message')

@section('content')
<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">New Request/Complaints</h4>
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
								<a href="#">Open Ticket</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Compose new message</div>
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

									<form method="POST" action="{{ route('support.store') }}">
									@csrf
										<div class="form-group">
											<label for="subject">Subject</label>
											<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Message Title">
												@error('subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
										</div>
										<div class="form-group">
											<label for="message">Message</label>
											<textarea class="form-control" id="message" name="message" rows="4"></textarea>
												@error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
										</div>
									

										<div class="card-action mb-4">
											<button type="submit" class="btn btn-success float-right">Send message</button>
											<button class="btn btn-danger float-left">Cancel</button>
										</div>

									</form>
									
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>

@endsection
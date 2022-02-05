@extends('layouts.dashboard')

@section('title', 'My Reviews')

@section('content')

            <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Leave a Review</h4>
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
								<a href="#">New Review</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Send us a review</div>
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

									<form method="POST" action="{{ route ('review.store') }}">
									@csrf
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
												@error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
										</div>
										<div class="form-group">
											<label for="subject">Job Title</label>
											<input type="text" class="form-control" id="title" name="title" value="{{ old('name') }}" placeholder="Enter your job title">
												@error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
										</div>
										<div class="form-group">
											<label for="comment">Message</label>
											<textarea class="form-control" id="comment" name="comment" value="{{ old('name') }}" rows="4"></textarea>
												@error('comment')
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
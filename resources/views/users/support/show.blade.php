@extends('layouts.dashboard')

@section('title', 'Show Support Message')

@section('content')

            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Ticket History</h4>
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
                                <a href="#">View Ticket</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item active">
                                <a href="#">View messages for <b>{{ $supports->subject }}</b></a>
                            </li>                           
                        </ul>
                    </div>
                    @if (session()->has('success_message'))
                            <div class="alert alert-success mb-6">
                                <strong>{{session()->get('success_message')}}</strong>
                            </div>
      					@endif

                        @if (count($errors) > 0 )
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="card">
                        <div class="card-body">
						

                            <div class="conversations-body">
								<div class="conversations-content bg-white">
									<div class="message-content-wrapper">
										<div class="message message-in">
											<div class="avatar avatar-sm">
												<img src="{{ profileImage($userprofile->avatar) }}" alt="profile picture" class="avatar-img rounded-circle border border-white">
											</div>
											<div class="message-body">
												<div class="message-content">
													<div class="name">{{ $user->name }}</div>
													<div class="content">{{ $supports->message }}</div>
												</div>
												<div class="date">{{ $supports->created_at->diffForHumans() }}</div>
											</div>
										</div>
									</div>
									@foreach ($discussions as $discusion)
									@if ($discusion->type == 0)
									<div class="message-content-wrapper">
										<div class="message message-in">
											<div class="avatar avatar-sm">
												<img src="{{ profileImage($userprofile->avatar) }}" alt="profile picture" class="avatar-img rounded-circle border border-white">
											</div>
											<div class="message-body">
												<div class="message-content">
													<div class="name">{{ $user->name }}</div>
													<div class="content">{!! $discusion->message !!}</div>
												</div>
												<div class="date">{{ $discusion->created_at->diffForHumans() }}</div>
											</div>
										</div>
									</div>
									
									@elseif ($discusion->type == 1)
									<div class="message-content-wrapper">
										<div class="message message-out">
											<div class="message-body">
												<div class="message-content">
													<div class="content">
													{!! $discusion->message !!}
													</div>
												</div>
												<div class="date">{{ $discusion->created_at->diffForHumans() }}</div>
											</div>
										</div>
									</div>
									@endif
									@endforeach
								</div>
                            </div>
							<form action="{{ route('support.update', $supports->ticket ) }}" method="POST">
							@csrf
								<div class="messages-form">
									<div class="messages-form-control">
										<input type="text" name="message" id="message" placeholder="Type here" class="form-control input-pill input-solid message-input">
									</div>
									<div class="messages-form-tool">
										<button type="submit" class="attachment">
											<i class="flaticon-message"></i>
										</button>
									</div>
								</div>
							</form>





                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">                             
    

                            
                                    
                                
                                

                            
                        </div>
                    </div>
                            



                </div>
            </div>   
           
            

@endsection
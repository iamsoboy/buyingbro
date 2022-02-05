@extends('layouts.dashboard')

@section('title', 'My Account')

@section('content')
<!-- Page Inner -->
<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>

						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-coins text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Revenue</p>
												<h4 class="card-title">{{ currency($userprofile->main_balance) }} </h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-credit-card text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Deposit Balance</p>
												<h4 class="card-title">{{ currency($userprofile->deposit_balance) }}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-analytics text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Withdrawal</p>
												<h4 class="card-title">{{ count($withdrawals) }}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-alarm-1 text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Orders</p>
												<h4 class="card-title">{{ count($orders)}}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Color -->


					<div class="row">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-header">
									<div class="card-title">Feed Activity</div>
								</div>
								<div class="card-body">
									<ol class="activity-feed">
                                        @forelse($getorders as $listorder)
										<li class="feed-item feed-item-secondary">
											<time class="date" datetime="9-25">{{$listorder->created_at->toDayDateTimeString()}}</time>
                                            @foreach($listorder->products as $products)
											<span class="text">{{ $products->name }} <a href="#">{{ currency($products->price) }}</a></span>
                                            @endforeach
										</li>
                                        @empty
										<li class="feed-item feed-item-danger">
											<time class="date" datetime="9-24">{{now()->format('l jS \\of F Y')}}</time>
											<span class="text">You have not made any orders yet.<a href="{{route('shop.index')}}">"Shop Now"</a></span>
										</li>
                                        @endforelse
									</ol>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Support Tickets</div>x
									</div>
								</div>
								<div class="card-body">
                                    @forelse($supports as $support)
									<div class="d-flex">
										<div class="avatar avatar-online">
											<span class="avatar-title rounded-circle border border-white bg-info">{{$user->name}}</span>
										</div>
										<div class="flex-1 ml-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">{{$support->subject}}
                                                @if($support->status == 'Closed')
                                                    <span class="text-warning pl-3">closed</span>
                                                @elseif($support->status == 'Active')
                                                    <span class="text-success pl-3">active</span>
                                                @else
                                                    <span class="text-warning pl-3">pending</span>
                                                @endif
                                            </h6>
											<span class="text-muted">{!! \Illuminate\Support\Str::limit($support->message, 90) !!}</span>
										</div>
										<div class="float-right pt-1">
											<small class="text-muted">{{$support->created_at}}</small>
										</div>
									</div>
									<div class="separator-dashed"></div>
                                    @empty
									<div class="d-flex">
										<div class="avatar avatar-offline">
											<span class="avatar-title rounded-circle border border-white bg-secondary"></span>
										</div>
										<div class="flex-1 ml-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1">{{$user->name}}</h6>
											<span class="text-muted">No New Support Ticket</span>
										</div>
									</div>
									<div class="separator-dashed"></div>
                                    @endforelse
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- End Page Inner -->
<script>
function updateCurrency (){
	var image = document.getElementById('flags');
	var query = window.location.search;
	var urlParams = new URLSearchParams(query);
	var element = urlParams.get('currency');
	//console.log(element);
	if (element == 'ngn') {
		image.src = "{{ asset('assets/img/flags/ng.png')}}";
	} else if (element == 'gbp'){
		image.src = "{{ asset('assets/img/flags/gb.png')}}";
	} else if (element == 'usd'){
		image.src = "{{ asset('assets/img/flags/us.png')}}";
	} else if (element == 'eur') {
		image.src = "{{ asset('assets/img/flags/europeanunion.png')}}";
	}
	updateCurrency = function(){}
}
</script>
@endsection

@extends('layouts.dashboard')

@section('title', 'Sell Gift Card')

@section('content')

<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4>
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
								<a href="#">Sell your Gift Cards</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">

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
								<div class="card-header">
									<div class="card-title">Upload Gift Card </div>

								</div>
								<form action ="{{ route('sell.store') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="card-body">
									<div class="row">

											<div class="col-lg-6 col-sm-12">
											<label class="form-label">Card Front View</label>
												<input type="file" name="front" class="dropify" data-height="180">
											</div>

											<div class="col-lg-6 col-sm-12">
											<label class="form-label">Card Rear View</label>
												<input type="file" name="back" class="dropify" data-height="180">
											</div>


										<div class="col-12">

											<div class="form-group">
												<label for="documenttype">Select Giftcard Type</label>
												<select class="form-control" id="type" name="type">
												@foreach ($availableCards as $card)
                                                        <option value="{{$card->name}}">{{$card->name}} - You get: {{$card->percentage}}%</option>
												@endforeach
												</select>
                                                <small>hello</small>
												@error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="cardvalue">Enter Card Value/Amount</label>
												<small id="cardvalue" class="form-text text-muted">Please note that entering amount higher that the uploaded gift card will result to your transaction being marked as fraud.</small>
												<input type="text" value="{{ old('value') }}" class="form-control" id="value" name="value" placeholder="Enter Gift Card Value">
												@error('value')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="description">Enter Card Details (Optional)</label>
												<small id="description" class="form-text text-muted">Please enter details of the uploaded gift card (PIN), for clearity.</small>
												<input type="text" value="{{ old('description') }}"  class="form-control" id="description" name="description" placeholder="Enter Gift Card Information">
												@error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>

										</div>



									</div>
									<div class="card-action mb-4">
											<button type="submit" class="btn btn-success float-right">Sell Gift Card</button>
										</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- JS Files -->

@if (session()->has('success'))
							<script type="text/javascript">
							$.notify({
								// options
								message: 'Hello Word'
							},{
								// settings
								type: 'danger'
							});
							</script>
							@endif


<script src="{{ asset ('assets/plugins/dist/js/jquery.min.js')}}"></script>
<script type="text/javascript">
				$(document).ready(function(){
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a clear image of your giftcard here or click to upload. <b><br>Ensure to upload a clear image showing all the needed numbers and codes on the gift card because blurry or unclear image will not be processed</b>',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (2M max).'
                }
            });
            });
        </script>
@endsection

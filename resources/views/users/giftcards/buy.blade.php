@extends('layouts.dashboard')

@section('title', 'Buy Gift Card')

@section('content')
    <div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Buy Gift Cards</h4>
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
								<a href="#">Buy Gift Cards</a>
							</li>							
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Buy Gift Card</div>
								</div>
									<div class="card-body">

										<div class="col-12">

											<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
											<div class="row row-demo-grid">
												<div class="col-sm-6 col-md-3">
													<div class="card">
														<div class="card-body"><code>col-sm-6 col-md-3</code></div>
													</div>
												</div>
												<div class="col-sm-6 col-md-3">
													<div class="card">
														<div class="card-body"><code>col-sm-6 col-md-3</code></div>
													</div>
												</div>
												<div class="col-sm-6 col-md-3">
													<div class="card">
														<div class="card-body"><code>col-sm-6 col-md-3</code></div>
													</div>
												</div>
												<div class="col-sm-6 col-md-3">
													<div class="card">
														<div class="card-body"><code>col-sm-6 col-md-3</code></div>
													</div>
												</div>
											</div>

											<div class="card-header">
												<div class="card-title">Available Fund(s): &#8358 55 </div>
											</div>

											<div class="form-group">
												<label for="documenttype">Select Gift Card </label>
												<select class="form-control" id="documenttype">
													<option>Shoprite Gift Card</option>
													<option>Spar Gift Cards</option>
													<option>Ruff 'n' Tumbles</option>
												</select>
												@error('documenttype')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="cardvalue">Enter Amount</label>
												<input type="number" class="form-control" id="cardvalue" placeholder="Enter Gift Card Value">
												@error('cardvalue')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>
											<div class="form-group">
												<label for="delivery">Enter Delivery Details</label>
												<small id="delivery" class="form-text text-muted">Please note that there will be a service charge for home delivery of gift cards. You will be contacted by our customer's care representative to facilitate home delivery if requested.</small>
												<textarea class="form-control" id="delivery" placeholder="Enter Email Address or Home Address you want the Gift Card Delivered" rows="6"> </textarea>
												@error('delivery')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            	@enderror
											</div>											
											
										</div>
										<div class="card-action mb-4">
											<button type="submit" class="btn btn-success float-right">Buy Gift Card</button>
										</div>
										
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
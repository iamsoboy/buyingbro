@extends('layouts.dashboard')

@section('title', 'Verification')

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
								<a href="#">Verification</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Account Verification</div>
								</div>

                                @if($customers->isEmpty())

                                    <div class="alert alert-avatar alert-warning alert-dismissible">
                                        Your Account Has Not Been Verified Yet on {{setting('site.title')}}. Please Upload A Means Of Identification To Get Verified On {{setting('site.title')}} and become a bonafide member of the platform
                                    </div>

                                    <form action ="{{ route('kyc.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label">Identity Card Front View</label>
                                                    <input type="file" name="front" class="dropify" data-height="180">
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label">Identity Card Rear View</label>
                                                    <input type="file" name="back" class="dropify" data-height="180">
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="documenttype">Document Upload Type</label>
                                                        <select class="form-control" id="name" name="name">
                                                            <option>Voter's Card</option>
                                                            <option>Drivers' Licence</option>
                                                            <option>National Identity Card</option>
                                                            <option>International Passport</option>
                                                        </select>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cardnumber">Passport/Identity Card Number</label>
                                                        <input type="text" class="form-control" id="number" name="number" placeholder="Enter International Passport or Identity Card or Drivers' Licence Number">
                                                        @error('number')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Expiry Date</label>
                                                        <input type="text" class="form-control date-picker" id="expiry_date" name="expiry_date">
                                                        @error('expiry_date')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-action mb-4">
                                                <button type="submit" class="btn btn-success float-right">Verify Account</button>
                                                <button type="cancel" class="btn btn-danger float-left">Cancel Verification</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

								@foreach ($customers as $customer)
									@if($customer->status == 1)
										<div class="alert alert-avatar alert-success alert-dismissible">
										    Your Account Has Been Verified On Our System. You are now a verified member of {{setting('site.title')}}
										</div>
									@elseif($customer->status == 2)
									    <div class="alert alert-avatar alert-danger alert-dismissible">
												<span style="color:red">Your Verification Failed.</span> Account Has Not Been Verified Yet on {{setting('site.title')}}. Please Upload A Means Of Identification To Get Verified On {{setting('site.title')}} and become a bonafide member of the platform
										</div>
										<form action ="{{ route('kyc.update') }}" method="post" enctype="multipart/form-data">
                                            @method('patch')
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                        <div class="col-lg-6 col-sm-12">
                                                        <label class="form-label">Identity Card Front View</label>
                                                            <input type="file" name="front" class="dropify" data-height="180">
                                                        </div>

                                                        <div class="col-lg-6 col-sm-12">
                                                        <label class="form-label">Identity Card Rear View</label>
                                                            <input type="file" name="back" class="dropify" data-height="180">
                                                        </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="documenttype">Document Upload Type</label>
                                                            <select class="form-control" id="name" name="name">
                                                                <option>Voter's Card</option>
                                                                <option>Drivers' Licence</option>
                                                                <option>National Identity Card</option>
                                                                <option>International Passport</option>
                                                            </select>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cardnumber">Passport/Identity Card Number</label>
                                                            <input type="text" class="form-control" id="number" name="number" placeholder="Enter International Passport or Identity Card or Drivers' Licence Number">
                                                            @error('number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Expiry Date</label>
                                                            <input type="text" class="datepicker form-control" data-date-format="dd/mm/yyyy" id="datepicker" name="expiry_date">
                                                            @error('expiry_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="card-action mb-4">
                                                        <button type="submit" class="btn btn-success float-right">Verify Account</button>
                                                        <button type="cancel" class="btn btn-danger float-left">Cancel Verification</button>
                                                    </div>
                                            </div>
								        </form>

									@else
										<div class="alert alert-avatar alert-info alert-dismissible">
										You Have Uploaded A Verification Document On {{setting('site.title')}}. Please Wait While We Verify Your Uploaded Document.
										</div>
									@endif
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript">
$('.datepicker').datepicker();
</script>

<script src="{{ asset ('assets/plugins/dist/js/jquery.min.js')}}"></script>
<script type="text/javascript">
				$(document).ready(function(){
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a clear image of your Identification Document here or click to upload. <b><br>Ensure to upload a clear image showing all the needed identifcation parameters because blurry or unclear image will not be processed</b>',
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

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ profileImage($userprofile->avatar) }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
								{{ $user->name }}
										<span class="user-level">
										@if($user->active == 0)
										<span class="text-warning">UNVERIFIED</span>
										@elseif($user->active == 1)
										<span class="text-success">VERIFIED</span>
										@endif
										</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
							<a href="{{route ('index')}}">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item {{ Request::is('user/giftcard*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#giftcard" class="collapsed" aria-expanded="false">
								<i class="fas fa-gift"></i>
								<p>Sell Gift Cards</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="giftcard">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ Request::is('user/giftcard/sell') ? 'active' : '' }}">
										<a href="{{route ('sell.create')}}">
											<span class="sub-item">Sell your gift card(s)</span>
										</a>
									</li>
									<!--<li>
										<a href="{{route ('buy.create')}}">
											<span class="sub-item">Buy your gift card(s)</span>
										</a>
									</li>-->
									<li class="nav-item {{ Request::is('user/giftcard/sell-history*') ? 'active' : '' }}">
										<a href="{{ route ('sellhistory.show', ['id'=> $user->id])}}">
											<span class="sub-item">Sales Archive</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item {{ Request::is('user/orders*') ? 'active' : '' }}">
							<a href="{{ route ('orders.show', ['id'=> $user->id]) }}">
								<i class="fas fa-box-open"></i>
								<p>My Orders</p>
							</a>
						</li>
						<!--<li class="nav-item {{ Request::is('user/crypto/*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#bitcoin" class="collapsed" aria-expanded="false">
								<i class="fab fa-bitcoin"></i>
								<p>Cryptocurrency</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="bitcoin">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route ('sellcrypto.create')}}">
											<span class="sub-item">Sell your cryptocurrency</span>
										</a>
									</li>
									<li>
										<a href="{{route ('buycrypto.create')}}">
											<span class="sub-item">Buy your cryptocurrency</span>
										</a>
									</li>
									<li>
										<a href="{{route ('cryptosellhistory.create')}}">
											<span class="sub-item">Sales Archive</span>
										</a>
									</li>
									<li>
										<a href="{{route ('cryptobuyshistory.create')}}">
											<span class="sub-item">Purchased Archive</span>
										</a>
									</li>
								</ul>
							</div>
						</li> -->
						<li class="nav-item {{ Request::is('user/deposit*') ? 'active' : '' }} {{ Request::is('user/deposit-history*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#wallet" class="collapsed" aria-expanded="false">
								<i class="fas fa-wallet"></i>
								<p>Fund Wallet</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="wallet">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ Request::is('user/deposit') ? 'active' : '' }}">
										<a href="{{route ('deposit.create')}}">
											<span class="sub-item">Deposit Fund</span>
										</a>
									</li>
									<li class="nav-item {{ Request::is('user/deposit-history*') ? 'active' : '' }}">
										<a href="{{route ('deposithistory.show',  ['id'=> $user->id])}}">
											<span class="sub-item">Deposit Archive</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item {{ Request::is('user/withdraw*') ? 'active' : '' }} {{ Request::is('user/withdraw-history*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#withdraw" class="collapsed" aria-expanded="false">
								<i class="fas fa-piggy-bank"></i>
								<p>Withdraw Fund</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="withdraw">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ Request::is('user/withdraw') ? 'active' : '' }}">
										<a href="{{route ('withdraw.create')}}">
											<span class="sub-item">New Withdrawals</span>
										</a>
									</li>
									<li class="nav-item {{ Request::is('user/withdraw-history*') ? 'active' : '' }}">
										<a href="{{ route ('withdraw.show', ['id'=> $user->id])}}">
											<span class="sub-item">Withdrawals Archive</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item {{ Request::is('user/profile') ? 'active' : '' }}">
							<a href="{{route ('profile.index')}}">
								<i class="fas fa-user-cog"></i>
								<p>My Profile</p>
							</a>
						</li>
						<!--<li class="nav-item">
							<a data-toggle="collapse" href="#profile" class="collapsed" aria-expanded="false">
								<i class="fas fa-user-cog"></i>
								<p>My Profile</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="profile">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route ('profile.index')}}">
											<span class="sub-item">View Profile</span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Edit Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</li> -->
						<li class="nav-item {{ Request::is('user/kyc') ? 'active' : '' }}">
							<a href="{{route ('kyc.create')}}">
								<i class="fas fa-fingerprint"></i>
								<p>Verification</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Messages</h4>
						</li>
						<li class="nav-item {{ Request::is('user/support*') ? 'active' : '' }} {{ Request::is('user/show-ticket*') ? 'active' : '' }}  {{ Request::is('user/send-ticket*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#ticket">
								<i class="fas fa-envelope-open"></i>
								<p>Support</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="ticket">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ Request::is('user/send-ticket*') ? 'active' : '' }}">
										<a href="{{route ('support.create')}}">
											<span class="sub-item">Open Ticket(s)</span>
										</a>
									</li>
									<li class="nav-item {{ Request::is('user/support*') ? 'active' : '' }} {{ Request::is('user/show-ticket*') ? 'active' : '' }}">
										<a href="{{route ('support.index')}}">
											<span class="sub-item">Ticket(s) Archive</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item {{ Request::is('user/review') ? 'active' : '' }}">
							<a href="{{route ('review.create')}}">
								<i class="fas fa-question-circle"></i>
								<p>Leave a Review</p>
							</a>
						</li>
						

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
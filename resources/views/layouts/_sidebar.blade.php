<div class="sidebar">

			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">Administrator</span>
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
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
							<a href="{{ route('home') }}">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						<li class="nav-item {{ Route::is('mapel.index') ? 'active' : '' }}">
							<a href="{{ route('mapel.index') }}">
								<i class="fas fa-tags"></i>
								<p>Mata Pelajaran</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('kelas.index') ? 'active' : '' }}">
							<a href="{{ route('kelas.index') }}">
								<i class="fas fa-columns"></i>
								<p>Kelas</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('siswa.index') ? 'active' : '' }}">
							<a href="{{ route('siswa.index') }}">
								<i class="fas fa-users"></i>
								<p>Siswa</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('soal.index') ? 'active' : '' }}">
							<a href="{{ route('soal.index') }}">
								<i class="fas fa-file-alt"></i>
								<p>Soal</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('paket-soal.index') ? 'active' : '' }}">
							<a href="{{ route('paket-soal.index') }}">
								<i class="fas fa-folder"></i>
								<p>Paket Soal</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('ujian.index') ? 'active' : '' }}">
							<a href="{{ route('ujian.index') }}">
								<i class="fas fa-puzzle-piece"></i>
								<p>Ujian</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('ujian.riwayat') ? 'active' : '' }}">
							<a href="{{ route('ujian.riwayat') }}">
								<i class="fas fa-archive"></i>
								<p>Riwayat Ujian</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('pengaturan.index') ? 'active' : '' }}">
							<a href="{{ route('pengaturan.index') }}">
								<i class="fas fa-cog"></i>
								<p>Pengaturan</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
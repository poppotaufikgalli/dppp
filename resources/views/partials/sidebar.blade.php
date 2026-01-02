<!-- Sidebar -->
<ul class="navbar-nav bg-accent sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
	<div class="d-flex align-items-center gap-2 px-1 pt-3">
		<a href="{{route('dashboard')}}" class="text-decoration-none d-flex">
			<img id="dp3-logo" src="{{asset('storage/images/logo-dp3.png')}}" alt="Logo DPPP" height="50">
		</a>
	</div>

	<!-- Divider -->
	<hr class="sidebar-divider my-1">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
		<a class="nav-link py-2 d-flex gap-1" href="{{route('dashboard')}}">
			<i class="bi bi-columns-gap"></i>
			<span>Dashboard</span>
		</a>
	</li>

	@php($lsAkses = json_decode(Auth::user()->group?->lsakses))
	@php($menu = json_decode($lsAkses?->menu))
	
	@if(isset($menu->user))
		<li class="nav-item {{ Request::routeIs('user') || Request::routeIs('user.*')? 'active' : '' }}">
			<a class="nav-link py-2 d-flex gap-1" href="{{route('user')}}">
				<i class="bi bi-person"></i>
				<span>User</span>
				
			</a>
		</li>
	@endif
	@if(isset($menu->group))
		<li class="nav-item {{ Request::routeIs('group') || Request::routeIs('group.*') ? 'active' : '' }}">
			<a class="nav-link py-2 d-flex gap-1" href="{{route('group')}}">
				<i class="bi bi-people-fill"></i>
				<span>Group dan Hak Akses</span>
			</a>
		</li>
	@endif
	@if(isset($menu->menu))
		<li class="nav-item {{ Request::routeIs('menu') || Request::routeIs('menu.*') ? 'active' : '' }}">
			<a class="nav-link py-2 d-flex gap-1" href="{{route('menu')}}">
				<i class="bi bi-layers"></i>
				<span>Menu</span>
			</a>
		</li>
	@endif

	<hr class="sidebar-divider my-1">

	<div class="sidebar-heading">
		Konten
	</div>

	@php($konten = json_decode($lsAkses?->kontenakses, true))
	@foreach($kontens as $key => $value)
		@if(isset($konten) && array_key_exists($key, $konten))
		<li class="nav-item {{ Request::routeIs($key) || Request::routeIs($key.'.*') ? 'active' : '' }}">
			<a class="nav-link py-2 d-flex gap-1" href="{{route($key, ['publish' => 'A'])}} ">
				<i class="bi bi-files"></i>
				<span>{{ucwords($value)}}</span>
			</a>
		</li>
		@endif
	@endforeach
</ul>
<!-- End of Sidebar -->
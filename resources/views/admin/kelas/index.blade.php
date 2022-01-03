<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Kelas - Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<!-- <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" /> -->
		<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		@include('admin/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('admin/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('adminhome')}}">Home</a>
							</li>
							<li>
								<a href="{{route('kelas')}}">Kelas</a>
							</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-header">
						<h1>
							Kelas
							<small>
								<a href="{{route('insert.kelas')}}" class="btn btn-xs btn-info">
									Tambah 
								</a>
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								<div class="table-responsive" >
									<table id="simple-table" class="table  table-bordered table-hover">
										<thead>
											<tr>
												<th>NO</th>
												<th>Nama Kelas</th>
												<th>Wali Kelas</th>
												<th></th>
											</tr>
										</thead>

										<tbody>
											@foreach($kelas as $k)
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $k->nama_kelas }}</td>
												<td>{{ $k->nama }}</td>
												<td>
													<div class="hidden-sm hidden-xs btn-group">
														<a href="{{ route('siswa', $k->k_id) }}" class="btn btn-xs btn-info">
															Siswa
														</a>

														<a href="{{route('edit.kelas',$k->k_id)}}" class="btn btn-xs btn-success">
															<i class="ace-icon fa fa-pencil bigger-120"></i>
														</a>

														<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.kelas',$k->k_id)}}" class="btn btn-xs btn-danger">
															<i class="ace-icon fa fa-trash bigger-120"></i>
														</a>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<!-- <table id="simple-table" class="table  table-bordered table-hover">
									<thead>
										<tr>
											<th>NO</th>
											<th>Nama Kelas</th>
											<th>Wali Kelas</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($kelas as $k)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $k->nama_kelas }}</td>
											<td>{{ $k->nama }}</td>
											<td>
												<div class="hidden-sm hidden-xs btn-group">
													<a href="{{ route('siswa', $k->k_id) }}" class="btn btn-xs btn-info">
														Siswa
													</a>

													<a href="{{route('edit.kelas',$k->k_id)}}" class="btn btn-xs btn-success">
														<i class="ace-icon fa fa-pencil bigger-120"></i>
													</a>

													<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.kelas',$k->k_id)}}" class="btn btn-xs btn-danger">
														<i class="ace-icon fa fa-trash bigger-120"></i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table> -->								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('admin/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ asset('assets/js/jquery-2.1.4.min.js')}}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src={{ asset('assets/js/jquery.mobile.custom.min.js')}} >"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

		<!-- page specific plugin scripts -->
		<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.flash.min.js')}} "></script>
		<script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>
		<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

		<!-- ace scripts -->
		<script src="{{ asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{ asset('assets/js/ace.min.js')}}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">

		</script>
	</body>
</html>

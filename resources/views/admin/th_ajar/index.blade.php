<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tahun Ajaran - Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
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
								<a href="#">KH</a>
							</li>
							<li>
								<a href="{{route('th_ajar')}}">Penguji KH</a>
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

					<div class="page-content">
						<div class="row">
							<div class="page-header">
								<h1>
									Jenis Kartu Hijau
									<small>
										<a href="{{ route('insert.th_ajar') }}" class="btn btn-xs btn-info">
											Tambah 
										</a>
									</small>
								</h1>
							</div><!-- /.page-header -->
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								{{ csrf_field() }}
					            <table id="editable" class="table table-bordered table-striped">
					              <thead>
					                <tr>
					                  <th>ID</th>
					                  <th>Tahun Ajaran</th>
					                  <th>Semester</th>
					                  <th></th>
					                </tr>
					              </thead>
					              <tbody>
					                @foreach($th_ajar as $row)
					                <tr>
					                  <td>{{ $row->ta_id }}</td>
					                  <td>{{ $row->th_ajaran }}</td>
					                  <td>{{ $row->smt }}</td>
					                  <td>
					                  	<a href="#" class="btn btn-xs btn-success">
											Ibadah Amaliyah 
										</a>
										<a href="#" class="btn btn-xs btn-success">
											Bhs Inggris 
										</a>
					                    <a href="#" class="btn btn-xs btn-success">
											Bhs Arab 
										</a>
										<a href="#" class="btn btn-xs btn-success">
											Hafalan Surat Pendek 
										</a>
										<a href="#" class="btn btn-xs btn-success">
											Dzikrul Ghofilin 
										</a>
					                  </td>
					                </tr>
					                @endforeach
					              </tbody>
					            </table>
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
		<script src="{{ asset('assets/js/jquery.tabledit.js')}}"></script>
		<script src="{{ asset('assets/js/jquery.tabledit.min.js')}}"></script>
	
		<!-- ace scripts -->
		<script src="{{ asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{ asset('assets/js/ace.min.js')}}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
		$(document).ready(function(){

		  $.ajaxSetup({
		    headers:{
		      'X-CSRF-Token' : $("input[name=_token]").val()
		    }
		  });

		  $('#editable').Tabledit({
		    url:'{{ route("action.thajar") }}',
		    dataType:"json",
		    columns:{
		      identifier:[0, 'ta_id'],
		      editable:[[1, 'th_ajaran'],[2, 'smt']]
		    },
		    deleteButton:true,
		    restoreButton:false,
		    onSuccess:function(data, textStatus, jqXHR)
		    {
		      if(data.action == 'delete')
		      {
		        $('#'+data.ta_id).remove();
		      }
		    }
		  });
		});  
		</script>
	</body>
</html>

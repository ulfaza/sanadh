<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Rekapitulasi KH - Guru</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('guru/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('guru/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('guru/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('guruhome')}}">Home</a>
							</li>
							<li>
								<a href="{{route('kh.guru')}}">KH</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="row">
							<div class="page-header">
								<h4>
									Rekapitulasi Kartu Hijau <br> <br>
									@foreach($ujikh as $u)
									{{ $u->tingkat }} {{ $u->k_nama }}	<br>
									{{ $u->th_ajaran }} {{ $u->smt }} <br>
									{{ $u->kh_nama }}
									@endforeach
								</h4>
							</div><!-- /.page-header -->
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								{{ csrf_field() }}
								<div class="table-responsive">
						            <table id="editable" class="table table-bordered table-striped">
						              <thead>
						                <tr>
						                  <th width="5%">ID</th>
						                  <th width="5%">NIS</th>
						                  <th width="10%">NISN</th>
						                  <th width="20%">Nama Siswa</th>
						                  @foreach($kh as $khs)
						                  <th width="10%">
						                  	{{ $khs->aspek1 }}
						                  	<br>
						                  	Max: {{ $khs->max_a1 }}
						                  </th>
						                  <th width="10%">
						                  	{{ $khs->aspek2 }}
						                  	<br>
						                  	Max: {{ $khs->max_a2 }}
						                  </th>
						                  <th width="10%">
						                  	{{ $khs->aspek3 }}
						                  	<br>
						                  	Max: {{ $khs->max_a3 }}
						                  </th>
						                  <th width="10%">
						                  	{{ $khs->aspek4 }}
						                  	<br>
						                  	Max: {{ $khs->max_a4 }}
						                  </th>
						                  @endforeach
						                  <th width="10%">Total</th>
						                  <th width="5%">Kriteria</th>
						                </tr>
						              </thead>
						              <tbody>
						                @foreach($rekapkh as $row)
						                <tr>
						                  <td>{{ $row->r_id }}</td>
						                  <td>{{ $row->nis }}</td>
						                  <td>{{ $row->nisn }}</td>
						                  <td>{{ $row->s_nama }}</td>
						                  <td class="cal">{{ $row->nilai_a1 }}</td>
						                  <td class="cal">{{ $row->nilai_a2 }}</td>
						                  <td class="cal">{{ $row->nilai_a3 }}</td>
						                  <td class="cal">{{ $row->nilai_a4 }}</td>
						                  <td><input type="text" class="total" name="total" value="{{ $row->total }}" readonly="true"> </td>
						                  <td><input type="text" class="kriteria" name="kriteria" readonly="true"> </td>
						                </tr>
						                @endforeach
						              </tbody>
						            </table>
					        	</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('guru/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('guru/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
		$(document).ready(function(){

		  $.ajaxSetup({
		    headers:{
		      'X-CSRF-Token' : $("input[name=_token]").val()
		    }
		  });

		  $('#editable').Tabledit({
		    url:'{{ route("guru.rekap") }}',
		    dataType:"json",
		    columns:{
		      identifier:[0, 'r_id'],
		      editable:[[4, 'nilai_a1'],[5, 'nilai_a2'],[6, 'nilai_a3'],[7, 'nilai_a4']]
		    },
		    deleteButton:false,
		    restoreButton:false,
		    onSuccess:function(data, textStatus, jqXHR)
		    {
		      if(data.action == 'delete')
		      {
		        $('#'+data.r_id).remove();
		      }
		    }
		  });

		  var $tblrows = $("#editable tbody tr");
		 	$tblrows.each(function (index) {
			    var $tblrow = $(this);

				$tblrow.find('.cal').on('change', function () {
	 
					var a1 = $tblrow.find("[name=nilai_a1]").val();
					var a2 = $tblrow.find("[name=nilai_a2]").val();
					var a3 = $tblrow.find("[name=nilai_a3]").val();
					var a4 = $tblrow.find("[name=nilai_a4]").val();
					var sum = parseFloat(a1) + parseFloat(a2) + parseFloat(a3) + parseFloat(a4);

					if (!isNaN(sum)) {
					    $tblrow.find('.total').val(sum.toFixed(2));
					    if (sum >= 70) {
					    	$tblrow.find('.kriteria').val("TUNTAS");
					    }
					    else{
					    	$tblrow.find('.kriteria').val("TIDAK TUNTAS");
					    }
					}

				});			 	
			});
			
		}); 
		</script>
	</body>
</html>

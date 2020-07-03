@extends('master')
@section('titlepage')
	<title>Jawaban</title>
@endsection
@section('sidebar')
	<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/" class="nav-link ">
              <i class="nav-icon far fa-image"></i>
              <p>
                Table
              </p>
            </a>
           </li>
          <li class="nav-item">
            <a href="/data-tables" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Data-table
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{route('pertanyaan.index')}}" class="nav-link ">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pertanyaan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('jawaban.index')}}" class="nav-link active">
              <i class="nav-icon far fa-image"></i>
              <p>
                Jawaban
              </p>
            </a>
          </li>
         
        </ul>
    </nav>
@endsection

@section('title')
<h1 class="m-0 text-dark">Jawaban</h1> <br>
<h1><button name="btn_add" id="btn_add" class="btn btn-primary btn-sm">tambah jawaban</button></h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jawaban</li>
</ol>
@endsection
@section('content')

<div class="card">
      <div class="card-header">
        <h3 class="card-title">Jawaban</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      	<table id="tab_data" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Judul pertanyaan</th>
					<th>Jawaban </th>
					<th>Aksi</th>
				</tr>
			</thead>
			
		</table>
      </div>
</div>

<div id="createModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<span id="form_result"></span>
        <form method="post" id="add" class="form-horizontal" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label class="control-label col-md-4" >Pertanyaan : </label>
						<div class="col-md-8">
							<select class="form-control" id="pertanyaan" name="pertanyaan">
								@for($i=0; $i<= count($data)-1;$i++)
								<option value="{{$data[$i]->id}}">{{$data[$i]->isi}}</option>
								@endfor
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-4" >jawaban : </label>
						<div class="col-md-8">
							<input type="text" name="isi" id="isi" class="form-control" />
						</div>
					</div>

					<br />
					<div class="form-group">
						<input type="hidden" name="action" id="action" />						
						<input type="hidden" name="hidden_id" id="hidden_id" />
						<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="submit" />
					</div>
		</form>
      </div>
     
    </div>
  </div>
</div>

<div id="confirmModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Delete</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Apakah anda yakin akan menghapus data ini?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  $(function () {
    $("#tab_data").DataTable({
    	processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('jawaban.index') }}",
			},
			columns:[

			{
				data: 'judul',
				name: 'judul',
			},
			{
				data: 'jawaban',
				name: 'jawaban',
			},
			{
				data: 'action',
				name: 'action',
				orderable: false
			}
			]
    });
    $('#btn_add').click(function(){
			$('#createModal').modal('show');
			$('#name').val("");
			$('#form_result').hide();
			$('#createModal .modal-title').text("Tambah Jawaban");
			$('#action').val("tambah");
	});
	$('#add').on('submit',function(event){
		event.preventDefault();
		if($('#action').val() == 'tambah'){
				$.ajax({
					url:"{{route('jawaban.store')}}",
					method:"POST",
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					data: new FormData(this),
					success:function(data)
					{
						$('#form_result').show();
							if(data.errors)
							{

								html = '<div class="alert alert-danger">';
								for(var count = 0; count < data.errors.length; count++)
								{
									html += '<p>' + data.errors[count] + '</p>';
								}
								html += '</div>';
								$('#form_result').html(html);
							}
							if(data.success)
							{
								html = '<div class="alert alert-success">' + data.success + '</div>';
								setTimeout(function(){
									$('#createModal').modal('hide');

							},1000);
								$('#tab_data').DataTable().ajax.reload();
								toastr.success('Jawaban telah berhasil ditambahkan!', 'Success', {timeOut: 5000});
							}
							
					},
					error:function(xhr)
					{
						$('#form_result').show();

				 			html = '<div class="alert alert-danger">';
						 $.each(xhr.responseJSON.errors, function (key, item) 
				          {	
				          	html+='<p>' +item+'</p>';
				          });
				 			html += '</div>';
							$('#form_result').html(html);
								
					}//end error
				});
		}else{
			$.ajax({
					url:"{{route('jwb.update')}}",
					method:"POST",
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					data: new FormData(this),
					success:function(data)
					{
						$('#form_result').show();
						var html = '';
							if(data.errors)
							{

								html = '<div class="alert alert-danger">';
								for(var count = 0; count < data.errors.length; count++)
								{
									html += '<p>' + data.errors[count] + '</p>';
								}
								html += '</div>';
								$('#form_result').html(html);
							}
							if(data.success)
							{
								html = '<div class="alert alert-success">' + data.success + '</div>';
								setTimeout(function(){
									$('#createModal').modal('hide');

							},1000);
								$('#tab_data').DataTable().ajax.reload();
								toastr.success('jawaban telah berhasil diupdate!', 'Success', {timeOut: 5000});
							}
							
					},
					error:function(xhr)
					{
						$('#form_result').show();

				 			html = '<div class="alert alert-danger">';
						 $.each(xhr.responseJSON.errors, function (key, item) 
				          {	
				          	html+='<p>' +item+'</p>';
				          });
				 			html += '</div>';
							$('#form_result').html(html);
						
								
					}//end error
				});
		}

	});
	var id_table;
	$(document).on('click','.edit',function(){
		id_table = $(this).attr('id');
			$('#form_result').hide();
			$('#createModal').modal('show');
			$('#action').val("edit");
			$('.disp').hide();
			$('#createModal .modal-title').text("Edit jawaban");
			$.ajax({
				url:"/jawaban/"+id_table+"/edit",
				dataType:"json",
				success:function(html)
				{
					$('#pertanyaan').val(html.data.prt_id);
					$('#isi').val(html.data.isi);
					$('#hidden_id').val(html.data.id);
				}
			})	
		});

	$(document).on('click','.delete',function(){
			id_table = $(this).attr('id');
			$('#confirmModal').modal('show');
			$('#ok_button').text('OK');
		});
		$('#ok_button').click(function(){
			$.ajax({
				url:"jawaban/destroy/"+id_table,
				beforeSend:function(){
					$('#ok_button').text('Deleting...');
				},
				success:function(data)
				{
					setTimeout(function(){
						$('#confirmModal').modal('hide');
						$('#tab_data').DataTable().ajax.reload();
					}, 2000);
						toastr.success('jawaban telah berhasil dihapus!', 'Success', {timeOut: 5000});
				}
			})
		});
  });
</script>
@endpush	
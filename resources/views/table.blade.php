@extends ('master')
@section('titlepage')
<title>Table</title>

@endsection
@section('sidebar')
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link active">
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
            <a href="{{route('pertanyaan.index')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pertanyaan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('jawaban.index')}}" class="nav-link">
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
<h1 class="m-0 text-dark">Table</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">table</li>
</ol>
@endsection
@section('content')
<table class="table table-bordered">
  <thead>                  
    <tr>
      <th style="width: 10px">#</th>
      <th>Task</th>
      <th>Progress</th>
      <th style="width: 40px">Label</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1.</td>
      <td>Update software</td>
      <td>
        <div class="progress progress-xs">
          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
        </div>
      </td>
      <td><span class="badge bg-danger">55%</span></td>
    </tr>
    <tr>
      <td>2.</td>
      <td>Clean database</td>
      <td>
        <div class="progress progress-xs">
          <div class="progress-bar bg-warning" style="width: 70%"></div>
        </div>
      </td>
      <td><span class="badge bg-warning">70%</span></td>
    </tr>
    <tr>
      <td>3.</td>
      <td>Cron job running</td>
      <td>
        <div class="progress progress-xs progress-striped active">
          <div class="progress-bar bg-primary" style="width: 30%"></div>
        </div>
      </td>
      <td><span class="badge bg-primary">30%</span></td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Fix and squish bugs</td>
      <td>
        <div class="progress progress-xs progress-striped active">
          <div class="progress-bar bg-success" style="width: 90%"></div>
        </div>
      </td>
      <td><span class="badge bg-success">90%</span></td>
    </tr>
  </tbody>
</table>
@endsection
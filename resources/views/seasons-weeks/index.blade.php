@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>Seasons Weeks</div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                        @endif
                        <div class="row mb-3 ml-3" style="float: right;">
                            <a class="btn btn-lg btn-primary" href="{{ route('seasons-weeks.create') }}">Add Season Week</a>
                        </div>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Week Number</th>
                            <th>Season Name</th>
                            <th>Season Year</th>
                            <th colspan="2">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($weeks as $week)
                            <tr>
                              <td>{{ $week->id }}</td>
                              <td>{{ $week->title }}</td>
                              <td>{{ $week->week_number }}</td>
                              <td>{{ $week->season->name }}</td>
                              <td>{{ $week->season->year }}</td>
                              <td>
                                <a href="{{ url('/seasons-weeks/' . $week->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('seasons-weeks.destroy', $week->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection


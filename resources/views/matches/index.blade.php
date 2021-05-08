@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>Matches</div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                        @endif
                        <div class="row mb-3 ml-3" style="float: right;">
                            <a class="btn btn-lg btn-primary" href="{{ route('matches.create') }}">Add Match</a>
                        </div>
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Arabic Title</th>
                            <th>English Title</th>
                            <th>Arabic Description</th>
                            <th>English Description</th>
                            <th>Week Number</th>
                            <th>Image</th>
                            <th>Video</th>
                            <th colspan="2">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($matches as $match)
                            <tr>
                              <td>{{ $match->id }}</td>
                              <td>{{ $match->title['ar'] }}</td>
                              <td>{{ $match->title['en'] }}</td>
                              <td>{{ $match->description['ar'] }}</td>
                              <td>{{ $match->description['en'] }}</td>
                              <td>{{ $match->week->title}} - {{ $match->week->week_number }}</td>
                              <td><img style="width: 100px; height:100px" src="{{ asset($match->image) }}"></td>
                              <td>{{ $match->video }}</td>
                              <td>
                                <a href="{{ url('/matches/' . $match->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('matches.destroy', $match->id ) }}" method="POST">
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

@endsection


@section('javascript')

@endsection


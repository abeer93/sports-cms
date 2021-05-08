@extends('dashboard.base')

@section('content')
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>Season Week Form</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('seasons-weeks.update', $seasonsWeek->id) }}">
                            @csrf
                            @method('PUT')
                            <h1>Edit Season Week</h1>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                </div>
                                <input class="form-control" type="text" placeholder="title" name="title" value="{{ $seasonsWeek->title }}" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                                </div>
                                <input class="form-control" type="number" name="week_number" value="{{ $seasonsWeek->week_number }}" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                                </div>
                                <select class="form-control" id="seasons" name=season_id>
                                  <option>Select Season</option>
                                  @foreach($seasons as $season)
                                    <option value="{{$season->id}}" @if($seasonsWeek->season_id == $season->id) selected="selected" @endif>{{$season->name}} - {{$season->year}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
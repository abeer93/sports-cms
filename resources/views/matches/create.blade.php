@extends('dashboard.base')

@section('content')
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>Match Form</div>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('matches.store') }}">
                            @csrf
                            <h1>Add New Match</h1>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                </div>
                                <input class="form-control" type="text" placeholder="arabic title" name="title_ar" value="{{ old('title_ar') }}" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                </div>
                                <input class="form-control" type="text" placeholder="english title" name="title_en" value="{{ old('title_en') }}" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                </div>
                                <input class="form-control" type="text" placeholder="arabic description" name="description_ar" value="{{ old('description_ar') }}" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-user"></i>
                                </span>
                                </div>
                                <input class="form-control" type="text" placeholder="english description" name="description_en" value="{{ old('description_en') }}" required autofocus>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                                </div>
                                <select class="form-control" id="weeks" name=week_id>
                                  <option>Select Week</option>
                                  @foreach($weeks as $week)
                                    <option value="{{$week->id}}">{{$week->title}} - {{$week->week_number}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                                </div>
                                <input class="form-control" type="file" name="image">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                                </div>
                                <input class="form-control" type="url" name="video" value="{{ old('video') }}">
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
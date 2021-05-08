@extends('dashboard.base')

@section('content')
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>JSON API Documentation</div>
                    <div class="card-body">
                    <!-- ------------------------ -->
                    <div class="card">
                        <div class="card-header" style="background-color: #85ddb4;">
                            <i class="fa fa-align-justify"></i>
                            <button class="btn btn-success">Get</button>
                            <b>/api/matches/year</b>
                        </div>
                        <div class="card-body">
                            <b>List Matches Grouped By Year.</b>
                        </div>
                    </div>
                    <!-- ------------------------ -->
                    <div class="card">
                        <div class="card-header" style="background-color: #89cff0;">
                            <i class="fa fa-align-justify"></i>
                            <button class="btn btn-primary">Get</button>
                            <b>/api/matches</b>
                        </div>
                        <div class="card-body">
                            <b>List Matches filtered with week id or season year.</b>
                            <h3>Route Parameters</h3>
                            <ul>
                                <li><b>Week_id:</b> week id</li>
                                <li><b>year:</b> season year</li>
                            </ul>
                        </div>
                    </div>
                    <!-- ------------------------ -->
                    <div class="card">
                        <div class="card-header" style="background-color: #fdce94;">
                            <i class="fa fa-align-justify"></i>
                            <button class="btn btn-warning">Get</button>
                            <b>/api/matches/{id}</b>
                        </div>
                        <div class="card-body">
                            <b>Get match details.</b>
                            <h3>Route Parameters</h3>
                            <ul>
                                <li><b>id:</b> match id</li>
                            </ul>
                        </div>
                    </div>
                    <!-- ------------------------ -->
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
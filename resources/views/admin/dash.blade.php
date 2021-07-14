@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
      {{-- ROW 1: COUNT CARDS --}}
      <div class="row">
        {{-- USER COUNT CARD --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">person</i>
              </div>
              <p class="card-category">Users</p>
              <h3 class="card-title">{{$data['userCount']}}
              </h3>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>

        {{-- POSITION COUNT CARD --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">badge</i>
              </div>
              <p class="card-category">Position</p>
              <h3 class="card-title">{{$data['positionCount']}}</h3>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>

        {{-- SUBJECT COUNT CARD --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">subjects</i>
              </div>
              <p class="card-category">Subject</p>
              <h3 class="card-title">{{$data['subjectCount']}}</h3>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>

        {{-- TEAMS COUNT CARD --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">groups</i>
              </div>
              <p class="card-category">Teams</p>
              <h3 class="card-title">{{$data['teamCount']}}</h3>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>

      {{-- ROW 2: GRAPHS AND CHARTS --}}
      <div class="row">
        {{-- LINE GRAPH OF USER COUNT PER POSITION --}}
        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="positionsToUserChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Users per position</h4>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>

        {{-- LINE GRAPH OF USER COUNT PER SUBJECT --}}
        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="subjectsToUserChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Users per Subject</h4>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>

      {{-- ROW 3: GRAPH AND TABLE --}}
      <div class="row">
        {{-- LINE GRAPH OF CONNECTION REQUEST PER WEEK IN CURRENT MONTH --}}
        <div class="col-lg-6 col-md-12">
            <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="connectionsCountChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Connections per week</h4>
                  <p class="card-category">For the month of {{date('F')}}</p> 
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">info</i> Shows progress per week in a month
                  </div>
                </div>
            </div>
        </div>

        {{-- TABLE OF TEAMS AND MEMBER COUNT --}}
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Teams</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>ID</th>
                  <th>Team Name</th>
                  <th>Team Members</th>
                </thead>
                <tbody>
                    @foreach($data['teamMembers'] as $team)
                  <tr>
                    <td>{{$team->team_id}}</td>
                    <td>{{$team->team_name}}</td>
                    <td>{{$team->count}}</td>
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
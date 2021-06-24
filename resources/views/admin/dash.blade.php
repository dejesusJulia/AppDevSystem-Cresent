@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
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
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">subjects</i>
              </div>
              <p class="card-category">Subject</p>
              <h3 class="card-title">{{$data['subjectCount']}}</h3>
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">groups</i>
              </div>
              <p class="card-category">Teams</p>
              <h3 class="card-title">{{$data['teamCount']}}</h3>
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="positionsToUserChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Users per position</h4>
              <!-- <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p> -->
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="subjectsToUserChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Users per Subject</h4>
              <!-- <p class="card-category">Last Campaign Performance</p> -->
            </div>
            <div class="card-footer">
              <!-- <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
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
                    <i class="material-icons">info</i> Shows progress per week
                  </div>
                </div>
            </div>
        </div>
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
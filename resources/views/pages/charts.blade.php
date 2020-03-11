@extends('layouts.base')


@section('charts')


<div class="container-fluid d-flex-column mt-5">
    <div class="form-group w-100 selectdiv text-center">
        <select class="col-12 col-md-4 mt-5 form-control" id="year_selection">
            <option value="2020" selected>2020</option>
            <option value="2019" >2019</option>
            <option value="2018">2018</option>
        </select>
    </div>
    <div class="container-fluid mt-5 p-3">
    <div class="chart-container mt-5 p-3">
        <canvas id="messagesChart"></canvas>
    </div>
    <div class="chart-container mt-5 p-3">
        <canvas id="viewsChart"></canvas>
    </div>
    </div>
</div>


@endsection

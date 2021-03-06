@extends('layouts.admin')
@section('content')
    <style>
        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
    <div class="card">
        <div class="card-header">
            Test Detail
        </div>
        @include("admin.TestPerformed.partial_patient")
        @include("admin.TestPerformed.partial_report")
        <div class="col-md-12 mb-12 noprint">
            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
        </div>
        <br>
        <br>
    </div>

@endsection
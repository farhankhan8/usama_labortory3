@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Test Detail
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-12 mb-12"><h4>Basic</h4></div>

                <div class="col-md-3 mb-3">
                    <b>Category</b>
                </div>
                <div class="col-md-3 mb-3">
                    <p>{{ $availableTestId->category->Cname}}</p>
                </div>

                <div class="col-md-3 mb-3">
                    <b>Name</b>
                </div>
                <div class="col-md-3 mb-3">
                    <p> {{ $availableTestId->name ?? '' }}</p>
                </div>

                <div class="col-md-3 mb-3">
                    <b>Test Fee</b>
                </div>
                <div class="col-md-3 mb-3">
                    <p>{{ $availableTestId->testFee }}</p>
                </div>

                <div class="col-md-3 mb-3">
                    <b>Urgent Fee</b>
                </div>
                <div class="col-md-3 mb-3">
                    <p>{{ $availableTestId->urgentFee }}</p>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 mb-12"><h4>Report Items</h4></div>
                @php $y=1; @endphp
                @foreach($availableTestId->TestReportItems->where("status","active") as $TestReportItem)

                    <div class="col-md-12 mb-12 text-capitalize"><h4>{{$y}}. {{$TestReportItem->title}}</h4></div>
                    <div class="col-md-3 mb-3">
                        <b>Normal Range</b>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p>{{ $TestReportItem->initialNormalValue }}{{ $TestReportItem->unit ?? '' }}-{{ $TestReportItem->finalNormalValue }}{{ $TestReportItem->unit ?? '' }}</p>
                    </div>

                    <div class="col-md-3 mb-3">
                        <b>Critical Values</b>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p>< {{ $TestReportItem->firstCriticalValue }}{{ $TestReportItem->unit ?? '' }} & > {{ $TestReportItem->finalCriticalValue }}{{ $TestReportItem->unit ?? '' }}</p>
                    </div>
                    @php $y++; @endphp
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12 mb-12"><h4>Inventory Used</h4></div>
                @php $y=1; @endphp
                @foreach($availableTestId->available_test_inventories as $test_inventories)

                    <div class="col-md-12 mb-12"><h4>{{$y}}.</h4></div>
                    <div class="col-md-3 mb-3">
                        <b>Item</b>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p>{{ $test_inventories->inventory->inventoryName }}</p>
                    </div>

                    <div class="col-md-3 mb-3">
                        <b>Used</b>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p>{{ $test_inventories->itemUsed }}{{ $test_inventories->inventory->inventoryUnit }}</p>
                    </div>
                    @php $y++; @endphp
                @endforeach
                <div class="col-md-12 mb-12 text-right">
                    <a class="btn btn-primary" href="{{ route('available-tests') }}">
                        <button class="btn btn-primary">
                            Back
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
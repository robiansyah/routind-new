@extends('layouts.main')
@section('title', 'Performance')
@section('content')
    <div class="container-fluid pt-3" id="app">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title flex-grow-1">Performance {{ $category }}</h3>
                        <div style="width: 200px;">
                            <select name="category" id="category" class="form-control">
                                <option value="Brevet Pajak" {!! ($category=='Brevet Pajak') ? 'selected' : '' !!}>Brevet Pajak</option>
                                <option value="Accurate" {!! ($category=='Accurate') ? 'selected' : '' !!}>Accurate</option>
                                <option value="CTT" {!! ($category=='CTT') ? 'selected' : '' !!}>CTT</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <h4 class="p-1">Pelatihan</h4>
                        @php
                            $temp = 0;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered text-center m-0">
                                <thead>
                                <tr class="bg-light">
                                    <th>Year</th>
                                    @foreach($monthMap as $num => $name)
                                        <th>{{ $name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($returns as $year => $months)
                                    <tr>
                                        <td><strong>{{ $year }}</strong></td>
                                        @foreach($monthMap as $num => $name)
                                            @php
                                                // Access data using the integer key (1-12)
                                                
                                                $val = $months->has($num) ? $months[$num]->training : null;
                                                $colorClass = $val >= $temp ? 'bg-success' : 'bg-danger';
                                                $temp = $val;
                                            @endphp
                                            <td class="{{ $val !== null ? $colorClass : '' }}">
                                                {{ $val !== null ? $val : '' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h4 class="pt-4">Sertifikasi</h4>
                        @php
                            $temp = 0;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered text-center m-0">
                                <thead>
                                <tr class="bg-light">
                                    <th>Year</th>
                                    @foreach($monthMap as $num => $name)
                                        <th>{{ $name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($returns as $year => $months)
                                    <tr>
                                        <td><strong>{{ $year }}</strong></td>
                                        @foreach($monthMap as $num => $name)
                                            @php
                                                // Access data using the integer key (1-12)

                                                $val = $months->has($num) ? $months[$num]->certification : null;
                                                $colorClass = $val >= $temp ? 'bg-success' : 'bg-danger';
                                                $temp = $val;
                                            @endphp
                                            <td class="{{ $val !== null ? $colorClass : '' }}">
                                                {{ $val !== null ? $val : '' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h4 class="pt-4">Total (Pelatihan + Sertifikasi)</h4>
                        @php
                            $temp = 0;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered text-center m-0">
                                <thead>
                                <tr class="bg-light">
                                    <th>Year</th>
                                    @foreach($monthMap as $num => $name)
                                        <th>{{ $name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($returns as $year => $months)
                                    <tr>
                                        <td><strong>{{ $year }}</strong></td>
                                        @foreach($monthMap as $num => $name)
                                            @php
                                                // Access data using the integer key (1-12)

                                                $val = $months->has($num) ? $months[$num]->certification+$months[$num]->training : null;
                                                $colorClass = $val >= $temp ? 'bg-success' : 'bg-danger';
                                                $temp = $val;
                                            @endphp
                                            <td class="{{ $val !== null ? $colorClass : '' }}">
                                                {{ $val !== null ? $val : '' }}
                                            </td>
                                        @endforeach
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
@section('js')
    <script>
        $('#category').change(function() {
            var category = $('#category').val();
            window.location.replace('/admin/performance/create?category='+category);
        });
    </script>
@endsection
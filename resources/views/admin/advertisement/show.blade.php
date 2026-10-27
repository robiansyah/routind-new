@extends('layouts.main')
@section('title', 'Advertisement')
@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
    <div class="container-fluid pt-3" id="app">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Merchant</h4>
                        <form method="GET" action="{{ route('admin.advertisement.create') }}" accept-charset="UTF-8">
                            <div class="row float-md-right">
                                <div class="col-sm-10">
                                    <!-- Date range -->
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                          </span>
                                        </div>
                                        <input type="text" name="date" class="form-control float-right" value="{{ $date }}" id="reservation">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="submit" value="filter" class="btn btn-round btn-info float-md-right">
                                        <i class="zmdi zmdi-filter-list"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="200px">Kategori</th>
                                            <th>Biaya</th>
                                        </tr>
                                        @php($total = 0)
                                        @foreach($last as $item)
                                            <tr>
                                                <td>{{ $item->category }}</td>
                                                <td>@money($item->total_biaya)</td>
                                            </tr>
                                            @php($total += $item->total_biaya)
                                        @endforeach
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td><b>@money($total)</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="height: 250px;">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <canvas id="myDailyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        (function() {
            var date = "{{ $date }}";
            if(date==""){
                $('#reservation').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                });

                $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            }else{
                $('#reservation').daterangepicker();
            }

            // Menggunakan function self-invoking agar scope aman
            const initChart = () => {
                // --- LOGIKA BAR CHART (Data Harian) ---
                const barCtx = document.getElementById('myDailyChart');
                if (barCtx) {
                    new Chart(barCtx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($labels) !!},
                            datasets: [
                                { label: 'Brevet Pajak', data: {!! json_encode($dataBrevet) !!}, backgroundColor: '#0095E8' },
                                { label: 'Accurate', data: {!! json_encode($dataAccurate) !!}, backgroundColor: '#F1416C' }
                            ]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                }

                // --- LOGIKA PIE CHART (Data per Kategori dari $last) ---
                const pieCtx = document.getElementById('myPieChart');
                if (pieCtx) {
                    // Kita ambil label dan data dari variabel $last di Blade
                    const pieLabels = {!! json_encode($last->pluck('category')) !!};
                    const pieData = {!! json_encode($last->pluck('total_biaya')) !!};

                    new Chart(pieCtx, {
                        type: 'pie',
                        data: {
                            labels: pieLabels,
                            datasets: [{
                                data: pieData,
                                backgroundColor: ['#0095E8', '#F1416C', '#FFC700', '#7239EA'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            let value = Number(context.parsed) || 0; // Pastikan jadi angka

                                            // Ambil semua data dan pastikan semuanya angka
                                            let dataset = context.dataset.data;
                                            let total = dataset.reduce((acc, curr) => acc + Number(curr), 0);

                                            if (total === 0) return label + ': Rp 0 (0%)';

                                            let percentage = ((value / total) * 100).toFixed(1) + '%';

                                            return label + ': Rp ' + value.toLocaleString('id-ID') + ' (' + percentage + ')';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            };

            if (document.readyState === 'complete') {
                initChart();
            } else {
                window.addEventListener('load', initChart);
            }
        })();
    </script>
@endsection
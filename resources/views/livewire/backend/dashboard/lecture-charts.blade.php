<!-- Bar Charts -->
{{-- TODO: --}}
<div class="col-lg-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Grafic Absensi Dosen</h5>
            <div class="card-action-element ms-auto py-0">
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-calendar"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <canvas id="chartDummy" class="chartjs" data-height="400"></canvas>
        </div>
    </div>
    @push('scripts')
    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            // Set height according to their data-height
            const chartList = document.querySelectorAll('.chartjs');
            chartList.forEach(function(chartListItem) {
                chartListItem.height = chartListItem.dataset.height;
            });

            // Bar Chart
            const chartDummy = document.getElementById('chartDummy');
            if (chartDummy) {
                // Destroy existing chart instance if it exists
                if (chartDummy.chartInstance) {
                    chartDummy.chartInstance.destroy();
                }

                chartDummy.chartInstance = new Chart(chartDummy, {
                    type: 'bar'
                    , data: {
                        labels: [
                            '7/12', '8/12', '9/12', '10/12', '11/12', '12/12', '13/12'
                            , '14/12', '15/12', '16/12', '17/12', '18/12', '19/12'
                        ]
                        , datasets: [{
                            data: [275, 90, 190, 205, 125, 85, 55, 87, 127, 150, 230, 280, 190]
                            , backgroundColor: '#28dac6'
                            , borderColor: 'transparent'
                            , maxBarThickness: 15
                            , borderRadius: {
                                topRight: 15
                                , topLeft: 15
                            }
                        }]
                    }
                    , options: {
                        responsive: true
                        , maintainAspectRatio: false
                        , animation: {
                            duration: 500
                        }
                        , plugins: {
                            tooltip: {
                                borderWidth: 1
                            }
                            , legend: {
                                display: false
                            }
                        }
                        , scales: {
                            x: {
                                grid: {
                                    drawBorder: false
                                }
                            }
                            , y: {
                                min: 0
                                , max: 400
                                , grid: {
                                    drawBorder: false
                                }
                                , ticks: {
                                    stepSize: 100
                                }
                            }
                        }
                    }
                });
            }
        });

    </script>
    @endpush
</div>

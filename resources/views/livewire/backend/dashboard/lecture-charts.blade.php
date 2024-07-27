<!-- Bar Charts -->
{{-- TODO: --}}
<div class="col-lg-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">{{ $title }}</h5>
            <div class="card-action-element ms-auto py-0">
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-calendar"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="Livewire.dispatch('refreshChart', ['today'])">Hari Ini</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="Livewire.dispatch('refreshChart', ['yesterday'])">Kemarin</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="Livewire.dispatch('refreshChart', ['last7Days'])">7 Hari Terakhir</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="Livewire.dispatch('refreshChart', ['last30Days'])">30 Hari Terakhir</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="Livewire.dispatch('refreshChart', ['currentMonth'])">Bulan Ini</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="Livewire.dispatch('refreshChart', ['lastMonth'])">Bulan Lalu</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <canvas id="chartDummy" wire:ignore.self class="chartjs" data-height="400"></canvas>
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

            // Status mapping
            const statusMapping = {
                'H': 'Hadir'
                , 'S': 'Sakit'
                , 'I': 'Izin'
                , 'T': 'Terlambat'
                , 'A': 'Alpha'
            };

            // Prepare data for the chart
            function updateChart(attendances) {
                // Group by date and sum counts
                const groupedData = attendances.reduce((acc, attendance) => {
                    const status = statusMapping[attendance.status] || attendance.status;
                    if (!acc[status]) {
                        acc[status] = 0;
                    }
                    acc[status] += attendance.count || 1; // Assuming count is 1 if not provided
                    return acc;
                }, {});

                // Prepare labels and data for Chart.js
                const labels = Object.keys(groupedData);
                const data = Object.values(groupedData);

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
                            labels: labels
                            , datasets: [{
                                data: data
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
                                    , max: Math.max(...data) + 10
                                    , grid: {
                                        drawBorder: false
                                    }
                                    , ticks: {
                                        stepSize: 10
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // Initial chart load
            updateChart(@json($monthlyAttendances));

            // Listen for chart updates
            Livewire.on('chartUpdated', attendancesJson => {
                const attendances = JSON.parse(attendancesJson);
                updateChart(attendances);
            });
        });

    </script>
    @endpush

</div>

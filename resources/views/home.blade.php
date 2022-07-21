@extends('layouts.app')

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
    <div id="USERS" class="row">
        <div class="col-6">

        </div>
        <div class="col-6">
            <canvas id="Users" width="400" height="200"></canvas>
        </div>
    </div>

    <div id="DECISION" class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <p class="text-center h2 pb-3">Bảng thống kê thưởng - phạt</p>
            <canvas id="RewardAndDiscipline" width="400" height="200"></canvas>
        </div>
    </div>

    <div id="SALARY">
        <p class="text-center h2 pb-3">Bảng thống kê lương</p>
        <canvas id="SalaryChart" height="80px"></canvas>
    </div>

    <!-- javascript -->

    {{-- bảng thống kê lương --}}
    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var data_avg_salary = {{ Js::from($data_avg_salary) }};
        var data_max_salary = {{ Js::from($data_max_salary) }};
        var data_min_salary = {{ Js::from($data_min_salary) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Lương cao nhất',
                backgroundColor: 'rgb(52, 235, 183)',
                borderColor: 'rgb(52, 235, 183)',
                data: data_max_salary,
            }, {
                label: 'Lương thấp nhất',
                backgroundColor: 'rgb(3, 36, 252)',
                borderColor: 'rgb(3, 36, 252)',
                data: data_min_salary,
            }, {
                label: 'Lương trung bình',
                backgroundColor: 'rgb(252, 11, 3)',
                borderColor: 'rgb(252, 11, 3)',
                data: data_avg_salary,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('SalaryChart'),
            config
        );
    </script>

    {{-- bảng thôgns kê nhân sự --}}
    <script>
        var users = {{ Js::from($data_users) }};
        var staff = {{ Js::from($staff) }};
        var manager = {{ Js::from($manager) }};
        var chief_of_department = {{ Js::from($chief_of_department) }};
        var quit = {{ Js::from($quit) }};
        const ctx = document.getElementById('Users').getContext('2d');
        const Color = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Thành viên', 'Nhân viên', 'Quản lí', 'Trưởng phòng', 'Đã nghỉ'],
                datasets: [{
                    label: 'Nhân sự',
                    data: [users, staff, manager, chief_of_department, quit],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        min: 0,
                        max: 30
                    },
                }
            }
        });
    </script>

    {{-- bảng thống kê thưởng phạt --}}
    <script type="text/javascript">
        var labels_decision = {{ Js::from($labels_decision) }};
        var reward = {{ Js::from($reward) }};
        var discipline = {{ Js::from($discipline) }};

        const data_decision = {
            labels: labels_decision,
            datasets: [{
                label: 'thưởng',
                backgroundColor: 'rgb(52, 235, 183)',
                borderColor: 'rgb(52, 235, 183)',
                data: discipline,
            }, {
                label: 'phạt',
                backgroundColor: 'rgb(3, 36, 252)',
                borderColor: 'rgb(3, 36, 252)',
                data: reward,
            }]
        };

        const config_decision = {
            type: 'line',
            data: data_decision,
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        min: 0,
                    },
                }
            }
        };

        const RewardAndDiscipline = new Chart(
            document.getElementById('RewardAndDiscipline'),
            config_decision
        );
    </script>
@endsection

<section class="section">
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Respondent Perbulan</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="158"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="" style="display:flex; align-items:center">
                        <div class="card-stats-title col-md-6">Filter</div>
                        <div class="col-lg-6 col-md-12" style="padding:1rem">
                            <input type="Month" class="form-control" placeholder="Tahun" wire:model.live="filterDate">
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Respondent</h4>
                    </div>
                    <div class="card-body">
                        {{ $respondents->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Question Chart -->
    <div class="row">
        @foreach ($questions as $key => $question)
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $question->name }}</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="question-{{ $key }}"></canvas>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- respondentPerBulanChart Script -->
    <script>
        const monthLabel = ["January", "February", "March", "April", "May", "June", "July", "August",
            "September",
            "October", "November", "December"
        ]
        let respondentPerBulanChart;

        function initRespondentPerBulanChart(data) {
            var ctx = document.getElementById("myChart").getContext('2d');
            respondentPerBulanChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthLabel,
                    datasets: [{
                        label: 'Respondent',
                        data: data,
                        borderWidth: 2,
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderWidth: 0,
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    }, ]
                },
            });
        }
    </script>

    <!-- Question Chart -->
    <script>
        let charts = []

        function initPieChart(key, data, title) {
            var ctx = document.getElementById(`question-${key}`).getContext('2d');
            let tempChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: Object.values(data),
                        backgroundColor: [
                            '#191d21',
                            '#fc544b',
                            '#6777ef',
                            '#63ed7a',
                            '#ffa426',
                        ],
                        label: title
                    }],
                    labels: Object.keys(data),
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                }
            });
            charts.push(
                tempChart
            )
        }
    </script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            initRespondentPerBulanChart(@json($this->getMontlyRespondent));
            @foreach ($questions as $key => $question)

                initPieChart({{ $key }}, @json($this->getQuestionData[$key]), "{{ $question->name }}")
            @endforeach
        })
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.on('filter-update', (data) => {
                setTimeout(() => {
                    respondentPerBulanChart.destroy();
                    initRespondentPerBulanChart(data[0]);
                    @foreach ($questions as $key => $question)

                        charts[{{ $key }}].destroy()
                        initPieChart({{ $key }}, data[1][{{ $key }}],
                            "{{ $question->name }}")
                    @endforeach
                }, 0)
            })
        });
    </script>
</section>

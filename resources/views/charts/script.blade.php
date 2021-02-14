<script>
    let url = "{{ route('api.chart') }}";

$.ajax({
    url: url,
    success: function (data) {
        var options = {
            plotOptions: {
                bar: {
                    horizontal: false,
                    dataLabels: {
                    position: 'bottom'
                    }
                }
            },
            chart: {
                type: "bar",
                height: 300
            },
            series: [
                {
                    name: "Kas",
                    data: [
                        data.data.jan,
                        data.data.feb,
                        data.data.mar,
                        data.data.apr,
                        data.data.mei,
                        data.data.jun,
                        data.data.jul,
                        data.data.agu,
                        data.data.sep,
                        data.data.okt,
                        data.data.nov,
                        data.data.des,
                    ],
                },
            ],
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
            },
        };

        var chart = new ApexCharts(
            document.querySelector("#cash-transaction-chart-dashboard"),
            options
        );

        chart.render();
        console.log(data.data.jan);
    },
});
</script>
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>

<script>
    Highcharts.chart('container', {
        chart: {
            type: 'spline',
            inverted: true
        },
        title: {
            text: '25GSC_230V 50Hz',
            align: 'center'
        },
        subtitle: {
            text: '25GSC_230V 50Hz',
            align: 'center'
        },
        xAxis: {
            reversed: false,
            title: {
                enabled: true,
                text: 'Static Pressure (Pa)'
            },
            labels: {
                format: '{value}'
            },
            accessibility: {
                rangeDescription: 'Range: 0 to 100'
            },
            maxPadding: 0.05,
            showLastLabel: true,
            gridLineWidth: 1,
            lineWidth: 2,
            lineColor: '#ccd6eb'
        },
        yAxis: {
            title: {
                text: 'Air Volume (m³/h)'
            },
            labels: {
                format: '{value}'
            },
            accessibility: {
                rangeDescription: 'Range: 0 to 1200'
            },
            gridLineWidth: 1,
            lineWidth: 1,
            lineColor: '#ccd6eb'
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '',
            pointFormat: '{point.y} m³/h </br> {point.x} pa'
        },
        plotOptions: {
            spline: {
                marker: {
                    enable: false
                }
            }
        },
        series: [{
            name: 'Temperature',
            color: '#c12227',
            data: [
                [0, 1120], [18, 1001], [27, 904], [34, 795], [37, 705],
                [40, 594], [47, 400], [54, 294], [59, 207], [72, 95], [89, 0]
            ],
            marker: {
                enabled: false, // Hide markers by default
                states: {
                    hover: {
                        enabled: true // Show markers on hover
                    }
                }
            }

        }]
    });


</script>
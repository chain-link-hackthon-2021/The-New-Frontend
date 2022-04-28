<div class="card-body dc">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
    </div>
    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
    </div>
</div>
<canvas id="chart-top-products" style="display: block; width: 485px; height: 341px;" class="chartjs-render-monitor" width="485" height="341"></canvas>
<div class="chart-widget-list">
    <p>
        <span class="fa-xs mr-1 legend-title" style="color:#017679">
            <i class="fa fa-fw fa-square-full"></i>
        </span>
        <span class="legend-text"> Product 1</span>
        <span class="float-right">$360</span>
    </p>
    <p>
        <span class="fa-xs mr-1 legend-title" style="color:#2f2e41">
            <i class="fa fa-fw fa-square-full"></i>
        </span>
        <span class="legend-text"> Product 2</span>
        <span class="float-right">$180</span>
    </p>
</div>

<script>
    var ctx = document.getElementById('chart-top-products').getContext('2d');
    // For a pie chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: [],
                data: []
            }]
        },
        options:
        {
            title: {
                display: false,
                text: 'Top-Products'
            },
            responsive: true,
            legend: {
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
        }
    });
    function addPieData(chart, label, data, color) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.backgroundColor.push(color);
            dataset.data.push(data);
        });
        chart.update();
    }

</script>
<script>
        addPieData(myPieChart,"Product 1",360,"#017679");
    </script>
<script>
        addPieData(myPieChart,"Product 2",180,"#2f2e41");
    </script>
</div>
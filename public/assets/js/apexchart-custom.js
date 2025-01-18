$(function () {
    "use strict";

    // apex chart
    var options = {
        series: [{
        name: 'Views',
        data: [150, 130, 180, 170, 220, 250, 200, 280, 180],
    }],
    colors : ['#3C65F5'],
    chart: {
        height: 340,
        type: 'area'
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();


});
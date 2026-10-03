/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Boxplot Chart init js
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    const chartElement = document.getElementById(chartId);
    if (chartElement) {
        const colors = chartElement.dataset.colors;
        if (colors) {
            const parsedColors = JSON.parse(colors);
            const mappedColors = parsedColors.map((value) => {
                const newValue = value.replace(/\s/g, "");
                if (!newValue.includes(",")) {
                    const color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    return color || newValue;
                } else {
                    const val = value.split(",");
                    if (val.length === 2) {
                        const rgbaColor = `rgba(${getComputedStyle(document.documentElement).getPropertyValue(val[0])}, ${val[1]})`;
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
            return mappedColors;
        } else {
            console.warn(`data-colors attribute not found on: ${chartId}`);
        }
    }
}

var chartBoxBasicChart = "";
var chartBoxPlotChart = "";
var chartBoxPlotHoriChart = "";

function loadCharts() {
    var chartBoxBasicColors = "";
    chartBoxBasicColors = getChartColorsArray("basic_box");
    if (chartBoxBasicColors) {
        var options = {
            series: [{
                type: 'boxPlot',
                data: [{
                    x: 'دی 1393',
                    y: [54, 66, 69, 75, 88]
                },
                {
                    x: 'دی 1394',
                    y: [43, 65, 69, 76, 81]
                },
                {
                    x: 'دی 1395',
                    y: [31, 39, 45, 51, 59]
                },
                {
                    x: 'دی 1396',
                    y: [39, 46, 55, 65, 71]
                },
                {
                    x: 'دی 1397',
                    y: [29, 31, 35, 39, 44]
                },
                {
                    x: 'دی 1398',
                    y: [41, 49, 58, 61, 67]
                },
                {
                    x: 'دی 1399',
                    y: [54, 59, 66, 71, 88]
                }
                ]
            }],
            chart: {
                type: 'boxPlot',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            title: {
                text: 'نمودار جعبه‌ای پایه',
                align: 'left',
                style: {
                    fontWeight: 500,
                },
            },
            plotOptions: {
                boxPlot: {
                    colors: {
                        upper: chartBoxBasicColors[0],
                        lower: chartBoxBasicColors[1]
                    }
                }
            },
            stroke: {
                colors: [chartBoxBasicColors[2]]
            },
        };

        if (chartBoxBasicChart != "")
            chartBoxBasicChart.destroy();
        chartBoxBasicChart = new ApexCharts(document.querySelector("#basic_box"), options);
        chartBoxBasicChart.render();
    }

    //  Boxplot-Scatter
    var chartBoxPlotColors = "";
    chartBoxPlotColors = getChartColorsArray("box_plot");
    if (chartBoxPlotColors) {
        var options = {
            series: [{
                name: 'جعبه',
                type: 'boxPlot',
                data: [{
                    x: new Date('2017-01-01').getTime(),
                    y: [54, 66, 69, 75, 88]
                },
                {
                    x: new Date('2018-01-01').getTime(),
                    y: [43, 65, 69, 76, 81]
                },
                {
                    x: new Date('2019-01-01').getTime(),
                    y: [31, 39, 45, 51, 59]
                },
                {
                    x: new Date('2020-01-01').getTime(),
                    y: [39, 46, 55, 65, 71]
                },
                {
                    x: new Date('2021-01-01').getTime(),
                    y: [29, 31, 35, 39, 44]
                }
                ]
            },
            {
                name: 'داده‌های پرت',
                type: 'scatter',
                data: [{
                    x: new Date('2017-01-01').getTime(),
                    y: 32
                },
                {
                    x: new Date('2018-01-01').getTime(),
                    y: 25
                },
                {
                    x: new Date('2019-01-01').getTime(),
                    y: 64
                },
                {
                    x: new Date('2020-01-01').getTime(),
                    y: 27
                },
                {
                    x: new Date('2020-01-01').getTime(),
                    y: 78
                },
                {
                    x: new Date('2021-01-01').getTime(),
                    y: 15
                }
                ]
            }
            ],
            chart: {
                type: 'boxPlot',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            
            colors: [chartBoxPlotColors[0], chartBoxPlotColors[1]],
            title: {
                text: 'نمودار باکس‌پلات - نمودار پراکندگی',
                align: 'left',
                style: {
                    fontWeight: 500,
                },
            },
            xaxis: {
                type: 'datetime',
                tooltip: {
                    formatter: function (val) {
                        return new Date(val).getFullYear()
                    }
                }
            },
            plotOptions: {
                boxPlot: {
                    colors: {
                        upper: chartBoxPlotColors[2],
                        lower: chartBoxPlotColors[3]
                    }
                }
            },
            stroke: {
                colors: [chartBoxPlotColors[4]]
            },
            tooltip: {
                shared: false,
                intersect: true
            }
        };

        if (chartBoxPlotChart != "")
            chartBoxPlotChart.destroy();
        chartBoxPlotChart = new ApexCharts(document.querySelector("#box_plot"), options);
        chartBoxPlotChart.render();
    }

    // box_plot_hori
    var chartBoxPlotHoriColors = "";
    chartBoxPlotHoriColors = getChartColorsArray("box_plot_hori");
    if (chartBoxPlotHoriColors) {
        var options = {
            series: [
                {
                    data: [
                        {
                            x: 'دسته A',
                            y: [54, 66, 69, 75, 88]
                        },
                        {
                            x: 'دسته B',
                            y: [43, 65, 69, 76, 81]
                        },
                        {
                            x: 'دسته C',
                            y: [31, 39, 45, 51, 59]
                        },
                        {
                            x: 'دسته D',
                            y: [39, 46, 55, 65, 71]
                        },
                        {
                            x: 'دسته E',
                            y: [29, 31, 35, 39, 44]
                        },
                        {
                            x: 'دسته F',
                            y: [41, 49, 58, 61, 67]
                        },
                        {
                            x: 'دسته G',
                            y: [54, 59, 66, 71, 88]
                        }
                    ]
                }
            ],
            chart: {
                type: 'boxPlot',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '50%'
                },
                boxPlot: {
                    colors: {
                        upper: chartBoxPlotHoriColors[0],
                        lower: chartBoxPlotHoriColors[1]
                    }
                }
            },
            stroke: {
                colors: [chartBoxPlotHoriColors[2]]
            },
        };

        if (chartBoxPlotHoriChart != "")
            chartBoxPlotHoriChart.destroy();
        chartBoxPlotHoriChart = new ApexCharts(document.querySelector("#box_plot_hori"), options);
        chartBoxPlotHoriChart.render();
    }
}
window.addEventListener("resize", function () {
    setTimeout(() => {
        loadCharts();
    }, 250);
});
loadCharts();
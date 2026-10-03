/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Treemaps Chart init js
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

var chartTreemapBasicChart = "";
var chartTreemapMultiChart = "";
var chartTreemapDistributedChart = "";
var chartTreemapRangeChart = "";

function loadCharts() {
    // Basic Treemaps
    var chartTreemapBasicColors = "";
    chartTreemapBasicColors = getChartColorsArray("basic_treemap");
    if (chartTreemapBasicColors) {
        var options = {
            series: [{
                data: [{
                    x: 'دهلی نو',
                    y: 218
                },
                {
                    x: 'کولکاتا',
                    y: 149
                },
                {
                    x: 'مومبای',
                    y: 184
                },
                {
                    x: 'احمدآباد',
                    y: 55
                },
                {
                    x: 'بنگالور',
                    y: 84
                },
                {
                    x: 'پونه',
                    y: 31
                },
                {
                    x: 'چنای',
                    y: 70
                },
                {
                    x: 'جیپور',
                    y: 30
                },
                {
                    x: 'سورت',
                    y: 44
                },
                {
                    x: 'حیدرآباد',
                    y: 68
                },
                {
                    x: 'لکنو',
                    y: 28
                },
                {
                    x: 'ایندور',
                    y: 19
                },
                {
                    x: 'کانپور',
                    y: 29
                }
                ]
            }],
            legend: {
                show: false
            },
            chart: {
                height: 350,
                type: 'treemap',
                toolbar: {
                    show: false
                }
            },
            colors: chartTreemapBasicColors,
            title: {
                text: 'نقشه درختی پایه',
                style: {
                    fontWeight: 500,
                }
            },
        };

        if (chartTreemapBasicChart != "")
            chartTreemapBasicChart.destroy();
        chartTreemapBasicChart = new ApexCharts(document.querySelector("#basic_treemap"), options);
        chartTreemapBasicChart.render();
    }

    // Multi - Dimensional Treemap
    var chartTreemapMultiColors = "";
    chartTreemapMultiColors = getChartColorsArray("multi_treemap");
    if (chartTreemapMultiColors) {
        var options = {
            series: [{
                name: 'رایانه‌های رومیزی',
                data: [{
                    x: 'الف',
                    y: 10
                },
                {
                    x: 'ب',
                    y: 60
                },
                {
                    x: 'ج',
                    y: 41
                }
                ]
            },
            {
                name: 'موبایل',
                data: [{
                    x: 'الفب',
                    y: 10
                },
                {
                    x: 'بالف',
                    y: 20
                },
                {
                    x: 'جالف',
                    y: 51
                },
                {
                    x: 'پ',
                    y: 30
                },
                {
                    x: 'م',
                    y: 20
                },
                {
                    x: 'ج',
                    y: 30
                }
                ]
            }
            ],
            legend: {
                show: false
            },
            chart: {
                height: 350,
                type: 'treemap',
                toolbar: {
                    show: false
                }
            },
            title: {
                text: 'نقشه درختی چند بعدی',
                align: 'center',
                style: {
                    fontWeight: 500,
                }
            },
            colors: chartTreemapMultiColors
        };

        if (chartTreemapMultiChart != "")
            chartTreemapMultiChart.destroy();
        chartTreemapMultiChart = new ApexCharts(document.querySelector("#multi_treemap"), options);
        chartTreemapMultiChart.render();
    }

    // Distributed Treemap
    var chartTreemapDistributedColors = "";
    chartTreemapDistributedColors = getChartColorsArray("distributed_treemap");
    if (chartTreemapDistributedColors) {
        var options = {
            series: [{
                data: [{
                    x: 'دهلی نو',
                    y: 218
                },
                {
                    x: 'کولکاتا',
                    y: 149
                },
                {
                    x: 'مومبای',
                    y: 184
                },
                {
                    x: 'احمدآباد',
                    y: 55
                },
                {
                    x: 'بنگالورو',
                    y: 84
                },
                {
                    x: 'پونه',
                    y: 31
                },
                {
                    x: 'چنای',
                    y: 70
                },
                {
                    x: 'جیپور',
                    y: 30
                },
                {
                    x: 'سورت',
                    y: 44
                },
                {
                    x: 'حیدرآباد',
                    y: 68
                },
                {
                    x: 'لکنو',
                    y: 28
                },
                {
                    x: 'ایندور',
                    y: 19
                },
                {
                    x: 'کانپور',
                    y: 29
                }
                ]
            }],
            legend: {
                show: false
            },
            chart: {
                height: 350,
                type: 'treemap',
                toolbar: {
                    show: false
                }
            },
            title: {
                text: 'نقشه درختی توزیع شده (رنگ متفاوت برای هر سلول)',
                align: 'center',
                style: {
                    fontWeight: 500,
                }
            },
            colors: chartTreemapDistributedColors,
            plotOptions: {
                treemap: {
                    distributed: true,
                    enableShades: false
                }
            }
        };

        if (chartTreemapDistributedChart != "")
            chartTreemapDistributedChart.destroy();
        chartTreemapDistributedChart = new ApexCharts(document.querySelector("#distributed_treemap"), options);
        chartTreemapDistributedChart.render();
    }

    // Color Range Treemaps
    var chartTreemapRangeColors = "";
    chartTreemapRangeColors = getChartColorsArray("color_range_treemap");
    if (chartTreemapRangeColors) {
        var options = {
            series: [{
                data: [{
                    x: 'اینترتل',
                    y: 1.2
                },
                {
                    x: 'گلدمن ساکس',
                    y: 0.4
                },
                {
                    x: 'اکسون موبیل',
                    y: -1.4
                },
                {
                    x: 'جنرال الکتریک',
                    y: 2.7
                },
                {
                    x: 'کاترپیلار',
                    y: -0.3
                },
                {
                    x: 'رایتون',
                    y: 5.1
                },
                {
                    x: 'سیسکو',
                    y: -2.3
                },
                {
                    x: 'جانسون و جانسون',
                    y: 2.1
                },
                {
                    x: 'پروکتر و گمبل',
                    y: 0.3
                },
                {
                    x: 'ترور',
                    y: 0.12
                },
                {
                    x: '۳M',
                    y: -2.31
                },
                {
                    x: 'نایک',
                    y: 3.98
                },
                {
                    x: 'آی‌تی',
                    y: 1.67
                }
                ]
            }],
            legend: {
                show: false
            },
            chart: {
                height: 350,
                type: 'treemap',
                toolbar: {
                    show: false
                }
            },
            title: {
                text: 'نمودار درختی با مقیاس رنگی',
                style: {
                    fontWeight: 500,
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '12px',
                },
                formatter: function (text, op) {
                    return [text, op.value]
                },
                offsetY: -4
            },
            plotOptions: {
                treemap: {
                    enableShades: true,
                    shadeIntensity: 0.5,
                    reverseNegativeShade: true,
                    colorScale: {
                        ranges: [{
                            from: -6,
                            to: 0,
                            color: chartTreemapRangeColors[0]
                        },
                        {
                            from: 0.001,
                            to: 6,
                            color: chartTreemapRangeColors[1]
                        }
                        ]
                    }
                }
            }
        };

        if (chartTreemapRangeChart != "")
            chartTreemapRangeChart.destroy();
        chartTreemapRangeChart = new ApexCharts(document.querySelector("#color_range_treemap"), options);
        chartTreemapRangeChart.render();
    }
}
window.addEventListener("resize", function () {
    setTimeout(() => {
        loadCharts();
    }, 250);
});
loadCharts();
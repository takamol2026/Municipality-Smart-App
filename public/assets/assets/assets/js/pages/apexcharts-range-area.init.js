/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: range area Chart init js
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

var rangeAreaChart = "";
var comboRangeAreaChart = "";

function loadCharts() {

    //  Basic range area Charts
    var rangeAreaChartColors = "";
    rangeAreaChartColors = getChartColorsArray("range_area_chart_basic");
    if (rangeAreaChartColors) {
        var options = {
            series: [
                {
                    name: 'New York Temperature',
                    data: [
                        {
                            x: 'فروردین',
                            y: [-2, 4]
                        },
                        {
                            x: 'اردیبهشت',
                            y: [-1, 6]
                        },
                        {
                            x: 'خرداد',
                            y: [3, 10]
                        },
                        {
                            x: 'تیر',
                            y: [8, 16]
                        },
                        {
                            x: 'مرداد',
                            y: [13, 22]
                        },
                        {
                            x: 'شهریور',
                            y: [18, 26]
                        },
                        {
                            x: 'مهر',
                            y: [21, 29]
                        },
                        {
                            x: 'آبان',
                            y: [21, 28]
                        },
                        {
                            x: 'آذر',
                            y: [17, 24]
                        },
                        {
                            x: 'دی',
                            y: [11, 18]
                        },
                        {
                            x: 'بهمن',
                            y: [6, 12]
                        },
                        {
                            x: 'اسفند',
                            y: [1, 7]
                        }
                    ]
                }
            ],
            chart: {
                height: 350,
                type: 'rangeArea',
                toolbar: {
                    show: false,
                }
            },
            stroke: {
                curve: 'straight'
            },
            colors: rangeAreaChartColors,
            title: {
                text: 'دمای نیویورک (در تمام طول سال)'
            },
            markers: {
                hover: {
                    sizeOffset: 5
                }
            },
            dataLabels: {
                enabled: false
            },
            yaxis: {
                labels: {
                    formatter: (val) => {
                        return val + '°C'
                    }
                }
            }
        };

        if (rangeAreaChart != "")
            rangeAreaChart.destroy();
        rangeAreaChart = new ApexCharts(document.querySelector("#range_area_chart_basic"), options);
        rangeAreaChart.render();
    }

    //  Combo range area Charts
    var comboRangeAreaChartColors = "";
    comboRangeAreaChartColors = getChartColorsArray("combo_range_area_chart");
    if (comboRangeAreaChartColors) {
        var options = {
            series: [
                {
                    type: 'rangeArea',
                    name: 'Team B Range',

                    data: [
                        {
                            x: 'فروردین',
                            y: [1100, 1900]
                        },
                        {
                            x: 'اردیبهشت',
                            y: [1200, 1800]
                        },
                        {
                            x: 'خرداد',
                            y: [900, 2900]
                        },
                        {
                            x: 'تیر',
                            y: [1400, 2700]
                        },
                        {
                            x: 'مرداد',
                            y: [2600, 3900]
                        },
                        {
                            x: 'شهریور',
                            y: [500, 1700]
                        },
                        {
                            x: 'مهر',
                            y: [1900, 2300]
                        },
                        {
                            x: 'آبان',
                            y: [1000, 1500]
                        }
                    ]
                },

                {
                    type: 'rangeArea',
                    name: 'Team A Range',
                    data: [
                        {
                            x: 'فروردین',
                            y: [3100, 3400]
                        },
                        {
                            x: 'اردیبهشت',
                            y: [4200, 5200]
                        },
                        {
                            x: 'خرداد',
                            y: [3900, 4900]
                        },
                        {
                            x: 'تیر',
                            y: [3400, 3900]
                        },
                        {
                            x: 'مرداد',
                            y: [5100, 5900]
                        },
                        {
                            x: 'شهریور',
                            y: [5400, 6700]
                        },
                        {
                            x: 'مهر',
                            y: [4300, 4600]
                        },
                        {
                            x: 'آبان',
                            y: [2100, 2900]
                        }
                    ]
                },

                {
                    type: 'line',
                    name: 'Team B Median',
                    data: [
                        {
                            x: 'ژانویه',
                            y: 1500
                        },
                        {
                            x: 'فوریه',
                            y: 1700
                        },
                        {
                            x: 'مارس',
                            y: 1900
                        },
                        {
                            x: 'آوریل',
                            y: 2200
                        },
                        {
                            x: 'مه',
                            y: 3000
                        },
                        {
                            x: 'ژوئن',
                            y: 1000
                        },
                        {
                            x: 'ژوئیه',
                            y: 2100
                        },
                        {
                            x: 'اوت',
                            y: 1200
                        },
                        {
                            x: 'سپتامبر',
                            y: 1800
                        },
                        {
                            x: 'اکتبر',
                            y: 2000
                        }
                    ]
                },
                {
                    type: 'line',
                    name: 'Team A Median',
                    data: [
                        {
                            x: 'ژانویه',
                            y: 3300
                        },
                        {
                            x: 'فوریه',
                            y: 4900
                        },
                        {
                            x: 'مارس',
                            y: 4300
                        },
                        {
                            x: 'آوریل',
                            y: 3700
                        },
                        {
                            x: 'مه',
                            y: 5500
                        },
                        {
                            x: 'ژوئن',
                            y: 5900
                        },
                        {
                            x: 'ژوئیه',
                            y: 4500
                        },
                        {
                            x: 'اوت',
                            y: 2400
                        },
                        {
                            x: 'سپتامبر',
                            y: 2100
                        },
                        {
                            x: 'اکتبر',
                            y: 1500
                        }
                    ]
                }
            ],
            chart: {
                height: 350,
                type: 'rangeArea',
                toolbar: {
                    show: false,
                },
                animations: {
                    speed: 500
                }
            },
            colors: comboRangeAreaChartColors,
            dataLabels: {
                enabled: false
            },
            fill: {
                opacity: [0.24, 0.24, 1, 1]
            },
            forecastDataPoints: {
                count: 2
            },
            stroke: {
                curve: 'straight',
                width: [0, 0, 2, 2]
            },
            legend: {
                show: true,
                customLegendItems: ['Team B', 'Team A'],
                inverseOrder: true
            },
            title: {
                text: 'منطقه دامنه با خط پیش بینی (ترکیبی)'
            },
            markers: {
                hover: {
                    sizeOffset: 5
                }
            }
        };

        if (comboRangeAreaChart != "")
            comboRangeAreaChart.destroy();
        comboRangeAreaChart = new ApexCharts(document.querySelector("#combo_range_area_chart"), options);
        comboRangeAreaChart.render();
    }
}

window.addEventListener("resize", function () {
    setTimeout(() => {
        loadCharts();
    }, 250);
});
loadCharts();
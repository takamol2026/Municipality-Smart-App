function getChartColorsArray(chartId) {
    const chartElement = document.getElementById(chartId);
    if (chartElement) {
        const colors = chartElement.dataset.colors;
        if (colors) {
            const parsedColors = JSON.parse(colors);
            return parsedColors.map((value) => {
                const newValue = value.replace(/\s/g, "");
                if (!newValue.includes(",")) {
                    const color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    return color || newValue;
                }

                const val = value.split(",");
                if (val.length === 2) {
                    return `rgba(${getComputedStyle(document.documentElement).getPropertyValue(val[0])}, ${val[1]})`;
                }

                return newValue;
            });
        }
    }
}

var moduleColumnChart = "";
var projectDonutChart = "";
var monthlyColumnChart = "";
var miniCharts = {};

function loadCharts() {
    document.querySelectorAll('[id^="mini-chart-"]').forEach((element) => {
        const colors = getChartColorsArray(element.id);
        if (!colors) {
            return;
        }

        let seriesData = [];
        try {
            seriesData = JSON.parse(element.dataset.series || "[]");
        } catch (error) {
            seriesData = [];
        }

        const options = {
            series: [{ data: seriesData }],
            chart: {
                type: "bar",
                height: 45,
                sparkline: { enabled: true }
            },
            colors: colors,
            stroke: {
                curve: "smooth",
                width: 1
            },
            tooltip: {
                fixed: { enabled: false },
                x: { show: false },
                y: {
                    title: {
                        formatter: function () {
                            return "";
                        }
                    }
                },
                marker: { show: false }
            }
        };

        if (miniCharts[element.id]) {
            miniCharts[element.id].destroy();
        }

        miniCharts[element.id] = new ApexCharts(element, options);
        miniCharts[element.id].render();
    });

    var moduleColors = getChartColorsArray("column_chart");
    if (moduleColors && window.dashboardCharts && window.dashboardCharts.module) {
        var options = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "45%",
                    endingShape: "rounded",
                    distributed: true
                }
            },
            dataLabels: { enabled: false },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                name: "",
                data: window.dashboardCharts.module.series
            }],
            colors: ["#405189", "#0ab39c", "#f7b84b", "#299cdb", "#f06548", "#3577f1", "#405189", "#0ab39c", "#f7b84b", "#299cdb"],
            xaxis: {
                categories: window.dashboardCharts.module.labels
            },
            yaxis: {
                min: 0,
                forceNiceScale: true
            },
            legend: { show: false },
            grid: { borderColor: "#f1f1f1" }
        };

        if (moduleColumnChart !== "") {
            moduleColumnChart.destroy();
        }
        moduleColumnChart = new ApexCharts(document.querySelector("#column_chart"), options);
        moduleColumnChart.render();
    }

    var donutColors = getChartColorsArray("simple_dount_chart");
    if (donutColors && window.dashboardCharts && window.dashboardCharts.projectStatus) {
        var donutOptions = {
            series: window.dashboardCharts.projectStatus.series,
            chart: {
                height: 350,
                type: "donut"
            },
            labels: window.dashboardCharts.projectStatus.labels,
            legend: { position: "bottom" },
            dataLabels: {
                dropShadow: { enabled: false }
            },
            colors: donutColors
        };

        if (projectDonutChart !== "") {
            projectDonutChart.destroy();
        }
        projectDonutChart = new ApexCharts(document.querySelector("#simple_dount_chart"), donutOptions);
        projectDonutChart.render();
    }

    var monthlyColors = getChartColorsArray("monthly_column_chart");
    if (monthlyColors && window.dashboardCharts && window.dashboardCharts.monthly) {
        var monthlyOptions = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "45%",
                    endingShape: "rounded"
                }
            },
            dataLabels: { enabled: false },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: window.dashboardCharts.monthly.series,
            colors: monthlyColors,
            xaxis: {
                categories: window.dashboardCharts.monthly.labels
            },
            yaxis: {
                min: 0,
                forceNiceScale: true
            },
            grid: { borderColor: "#f1f1f1" }
        };

        if (monthlyColumnChart !== "") {
            monthlyColumnChart.destroy();
        }
        monthlyColumnChart = new ApexCharts(document.querySelector("#monthly_column_chart"), monthlyOptions);
        monthlyColumnChart.render();
    }
}

window.addEventListener("resize", function () {
    setTimeout(function () {
        loadCharts();
    }, 250);
});

loadCharts();

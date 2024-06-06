$(function () {


  // -----------------------------------------------------------------------
  // Subscriptions
  // -----------------------------------------------------------------------
  var chart = {
    series: [
      {
        name: "Light Intencity",
        data: [1.2, 2.7, 1, 3.6, 2.1, 2.7, 2.2, 1.3, 2.5],
      },
      {
        name: "Temperature",
        data: [-2.8, -1.1, -2.5, -1.5, -2.3, -1.9, -1, -2.1, -1.3],
      },
      {
        name: "Humidity",
        data: [2.8, 4.1, 5.5, .5, 4, 1.9, -3, 3.1, 4.3],
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "line",
      fontFamily: "inherit",
      foreColor: "#adb0bb",
      height: 270,
      stacked: true,
      offsetX: -15,
    },
    colors: ["var(--bs-warning)", "var(--bs-danger)","var(--bs-info)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "15%",
        borderRadius: [6],
        borderRadiusApplication: "end",
        borderRadiusWhenStacked: "all",
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      show: true,
      padding: {
        top: 0,
        bottom: 0,
        right: 0,
      },
      borderColor: "rgba(0,0,0,0.05)",
      xaxis: {
        lines: {
          show: true,
        },
      },
      yaxis: {
        lines: {
          show: true,
        },
      },
    },
    yaxis: {
      min: -5,
      max: 5,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      categories: [
        "10:30",
        "10:35",
        "10:40",
        "10:45",
        "10:50",
        "10:55",
        "11:00",
        "11:05",
        "11:10",
      ],
      labels: {
        style: { fontSize: "13px", colors: "#adb0bb", fontWeight: "400" },
      },
    },
    yaxis: {
      tickAmount: 4,
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(
    document.querySelector("#revenue-forecast"),
    chart
  );
  chart.render();



})

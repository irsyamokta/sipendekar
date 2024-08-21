import ApexCharts from "apexcharts";

// ===== chartThree
const chart03 = () => {
  const chartThreeOptions = {
    series: [usia4_18, usia18_keatas],
    chart: {
      type: "donut",
      width: 380,
    },
    colors: ["#83B7FD", "#176B87"],
    labels: ["4 - 18 Tahun", "Di atas 18 Tahun"],
    legend: {
      show: false,
      position: "bottom",
    },

    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          background: "transparent",
        },
      },
    },

    dataLabels: {
      enabled: false,
    },
    responsive: [
      {
        breakpoint: 640,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  const chartSelector = document.querySelectorAll("#chartThree");

  if (chartSelector.length) {
    const chartThree = new ApexCharts(
      document.querySelector("#chartThree"),
      chartThreeOptions
    );
    chartThree.render();
  }
};

export default chart03;

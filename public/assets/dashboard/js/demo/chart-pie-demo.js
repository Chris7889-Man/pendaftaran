// Set new default font family and font color to mimic Bootstrap's default styling
((Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif');
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
// Pie Chart Jenis Kelamin
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Laki-laki", "Perempuan"], // 🔥 sesuai kebutuhan
        datasets: [
            {
                data: [laki, perempuan], // 🔥 dari database
                backgroundColor: [
                    "#4e73df", // biru (laki-laki)
                    "#e83e8c", // pink (perempuan)
                ],
                hoverBackgroundColor: ["#2e59d9", "#d63384"],
                borderWidth: 2,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        cutoutPercentage: 70, // 🔥 ukuran donut

        legend: {
            display: true,
            position: "bottom", // 🔥 lebih rapi
        },

        tooltips: {
            backgroundColor: "#fff",
            bodyFontColor: "#666",
            borderColor: "#ddd",
            borderWidth: 1,
            callbacks: {
                label: function (tooltipItem, data) {
                    let label = data.labels[tooltipItem.index];
                    let value = data.datasets[0].data[tooltipItem.index];
                    return label + ": " + value + " peserta";
                },
            },
        },
    },
});

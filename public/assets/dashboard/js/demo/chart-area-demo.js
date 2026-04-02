// Set new default font family and font color to mimic Bootstrap's default styling
((Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif');
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: "bar", // 🔥 ganti ke bar chart
    data: {
        labels: jurusanLabels,
        datasets: [
            {
                label: "Jumlah Peserta",
                data: jurusanData,
                backgroundColor: [
                    "#4e73df",
                    "#1cc88a",
                    "#36b9cc",
                    "#f6c23e",
                    "#e74a3b",
                    "#858796",
                ],
                borderRadius: 8, // 🔥 biar rounded
                barThickness: 30,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,

        scales: {
            xAxes: [
                {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 30, // 🔥 biar tidak tabrakan
                        minRotation: 30,
                    },
                    gridLines: {
                        display: false,
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        precision: 0,
                    },
                    gridLines: {
                        color: "#f0f0f0",
                    },
                },
            ],
        },

        legend: {
            display: false,
        },

        tooltips: {
            backgroundColor: "#fff",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            borderColor: "#ddd",
            borderWidth: 1,
            callbacks: {
                label: function (tooltipItem) {
                    return "Jumlah: " + tooltipItem.yLabel + " peserta";
                },
            },
        },
    },
});

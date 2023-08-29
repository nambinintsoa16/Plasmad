/*$(() => {
            //___________________________________________________________________
            //___________________________________________ statistique de commande

             let lineChart = document.getElementById('lineChart').getContext('2d');
    let myLineChart = new Chart(lineChart, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Active Users",
                borderColor: "#1d7af3",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1d7af3",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    padding: 10,
                    fontColor: '#1d7af3',
                }
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: { left: 15, right: 15, top: 15, bottom: 15 }
            }
        }
    })

    //___________________________________________________________________
    //_________________________________________ statistique de production

    let pieChart = document.getElementById('pieChart').getContext('2d')
    let myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [50, 35, 15],
                backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
                borderWidth: 0
            }],
            labels: ['New Visitors', 'Subscribers', 'Active Users']
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })

    //___________________________________________________________________
    //_________________________________________ statistique de production
    let doughnutChart = document.getElementById('doughnutChart').getContext('2d')
    let myDoughnutChart = new Chart(doughnutChart, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [10, 20, 30],
                backgroundColor: ['#f3545d', '#fdaf4b', '#1d7af3']
            }],

            labels: [
                'Red',
                'Yellow',
                'Blue'
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            },
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })



})*/

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('graficaPuestos');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    const puestosActivos = JSON.parse(
        canvas.dataset.puestos || '[0,0,0,0]'
    );

    new Chart(canvas, {
        type: 'bar',

        data: {
            labels: ['Sector A', 'Sector B', 'Sector C', 'Global'],

            datasets: [{
                label: 'Puestos activos',
                data: puestosActivos,

                backgroundColor: [
                    '#174F8A',
                    '#2585F5',
                    '#07969B',
                    '#7950E8'
                ],

                borderRadius: 2,
                borderSkipped: false,
                maxBarThickness: 40,
                categoryPercentage: 0.8,
                barPercentage: 0.8
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            layout: {
                padding: {
                    top: 15,
                    right: 5,
                    left: 0
                }
            },

            plugins: {
                legend: {
                    display: true,
                    position: 'right',

                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rect',
                        boxWidth: 10,
                        boxHeight: 10,
                        padding: 12,
                        color: '#334155',
                        font: {
                            size: 11
                        },
                        // Ocultar el rectángulo de "Puestos activos"
                        filter: function (item) {
                            return item.text !== 'Puestos activos';
                        }
                    }
                },

                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Puestos activos: ' + context.parsed.y;
                        }
                    }
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#111827',
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    },
                    border: {
                        color: '#B8D5E8'
                    }
                },

                y: {
                    beginAtZero: true,

                    ticks: {
                        display: false,
                        precision: 0
                    },

                    grid: {
                        color: '#E5EDF5'
                    },

                    border: {
                        display: false
                    }
                }
            }
        },

        plugins: [{
            id: 'etiquetasBarras',

            afterDatasetsDraw(chart) {
                const ctx = chart.ctx;

                chart.data.datasets.forEach((dataset, index) => {
                    const meta = chart.getDatasetMeta(index);

                    meta.data.forEach((barra, i) => {
                        const valor = dataset.data[i];

                        ctx.save();
                        ctx.fillStyle = '#25364D';
                        ctx.font = '12px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        ctx.fillText(
                            valor,
                            barra.x,
                            barra.y - 1
                        );

                        ctx.restore();
                    });
                });
            }
        }]
    });

});

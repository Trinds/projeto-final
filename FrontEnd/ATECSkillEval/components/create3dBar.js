// Sample data in the format [month, y]
const dataArray = [
    ['January', 10],
    ['February', 8],
    ['March', 9],
    ['April', 11],
    ['May', 18],
    ['June', 10],
    ['July', 19],
    ['August', 12],
    ['September', 8],
    ['October', 18],
    ['November', 10],
    ['December', 13],
];

// Function to create the bar chart
function createBarChart(data) {
    const ctx = document.getElementById('barChart').getContext('2d');

    const labels = data.map(item => item[0]); // Extract month names
    const values = data.map(item => item[1]); // Extract y values

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: 'rgb(233, 184, 36)', // Bar color
                borderColor: 'rgb(216, 63, 49)', // Border color
                borderWidth: 1 // Border width
            }]
        },
        options: {
            scales: {
                x: {
                    display: true, // Hide x-axis labels
                },
                y: {
                    display: true, // Hide y-axis labels
                    beginAtZero: true,
                },
            },
            responsive:true,
            plugins: {
                legend: {
                    display: false // Hide the legend
                }
            }
        }
    });
}

// Call the function with your data array
createBarChart(dataArray);

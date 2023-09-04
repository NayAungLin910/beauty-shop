<div class="m-2">
    <div class="flex flex-col lg:flex-wrap lg:flex-row place-content-center">
        <div class="lg:w-1/2 p-2 my-1">
            <canvas class="bg-white rounded-xl w-full shadow-lg" id='popularProductsChart'></canvas>
        </div>
        <div class="lg:w-1/2 p-2 my-1">
            <canvas class="bg-white rounded-xl w-full shadow-lg" id='yearlySalesChart'></canvas>
        </div>
    </div>
    <div class="flex flex-wrap gap-4 my-2">
        <div class="rounded-xl bg-pink-600 w-[10rem] h-[6rem] p-3 hover:bg-pink-700 text-white shadow-lg">
            <p class="text-2xl text-center">
                Users
            </p>
            <p class="text-lg text-center mt-4">
                Total: {{ $this->totalUserCount }}
            </p>
        </div>
        <div class="rounded-xl bg-violet-600 w-[10rem] h-[6rem] p-3 hover:bg-violet-700 text-white shadow-lg">
            <p class="text-2xl text-center">
                Admins
            </p>
            <p class="text-lg text-center mt-4">
                Total: {{ $this->totalAdminCount }}
            </p>
        </div>
        <div class="rounded-xl bg-sky-600 w-[10rem] h-[6rem] p-3 hover:bg-sky-700 text-white shadow-lg">
            <p class="text-2xl text-center">
                Sales
            </p>
            <p class="text-lg text-center mt-4">
                Total: {{ $this->totalSalesCount }}
            </p>
        </div>
        <div class="rounded-xl bg-orange-500 w-[10rem] h-[6rem] p-3 hover:bg-orange-600 text-white shadow-lg">
            <p class="text-2xl text-center">
                Products
            </p>
            <p class="text-lg text-center mt-4">
                Total: {{ $this->totalProductsCount }}
            </p>
        </div>
    </div>

    @push('layout-script-stack')
    <!-- Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const popularProducts = document.getElementById('popularProductsChart')

        new Chart(popularProducts, {
                type: 'bar',
                data: {
                    labels: {!!  $top5MostBoughtProducts[0]  !!},
                    datasets: [{
                        label: 'Top 5 Most Popular Products',
                        data: {{ $top5MostBoughtProducts[1] }},
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },  
                },
            }
        )

        const yearlySales = document.getElementById('yearlySalesChart')

        new Chart(yearlySales, {
                type: 'line',
                data: {
                    labels: {!!  $yearlySales[0]  !!},
                    datasets: [{
                        label: 'Last 3 Years Sales',
                        data: {{ $yearlySales[1] }},
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },  
                },
            }
        )

    </script>
    @endpush
</div>
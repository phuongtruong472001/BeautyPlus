
$(window).on('load', function () {
    // new PRODUCT('.m-table-product-wrapper');
    new CHART('.m-chart')
})

class PRODUCT {
    constructor(className) {
        this.className = className;

        $(this.className).append(`
            <div class="m-table-action">
            </div>
            <div class="m-table sticky-table">
                <table>
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" />
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Miêu tả</th>
                            <th>Số lượng</th>
                            <th>Giá thành</th>
                            <th>Chiêt khấu</th>
                            <th>Chiêt khấu</th>
                            <th>Nhãn hiệu</th>
                            <th class="fixed-coloumn-last">Số sản phẩm đã bán</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="m-table-footer">
                <div>Tổng số: <span class="m-total-news">0</span> bản ghi</div>
                <div></div>
            </div>
        `)

    }


}

class CHART {
    constructor(className) {
        this.className = className;
        this.loadData();
    }

    loadData(m){
        var that = this;
        $.ajax({
            type: "GET",
            url: "./api/statistical/get-product-by-month.php",
            data: {month:6},
            
            success: function (response) {
                
                console.log(JSON.parse(response))
                that.render(JSON.parse(response))
            }   
        });
    }
    render(response) {
        const mLables =[];
        const mData =[];
        response.forEach(e => {
            mLables.push(e.name);
            mData.push(e.sold)
        });
        $(this.className).empty();
        $(this.className).append(`
            <canvas id="myChart" ></canvas>
        `)
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: mLables,
                datasets: [{
                    label: 'Số Lượng Bán',
                    data: mData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                // scales: {
                //     y: {
                //         beginAtZero: true
                //     }
                // }
            }
        });
    }


}





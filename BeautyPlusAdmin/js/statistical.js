$(window).on('load', function () {
    new Statistical('.m-table-wrapper');
    // new CHART();
})

class Statistical {
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
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng tồn kho</th>
                            <th>Nhãn hàng</th>
                            <th>Số lượng đã bán</th>
                            <th>Giá bán</th>
                            <th class="fixed-coloumn-last">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="m-table-footer">
                <div>Tổng số: <span class="m-total-news">0</span> bản ghi</div>
                <div>Tổng doanh thu: <span class="m-total-revenue">0</span> VND</div>
            </div>
        `)
        const currentDate = new Date();
        const datetime={datetime:`${currentDate.getFullYear()}/${currentDate.getMonth()+1}/${currentDate.getDay()}`}
        $("#bday-month").val(`${currentDate.getFullYear()}-0${currentDate.getMonth()+1}`)
        this.loadData(datetime);
        this.handleAdd();
        this.changeDateTime();
    }
    changeDateTime() {
        var that = this;
        $('#bday-month').change(function (e) {
            that.loadData({ datetime: e.target.value +"-01"});
        })
    }
    loadData(datetime) {
        console.log("Thay đổi ngày tháng thống kê", datetime)
        var that = this;
        $.ajax({
            type: "GET",
            data: datetime,
            url: "./api/statistical/get-product-by-month.php",
            success: function (response) {
               
                const datasource = JSON.parse(response);
                that.render(datasource);

            }
        });
    }

    /**@deprecated*/
    handleAdd() {
        //Them dong du lieu
        $('.m-news-add-action').show();
        $('.m-news-edit-action').hide();
        // $('.add-new-employee').hide();

    }

    render(arr) {
        let totalRevenue = 0;
        arr.forEach(value=>{
            const cur=totalRevenue + value.BillProductPrice*value.BillProductQuantity;
            totalRevenue = totalRevenue + cur?cur:0;
        });
        $('.m-total-news').text(arr.length + "");
        $('.m-total-revenue').text(totalRevenue);

        $(`${this.className} tbody`).empty();

        arr.forEach(e => {
            //Thêm Một dòng mới

            $(`${this.className} tbody`).append(`
            <tr>
                <td class= "fixed-coloumn-first">
                    <input type="checkbox" />
                    
                </td>
                <td >${e.ProductID}</td>
                <td >${e.ProductName}</td>
                <td >${e.ProductQuantity}</td>
                <td >${e.ProductBrand}</td>
                <td >${e.BillProductQuantity}</td>
                <td >${e.BillProductPrice}</td>       
                <td >
                    <button class="m-news-edit-${e.id}">Xem</button>
                   
                </td>
             </tr>`);



            //Thêm sự kiện sửa dòng
            $(`.m-news-edit-${e.id}`).click(function () {
                $('.m-news-add-action').hide();
                $('.m-news-edit-action').show();
                let inputs = $(".m-dialogue [propName]")
                for (let i = 0; i < inputs.length; i++) {
                    const input = inputs[i];
                    $(input).val(e[$(input).attr("propName")]);
                }
                $('.m-dialogue').show();

            })
        });
    }
}
















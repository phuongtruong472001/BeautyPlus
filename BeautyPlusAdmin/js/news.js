
$(window).on('load', function () {
    new NEWS('.m-table-wrapper');
})

class NEWS {
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
                            <th>Tiêu Đề</th>
                            <th>Nội Dung</th>
                            <th>Tác Giả</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Sửa</th>
                            <th class="fixed-coloumn-last">Chức năng</th>
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
        this.loadData();
        this.handleAdd();
    }

    loadData() {
        var news = this;
        $.ajax({
            type: "GET",
            url: "./api/news/get-all.php",
            success: function (response) {
                const datasource = JSON.parse(response);
                news.render(datasource);
            }
        });
    }

    handleAdd() {
        //Them dong du lieu
        $('.m-news-add-action').show();
        $('.m-news-edit-action').hide();

        var news = this;
        $('.m-news-add').click(function () {
            $('.m-dialogue').show();
        })

        //Huỷ thêm mới
        $('.m-news-cancel').click(function () {
            $('.m-dialogue').hide();
        })

        //Lưu bài viết
        $('.m-news-save').click(function () {
            const resp = {}
            const inputs = $(".m-dialogue [propName]")
            for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];
                resp[$(input).attr("propName")] = $(input).val();
                console.log($(input).val());
            }
            $.ajax({
                type: "POST",
                url: "./api/news/add-new-news.php",
                data: resp,
                success: function (response) {
                    if (response) {
                        console.log("Test Them moi", response);
                        news.loadData();
                        window.alert("Thêm thành công!");
                    }
                    else {
                        window.alert("Thêm thất bại!")
                    }
                    $('.m-dialogue').hide();
                },
                error: function () {
                    window.alert("Thêm thất bại!")
                    $('.m-dialogue').hide();
                }
            });
        })


        //Lưu bài viết và thêm mới
        $('.m-news-save-and-add').click(function () {
            const resp = {}
            const inputs = $(".m-dialogue [propName]")
            for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];
                resp[$(input).attr("propName")] = $(input).val();
                console.log($(input).val());
            }
            $.ajax({
                type: "POST",
                url: "./api/news/add-new-news.php",
                data: resp,
                success: function (response) {
                    if (response) {
                        console.log("Test Them moi", response);
                        news.loadData();
                        window.alert("Thêm thành công!");
                    }
                    else {
                        window.alert("Thêm thất bại!")
                    }

                },
                error: function () {
                    window.alert("Thêm thất bại!")
                }
            });
        })
    }

    render(arr) {
        var news = this;
        $('.m-total-news').text(arr.length + "");
        $(`${this.className} tbody`).empty();

        arr.forEach(e => {
            //Thêm Một dòng mới

            $(`${this.className} tbody`).append(`
            <tr>
                <td class= "fixed-coloumn-first">
                    <input type="checkbox" />
                    
                </td>
                <td >${e.title}</td>
                <td >${e.content}</td>
                <td >${e.author}</td>
                <td >${e.created}</td>
                <td >${e.updated}</td>

                <td >
                    <button class="m-news-edit-${e.id}">Sửa</button>
                    <button class="m-news-delete-${e.id}">Xoá</button>
                </td>
             </tr>`);

            //Thêm sự kiện xoá dòng
            $(`.m-news-delete-${e.id}`).click(function () {
                const cf = confirm("Bạn có muốn xoá dòng  này!");
                if (cf) {
                    $.ajax({
                        type: "POST",
                        url: "./api/news/delete-by-id.php",
                        data: e,
                        success: function (response) {
                            console.log("Test chuc nag xoa", response)
                            if (response) {
                                window.alert("Xoá Thành Công");
                                news.loadData();
                            }
                            else {
                                window.alert("Xoá Thất Bại");
                            }
                        }
                    });
                }
            })


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
             
                var row=e;
                $('.m-news-update').click(function () {
                    const resp = row;
                    inputs = $(".m-dialogue [propName]")
                    for (let i = 0; i < inputs.length; i++) {
                        const input = inputs[i];
                        resp[$(input).attr("propName")] = $(input).val();
                        console.log($(input).val());
                    }
                    console.log("Trước khi sửa","response", resp);
                    $.ajax({
                        type: "POST",
                        url: "./api/news/update-by-id.php",
                        data: resp,
                        success: function (response) {
                            console.log("Test chức năng sửa",response,resp);
                            if (response) {
                                window.alert("Sửa thành công!");
                                $('.m-dialogue').hide();
                                
                            } else {
                                window.alert("Sửa thất bại!")
                            }
                            news.loadData();
                            
                        }
                    });
                })
            })
        });
    }
}





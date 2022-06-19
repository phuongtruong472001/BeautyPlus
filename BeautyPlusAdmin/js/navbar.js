const data = [{

    width: 18,
    height: 20,
    position: "-33px -1630px",
    activePosition: "-33px -1587px",
    title: "Quản Lý tài khoản",
    url:"manageUser.php"
},
{

    width: 14,
    height: 18,
    position: "-78px -1631px",
    activePosition: "-78px -1588px",
    title: "Quản lý danh mục",
    url:"manageCategory.php"
},
{
    width: 16,
    height: 16,
    position: "-121px -1633px",
    activePosition: "-121px -1590px",
    title: "Quản lý sản phẩm",
    url:"manageProduct.php"
},
{
    width: 16,
    height: 18,
    position: "-165px -1632px",
    activePosition: "-165px -1589px",
    title: "Quản lý bài viết",
    url:"news.php"
},
{
    width: 20,
    height: 18,
    position: "-206px -1631px",
    activePosition: "-206px -1588px",
    title: "Thống kê",
    url:"statistical.php"
},
{
    width: 14,
    height: 17,
    position: "-254px -1632px",
    activePosition: "-254px -1589px",
    title: "Quản lý hình ảnh",
    url:"manageImage.php"
},
    // {
    //     width: 18,
    //     height: 17,
    //     position: "-294px -1632px",
    //     activePosition: "-294px -1589px",
    //     title: "kho"
    // },
    // {
    //     width: 18,
    //     height: 17,
    //     position: "-339px -1633px",
    //     activePosition: "-339px -1590px",
    //     title: "Công cụ dụng cụ"
    // },
    // {
    //     width: 16,
    //     height: 16,
    //     position: "-382px -1632px",
    //     activePosition: "-382px -1589px",
    //     title: "Tài sản cố định"
    // },
    // {
    //     width: 17,
    //     height: 18,
    //     position: "-427px -1634px",
    //     activePosition: "-427px -1591px",
    //     title: "Thuế"
    // },
    // {
    //     width: 17,
    //     height: 17,
    //     position: "-471px -1633px",
    //     activePosition: "-471px -1590px",
    //     title: "Giá thành"
    // },
    // {
    //     width: 15,
    //     height: 16,
    //     position: "-514px -1632px",
    //     activePosition: "-514px -1590px",
    //     title: "Tổng hợp"
    // },
    // {
    //     width: 16,
    //     height: 16,
    //     position: "-382px -1664px",
    //     activePosition: "-427px -1664px",
    //     title: "Ngân sách"
    // },
    // {
    //     width: 14,
    //     height: 13,
    //     position: "-552px -1636px",
    //     activePosition: "-552px -1593px",
    //     title: "Báo cáo"
    // },
    // {
    //     width: 17,
    //     height: 14,
    //     position: "-207px -1667px",
    //     activePosition: "-251px -1667px",
    //     title: "Phân tích tài chính"
    // }

];
const className = ".navbar .menu-item-list";
$(window).on('load', function (e) {
    const navbar = new NabBar(data, className)
    navbar.render();
    navbar.setUpEvents();
});




class NabBar {
    constructor(data, className) {
        this.className = className;
        this.data = data;
    }

    render() {
        this.data.forEach((value, index) => {
            $(this.className)
                .append(`<a href=${value.url}> 
                        <div class="menu-item ${index}-th">
                        <div></div>
                        <div style="background-position: ${value.position}; width:${value.width}px; height:${value.height}px;"></div>
                        <div>${value.title}</div>
                        </div>
                </a>`);

        })
    }

    setUpEvents() {
        let prev = -1;
        for (let i = 0; i < data.length; i++) {

            const item = $(`.${i}-th`).click(function () {


                if (item.hasClass('menu-item-active')) {
                    item.removeClass('menu-item-active');
                    $(`.${i}-th div:nth-child(2)`)
                        .css('background-position', `${data[i].position}`);
                }
                else {
                    if (prev >= 0) {
                        $(`.${prev}-th`).removeClass('menu-item-active');
                        $(`.${prev}-th div:nth-child(2)`)
                            .css('background-position', `${data[prev].position}`);
                    }


                    prev = i;
                    item.addClass('menu-item-active');
                    $(`.${i}-th div:nth-child(2)`)
                        .css('background-position', `${data[i].activePosition}`);
                }
            })
        }
    }
}
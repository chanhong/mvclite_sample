<?php
$this->_view_data['header_title'] = 'External Customized Pager';
?>

<style>
        .external-pager {
            margin: 10px 0;
        }

        .external-pager .jsgrid-pager-current-page {
            background: #c4e2ff;
            color: #fff;
        }
    </style>

    <h1>External Customized Pager</h1>
    <div id="externalPager" class="external-pager"></div>

    <div id="jsGrid"></div>

    <script>
        $(function() {

            $("#jsGrid").jsGrid({
                height: "70%",
                width: "100%",
                paging: true,
                pageSize: 15,
                pageButtonCount: 5,
                pagerContainer: "#externalPager",
                pagerFormat: "current page: {pageIndex} &nbsp;&nbsp; {first} {prev} {pages} {next} {last} &nbsp;&nbsp; total pages: {pageCount} total items: {itemCount}",
                pagePrevText: "<",
                pageNextText: ">",
                pageFirstText: "<<",
                pageLastText: ">>",
                pageNavigatorNextText: "&#8230;",
                pageNavigatorPrevText: "&#8230;",
                fields: [
                    { name: "Name", type: "text", width: 150 },
                    { name: "Age", type: "number", width: 50 },
                    { name: "Address", type: "text", width: 200 },
                    { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
                    { name: "Married", type: "checkbox", title: "Is Married" }
                ],
                data: db.clients
            });

        });
    </script>


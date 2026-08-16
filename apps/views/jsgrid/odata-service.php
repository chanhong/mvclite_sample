<?php
$this->_view_data['header_title'] = 'OData Service (FR)';
?>

    <style>
        .rating {
            color: #F8CA03;
        }
    </style>

    <h1>OData Service</h1>
    <div id="jsGrid"></div>

    <script>
        $(function() {

            $("#jsGrid").jsGrid({
                height: "auto",
                width: "auto",
                sorting: true,
                paging: false,
                autoload: true,
                controller: {
                    loadData: function() {
                        var d = $.Deferred();

                        $.ajax({
                            url: "https://services.odata.org/V3/(S(3mnweai3qldmghnzfshavfok))/OData/OData.svc/Products",
                            dataType: "json"
                        }).done(function(response) {
                            d.resolve(response.value);
                        });

                        return d.promise();
                    }
                },
                fields: [
                    { name: "Name", type: "text", width: 100 },
                    { name: "Description", type: "textarea", width: 200 },
                    { name: "Rating", type: "number", width: 150, align: "center",
                        itemTemplate: function(value) {
                            return $("<div>").addClass("rating").append(Array(value + 1).join("&#9733;"));
                        }
                    },
                    { name: "Price", type: "number", width: 100,
                        itemTemplate: function(value) {
                            return value.toFixed(2) + "$"; }
                    }
                ]
            });

        });
    </script>

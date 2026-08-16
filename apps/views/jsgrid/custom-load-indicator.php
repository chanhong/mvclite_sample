<?php
$this->_view_data['header_title'] = 'Custom Load Indicator';
?>


    <style>
        .rating {
            color: #F8CA03;
        }
    </style>

    <h1>Custom Load Indicator</h1>
    <div id="jsGrid"></div>

    <script>
        $(function() {

            $("#jsGrid").jsGrid({
                height: "50%",
                width: "100%",
                sorting: true,
                paging: false,
                autoload: true,
                controller: {
                    loadData: function() {
                        var d = $.Deferred();

                        $.ajax({
                            url: "http://services.odata.org/V3/(S(3mnweai3qldmghnzfshavfok))/OData/OData.svc/Products",
                            dataType: "json"
                        }).done(function(response) {
                            setTimeout(function() {
                                d.resolve(response.value);
                            }, 2000);
                        });

                        return d.promise();
                    }
                },
                loadIndicator: function(config) {
                    var container = config.container[0];
                    var spinner = new Spinner();

                    return {
                        show: function() {
                            spinner.spin(container);
                        },
                        hide: function() {
                            spinner.stop();
                        }
                    };
                },
                fields: [
                    { name: "Name", type: "text" },
                    { name: "Description", type: "textarea", width: 150 },
                    { name: "Rating", type: "number", width: 50, align: "center",
                        itemTemplate: function(value) {
                            return $("<div>").addClass("rating").append(Array(value + 1).join("&#9733;"));
                        }
                    },
                    { name: "Price", type: "number", width: 50,
                        itemTemplate: function(value) {
                            return value.toFixed(2) + "$"; }
                    }
                ]
            });

        });
    </script>
</body>
</html>

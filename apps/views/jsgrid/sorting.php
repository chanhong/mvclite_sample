<?php
$this->_view_data['header_title'] = 'Sorting';
?>


    <style>
        .sort-panel {
            padding: 10px;
            margin: 10px 0;
            background: #fcfcfc;
            border: 1px solid #e9e9e9;
            display: inline-block;
        }
    </style>

    <h1>Sorting</h1>
    <div class="sort-panel">
        <label>Sorting Field:
            <select id="sortingField">
                <option>Name</option>
                <option>Age</option>
                <option>Address</option>
                <option>Country</option>
                <option>Married</option>
            </select>
            <button type="button" id="sort">Sort</button>
        </label>
    </div>

    <div id="jsGrid"></div>

    <script>
        $(function() {

            $("#jsGrid").jsGrid({
                height: "70%",
                width: "100%",
                autoload: true,
                selecting: false,
                controller: db,
                fields: [
                    { name: "Name", type: "text", width: 150 },
                    { name: "Age", type: "number", width: 50 },
                    { name: "Address", type: "text", width: 200 },
                    { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
                    { name: "Married", type: "checkbox", title: "Is Married" }
                ]
            });

            $("#sort").click(function() {
                var field = $("#sortingField").val();
                $("#jsGrid").jsGrid("sort", field);
            });

        });
    </script>

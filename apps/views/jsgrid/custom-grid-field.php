<?php
$this->_view_data['header_title'] = 'Custom Grid DateField';
?>

        <style>
        .hasDatepicker {
            width: 100px;
            text-align: center;
        }

        .ui-datepicker * {
            font-family: 'Helvetica Neue Light', 'Open Sans', Helvetica;
            font-size: 14px;
            font-weight: 300 !important;
        }
    </style>
    <h1>Custom Grid DateField</h1>
    <div id="jsGrid"></div>

    <script>
        $(function() {

            var MyDateField = function(config) {
                jsGrid.Field.call(this, config);
            };

            MyDateField.prototype = new jsGrid.Field({
                sorter: function(date1, date2) {
                    return new Date(date1) - new Date(date2);
                },

                itemTemplate: function(value) {
                    return new Date(value).toDateString();
                },

                insertTemplate: function(value) {
                    return this._insertPicker = $("<input>").datepicker({ defaultDate: new Date() });
                },

                editTemplate: function(value) {
                    return this._editPicker = $("<input>").datepicker().datepicker("setDate", new Date(value));
                },

                insertValue: function() {
                    return this._insertPicker.datepicker("getDate").toISOString();
                },

                editValue: function() {
                    return this._editPicker.datepicker("getDate").toISOString();
                }
            });

            jsGrid.fields.myDateField = MyDateField;

            $("#jsGrid").jsGrid({
                height: "70%",
                width: "100%",
                inserting: true,
                editing: true,
                sorting: true,
                paging: true,
                fields: [
                    { name: "Account", width: 150, align: "center" },
                    { name: "Name", type: "text" },
                    { name: "RegisterDate", type: "myDateField", width: 100, align: "center" },
                    { type: "control", editButton: false, modeSwitchButton: false }
                ],
                data: db.users
            });

        });
    </script>

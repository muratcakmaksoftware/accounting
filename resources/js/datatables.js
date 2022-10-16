import '../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css';

import DataTable from 'datatables.net-dt/js/dataTables.dataTables.min';
window.DataTable = DataTable;
DataTable(window, window.$);

// Datatable global configuration
(function ($, DataTable) {
    $.extend(true, DataTable.defaults, {
        language: {
            url: "languages/datatables/tr.json"
        }
    });
})(jQuery, jQuery.fn.dataTable);

function tableToExcel(tableId, name) {
    name = (name === undefined) ? 'output' : name;

    //getting values of current time for generating the file name
    var dt = new Date();
    var day = dt.getDate();
    var month = dt.getMonth() + 1;
    var year = dt.getFullYear();
    var hour = dt.getHours();
    var mins = dt.getMinutes();
    var postfix = day + "-" + month + "-" + year + "_" + hour + "h" + mins;

    //creating a temporary HTML link element (they support setting file names)
    var a = document.createElement('a');

    //getting data from our div that contains the HTML table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById(tableId);
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    a.href = data_type + ', ' + table_html;

    //setting the file name
    a.download = name.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '_' + postfix + '.xls';

    //triggering the function
    a.click();
}

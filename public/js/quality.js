function printdiv(){
    var divstr = document.getElementById("printpage").innerHTML;
    var header = '<header><div align="center"><h3 style="color:#EB5005"> Your Header </h3></div><br></header><hr><br>';
    var footer = "";
    var popupWin = window.open('', '_blank', 'left=1,top=1,width=1100,height=600,directories=0,titlebar=0,status=0,resizable=1,location=0,personalbar=0,scrollbars=1,statusbar=0,toolbar=0,menubar=0');
    popupWin.document.open();
    popupWin.document.write('<html><head><title>统计报表</title><style type="text/css">@media print{@page {size:landscape;}} table{width:1000px;font-size:11px;word-spacing:1px;line-height:10pt;padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;}</style></head><body onload="window.print()"><p style="font-size: xx-small;">' + divstr + '</p></body></html>' + footer);
    popupWin.document.close();
    return false;
}

function printdiv0(){
    var divstr = document.getElementById("printpage").innerHTML;
    var header = '<header><div align="center"><h3 style="color:#EB5005"> Your Header </h3></div><br></header><hr><br>';
    var footer = "";
    var popupWin = window.open('', '_blank', 'left=1,top=1,width=1100,height=600,directories=0,titlebar=0,status=0,resizable=1,location=0,personalbar=0,scrollbars=1,statusbar=0,toolbar=0,menubar=0');
    popupWin.document.open();
    popupWin.document.write('<html><head><title>统计报表</title><style type="text/css">@media print{@page {size:portrait;}} table{border:1px solid black;} th{border:1px solid black;padding:5px;background-color:grey;color:white;} td{border:1px solid black;padding:5px;}</style></head><body onload="window.print()"><p style="font-size: xx-small;">' + divstr + '</p></body></html>' + footer);
    popupWin.document.close();
    return false;
}
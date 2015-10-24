<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"></meta>
</head>
<?php

$conn = oci_connect('system', '4r3e2w1q', '192.168.1.99/orcl', 'AL32UTF8'); // 'ZHS16GBK'

$stid = oci_parse($conn, 'select * from pub_class_office');
// $stid = oci_parse($conn, 'select * from nls_database_parameters');

oci_execute($stid);
oci_close($conn);
echo "测试页面本身中文显示情况";

echo "<table>\n";
while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "  <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>

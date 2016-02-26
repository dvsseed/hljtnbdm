<tr><td>A1C</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&lt;6.0</td><td>{{ $count[0][1] }}</td><td>{{ round($count[0][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;6.0&sim;&lt;6.5</td><td>{{ $count[0][2] }}</td><td>{{ round($count[0][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;6.5&sim;&lt;7.0</td><td>{{ $count[0][3] }}</td><td>{{ round($count[0][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;7.0&sim;&lt;7.5</td><td>{{ $count[0][4] }}</td><td>{{ round($count[0][4] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;7.5&sim;&lt;8.0</td><td>{{ $count[0][5] }}</td><td>{{ round($count[0][5] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;8.0&sim;&lt;8.5</td><td>{{ $count[0][6] }}</td><td>{{ round($count[0][6] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;8.5&sim;&lt;9.0</td><td>{{ $count[0][7] }}</td><td>{{ round($count[0][7] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;9.0&sim;&lt;9.5</td><td>{{ $count[0][8] }}</td><td>{{ round($count[0][8] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;9.5&sim;&lt;10.0</td><td>{{ $count[0][9] }}</td><td>{{ round($count[0][9] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;10.0</td><td>{{ $count[0][10] }}</td><td>{{ round($count[0][10] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>LDL</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&lt;1.81</td><td>{{ $count[1][1] }}</td><td>{{ round($count[1][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;1.81&sim;&lt;2.59</td><td>{{ $count[1][2] }}</td><td>{{ round($count[1][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;2.59&sim;&lt;3.37</td><td>{{ $count[1][3] }}</td><td>{{ round($count[1][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;3.37</td><td>{{ $count[1][4] }}</td><td>{{ round($count[1][4] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>TG</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&lt;1.70</td><td>{{ $count[2][1] }}</td><td>{{ round($count[2][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;1.70&sim;&lt;2.26</td><td>{{ $count[2][2] }}</td><td>{{ round($count[2][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;2.26&sim;&lt;5.65</td><td>{{ $count[2][3] }}</td><td>{{ round($count[2][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&ge;5.65</td><td>{{ $count[2][4] }}</td><td>{{ round($count[2][4] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>eGFR</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&ge;90</td><td>{{ $count[3][1] }}</td><td>{{ round($count[3][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;90&sim;&ge;60</td><td>{{ $count[3][2] }}</td><td>{{ round($count[3][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;60&sim;&ge;45</td><td>{{ $count[3][3] }}</td><td>{{ round($count[3][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;45&sim;&ge;30</td><td>{{ $count[3][4] }}</td><td>{{ round($count[3][4] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;30&sim;&ge;15</td><td>{{ $count[3][5] }}</td><td>{{ round($count[3][5] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;15</td><td>{{ $count[3][6] }}</td><td>{{ round($count[3][6] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>BP</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&lt;120/80</td><td>{{ $count[4][1] }}</td><td>{{ round($count[4][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;130/80</td><td>{{ $count[4][2] }}</td><td>{{ round($count[4][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;140/80</td><td>{{ $count[4][3] }}</td><td>{{ round($count[4][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>&lt;150/90</td><td>{{ $count[4][4] }}</td><td>{{ round($count[4][4] / $count[0][0], 2) * 100 }}%</td></tr>

<tr><td>BMI</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><18.5</td><td>{{ $count[0][1] }}</td><td>{{ round($count[0][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥18.5~<22</td><td>{{ $count[0][2] }}</td><td>{{ round($count[0][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥22~<23</td><td>{{ $count[0][3] }}</td><td>{{ round($count[0][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥23~<24</td><td>{{ $count[0][4] }}</td><td>{{ round($count[0][4] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥24~<27</td><td>{{ $count[0][5] }}</td><td>{{ round($count[0][5] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥27~<30</td><td>{{ $count[0][6] }}</td><td>{{ round($count[0][6] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥30~<35</td><td>{{ $count[0][7] }}</td><td>{{ round($count[0][7] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥35~<40</td><td>{{ $count[0][8] }}</td><td>{{ round($count[0][8] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>≥40</td><td>{{ $count[0][9] }}</td><td>{{ round($count[0][9] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>腰围</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>男性<90</td><td>{{ $count[1][1] }}</td><td>{{ round($count[1][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>女性<80</td><td>{{ $count[1][2] }}</td><td>{{ round($count[1][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>吸烟</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[2][1] }}</td><td>{{ round($count[2][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>饮酒</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[3][1] }}</td><td>{{ round($count[3][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>牙周病</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[4][1] }}</td><td>{{ round($count[4][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>咀嚼</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>异常</td><td>{{ $count[5][1] }}</td><td>{{ round($count[5][1] / $count[0][0], 2) * 100 }}%</td></tr>

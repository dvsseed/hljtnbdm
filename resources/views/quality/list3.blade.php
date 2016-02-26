<tr><td>肾病变</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>无</td><td>{{ $count[0][1] }}</td><td>{{ round($count[0][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>stage1</td><td>{{ $count[0][2] }}</td><td>{{ round($count[0][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>stage2</td><td>{{ $count[0][3] }}</td><td>{{ round($count[0][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>stage3a</td><td>{{ $count[0][4] }}</td><td>{{ round($count[0][4] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>stage3b</td><td>{{ $count[0][5] }}</td><td>{{ round($count[0][5] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>stage4</td><td>{{ $count[0][6] }}</td><td>{{ round($count[0][6] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>stage5</td><td>{{ $count[0][7] }}</td><td>{{ round($count[0][7] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>周边血管病变</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[1][1] }}</td><td>{{ round($count[1][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>神经病变</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[2][1] }}</td><td>{{ round($count[2][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>视网膜病变</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[3][1] }}</td><td>{{ round($count[3][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>白内障</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[4][1] }}</td><td>{{ round($count[4][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>冠心病</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>无</td><td>{{ $count[5][1] }}</td><td>{{ round($count[5][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&lt;1年</td><td>{{ $count[5][2] }}</td><td>{{ round($count[5][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&ge;1年</td><td>{{ $count[5][3] }}</td><td>{{ round($count[5][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>脑中风</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>无</td><td>{{ $count[6][1] }}</td><td>{{ round($count[6][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&lt;1年</td><td>{{ $count[6][2] }}</td><td>{{ round($count[6][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&ge;1年</td><td>{{ $count[6][3] }}</td><td>{{ round($count[6][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>失明</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>无</td><td>{{ $count[7][1] }}</td><td>{{ round($count[7][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&lt;1年</td><td>{{ $count[7][2] }}</td><td>{{ round($count[7][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&ge;1年</td><td>{{ $count[7][3] }}</td><td>{{ round($count[7][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>透析</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>无</td><td>{{ $count[8][1] }}</td><td>{{ round($count[8][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&lt;1年</td><td>{{ $count[8][2] }}</td><td>{{ round($count[8][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&ge;1年</td><td>{{ $count[8][3] }}</td><td>{{ round($count[8][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>下肢截肢</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>无</td><td>{{ $count[9][1] }}</td><td>{{ round($count[9][1] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&lt;1年</td><td>{{ $count[9][2] }}</td><td>{{ round($count[9][2] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>&nbsp;</td><td>有，发生时间&ge;1年</td><td>{{ $count[9][3] }}</td><td>{{ round($count[9][3] / $count[0][0], 2) * 100 }}%</td></tr>
<tr><td>高低血糖就医</td><td>总笔数</td><td>{{ $count[0][0] }}</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>有</td><td>{{ $count[10][1] }}</td><td>{{ round($count[10][1] / $count[0][0], 2) * 100 }}%</td></tr>

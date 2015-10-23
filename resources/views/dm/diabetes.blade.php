<button type="button" class="btn btn-warning"
    data-container="body" data-toggle="popover" data-placement="bottom"
    title="{{ Auth::user()->name }}--成绩"
    data-content="
        ************** 11 -- {{ $grade->math }} **************
        ************** 22 -- {{ $grade->english }} **************
        ************** 33 -- {{ $grade->c }} **************
        ************** 44 -- {{ $grade->sport }} **************
        ************** 55 -- {{ $grade->think }} **************
        ************** 66 -- {{ $grade->soft }} **************
    ">
    点击,查看成绩
</button>

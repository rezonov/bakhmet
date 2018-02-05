<div class="menu_wrapper">
    <ul class="menu">
        @foreach($menu as $m)
            @if($m->level == 0)
                <li>{{$m->name}}
                <ul>
                    <li><a href=#>Sudmenu 1</a></li>
                    <li><a href=#>Sudmenu 1</a></li>
                    <li><a href=#>Sudmenu 1</a></li>
                </ul></li>

            @endif

            @endforeach
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
    </ul>
</div>
<div class="menu_wrapper">
    <ul class="menu">
        @foreach($menu as $m)
            @if($m->level == 0)
                <li>{{$m->name}}
                <ul class="submenu">
                    <li><a href=#>Sudmenu 1</a></li>
                    <li><a href=#>Sudmenu 1</a></li>
                    <li><a href=#>Sudmenu 1</a></li>
                </ul>
                </li>

            @endif

            @endforeach
            <li class="menu-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Навигация <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Меню</a></li>
                    <li><a href="#">Меню</a></li>
                    <li class="menu-item dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Меню</a>
                        <ul class="dropdown-menu">
                            <li class="menu-item "><a href="#">Подменю</a></li>
                            <li class="menu-item "><a href="#">Подменю</a></li>
                            <li class="menu-item dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Подменю</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Подменю в квадрате</a></li>
                                    <li><a href="#">Подменю в квадрате</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
        <li>Насосы</li>
    </ul>
</div>
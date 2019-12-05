<div class="content-side content-side-full">
    <ul class="nav-main">
        <li class="nav-main-heading">
            <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">MENÜ</span>
        </li>
        <li>
            <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
            </a>
        </li>

        <li class="{{ request()->is('dashboard/settings/*') ? 'open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span
                    class="sidebar-mini-hide">Ayarlar</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('dashboard/settings/invoice') ? 'active' : '' }}"
                       href="{{action('SettingController@SettingInvoice')}}">
                        Fatura Ayarları
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('dashboard/settings/users') ? 'active' : '' }}"
                       href="{{action('UserController@index')}}">
                        Kullanıcılar
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('dashboard/settings/templates/*') ? 'active' : '' }}"
                       href="{{action('TemplateController@index')}}">
                        Proje Ayarları
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->is('dashboard/project/*') ? 'open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-game-controller"></i><span
                    class="sidebar-mini-hide">Projeler</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('dashboard/project/') ? 'active' : '' }}"
                       href="{{action('ProjectController@index')}}">
                        Proje Listesi
                    </a>
                </li>

            </ul>
        </li>

        <li class="{{ request()->is('dashboard/stock/*') ? ' open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span
                    class="sidebar-mini-hide">Stoklar</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('dashboard/stock/') ? ' active' : '' }}"
                       href="{{ action('StockController@index') }}">Stok Listesi</a>
                </li>

            </ul>
        </li>

        <li class="{{ request()->is('dashboard/cari/*') ? ' open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span
                    class="sidebar-mini-hide">Cari Hesaplar</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('dashboard/cari/') ? ' active' : '' }}"
                       href="{{ action('CariController@index') }}">Cari Kartlar</a>
                </li>

            </ul>
        </li>

        <li class="{{ request()->is('dashboard/invoices/*') ? ' open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span
                    class="sidebar-mini-hide">Fatura</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('dashboard/invoices/') ? ' active' : '' }}"
                       href="{{ action('InvoiceController@index') }}">Fatura Listesi</a>
                </li>
                <li>
                    <a class="{{ request()->is('dashboard/invoices/create') ? ' active' : '' }}"
                       href="{{ action('InvoiceController@create') }}">Yeni Fatura</a>
                </li>


            </ul>
        </li>


        <li class="{{ request()->is('examples/*') ? ' open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span
                    class="sidebar-mini-hide">Examples</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('examples/plugin-helper') ? ' active' : '' }}"
                       href="/examples/plugin-helper">Plugin with JS Helper</a>
                </li>
                <li>
                    <a class="{{ request()->is('examples/plugin-init') ? ' active' : '' }}"
                       href="/examples/plugin-init">Plugin with JS Init</a>
                </li>
                <li>
                    <a class="{{ request()->is('examples/blank') ? ' active' : '' }}"
                       href="/examples/blank">Blank</a>
                </li>
            </ul>
        </li>
        <li class="nav-main-heading">
            <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">More</span>
        </li>
        <li>
            <a href="/">
                <i class="si si-globe"></i><span class="sidebar-mini-hide">Landing</span>
            </a>
        </li>
    </ul>
</div>


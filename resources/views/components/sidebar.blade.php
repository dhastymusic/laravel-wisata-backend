<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Dhasty</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Users</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('users.index') }}">All Users</a></li>
                    <li><a class="nav-link" href="{{ route('users.create') }}">Add New</a></li>
                </ul>

            </li>

            <li class="menu-header">Categories</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('categories.index') }}">All Categories</a></li>
                    <li><a class="nav-link" href="{{ route('categories.create') }}">Add New</a></li>
                </ul>
            </li>

            <li class="menu-header">Products</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-box"></i><span>Products</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('products.index') }}">All Products</a></li>
                    <li><a class="nav-link" href="{{ route('products.create') }}">Add New</a></li>
                </ul>
            </li>


    </aside>
</div>

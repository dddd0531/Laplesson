{{-- resouces/views/navbar.blade.php --}}

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <!-- スマホやタブレットで表示した時のメニューボタン -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- ブランド表示 -->
            <a class="navbar-brand" href="/"><img src="/image/logo.png" alt="ラプレッスン" width="150px"></a>
        </div>

        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- 左寄せメニュー -->
            <ul class="nav navbar-nav">
                <li><a href="/admin/home">Home</a></li>
                <li><a href="/admin/lesson">Lesson</a></li>
                <li><a href="/admin/userslist">Users</a></li>
                <li><a href="/admin/category">Category</a></li>
                <li><a href="/admin/news">News</a></li>
                <li><a href="/admin/help">Help</a></li>
            </ul>
            <!-- 右寄せメニュー -->
            <ul class="nav navbar-nav navbar-right">
                    <!-- ドロップダウンメニュー -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::guard('admin')->user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/admin/register">Register</a></li>
                            <li><a href="/admin/logout">Logout</a></li>
                        </ul>
                    </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

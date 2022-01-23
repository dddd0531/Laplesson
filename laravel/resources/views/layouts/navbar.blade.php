{{-- resouces/views/navbar.blade.php --}}
 
<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- スマホやタブレットで表示した時のメニューボタン -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
 
            <!-- ブランド表示 -->
            <a class="navbar-brand" href="/"><img src="/image/logo5.png" alt="ラプレッスン" width="170px"></a>
        </div>
 
        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="navbar">
            <!-- 左寄せメニュー -->
            <ul class="nav navbar-nav navbar-right">
            	@if (Auth::user())
            	<li class="<?php if(Request::path() == "mypage"){ echo 'active';} ?>"><a href="/mypage">マイページ</a></li>
                @endif
                <li class="<?php if(Request::path() == "lesson" || strstr(Request::path(),"lesson/") || strstr(Request::path(),"lesson/category/")){ echo 'active';} ?>"><a href="/lesson">レッスン一覧</a></li>
                @if (Auth::guest())
                	<li class="<?php if(Request::path() == "about"){ echo 'active';} ?>"><a href="/about">ラプレッスンとは？</a></li>
                @endif
                <li class="<?php if(Request::path() == "guide"){ echo 'active';} ?>"><a href="/guide">学習ガイド</a></li>
                @if (Auth::guest())
                    {{-- ログインしていない時 --}}
                    <li class="<?php if(Request::path() == "auth/login"){ echo 'active';} ?>"><a href="/auth/login">ログイン</a></li>
                    <li><a href="/auth/register" class="btn btn-info navbar-btn">ユーザー登録</a></li>
                @else
                    {{-- ログインしている時 --}}
 
                    <!-- ドロップダウンメニュー -->
                      @if (Auth::user()->avater)
                        <img class="avater" src="/media/{{ Auth::user()->avater }}" alt="{{ Auth::user()->name }}さん">
                      @else
                        <img class="avater" src="/media/avater.jpg" alt="{{ Auth::user()->name }}さん">
                      @endif                     
                    
                    <li class="dropdown">
                    
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/mypage/profile">プロフィール</a></li>
                            <li><a href="/auth/logout">ログアウト</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
 
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@extends('layouts.default')

@section('headernav')
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">Tweet-app</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item mr-3">
            <a class="nav-link" href="/posts">ホーム</a>
          </li>
          <li class="nav-item mr-3">
            <a class="nav-link" href="/users/{{ Auth::user()->id }}">プロフィール</a>
          </li>
          <li class="nav-item mr-3">
            <a class="nav-link" href="{{ url('posts/create') }}">新規投稿</a>
          </li>
          <li class="nav-item mr-3">
            <a class="nav-link" href="/users">ユーザー一覧</a>
          </li>
          <li class="nav-item mr-3">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
              ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </nav>
    
    
@endsection
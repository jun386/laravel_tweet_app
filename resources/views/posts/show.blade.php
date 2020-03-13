@extends('layouts.default')

<!--@include('layouts.header_nav')-->

@section('content')
  
  <div class="row justify-content-center mb-5">
    <div class="col-md-8 mb-3">
      <div class="card">
        <div class="card-header p-3 w-100 d-flex bg-white border-bottom-0">
          <img src="{{ asset('storage/image/' .$post->user->image) }}" class="rounded-circle" width="50" height="50">
          <div class="ml-2 d-flex flex-column">
            <a href="{{ url('users/' .$post->user->id) }}" class="text-dark mt-2 ml-2">{{ $post->user->name }}</a>
          </div>
          <div class="d-flex justify-content-end flex-grow-1">
              <p class="mb-0 text-secondary">{{ $post->created_at->format('Y-m-d H:i') }}</p>
          </div>
        </div>
        <div class="card-body">
          {!! nl2br(e($post->content)) !!}
        </div>
        <div class="card-footer py-1 d-flex justify-content-end bg-white">
          @if($post->user->id === Auth::user()->id)
            <div class="dropdown mr-3 d-flex align-items-center">
              <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-fw"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <form method="POST" action="{{ url('posts/' .$post->id) }}" class="mb-0">
                  @csrf
                  @method('DELETE')

                  <a href="{{ url('posts/' .$post->id .'/edit') }}" class="dropdown-item">編集</a>
                  <button type="submit" class="dropdown-item del-btn">削除</button>
                </form>
              </div>
            </div>
          @endif
          <div class="mr-3 d-flex align-items-center">
            <a href="{{ url('posts/' .$post->id) }}"><i class="far fa-comment fa-fw"></i></a>
            <p class="mb-0 text-secondary">{{ count($post->comments) }}</p>
          </div>
          <div class="d-flex align-items-center">
              @if(!in_array($user->id, array_column($post->likes->toArray(), 'user_id'), TRUE))
                <form method="POST" action="{{ url('likes/') }}" class="mb-0">
                  @csrf
                  <input type="hidden" name="post_id" value="{{ $post->id }}">
                  <button type="submit" class="btn p-0 border-0 text-primary bg-white"><i class="far fa-heart fa-fw"></i></button>
                </form>
              @else
                <form method="POST" action="{{ url('likes/' .array_column($post->likes->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                  @csrf
                  @method('DELETE')
                  
                  <button type="submit" class="btn p-0 border-0 text-danger bg-white"><i class="fas fa-heart fa-fw"></i></button>
                </form>
              @endif
            <p class="mb-0 text-secondary">{{ count($post->likes) }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row justify-content-center">
    <div class="col-md-8 mb-3">
      <ul class="list-group">
        @forelse($comments as $comment)
          <li class="list-group-item">
            <div class="py-3 w-100 d-flex">
              <img src="{{ asset('storage/image/' .$comment->user->image) }}" class="rounded-circle" width="50" height="50">
              <div class="ml-2 d-flex flex-column">
                <a href="{{ url('users/' .$comment->user->id) }}" class="text-dark mt-2 ml-2">{{ $comment->user->name }}</a>
              </div>
              <div class="d-flex justify-content-end flex-grow-1">
                <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
              </div>
            </div>
            <div class="py-3">
              {!! nl2br(e($comment->content)) !!}
            </div>
            @if($comment->user->id === Auth::user()->id)
              <form method="POST" action="{{ url('comments/' .$comment->id) }}" class="mb-0">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="del-btn">削除</button>
              </form>
            @endif
          </li>
        @empty
          <li class="list-group-item">
            <p class="mb-0 text-secondary">コメントはまだありません。</p>
          </li>
        @endforelse
          <li class="list-group-item">
            <div class="py-3">
              <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                
                <div class="form-group row mb-0">
                  <div class="col-md-12 p-3 w-100 d-flex">
                    <img src="{{ asset('storage/image/' .$user->image) }}" class="rounded-circle" width="50" height="50">
                    <div class="ml-2 d-flex flex-column">
                      <a href="{{ url('users/' .$user->id) }}" class="text-dark mt-2 ml-2">{{ $user->name }}</a>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" rows="4">{{ old('content') }}</textarea>
                    @error('content')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-md-12 text-right">
                    <p class="mb-4 text-danger">140文字以内</p>
                    <button type="submit" class="btn btn-primary">
                      コメントする
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
      </ul>
    </div>
  </div>
  
@endsection
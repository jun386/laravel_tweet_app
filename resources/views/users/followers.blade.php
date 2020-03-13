@extends('layouts.default')

<!--@include('layouts.header_nav')-->


@section('content')
  
  <div class="row justify-content-center">
      <div class="col-md-8">
          @forelse($user_followers as $user)
              <div class="card">
                  <div class="card-header p-3 w-100 d-flex">
                      <img src="{{ asset('storage/image/' .$user->image) }}" class="rounded-circle" width="50" height="50">
                      <div class="ml-3 d-flex align-items-center">
                          <a href="{{ url('users/' .$user->id) }}" class="text-dark lead">{{ $user->name }}</a>
                      </div>
                      @if($user->id !== Auth::id())
                        @if (auth()->user()->isFollowed($user->id))
                            <div class="px-3 pt-3">
                                <span class="d-flex bg-secondary text-light">フォローされています</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-end flex-grow-1 align-items-center">
                            @if (auth()->user()->isFollowing($user->id))
                                <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    
                                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                                </form>
                            @else
                                <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </form>
                            @endif
                        </div>
                      @endif
                  </div>
              </div>
          @empty
            <h1>no followers</h1>
          @endforelse
      </div>
  </div>
  <div class="my-4 d-flex justify-content-center">
      {{ $user_followers->links() }}
  </div>
  
@endsection
@extends('layouts.default')

<!--@include('layouts.header_nav')-->

@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        <img src="{{ asset('storage/image/' .$user->image) }}" class="rounded-circle" width="100" height="100">
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if($user->id === Auth::user()->id)
                                    <a href="{{ url('users/' .$user->id .'/edit')}}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if($is_following)
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
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">ツイート数</p>
                                <span>{{ $post_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <a href="{{ url('users/' .$user->id .'/following') }}" class="font-weight-bold text-dark mb-3">フォロー数</a>
                                <span>{{ $follow_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <a href="{{ url('users/' .$user->id .'/followers') }}" class="font-weight-bold text-dark mb-3">フォロワー数</a>
                                <span>{{ $follower_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($timelines))
            @foreach($timelines as $timeline)
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-header p-3 w-100 d-flex bg-white border-bottom-0">
                            <img src="{{ asset('storage/image/' .$user->image) }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column flex-grow-1">
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="mb-0">{{ $timeline->user->name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $timeline->content }}
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if ($timeline->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="{{url('posts/' .$timeline->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <a href="{{ url('posts/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                            <button type="submit" class="dropdown-item del-btn">削除</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('posts/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @if(!in_array(Auth::user()->id, array_column($timeline->likes->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('likes/') }}" class="mb-0">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $timeline->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary bg-white"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('likes/' .array_column($timeline->likes->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn p-0 border-0 text-danger bg-white"><i class="fas fa-heart fa-fw"></i></button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary">{{ count($timeline->likes) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="my-4 d-flex justify-content-center">
            {{ $timelines->links() }}
        </div>
        
    </div>
    
    
@endsection
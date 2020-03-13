@extends('layouts.default')

<!--@include('layouts.header_nav')-->

@section('content')
    
  <div class="row justify-content-center">
    @if(isset($timelines))
      @foreach($timelines as $timeline)
        <div class="col-md-8 mb-3">
          <div class="card">
            <div class="card-header p-3 w-100 d-flex bg-white border-bottom-0">
              <img src="{{ asset('storage/image/' .$timeline->user->image) }}" class="rounded-circle" width="50" height="50">
              <div class="ml-2 d-flex flex-column">
                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-dark mt-2 ml-2">{{ $timeline->user->name }}</a>
              </div>
              <div class="d-flex justify-content-end flex-grow-1">
                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
              </div>
            </div>
            <div class="card-body">
              {!! nl2br(e($timeline->content)) !!}
            </div>
            <div class="card-footer py-1 d-flex justify-content-end bg-white">
              @if($timeline->user->id === Auth::user()->id)
                <div class="dropdown mr-3 d-flex align-items-center">
                  <a href="#" role="button" id="dropdownMunuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-fw"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMunuLink">
                    <form method="POST" action="{{ url('posts/' .$timeline->id) }}" class="mb-0">
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
                @if(!in_array($user->id, array_column($timeline->likes->toArray(), 'user_id'), TRUE))
                  <form method="POST" action="{{ url('likes/') }}" class="mb-0">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $timeline->id }}">
                    <button type="submit" class="btn p-0 border-0 text-primary bg-white"><i class="far fa-heart fa-fw"></i></button>
                  </form>
                @else
                  <form method="POST" action="{{ url('likes/' .array_column($timeline->likes->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
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
  </div>
  
  <div class="my-4 d-flex justify-content-center">
    {{ $timelines->links() }}
  </div>
    
@endsection
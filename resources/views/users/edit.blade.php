@extends('layouts.default')

<!--@include('layouts.header_nav')-->

@section('content')
    
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update</div>
        <div class="card-body">
          <form method="POST" action="{{ url('users/' .$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group row align-items-center">
              <label for="image" class="col-md-4 col-form-label text-md-right">プロフィール写真</label>
              
              <div class="col-md-6 d-flex align-items-center">
                <img src="{{ asset('storage/image/' .$user->image) }}" class="mr-2 rounded-circle" width="80" height="80" alt="profile_image">
                <input type="file" name="image" class="@error('image') is-invalid @enderror" autocomplete="image">
                @error('image')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
              
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
              
              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">更新する</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    
    
@endsection
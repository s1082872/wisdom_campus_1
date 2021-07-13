@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">新增地點資料</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('places.store') }}"  enctype="multipart/form-data" >
          @csrf



          <div class="form-group">
              <label for="name">觀光景點</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <div class="form-group">
              <label for="input">內容</label>
              <input type="text" class="form-control" name="input"/>
          </div>
          <div class="form-group">
              <label class="col-md-4 text-right">選擇照片</label>
              <div class="col-md-8">
                <input type="file" name="photo"/>
              </div>
          </div>
          <button type="submit" class="btn btn-primary-outline">確定新增</button>
      </form>
  </div>
</div>
</div>
@endsection
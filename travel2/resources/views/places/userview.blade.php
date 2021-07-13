@extends('base')

@section('main')

<div class="row">

  <div class="col-sm-12">
    <h1 class="display-3" style="margin: 20px 0 20px 35%;">觀光景點</h1>    
    <table class="table table-striped">
      <thead>
        <tr>
          <td><h5>旅遊地點</h5></td>
          <td><h5>詳細內容</h5></td>
          <td><h5>旅遊照片</h5></td>
        </tr>

      </thead>
      <tbody>

          @foreach($places as $place)

          <tr>
            <td>{{$place->name}}</td>
            <td>{{$place->input}}</td>
            <td>
              <img src="{{ URL::to('/') }}/images/{{ $place->photo_path }}" class="img-thumbnail" width="250" />
            </td>
              
          </tr>

          @endforeach

      </tbody>
    </table>
<div>

</div>

@endsection
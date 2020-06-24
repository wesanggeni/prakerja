@extends('frontend/layout.default')

@section('title')
Prakerja
@endsection

@section('content')

@if ($user = Sentinel::check())
<div class="" style="margin-top: 19px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">item heading</h5>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus.</p>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">item heading</h5>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus.</p>
          </a>
        </div>
      </div>
      <div class="col-6">
        <div class="card mb-4">
          <div class="card-header">
            Buat Postingan
          </div>
          <div class="card-body">
            <div class="media bg-white">
              <img src="{{$user->avatar}}" style="max-width: 40px;" class="mr-3 rounded-circle">
              <div class="media-body">
                <div class="form-group">
                  <textarea class="statusForm form-control" rows="3"></textarea>
                </div>
                <div class="pull-left">
                  <button type="button" class="statusCreate btn btn-sm btn-primary">Kirim</button>
                  <button type="button" class="btn btn-sm btn-link disabled"><i class="fa fa-picture-o"></i> Foto</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="status-fill">


<div class="card">
  <div class="card-body">
    <pre>
    <?php
    
    $json_string = json_encode($data, JSON_PRETTY_PRINT);
    print_r($json_string);
    
    ?>
    </pre>
  </div>
</div>


<?php
if (count($data) > 0) {
foreach ($data as $key => $value) {
?>
<div class="card">
  <div class="card-body">
    <?php echo $value->status; ?>
  </div>
</div>
<?php
} }
?>


        </div>
      </div>
      <div class="col">
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <?php

            if (count($circleRecom) > 0) {
              foreach ($circleRecom as $key => $value) {
  echo $value->first_name.' - <span class="act-circle" data-id="'.$value->id.'">Add Circle</span>
  <br>';
              }
            }
            ?>
          </div>
        </div>
      </div>


      <div class="col">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            <small class="text-muted">Donec id elit non mi porta.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            <small class="text-muted">Donec id elit non mi porta.</small>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    //-- create status
    $(".statusCreate").click(function(){
      statusCreate();
    });

    function statusCreate() {
      const data = {
        status: $('.statusForm').val(),
      };
      fetch('{{url("api/status/create")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        console.log(data.data.status);
        $(".status-fill").prepend('<div class="card mb-2">'+
          '<div class="card-body">'+
          '<div class="media bg-white">'+
            '<img src="{{$user->avatar}}" style="max-width:40px;" class="mr-3 rounded-circle">'+
            '<div class="media-body">'+
              '<h6 class="card-subtitle mb-2 mt-2 text-muted">{{$user->first_name}}</h6>'
              +data.data.status+
            '</div>'+
          '</div>'+
          '</div>'+
        '</div>');
      })
      .catch((error) => {
        console.error(error);
      });
    }

    $(".act-circle").click(function circleCreate() {
      const data = {
        dataId: $(this).attr("data-id"),
      };
      fetch('{{url("api/circle/create")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        console.log(data);
      })
      .catch((error) => {
        console.error(error);
      });
    });

  });
</script>
@endif

@endsection
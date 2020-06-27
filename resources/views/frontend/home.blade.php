@extends('frontend/layout.default')
@section('title')
Prakerja
@endsection
@section('content')
@if ($user = Sentinel::check())
<div class="" style="margin-top: 19px; height: 100% !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 mb-2">
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

      <div class="col-lg-5">
        <div class="card mb-c">
          <div class="card-header">
            Buat Postingan
          </div>
          <div class="card-body">
            <div class="media bg-white">
              <img src="{{$user->avatar_md}}" style="max-width: 40px;" class="mr-3">
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
        <div class="fill-status">
          <!-- load status -->
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <?php
              if (count($circleRecom) > 0) {
                foreach ($circleRecom as $key => $value) {
              echo $value->name.' - <a href="#" class="act-circle" data-id="'.$value->id.'">Add Circle</a>
              <br>';
                }
              }
              ?>
          </div>
        </div>
      </div>
      <div class="col-lg-2">

        <div class="homeright-wrap border">
          <div class="homeright-item">

  <div class="media p-3">
    <img src="{{$user->avatar_sm}}" alt="John Doe" class="mr-3 rounded-circle" style="width:30px;">
    <div class="media-body">
      <a href="">Setan Alas</a>     
    </div>
  </div>

          </div>
        </div>

      </div>
      <!-- end col-2 -->

    </div>
  </div>
</div>

@include('frontend.layout.chat')

<script>
$(document).ready(function() {
  loadStatus();
  //-- create status
  $(".statusCreate").click(function() {
    statusCreate();
  });
  $(document).on("click", '.act-up1', function(event) {
    const data = {
      dataId: $(this).attr("data-id"),
      status: 1,
    };
    fetch('{{url("api/status/thumbs-one")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        $(this).toggleClass("act");
        $(this).find('.tl1').html(data.data.count_up);
        $(this).next('.act-down1').find('.tl1').html(data.data.count_down);
        if ($(this).next('.act-down1').hasClass('act')) {
          $(this).next('.act-down1').toggleClass("act");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });
  $(document).on("click", '.act-down1', function(event) {
    const data = {
      dataId: $(this).attr("data-id"),
      status: 2,
    };
    fetch('{{url("api/status/thumbs-one")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        $(this).toggleClass("act");
        $(this).find('.tl1').html(data.data.count_down);
        $(this).prev('.act-up1').find('.tl1').html(data.data.count_up);
        if ($(this).prev('.act-up1').hasClass('act')) {
          $(this).prev('.act-up1').toggleClass("act");
        }
      })
      .catch((error) => {
        //console.error(error);
      });
  });
  $(document).on("click", '.act-up2', function(event) {
    const data = {
      dataId: $(this).attr("data-id"),
      status: 1,
    };
    fetch('{{url("api/status/thumbs-two")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        $(this).toggleClass("act");
        $(this).find('.tl1').html(data.data.count_up);
        $(this).next('.act-down2').find('.tl1').html(data.data.count_down);
        if ($(this).next('.act-down2').hasClass('act')) {
          $(this).next('.act-down2').toggleClass("act");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });
  $(document).on("click", '.act-down2', function(event) {
    const data = {
      dataId: $(this).attr("data-id"),
      status: 2,
    };
    fetch('{{url("api/status/thumbs-two")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        $(this).toggleClass("act");
        $(this).find('.tl1').html(data.data.count_down);
        $(this).prev('.act-up2').find('.tl1').html(data.data.count_up);
        if ($(this).prev('.act-up2').hasClass('act')) {
          $(this).prev('.act-up2').toggleClass("act");
        }
      })
      .catch((error) => {
        //console.error(error);
      });
  });
  $(document).on("click", '.act-up3', function(event) {
    const data = {
      dataId: $(this).attr("data-id"),
      status: 1,
    };
    fetch('{{url("api/status/thumbs-three")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        $(this).toggleClass("act");
        $(this).find('.tl1').html(data.data.count_up);
        $(this).next('.act-down3').find('.tl1').html(data.data.count_down);
        if ($(this).next('.act-down3').hasClass('act')) {
          $(this).next('.act-down3').toggleClass("act");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });
  $(document).on("click", '.act-down3', function(event) {
    const data = {
      dataId: $(this).attr("data-id"),
      status: 2,
    };
    fetch('{{url("api/status/thumbs-three")}}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        $(this).toggleClass("act");
        $(this).find('.tl1').html(data.data.count_down);
        $(this).prev('.act-up3').find('.tl1').html(data.data.count_up);
        if ($(this).prev('.act-up3').hasClass('act')) {
          $(this).prev('.act-up3').toggleClass("act");
        }
      })
      .catch((error) => {
        //console.error(error);
      });
  });
  /* --------------------------- */
  $(document).on("keypress", '.act-write1', function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
      const data = {
        dataId: $(this).attr("data-id"),
        comment: $(this).val(),
      };
      fetch('{{url("api/status/comment")}}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer {{$user->token}}'
          },
          body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
          //console.log(data);
          $('.fill-comment[data-id="' + $(this).attr("data-id") + '"]').prepend('<div class="box-wrap">' +
            '<div class="box-img">' +
            '<img src="' + data.data.user.avatar_sm + '" class="st2">' +
            '</div>' +
            '<div class="box-com">' +
            '<div class="comment-area">' +
            '<p class="status-name">' +
            '<button class="post-act act-comment">' +
            '<i class="fa fa-ellipsis-v"></i>' +
            '</button>' +
            data.data.user.name +
            '<span class="smt">baru saja</span></p>' +
            '<div class="act-line">' +
            '<button data-id="' + data.data.id + '" class="act-up2 post-act">' +
            '<i class="fa fa-thumbs-o-up"></i>' +
            '<span class="tl1">0</span>' +
            '</button>' +
            '<button data-id="' + data.data.id + '" class="act-down2 post-act">' +
            '<i class="fa fa-thumbs-o-down"></i>' +
            '<span class="tl1">0</span>' +
            '</button>' +
            '</div>' +
            '<div class="post-content">' + data.data.comment +
            '</div>' +
            '</div>' +
            '<div data-id="' + data.data.id + '" class="act-reply2 post-act t-comment1 cF"><i class="fa fa-angle-down" aria-hidden="true"></i>0 Balasan</div>' +
            '<!-- comment reply -->' +
            '<div data-id="' + data.data.id + '" class="show-reply">' +
            '<div class="box-wrap bt">' +
            '<div class="box-img-sub">' +
            '<img src="' + data.data.user.avatar_sm + '" class="st2">' +
            '</div>' +
            '<div class="box-com-sub">' +
            '<textarea data-id="' + data.data.id + '" class="act-write2 form-control textarea-autosize" rows="1" placeholder="Tulis balasan"></textarea>' +
            '</div>' +
            '</div>' +
            '<div data-id="' + data.data.id + '" class="fill-reply">' +
            '<!-- content reply -->' +
            '</div>' +
            '</div>' +
            '<!-- end comment reply -->' +
            '</div>' +
            '</div>');
          $(this).val('');
        })
        .catch((error) => {
          //console.error(error);
        });
    }
  });
  $(document).on("keypress", '.act-write2', function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
      const data = {
        dataId: $(this).attr("data-id"),
        comment: $(this).val(),
      };
      fetch('{{url("api/status/reply")}}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer {{$user->token}}'
          },
          body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
          //console.log(data);
          $('.fill-reply[data-id="' + $(this).attr("data-id") + '"]').append('<div class="box-wrap">' +
            '<div class="box-img-sub">' +
            '<img src="' + data.data.user.avatar_sm + '" class="st2">' +
            '</div>' +
            '<div class="box-com-sub">' +
            '<div class="comment-area">' +
            '<p class="status-name">' + data.data.user.name +
            '<span class="smt">baru saja</span>' +
            '</p>' +
            '<div class="act-line">' +
            '<button data-id="' + data.data.id + '" class="act-up3 post-act">' +
            '<i class="fa fa-thumbs-o-up"></i>' +
            '<span class="tl1">0</span>' +
            '</button>' +
            '<button data-id="' + data.data.id + '" class="act-down3 post-act">' +
            '<i class="fa fa-thumbs-o-down"></i>' +
            '<span class="tl1">0</span>' +
            '</button>' +
            '</div>' +
            '<div class="post-content">' + data.data.comment_reply +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
          $(this).val('');
        })
        .catch((error) => {
          //console.error(error);
        });
    }
  });
  /* --------------------------- */
  $(document).on("click", '.act-reply1', function(event) {
    const attrId = $(this).attr("data-id");
    $(this).toggleClass("act");
    $('.show-comment[data-id="' + attrId + '"]').toggle(function() {
      $(this).css('display', 'block');
    });
    /* load comment */
    if ($(this).hasClass('cF')) {
      const data = {
        dataId: attrId,
      };
      fetch('{{url("api/status/get-comment")}}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer {{$user->token}}'
          },
          body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
          //console.log(data.data);
          if (data.data.data !== 'undefined') {
            data.data.data.forEach(function(item) {
              var statusUp = '';
              var statusDown = '';
              if (item.thumb_up_status === 1) {
                statusUp = ' act';
              }
              if (item.thumb_down_status === 1) {
                statusDown = ' act';
              }
              $('.fill-comment[data-id="' + attrId + '"]').append('<div class="box-wrap">' +
                '<div class="box-img">' +
                '<img src="' + item.user.avatar_sm + '" class="st2">' +
                '</div>' +
                '<div class="box-com">' +
                '<div class="comment-area">' +
                '<p class="status-name">' +
                '<button class="post-act act-comment">' +
                '<i class="fa fa-ellipsis-v"></i>' +
                '</button>' +
                item.user.name +
                '<span class="smt">baru saja</span></p>' +
                '<div class="act-line">' +
                '<button data-id="' + item.id + '" class="act-up2 post-act' + statusUp + '">' +
                '<i class="fa fa-thumbs-o-up"></i>' +
                '<span class="tl1">' + item.thumb_up_count + '</span>' +
                '</button>' +
                '<button data-id="' + item.id + '" class="act-down2 post-act' + statusDown + '">' +
                '<i class="fa fa-thumbs-o-down"></i>' +
                '<span class="tl1">' + item.thumb_down_count + '</span>' +
                '</button>' +
                '</div>' +
                '<div class="post-content">' + item.comment +
                '</div>' +
                '</div>' +
                '<div data-id="' + item.id + '" class="act-reply2 post-act t-comment1 cF"><i class="fa fa-angle-down" aria-hidden="true"></i>' + item.comment_reply_count + ' Balasan</div>' +
                '<!-- comment reply -->' +
                '<div data-id="' + item.id + '" class="show-reply">' +
                '<div class="box-wrap">' +
                '<div class="box-img-sub">' +
                '<img src="' + item.user.avatar_sm + '" class="st2">' +
                '</div>' +
                '<div class="box-com-sub">' +
                '<textarea data-id="' + item.id + '" class="act-write2 form-control textarea-autosize" rows="1" placeholder="Tulis balasan"></textarea>' +
                '</div>' +
                '</div>' +
                '<div data-id="' + item.id + '" class="fill-reply">' +
                '<!-- content reply -->' +
                '</div>' +
                '</div>' +
                '<!-- end comment reply -->' +
                '</div>' +
                '</div>');
            });
          }
        })
        .catch((error) => {
          //console.error(error);
        });
    }
    $(this).removeClass('cF');
  });
  $(document).on("click", '.act-reply2', function(event) {
    $(this).toggleClass("act");
    $('.show-reply[data-id="' + $(this).attr("data-id") + '"]').toggle(function() {
      $(this).css('display', 'block');
    });
    /* load reply */
    if ($(this).hasClass('cF')) {
      const attrId = $(this).attr("data-id");
      const data = {
        dataId: attrId,
      };
      fetch('{{url("api/status/get-reply")}}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer {{$user->token}}'
          },
          body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
          //console.log(data.data);
          if (data.data.data !== 'undefined') {
            data.data.data.forEach(function(item) {
              var statusUp = '';
              var statusDown = '';
              if (item.thumb_up_status === 1) {
                statusUp = ' act';
              }
              if (item.thumb_down_status === 1) {
                statusDown = ' act';
              }
              $('.fill-reply[data-id="' + attrId + '"]').append('<div class="box-wrap">' +
                '<div class="box-img-sub">' +
                '<img src="' + item.user.avatar_sm + '" class="st2">' +
                '</div>' +
                '<div class="box-com-sub">' +
                '<div class="comment-area">' +
                '<p class="status-name">' +
                '<button class="post-act act-reply">' +
                '<i class="fa fa-ellipsis-v"></i>' +
                '</button>' +
                item.user.name +
                '<span class="smt">6 menit lalu</span>' +
                '</p>' +
                '<div class="act-line">' +
                '<button data-id="' + item.id + '" class="act-up3 post-act' + statusUp + '">' +
                '<i class="fa fa-thumbs-o-up"></i>' +
                '<span class="tl1">' + item.thumb_up_count + '</span>' +
                '</button>' +
                '<button data-id="' + item.id + '" class="act-down3 post-act' + statusDown + '">' +
                '<i class="fa fa-thumbs-o-down"></i>' +
                '<span class="tl1">' + item.thumb_down_count + '</span>' +
                '</button>' +
                '</div>' +
                '<div class="post-content">' + item.comment_reply +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
            });
          }
        })
        .catch((error) => {
          //console.error(error);
        });
    }
    $(this).removeClass('cF');
  });
  /* --------------------------- */
  function loadStatus() {
    fetch('{{url("api/status")}}', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer {{$user->token}}'
        },
      })
      .then(response => response.json())
      .then(data => {
        //console.log(data.data);
        $.each(data.data.data, function(key, value) {
          var statusUp = '';
          var statusDown = '';
          if (value.thumb_up_status === 1) {
            statusUp = ' act';
          }
          if (value.thumb_down_status === 1) {
            statusDown = ' act';
          }
          $(".fill-status").prepend('<div data-id="' + value.id + '" class="post-item">' +
            '<div class="post-body">' +
            '<!-- status coloumn -->' +
            '<div class="media">' +
            '<img src="' + value.user.avatar_sm + '" class="st1">' +
            '<div class="media-body">' +
            '<p class="status-name">' +
            '<button class="post-act act-post">' +
            '<i class="fa fa-ellipsis-v"></i>' +
            '</button>' +
            value.user.name +
            '</p>' +
            '<p class="status-time">6 menit lalu</p>' +
            '</div>' +
            '<div class="act-line row bdt">' +
            '<button data-id="' + value.id + '" class="act-up1 post-act' + statusUp + '">' +
            '<i class="fa fa-thumbs-o-up"></i>' +
            '<span class="tl1">' + value.thumb_up_count + '</span>' +
            '</button>' +
            '<button data-id="' + value.id + '" class="act-down1 post-act' + statusDown + '">' +
            '<i class="fa fa-thumbs-o-down"></i>' +
            '<span class="tl1">' + value.thumb_down_count + '</span>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '<div class="status-box">' +
            value.status +
            '</div>' +
            '<div data-id="' + value.id + '" class="act-reply1 post-act t-comment cF"><i class="fa fa-angle-down" aria-hidden="true"></i>' + value.comment_count + ' Balasan</div>' +
            '<!-- end status coloumn -->' +
            '<!-- comment box -->' +
            '<div data-id="' + value.id + '" class="show-comment">' +
            '<div class="box-wrap bt">' +
            '<div class="box-img">' +
            '<img src="{{$user->avatar_sm}}" class="st2">' +
            '</div>' +
            '<div class="box-com">' +
            '<textarea data-id="' + value.id + '" class="act-write1 form-control textarea-autosize" rows="1" placeholder="Tulis balasan"></textarea>' +
            '</div>' +
            '</div>' +
            '<div data-id="' + value.id + '" class="fill-comment">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<!-- end show comment -->' +
            '</div>');
        });
      })
      .catch((error) => {
        console.error(error);
      });
  }

  function statusCreate() {
    var data = {
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
        $(".fill-status").prepend('<div data-id="' + data.data.id + '" class="post-item">' +
          '<div class="post-body">' +
          '<!-- status coloumn -->' +
          '<div class="media">' +
          '<img src="' + data.data.user.avatar_sm + '" class="st1">' +
          '<div class="media-body">' +
          '<p class="status-name">' +
          '<button class="post-act act-post">' +
          '<i class="fa fa-ellipsis-v"></i>' +
          '</button>' +
          data.data.user.name + '</p>' +
          '<p class="status-time">baru saja</p>' +
          '</div>' +
          '<div class="act-line row bdt">' +
          '<button data-id="' + data.data.id + '" class="act-up1 post-act">' +
          '<i class="fa fa-thumbs-o-up"></i>' +
          '<span class="tl1">0</span>' +
          '</button>' +
          '<button data-id="' + data.data.id + '" class="act-down1 post-act">' +
          '<i class="fa fa-thumbs-o-down"></i>' +
          '<span class="tl1">0</span>' +
          '</button>' +
          '</div>' +
          '</div>' +
          '<div class="status-box">' +
          data.data.status +
          '</div>' +
          '<div data-id="' + data.data.id + '" class="act-reply1 post-act t-comment cF"><i class="fa fa-angle-down" aria-hidden="true"></i>0 Balasan</div>' +
          '<!-- end status coloumn -->' +
          '<!-- comment box -->' +
          '<div data-id="' + data.data.id + '" class="show-comment">' +
          '<div class="box-wrap bt">' +
          '<div class="box-img">' +
          '<img src="' + data.data.user.avatar_sm + '" class="st2">' +
          '</div>' +
          '<div class="box-com">' +
          '<textarea data-id="' + data.data.id + '" class="act-write1 form-control textarea-autosize" rows="1" placeholder="Tulis balasan"></textarea>' +
          '</div>' +
          '</div>' +
          '<div data-id="' + data.data.id + '" class="fill-comment">' +
          '</div>' +
          '</div>' +
          '</div>' +
          '<!-- end show comment -->' +
          '</div>');
        $('.statusForm').val('');
      })
      .catch((error) => {
        //console.error(error);
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
        alert('lingkaran baru telah ditambahkan!');
      })
      .catch((error) => {
        console.error(error);
      });
  });
});
</script>
@endif
@endsection
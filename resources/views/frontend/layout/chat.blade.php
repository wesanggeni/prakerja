@if ($user = Sentinel::check())
<!-- start wrap chat -->
<div class="chat-wrap">
  <!-- chat item -->
  <div data-id="0" class="chat">
    <div data-id="0" class="chat-head">
      <div class="head-left">
        <img src="{{$user->avatar_sm}}" class="chat-avatar">
        <span>{{$user->name}}</span>
      </div>
      <div class="head-right">
        <i data-id="0" class="close fa fa-times" aria-hidden="true"></i>
      </div>
    </div>
    <div data-id="0" class="chat-box">
      <div class="box-list">

        <div class="chat-contact" style="border-bottom: 1px #eee solid;"></div> 

        @if (count($circleRecom) > 0)
        @foreach ($circleRecom as $key => $value)
        @if ($value->id != $user->id)
        <div data-id="{{$value->id}}" data-chat="uid{{$user->id}}_uid{{$value->id}}"  data-username="{{$value->name}}" class="chat-list">
          <div class="list-left">
            <img data-id="{{$value->id}}" src="{{$value->avatar_sm}}" class="chat-profile">
          </div>
          <div class="list-center">
            <span data-id="{{$value->id}}" class="chat-username">{{$value->name}}</span>
          </div>
          <div class="list-right">
            <span class="chat-on active">
              <i class="fa fa-circle" aria-hidden="true"></i>
            </span>
          </div>
        </div>
        @endif
        @endforeach
        @endif

      </div>
    </div>
  </div>
  <!-- end chat item -->
</div>
<!-- end wrap chat -->

<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-analytics.js"></script>
<script>
  var firebaseConfig = {
    apiKey: "AIzaSyBIwrpfZK-GtP9Jcvxhbq6UncDyZ5SUJxA",
    authDomain: "prakerja-id.firebaseapp.com",
    databaseURL: "https://prakerja-id.firebaseio.com",
    projectId: "prakerja-id",
    storageBucket: "prakerja-id.appspot.com",
    messagingSenderId: "252978396695",
    appId: "1:252978396695:web:3b4ebcedd90ad375b82652",
    measurementId: "G-KR0NQQMXZB"
  };
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>

<script>
$(document).ready(function(){

  var dataUserBook = firebase.database().ref('chat_book/uid{{$user->id}}');
  dataUserBook.on('child_added', function(snapshot) {
      var contact = snapshot.val();
      displayChatContact(contact.contactName, contact.lastupdate, contact.senderId, contact.receiverId, contact.chatId);
      //console.log(snapshot.val());
  });

  function displayChatContact(contactName, lastupdate, thisSenderId, thisReceiverId, thisChatId) {
    $('.chat-contact').append('<div data-id="'+thisReceiverId+'" data-chat="'+thisChatId+'" data-username="'+contactName+'" class="chat-list">'+
          '<div class="list-left">'+
            '<img data-id="'+thisReceiverId+'" src="{{url("/img")}}/'+thisReceiverId+'/avatar-md.jpg" class="chat-profile">'+
          '</div>'+
          '<div class="list-center">'+
            '<span data-id="'+thisReceiverId+'" class="chat-username">'+contactName+'</span>'+
          '</div>'+
          '<div class="list-right">'+
            '<span class="chat-on active">'+
              '<i class="fa fa-circle" aria-hidden="true"></i>'+
            '</span>'+
          '</div>'+
        '</div>');
    //$('.chat-contact')[0].scrollTop = $('.chat-contact')[0].scrollHeight;
  };

  $(document).on("keypress", '.chat-write', function(e) {    
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {

      var attrId = $(this).attr("data-id");
      var senderId = $(this).attr("data-sender");
      var receiverId = $(this).attr("data-receiver");
      var chatId = $(this).attr("data-chat");
      var senderName = $(this).attr("data-namesender");
      var receiverName = $(this).attr("data-namereceiver");

      var dataChat = firebase.database().ref('chat/'+chatId);
      var childRef1 = firebase.database().ref('chat_book/uid'+senderId).child(chatId);
      var childRef2 = firebase.database().ref('chat_book/uid'+receiverId).child(chatId);

      var dates = new Date().toLocaleDateString("en-US") +' '+ new Date().toLocaleTimeString("en-US");
      var message = $(this).val();

      dataChat.push({
          senderId: senderId,
          receiverId: receiverId,
          message: message,
          dates: dates
      });

      childRef1.set({ contactName: receiverName, senderId: senderId, receiverId:receiverId, lastupdate: dates, chatId: chatId })
      .then(function() { })
      .catch(function(error) { });

      childRef2.set({ contactName: senderName, senderId: receiverId, receiverId:senderId, lastupdate: dates, chatId: chatId })
      .then(function() { })
      .catch(function(error) { });

      $(this).val('');
    }
  });

  function displayChatMessage(thisReceiverId, thisSenderId, message, dates, nameSender, nameReceiver) {
      if ('{{$user->id}}' != thisSenderId) {
          $('.fill-chat'+thisReceiverId).append('<!-- chat out -->'+
        '<div class="box-out">'+
          '<span class="chat-name">'+nameSender+'</span>'+
          '<div class="chat-out">'
            +message+
          '</div>'+
          '<span class="chat-time">'+dates+'</span>'+
        '</div>'+
        '<!-- end chat out -->');
      } else {
        $('.fill-chat'+thisReceiverId).append('<!-- chat me -->'+
        '<div class="box-me">'+
          '<span class="chat-name">'+nameReceiver+'</span>'+
          '<div class="chat-me">'
            +message+
          '</div>'+
          '<span class="chat-time">'+dates+'</span>'+
        '</div>'+
        '<!-- end chat me -->');
      }
      $('.fill-chat'+thisReceiverId)[0].scrollTop = $('.fill-chat'+thisReceiverId)[0].scrollHeight;
  };

  //----------------------------------------

  $(document).on("click", '.chat-head', function(event) {
    $('.chat-box[data-id="' + $(this).attr("data-id") + '"]').toggle();
    $('.fill-chat'+$(this).attr("data-id"))[0].scrollTop = $('.fill-chat'+$(this).attr("data-id"))[0].scrollHeight;
  });
  $(document).on("click", '.close', function(event) {
    $('.chat[data-id="' + $(this).attr("data-id") + '"]').remove();
  });

  $(document).on("click", '.chat-list', function(event) {
    var attrId = $(this).attr("data-id");
    var attrImg = $('.chat-profile[data-id="' + $(this).attr("data-id") + '"]').attr("src");
    var attrName = $(this).attr("data-username");
    var chatId = $(this).attr("data-chat");

    if (!$('.cC'+attrId)[0]) {

    /* fire-chat */
    var dataChatProduct = firebase.database().ref('chat/'+chatId);
    dataChatProduct.on('child_added', function(snapshot) {
      var message = snapshot.val();
      displayChatMessage(attrId, message.senderId, message.message, message.dates, '{{$user->name}}' ,attrName);
    });
    /* end fire-chat */

    $('.chat-wrap').prepend('<!-- chat item -->'+
  '<div data-id="'+attrId+'" class="chat cC'+attrId+'">'+
    '<div data-id="'+attrId+'" class="chat-head">'+
      '<div class="head-left">'+
        '<img src="'+attrImg+'" class="chat-avatar">'+
        '<span>'+attrName+'</span>'+
      '</div>'+
      '<div class="head-right">'+
        '<i data-id="'+attrId+'" class="close fa fa-times" aria-hidden="true"></i>'+
      '</div>'+
    '</div>'+
    '<div data-id="'+attrId+'" class="chat-box">'+
      '<div data-id="'+attrId+'" class="fill-chat'+attrId+' box-list">'+
        '<!-- start chat -->'+

        '<!-- end chat -->'+
      '</div>'+
        '<!-- start write -->'+
        '<div class="end-chat"></div>'+
        '<div class="chat-start">'+
          '<textarea data-id="'+attrId+'" data-sender="{{$user->id}}" data-receiver="'+attrId+'" data-chat="'+chatId+'" data-namesender="{{$user->name}}" data-namereceiver="'+attrName+'" class="chat-write" placeholder="Tulis pesan"></textarea>'+
        '</div>'+
        '<!-- end write -->'+
    '</div>'+
  '</div>'+
  '<!-- end chat item -->');
  }
    //$('.chat-box[data-id="' + $(this).attr("data-id") + '"]').toggle();
  });

 });
</script>
@endif
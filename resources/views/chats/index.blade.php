@extends('layouts.app')

@section('content')
    <div class="auto-center">
        <div id="chat_list" class="chat_list">
            <div class='table'>
                @foreach ($messages as $message)
                    <div class='tr'>
                        <div class='lbl'>{{ $message->name }}</div> 
                        <div class='desc'>{{ $message->content }} </div> 
                        <div class='date'>{{ $message->created_at }}</div> 
                    </div>  
                @endforeach
            </div>
        </div>

        <form id="form" action="{{ route('chat.store') }}" method="post">
            @csrf
            <div class="submit_chat">
                <span class="input">
                    <input type="text" id="name" name="name" placeholder="닉네임" required="required" autofocus="autofocus" /></span><span class="desc">
                    <textarea id="content" name="content" rows="5" placeholder="내용" required="required"></textarea>
                </span>
                <div class="btn_group">
                    <button class="btn-submit" id="submit" type="submit">등록</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        fn_moveScrollEnd();

        document.getElementById("form").addEventListener('submit', function(e) {
            e.preventDefault();
            fn_insertChat(this);
        });

        document.getElementById("content").addEventListener('keydown', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                document.getElementById("submit").click()
            }
        });

        Echo.channel('chats').listen('MessageSend', (e) => {
            var body = document.getElementById("chat_list");
            var prevScrollHeight = body.scrollHeight;
            var message = e.message;

            var str =  "<div class='tr'>" +
                            "<div class='lbl'>" + message.name + "</div>" +
                            "<div class='desc'>" + message.content + "</div>" +
                            "<div class='date'>" + message.created_at + "</div>" +
                       "</div>";

            body.querySelector('.table').innerHTML += str;

            if(body.scrollTop == (prevScrollHeight - body.offsetHeight))
                fn_moveScrollEnd();
        })

        function fn_insertChat(form) {
            var comAjax = new ComAjax(form);
            comAjax.setUrl(form.action);
            comAjax.ajax();

            document.getElementById("content").value = '';
            document.getElementById("content").focus();
        }

        function fn_moveScrollEnd() {
            var body = document.getElementById("chat_list");
            body.scrollTop = body.scrollHeight;
        }
    </script>
@endsection

@extends('layouts.app')

@section('content')
<div class="board_view auto-center">
    <h3>글보기</h3>
    <div class="table">
        <div class="tr">
            <div class="lbl">작성자</div>
            <div class="desc">{{ $post->name }}</div>
        </div>
        <div class="tr">
            <div class="lbl">제목</div>
            <div class="desc">{{ $post->subject }}</div>
        </div>
        <div class="tr">
            <div class="lbl">내용</div>
            <div class="desc content">{{ $post->content }}</div>
        </div>
    </div>
    <div id="comment_list"></div>
    <form id="comment_form" action="{{ route('comment.store', [ 'postId' => $post->id ]) }}" action="post">
        @csrf
        <div class="submit_comment">
            <span class="input">
                <div class="tr">
                    <input id="name" type="text" name="name" placeholder="닉네임" />
                </div>
                <div class="tr">
                    <input id="pw" type="password" name="pw" placeholder="비밀번호" />
                </div>
            </span>
            <span class="desc">
                <textarea id="content" rows="5" name="content" placeholder="내용"></textarea>
            </span>
            <div class="btn_group">
                <button class="btn-submit" type="submit">등록</button>
            </div>
        </div>
    </form>
    <div class="btn_group">
        <a class="btn-default" href="{{ route('post.index') }}">목록</a>
        <a class="btn-submit" href="{{ route('post.edit', [ 'id' => $post->id ]) }}">수정</a>
        <a class="btn-submit" href="{{ route('post.destroy', [ 'id' => $post->id ]) }}">삭제</a>
    </div>
</div>

<script type="text/javascript">
    fn_selectCommentList();

    document.getElementById("comment_form").addEventListener('submit', function(e){
        e.preventDefault();
        fn_insertComment(this);
    });

    function fn_selectCommentList() {
        var comAjax = new ComAjax();
        comAjax.setUrl("{{ route('comment.index', [ 'postId' => $post->id ]) }}");
        comAjax.setCallback("fn_selectCommentListCallback");
        comAjax.setMethod("GET");
        comAjax.ajax();
    }

    function fn_selectCommentListCallback(data) {
        data = JSON.parse(data);
        var body = document.getElementById("comment_list");
        var str = "<h4>총 댓글 수 : " + data.length + "</h4>";
        str += "<div class='table'>";
        for(var key in data) {
            str +=  "<div class='tr'>" +
                        "<div class='lbl'>" + data[key].name + "</div>" +
                        "<div class='desc'>" + data[key].content + "</div>" +
                        "<div class='date'>" + data[key].created_at + "</div>" +
                        "<div class='delete'>" + "<a href='#' id='opendel'><img src='{{ asset('img/delete.jpg') }}'></a>" + "</div>" +
                        "<input type='hidden' id='idx' value=" + data[key].id + ">" +
                    "</div>";
        };
        str += "</div>";
        body.innerHTML = str;

        for(i=0; i<body.querySelectorAll('#opendel').length; i++) {          
            body.querySelectorAll('#opendel')[i].addEventListener('click', function(e){
                e.preventDefault();
                fn_openDeleteComment(this.parentElement);
            });
        }
    }

    function fn_validateComment() {
        var name = document.getElementById("name").value;
        var pw = document.getElementById("pw").value;
        var content = document.getElementById("content").value;

        if(name.length == 0) { alert("닉네임을 입력해주세요."); return false; }
        if(pw.length == 0) { alert("비밀번호를 입력해주세요."); return false; }
        if(content.length == 0) { alert("내용을 입력해주세요."); return false; }

        return true;
    }

    function fn_insertComment(form) {
        if(fn_validateComment()) {
            var comAjax = new ComAjax(form);
            comAjax.setUrl(form.action);
            comAjax.setCallback('fn_selectCommentList');
            comAjax.ajax();

            document.getElementById("name").value = '';
            document.getElementById("pw").value = '';
            document.getElementById("content").value = '';
        }
    }

    function fn_openDeleteComment(obj) {
        if(document.getElementById("comment_list").querySelector(".btn_group") != null)
            document.getElementById("comment_list").querySelector(".btn_group").remove();
        
        var div = document.createElement("div");
        div.className = "btn_group";
        var str = "<form id='comment_delete_form' action='' method='post'>" +
                    "<input type='hidden' name='_method' value='DELETE'>" +
                    "<input type='hidden' name='_token' value='{{ csrf_token() }}'>" +
                    "<input type='password' id='commentpw' name='pw' placeholder='비밀번호' required>" +
                    "<button id='commentdelete' class='btn-submit' type='submit'>확인</button>" +
                    "<button id='commentcencel' class='btn-submit'>취소</button>" +
                  "</form>";
        div.innerHTML = str;
        
        obj.parentElement.appendChild(div);

        document.getElementById("comment_delete_form").addEventListener('submit', function(e){
            e.preventDefault();
            fn_deleteComment(this);
        });

        document.getElementById("commentcencel").addEventListener('click', function(e){
            e.preventDefault();
            fn_deleteCencel(this);
        });
    }

    function fn_deleteComment(form) {
        var idx = form.parentElement.parentElement.querySelector("#idx").value;
        var url = '{{ route("comment.delete", ":id") }}';
        url = url.replace(':id', idx);

        var comAjax = new ComAjax(form);
        comAjax.setUrl(url);
        comAjax.setCallback("fn_deleteCommentCallback");
        comAjax.ajax();
    }

    function fn_deleteCommentCallback(data) {
        if(data == 1) {
            alert("완료되었습니다.");
            fn_selectCommentList();
        }
        else {
            alert("비밀번호가 일치하지 않습니다.");
        }
    }

    function fn_deleteCencel(obj) {
        obj.parentElement.remove();
    }
</script>
@endsection

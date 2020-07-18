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
    <div class="btn_group">
        <a class="btn-default" href="{{ route('post.index') }}">목록</a>
        <a class="btn-submit" href="{{ route('post.edit', [ 'id' => $post->id ]) }}">수정</a>
        <a class="btn-submit" href="{{ route('post.destroy', [ 'id' => $post->id ]) }}">삭제</a>
    </div>
</div>
@endsection

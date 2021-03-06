@extends('layouts.app')

@section('content')
<div class="board_write auto-center">
    <form action="{{ route('post.delete', [ 'id' => $postId ]) }}" method="post">
        @method('DELETE')
        @csrf
        <fieldset><legend>글삭제</legend>
            <h3>글삭제</h3>
            <div class="table">
                <div class="tr">
                    <div class="lbl"><label for="board_pw">비밀번호</label></div>
                    <div class="desc"><input type="password" id="board_pw" name="pw" size="20" title="비밀번호" required autofocus></div>
                </div>
            </div>
            <div class="btn_group">
                <a class="btn-default" href="{{ route('post.show', [ 'id' => $postId ]) }}">취소</a>
                <button class="btn-submit" type="submit">완료</button>
            </div>
        </fieldset>
    </form>
</div>
@endsection

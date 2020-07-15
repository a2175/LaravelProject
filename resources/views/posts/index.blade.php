@extends('layouts.app')

@section('content')
    <div class="board_list auto-center">
        <h3>총 게시물 수 : {{ $postNum }}</h3>
        <table width="100%">
            <colgroup>
                <col width="10%">
                <col width="60%">
                <col width="15%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td class="al_l"><a href="{{ route('post.show', [ 'id' => $post->id ]) }}">{{ $post->subject }}</a></td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
    
    </script>
@endsection

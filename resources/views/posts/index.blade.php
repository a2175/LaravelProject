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
        <div class="btn_group">
            제목 검색: <input type="text" id="keyword" name="keyword" value="{{ request()->get('keyword') }}">
            <a href="#this" class="btn-submit" id="search">검색</a>
            <a class="btn-default" href="{{ route('post.create') }}">작성</a>
        </div>
        <div id="PAGE_NAVI" style="margin:auto; display:table;"></div>
    </div>

    <script type="text/javascript">
        var params = {
            divId : "PAGE_NAVI",
            pageIndex : "{{ request()->get('page') }}",
            totalCount : {{ $postNum }},
            keyword : "{{ request()->get('keyword') }}",
            eventName : "{{ route('post.index') }}"
        };
        gfn_renderPaging(params);

        document.getElementById("search").addEventListener('click', function(e){
            e.preventDefault();
            fn_openBoardSearchList();
        });
        
        function fn_openBoardSearchList() {
            var keyword = document.getElementById("keyword").value;
            var comSubmit = new ComSubmit();
            comSubmit.setMethod('get');
            comSubmit.setUrl("{{ route('post.index') }}");
            comSubmit.addParam("keyword", keyword);
            comSubmit.submit();
        }
    </script>
@endsection

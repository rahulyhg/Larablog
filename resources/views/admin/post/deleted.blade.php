@extends('admin.layout')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-{{ session('status') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Deleted posts
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Categories</th>
                            <th>Tags</th>
                            <th><i class="fa fa-comment-o" aria-hidden="true"></i></th>
                            <th>Deleted</th>
                            <th>Restore</th>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td><a href="{{route('lb-admin.post.edit', [$post->id]) }}">{{$post->title}}</a></td>
                                    <td>{{$post->author->name}}</td>
                                    <td>
                                        @foreach($post->categories as $category)
                                            {{$category->title}}
                                            {{Helper::appendComma($post->categories,$category)}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($post->tags as $tag)
                                            {{$tag->title}}
                                            {{Helper::appendComma($post->tags,$tag)}}

                                        @endforeach
                                    </td>
                                    <td>{{$post->comments->count()}}</td>
                                    <td>{{$post->deleted_at}}</td>
                                    <td>

                                        <a href="{{ route('restorepost', [$post->id]) }}" class="confirmable"
                                           data-confirm-title="{{ trans('strings.confirm_title') }}"
                                           data-confirm-message="{{ trans('strings.confirm_restore') }}"
                                           data-confirm-ok="{{ trans('strings.restore') }}"
                                           data-confirm-cancel="{{ trans('strings.confirm_cancel') }}"
                                           data-confirm-style="danger">
                                            <i class="fa fa-undo"></i>
                                        </a>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

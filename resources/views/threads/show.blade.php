@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        <div class="body">{{ $thread->body }}</div>
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}

                @if(auth()->check())
                    <form action="{{ $thread->path() . '/replies' }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" placeholder="Have somerhing to say?" class="form-control">
                            </textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Reply">
                        </div>
                    </form>
                @else
                    <p>Please <a href="/login">Sign in</a> to participate in thread</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="#">{{ $thread->creator->name }}</a>
                        and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection

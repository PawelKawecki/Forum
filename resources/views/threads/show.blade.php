@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        <div class="body">{{ $thread->body }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('threads.reply')
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(auth()->check())
                    <form action="{{ $thread->path() . '/replies' }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" placeholder="Have somerhing to say?"
                                      class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Reply">
                        </div>
                    </form>
                @else
                    <p>Please <a href="/login">Sign in</a> to participate in thread</p>
                @endif
            </div>
        </div>
    </div>
@endsection

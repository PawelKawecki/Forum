@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Thread</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form action="{{ url('threads') }}" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <select name="channel_id" class="form-control">
                                        <option value="null">Choose one...</option>
                                            @foreach(\App\Channel::all() as $channel)
                                                <option value="{{ $channel->id }}" @if(old('channel_id') == $channel->id) selected @endif >{{ $channel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input name="title" type="text" class="form-control" placeholder="title" value="{{ old('title') }}">
                                    </div>

                                    <div class="form-group">
                                        <textarea name="body" id="body" cols="30" rows="5" placeholder="Have somerhing to say?" class="form-control">{{ old('body') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Publish">
                                    </div>
                                </form>

                                @if(count($errors))
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

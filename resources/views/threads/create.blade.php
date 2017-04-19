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
                                @if(auth()->check())
                                    <form action="{{ url('threads') }}" method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input name="title" type="text" class="form-control" placeholder="title">
                                        </div>

                                        <div class="form-group">
                                            <textarea name="body" id="body" cols="30" rows="5" placeholder="Have somerhing to say?" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Publish">
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

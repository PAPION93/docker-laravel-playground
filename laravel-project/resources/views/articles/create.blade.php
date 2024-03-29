@extends('layouts.master')

@section('content')
    <div class="page-header">
        ...
    </div>

    <div class="container__forum">
        <form action="{{ route('articles.store') }}" method="POST" role="form" class="form__forum">
            {!! csrf_field() !!}
            <input type="hidden" name="author_id" value="{{ \Auth::id() }}">

            @include('articles.partial.form')

            <div class="form-group">
                <p class="text-center">
                    <a href="{{ route('articles.create') }}" class="btn btn-default">
                        {!! icon('reset') !!} Reset
                    </a>
                    <button type="submit" class="btn btn-primary my-submit">
                        {!! icon('plane') !!} Post
                    </button>
                </p>
            </div>
        </form>
    </div>
@stop

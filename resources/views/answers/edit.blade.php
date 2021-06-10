@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Editing answer for <strong>{{$question->title}}</strong></h3>
                    </div>
                    <hr>
                    <form action="{{ route('questions.answers.update',[$question->id,$answer->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <textarea rows="7" class="form-control @error('body') is-invalid @enderror" name="body">{{old('body') ?? $answer->body}}</textarea>
                            @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

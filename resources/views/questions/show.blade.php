@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{$question->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a class="vote-up" title="This question is useful"><i class="fas fa-caret-up fa-3x"></i></a>
                            <span class="votes-count">1230</span>
                            <a class="vote-down off" title="This question is not useful"><i class="fas fa-caret-down fa-3x"></i></a>
                            <a title="Click to mark as favourite question (Click again to undo)" class="favourite mt-2 favourited">
                                <i class="fas fa-certificate fa-2x"></i>
                                <span class="favourite-count">10</span>
                            </a>

                        </div>
                        <div class="media-body">
                            {!! parsedown($question->body) !!}
                            <div class="float-right">
                                <span class="text-muted">Answered {{$question->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$question->user->url}}">
                                        <img src="{{$question->user->avatar}}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @include('answers._index',[
        'answers'=>$question->answers,
        'answersCount'=>$question->answers_count
   ])
</div>
@endsection

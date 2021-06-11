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
                            <!--upvote question-->>
                            <a class="vote-up {{Auth::guest() ? 'off' : ''}}" title="This question is useful" onclick="event.preventDefault(); document.getElementById('up-vote-question-{{$question->id}}').submit();"><i class="fas fa-caret-up fa-3x"></i></a>
                            <form id="up-vote-question-{{$question->id}}" action="/questions/{{$question->id}}/vote" method="POST" class="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count {{Auth::guest() ? 'off' : ''}}">{{$question->votes_count}}</span>

                            <!--downVote question-->>
                            <a class="vote-down off" title="This question is not useful" onclick="event.preventDefault(); document.getElementById('down-vote-question-{{$question->id}}').submit();"><i class="fas fa-caret-down fa-3x"></i></a>
                            <form id="down-vote-question-{{$question->id}}" action="/questions/{{$question->id}}/vote" method="POST" class="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <!--mark as favourite question-->>
                            <a title="Click to mark as favourite question (Click again to undo)" class="favourite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favourited ? 'favourited' : '') }}" onclick="event.preventDefault(); document.getElementById('favourite-question-{{$question->id}}').submit();">
                                <i class="fas fa-certificate fa-2x"></i>
                                <span class="favourite-count">{{$question->favourites_count}}</span>
                            </a>
                            <form id="favourite-question-{{$question->id}}" action="/questions/{{$question->id}}/favourites" method="POST" class="display:none;">
                                @csrf
                                @if($question->is_favourited)
                                @method('DELETE')
                                @endif
                            </form>

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
    @include('answers._create')
</div>
@endsection

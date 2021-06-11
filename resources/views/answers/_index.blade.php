<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answersCount." ".Str::plural('Answer',$answersCount)}}</h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach($answers as $answer)
                <div class="media">
                    <div class="d-flex flex-column vote-controls">
                        <!--upvote answer-->
                        <a class="vote-up {{Auth::guest() ? 'off' : ''}}" title="This answer is useful" onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{$answer->id}}').submit();"><i class="fas fa-caret-up fa-3x"></i></a>
                        <form id="up-vote-answer-{{$answer->id}}" action="/answers/{{$answer->id}}/vote" method="POST" class="display:none;">
                            @csrf
                            <input type="hidden" name="vote" value="1">
                        </form>

                        <span class="votes-count {{Auth::guest() ? 'off' : ''}}">{{$answer->votes_count}}</span>

                        <!--downVote answer-->
                        <a class="vote-down off" title="This answer is not useful" onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{$answer->id}}').submit();"><i class="fas fa-caret-down fa-3x"></i></a>
                        <form id="down-vote-answer-{{$answer->id}}" action="/answers/{{$answer->id}}/vote" method="POST" class="display:none;">
                            @csrf
                            <input type="hidden" name="vote" value="-1">
                        </form>

                        @can('accept',$answer)
                        <a title="Mark this answer as best answer" class=" mt-2 {{ $answer->status }}" onclick="event.preventDefault(); document.getElementById('accepted-answer-{{ $answer->id }}').submit();">
                            <i class="fas fa-check fa-2x"></i>
                        </a>
                        <form id="accepted-answer-{{ $answer->id }}" action="{{route('answers.accept',$answer->id)}}" method="POST" class="display:none;">
                            @csrf
                        </form>
                        @else
                        @if($answer->is_best)
                        <a title="Author of this question accepted this answer as best answer" class=" mt-2 {{ $answer->status }}">
                            <i class="fas fa-check fa-2x"></i>
                        </a>
                        @endif
                        @endcan

                    </div>
                    <div class="media-body">
                        {!!parsedown($answer->body)!!}
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can('update',$answer)
                                    <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete',$answer)
                                    <form action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" class="form-delete" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <span class="text-muted">Answered {{$answer->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$answer->user->url}}">
                                        <img src="{{$answer->user->avatar}}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

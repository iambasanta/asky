@if($answersCount>0)
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

                        @include('shared._accept',['model'=>$answer])

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
                                @include('shared._author',
                                ['model'=>$answer,'label'=>'answered']
                                )
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
@endif

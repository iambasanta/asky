@if($model instanceof App\Models\Question)
@php
$name = 'question';
$firstURISegment = 'questions';
@endphp
@elseif($model instanceof App\Models\Answer)
@php
$name = 'answer';
$firstURISegment = 'answers';
@endphp
@endif

@php
$formId = $name."-".$model->id;
@$formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp

<div class="d-flex flex-column vote-controls">
    <!--upvote {{ $name }}-->
    <a class="vote-up {{Auth::guest() ? 'off' : ''}}" title="This {{ $name }} is useful" onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();"><i class="fas fa-caret-up fa-3x"></i></a>
    <form id="up-vote-{{ $formId }}" action="{{ $formAction }}" method="POST" class="display:none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>

    <span class="votes-count {{Auth::guest() ? 'off' : ''}}">{{$model->votes_count}}</span>

    <!--downVote {{ $name }}-->
    <a class="vote-down off" title="This {{ $name }} is not useful" onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();"><i class="fas fa-caret-down fa-3x"></i></a>
    <form id="down-vote-{{ $formId }}" action="{{ $formAction }}" method="POST" class="display:none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    <!--mark as favourite {{ $name }}-->
   @if($model instanceof App\Models\Question)
        @include('shared._favourite',[
        'model'=>$model
        ])
    @elseif($model instanceof App\Models\Answer)
             @include('shared._accept',[
        'model'=>$model
        ])
   @endif

</div>

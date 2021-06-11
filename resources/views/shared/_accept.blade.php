@can('accept',$model)
<a title="Mark this answer as best answer" class=" mt-2 {{ $model->status }}" onclick="event.preventDefault(); document.getElementById('accepted-answer-{{ $model->id }}').submit();">
    <i class="fas fa-check fa-2x"></i>
</a>
<form id="accepted-answer-{{ $model->id }}" action="{{route('answers.accept',$model->id)}}" method="POST" class="display:none;">
    @csrf
</form>
@else
@if($model->is_best)
<a title="Author of this question accepted this answer as best answer" class=" mt-2 {{ $model->status }}">
    <i class="fas fa-check fa-2x"></i>
</a>
@endif
@endcan

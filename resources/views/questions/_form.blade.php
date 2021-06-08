@csrf
<div class="form-group">
    <label for="question-title">
        Question Title
    </label>
    <input type="text" value="{{ old('title') ?? $question->title}}" class="form-control @error('title') is-invalid @enderror" id="question-title" name="title">

    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="question-body">
        Explain your question
    </label>
    <textarea name="body" type="text" value="" id="question-body" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body') ?? $question->body}}</textarea>
    @error('body')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{$buttonText}}</button>
</div>

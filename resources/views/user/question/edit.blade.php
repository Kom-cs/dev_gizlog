@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['question.update', $question->id], 'method' => 'put']) }}
      <div class="form-group @if($errors->has('tag_category_id')) has-error @endif">
        {{ Form::select('tag_category_id', [1 => 'front', 2 => 'back', 3 => 'infra', 4 => 'others'], $question->tag_category_id, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id', 'placeholder' => 'Select category']) }}
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group @if($errors->has('title')) has-error @endif">
        {{ Form::text('title', $question->title, ['class' => 'form-control', 'placeholder' => 'title']) }}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if($errors->has('content')) has-error @endif">
        {{ Form::textarea('content', $question->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) }}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
    {{ Form::close() }}
  </div>
</div>

@endsection


@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => 'question.confirm', 'method' => 'get']) }}
      <div class="form-group">
        <!-- <select name='tag_category_id' class = "form-control selectpicker form-size-small" id="pref_id">
          <option value="">Select category</option>
        </select> -->
        {{ Form::select('tag_category_id', [1 => 'front', 2 => 'back', 3 => 'infra', 4 => 'others'], null, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id', 'placeholder' => 'Select category']) }}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) }}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) }}
        <span class="help-block"></span>
      </div>
      {{ Form::submit('create', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection


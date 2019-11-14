@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => 'daily_report.create']) }}
      <div class="form-group form-size-small @if($errors->has('reporting_time')) has-error @endif">
        {{ Form::date('reporting_time', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
        <div class="form-group @if($errors->has('title')) has-error @endif">
          {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if($errors->has('content')) has-error @endif">
        {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content', 'cols' => 50, 'rows' => 10]) }}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {{ Form::button('Add', ['class' => 'btn btn-success pull-right', 'type' => 'submit']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection


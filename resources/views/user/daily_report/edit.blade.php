@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['daily_report.update', $dailyReport->id], 'method' => 'PUT']) }}
      <div class="form-group form-size-small　@if(!empty($errors->first('reporting_time'))) has-error @endif">
        {{ Form::input('date', 'reporting_time', $dailyReport->reporting_time->format('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Title']) }}
      <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {{ Form::input('text', 'title', $dailyReport->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
      <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
        {{ Form::textarea('content', $dailyReport->content, ['class' => 'form-control', 'placeholder' => 'Content', 'cols' => 50, 'rows' => 10]) }}
      <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {{ Form::button('Update', ['class' => 'btn btn-success pull-right', 'type' => 'submit']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection


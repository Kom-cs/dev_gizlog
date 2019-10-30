@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => 'daily_report.create']) }}
        <input class="form-control" name="user_id" type="hidden">
        <div class="form-group form-size-small">
      <input class="form-control" name="reporting_time" type="date">
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Title" name="title" type="text">
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Content" name="content" cols="50" rows="10"></textarea>
        <span class="help-block"></span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Add</button>
    {{ Form::close() }}
  </div>
</div>

@endsection


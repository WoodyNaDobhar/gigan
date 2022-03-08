<!-- Starts At Field -->
<div class="form-group">
    {!! Form::label('starts_at', __('models/weeks.fields.starts_at').':') !!}
    <p>{{ $week->starts_at }}</p>
</div>

<!-- Ends At Field -->
<div class="form-group">
    {!! Form::label('ends_at', __('models/weeks.fields.ends_at').':') !!}
    <p>{{ $week->ends_at }}</p>
</div>


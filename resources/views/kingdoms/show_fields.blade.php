<!-- Label Field -->
<div class="form-group">
    {!! Form::label('label', __('models/kingdoms.fields.label').':') !!}
    <p>{{ $kingdom->label }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/kingdoms.fields.description').':') !!}
    <p>{{ $kingdom->description }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/kingdoms.fields.image').':') !!}
    <p>{{ $kingdom->image }}</p>
</div>


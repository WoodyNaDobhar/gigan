<!-- Kingdom Id Field -->
<div class="form-group">
    {!! Form::label('kingdom_id', __('models/lands.fields.kingdom_id').':') !!}
    <p>{{ $land->kingdom_id }}</p>
</div>

<!-- Label Field -->
<div class="form-group">
    {!! Form::label('label', __('models/lands.fields.label').':') !!}
    <p>{{ $land->label }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/lands.fields.description').':') !!}
    <p>{{ $land->description }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/lands.fields.image').':') !!}
    <p>{{ $land->image }}</p>
</div>


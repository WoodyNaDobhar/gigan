<!-- Kingdom Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kingdom_id', __('models/lands.fields.kingdom_id').':') !!}
    {!! Form::number('kingdom_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', __('models/lands.fields.label').':') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/lands.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/lands.fields.image').':') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('lands.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>

<!-- Orkid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('orkID', __('models/flexers.fields.orkID').':') !!}
    {!! Form::number('orkID', null, ['class' => 'form-control']) !!}
</div>

<!-- Rank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank', __('models/flexers.fields.rank').':') !!}
    {!! Form::number('rank', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('flexers.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>

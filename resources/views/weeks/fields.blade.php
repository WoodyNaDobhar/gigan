<!-- Starts At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starts_at', __('models/weeks.fields.starts_at').':') !!}
    {!! Form::date('starts_at', null, ['class' => 'form-control','id'=>'starts_at']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#starts_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Ends At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ends_at', __('models/weeks.fields.ends_at').':') !!}
    {!! Form::date('ends_at', null, ['class' => 'form-control','id'=>'ends_at']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#ends_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('weeks.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>

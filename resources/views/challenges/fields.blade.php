<!-- Challenger Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('challenger_id', __('models/challenges.fields.challenger_id').':') !!}
    {!! Form::number('challenger_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Challenged Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('challenged_id', __('models/challenges.fields.challenged_id').':') !!}
    {!! Form::number('challenged_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Week Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('week_id', __('models/challenges.fields.week_id').':') !!}
    {!! Form::number('week_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Winner Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('winner_id', __('models/challenges.fields.winner_id').':') !!}
    {!! Form::number('winner_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Challenged At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('challenged_at', __('models/challenges.fields.challenged_at').':') !!}
    {!! Form::date('challenged_at', null, ['class' => 'form-control','id'=>'challenged_at']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#challenged_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Challenger Rank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('challenger_rank', __('models/challenges.fields.challenger_rank').':') !!}
    {!! Form::number('challenger_rank', null, ['class' => 'form-control']) !!}
</div>

<!-- Challenged Rank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('challenged_rank', __('models/challenges.fields.challenged_rank').':') !!}
    {!! Form::number('challenged_rank', null, ['class' => 'form-control']) !!}
</div>

<!-- Video Field -->
<div class="form-group col-sm-6">
    {!! Form::label('video', __('models/challenges.fields.video').':') !!}
    {!! Form::text('video', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('challenges.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>

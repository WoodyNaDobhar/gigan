<!-- Challenger Id Field -->
<div class="form-group">
    {!! Form::label('challenger_id', __('models/challenges.fields.challenger_id').':') !!}
    <p>{{ $challenge->challenger_id }}</p>
</div>

<!-- Challenged Id Field -->
<div class="form-group">
    {!! Form::label('challenged_id', __('models/challenges.fields.challenged_id').':') !!}
    <p>{{ $challenge->challenged_id }}</p>
</div>

<!-- Week Id Field -->
<div class="form-group">
    {!! Form::label('week_id', __('models/challenges.fields.week_id').':') !!}
    <p>{{ $challenge->week_id }}</p>
</div>

<!-- Winner Id Field -->
<div class="form-group">
    {!! Form::label('winner_id', __('models/challenges.fields.winner_id').':') !!}
    <p>{{ $challenge->winner_id }}</p>
</div>

<!-- Challenged At Field -->
<div class="form-group">
    {!! Form::label('challenged_at', __('models/challenges.fields.challenged_at').':') !!}
    <p>{{ $challenge->challenged_at }}</p>
</div>

<!-- Challenger Rank Field -->
<div class="form-group">
    {!! Form::label('challenger_rank', __('models/challenges.fields.challenger_rank').':') !!}
    <p>{{ $challenge->challenger_rank }}</p>
</div>

<!-- Challenged Rank Field -->
<div class="form-group">
    {!! Form::label('challenged_rank', __('models/challenges.fields.challenged_rank').':') !!}
    <p>{{ $challenge->challenged_rank }}</p>
</div>

<!-- Video Field -->
<div class="form-group">
    {!! Form::label('video', __('models/challenges.fields.video').':') !!}
    <p>{{ $challenge->video }}</p>
</div>


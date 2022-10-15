<!-- Recipe Id Field -->
<div class="col-sm-12">
    {!! Form::label('recipe_id', 'Recipe Id:') !!}
    <p>{{ $loss->recipe_id }}</p>
</div>

<!-- Qty Field -->
<div class="col-sm-12">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{{ $loss->qty }}</p>
</div>

<!-- Cost Field -->
<div class="col-sm-12">
    {!! Form::label('cost', 'Cost:') !!}
    <p>{{ $loss->cost }}</p>
</div>


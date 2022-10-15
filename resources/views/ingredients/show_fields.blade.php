<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $ingredient->user_id }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $ingredient->description }}</p>
</div>

<!-- Qty Field -->
<div class="col-sm-12">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{{ $ingredient->qty }}</p>
</div>

<!-- Measurement Unit Id Field -->
<div class="col-sm-12">
    {!! Form::label('measurement_unit_id', 'Measurement Unit Id:') !!}
    <p>{{ $ingredient->measurement_unit_id }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $ingredient->price }}</p>
</div>


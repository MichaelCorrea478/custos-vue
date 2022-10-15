<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $recipe->user_id }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $recipe->description }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $recipe->price }}</p>
</div>

<!-- Stock Qty Field -->
<div class="col-sm-12">
    {!! Form::label('stock_qty', 'Stock Qty:') !!}
    <p>{{ $recipe->stock_qty }}</p>
</div>

<!-- Cost Field -->
<div class="col-sm-12">
    {!! Form::label('cost', 'Cost:') !!}
    <p>{{ $recipe->cost }}</p>
</div>

<!-- Avg Cost Field -->
<div class="col-sm-12">
    {!! Form::label('avg_cost', 'Avg Cost:') !!}
    <p>{{ $recipe->avg_cost }}</p>
</div>


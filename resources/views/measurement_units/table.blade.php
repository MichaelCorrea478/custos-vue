<div class="table-responsive">
    <table class="table" id="measurementUnits-table">
        <thead>
        <tr>
            <th>Abbreviation</th>
        <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($measurementUnits as $measurementUnit)
            <tr>
                <td>{{ $measurementUnit->abbreviation }}</td>
            <td>{{ $measurementUnit->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['measurementUnits.destroy', $measurementUnit->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('measurementUnits.show', [$measurementUnit->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('measurementUnits.edit', [$measurementUnit->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

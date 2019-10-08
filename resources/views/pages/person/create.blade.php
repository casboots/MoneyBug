@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['action' => 'personController@store', 'method' => 'POST']) !!}
                @for($i=1; $i <= $persons; $i++)
                <div class="form-group">
                    {{Form::label('person[]', 'Person '.$i)}}
                    {{Form::text('person[]', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                @endfor
                {{Form::hidden('tableId', $table->tableId)}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
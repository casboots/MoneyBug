@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['action' => 'FinanceController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control', 'autofocus'])}}
                </div>
                <div class="form-group">
                    {{Form::label('person', 'Person')}}
                    {{Form::select('person', $persons, null, ['class' => 'form-control', 'placeholder' => 'Select payer'])}}
                </div>
                <div class="form-group">
                    {{Form::label('amount', 'Amount')}}
                    {{Form::number('amount', '', ['step' => '0.01','class' => 'form-control', 'placeholder' => '0.00'])}}
                </div>
                <div class="form-group">
                    {{Form::label('store', 'Store')}}
                    {{Form::text('store', '', ['class' => 'form-control', 'placeholder' => 'Store'])}}
                </div>   
                <div class="form-group">
                    {{Form::label('category', 'Category')}}
                    {{Form::select('category', ['groceries' => 'Groceries', 'lesure' => 'Lesure', 'vacation' => 'Vacation', 'other' => 'Other'], null, ['class' => 'form-control', 'placeholder' => 'Select category'])}}
                </div>
                <div class="form-group">
                    {{Form::label('note', 'Note')}}
                    {{Form::textarea('note', '', ['class' => 'form-control', 'placeholder' => 'Select payer'])}}
                </div>
                <div class="form-group">
                    {{Form::label('country', 'Country')}}
                    {{Form::text('country', '', ['class' => 'form-control', 'placeholder' => 'NL'])}}
                </div> 
                <div class="form-group">
                    {{Form::label('location', 'Location')}}
                    {{Form::text('location', '', ['class' => 'form-control', 'placeholder' => 'Amsterdam'])}}
                </div> 
                <div class="form-group">
                    {{Form::label('keywords', 'Keywords')}}
                    {{Form::text('keywords', '', ['class' => 'form-control', 'placeholder' => 'Keywords, ..., ...'])}}
                </div> 
                {{Form::hidden('tableId', $tableId)}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
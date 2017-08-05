@extends('layouts.app')

@section('content')
    <h2>Create Product</h2>
    {!! Form::open(['class' => 'form', 'url' => 'create-product', 'method' => 'POST']) !!}
        @include('products.partials.form-data', [
            'isUpdate' => false
        ])
        {!! Form::submit('Create Product', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
@endsection
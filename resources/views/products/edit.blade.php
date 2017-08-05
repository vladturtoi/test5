@extends('layouts.app')

@section('content')
    <h2>Update Product {!! $product->name !!}</h2>
    {!! Form::model($product, ['class' => 'form', 'method' => 'POST']) !!}
        @include('products.partials.form-data', [
            'isUpdate' => true
        ])
        {!! Form::submit('Update Product', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}

    <a class="btn btn-inverse pull-left"
       href={{ route('products.index') }}>Cancel</a>

    {!! Form::open(['method' => 'DELETE']) !!}
        {!! Form::submit('Delete Product', ['class' => 'btn btn-danger pull-right']) !!}
    {!! Form::close() !!}
@endsection
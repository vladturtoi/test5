@extends('layouts.app')

@section('content')
    @if(session('message'))
        <p class="bg-success">{!! session('message') !!}</p>
    @endif

    <a href="{!! route('products.create') !!}" class="btn btn-success">Create New Product</a>
    {!! Form::open(['class' => 'form-inline', 'url' => '/', 'method' => 'GET']) !!}
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', \Input::has('name') ? \Input::get('name') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('type') !!}
            {!! Form::select('type', \App\Utils\ProductUtils::TYPES, \Input::has('type') ? \Input::get('type') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price_min') !!}
            {!! Form::number('price_min', \Input::has('price_min') ? \Input::get('price_min') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price_max') !!}
            {!! Form::number('price_max', \Input::has('price_max') ? \Input::get('price_max') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price_discounted_min') !!}
            {!! Form::number('price_discounted_min', \Input::has('price_discounted_min') ? \Input::get('price_discounted_min') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price_discounted_max') !!}
            {!! Form::number('price_discounted_max', \Input::has('price_discounted_max') ? \Input::get('price_discounted_max') : null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Apply Filters', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Description</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Edit</th>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
                <tr>
                    <td>{!! \Input::has('page') ? (\Input::get('page') - 1) * 15 + $key + 1 : $key + 1 !!}</td>
                    <td>{!! $product->name !!}</td>
                    <td>{!! $product->type !!}</td>
                    <td>{!! $product->description !!}</td>
                    <td>{!! $product->price !!}</td>
                    <td>{!! $product->discount !!}</td>
                    <td><a href="{!! route('products.edit', $product->id) !!}" class="btn btn-primary">EDIT</a></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Description</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Edit</th>
        </tfoot>
    </table>

    {{ $products->appends($_GET)->links() }}

    <div class="clearfix"></div>
    <a href="javascript:;" class="export-button btn btn-primary">Export to xls</a>

    {!! Form::open(['url' => 'export-products', 'method' => 'POST', 'class' => 'form export-form', 'style' => 'display:none']) !!}
        {!! Form::label('Please enter your email to export') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        {!! Form::submit('Export to xls', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    <script>
        $(".export-button").on('click', function () {
            $('.export-form').show();
            $(this).hide();
            $('html,body').animate({ scrollTop: 9999 }, 'slow');
        });
    </script>
@endsection
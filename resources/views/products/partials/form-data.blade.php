<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name') !!}
    {!! Form::text('name', $isUpdate ? $product->name : null, ['class' => 'form-control']) !!}

    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    {!! Form::label('type') !!}
    {!! Form::select('type', \App\Utils\ProductUtils::TYPES, $isUpdate ? $product->type : null, ['class' => 'form-control']) !!}

    @if ($errors->has('type'))
        <span class="help-block">
            <strong>{{ $errors->first('type') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description') !!}
    {!! Form::textarea('description', $isUpdate ? $product->description : null, ['class' => 'form-control']) !!}

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    {!! Form::label('price') !!}
    {!! Form::number('price', $isUpdate ? $product->price : null, ['class' => 'form-control', 'step' => '0.1']) !!}

    @if ($errors->has('price'))
        <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
    {!! Form::label('discount') !!}
    {!! Form::number('discount', $isUpdate ? $product->discount : null, ['class' => 'form-control', 'step' => '0.1']) !!}

    @if ($errors->has('discount'))
        <span class="help-block">
            <strong>{{ $errors->first('discount') }}</strong>
        </span>
    @endif
</div>
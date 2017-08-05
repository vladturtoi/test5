<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProduct;
use App\Http\Requests\ExportProducts;
use App\Http\Requests\UpdateProduct;
use App\Utils\ProductUtils;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
    	$data = ProductUtils::getIndexData(\Input::get());

    	return view('products.index', $data);
    }

    public function edit($id)
    {
		$data = ProductUtils::getEditData($id);

		return view('products.edit', $data);
    }

	public function create()
	{
		return view('products.create');
	}

    public function update(UpdateProduct $request, $id)
    {
		ProductUtils::createOrUpdate($request, $id);

	    return redirect(route('products.edit', $id));
    }

    public function store(CreateProduct $request)
    {
		$product = ProductUtils::createOrUpdate($request);

	    return redirect(route('products.edit', $product->id));
    }

    public function delete($id)
    {
		ProductUtils::deleteProduct($id);

	    return redirect(route('products.index'));
    }

    public function export(ExportProducts $request)
    {
    	ProductUtils::export($request);

    	return redirect(route('products.index'))->with(['message' => 'You will be notified via email when the XLS is ready']);
    }

    public function getXls($id)
    {
	    $path = storage_path("exports/$id.xls");

	    return response()->download($path);
    }
}

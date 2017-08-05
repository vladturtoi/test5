<?php
/**
 * Created by PhpStorm.
 * User: vlad.turtoi
 * Date: 05/08/2017
 * Time: 16:59
 */

namespace App\Utils;

use App\Jobs\ExportProducts;
use App\Models\Product;
use App\Models\ProductXls;
use Illuminate\Support\Facades\Input;

class ProductUtils extends Utils
{
	CONST TYPES = ['type1' => 'type1', 'type2' => 'type2', 'type3' => 'type3'];

	public static function createOrUpdate($request, $productId = false)
	{
		if ($productId) {
			$product = Product::find($productId);
		} else {
			$product = new Product();
		}

		$product->fill($request->all());

		$product->save();

		return $product;
	}

	public static function getEditData($id)
	{
		$data = [];
		$data['product'] = self::getProduct($id);

		return $data;
	}

	public static function getProduct($id)
	{
		if ($product = Product::find($id)) {
			return $product;
		}

		abort(404);
	}

	public static function deleteProduct($id)
	{
		Product::find($id)->delete();
	}

	public static function getIndexData($filters)
	{
		$data = [];

		$data['products'] = self::getProducts($filters)->paginate(15);

		session(['filters' => \Input::get()]);

		return $data;
	}

	public static function getProducts($filters)
	{
		return Product::where(function($query) use ($filters) {
			if (isset($filters['name']) && $value = $filters['name']) {
				$query->where(function($query) use ($value) {
					$query->where('name', 'like', "%$value%")
						->orWhere('description', 'like', "%$value%");
				});
			}
			if (isset($filters['price_max']) && $value = $filters['price_max']) {
				$query->where('price', '<', "$value");
			}
			if (isset($filters['type']) && $value = $filters['type']) {
				$query->where('type', "$value");
			}
			if (isset($filters['price_min']) && $value = $filters['price_min']) {
				$query->where('price', '>', "$value");
			}
			if (isset($filters['price_max']) && $value = $filters['price_max']) {
				$query->where('price', '<', "$value");
			}
			if (isset($filters['price_discounted_max']) && $value = $filters['price_discounted_max']) {
				$query->whereRaw("price - ifnull(discount, 0) < $value");
			}
			if (isset($filters['price_discounted_min']) && $value = $filters['price_discounted_min']) {
				$query->whereRaw("price - ifnull(discount, 0) > $value");
			}
		});
	}

	public static function export($request)
	{
		$productXls = ProductXls::create();

		$url = \Request::server('HTTP_HOST') . "/get-xls/$productXls->id";

		dispatch(new ExportProducts(session('filters', []), $request->email, $url, $productXls->id));
	}
}
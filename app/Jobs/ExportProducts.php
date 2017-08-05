<?php

namespace App\Jobs;

use App\Mail\ProductsExportMail;
use App\Models\ProductXls;
use App\Utils\ProductUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Maatwebsite\Excel\Facades\Excel;

class ExportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filters;
    public $email;
    public $url;
    public $xlsId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filters, $email, $url, $xlsId)
    {
		$this->filters = $filters;
		$this->email = $email;
		$this->url = $url;
		$this->xlsId = $xlsId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $products = ProductUtils::getProducts($this->filters)->get(['name', 'description', 'price', 'discount', 'created_at', 'updated_at']);

	    Excel::create($this->xlsId, function($excel) use($products) {

		    $excel->sheet('Products', function($sheet) use($products) {

			    $sheet->fromModel($products);

		    });

	    })->store('xls');

	    \Mail::to($this->email)->send(new ProductsExportMail($this->url));
    }
}

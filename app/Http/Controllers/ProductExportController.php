<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductExportController extends Controller
{
   public function export()
    {
        $fileName = 'products_' . now()->format('Y_m_d_His') . '.xlsx';
        return Excel::download(new ProductExport, $fileName);
        // return Excel::download(new UsersExport, 'users.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}

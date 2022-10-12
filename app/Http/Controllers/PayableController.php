<?php

namespace App\Http\Controllers;

use App\Models\Payable;
use Yajra\DataTables\Facades\DataTables;

class PayableController extends Controller
{

    public function index()
    {
        return view('payable.index');
    }

    public function datatables()
    {
        $payables = Payable::with(['company' => function ($query) {
            $query->select(['id', 'name']);
        }, 'currencyType' => function ($query) {
            $query->select(['id', 'name']);
        }, 'paymentMethodType' => function ($query) {
            $query->select(['id', 'name']);
        }])->orderByDesc('id')->get();
        return Datatables::of($payables)
            ->addIndexColumn()
            ->addColumn('company_name', function ($row) {
                return $row->company->name;
            })
            ->addColumn('currency_type', function ($row) {
                return $row->currencyType->name;
            })
            ->addColumn('payment_method_type', function ($row) {
                return $row->paymentMethodType->name;
            })
            ->editColumn('price', function ($row) {
                return $row->price_format_try;
            })
            ->editColumn('expires_at', function ($row) {
                return $row->expires_at_format;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->only(['DT_RowIndex', 'company_name', 'currency_type', 'payment_method_type', 'price', 'expires_at',
                'description', 'created_at'])
            ->toJson();
    }
}

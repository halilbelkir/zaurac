<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class formController extends Controller
{
    public function index()
    {
        return view('form.index');
    }

    public function datatable()
    {
        return Datatables::of(Form::get())
            ->editColumn('created_at', function ($form) {
                return $form->updated_at ? with(new Carbon($form->updated_at))->format('d-m-Y H:i:s') : '';
            })
            ->toJson();
    }
}

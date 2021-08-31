<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\SimpleStoreRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $rows = Country::latest()->get();
        return view('country.index', compact('rows'));
    }

    public function create()
    {
        return view('country.create');
    }

    public function store(SimpleStoreRequest $request)
    {
        $data = $request->all();
        Country::create($data);
        return redirect()->route('admin.country.index')->with('created');
    }

    public function edit($id): object
    {
        $row = Country::find($id);
        return view('country.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $row = Country::find($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->route('admin.country.index')->with('updated');
    }

    public function ban($id): object
    {
        $row = Country::find($id);
        $row->update(
            [
                'banned' => 1,
            ]
        );
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $row = Country::find($id);
        $row->update(
            [
                'banned' => 0,
            ]
        );
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }
}

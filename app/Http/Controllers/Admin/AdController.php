<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\SimpleStoreRequest;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $rows = Ad::latest()->get();
        return view('ad.index', compact('rows'));
    }
    public function create()
    {
        return view('ad.create');
    }

    public function store(SimpleStoreRequest $request)
    {
        $data = $request->all();
        Ad::create($data);
        return redirect()->route('admin.ad.index')->with('created');
    }

    public function edit($id): object
    {
        $row = Ad::find($id);
        return view('ad.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $row = Ad::find($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->route('admin.ad.index')->with('updated');
    }

    public function ban($id): object
    {
        $row = Ad::find($id);
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
        $row = Ad::find($id);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\SimpleStoreRequest;
use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $rows = Sport::latest()->get();
        return view('sport.index', compact('rows'));
    }
    public function create()
    {
        return view('sport.create');
    }

    public function store(SimpleStoreRequest $request)
    {
        $data = $request->all();
        Sport::create($data);
        return redirect()->route('admin.sport.index')->with('created');
    }

    public function edit($id): object
    {
        $row = Sport::find($id);
        return view('sport.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $row = Sport::find($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->route('admin.sport.index')->with('updated');
    }

    public function ban($id): object
    {
        $row = Sport::find($id);
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
        $row = Sport::find($id);
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

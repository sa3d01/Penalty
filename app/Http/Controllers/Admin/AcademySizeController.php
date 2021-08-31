<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\SimpleStoreRequest;
use App\Models\AcademySize;
use Illuminate\Http\Request;

class AcademySizeController extends MasterController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $rows = AcademySize::latest()->get();
        return view('academy_size.index', compact('rows'));
    }

    public function create()
    {
        return view('academy_size.create');
    }

    public function store(SimpleStoreRequest $request)
    {
        $data = $request->all();
        AcademySize::create($data);
        return redirect()->route('admin.academy_size.index')->with('created');
    }

    public function edit($id): object
    {
        $row = AcademySize::find($id);
        return view('academy_size.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $row = AcademySize::find($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->route('admin.academy_size.index')->with('updated');
    }

    public function ban($id): object
    {
        $row = AcademySize::find($id);
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
        $row = AcademySize::find($id);
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

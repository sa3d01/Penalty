<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function ban($id): object
    {
        $user = $this->model->find($id);
        $user->update(
            [
                'banned' => 1,
            ]
        );
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }

    public function toggle_approved(Request $request,$id): object
    {
        $user = $this->model->find($id);
        if($request->reply == 'approved'){
            $user->update(
                [
                    'approved' => 1,
                ]
            );
        }else{
            $user->update(
                [
                    'approved' => 0,
                    'reject_reason' => $request->reject_reason
                ]
            );
        }
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }

}

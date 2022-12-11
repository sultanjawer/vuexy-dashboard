<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchService extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store($data)
    {
        $branch = Branch::create([
            'name' => $data['branch_name'],
            'code' => $data['branch_code'],
            'city_id' => $data['city_id'],
        ]);
    }

    public function update($branch, $validatedData)
    {
        $branch->update([
            'name' => $validatedData['branch_name'],
            'code' => $validatedData['branch_code'],
            'city_id' => $validatedData['city_id'],
        ]);

        return true;
    }

    public function changeBranchStatus($branch_id)
    {
        $branch = Branch::find($branch_id);
        if ($branch->status == 1) {
            $branch->update(['status' => 2]);
        } elseif ($branch->status == 2) {
            $branch->update(['status' => 1]);
        }

        return redirect()->route('panel.branches')->with('message',  '👍 تم تحديث حالة الفرع بنجاح',);
    }
}

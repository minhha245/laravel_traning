<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequests;
use App\Repository\TeamRepository;
use Illuminate\Http\Request;
use App\Repository\EmployeeRepository;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public $employeeRepo, $teamRepo;

    public function __construct(TeamRepository $teamRepo, EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
        $this->teamRepo = $teamRepo;
    }

    public function search()
    {
        $teams = $this->teamRepo->getAll();
        if (isset($_GET['name'])&&isset($_GET['email'])) {
            $data = [
                'name'=>$_GET['name'],
                'email'=>$_GET['email'],
                ];
            $result = $this->employeeRepo->getInforSearch($data);
            $this->employeeRepo->getEmployee();
        } else {
            $data = [
                'name'=>'',
                'email'=>'',
            ];
            $result = $this->employeeRepo->getInforSearch($data);

        }

        return view('employee.search')->with(compact('result', 'teams'));
    }

    public function create()
    {
        $teams = $this->teamRepo->getAll();
        return view('employee.create')->with('teams', $teams);
    }

    public function confirmCreate(EmployeeRequests $request)
    {
        $data = $request->all();
        $request->flash();
        session()->put('createEmployee', $data);
        $teams = $this->teamRepo->find(request()->team_id);

        return view('employee.confirm_create')->with('teams', $teams);

    }

    public function store(Request $request)
    {
        $data = session()->get('createEmployee');
        $upd_id = Auth::id();
        $value = ['ins_id' => $upd_id,
            'ins_datetime' => date("Y-m-d H:i:s"),
            'password' => '123456',
        ];
        $data = array_merge($data, $value);
        $this->employeeRepo->create($data);

        return redirect()->route('employee.search')->with('message', config('messages.create_success'));
    }

    public function edit($id)
    {
        $result = $this->employeeRepo->find($id);
        $teams = $this->teamRepo->getAll();
        if (!$result) {
            return redirect()->route('employee.search')->with('message', config('messages.update_not_list'));
        }

        return view('employee.edit',compact('result', 'teams'));
    }

    public function confirmEdit(EmployeeRequests $request)
    {
        $request->flash();
        $data = $request->all();
        $result = $this->employeeRepo->find($request->id);
        $teams = $this->teamRepo->find($request->team_id);
        session()->put('editEmployee', $data);

        return view('employee.confirm_edit')->with(compact('teams', 'result'));
    }

    public function update($id, Request $request)
    {
        $data = session()->get('editEmployee');
        $upd_id = Auth::id();
        $value = ['upd_id' => $upd_id,
            'upd_datetime' => date("Y-m-d H:i:s"),
        ];
        $data = array_merge($data, $value);
        $this->employeeRepo->update($id, $data);

        return redirect()->route('employee.search')->with('message', config('messages.update_success'));
    }

    public function destroy($id)
    {
        $teams = $this->employeeRepo->find($id);
        $this->employeeRepo->delete($id);

        return redirect()->back()->with('message', config('messages.delete_success'));
    }
}

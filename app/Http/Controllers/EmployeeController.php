<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequests;
use App\Repository\TeamRepository;
use Illuminate\Http\Request;
use App\Repository\EmployeeRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


class EmployeeController extends Controller
{
    public $employeeRepo, $teamRepo;

    public function __construct(TeamRepository $teamRepo, EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
        $this->teamRepo = $teamRepo;
    }

    public function search(Request $request)
    {
        try {
            $request->flash();
            $teams = $this->teamRepo->getAll();
            $result = $this->employeeRepo->getInforSearch($request);

            return view('employee.search', compact('result', 'teams'));

        } catch (ModelNotFoundException $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function create()
    {
        $teams = $this->teamRepo->getAll();
        return view('employee.create')->with('teams', $teams);
    }

    public function upload()
    {
        $fileName = null;
        $imageUrl = null;

        if (request()->hasFile('avatar')) {
            $image = request()->file('avatar');
            $fileName = 'avatar' . time() . '_' . $image->getClientOriginalName();
            $image->storeAs(config('constant.PATH_IMG_PUBLIC'), $fileName);
            $imageUrl = config('constant.PATH_IMG_STORAGE') . $fileName;

            session()->put('currentImgUrl', $imageUrl);

        } else {
            $fileName = str_replace(config('constant.PATH_IMG_STORAGE'), '', session()->get('currentImgUrl'));
            $imageUrl = session()->get('currentImgUrl');
        }

        return [
            'file_name' => $fileName,
            'file_path' => $imageUrl,
        ];

    }

    public function confirmCreate(EmployeeRequests $request)
    {
        request()->flash();
        $img = $this->upload();
        $request->merge($img);
        $data = $request->except('avatar');
        session()->put('createEmployee', $data);
        $teams = $this->teamRepo->find(request()->team_id);

        return view('employee.confirm_create')->with('teams', $teams);

    }

    public function store(Request $request)
    {
        try {
            $data = session()->get('createEmployee');

            if (!$data) {
                return redirect()->route('employee.search')->with('message', config('messages.create_failed'));
            }

            $this->employeeRepo->create($data);

            return redirect()->route('employee.search')->with('message', config('messages.create_success'));

        } catch (QueryException $exception) {
            $error = $exception->errorInfo;
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return redirect()->back()->with('error', $error);
        }

    }

    public function edit($id)
    {
        $result = $this->employeeRepo->find($id);
        $teams = $this->teamRepo->getAll();
        if (!$result) {
            return redirect()->route('employee.search')->with('message', config('messages.update_not_list'));
        }

        return view('employee.edit', compact('result', 'teams'));
    }

    public function confirmEdit(EmployeeRequests $request)
    {
        $request->flash();
        $result = $this->employeeRepo->find($request->id);
        $teams = $this->teamRepo->find($request->team_id);
        $oldImg = $result->avatar;
        $img = $this->upload();
        $request = request()->merge($img);

        if ($request->avatar == null && !session()->has('currentImgUrl')) {

            $request = request()->merge([
                'file_name' => $oldImg,
                'path' => config('constant.PATH_IMG_STORAGE') . $oldImg
            ]);

            session()->put('currentImgUrl', $request->path);
        }

        $data = $request->except('avatar');
        session()->put('editEmployee', $data);
//dd($data);
        return view('employee.confirm_edit')->with(compact('teams', 'result'));
    }

    public function update($id, Request $request)
    {
        try {

            $data = session()->get('editEmployee');

            if (!$data) {
                return redirect()->route('employee.search')->with('message', config('messages.update_failed'));
            }
            $this->employeeRepo->update($id, $data);

            return redirect()->route('employee.search')->with('message', config('messages.update_success'));

        } catch (\Exception $exception) {
            $error = config('messages.update_not_list') . $exception->getCode();
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return redirect()->route('employee.search')->with('error', $error);
        }

    }

    public function destroy($id)
    {
        try {
            $result = $this->employeeRepo->delete($id);

            if ($result) {
                return redirect()->back()->with('message', config('messages.delete_success'));
            } else {
                return redirect()->back()->with('message', config('messages.delete_failed'));
            }

        } catch (\Exception $exception) {
            $error = config('messages.delete_not_list') . $exception->getCode();
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return redirect()->route('admin.employee.search')->with('error', $error);
        }
    }

    public function reset(Request $request)
    {
        try {
            session()->forget('createEmployee');
            session()->forget('editEmployee');
            session()->forget('currentImgUrl');

            return redirect()->back();

        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return back()->withError($exception->getMessage())->withInput();
        }
    }
}

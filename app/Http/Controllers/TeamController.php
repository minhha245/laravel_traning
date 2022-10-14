<?php

namespace App\Http\Controllers;

use App\Repository\TeamRepository;
use Illuminate\Http\Request;
use App\Http\Requests\TeamsRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class TeamController extends Controller
{
    public $teamRepo;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepo = $teamRepo;
    }

    public function show($id)
    {
        $teams = $this->teamRepo->find($id);

        return view('team.search', ['teams' => $teams]);
    }

    public function create()
    {
        // create page
        return view('team.create');
    }

    public function confirmCreate(TeamsRequests $request)
    {
        $data = $request->all();
        $request->flash();
        session()->put('createTeam', $data);

        return view('team.confirm_create');
    }

    public function store(Request $request)
    {
        try {
            $data = session()->get('createTeam');
            $this->teamRepo->create($data);

            return redirect()->route('teams.search')->with('message', config('messages.create_success'));
        } catch (QueryException $exception) {
            $error = $exception->errorInfo;
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return redirect()->back()->with('error', $error);
        }
    }

    public function edit($id)
    {
        $teams = $this->teamRepo->find($id);
        if (!$teams) {
            return redirect()->route('teams.search')->with('message', config('messages.update_not_list'));
        }
        return view('team.edit')->with('teams', $teams);
    }

    public function confirmEdit(TeamsRequests $request)
    {
        $request->flash();
        $data = $request->all();
        session()->put('editTeam', $data);

        return view('team.confirm_edit');
    }

    public function update($id, Request $request)
    {
        try {
            $data = session()->get('editTeam');
            $this->teamRepo->update($id, $data);

            return redirect()->route('teams.search')->with('message', config('messages.update_success'));
        } catch (\Exception $exception) {
            $error = config('messages.update_not_list') . $exception->getCode();
            Log::error('Message: ' . $exception->getMessage() . ' Line : ' . $exception->getLine());

            return redirect()->route('employee.search')->with('error', $error);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->teamRepo->delete($id);
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

    public function search(Request $request)
    {
            $request->flash();
            $result = $this->teamRepo->getInforSearch($request);

            return view('team.search', compact('result'));
    }
}

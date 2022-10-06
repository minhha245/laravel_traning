<?php

namespace App\Http\Controllers;

use App\Repository\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TeamsRequests;

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
        $data = session()->get('createTeam');
        $upd_id = Auth::id();
        $value = ['ins_id' => $upd_id,
            'ins_datetime' => date("Y-m-d H:i:s"),
        ];
        $data = array_merge($data, $value);
        $this->teamRepo->create($data);

        return redirect()->route('teams.search')->with('message', config('messages.create_success'));
    }

    public function edit($id)
    {
        $teams = $this->teamRepo->find($id);
        if (!$teams) {
            return redirect()->route('teams.search')->with('message', config('messages.update_not_list'));
        }
        return view('team.edit')->with('teams', $teams);
    }

    public function confirmEdit(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255',
        ],
            [
                'name.required' => 'Name is not blank!',
            ]
        );
        $request->flash();
        $data = $request->all();
        session()->put('editTeam', $data);

        return view('team.confirm_edit');
    }

    public function update($id, Request $request)
    {
        $data = session()->get('editTeam');
        $upd_id = Auth::id();
        $value = ['upd_id' => $upd_id,
            'upd_datetime' => date("Y-m-d H:i:s"),
        ];
        $data = array_merge($data, $value);
        $this->teamRepo->update($id, $data);

        return redirect()->route('teams.search')->with('message', config('messages.update_success'));
    }

    public function destroy($id)
    {
        $teams = $this->teamRepo->find($id);
        $this->teamRepo->delete($id);

        return redirect()->back()->with('message', config('messages.delete_success'));
    }

    public function search()
    {
        if (isset($_GET['name'])) {
            $data = $_GET['name'];
            $result = $this->teamRepo->getInforSearch($data);
            $teams = $this->teamRepo->getTeam();
        } else {
            $data = "";
            //$result = $this->teamRepo->getTeam();
            $result = $this->teamRepo->getInforSearch($data);
        }

        return view('team.search')->with('result', $result);
    }
}

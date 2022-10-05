<?php

namespace App\Http\Controllers;

use App\Repository\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public $teamRepo;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepo = $teamRepo;
    }

    public function index()
    {
        $teams = $this->teamRepo->getTeam();

        return view('team.index')->with('teams', $teams);
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
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:255',
        ],
            [
                'name.required' => 'Name is not blank!',
            ]
        );
        $data = $request->all();
        $ins_id = Auth::id();
        $value =['ins_id' => $ins_id,
        'ins_datetime' => date("Y-m-d H:i:s"),
    ];
        $data = array_merge($data, $value);

        //... Validation here

        $product = $this->teamRepo->create($data);

        return redirect()->route('teams.search')->with('messages', 'Create successfull!');
    }

    public function edit($id)
    {
        $teams = $this->teamRepo->find($id);
        if (!$teams){
            return redirect()->route('teams.search')->with('status', config('messages.update_not_list'));
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
        $data = $request->all();
        session()->put('editTeam', $data);

        return view('team.confirm');
    }
    public function update($id, Request $request)
    {
        $data = session()->get('editTeam');
        $upd_id = Auth::id();
        $value =['upd_id' => $upd_id,
        'upd_datetime' => date("Y-m-d H:i:s"),
    ];
        $data = array_merge($data, $value);
        $this->teamRepo->update($id, $data);

        return redirect()->route('teams.search')->with('message', config('messages.create_success'));
    }

    public function destroy($id)
    {$teams = $this->teamRepo->find($id);
        $this->teamRepo->delete($id);

        return redirect()->back()->with('status', 'Delete successfull!');
    }
    public function search()
    {
        if(isset($_GET['name'])){
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

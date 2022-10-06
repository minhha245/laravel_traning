<?php

namespace App\Http\Controllers;

use App\Repository\TeamRepository;
use Illuminate\Http\Request;
use App\Repository\EmployeeRepository;

class EmployeeController extends Controller
{
    public $employeeRepo,$teamRepo;

    public function __construct(TeamRepository $teamRepo, EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
        $this->teamRepo = $teamRepo;
    }

    public function search()
    {
        if (isset($_GET['name'])) {
            $data = $_GET['name'];
            $result = $this->employeeRepo->getInforSearch($data);
            $this->employeeRepo->getEmplyee();
        } else {
            $data = "";
            $result = $this->employeeRepo->getInforSearch($data);
        }

        return view('employee.search')->with('result', $result);
    }

    public function create()
    {
        // create page
        return view('employee.create');
    }
}

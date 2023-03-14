<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMapping;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['route' => '', 'name' => 'Team Management'],
        ];
        return view('team.main', [
            'title' => 'Team Management',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['route' => route('teams.index'), 'name' => 'Team Management'],
            ['route' => '', 'name' => 'Create Team'],
        ];
        return view('team.form', [
            'title' => 'Create Team',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:100',
            ],
            [
                'name.required' => 'Please enter name',
                'name.max' => 'Name cannot be longer than 100 characters.',
            ]
        );

        $data = new Team($request->all());
        $data->save();

        return redirect()->route('teams.index')->with('toast_success', 'Create data succeed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['route' => route('teams.index'), 'name' => 'Team Management'],
            ['route' => '', 'name' => 'Edit Team'],
        ];
        return view('team.form', [
            'title' => 'Edit Account',
            'breadcrumbs' => $breadcrumbs,
            'data' => Team::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:100',
            ],
            [
                'name.required' => 'Please enter name',
                'name.max' => 'Name cannot be longer than 100 characters.',
            ]
        );

        $data = Team::findOrFail($id);
        $data->update($request->all());
        $data->save();

        return redirect()->route('teams.index')->with('toast_success', 'Update data succeed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Team::findOrFail($id);
        $data->delete();
        return back()->with('toast_success', 'Delete data succeed!');
    }

    public function jsontable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');
        $order = $request->get('order');

        $displayType = $request->get('displayType');
        $userId = $request->get('userId');

        $columnorder = array(
            'id',
            'name',
            'created_at',
            'updated_at',
            'action',
        );

        if (empty($order)) {
            $sort = 'name';
            $dir = 'asc';
        } else {
            $sort = $columnorder[$order[0]['column']];
            $dir = $order[0]['dir'];
        }
        // query
        $keyword = trim($search['value']);

        if ($displayType != 'inModal') {
            $data = Team::when($keyword, function ($query, $keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
                ->offset($start)
                ->limit($length)
                ->orderBy($sort, $dir)
                ->get();
        } else {
            $data = Team::when($keyword, function ($query, $keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
                ->orderBy($sort, $dir)
                ->get();
        }
        $recordsTotal = Team::select('id')->count();
        $recordsFiltered = Team::select('id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->count();
        $resp = DataTables::of($data)
            ->editColumn('id', function ($data) {
                return str_pad($data->id, 5, "0", STR_PAD_LEFT);
            })
            ->editColumn('created_at', function ($data) {
                return '<small>' . date('d/m/Y', strtotime($data->created_at)) . '<br><i class="far fa-clock"></i> ' . date('h:i A', strtotime($data->created_at)) . '</small>';
            })
            ->editColumn('updated_at', function ($data) {
                return '<small>' . date('d/m/Y', strtotime($data->updated_at)) . '<br><i class="far fa-clock"></i> ' . date('h:i A', strtotime($data->updated_at)) . '</small>';
            })
            ->addColumn('action', function ($data) use ($displayType, $userId) {
                $id = $data->id;
                switch ($displayType) {
                    case 'inModal':
                        $assign = false;
                        $mappingId = 0;
                        if (!empty($userId)) {
                            $mapping = TeamMapping::where(['teamId' => $data->id, 'userId' => $userId])->first();
                            $assign = $mapping == null ?? true;
                            $mappingId = $mapping != null ? $mapping->id : 0;
                        }
                        return view('account._actionModal', compact('id', 'assign', 'userId', 'mappingId'));
                        break;
                    default:
                        return view('team._action', compact('id'));
                        break;
                }
            })
            ->setTotalRecords($recordsTotal)
            ->setFilteredRecords($recordsFiltered)
            ->escapeColumns([])
            ->skipPaging()
            ->addIndexColumn()
            ->make(true);
        return $resp;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['route' => '', 'name' => 'Holiday Management'],
        ];
        return view('holiday.main', [
            'title' => 'Holiday Management',
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
            ['route' => route('holidays.index'), 'name' => 'Holiday Management'],
            ['route' => '', 'name' => 'Create Holiday'],
        ];
        return view('holiday.form', [
            'title' => 'Create Holiday',
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
                'name' => 'required|max:255',
                'date' => 'required',
            ],
            [
                'name.required' => 'Please enter name',
                'name.max' => 'Name cannot be longer than 255 characters.',
                'date.required' => 'Please enter date',
            ]
        );

        $data = new Holiday($request->all());
        $data->save();

        return redirect()->route('holidays.index')->with('toast_success', 'Create data succeed!');
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
            ['route' => route('holidays.index'), 'name' => 'Holiday Management'],
            ['route' => '', 'name' => 'Edit Holiday'],
        ];
        return view('holiday.form', [
            'title' => 'Edit Account',
            'breadcrumbs' => $breadcrumbs,
            'data' => Holiday::findOrFail($id)
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
                'name' => 'required|max:255',
                'date' => 'required',
            ],
            [
                'name.required' => 'Please enter name',
                'name.max' => 'Name cannot be longer than 255 characters.',
                'date.required' => 'Please enter date',
            ]
        );

        $data = Holiday::findOrFail($id);
        $data->update($request->all());
        $data->save();

        return redirect()->route('holidays.index')->with('toast_success', 'Update data succeed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Holiday::findOrFail($id);
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

        $year = $request->get('year');

        $columnorder = array(
            'id',
            'date',
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

        $data = Holiday::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'LIKE', '%' . $keyword . '%');
        })
            ->when($year, function ($query, $year) {
                return $query->whereYear('date', $year);
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($sort, $dir)
            ->get();
        $recordsTotal = Holiday::select('id')->count();
        $recordsFiltered = Holiday::select('id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('date', $year);
            })
            ->count();
        $resp = DataTables::of($data)
            ->editColumn('id', function ($data) {
                return str_pad($data->id, 5, "0", STR_PAD_LEFT);
            })
            ->editColumn('date', function ($data) {
                return  date('Y/m/d', strtotime($data->date));
            })
            ->editColumn('created_at', function ($data) {
                return '<small>' . date('d/m/Y', strtotime($data->created_at)) . '<br><i class="far fa-clock"></i> ' . date('h:i A', strtotime($data->created_at)) . '</small>';
            })
            ->editColumn('updated_at', function ($data) {
                return '<small>' . date('d/m/Y', strtotime($data->updated_at)) . '<br><i class="far fa-clock"></i> ' . date('h:i A', strtotime($data->updated_at)) . '</small>';
            })
            ->addColumn('action', function ($data) {
                $id = $data->id;
                return view('holiday._action', compact('id'));
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

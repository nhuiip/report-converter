<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['route' => '', 'name' => 'Account Management'],
        ];
        return view('account.main', [
            'title' => 'Account Management',
            'breadcrumbs' => $breadcrumbs,
            'role' => Role::all()
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
            ['route' => route('accounts.index'), 'name' => 'Account Management'],
            ['route' => '', 'name' => 'Create Account'],
        ];
        return view('account.form', [
            'title' => 'Create Account',
            'breadcrumbs' => $breadcrumbs,
            'role' => array('' => 'Select Role') + Role::select('name')->get()->pluck('name', 'name')->toArray()
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
                'role' => 'required',
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required', 'min:8', 'confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'role.required' => 'Please select role.',
                'name.required' => 'Please enter name',
                'name.max' => 'Name cannot be longer than 100 characters.',
                'email.required' => 'Please enter email',
                'email.email' => 'Invalid email format',
                'email.unique' => 'Email has already been taken.',
                'email.max' => 'Email cannot be longer than 255 characters.',
                'password.required' => 'Please enter password.',
                'password.min' => 'Please enter a password of at least 8 characters.',
                'password.confirmed' => 'Incorrect password confirmation',
                'password_confirmation.required' => 'Please confirm password.',
                'password_confirmation.min' => 'Please enter a confirmation password of at least 8 characters.',
            ]
        );

        $data = new User($request->all());
        $data->save();

        $data->assignRole($request->role);

        return redirect()->route('accounts.index')->with('toast_success', 'Create data succeed!');
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
            ['route' => route('accounts.index'), 'name' => 'Account Management'],
            ['route' => '', 'name' => 'Edit Account'],
        ];
        return view('account.form', [
            'title' => 'Edit Account',
            'breadcrumbs' => $breadcrumbs,
            'role' => array('' => 'Select Role') + Role::select('name')->get()->pluck('name', 'name')->toArray(),
            'data' => User::findOrFail($id)
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
        switch ($request->action) {
            case 'resetpassword':
                $this->validate(
                    $request,
                    [
                        'password' => 'required', 'min:8', 'confirmed',
                        'password_confirmation' => 'required',
                    ],
                    [
                        'password.required' => 'Please enter password.',
                        'password.min' => 'Please enter a password of at least 8 characters.',
                        'password.confirmed' => 'Incorrect password confirmation',
                        'password_confirmation.required' => 'Please confirm password.',
                        'password_confirmation.min' => 'Please enter a confirmation password of at least 8 characters.',
                    ]
                );
                break;
            default:
                $this->validate(
                    $request,
                    [
                        'role' => 'required',
                        'name' => 'required|max:100',
                        'email' => 'required|email|max:255|unique:users,email,' . $id,
                    ],
                    [
                        'role.required' => 'Please select role.',
                        'name.required' => 'Please enter name',
                        'name.max' => 'Name cannot be longer than 100 characters.',
                        'email.required' => 'Please enter email',
                        'email.email' => 'Invalid email format',
                        'email.unique' => 'Email has already been taken.',
                        'email.max' => 'Email cannot be longer than 255 characters.',
                    ]
                );
                break;
        }

        $data = User::findOrFail($id);
        $data->update($request->all());
        $data->save();

        if ($request->action == 'save') {
            if ($data->roles->first()->name != $request->role) {
                $data->removeRole($data->roles->first()->name);
                $data->assignRole($request->role);
            }
        }

        return redirect()->route('accounts.index')->with('toast_success', 'Update data succeed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return back()->with('toast_success', 'Delete data succeed!');
    }

    public function resetpassword($id)
    {
        $breadcrumbs = [
            ['route' => route('accounts.index'), 'name' => 'Account Management'],
            ['route' => '', 'name' => 'Reset Password'],
        ];
        return view('account.form', [
            'title' => 'Reset Password',
            'breadcrumbs' => $breadcrumbs,
            'data' => User::findOrFail($id)
        ]);
    }

    public function jsontable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');
        $order = $request->get('order');

        // filter
        $role = $request->get('role');

        $columnorder = array(
            'id',
            'name',
            'email',
            'role',
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

        $data = User::when($keyword, function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        })
            ->when($role, function ($query, $role) {
                $userId = User::role($role)->select('id')->get()->pluck('id')->toArray();
                return $query->whereIn('id', $userId);
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($sort, $dir)
            ->get();
        $recordsTotal = User::select('id')->count();
        $recordsFiltered = User::select('id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%');
                });
            })
            ->when($role, function ($query, $role) {
                $userId = User::role($role)->select('id')->get()->pluck('id')->toArray();
                return $query->whereIn('id', $userId);
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
            ->addColumn('info', function ($data) {

                return $data->email.'<br><small>'.$data->name.'</small>';
            })
            ->addColumn('role', function ($data) {
                $role = '<span class="label label-dark" style="">' . $data->roles->first()->name . '</span>';
                return $role;
            })
            ->addColumn('action', function ($data) {
                $id = $data->id;
                return view('account._action', compact('id'));
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

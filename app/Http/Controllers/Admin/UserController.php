<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use PDF;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'permit_no'=>'required|unique:users',
                'name'=>'required|max:255',
                'bname'=>'required|max:255',
                'lob'=>'required|max:255',
                'position'=>'required',
                'issued'=>'required'
            ]);

                $user = auth()->user()->create([
                'permit_no'=>$data['permit_no'],
                'name' => $data['name'],
                'bname'=>$data['bname'],
                'lob'=>$data['lob'],
                'issued'=>$data['issued'],
                'position'=>$data['position'],
                'password'=>Hash::make('password'),

            ]);
            $role = Role::select('id')->where('name','user')->first();
            $user->roles()->attach($role);

            return redirect(route('admin.users.index'))->with('success','Successfully Save');
        }catch (\Exception $e) {
            return redirect(route('admin.users.index'))->with('error', $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $pdf = PDF::loadview('pdf', compact('user'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }

        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try{
            $data = $request->validate([
                'permit_no'=>'required',
                'name'=>'required|max:255',
                'bname'=>'required|max:255',
                'lob'=>'required|max:255',
                'position'=>'required',
                'issued'=>'required'
            ]);

            $user->where('id',$user->id)->update([
                'permit_no'=>$data['permit_no'],
                'name' => $data['name'],
                'bname'=>$data['bname'],
                'lob'=>$data['lob'],
                'issued'=>$data['issued'],
                'position'=>$data['position'],
                'password'=>Hash::make('password'),
            ]);

            return redirect(route('admin.users.index'))->with('success','Successfully Update');
        }catch (\Exception $e) {
            return redirect(route('admin.users.index'))->with('error', $e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function sindex(){
        return view('admin.search');
    }
    public function search(Request $request){
        try{
            if($request->ajax())
            {
                $output = '';
                $query=$request->get('query');
                if($query != '')
                {
                    $data=User::where('name','LIKE','%'.$query."%")
                        ->orWhere('bname','LIKE','%'.$query."%")->orWhere('permit_no','LIKE','%'.$query."%")->paginate(5);

                }
                else{
                    $data = DB::table('users')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                }

                $total_row = $data->count();
                if($total_row > 0){

                    foreach ($data as $key =>$users) {

                        $output .= '<tr>' .
                            '<td>' . $users->permit_no . '</td>'.
                            '<td>' . $users->name . '</td>' .
                            '<td>' . $users->bname . '</td>' .
                            '<td>' . $users->lob . '</td>' .
                            '<td><a class="btn btn-primary" href="'.route('admin.users.show',$users->id).'">Print</a>
                     </td>'.
                            '<td><a class="btn btn-success" href="'.route('admin.users.edit',$users->id).'">Edit</a>
                     </td>';

                        '</tr>';
                    }
                }
                else
                {
                    $output = '
               <tr>
                <td align="center" colspan="5">No Data Found</td>
               </tr>
               ';
                }

                $data = array(
                    'table_data'  => $output,
                    'total_data'  => $total_row
                );

                echo json_encode($data);
            }
        }catch (\Exception $e){
            return redirect(route('admin.users.index'))->with('error',$e->getMessage());
        }

        }


}

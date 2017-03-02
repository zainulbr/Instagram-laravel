<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use DB;
    
class AdminController extends Controller {

 
    public function index()
    {
        return view('admin/dashboard');
     
    }

    public function tabel()
    {
     	$user= DB::table('users')->get();
        return view('admin/tabel')->with('data',$user);

     
    }
       public function insert()
    {
        return view('admin/insert');
     
    }
     public function tambah(Request $request)
    {
        $cek = User::where('username', $request->input('username'))->count();
        if ($cek >= 1) return redirect()->route('user-insert')->with(['status' => 'danger','title'=>'Error!!!', 'message' => 'Username has been registered']);

        $newUser = User::Create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'birthdate' => "",
            'email' => $request->input('email'),
            'full_name' => $request->input('full_name'),
        ]);

        return redirect()->route('user-insert')
            ->with([
                'status'=>'success input data',
                'title'=> 'Success!!!',
            ]);

    }
     public function hapus($id)
    {
        $cek = DB::table('users')->where('id',$id)->delete();
        if ($cek >= 1)
        {
            return redirect()->route('user-tabel')
            ->with([
                'status'=>'success delete data',
                'title'=> 'Success!!!',
            ]);
        } 
        else
        {
              return redirect()->route('user-tabel')
            ->with([
                'status'=>'invilid delete',
                'title'=> 'erorr!!!',
            ]);  
        }


    }

     public function edit($id)
    {
        $cek = DB::table('users')->where('id',$id)->first();
     
            return view('admin/update')->with('row',$cek);
     }

     public function save(request $request)
    {
        $post = $request->all();
     
       
            $data= array(
                'username' => $post['username'],
            'password' => $post['password'],
            'email' => $post['email'],
            'full_name' => $post['full_name'],
                );
            $i = DB::table('users')->where('id',$post['id'])->update($data);
            if ($i>0) {
                 return redirect()->route('user-tabel')
            ->with([
                'status'=>'success update data',
                'title'=> 'Success!!!',
            ]);
            }
            else
                return redirect()->back()->with([
                'status'=>'eror update data',
                'title'=> 'eror!!!',
            ]);
        }

   }    
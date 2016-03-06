<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdvancedReg extends Controller
{

//    public function register(Request $request)
//    {
//
////        dd(\Auth::check());
//        $this->validate($request, [
//            'email' => 'required|unique:users|max:250|',
//            'password' => 'required|confirmed|min:6',
//        ]);
//
////Insert user
//        $username = $request->input('name').' '.$request->input('surname').' '.$request->input('patronymic');
//
//        if ($request->input('isPrepod') == '1')
//        {
//            $user=User::create([
//            'name' => $username,
//            'email' => $request->input('email'),
//            'password' => bcrypt($request->input('password')),
//        ]);
//            $user->isPrepod=1;
//            $user->save();
//        } else {
//            $user=User::create([
//            'name' => $username,
//            'email' => $request->input('email'),
//            'password' => bcrypt($request->input('password')),
//        ]);
//        }
//        if(!empty($user->id))
//        {
//            return \Redirect::to('/')->with('message','Вы успешно зарегистрированы.');
//        }
//        else {
//            return \Redirect::back()->with('message','Ведутся технические работы. Попробуйте позже.');
//        }
//    }

    public function postLogin(Request $request)
    {

//        dd(\Auth::attempt(['name' => $request->name, 'password' => $request->password]));
//        dd($request);

        if (\Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $courses = Course::all();
            $usaName =  \Auth::user()->name;
            $usachek = \Auth::user()->isPrepod;

            return view('home.courses', ['usaName' => $usaName, 'usachek' => $usachek, 'courses' => $courses]);
        }
        return \Redirect::back()->with('message','Ошибка авторизации. Попробуйте ещё раз.');
    }

    public function logout()
    {
        \Auth::logout();
//        dd(\Auth::check());
        \Session::flash('success', 'You have been successfully logged out!');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}

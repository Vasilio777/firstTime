<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Addmat;
use App\Models\Lection;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function courses()
    {
        if (\Auth::check()) {
            $usaName =  \Auth::user()->name;
            $courses = Course::all();
            $usachek = \Auth::user()->isPrepod;
            return view('home.courses', ['usaName' => $usaName, 'usachek' => $usachek, 'courses' => $courses]);
        }

        return $this->index();
    }

    public function newcourse() {
        if (\Auth::check()) {
            $usaName =  \Auth::user()->name;
            $courses = Course::all();
            $usachek = \Auth::user()->isPrepod;
            return view('home.newcourse', ['usaName' => $usaName, 'usachek' => $usachek, 'courses' => $courses]);
        }

        return $this->index();
    }
    public function addCourse(Request $request)
    {
//        $whitelist = [".jpg", ".jpeg", ".png", ".gif"];
//        foreach ($whitelist as $item) {
//            if(preg_match("/$item\$/i", $_FILES['logofile']['name'])) {
//                exit;
//            }
//        }

        if (\Auth::check()) {
            $new = new Course();
            $new->coursetitle = $request->coursetitle;
            $new->cdesc = $request->cdesc;
            $new->requirements = $request->requirements;
            $new->forWhom = $request->forWhom;
//            $new->image = $request->logofile;
            $new->save();

            return \Redirect::to('courses');
        }

        return $this->index();
    }
    public function addLogo() {

        return  view('newplate');
    }

    public function lections($id)
    {
        if (\Auth::check()) {
            $chosencourse = Course::findorFail($id);
            $lections = Lection::all();
            $usaName =  \Auth::user()->name;
            $usachek = \Auth::user()->isPrepod;

            return view('home.lections', ['usaName' => $usaName,  'usachek' => $usachek, 'chosencourse' => $chosencourse, 'lections' => $lections]);
        }

        return $this->index();
    }
    public function addLection($id, Request $request)
    {
        if (\Auth::check()) {
        $new = new Lection();
        $new->ltitle = $request->ltitle;
        $new->idcourse = $request->id;
        $new->ldesc = $request->ldesc;
        $new->save();

        return \Redirect::to('course'.$id.'/lections');
        }

        return $this->index();
    }
    public function chosenlections($id)
    {
        if (\Auth::check()) {
        $chosenlections = Lection::findorFail($id);
        $addmats = Addmat::all();
        $videos = Video::all();
        $usaName =  \Auth::user()->name;
        $usachek = \Auth::user()->isPrepod;
        return view('home.chosenlections', ['usaName' => $usaName, 'usachek' => $usachek, 'id' => $id, 'chosenlections' => $chosenlections, 'addmats' => $addmats, 'videos' => $videos]);
        }

        return $this->index();
    }

//    public function regist()
//    {
//        return view('home.regist');
//    }

    public function addVideo($id, Request $request)
    {
        if (\Auth::check()) {
        $file = $request->file('videofile');
        $filename = $file->getClientOriginalName();
        $vRec = new Video();
        $vRec->idvlec = $id;
        $vRec->vtitle = $filename;
        $vRec->vdesc = "Описание";
        $vRec->save();
        $vRec->pid = $vRec->id;
        $vRec->save();
        $file->move('gruntFiles/videos', mb_convert_encoding($filename, 'Windows-1251'));

        return \Redirect::to('lections/'.$id);
        }

        return $this->index();
    }
    public function deleteVideo($id, Request $request)
    {
        if (\Auth::check()) {
        $abc = $request->get('name', -1);
        $delrec = Video::findorFail( $request->get('id', '-1'));
        $delrec->delete();
        \File::delete(public_path().'/gruntFiles/videos/'.(mb_convert_encoding($abc, 'Windows-1251')));

        return \Redirect::to('lections/'.$id);
        }

        return $this->index();
    }

//    public function incremVideo($id, Request $request)
//    {
//        $self_id = $request->get('id', -1);
//        $self = Video::findOrFail($self_id);
//
//        $increm = $self_id +1;
//        $next = Video::find($increm);
//
//        if ( $next != null) {
//            $next_true = Video::findOrFail($increm);
//            $my_pid = $self->pid;
//            $self->pid = $next_true->pid;
//            $next_true->pid = $my_pid;
//
//            $self->save();
//            $next_true->save();
//
//        } else
//        dd($increm);
//
//        $next_true = Video::findOrFail($increm);
//        $my_pid = $self->pid;
//        $self->pid = $next_true->pid;
//        $next_true->pid = $my_pid;
//
//        $self->save();
//        $next_true->save();
//
//        return \Redirect::to('lections/'.$id);
//    }

    public function addTableRecord($id, Request $request)
    {
        if (\Auth::check()) {
        $file = $request->file('userfile');
        $filename = $file->getClientOriginalName();
        $addRec = new Addmat();
        $addRec->idaddlec = $id;
        $addRec->addtitle = $filename;
        $addRec->save();
        $file->move('gruntFiles/addmats', mb_convert_encoding($filename, 'Windows-1251'));

        return \Redirect::to('lections/'.$id);
        }

        return $this->index();
    }
    public function deleteTableRecord($id, Request $request)
    {
        if (\Auth::check()) {
        $abc = $request->get('name', -1);
        $delrec = Addmat::findorFail($request->get('id', '-1'));
        $delrec->delete();
        \File::delete(public_path().'/gruntFiles/addmats/'.(mb_convert_encoding($abc, 'Windows-1251')));

        return \Redirect::to('lections/'.$id);
        }

        return $this->index();
    }

    public function changeLecDesc ($id, Request $request)
    {
        if (\Auth::check()) {
        $newLecDesc = $request->get('comment', -1);

        $desc = Lection::findorFail($id);
        $desc->ldesc = $newLecDesc;
        $desc->save();
        return \Redirect::to('lections/'.$id);
        }

        return $this->index();
    }
    public function changeVideoDesc ($id, Request $request)
    {
        if (\Auth::check()) {
        $newVideoDesc = $request->get('comment', -1);

        $desc = Video::findorFail($request->get('id', '-1'));
        $desc->vdesc = $newVideoDesc;
        $desc->save();
        return \Redirect::to('lections/'.$id);
        }

        return $this->index();
    }
}

//        $delRec = Addmat::find(5);
//        $delRec->delete();

//$destinationPath = public_path().'/uploads';

//Input::file('img')->move('uploads/news', $id.'_news.jpg');

//        function rearrange( $arr ){
//            foreach( $arr as $key => $all ){
//                foreach( $all as $i => $val ){
//                    $new[$i][$key] = $val;
//                }
//            }
//            return $new;
//        }
//        $refile = rearrange($_FILES['userfile']);


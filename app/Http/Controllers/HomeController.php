<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Addmat;
use App\Models\Lection;
use App\Models\User;
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
        if (\Auth::check()) {
            $new = new Course();
            $new->coursetitle = $request->coursetitle;
            $new->cdesc = $request->cdesc;
            $new->requirements = $request->requirements;
            $new->forWhom = $request->forWhom;
            $new->image = $request->logofile;
            $new->save();
            $id = $new->id;
            return \Redirect::to('course'.$id.'/lections');
        }

        return $this->index();
    }
    public function addLogo() {

        $filename = $_FILES['logofile']['name'];
        $uploaddir = public_path().'/images/icon/';
        $whitelist = [".jpg", ".jpeg", ".png", ".gif"];
        foreach ($whitelist as $item) {
            if(preg_match("/$item\$/i", $_FILES['logofile']['name'])) {
                move_uploaded_file($_FILES['logofile']['tmp_name'], $uploaddir.basename(mb_convert_encoding($filename, 'Windows-1251')));

                return  view('newplate');
            }
        }
    }
    public function changeCourseDesc ($id, Request $request)
    {
        if (\Auth::check()) {
            $newLecDesc = $request->get('comment', -1);
            $desc = Lection::findorFail($id);
            $desc->ldesc = $newLecDesc;
            $desc->save();

            return back();
        }

        return $this->index();
    }
    public function changeCourseReq ($id, Request $request)
    {
        if (\Auth::check()) {
            $newLecDesc = $request->get('comment', -1);
            $desc = Lection::findorFail($id);
            $desc->ldesc = $newLecDesc;
            $desc->save();

            return back();
        }

        return $this->index();
    }
    public function changeCourseWhom ($id, Request $request)
    {
        if (\Auth::check()) {
            $newLecDesc = $request->get('comment', -1);
            $desc = Lection::findorFail($id);
            $desc->ldesc = $newLecDesc;
            $desc->save();

            return back();
        }

        return $this->index();
    }

    public function addLection(Request $request)
    {
        if (\Auth::check()) {

            $file = $request->file('videofile');
            $filename = $file->getClientOriginalName();
            $file_type = substr($filename, strrpos($filename, '.')+1);
            $ltitle = $request->ltitle;
            $newname = $ltitle.'.'.$file_type;

            $whitelist = [".mp4", ".webm", ".ogv", ".mpeg"];
            foreach ($whitelist as $item) {
                if(preg_match("/$item\$/i", $_FILES['videofile']['name'])) {
                    $file->move('gruntFiles/videos', mb_convert_encoding($newname, 'Windows-1251'));

                    $new = new Lection();
                    $new->ltitle = $newname;
                    $new->idcourse = $request->id;
                    $new->ldesc = $request->ldesc;
                    $new->save();

                    return back()->with('message', 'Лекция успешно добавлена.');
                }
            }

            return back()->with('message', 'Выберите видеофайл(Поддерживаемые форматы: mp4, webm, ogv, mpeg)');
        }

        return $this->index();
    }
    public function lections($id)
    {
        if (\Auth::check()) {
            $chosencourse = Course::findorFail($id);
            $lections = Lection::all();
//            $videos = Video::all();
            $addmats = Addmat::all();
            $usaName =  \Auth::user()->name;
            $usachek = \Auth::user()->isPrepod;

            return view('home.lections', ['usaName' => $usaName, 'usachek' => $usachek, 'chosencourse' => $chosencourse, 'lections' => $lections, 'addmats' => $addmats /*, 'videos' => $videos*/]);
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

            return back();
        }

        return $this->index();
    }
    public function deleteLection($id, Request $request)
    {
        if (\Auth::check()) {
            $abc = $request->get('name', -1);
            $delrec = Lection::findorFail($id);
            $delrec->delete();
            \File::delete(public_path().'/gruntFiles/videos/'.(mb_convert_encoding($abc, 'Windows-1251')));

            return back();
        }

        return $this->index();
    }
//    public function chosenlections($id)
//    {
//        if (\Auth::check()) {
//            $chosenlections = Lection::findorFail($id);
//            $addmats = Addmat::all();
//            $videos = Video::all();
//            $usaName =  \Auth::user()->name;
//            $usachek = \Auth::user()->isPrepod;
//
//            return view('home.chosenlections', ['usaName' => $usaName, 'usachek' => $usachek, 'id' => $id, 'chosenlections' => $chosenlections, 'addmats' => $addmats, 'videos' => $videos]);
//        }
//
//        return $this->index();
//    }

//    public function regist()
//    {
//        return view('home.regist');
//    }

//    public function addVideo($id, Request $request)
//    {
//        if (\Auth::check()) {
//            $file = $request->file('videofile');
//            $filename = $file->getClientOriginalName();
//            $vRec = new Video();
//            $vRec->idvlec = $id;
//            $vRec->vtitle = $filename;
//            $vRec->vdesc = "Описание";
//            $vRec->save();
//            $vRec->pid = $vRec->id;
//            $vRec->save();
//            $file->move('gruntFiles/videos', mb_convert_encoding($filename, 'Windows-1251'));
//
//            return \Redirect::to('lections/'.$id);
//        }
//
//        return $this->index();
//    }
//    public function deleteVideo($id, Request $request)
//    {
//        if (\Auth::check()) {
//        $abc = $request->get('name', -1);
//        $delrec = Video::findorFail( $request->get('id', '-1'));
//        $delrec->delete();
//        \File::delete(public_path().'/gruntFiles/videos/'.(mb_convert_encoding($abc, 'Windows-1251')));
//
//        return \Redirect::to('lections/'.$id);
//        }
//
//        return $this->index();
//    }
//    public function changeVideoDesc ($id, Request $request)
//    {
//        if (\Auth::check()) {
//            $newVideoDesc = $request->get('comment', -1);
//
//            $desc = Video::findorFail($request->get('id', '-1'));
//            $desc->vdesc = $newVideoDesc;
//            $desc->save();
//            return \Redirect::to('lections/'.$id);
//        }
//
//        return $this->index();
//    }

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

            return back();
        }

        return $this->index();
    }
    public function deleteTableRecord($id, Request $request)
    {
        if (\Auth::check()) {
            $abc = $request->get('name', -1);
            $delrec = Addmat::findorFail($id);
            $delrec->delete();
            \File::delete(public_path().'/gruntFiles/addmats/'.(mb_convert_encoding($abc, 'Windows-1251')));

            return back();
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

//return \Redirect::to('course'.$id.'/lections');

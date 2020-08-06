<?php

namespace App\Http\Controllers\Web\Admin;

use App\ClassLists;
use App\DownloadContentDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DownloadCenterController extends Controller
{
    public function contentupload()
    {
        $contentlist = DownloadContentDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/contentupload')->with('contentlist',$contentlist);
    }

    public function contentupload_add(Request $request)
    {
        $data['academicyear'] = Session::get('academicyear');
        $data['contenttitle'] = $request->contenttitle;
        $data['contenttype'] = $request->contenttype;
        if($request->availablefor)
        {
            $data['availablefor'] = 'All';
        }
        else
        {
            $data['availablefor'] = 'Specific';
        }
        $data['classname'] = $request->classname;
        $data['division'] = $request->division;
        $data['description'] = $request->description;

        if($request->file('contentfile')) {
            $file = $request->file('contentfile');
            $new_name = date('ymdHis') . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/downloadcontent/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/downloadcontent/' . $new_name;
            $data['contentpath'] = $filepath;
        }

        DownloadContentDetails::create($data);

        return back()->with('success','Content added successfully');
    }

    public function contentupload_edit($id)
    {
        $contentlist = DownloadContentDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        $uploadcontent = DownloadContentDetails::where('id',decrypt($id))->first();
        if($uploadcontent->classname)
        {
            $division = ClassLists::where('classname',$uploadcontent->classname)->first();
            return view(auth()->user()->role.'/contentupload_edit')->with('contentlist',$contentlist)->with('uploadcontent',$uploadcontent)
                ->with('divisionlist',explode(',',$division->division));
        }
        else
        {
            return view(auth()->user()->role.'/contentupload_edit')->with('contentlist',$contentlist)->with('uploadcontent',$uploadcontent);
        }
    }

    public function contentupload_editcontent(Request $request)
    {

        if($request->availablefor)
        {
            $updateData = [
                'contenttitle' => $request->contenttitle,
                'contenttype' => $request->contenttype,
                'availablefor' => 'All',
                'classname' => null,
                'division' => null,
                'description' => $request->description,
            ];
        }
        else
        {
            $updateData = [
                'contenttitle' => $request->contenttitle,
                'contenttype' => $request->contenttype,
                'availablefor' => 'Specific',
                'classname' => $request->classname,
                'division' => $request->division,
                'description' => $request->description,
            ];
        }

        DownloadContentDetails::where('id',$request->id)->update($updateData);

        return Redirect::route('contentupload')->with('success','Content ediited successfully');
    }

    public function contentupload_delete($id)
    {
        DownloadContentDetails::where('id',decrypt($id))->delete();

        return back()->with('success','Content deleted successfully');
    }

    public function assignments()
    {
        $contentlist = DownloadContentDetails::where('academicyear',Session::get('academicyear'))->where('contenttype','Assignments')->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/assignments')->with('contentlist',$contentlist);
    }

    public function addassignment()
    {
        return Redirect::route('contentupload')->with('contenttype','Assignments');
    }

    public function studymaterial()
    {
        $contentlist = DownloadContentDetails::where('academicyear',Session::get('academicyear'))->where('contenttype','Study Material')->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/studymaterial')->with('contentlist',$contentlist);
    }

    public function addstudymaterial()
    {
        return Redirect::route('contentupload')->with('contenttype','Study Material');
    }

    public function syllabus()
    {
        $contentlist = DownloadContentDetails::where('academicyear',Session::get('academicyear'))->where('contenttype','Syllabus')->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/syllabus')->with('contentlist',$contentlist);
    }

    public function addsyllabus()
    {
        return Redirect::route('contentupload')->with('contenttype','Syllabus');
    }
}

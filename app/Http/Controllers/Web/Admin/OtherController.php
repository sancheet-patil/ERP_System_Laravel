<?php

namespace App\Http\Controllers\Web\Admin;

use App\CasteCategoryList;
use App\CategoryLists;
use App\ClassLists;
use App\ClassSubjectDetails;
use App\LeavingCertificateDetails;
use App\Rules\MatchOldPassword;
use App\StudentDetails;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OtherController extends Controller
{
    public function profile()
    {
        return view(auth()->user()->role.'/profile');
    }

    public function changeloginpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response'   => 'error',
                'error'=>$validator->errors()->first()
            ]);
        }

        User::find(auth()->user()->id)->update(['password'=> bcrypt($request->new_password)]);

        return response()->json([
            'response'   => 'success',
            'success'    => 'Password changed successfully.<br>Page will refresh in 2 seconds'
        ]);
    }

    public function changeacademicyear($academicyear)
    {
        Session::put('academicyear',$academicyear);
        return back();
    }

    public function changeregisterfor(Request $request)
    {
        Session::put('registerfor',$request->registerfor);
        return back();
    }

    public function divisionlist(Request $request)
    {
        $divisionlist = ClassLists::where('classname',$request->classname)->first();
        return explode(',',$divisionlist->division);
    }

    public function getnextregisterno(Request $request)
    {
        $data = StudentDetails::where('registerfor',$request->registerfor)->orderBy('registerno','desc')->first();
        if($data) {
            return ++$data->registerno;
        }
        return '1';
    }

    public function validateregisterno(Request $request)
    {
        $data = StudentDetails::where('registerfor',$request->registerfor)->where('registerno',$request->registerno)->first();
        if($data)
        {
            return 'True';
        }
        return 'False';
    }

    public function validateaadhar(Request $request)
    {
        $check = User::where('aadhar',$request->aadhar)->first();
        if($check){
            return 'True';
        }
        return 'False';
    }

    public function castelist(Request $request)
    {
        $caste = CasteCategoryList::where('religion',$request->religion)->select('castename')->distinct()->get();
        return response()->json($caste);
    }

    public function subcastelist(Request $request)
    {
        $subcaste = CasteCategoryList::where('religion',$request->religion)->where('castename',$request->castename)->orderBy('subcaste','asc')->get();
        return response()->json($subcaste);
    }

    public function subcastedetails(Request $request)
    {
        $subcaste = CasteCategoryList::where('id',$request->subcaste)->first();
        $category = CategoryLists::where('id',$subcaste->category)->value('category');
        return $category;
    }

    public function undividedstudents(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))->where('registerfor',Session::get('registerfor'))
            ->where('classname',$request->classname)->where('division','NA')->where('hasaccess','1')->orderBy('lname','asc')->get();
        return response()->json($studentlist);
    }

    public function dividedstudents(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('registerfor',Session::get('registerfor'))->where('classname',$request->classname)
            ->where('division',$request->division)->where('hasaccess','1')->orderBy('lname','asc')->get();
        return response()->json($studentlist);
    }

    public function undividedcollegestudents(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))->where('registerfor',Session::get('registerfor'))
            ->where('classname',$request->classname)->where('faculty',$request->faculty)
            ->where('division','NA')->where('hasaccess','1')->orderBy('lname','asc')->get();
        return response()->json($studentlist);
    }

    public function dividedcollegestudents(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('registerfor',Session::get('registerfor'))
            ->where('classname',$request->classname)->where('faculty',$request->faculty)
            ->where('division',$request->division)->where('hasaccess','1')->orderBy('lname','asc')->get();
        return response()->json($studentlist);
    }

    public function classsubjectlist(Request $request)
    {
        $classsubjectlist = DB::table('class_subject_details')
            ->join('staff_details','class_subject_details.teachername','=','staff_details.userid')
            ->join('subject_lists','class_subject_details.subjectname','=','subject_lists.id')
            ->select('class_subject_details.classname','class_subject_details.division','class_subject_details.outofmarks',
                'class_subject_details.subjectname as subjectid','class_subject_details.teachername as teacherid',
                'subject_lists.subjectname','staff_details.fname','staff_details.mname','staff_details.lname')
            ->where('class_subject_details.academicyear',Session::get('academicyear'))
            ->where('class_subject_details.classname',$request->classname)
            ->where('class_subject_details.division',$request->division)->get();
        return response()->json($classsubjectlist);
    }

    public function unissuedlc(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('registerfor',Session::get('registerfor'))->where('classname',$request->classname)
            ->where('division',$request->division)->where('hasaccess','1')->orderBy('lname','asc')->get();

        return $studentlist;
    }

    public function collegeunissuedlc(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('registerfor',Session::get('registerfor'))->where('classname',$request->classname)
            ->where('division',$request->division)->where('faculty',$request->faculty)->where('hasaccess','1')
            ->orderBy('lname','asc')->get();

        return $studentlist;
    }

    public function studentdetails(Request $request)
    {
        $student = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.userid',$request->userid)
            ->first();
        return response()->json($student);
    }

    public function form17lcunissuedstudents(Request $request)
    {
        $students = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname','12')->where('registerfor','College Form 17')->where('faculty',$request->faculty)
            ->where('hasaccess','1')->get();
        $girlscount = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname','12')->where('registerfor','College Form 17')->where('faculty',$request->faculty)
            ->where('gender','Female')->where('hasaccess','1')->get()->count();
        $boyscount = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname','12')->where('registerfor','College Form 17')->where('faculty',$request->faculty)
            ->where('gender','Male')->where('hasaccess','1')->get()->count();

        $data['students'] = $students;
        $data['girlscount'] = $girlscount;
        $data['boyscount'] = $boyscount;

        return response()->json($data);
    }

    public function migrate()
    {
        $userslist = StudentDetails::where('academicyear','2019-2020')->where('registerfor','School Form 17')->get()->count();


        return $userslist;
    }
}

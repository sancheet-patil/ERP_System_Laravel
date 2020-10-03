<?php

namespace App\Http\Controllers\Web\Admin;

use App\BonafideDetails;
use App\CasteCategoryList;
use App\CategoryLists;
use App\CircularDetails;
use App\ClassLists;
use App\ClassTeacherDetails;
use App\Http\Controllers\Controller;
use App\InwardsDetails;
use App\LeavingCertificateDetails;
use App\OtherSchoolLists;
use App\OutwardsDetails;
use App\ReligionLists;
use App\ScholarshipLists;
use App\StaffDetails;
use App\StudentAttendanceInfo;
use App\StudentDetails;
use App\VisitorBookDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReportsController extends Controller
{
    public function studentbonafidereport()
    {
        $bonafidelist = DB::table('bonafide_details')
            ->join('student_details','bonafide_details.studentid','=','student_details.userid')
            ->where('bonafide_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->orderBy('bonafide_details.id','desc')->get();

        return view(auth()->user()->role.'/student_bonafide_report')->with('bonafidelist',$bonafidelist)
            ->with('academicyear','')->with('registerfor','')->with('classname','')->with('division','')->with('faculty','');
    }

    public function studentbonafidereport_post(Request $request)
    {
        $bonafidelist = DB::table('bonafide_details')
            ->join('student_details','bonafide_details.studentid','=','student_details.userid')
            ->join('student_other_details','bonafide_details.studentid','=','student_other_details.userid');

        $view = view(auth()->user()->role.'/student_bonafide_report');

        if($request->academicyear) {
            $bonafidelist = $bonafidelist->where('bonafide_details.academicyear',$request->academicyear);
            $view = $view->with('academicyear',$request->academicyear);
        }
        else {
            $view = $view->with('academicyear','');
        }
        if($request->registerfor) {
            $bonafidelist = $bonafidelist->where('registerfor',$request->registerfor);
            $view = $view->with('registerfor',$request->registerfor);
        }
        else {
            $view = $view->with('registerfor','');
        }
        if($request->classname) {
            $bonafidelist = $bonafidelist->where('classname',$request->classname);
            $view = $view->with('classname',$request->classname);
        }
        else {
            $view = $view->with('classname','');
        }
        if($request->division) {
            $bonafidelist = $bonafidelist->where('division',$request->division);
            $classdivision = ClassLists::where('classname',$request->classname)->first();
            $divisionlist = explode(',',$classdivision->division);
            $view = $view->with('division',$request->division)->with('divisionlist',$divisionlist);
        }
        else {
            $view = $view->with('division','');
        }
        if($request->faculty) {
            $bonafidelist = $bonafidelist->where('faculty',$request->faculty);
            $view = $view->with('faculty',$request->faculty);
        }
        else {
            $view = $view->with('faculty','');
        }
        $bonafidelist = $bonafidelist->get();

        return $view->with('bonafidelist',$bonafidelist);
    }

    public function bonafidereportexcel(Request $request)
    {
        $bonafidelist = DB::table('bonafide_details')
            ->join('student_details','bonafide_details.studentid','=','student_details.userid')
            ->join('student_other_details','bonafide_details.studentid','=','student_other_details.userid');

        if($request->academicyear) {
            $bonafidelist = $bonafidelist->where('bonafide_details.academicyear',$request->academicyear);
        }
        if($request->registerfor) {
            $bonafidelist = $bonafidelist->where('registerfor',$request->registerfor);
        }
        if($request->classname) {
            $bonafidelist = $bonafidelist->where('classname',$request->classname);
        }
        if($request->division) {
            $bonafidelist = $bonafidelist->where('division',$request->division);
        }
        if($request->faculty) {
            $bonafidelist = $bonafidelist->where('faculty',$request->faculty);
        }
        $bonafidelist = $bonafidelist->get();

        foreach($bonafidelist as $bonafide)
        {
            if($bonafide->schoolname == 'Other')
            {
                $lastschool = $bonafide->lastschool;
            }
            else
            {
                $lastschool = OtherSchoolLists::where('id',$bonafide->schoolname)->value('schoolname');
            }
            $castecategory = CasteCategoryList::where('id',$bonafide->subcaste)->first();
            $religion = ReligionLists::where('id',$castecategory['religion'])->value('religion');
            $category = CategoryLists::where('id',$castecategory['category'])->value('category');
            $castename = $castecategory['castename'];
            $subcaste = $castecategory['subcaste'];

            $downloadable[] = [
                'academic year' => $bonafide->academicyear, 'registerno' => $bonafide->registerno, 'admission_date' => $bonafide->admission_date, 'first name' => $bonafide->fname,
                'father name' => $bonafide->mname, 'last name' => $bonafide->lname, 'mothername' => $bonafide->mothername,
                'classname' => $bonafide->classname, 'division' => $bonafide->division, 'aadhar' => $bonafide->aadhar,
                'saralid' => $bonafide->saralid, 'place of birth' => $bonafide->placeob, 'mothertongue' => $bonafide->mothertongue,
                'date of birth' => $bonafide->dob, 'religion' => $religion, 'category' => $category,'castename' => $castename,
                'subcaste' => $subcaste, 'lastschool' => $lastschool, 'issuedate' => $bonafide->issuedate
            ];
        }

        $downloadable = json_decode($bonafidelist,true);

        return Excel::create('bonafide list', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:O1")->setCellValue("A1","Bonafide Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:O3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function lcissuereport()
    {
        $lclist = DB::table('leaving_certificate_details')
            ->join('student_details','leaving_certificate_details.studentid','=','student_details.userid')
            ->join('student_other_details','leaving_certificate_details.studentid','=','student_other_details.userid')
            ->where('leaving_certificate_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->orderBy('leaving_certificate_details.id','desc')->get();

        return view(auth()->user()->role.'/student_lc_report')->with('lclist',$lclist)
            ->with('academicyear','')->with('registerfor','')->with('classname','')->with('division','')->with('faculty','');
    }

    public function lcissuereport_post(Request $request)
    {
        $lclist = DB::table('leaving_certificate_details')
            ->join('student_details','leaving_certificate_details.studentid','=','student_details.userid')
            ->join('student_other_details','leaving_certificate_details.studentid','=','student_other_details.userid');

        $view = view(auth()->user()->role.'/student_lc_report');

        if($request->academicyear) {
            $lclist = $lclist->where('leaving_certificate_details.academicyear',$request->academicyear);
            $view = $view->with('academicyear',$request->academicyear);
        }
        else {
            $view = $view->with('academicyear','');
        }
        if($request->registerfor) {
            $lclist = $lclist->where('registerfor',$request->registerfor);
            $view = $view->with('registerfor',$request->registerfor);
        }
        else {
            $view = $view->with('registerfor','');
        }
        if($request->classname) {
            $lclist = $lclist->where('classname',$request->classname);
            $view = $view->with('classname',$request->classname);
        }
        else {
            $view = $view->with('classname','');
        }
        if($request->division) {
            $lclist = $lclist->where('division',$request->division);
            $classdivision = ClassLists::where('classname',$request->classname)->first();
            $divisionlist = explode(',',$classdivision->division);
            $view = $view->with('division',$request->division)->with('divisionlist',$divisionlist);
        }
        else {
            $view = $view->with('division','');
        }
        if($request->faculty) {
            $lclist = $lclist->where('faculty',$request->faculty);
            $view = $view->with('faculty',$request->faculty);
        }
        else {
            $view = $view->with('faculty','');
        }
        $lclist = $lclist->get();

        return $view->with('lclist',$lclist);
    }

    public function lcissuereportexcel(Request $request)
    {
        $lclist = DB::table('leaving_certificate_details')
            ->join('student_details','leaving_certificate_details.studentid','=','student_details.userid')
            ->join('student_other_details','leaving_certificate_details.studentid','=','student_other_details.userid');

        if($request->academicyear) {
            $lclist = $lclist->where('leaving_certificate_details.academicyear',$request->academicyear);
        }
        if($request->registerfor) {
            $lclist = $lclist->where('registerfor',$request->registerfor);
        }
        if($request->classname) {
            $lclist = $lclist->where('classname',$request->classname);
        }
        if($request->division) {
            $lclist = $lclist->where('division',$request->division);
        }
        if($request->faculty) {
            $lclist = $lclist->where('faculty',$request->faculty);
        }
        $lclist = $lclist->get();

        foreach($lclist as $lc)
        {
            if($lc->schoolname == 'Other')
            {
                $lastschool = $lc->lastschool;
            }
            else
            {
                $lastschool = OtherSchoolLists::where('id',$lc->schoolname)->value('schoolname');
            }
            $castecategory = CasteCategoryList::where('id',$lc->subcaste)->first();
            $religion = ReligionLists::where('id',$castecategory['religion'])->value('religion');
            $category = CategoryLists::where('id',$castecategory['category'])->value('category');
            $castename = $castecategory['castename'];
            $subcaste = $castecategory['subcaste'];

            $downloadable[] = [
                'academic year' => $lc->academicyear, 'registerno' => $lc->registerno, 'admission_date' => $lc->admission_date, 'first name' => $lc->fname,
                'father name' => $lc->mname, 'last name' => $lc->lname, 'mothername' => $lc->mothername,
                'classname' => $lc->classname, 'division' => $lc->division, 'aadhar' => $lc->aadhar,
                'saralid' => $lc->saralid, 'place of birth' => $lc->placeob, 'mothertongue' => $lc->mothertongue,
                'date of birth' => $lc->dob, 'religion' => $religion, 'category' => $category,'castename' => $castename,
                'subcaste' => $subcaste, 'lastschool' => $lastschool, 'issuedate' => $lc->issuedate, 'progress' => $lc->progress,
                'conduct' => $lc->conduct, 'remarks' => $lc->remarks, 'dateofleaving' => $lc->dateofleaving,
                'reasonofleaving' => $lc->reasonofleaving, 'studyinginclass' => $lc->studyinginclass,
            ];
        }

        return Excel::create('LC list', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:Z1")->setCellValue("A1","Leaving Certificate Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->mergeCells("A2:Z2")->setCellValue("A2","");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->cells("A4:Z4", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A4',false);
            });
        })->download('xlsx');
    }

    public function form17lcissuereport()
    {
        $lclist = DB::table('form17_lc_details')
            ->join('student_details','form17_lc_details.studentid','=','student_details.userid')
            ->join('student_other_details','form17_lc_details.studentid','=','student_other_details.userid')
            ->where('form17_lc_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->orderBy('form17_lc_details.id','desc')->get();

        return view(auth()->user()->role.'/student_form17_lc_report')->with('lclist',$lclist)
            ->with('academicyear','')->with('registerfor','')->with('classname','')->with('division','')->with('faculty','');
    }

    public function form17lcissuereport_post(Request $request)
    {
        $lclist = DB::table('form17_lc_details')
            ->join('student_details','form17_lc_details.studentid','=','student_details.userid')
            ->join('student_other_details','form17_lc_details.studentid','=','student_other_details.userid');

        $view = view(auth()->user()->role.'/student_form17_lc_report');

        if($request->academicyear) {
            $lclist = $lclist->where('form17_lc_details.academicyear',$request->academicyear);
            $view = $view->with('academicyear',$request->academicyear);
        }
        else {
            $view = $view->with('academicyear','');
        }
        if($request->registerfor) {
            $lclist = $lclist->where('registerfor',$request->registerfor);
            $view = $view->with('registerfor',$request->registerfor);
        }
        else {
            $view = $view->with('registerfor','');
        }
        if($request->classname) {
            $lclist = $lclist->where('classname',$request->classname);
            $view = $view->with('classname',$request->classname);
        }
        else {
            $view = $view->with('classname','');
        }
        if($request->division) {
            $lclist = $lclist->where('division',$request->division);
            $classdivision = ClassLists::where('classname',$request->classname)->first();
            $divisionlist = explode(',',$classdivision->division);
            $view = $view->with('division',$request->division)->with('divisionlist',$divisionlist);
        }
        else {
            $view = $view->with('division','');
        }
        if($request->faculty) {
            $lclist = $lclist->where('faculty',$request->faculty);
            $view = $view->with('faculty',$request->faculty);
        }
        else {
            $view = $view->with('faculty','');
        }
        $lclist = $lclist->get();

        return $view->with('lclist',$lclist);
    }

    public function form17lcissuereportexcel(Request $request)
    {
        $lclist = DB::table('form17_lc_details')
            ->join('student_details','form17_lc_details.studentid','=','student_details.userid')
            ->join('student_other_details','form17_lc_details.studentid','=','student_other_details.userid');

        if($request->academicyear) {
            $lclist = $lclist->where('form17_lc_details.academicyear',$request->academicyear);
        }
        if($request->registerfor) {
            $lclist = $lclist->where('registerfor',$request->registerfor);
        }
        if($request->classname) {
            $lclist = $lclist->where('classname',$request->classname);
        }
        if($request->division) {
            $lclist = $lclist->where('division',$request->division);
        }
        if($request->faculty) {
            $lclist = $lclist->where('faculty',$request->faculty);
        }
        $lclist = $lclist->get();

        foreach($lclist as $lc)
        {
            if($lc->schoolname == 'Other')
            {
                $lastschool = $lc->lastschool;
            }
            else
            {
                $lastschool = OtherSchoolLists::where('id',$lc->schoolname)->value('schoolname');
            }
            $castecategory = CasteCategoryList::where('id',$lc->subcaste)->first();
            $religion = ReligionLists::where('id',$castecategory['religion'])->value('religion');
            $category = CategoryLists::where('id',$castecategory['category'])->value('category');
            $castename = $castecategory['castename'];
            $subcaste = $castecategory['subcaste'];

            $downloadable[] = [
                'academic year' => $lc->academicyear, 'registerno' => $lc->registerno, 'admission_date' => $lc->admission_date, 'first name' => $lc->fname,
                'father name' => $lc->mname, 'last name' => $lc->lname, 'mothername' => $lc->mothername,
                'classname' => $lc->classname, 'division' => $lc->division, 'aadhar' => $lc->aadhar,
                'saralid' => $lc->saralid, 'place of birth' => $lc->placeob, 'mothertongue' => $lc->mothertongue,
                'date of birth' => $lc->dob, 'religion' => $religion, 'category' => $category,'castename' => $castename,
                'subcaste' => $subcaste, 'lastschool' => $lastschool, 'issuedate' => $lc->issuedate
            ];
        }

        return Excel::create('LC list', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:T1")->setCellValue("A1","Leaving Certificate Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->mergeCells("A2:T2")->setCellValue("A2","");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->cells("A4:T4", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A4',false);
            });
        })->download('xlsx');
    }

    public function studentreport()
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->orderBy('student_details.id','desc')->get();
        return view(auth()->user()->role.'/student_report')->with('studentlist',$studentlist)
            ->with('academicyear','')->with('registerfor','')->with('classname','')->with('division','')->with('faculty','')
            ->with('gender','')->with('category','')->with('religion','')->with('castename','')->with('subcaste','')
            ->with('fname','')->with('mname','')->with('lname','')->with('ispwd','')->with('isminor','')->with('isbpl','');
    }

    public function studentreport_post(Request $request)
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid');

        $view = view(auth()->user()->role.'/student_report');

        if($request->academicyear) {
            $studentlist = $studentlist->where('academicyear',$request->academicyear);
            $view = $view->with('academicyear',$request->academicyear);
        }
        else {
            $view = $view->with('academicyear','');
        }
        if($request->registerfor) {
            $studentlist = $studentlist->where('registerfor',$request->registerfor);
            $view = $view->with('registerfor',$request->registerfor);
        }
        else {
            $view = $view->with('registerfor','');
        }
        if($request->classname) {
            $studentlist = $studentlist->where('classname',$request->classname);
            $view = $view->with('classname',$request->classname);
        }
        else {
            $view = $view->with('classname','');
        }
        if($request->division) {
            $studentlist = $studentlist->where('division',$request->division);
            $classdivision = ClassLists::where('classname',$request->classname)->first();
            $divisionlist = explode(',',$classdivision->division);
            $view = $view->with('division',$request->division)->with('divisionlist',$divisionlist);
        }
        else {
            $view = $view->with('division','');
        }
        if($request->faculty) {
            $studentlist = $studentlist->where('faculty',$request->faculty);
            $view = $view->with('faculty',$request->faculty);
        }
        else {
            $view = $view->with('faculty','');
        }
        if($request->gender) {
            $studentlist = $studentlist->where('gender',$request->gender);
            $view = $view->with('gender',$request->gender);
        }
        else {
            $view = $view->with('gender','');
        }
        if($request->category) {
            $studentlist = $studentlist->where('category',$request->category);
            $view = $view->with('category',$request->category);
        }
        else {
            $view = $view->with('category','');
        }
        if($request->religion) {
            $studentlist = $studentlist->where('religion',$request->religion);
            $view = $view->with('religion',$request->religion);
        }
        else {
            $view = $view->with('religion','');
        }
        if($request->castename) {
            $studentlist = $studentlist->where('castename',$request->castename);
            $castelist = CasteCategoryList::where('religion',$request->religion)->select('castename')->distinct()->get();
            $view = $view->with('castename',$request->castename)->with('castelist',$castelist);
        }
        else {
            $view = $view->with('castename','');
        }
        if($request->subcaste) {
            $studentlist = $studentlist->where('subcaste',$request->subcaste);
            $castelist = CasteCategoryList::where('religion',$request->religion)->select('castename')->distinct()->get();
            $subcastelist = CasteCategoryList::where('religion',$request->religion)->where('castename',$request->castename)->orderBy('subcaste','asc')->get();
            $view = $view->with('subcaste',$request->subcaste)->with('castelist',$castelist)->with('subcastelist',$subcastelist);
        }
        else {
            $view = $view->with('subcaste','');
        }

        if($request->fname) {
            $studentlist = $studentlist->where('fname',$request->fname);
            $view = $view->with('fname',$request->fname);
        }
        else {
            $view = $view->with('fname','');
        }
        if($request->mname) {
            $studentlist = $studentlist->where('mname',$request->mname);
            $view = $view->with('mname',$request->mname);
        }
        else {
            $view = $view->with('mname','');
        }
        if($request->lname) {
            $studentlist = $studentlist->where('lname',$request->lname);
            $view = $view->with('lname',$request->lname);
        }
        else {
            $view = $view->with('lname','');
        }

        if($request->ispwd) {
            if($request->ispwd == 'Yes'){
                $studentlist = $studentlist->where('pwd','!=','No');
                $view = $view->with('ispwd','Yes');
            }
            else{
                $studentlist = $studentlist->where('pwd','=','No');
                $view = $view->with('ispwd','No');
            }
        }
        else {
            $view = $view->with('ispwd','');
        }
        if($request->isminor) {
            if($request->isminor == 'Yes'){
                $studentlist = $studentlist->where('isminor','Yes');
                $view = $view->with('isminor','Yes');
            }
            else{
                $studentlist = $studentlist->where('isminor','No');
                $view = $view->with('isminor','No');
            }
        }
        else {
            $view = $view->with('isminor','');
        }
        if($request->isbpl) {
            if($request->isbpl == 'Yes'){
                $studentlist = $studentlist->where('bpl','!=','No');
                $view = $view->with('isbpl','Yes');
            }
            else{
                $studentlist = $studentlist->where('bpl','=','No');
                $view = $view->with('isbpl','No');
            }
        }
        else {
            $view = $view->with('isbpl','');
        }

        $studentlist = $studentlist->orderBy('student_details.id','desc')->get();

        return $view->with('studentlist',$studentlist);
    }

    public function studentreportexcel(Request $request)
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid');

        if($request->academicyear) {
            $studentlist = $studentlist->where('academicyear',$request->academicyear);
        }
        if($request->registerfor) {
            $studentlist = $studentlist->where('registerfor',$request->registerfor);
        }
        if($request->classname) {
            $studentlist = $studentlist->where('classname',$request->classname);
        }
        if($request->division) {
            $studentlist = $studentlist->where('division',$request->division);
        }
        if($request->faculty) {
            $studentlist = $studentlist->where('faculty',$request->faculty);
        }
        if($request->gender) {
            $studentlist = $studentlist->where('gender',$request->gender);
        }
        if($request->category) {
            $studentlist = $studentlist->where('category',$request->category);
        }
        if($request->religion) {
            $studentlist = $studentlist->where('religion',$request->religion);
        }
        if($request->castename) {
            $studentlist = $studentlist->where('castename',$request->castename);
        }
        if($request->subcaste) {
            $studentlist = $studentlist->where('subcaste',$request->subcaste);
        }
        if($request->fname) {
            $studentlist = $studentlist->where('fname',$request->fname);
        }
        if($request->mname) {
            $studentlist = $studentlist->where('mname',$request->mname);
        }
        if($request->lname) {
            $studentlist = $studentlist->where('lname',$request->lname);
        }
        if($request->ispwd) {
            if($request->ispwd == 'Yes'){
                $studentlist = $studentlist->where('pwd','!=','No');
            }
            else{
                $studentlist = $studentlist->where('pwd','=','No');
            }
        }
        if($request->isminor) {
            if($request->isminor == 'Yes'){
                $studentlist = $studentlist->where('isminor','Yes');
            }
            else{
                $studentlist = $studentlist->where('isminor','No');
            }
        }
        if($request->isbpl) {
            if($request->isbpl == 'Yes'){
                $studentlist = $studentlist->where('bpl','!=','No');
            }
            else{
                $studentlist = $studentlist->where('bpl','=','No');
            }
        }

        $students = $studentlist->orderBy('student_details.id','desc')->get();

        foreach($students as $student)
        {
            if($student->schoolname == 'Other')
            {
                $lastschool = $student->lastschool;
            }
            else
            {
                $lastschool = OtherSchoolLists::where('id',$student->schoolname)->value('schoolname');
            }
            $castecategory = CasteCategoryList::where('id',$student->subcaste)->first();
            $religion = ReligionLists::where('id',$castecategory['religion'])->value('religion');
            $category = CategoryLists::where('id',$castecategory['category'])->value('category');
            $castename = $castecategory['castename'];
            $subcaste = $castecategory['subcaste'];

            $downloadable[] = [
                'current academic year' => $student->academicyear, 'admission year' => $student->admission_year, 'registerno' => $student->registerno,
                'admission date' => $student->admission_date, 'admission class' => $student->admission_class, 'first name' => $student->fname,
                'father name' => $student->mname, 'last name' => $student->lname, 'mothername' => $student->mothername,
                'current class' => $student->classname, 'division' => $student->division, 'aadhar' => $student->aadhar,
                'saralid' => $student->saralid, 'place of birth' => $student->placeob, 'mothertongue' => $student->mothertongue,
                'date of birth' => $student->dob, 'religion' => $religion, 'category' => $category,'castename' => $castename,
                'subcaste' => $subcaste,'PwD' => $student->pwd,'Family income' => $student->familyincome,'bpl' => $student->bpl,
                'isminor' => $student->isminor,'lastschool' => $lastschool,'current address' => $student->currentaddress,
                'permanent address' => $student->permanentaddress,'bank account title' => $student->accounttitle,
                'account no' => $student->accountno, 'IFSC code' => $student->bankifsccode,'bank name' => $student->bankname,
                'bank branch name' => $student->bankbranchname, 'MICR code' => $student->bankmicrcode,
            ];
        }

        $reportdata['religion'] = ReligionLists::where('id',$request->religion)->value('religion');
        $reportdata['castename'] = CasteCategoryList::where('id',$request->subcaste)->value('castename');
        $reportdata['subcaste'] = CasteCategoryList::where('id',$request->subcaste)->value('subcaste');

        return Excel::create('Student list', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:AD1")->setCellValue("A1","Student Details Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:AD3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function studentcustomreportexcel(Request $request)
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid');

        if($request->academicyear) {
            $studentlist = $studentlist->where('academicyear',$request->academicyear);
        }
        if($request->registerfor) {
            $studentlist = $studentlist->where('registerfor',$request->registerfor);
        }
        if($request->classname) {
            $studentlist = $studentlist->where('classname',$request->classname);
        }
        if($request->division) {
            $studentlist = $studentlist->where('division',$request->division);
        }
        if($request->faculty) {
            $studentlist = $studentlist->where('faculty',$request->faculty);
        }
        if($request->gender) {
            $studentlist = $studentlist->where('gender',$request->gender);
        }
        if($request->category) {
            $studentlist = $studentlist->where('category',$request->category);
        }
        if($request->religion) {
            $studentlist = $studentlist->where('religion',$request->religion);
        }
        if($request->castename) {
            $studentlist = $studentlist->where('castename',$request->castename);
        }
        if($request->subcaste) {
            $studentlist = $studentlist->where('subcaste',$request->subcaste);
        }
        if($request->fname) {
            $studentlist = $studentlist->where('fname',$request->fname);
        }
        if($request->mname) {
            $studentlist = $studentlist->where('mname',$request->mname);
        }
        if($request->lname) {
            $studentlist = $studentlist->where('lname',$request->lname);
        }
        if($request->ispwd) {
            if($request->ispwd == 'Yes'){
                $studentlist = $studentlist->where('pwd','!=','No');
            }
            else{
                $studentlist = $studentlist->where('pwd','=','No');
            }
        }
        if($request->isminor) {
            if($request->isminor == 'Yes'){
                $studentlist = $studentlist->where('isminor','Yes');
            }
            else{
                $studentlist = $studentlist->where('isminor','No');
            }
        }
        if($request->isbpl) {
            if($request->isbpl == 'Yes'){
                $studentlist = $studentlist->where('bpl','!=','No');
            }
            else{
                $studentlist = $studentlist->where('bpl','=','No');
            }
        }

        $students = $studentlist->orderBy('student_details.id','desc')->get();

        foreach($students as $student)
        {
            $castecategory = CasteCategoryList::where('id',$student->subcaste)->first();
            $religion = ReligionLists::where('id',$castecategory['religion'])->value('religion');
            $category = CategoryLists::where('id',$castecategory['category'])->value('category');
            $castename = $castecategory['castename'];
            $subcaste = $castecategory['subcaste'];

            $downloadable[] = [
                'academicyear year' => $student->academicyear, 'registerno' => $student->registerno, 'registerfor' => $student->registerfor,
                'current class' => $student->classname, 'division' => $student->division,'first name' => $student->fname,
                'father name' => $student->mname, 'last name' => $student->lname, 'mothername' => $student->mothername,
                'gender' => $student->gender,
                'religion' => $religion, 'category' => $category,'castename' => $castename,'subcaste' => $subcaste,
                'PwD' => $student->pwd,'BPL' => $student->bpl,'isminor' => $student->isminor,
            ];
        }

        $reportdata['religion'] = ReligionLists::where('id',$request->religion)->value('religion');
        $reportdata['castename'] = CasteCategoryList::where('id',$request->subcaste)->value('castename');
        $reportdata['subcaste'] = CasteCategoryList::where('id',$request->subcaste)->value('subcaste');

        return Excel::create('Student list', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:Q1")->setCellValue("A1","Student Details Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:Q3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function form17studentreport()
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor','School Form 17')
            ->orWhere('student_details.registerfor','College Form 17')
            ->orderBy('student_details.id','desc')->get();
        return view(auth()->user()->role.'/student_form17_report')->with('studentlist',$studentlist)
            ->with('registerfor','');
    }

    public function form17studentreport_post(Request $request)
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',$request->registerfor)
            ->orderBy('student_details.id','desc')->get();

        return view(auth()->user()->role.'/student_form17_report')->with('studentlist',$studentlist)->with('registerfor',$request->registerfor);
    }

    public function form17studentreportexcel(Request $request)
    {
        $students = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',$request->registerfor)
            ->orderBy('student_details.id','asc')->get();

        foreach($students as $student)
        {
            if($student->schoolname == 'Other')
            {
                $lastschool = $student->lastschool;
            }
            else
            {
                $lastschool = OtherSchoolLists::where('id',$student->schoolname)->value('schoolname');
            }

            $downloadable[] = [
                'academic year' => $student->academicyear, 'registerno' => $student->registerno, 'admission_date' => $student->admission_date, 'first name' => $student->fname,
                'father name' => $student->mname, 'last name' => $student->lname, 'mothername' => $student->mothername,
                'classname' => $student->classname, 'division' => $student->division, 'aadhar' => $student->aadhar,
                'saralid' => $student->saralid, 'place of birth' => $student->placeob, 'mothertongue' => $student->mothertongue,
                'date of birth' => $student->dob, 'religion' => $student->religion, 'category' => $student->category,
                'castename' => $student->castename, 'subcaste' => $student->subcaste, 'lastschool' => $lastschool,
                'current address' => $student->currentaddress, 'permanent address' => $student->permanentaddress,
                'bank account title' => $student->accounttitle, 'account no' => $student->accountno, 'IFSC code' => $student->bankifsccode,
                'bank name' => $student->bankname, 'bank branch name' => $student->bankbranchname, 'MICR code' => $student->bankmicrcode,
            ];
        }

        $reportdata['registerfor'] = $request->registerfor;

        return Excel::create('Student list', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:AA1")->setCellValue("A1","Student form17 Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->mergeCells("A2:AA2")->setCellValue("A2","Register for: {$reportdata['registerfor']}");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->cells("A4:AA4", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A4',false);
            });
        })->download('xlsx');
    }

    public function castewisestaffreport()
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->orderBy('staff_details.id','desc')->get();
        return view(auth()->user()->role.'/staff_castewise_report')->with('stafflist',$stafflist)
            ->with('religion','')->with('castename','')->with('subcaste','');
    }

    public function castewisestaffreport_post(Request $request)
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->where('staff_details.religion',$request->religion)
            ->where('staff_details.castename',$request->castename)
            ->where('staff_details.subcaste',$request->subcaste)
            ->orderBy('staff_details.id','desc')->get();

        $castelist = CasteCategoryList::where('religion',$request->religion)->select('castename')->distinct()->get();
        $subcastelist = CasteCategoryList::where('religion',$request->religion)->where('castename',$request->castename)->orderBy('subcaste','asc')->get();

        return view(auth()->user()->role.'/staff_castewise_report')->with('stafflist',$stafflist)->with('religion',$request->religion)
            ->with('castename',$request->castename)->with('subcaste',$request->subcaste)->with('castelist',$castelist)
            ->with('subcastelist',$subcastelist);
    }

    public function castewisestaffreportexcel(Request $request)
    {
        $religion = decrypt($request->religion);
        $castename = decrypt($request->castename);
        $subcaste = decrypt($request->subcaste);

        $staffs = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->where('staff_details.religion',$religion)
            ->where('staff_details.castename',$castename)
            ->where('staff_details.subcaste',$subcaste)
            ->orderBy('staff_details.id','asc')->get();

        foreach($staffs as $staff)
        {
            $downloadable[] = [
                'staff id' => $staff->staffid, 'shalarth id' => $staff->shalarthid, 'designation' => $staff->designation,
                'first name' => $staff->fname,'father name' => $staff->mname, 'last name' => $staff->lname, 'mothername' => $staff->mothername,
                'aadhar' => $staff->aadhar, 'place of birth' => $staff->placeob, 'mothertongue' => $staff->mothertongue,
                'date of birth' => $staff->dob, 'religion' => $staff->religion, 'category' => $staff->category,
                'castename' => $staff->castename, 'subcaste' => $staff->subcaste, 'bloodgroup' => $staff->bloodgroup,
                'qualification details' => $staff->qualificationdetails, 'experience details' => $staff->experiencedetails,
                'current address' => $staff->currentaddress, 'permanent address' => $staff->permanentaddress,
                'EPF no' => $staff->epfno, 'basic salary' => $staff->basicsalary, 'contract type' => $staff->contracttype,
                'bank account title' => $staff->accounttitle, 'account no' => $staff->accountno, 'IFSC code' => $staff->bankifsccode,
                'bank name' => $staff->bankname, 'bank branch name' => $staff->bankbranchname, 'MICR code' => $staff->bankmicrcode,
            ];
        }

        $reportdata['religion'] = ReligionLists::where('id',$religion)->value('religion');
        $reportdata['castename'] = CasteCategoryList::where('id',$subcaste)->value('castename');
        $reportdata['subcaste'] = CasteCategoryList::where('id',$subcaste)->value('subcaste');

        return Excel::create('Staff list', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:AC1")->setCellValue("A1","Staff Castewise Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->mergeCells("A2:AC2")->setCellValue("A2","Religion: {$reportdata['religion']}, Caste: {$reportdata['castename']}, Subcaste: {$reportdata['subcaste']}");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->cells("A4:AC4", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A4',false);
            });
        })->download('xlsx');
    }

    public function genderwisestaffreport()
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->orderBy('staff_details.id','desc')->get();
        return view(auth()->user()->role.'/staff_genderwise_report')->with('stafflist',$stafflist)
            ->with('gender','');
    }

    public function genderwisestaffreport_post(Request $request)
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->where('staff_details.gender',$request->gender)
            ->orderBy('staff_details.id','desc')->get();

        return view(auth()->user()->role.'/staff_genderwise_report')->with('stafflist',$stafflist)->with('gender',$request->gender);
    }

    public function genderwisestaffreportexcel(Request $request)
    {
        $staffs = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->where('staff_details.gender',$request->gender)
            ->orderBy('staff_details.id','asc')->get();

        foreach($staffs as $staff)
        {
            $downloadable[] = [
                'staff id' => $staff->staffid, 'shalarth id' => $staff->shalarthid, 'designation' => $staff->designation,
                'first name' => $staff->fname,'father name' => $staff->mname, 'last name' => $staff->lname, 'mothername' => $staff->mothername,
                'aadhar' => $staff->aadhar, 'place of birth' => $staff->placeob, 'mothertongue' => $staff->mothertongue,
                'date of birth' => $staff->dob, 'religion' => $staff->religion, 'category' => $staff->category,
                'castename' => $staff->castename, 'subcaste' => $staff->subcaste, 'bloodgroup' => $staff->bloodgroup,
                'qualification details' => $staff->qualificationdetails, 'experience details' => $staff->experiencedetails,
                'current address' => $staff->currentaddress, 'permanent address' => $staff->permanentaddress,
                'EPF no' => $staff->epfno, 'basic salary' => $staff->basicsalary, 'contract type' => $staff->contracttype,
                'bank account title' => $staff->accounttitle, 'account no' => $staff->accountno, 'IFSC code' => $staff->bankifsccode,
                'bank name' => $staff->bankname, 'bank branch name' => $staff->bankbranchname, 'MICR code' => $staff->bankmicrcode,
            ];
        }

        $reportdata['gender'] = $request->gender;

        return Excel::create('staff list', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:AC1")->setCellValue("A1","Staff Genderwise Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->mergeCells("A2:AC2")->setCellValue("A2","Gender: {$reportdata['gender']}");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->cells("A4:AC4", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A4',false);
            });
        })->download('xlsx');
    }

    public function studentcataloguereport()
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->orderBy('student_details.id','desc')->get();
        return view(auth()->user()->role.'/student_catalogue_report')->with('studentlist',$studentlist)->with('classname','');
    }

    public function studentcataloguereport_post(Request $request)
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->where('student_details.classname',$request->classname)
            ->orderBy('student_details.id','desc')->get();
        return view(auth()->user()->role.'/student_catalogue_report')->with('studentlist',$studentlist)->with('classname',$request->classname);
    }

    public function studentcataloguereportexcel(Request $request)
    {
        $students = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->where('student_details.classname',$request->classname)
            ->orderBy('student_details.id','asc')->get();

        $srno=1;

        foreach($students as $student)
        {
            $downloadable[] = [
                '#' => $srno,
                'Gen. Reg. No.' => $student->registerno,
                'Date of birth' => $student->dob,
                'Castename' => $student->castename,
                'Type of fee' => $student->category,
                'Mobile' => $student->mobile,
                'Gap sub.' => '',
                'Roll No.' => $student->roll_no,
                'Pupils full name' => $student->fname.' '.$student->mname.' '.$student->lname,
            ];
            $srno++;
        }

        $reportdata['classname'] = $request->classname;
        $reportdata['academicyear'] = Session::get('academicyear');

        return Excel::create('Student catalogue', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:I1")->setCellValue("A1",config('app.name'));
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 18,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells("A2:I2")->setCellValue("A2","Class: {$reportdata['classname']} - Academic year: {$reportdata['academicyear']}");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells("A3:I3")->setCellValue("A3","Student Catalogue report");
                $sheet->cells("A3", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 14,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->cells("A5:I5", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->fromArray($downloadable,null,'A5',false);
//                $sheet->setBorder('A1:K49', 'thin');
//                $sheet->setAllBorders('thin');

            });
        })->download('xlsx');
    }

    public function staffcataloguereport()
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->orderBy('staff_details.id','desc')->get();
        return view(auth()->user()->role.'/staff_catalogue_report')->with('stafflist',$stafflist);
    }

    public function staffcataloguereportexcel(Request $request)
    {
        $staffs = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->join('designation_lists','designation_lists.id','=','staff_details.designation')
            ->orderBy('staff_details.id','asc')->get();

        foreach($staffs as $staff)
        {
            $downloadable[] = [
                'staff id' => $staff->staffid, 'shalarth id' => $staff->shalarthid, 'designation' => $staff->designation,
                'first name' => $staff->fname,'father name' => $staff->mname, 'last name' => $staff->lname, 'mothername' => $staff->mothername,
                'aadhar' => $staff->aadhar, 'place of birth' => $staff->placeob, 'mothertongue' => $staff->mothertongue,
                'date of birth' => $staff->dob, 'religion' => $staff->religion, 'category' => $staff->category,
                'castename' => $staff->castename, 'subcaste' => $staff->subcaste, 'bloodgroup' => $staff->bloodgroup,
                'qualification details' => $staff->qualificationdetails, 'experience details' => $staff->experiencedetails,
                'current address' => $staff->currentaddress, 'permanent address' => $staff->permanentaddress,
                'EPF no' => $staff->epfno, 'basic salary' => $staff->basicsalary, 'contract type' => $staff->contracttype,
                'bank account title' => $staff->accounttitle, 'account no' => $staff->accountno, 'IFSC code' => $staff->bankifsccode,
                'bank name' => $staff->bankname, 'bank branch name' => $staff->bankbranchname, 'MICR code' => $staff->bankmicrcode,
            ];
        }

        $reportdata['gender'] = $request->gender;

        return Excel::create('staff list', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:AC1")->setCellValue("A1","Staff Catalogue Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->cells("A3:AC3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function studentattendanceataloguereport()
    {
        return view(auth()->user()->role.'/studentattendanceataloguereport')->with('studentlist','')
            ->with('classname','')->with('division','')->with('year','')->with('month','');
    }

    public function studentattendanceataloguereport_post(Request $request)
    {
        $data = $request->all();

        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

//        return $alldates;

        $dates = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->select('attendancedate')->distinct()->orderBy('attendancedate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->attendancedate)
                {
                    $datelist[] = [
                        'attendancedate' => $date1->attendancedate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','Attendance not taken in this month');
        }

        $studentlist=[];
        foreach($datelist as $date)
        {
            $presentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','1')->get()->count();
            $absentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','0')->get()->count();

            $data['attendancedate'] = $date['attendancedate'];
            $data['classname'] = $request->classname;
            $data['division'] = $request->division;
            $data['presentcount'] = $presentcount;
            $data['absentcount'] = $absentcount;
            $data['totalcount'] = $presentcount+$absentcount;
            array_push($studentlist,$data);
        }

        $divisions = ClassLists::where('classname',$request->classname)->first();
        $divisionlist = explode(',',$divisions->division);
        return view(auth()->user()->role.'/studentattendanceataloguereport')->with('studentlist',$studentlist)->with('divisionlist',$divisionlist)
            ->with('classname',$request->classname)->with('division',$request->division)
            ->with('month',$request->month)->with('year',$request->year);
    }

    public function studentattendanceataloguereport_details(Request $request)
    {
        $totaldays = 0;
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
                $totaldays++;
            }
        }
        $data['startdate'] = $alldates[0];
        $data['enddate'] = $alldates[count($alldates)-1];

        $dates = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->select('attendancedate')->distinct()->orderBy('attendancedate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->attendancedate)
                {
                    $datelist[] = [
                        'attendancedate' => $date1->attendancedate,
                    ];
                }
            }
        }

        $otherdata['classname'] = $request->classname;
        $otherdata['division'] = $request->division;
        $otherdata['month'] = date('F', $time-50000);
        $otherdata['year'] = $request->year;
        $otherdata['academicyear'] = Session::get('academicyear');
        $teacherid = ClassTeacherDetails::where('classname',$request->classname)->where('division',$request->division)->first()->teacherid;
        $teacherdetails = StaffDetails::where('userid',$teacherid)->first();
        $otherdata['classteacher'] = $teacherdetails->fname.' '.$teacherdetails->lname;
        $otherdata['totaldays'] = $totaldays;
        $otherdata['workingdays'] = count($datelist);
        $otherdata['nonworkingdays'] = $totaldays-count($datelist);
        $otherdata['averageonroll'] = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->get()->count();

        $totalpresent=0;
        $totalabsent=0;

        foreach($datelist as $date)
        {
            $presentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','1')->get()->count();
            $absentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','0')->get()->count();

            $totalpresent += $presentcount;
            $totalabsent += $absentcount;
        }
        $totalstudents = $totalpresent + $totalabsent;
        $averageattendance = round($totalpresent*100/$totalstudents,2);
        $averageabsence = round($totalabsent*100/$totalstudents,2);

        $otherdata['averageattendance'] = $averageattendance;
        $otherdata['averageabsence'] = $averageabsence;
        $otherdata['alldates'] = $alldates;

        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
            ->where('division',$request->division)->get();

        $downloadable = null;
        foreach($studentlist as $student)
        {
            $studentattendance = null;
            foreach($alldates as $date)
            {
                $attendance = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
                    ->where('classname',$request->classname)->where('division',$request->division)
                    ->where('attendancedate',$date)->where('studentid',$student->userid)->first();
                if($attendance)
                {
                    if($attendance->ispresent == 1)
                    {
                        $studentattendance[] = [
                            'date' => $date,
                            'ispresent' => 'P',
                        ];
                    }
                    else
                    {
                        $studentattendance[] = [
                            'date' => $date,
                            'ispresent' => 'A',
                        ];
                    }
                }
                else
                {
                    $studentattendance[] = [
                        'date' => $date,
                        'ispresent' => 'H',
                    ];
                }
            }
            $downloadable[] = [
                'studentname' => $student->fname.' '.$student->mname.' '.$student->lname,
                'attendance' => $studentattendance,
            ];
        }

        return Excel::create('Student attendance details '.$request->year.'-'.$request->month, function($excel) use ($downloadable,$otherdata) {
            $excel->sheet('Sheet1', function ($sheet) use ($downloadable,$otherdata) {
                $sheet->mergeCells("A1:AI1")->setCellValue("A1",config('app.name'));
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 18,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells("A2:AI2")->setCellValue("A2","Class: {$otherdata['classname']}({$otherdata['division']}) - Academic year: {$otherdata['academicyear']}");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells("A3:AI3")->setCellValue("A3","Student Attendance Report ({$otherdata['month']}-{$otherdata['year']})");
                $sheet->cells("A3", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 14,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $column = 'B';
                $row = 5;
                $sheet->setCellValue("A5", "Student Name")->cells("A5", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                for ($i = 0; $i < count($otherdata['alldates']); $i++) {
                    $sheet->setCellValue("{$column}{$row}", $otherdata['alldates'][$i])->cells("{$column}{$row}", function ($cells) {
                        $cells->setFont(array(
                            'name' => 'Calibri',
                            'bold' => true
                        ));
                        $cells->setAlignment('center');
                    });
                    $column++;
                }
                $sheet->setCellValue("{$column}{$row}","Present days")->cells("{$column}{$row}", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $column++;
                $sheet->setCellValue("{$column}{$row}","Absent days")->cells("{$column}{$row}", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $column++;
                $sheet->setCellValue("{$column}{$row}","Remarks")->cells("{$column}{$row}", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });

                $row=7;
                for($i=0; $i<count($downloadable); $i++)
                {
                    $column='A';
                    $presentdays=0;
                    $absentdays=0;

                    $sheet->setCellValue("{$column}{$row}", $downloadable[$i]['studentname']);
                    $column++;
                    for ($j = 0; $j < count($otherdata['alldates']); $j++) {
                        for($k=0; $k<count($otherdata['alldates']); $k++)
                        {
                            if($downloadable[$i]['attendance'][$k]['date'] == $otherdata['alldates'][$j])
                            {
                                $sheet->setCellValue("{$column}{$row}", $downloadable[$i]['attendance'][$k]['ispresent'])->cells("{$column}{$row}", function ($cells) {
                                    $cells->setAlignment('center');
                                });
                                if($downloadable[$i]['attendance'][$k]['ispresent'] == 'P'){
                                    $presentdays++;
                                }
                                else if($downloadable[$i]['attendance'][$k]['ispresent'] == 'A'){
                                    $absentdays++;
                                }

                            }
                        }
                        $column++;
                    }
                    $sheet->setCellValue("{$column}{$row}","{$presentdays}");
                    $column++;
                    $sheet->setCellValue("{$column}{$row}","{$absentdays}");
                    $row++;
                }

            });
        })->download('xlsx');
    }

    public function studentattendanceataloguereport_summary(Request $request)
    {
        $totaldays = 0;
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
                $totaldays++;
            }
        }
        $data['startdate'] = $alldates[0];
        $data['enddate'] = $alldates[count($alldates)-1];

        $dates = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->select('attendancedate')->distinct()->orderBy('attendancedate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->attendancedate)
                {
                    $datelist[] = [
                        'attendancedate' => $date1->attendancedate,
                    ];
                }
            }
        }

        $otherdata['classname'] = $request->classname;
        $otherdata['division'] = $request->division;
        $otherdata['month'] = date('F', $time-50000);
        $otherdata['year'] = $request->year;
        $teacherid = ClassTeacherDetails::where('classname',$request->classname)->where('division',$request->division)->first()->teacherid;
        $teacherdetails = StaffDetails::where('userid',$teacherid)->first();
        $otherdata['classteacher'] = $teacherdetails->fname.' '.$teacherdetails->lname;
        $otherdata['totaldays'] = $totaldays;
        $otherdata['workingdays'] = count($datelist);
        $otherdata['nonworkingdays'] = $totaldays-count($datelist);
        $otherdata['averageonroll'] = StudentDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)->where('division',$request->division)->get()->count();

        $totalpresent=0;
        $totalabsent=0;

        foreach($datelist as $date)
        {
            $presentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','1')->get()->count();
            $absentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','0')->get()->count();

            $totalpresent += $presentcount;
            $totalabsent += $absentcount;
        }
        $totalstudents = $totalpresent + $totalabsent;
        $averageattendance = round($totalpresent*100/$totalstudents,2);
        $averageabsence = round($totalabsent*100/$totalstudents,2);

        $otherdata['averageattendance'] = $averageattendance;
        $otherdata['averageabsence'] = $averageabsence;

//        $downloadable = json_decode($datelist,true);
        $downloadable = $datelist;

        return Excel::create('monthly attendance '.date('F-Y',$time), function($excel) use ($downloadable,$otherdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$otherdata)
            {
                $sheet->setAutoSize(true);
//                $sheet->setBorder("A1:L57", 'thin' );

                $sheet->mergeCells("A1:L1")->setCellValue("A1",config('app.name'));
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells("A2:L2")->setCellValue("A2","MONTHLY ATTENDANCE REGISTER");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 14,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A3:G3")->setCellValue("A3","STATEMENT OF FEES");
                $sheet->cells("A3", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 13,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("H3:I3")->setCellValue("H3","Std   {$otherdata['classname']}");
                $sheet->cells("H3", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 13,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("J3:L3")->setCellValue("J3","Div   {$otherdata['division']}");
                $sheet->cells("J3", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 13,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A4:B5")->setCellValue("A4","Date of installment");
                $sheet->cells("A4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("C4:C5")->setCellValue("C4","Entrance Fee");
                $sheet->cells("C4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("D4:D5")->setCellValue("D4","Tution Fee");
                $sheet->cells("D4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("E4:E5")->setCellValue("E4","Term Fee");
                $sheet->cells("E4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("F4:F5")->setCellValue("F4","Total Fee");
                $sheet->cells("F4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("G4:G5")->setCellValue("G4","Initials of Cashier");
                $sheet->cells("G4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("H4:L4")->setCellValue("H4","Month:- {$otherdata['month']} - {$otherdata['year']}");
                $sheet->cells("H4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("H5:L5")->setCellValue("H5","Class teacher:- {$otherdata['classteacher']}");
                $sheet->cells("H5", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A6:B7")->setCellValue("A6","1");
                $sheet->cells("A6", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A8:B9")->setCellValue("A8","2");
                $sheet->cells("A8", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A10:B11")->setCellValue("A10","3");
                $sheet->cells("A10", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A12:B13")->setCellValue("A12","4");
                $sheet->cells("A12", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A14:B15")->setCellValue("A14","5");
                $sheet->cells("A14", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A16:B17")->setCellValue("A16","Total Fee Recd");
                $sheet->cells("A16", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A18:B19")->setCellValue("A18","Total Fee Due");
                $sheet->cells("A18", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("C6:C7")->mergeCells("D6:D7")->mergeCells("E6:E7")->mergeCells("F6:F7")->mergeCells("G6:G7");
                $sheet->mergeCells("C8:C9")->mergeCells("D8:D9")->mergeCells("E8:E9")->mergeCells("F8:F9")->mergeCells("G8:G9");
                $sheet->mergeCells("C10:C11")->mergeCells("D10:D11")->mergeCells("E10:E11")->mergeCells("F10:F11")->mergeCells("G10:G11");
                $sheet->mergeCells("C12:C13")->mergeCells("D12:D13")->mergeCells("E12:E13")->mergeCells("F12:F13")->mergeCells("G12:G13");
                $sheet->mergeCells("C14:C15")->mergeCells("D14:D15")->mergeCells("E14:E15")->mergeCells("F14:F15")->mergeCells("G14:G15");
                $sheet->mergeCells("C16:C17")->mergeCells("D16:D17")->mergeCells("E16:E17")->mergeCells("F16:F17")->mergeCells("G16:G17");
                $sheet->mergeCells("C18:C19")->mergeCells("D18:D19")->mergeCells("E18:E19")->mergeCells("F18:F19")->mergeCells("G18:G19");

                $sheet->mergeCells("H6:I6")->mergeCells("H7:I7")->mergeCells("H8:I8")->mergeCells("H9:I9")->mergeCells("H10:I10");
                $sheet->mergeCells("J6:L6")->mergeCells("J7:L7")->mergeCells("J8:L8")->mergeCells("J9:L9")->mergeCells("J10:L10");

                $sheet->setCellValue("H6","Working Days")->setCellValue("H7","Non-Working Days")->setCellValue("H8","Average on roll");
                $sheet->setCellValue("H9","Average attendance")->setCellValue("H10","Average absence");
                $sheet->setCellValue("H6","Working Days")->setCellValue("H7","Non-Working Days")->setCellValue("H8","Average on roll");
                $sheet->setCellValue("I11","Boys")->setCellValue("J11","Girls")->mergeCells("K11:L11")->setCellValue("K11","Total");
                $sheet->setCellValue("H12","SC")->setCellValue("H13","ST")->setCellValue("H14","VJNT")->setCellValue("H15","OBC");
                $sheet->setCellValue("H16","SBC")->setCellValue("H17","Non BC")->setCellValue("H18","Minority")->setCellValue("H19","Total");
                for($i=6;$i<20;$i++){
                    $sheet->cells("H{$i}", function ($cells) {
                        $cells->setFont(array(
                            'name' => 'Calibri',
                            'size' => 11,
                            'bold' => true
                        ));
                        $cells->setAlignment('center')->setValignment('center');
                    });
                }
                for($i=12;$i<20;$i++){
                    $sheet->mergeCells("K{$i}:L{$i}");
                }
                $sheet->cells("I11", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->cells("J11", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->cells("K11", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 11,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("J6",$otherdata['workingdays'])->setCellValue("J7",$otherdata['nonworkingdays']);
                $sheet->setCellValue("J8",$otherdata['averageonroll'].' Students')->setCellValue("J9",$otherdata['averageattendance'].' %');
                $sheet->setCellValue("J10",$otherdata['averageabsence'].' %');

                $sheet->mergeCells("A20:F22")->mergeCells("G20:L22")->mergeCells("A23:L23");
                $sheet->setCellValue("A20","DESCRIPTION OF PUPILS")->setCellValue("G20","Month:- {$otherdata['month']} - {$otherdata['year']}");
                $sheet->setCellValue("A23","Government concession");
                $sheet->mergeCells("A24:B24");
                $sheet->setCellValue("A24","Paying")->setCellValue("A26","Paying")->setCellValue("C24","EBC")->setCellValue("D24","BC");
                $sheet->setCellValue("E24","Handicap")->setCellValue("F24","Govt.SW")->setCellValue("G24","ST Wards")->setCellValue("H24","PT Wards");
                $sheet->setCellValue("I24","FF Wards")->setCellValue("J24","Sold WA")->setCellValue("K24","Other")->setCellValue("L24","Total");
                $sheet->mergeCells("A25:B28")->mergeCells("C25:C28")->mergeCells("D25:D28")->mergeCells("E25:E28")->mergeCells("F25:F28");
                $sheet->mergeCells("G25:G28")->mergeCells("H25:H28")->mergeCells("I25:I28")->mergeCells("J25:J28")->mergeCells("K25:K28");
                $sheet->mergeCells("L25:L28")->mergeCells("A29:L31");
                $sheet->setCellValue("A29","REPORT ON PUPILS WITHDRAWN OR ADMITTED");
                $start=33;
                $end=34;
                for($i=0;$i<9;$i++)
                {
                    $sheet->mergeCells("A{$start}:A{$end}")->mergeCells("B{$start}:C{$end}")->mergeCells("D{$start}:F{$end}")->mergeCells("G{$start}:G{$end}")->mergeCells("H{$start}:I{$end}")->mergeCells("J{$start}:J{$end}")->mergeCells("K{$start}:L{$end}");
                    $start+=2;
                    $end+=2;
                }
                $sheet->mergeCells("A55:D55")->setCellValue("A55","CLASSTEACHER");
                $sheet->mergeCells("A56:D56")->setCellValue("A56",$otherdata['classteacher']);
                $sheet->mergeCells("I55:L55")->setCellValue("I55","SUPERVISOR");
                $sheet->mergeCells("I56:L56")->mergeCells("B32:C32")->mergeCells("D32:F32")->mergeCells("H32:I32")->mergeCells("K32:L32");

                $sheet->setCellValue("A32","Sr.No.")->setCellValue("B32","General Reg. No.")->setCellValue("D32","Name of Pupil")->setCellValue("G32","Date of Adm.");
                $sheet->setCellValue("H32","Date of withdrawal")->setCellValue("J32","Fees Due")->setCellValue("K32","Remark");

                $sheet->cells("A20", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("G20", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("A23", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("A24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("C24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("D24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("E24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("F24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("G24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("H24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("I24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("J24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("K24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("L24", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("A29", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 14, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("A32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("B32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("D32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("G32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("H32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("J32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("K32", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("A55", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("A56", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("I55", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});
                $sheet->cells("I56", function ($cells) {$cells->setFont(array('name' => 'Calibri', 'size' => 12, 'bold' => true));$cells->setAlignment('center')->setValignment('center');});

                /*$styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                    ],
                ];

                $sheet->getStyle('A1:I56')->applyFromArray($styleArray);*/
            });
        })->download('xlsx');
    }

    public function studentcataloguereport_studiesofmonth(Request $request)
    {
        $totaldays = 0;
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
                $totaldays++;
            }
        }
        $data['startdate'] = $alldates[0];
        $data['enddate'] = $alldates[count($alldates)-1];

        $dates = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->select('attendancedate')->distinct()->orderBy('attendancedate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->attendancedate)
                {
                    $datelist[] = [
                        'attendancedate' => $date1->attendancedate,
                    ];
                }
            }
        }

        $otherdata['classname'] = $request->classname;
        $otherdata['division'] = $request->division;
        $otherdata['month'] = date('F', $time-50000);
        $otherdata['year'] = $request->year;
        $otherdata['academicyear'] = Session::get('academicyear');
        $teacherid = ClassTeacherDetails::where('classname',$request->classname)->where('division',$request->division)->first()->teacherid;
        $teacherdetails = StaffDetails::where('userid',$teacherid)->first();
        $otherdata['classteacher'] = $teacherdetails->fname.' '.$teacherdetails->lname;
        $otherdata['totaldays'] = $totaldays;
        $otherdata['workingdays'] = count($datelist);
        $otherdata['nonworkingdays'] = $totaldays-count($datelist);
        $otherdata['averageonroll'] = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->get()->count();

        $totalpresent=0;
        $totalabsent=0;

        foreach($datelist as $date)
        {
            $presentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','1')->get()->count();
            $absentcount = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
                ->where('division',$request->division)->where('attendancedate',$date['attendancedate'])->where('ispresent','0')->get()->count();

            $totalpresent += $presentcount;
            $totalabsent += $absentcount;
        }
        $totalstudents = $totalpresent + $totalabsent;
        $averageattendance = round($totalpresent*100/$totalstudents,2);
        $averageabsence = round($totalabsent*100/$totalstudents,2);

        $otherdata['averageattendance'] = $averageattendance;
        $otherdata['averageabsence'] = $averageabsence;
        $otherdata['alldates'] = $alldates;

        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
            ->where('division',$request->division)->get();

        $downloadable = null;
        foreach($studentlist as $student)
        {
            $presentdays = 0;
            $absentdays = 0;
            foreach($alldates as $date)
            {
                $attendance = StudentAttendanceInfo::where('academicyear',Session::get('academicyear'))
                    ->where('classname',$request->classname)->where('division',$request->division)
                    ->where('attendancedate',$date)->where('studentid',$student->userid)->first();
                if($attendance)
                {
                    if($attendance->ispresent == 1)
                    {
                        $presentdays++;
                    }
                    else
                    {
                        $absentdays++;
                    }
                }
            }
            $downloadable[] = [
                'studentname' => $student->fname.' '.$student->mname.' '.$student->lname,
                'presentdays' => $presentdays,
                'absentdays' => $absentdays,
            ];
        }

        return Excel::create('monthly studies '.date('F-Y',$time), function($excel) use ($downloadable,$otherdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$otherdata)
            {
                $sheet->mergeCells("A1:M1")->setCellValue("A1",config('app.name'));
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A2:M2")->setCellValue("A2","STUDIES OF MONTH");
                $sheet->cells("A2", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'size' => 14,
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                for($i=4;$i<17;$i+=2)
                {
                    $j=$i+1;
                    $sheet->mergeCells("A{$i}:C{$j}")->cells("A{$i}", function ($cells) {
                        $cells->setFont(array(
                            'name' => 'Calibri',
                            'bold' => true
                        ));
                        $cells->setAlignment('center')->setValignment('center');
                    });
                    $sheet->mergeCells("D{$i}:H{$j}");
                    $sheet->mergeCells("I{$i}:M{$j}");
                }
                $sheet->setCellValue("A4","SUBJECT")->cells("A4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("D4","PORTION DONE")->cells("D4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("I4","PORTION IN ARREARS")->cells("I4", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A6","ENGLISH")->cells("A6", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A8","MARATHI")->cells("A8", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A10","GEOGRAPHY")->cells("A10", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A12","ECONOMICS")->cells("A12", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A14","SOCIOLOGY")->cells("A14", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A16","CO-OPERATION")->cells("A16", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("A19:G20")->setCellValue("A19","FEES DUE")->cells("A19", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("H19:M20")->setCellValue("H19","MONTH: {$otherdata['month']}-{$otherdata['year']}")->cells("H19", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("A22","Sr.No.")->cells("A22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("B22:F22")->setCellValue("B22","Name of Pupil")->cells("B22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("G22","ARREARS DUE")->cells("G22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("H22","FEES DUE")->cells("H22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("I22","TERM FEES DUE")->cells("I22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("J22","FINE")->cells("J22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("K22","TOTAL")->cells("K22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("L22","PRESENT DAYS")->cells("L22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->setCellValue("M22","REMARKS")->cells("M22", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });

                $row=24;
                for($i=0; $i<count($downloadable); $i++) {
                    $sheet->setCellValue("A{$row}",($i+1));
                    $sheet->mergeCells("B{$row}:F{$row}")->setCellValue("B{$row}",$downloadable[$i]['studentname']);
                    $sheet->setCellValue("L{$row}",$downloadable[$i]['presentdays']);

                    $row++;
                }
                $row++;
                $sheet->mergeCells("A{$row}:M{$row}")->setCellValue("A{$row}",'This is to certify that, I have verified the register and found entries in it are correct.')->cells("A{$row}", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Calibri',
                        'bold' => true
                    ));
                    $cells->setAlignment('center')->setValignment('center');
                });
                $row+=3;
                $sheet->mergeCells("A{$row}:G{$row}")->setCellValue("A{$row}","Principal")->cells("A{$row}", function ($cells) {
                    $cells->setAlignment('center')->setValignment('center');
                });
                $sheet->mergeCells("H{$row}:M{$row}")->setCellValue("H{$row}","Head of the college")->cells("H{$row}", function ($cells) {
                    $cells->setAlignment('center')->setValignment('center');
                });
            });
        })->download('xlsx');
    }

    public function examinationreport1to7()
    {
        return view(auth()->user()->role.'/examinationreport1to7')->with('classname','')->with('division','')
            ->with('semester','');
    }

    public function examinationreport1to7_post(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->get();
        $classdivision = ClassLists::where('classname',$request->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examinationreport1to7')->with('studentlist',$studentlist)
            ->with('classname',$request->classname)->with('division',$request->division)
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester);
    }

    public function examinationreport8to10()
    {
        return view(auth()->user()->role.'/examinationreport8to10')->with('classname','')->with('division','')
            ->with('semester','');
    }

    public function examinationreport8to10_post(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->get();
        $classdivision = ClassLists::where('classname',$request->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examinationreport8to10')->with('studentlist',$studentlist)
            ->with('classname',$request->classname)->with('division',$request->division)
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester);
    }

    public function examinationreport11to12()
    {
        return view(auth()->user()->role.'/examinationreport11to12')->with('classname','')->with('division','')
            ->with('semester','');
    }

    public function examinationreport11to12_post(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->get();
        $classdivision = ClassLists::where('classname',$request->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examinationreport11to12')->with('studentlist',$studentlist)
            ->with('classname',$request->classname)->with('division',$request->division)
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester);
    }

    public function circularreport()
    {
        $circulars = CircularDetails::where('academicyear',Session::get('academicyear'))->get();
        return view(auth()->user()->role.'/circularreport')->with('month','')->with('year','')->with('circulars',$circulars);
    }

    public function circularreport_post(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = CircularDetails::where('academicyear',Session::get('academicyear'))
            ->select('circulardate')->distinct()->orderBy('circulardate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->circulardate)
                {
                    $datelist[] = [
                        'circulardate' => $date1->circulardate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','circular not available')->with('month',$request->month)->with('year',$request->year);
        }

        foreach($datelist as $date)
        {
            $circulars = CircularDetails::where('circulardate',$date)->get();
            foreach ($circulars as $circular)
            {
                $circularlist[]=[
                    'circulardate' => $circular->circulardate,
                    'contenttitle' => $circular->contenttitle,
                    'contenttype' => $circular->contenttype,
                    'availablefor' => $circular->availablefor,
                    'description' => $circular->description,
                ];
            }
        }
        return view(auth()->user()->role.'/circularreport')->with('month',$request->month)->with('year',$request->year)->with('circularlist',$circularlist);
    }

    public function circularreportexcel(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = CircularDetails::where('academicyear',Session::get('academicyear'))
            ->select('circulardate')->distinct()->orderBy('circulardate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->circulardate)
                {
                    $datelist[] = [
                        'circulardate' => $date1->circulardate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','circular not available')->with('month',$request->month)->with('year',$request->year);
        }
        $srno=1;
        foreach($datelist as $date)
        {
            $circulars = CircularDetails::where('circulardate',$date)->get();
            foreach ($circulars as $circular)
            {
                $circularlist[]=[
                    'sr.no.' => $srno,
                    'circulardate' => $circular->circulardate,
                    'contenttitle' => $circular->contenttitle,
                    'contenttype' => $circular->contenttype,
                    'availablefor' => $circular->availablefor,
                    'description' => $circular->description,
                ];
                $srno++;
            }
        }

        $downloadable = $circularlist;

        return Excel::create('circular report', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:F1")->setCellValue("A1","Circular Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:F3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function inwardsreport()
    {
        $inwards = InwardsDetails::where('academicyear',Session::get('academicyear'))->get();
        return view(auth()->user()->role.'/inwardsreport')->with('month','')->with('year','')->with('inwards',$inwards);
    }

    public function inwardsreport_post(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = InwardsDetails::where('academicyear',Session::get('academicyear'))
            ->select('postaldate')->distinct()->orderBy('postaldate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->postaldate)
                {
                    $datelist[] = [
                        'postaldate' => $date1->postaldate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','inwards not available')->with('month',$request->month)->with('year',$request->year);
        }

        foreach($datelist as $date)
        {
            $inwards = InwardsDetails::where('postaldate',$date)->get();
            foreach ($inwards as $content)
            {
                $inwardslist[]=[
                    'fromtitle' => $content->fromtitle,
                    'referencenumber' => $content->referencenumber,
                    'fromaddress' => $content->fromaddress,
                    'totitle' => $content->totitle,
                    'postaldate' => $content->postaldate,
                ];
            }
        }

        return view(auth()->user()->role.'/inwardsreport')->with('month',$request->month)->with('year',$request->year)->with('inwardslist',$inwardslist);
    }

    public function inwardsreportexcel(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = InwardsDetails::where('academicyear',Session::get('academicyear'))
            ->select('postaldate')->distinct()->orderBy('postaldate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->postaldate)
                {
                    $datelist[] = [
                        'postaldate' => $date1->postaldate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','inwards not available')->with('month',$request->month)->with('year',$request->year);
        }

        $srno=1;
        foreach($datelist as $date)
        {
            $inwards = InwardsDetails::where('postaldate',$date)->get();
            foreach ($inwards as $content)
            {
                $inwardslist[]=[
                    'sr.no.' => $srno,
                    'fromtitle' => $content->fromtitle,
                    'referencenumber' => $content->referencenumber,
                    'fromaddress' => $content->fromaddress,
                    'totitle' => $content->totitle,
                    'postaldate' => $content->postaldate,
                ];
                $srno++;
            }
        }

        $downloadable = $inwardslist;

        return Excel::create('inwards report', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:F1")->setCellValue("A1","Inwards Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:F3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function outwardsreport()
    {
        $outwards = OutwardsDetails::where('academicyear',Session::get('academicyear'))->get();
        return view(auth()->user()->role.'/outwardsreport')->with('month','')->with('year','')->with('outwards',$outwards);
    }

    public function outwardsreport_post(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = OutwardsDetails::where('academicyear',Session::get('academicyear'))
            ->select('postaldate')->distinct()->orderBy('postaldate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->postaldate)
                {
                    $datelist[] = [
                        'postaldate' => $date1->postaldate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','outwards not available')->with('month',$request->month)->with('year',$request->year);
        }

        foreach($datelist as $date)
        {
            $outwards = OutwardsDetails::where('postaldate',$date)->get();
            foreach ($outwards as $content)
            {
                $outwardslist[]=[
                    'totitle' => $content->totitle,
                    'toaddress' => $content->toaddress,
                    'referencenumber' => $content->referencenumber,
                    'fromtitle' => $content->fromtitle,
                    'postaldate' => $content->postaldate,
                ];
            }
        }

        return view(auth()->user()->role.'/outwardsreport')->with('month',$request->month)->with('year',$request->year)->with('outwardslist',$outwardslist);
    }

    public function outwardsreportexcel(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = OutwardsDetails::where('academicyear',Session::get('academicyear'))
            ->select('postaldate')->distinct()->orderBy('postaldate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->postaldate)
                {
                    $datelist[] = [
                        'postaldate' => $date1->postaldate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','outwards not available')->with('month',$request->month)->with('year',$request->year);
        }

        $srno=1;
        foreach($datelist as $date)
        {
            $outwards = OutwardsDetails::where('postaldate',$date)->get();
            foreach ($outwards as $content)
            {
                $outwardslist[]=[
                    'sr.no.' => $srno,
                    'totitle' => $content->totitle,
                    'toaddress' => $content->toaddress,
                    'referencenumber' => $content->referencenumber,
                    'fromtitle' => $content->fromtitle,
                    'postaldate' => $content->postaldate,
                ];
                $srno++;
            }
        }

        $downloadable = $outwardslist;

        return Excel::create('outwards report', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:F1")->setCellValue("A1","Outwards Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:F3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function visitorsreport()
    {
        $visitors = VisitorBookDetails::where('academicyear',Session::get('academicyear'))->get();
        return view(auth()->user()->role.'/visitorsreport')->with('month','')->with('year','')->with('visitors',$visitors);
    }

    public function visitorsreport_post(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = VisitorBookDetails::where('academicyear',Session::get('academicyear'))
            ->select('visitdate')->distinct()->orderBy('visitdate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->visitdate)
                {
                    $datelist[] = [
                        'visitdate' => $date1->visitdate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','visitors not available')->with('month',$request->month)->with('year',$request->year);
        }

        foreach($datelist as $date)
        {
            $visitors = VisitorBookDetails::where('visitdate',$date)->get();
            foreach ($visitors as $content)
            {
                $visitorslist[]=[
                    'visitpurpose' => $content->visitpurpose,
                    'visitorname' => $content->visitorname,
                    'visitorphone' => $content->visitorphone,
                    'visitdate' => $content->visitdate,
                    'intime' => $content->intime,
                    'outtime' => $content->outtime,
                ];
            }
        }

        return view(auth()->user()->role.'/visitorsreport')->with('month',$request->month)->with('year',$request->year)->with('visitorslist',$visitorslist);
    }

    public function visitorsreportexcel(Request $request)
    {
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $request->month, $d, $request->year);
            if (date('m', $time) == $request->month) {
                $alldates[] = date('d-m-Y', $time);
            }
        }
        $startdate = $alldates[0];
        $enddate = $alldates[count($alldates)-1];

        $dates = VisitorBookDetails::where('academicyear',Session::get('academicyear'))
            ->select('visitdate')->distinct()->orderBy('visitdate','asc')
            ->get();
        $datelist = null;
        foreach($alldates as $date)
        {
            foreach($dates as $date1)
            {
                if($date == $date1->visitdate)
                {
                    $datelist[] = [
                        'visitdate' => $date1->visitdate,
                    ];
                }
            }
        }

        if(!$datelist)
        {
            return back()->with('success','visitors not available')->with('month',$request->month)->with('year',$request->year);
        }

        $srno=1;
        foreach($datelist as $date)
        {
            $visitors = VisitorBookDetails::where('visitdate',$date)->get();
            foreach ($visitors as $content)
            {
                $visitorslist[]=[
                    'sr.no.' => $srno,
                    'visitpurpose' => $content->visitpurpose,
                    'visitorname' => $content->visitorname,
                    'visitorphone' => $content->visitorphone,
                    'visitdate' => $content->visitdate,
                    'intime' => $content->intime,
                    'outtime' => $content->outtime,
                ];
                $srno++;
            }
        }

        $downloadable = $visitorslist;

        return Excel::create('visitors report', function($excel) use ($downloadable) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable)
            {
                $sheet->mergeCells("A1:G1")->setCellValue("A1","Visitors Report");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 20,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells("A3:G3", function ($cells) {
                    $cells->setFont(array(
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->fromArray($downloadable,null,'A3',false);
            });
        })->download('xlsx');
    }

    public function studentscholarshipreport()
    {
        return view(auth()->user()->role.'/studentscholarshipreport');
    }

    public function studentscholarshipreport_post(Request $request)
    {
        $studentlist = DB::table('scholarship_apply_details')
            ->join('scholarship_lists','scholarship_apply_details.scholarship','=','scholarship_lists.id')
            ->join('student_details','scholarship_apply_details.studentid','=','student_details.userid')
            ->select('scholarship_apply_details.scholarshipamount','scholarship_apply_details.noofmonths',
                'scholarship_lists.scholarshipname','student_details.fname','student_details.mname','student_details.lname',
                'student_details.classname','student_details.division','student_details.registerno','scholarship_apply_details.id as id',
                'student_details.gender')
            ->where('scholarship_apply_details.academicyear','=',$request->academicyear)
            ->where('scholarship_apply_details.scholarship','=',$request->scholarshipname);

        if($request->classname) {
            $studentlist = $studentlist->where('classname',$request->classname);
        }
        if($request->division) {
            $studentlist = $studentlist->where('division',$request->division);
        }
        if($request->faculty) {
            $studentlist = $studentlist->where('faculty',$request->faculty);
        }
        if($request->gender) {
            $studentlist = $studentlist->where('gender',$request->gender);
        }
        if($request->category) {
            $studentlist = $studentlist->where('category',$request->category);
        }
        $studentlist = $studentlist->get();

        return view(auth()->user()->role.'/studentscholarshipreport')->with('studentlist',$studentlist)->with('academicyear',$request->academicyear)
            ->with('scholarshipname',$request->scholarshipname)->with('classname',$request->classname)->with('division',$request->division)
            ->with('faculty',$request->faculty)->with('gender',$request->gender)->with('category',$request->category);
    }

    public function studentscholarshipreportexcel(Request $request)
    {
        $studentlist = DB::table('scholarship_apply_details')
            ->join('scholarship_lists','scholarship_apply_details.scholarship','=','scholarship_lists.id')
            ->join('student_details','scholarship_apply_details.studentid','=','student_details.userid')
            ->join('student_other_details','scholarship_apply_details.studentid','=','student_other_details.userid')
            ->select('scholarship_apply_details.scholarshipamount','scholarship_apply_details.noofmonths',
                'scholarship_lists.scholarshipname','student_details.fname','student_details.mname','student_details.lname',
                'student_details.classname','student_details.division','student_details.registerno','scholarship_apply_details.id as id',
                'student_details.gender','student_details.subcaste','student_details.aadhar','student_other_details.accounttitle',
                'student_other_details.accountno','student_other_details.bankifsccode','student_other_details.bankname',
                'student_other_details.bankbranchname','student_other_details.bankmicrcode')
            ->where('scholarship_apply_details.academicyear','=',$request->academicyear)
            ->where('scholarship_apply_details.scholarship','=',$request->scholarshipname);

        if($request->classname) {
            $studentlist = $studentlist->where('classname',$request->classname);
        }
        if($request->division) {
            $studentlist = $studentlist->where('division',$request->division);
        }
        if($request->faculty) {
            $studentlist = $studentlist->where('faculty',$request->faculty);
        }
        if($request->gender) {
            $studentlist = $studentlist->where('gender',$request->gender);
        }
        if($request->category) {
            $studentlist = $studentlist->where('category',$request->category);
        }
        $studentlist = $studentlist->get();

        foreach($studentlist as $student)
        {
            $castecategory = CasteCategoryList::where('id',$student->subcaste)->first();
            $religion = ReligionLists::where('id',$castecategory['religion'])->value('religion');
            $category = CategoryLists::where('id',$castecategory['category'])->value('category');
            $castename = $castecategory['castename'];
            $subcaste = $castecategory['subcaste'];

            $downloadable[] = [
                'registerno' => $student->registerno,'first name' => $student->fname,'father name' => $student->mname,
                'last name' => $student->lname,'castename' => $castename,'subcaste' => $subcaste,'aadhar' => $student->aadhar,
                'classname' => $student->classname,'Last year pass' => 'Pass','Attendance' => 'Regular',
                'Scholarship rate' => $student->scholarshipamount,'No. of months' => $student->noofmonths,
                'Total amount' => $student->scholarshipamount*$student->noofmonths,'AADHAR' => $student->aadhar,
                'bank name' => $student->bankname,'bank branch name' => $student->bankbranchname,'account no' => $student->accountno,
                'IFSC code' => $student->bankifsccode,
            ];
        }

        $applicablefor = ScholarshipLists::where('id',$request->scholarshipname)->value('applicablefor');
        $applicable = explode(',',$applicablefor);
        foreach ($applicable as $for)
        {
            $data[] = substr($for,2);
        }
        $applicablefor = implode(',',$data);

        $reportdata['scholarshipname'] = ScholarshipLists::where('id',$request->scholarshipname)->value('scholarshipname');
        $reportdata['applicablefor'] = $applicablefor;
        $reportdata['academicyear'] = $request->academicyear;

        return Excel::create('scholarship report', function($excel) use ($downloadable,$reportdata) {
            $excel->sheet('Sheet1', function($sheet) use ($downloadable,$reportdata)
            {
                $sheet->mergeCells("A1:R1")->setCellValue("A1","{$reportdata['scholarshipname']}");
                $sheet->cells("A1", function ($cells) {
                    $cells->setFont(array(
                        'name' => 'Times New Roman',
                        'size' => 16,
                        'bold' => true
                    ));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                $sheet->mergeCells("B2:C2")->setCellValue("B2","School name:");
                $sheet->mergeCells("B3:C3")->setCellValue("B3","School address:");
                $sheet->mergeCells("B4:C4")->setCellValue("B4","U dice code:");
                $sheet->mergeCells("B5:C5")->setCellValue("B5","Principal name:");
                $sheet->mergeCells("B6:C6")->setCellValue("B6","Principal mobile:");
                $sheet->mergeCells("D2:G2")->setCellValue("D2","Lokseva Vidyamandir and Jr. College");
                $sheet->mergeCells("D3:G3")->setCellValue("D3","Mandrup, Tq. S. Solapur, Dist. Solapur");
                $sheet->mergeCells("D4:G4")->setCellValue("D4","27301105412");
                $sheet->mergeCells("D5:G5")->setCellValue("D5","Mr. Tele Shridhar Vishwanath");
                $sheet->mergeCells("D6:G6")->setCellValue("D6","9420490054");

                $sheet->mergeCells("L3:M3")->setCellValue("L3","Applicable for");
                $sheet->mergeCells("L4:M4")->setCellValue("L4","Academic year");
                $sheet->mergeCells("N3:O3")->setCellValue("N3","{$reportdata['applicablefor']}");
                $sheet->mergeCells("N4:O4")->setCellValue("N4","{$reportdata['academicyear']}");

                $sheet->setCellValue("A8","Sr. No.");
                $sheet->setCellValue("B8","Register no.");
                $sheet->mergeCells("C8:E8")->setCellValue("C8","Student name");
                $sheet->setCellValue("F8","Caste/subcaste");
                $sheet->setCellValue("G8","Classname");
                $sheet->setCellValue("H8","Passed last year");
                $sheet->setCellValue("I8","Attendance");
                $sheet->setCellValue("C9","First name");
                $sheet->setCellValue("D9","Father name");
                $sheet->setCellValue("E9","Last name");
                $sheet->setCellValue("J8","Scholarship rate");
                $sheet->setCellValue("K8","Duration (months)");
                $sheet->setCellValue("L8","Total Amount");
                $sheet->setCellValue("M8","AADHAR no.");
                $sheet->mergeCells("N8:Q8")->setCellValue("N8","Bank account details");
                $sheet->setCellValue("N9","Bank name");
                $sheet->setCellValue("O9","Branch name");
                $sheet->setCellValue("P9","Account no.");
                $sheet->setCellValue("Q9","IFSC code");

                /*$sheet->fromArray($downloadable,null,'A11',true);*/
                $row=11;
                for($i=0; $i<count($downloadable); $i++) {
                    $sheet->setCellValue("A{$row}",($i+1));
                    $sheet->setCellValue("B{$row}",$downloadable[$i]['registerno']);
                    $sheet->setCellValue("C{$row}",$downloadable[$i]['first name']);
                    $sheet->setCellValue("D{$row}",$downloadable[$i]['father name']);
                    $sheet->setCellValue("E{$row}",$downloadable[$i]['last name']);
                    $sheet->setCellValue("F{$row}",$downloadable[$i]['castename']);
                    $sheet->setCellValue("G{$row}",$downloadable[$i]['classname']);
                    $sheet->setCellValue("H{$row}",$downloadable[$i]['Last year pass']);
                    $sheet->setCellValue("I{$row}",$downloadable[$i]['Attendance']);
                    $sheet->setCellValue("J{$row}",$downloadable[$i]['Scholarship rate']);
                    $sheet->setCellValue("K{$row}",$downloadable[$i]['No. of months']);
                    $sheet->setCellValue("L{$row}",$downloadable[$i]['Total amount']);
                    $sheet->setCellValue("M{$row}",$downloadable[$i]['AADHAR']);
                    $sheet->setCellValue("N{$row}",$downloadable[$i]['bank name']);
                    $sheet->setCellValue("O{$row}",$downloadable[$i]['bank branch name']);
                    $sheet->setCellValue("P{$row}",$downloadable[$i]['account no']);
                    $sheet->setCellValue("Q{$row}",$downloadable[$i]['IFSC code']);
                    $row++;
                }
                $row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","This is certified that,");$row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","1.");$row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","2.");$row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","3.");$row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","4.");$row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","5.");$row++;
                $sheet->mergeCells("B{$row}:Q{$row}")->setCellValue("B{$row}","6.");$row++;$row++;$row++;
                $sheet->mergeCells("M{$row}:P{$row}")->setCellValue("M{$row}","Principal,");$row++;
                $sheet->mergeCells("M{$row}:P{$row}")->setCellValue("M{$row}","Lokseva Vidyamandir and Jr. College, Mandrup");
            });
        })->download('xlsx');
    }
}

<?php

namespace App\Http\Controllers\Web\Admin;

use App\BonafideDetails;
use App\CasteCategoryList;
use App\ClassLists;
use App\Form17LcDetails;
use App\Helpers\AppHelper;
use App\LeavingCertificateDetails;
use App\StudentDetails;
use App\StudentOtherDetails;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class CertificatesController extends Controller
{
    public function bonafide()
    {
        $bonafidelist = DB::table('bonafide_details')
            ->join('student_details','bonafide_details.studentid','=','student_details.userid')
            ->where('bonafide_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->select('bonafide_details.id','student_details.registerno','student_details.fname','student_details.mname',
                'student_details.lname','student_details.classname','student_details.division',
                'bonafide_details.issuedate','bonafide_details.printcount')
            ->orderBy('bonafide_details.id','desc')->get();
        return view(auth()->user()->role.'/bonafide')->with('bonafidelist',$bonafidelist);
    }

    public function bonafide_issue(Request $request)
    {
        $data = $request->all();
        foreach($data['to'] as $studentid) {
            $lcdata['academicyear'] = Session::get('academicyear');
            $lcdata['studentid'] = $studentid;
            $lcdata['issuedate'] = date('d-m-Y');
            BonafideDetails::create($lcdata);
        }
        return back()->with('success','Bonafide issued successfully.');
    }

    public function bonafide_issue_print(Request $request)
    {
        echo 'issue - print';
        return $request;
    }

    public function bonafide_view($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $bonafide = DB::table('bonafide_details')
            ->join('student_details','bonafide_details.studentid','=','student_details.userid')
            ->join('student_other_details','bonafide_details.studentid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('bonafide_details.id',decrypt($id))
            ->select('student_details.registerno','student_details.saralid','student_details.fname','student_details.dob',
                'student_details.mname','student_details.lname','student_details.placeob','student_other_details.mothername',
                'student_details.mothertongue','student_details.classname','religion_lists.religion','caste_category_lists.castename',
                'caste_category_lists.subcaste','student_details.division','bonafide_details.issuedate','student_details.studentphoto',
                'bonafide_details.academicyear','student_details.faculty')
            ->first();

//        BonafideDetails::find(decrypt($id))->increment('printcount');

        $data['dob'] = Carbon::parse($bonafide->dob)->format('d-M-Y');

        $dob = $bonafide->dob;

        $newdob = Carbon::parse($dob)->format('d-M-Y');
        $dates = AppHelper::instance()->dates();
        $worddate = $dates[substr($dob,0,2)];

        if(substr($dob,6,4) < '2000')
        {
            $mainyear =  substr($dob,6,2);
            $subyear =  substr($dob,8,2);

            $dobinwords = $worddate.strtoupper(' '.Carbon::parse(substr($newdob,3,3))->format('F').' '.$format->format($mainyear).' '.$format->format($subyear));
        }
        else
        {
            $dobinwords = $worddate.strtoupper(' '.Carbon::parse(substr($newdob,3,3))->format('F').' '.$format->format(substr($newdob,7,4)));
        }

//        return $dobinwords;

        $data['dobinwords'] = $dobinwords;
        $data['bonafide'] = $bonafide;

        $pdf = PDF::loadView('prints/bonafide_view',$data)->setPaper('A4','portrait');
        return $pdf->stream('bonafide_gr_'.$bonafide->registerno.'.pdf');
    }

    public function bonafide_print($id)
    {
        echo 'print';
        return decrypt($id);
    }

    public function bonafide_delete($id)
    {
        BonafideDetails::where('id',decrypt($id))->delete();
        return back()->with('success','Bonafide deleted successfully.');
    }

    public function leavingcertificate()
    {
        $lclist = DB::table('leaving_certificate_details')
            ->join('student_details','leaving_certificate_details.studentid','=','student_details.userid')
            ->join('student_other_details','leaving_certificate_details.studentid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('leaving_certificate_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->select('leaving_certificate_details.id','student_details.registerno','student_details.saralid',
                'student_details.aadhar','student_details.fname','student_details.mname','student_details.lname','student_details.placeob',
                'student_other_details.mothername','student_details.mothertongue','religion_lists.religion','caste_category_lists.castename',
                'caste_category_lists.subcaste','student_details.dob','student_details.classname','student_details.division',
                'student_details.admission_date','student_details.faculty','student_details.lastschool','leaving_certificate_details.issuedate',
                'leaving_certificate_details.progress','leaving_certificate_details.conduct','leaving_certificate_details.remarks',
                'leaving_certificate_details.dateofleaving','leaving_certificate_details.reasonofleaving',
                'leaving_certificate_details.studyinginclass','leaving_certificate_details.printcount')
            ->orderBy('leaving_certificate_details.id','desc')->get();
        return view(auth()->user()->role.'/leavingcertificate')->with('lclist',$lclist);
    }

    public function leavingcertificate_issue(Request $request)
    {
        $data = $request->all();
        foreach($data['to'] as $studentid) {
            $lcdata['academicyear'] = Session::get('academicyear');
            $lcdata['studentid'] = $studentid;
            $lcdata['progress'] = $request->progress;
            $lcdata['conduct'] = $request->conduct;
            $lcdata['dateofleaving'] = $request->dateofleaving;
            $lcdata['reasonofleaving'] = $request->reasonofleaving;
            $lcdata['remarks'] = $request->remarks;
            $lcdata['studyinginclass'] = $request->studyinginclass;
            $lcdata['issuedate'] = date('d-m-Y');
            LeavingCertificateDetails::create($lcdata);

            $accessdata['hasaccess'] = '0';
            User::where('userid',$studentid)->update($accessdata);
            StudentDetails::where('userid',$studentid)->update($accessdata);
        }
        return back()->with('success','Leaving certificate issued successfully.');
    }

    public function leavingcertificate_issue_print(Request $request)
    {
        $data = $request->all();
        foreach($data['to'] as $studentid) {
            $lcdata['academicyear'] = Session::get('academicyear');
            $lcdata['studentid'] = $studentid;
            $lcdata['progress'] = $request->progress;
            $lcdata['conduct'] = $request->conduct;
            $lcdata['dateofleaving'] = $request->dateofleaving;
            $lcdata['reasonofleaving'] = $request->reasonofleaving;
            $lcdata['remarks'] = $request->remarks;
            $lcdata['studyinginclass'] = $request->studyinginclass;
            $lcdata['issuedate'] = date('d-m-Y');
            $lcdata['printcount'] = '1';
            LeavingCertificateDetails::create($lcdata);

            $accessdata['hasaccess'] = '0';
            User::where('userid',$studentid)->update($accessdata);
            StudentDetails::where('userid',$studentid)->update($accessdata);

            $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            $dob = StudentDetails::where('userid',$studentid)->value('dob');
            $newdob = Carbon::parse($dob)->format('d-M-Y');

            $dates = AppHelper::instance()->dates();
            $worddate = $dates[substr($dob,0,2)];

            if(substr($dob,6,4) < '2000')
            {
                $mainyear =  substr($dob,6,2);
                $subyear =  substr($dob,8,2);

                $dobinwords = $worddate.strtoupper(' '.Carbon::parse(substr($newdob,3,3))->format('F').' '.$format->format($mainyear).' '.$format->format($subyear));
            }
            else
            {
                $dobinwords = $worddate.strtoupper(' '.Carbon::parse(substr($newdob,3,3))->format('F').' '.$format->format(substr($newdob,7,4)));
            }

            $arr[] = [
                'studentid' => $studentid,
                'dobinwords' => $dobinwords,
            ];
        }
        return view('prints/leavingcertificate')->with('data',$arr);
    }

    public function leavingcertificate_view($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $lc = DB::table('leaving_certificate_details')
            ->join('student_details','leaving_certificate_details.studentid','=','student_details.userid')
            ->join('student_other_details','leaving_certificate_details.studentid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('leaving_certificate_details.id',decrypt($id))
            ->select('leaving_certificate_details.studentid as userid','leaving_certificate_details.id','student_details.registerno','student_details.saralid',
                'student_details.aadhar','student_details.fname','student_details.mname','student_details.lname','student_details.placeob',
                'student_other_details.mothername','student_details.mothertongue','religion_lists.religion','caste_category_lists.castename',
                'caste_category_lists.subcaste','student_details.dob','student_details.classname','student_details.division',
                'student_details.admission_date','student_details.faculty','student_details.lastschool','leaving_certificate_details.issuedate','student_details.schoolname',
                'leaving_certificate_details.progress','leaving_certificate_details.conduct','leaving_certificate_details.remarks',
                'leaving_certificate_details.dateofleaving','leaving_certificate_details.reasonofleaving',
                'leaving_certificate_details.studyinginclass','leaving_certificate_details.printcount')
            ->first();

        $data['dob'] = Carbon::parse($lc->dob)->format('d-M-Y');

        $dates = AppHelper::instance()->dates();
        $worddate = $dates[substr($data['dob'],0,2)];

        if(substr($lc->dob,6,4) < '2000')
        {
            $mainyear =  substr($lc->dob,6,2);
            $subyear =  substr($lc->dob,8,2);
            $data['dobinwords'] = $worddate.strtoupper($format->format(' '.Carbon::parse(substr($data['dob'],3,3))->format('F').' '.$format->format($mainyear).' '.$format->format($subyear)));
        }
        else
        {
            $data['dobinwords'] = $worddate.strtoupper(' '.Carbon::parse(substr($data['dob'],3,3))->format('F').' '.$format->format(substr($data['dob'],7,4)));
        }

        $data['dob'] = Carbon::parse($lc->dob)->format('d-m-Y');
        $data['lc'] = $lc;

        $pdf = PDF::loadView('prints/leavingcertificate_view',$data)->setPaper('A4','portrait');
        return $pdf->stream('lc_gr_'.$lc->registerno.'.pdf');
    }

    public function leavingcertificate_edit($id)
    {
        $lc = DB::table('leaving_certificate_details')
            ->join('student_details','leaving_certificate_details.studentid','=','student_details.userid')
            ->join('student_other_details','leaving_certificate_details.studentid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('leaving_certificate_details.id',decrypt($id))
            ->select('leaving_certificate_details.studentid as userid','student_details.registerno','student_details.saralid',
                'student_details.aadhar','student_details.fname','student_details.mname','student_details.lname','student_details.placeob',
                'student_other_details.mothername','student_details.mothertongue','student_details.religion','student_details.castename',
                'student_details.subcaste','student_details.dob','student_details.classname','student_details.division',
                'student_details.admission_date','student_details.lastschool','leaving_certificate_details.issuedate','student_details.schoolname',
                'leaving_certificate_details.progress','leaving_certificate_details.conduct','leaving_certificate_details.remarks',
                'leaving_certificate_details.dateofleaving','leaving_certificate_details.reasonofleaving',
                'leaving_certificate_details.studyinginclass','leaving_certificate_details.printcount')
            ->first();

        $classdivision = ClassLists::where('classname',$lc->classname)->first();
        $divisionlist = explode(',',$classdivision->division);
        $castelist = CasteCategoryList::where('religion',$lc->religion)->select('castename')->distinct()->get();
        $subcastelist = CasteCategoryList::where('religion',$lc->religion)->where('castename',$lc->castename)->orderBy('subcaste','asc')->get();

        return view(auth()->user()->role.'/leavingcertificate_edit')->with('lc',$lc)->with('divisionlist',$divisionlist)
            ->with('castelist',$castelist)->with('subcastelist',$subcastelist);
    }

    public function leavingcertificate_editlc(Request $request)
    {
        $student['saralid'] = $request->saralid;
        $student['aadhar'] = $request->aadhar;
        $student['fname'] = $request->fname;
        $student['mname'] = $request->mname;
        $student['lname'] = $request->lname;
        $student['mothertongue'] = $request->mothertongue;
        $student['religion'] = $request->religion;
        $student['castename'] = $request->castename;
        $student['subcaste'] = $request->subcaste;
        $student['placeob'] = $request->placeob;
        $student['dob'] = $request->dob;
        $student['schoolname'] = $request->schoolname;
        $student['lastschool'] = $request->lastschool;
        $student['admission_date'] = $request->admission_date;
        StudentDetails::where('userid',$request->userid)->update($student);

        $otherdetails['mothername'] = $request->mothername;
        StudentOtherDetails::where('userid',$request->userid)->update($otherdetails);

        $lc['progress'] = $request->progress;
        $lc['conduct'] = $request->conduct;
        $lc['dateofleaving'] = $request->dateofleaving;
        $lc['reasonofleaving'] = $request->reasonofleaving;
        $lc['remarks'] = $request->remarks;
        $lc['studyinginclass'] = $request->studyinginclass;
        LeavingCertificateDetails::where('studentid',$request->userid)->update($lc);

        return Redirect::route('leavingcertificate')->with('success','Leaving certificate edited');
    }

    public function leavingcertificate_delete($id)
    {
        $studentid = LeavingCertificateDetails::where('id',decrypt($id))->value('studentid');
        LeavingCertificateDetails::where('id',decrypt($id))->delete();

        $accessdata['hasaccess'] = '1';
        User::where('userid',$studentid)->update($accessdata);
        StudentDetails::where('userid',$studentid)->update($accessdata);

        return Redirect::route('leavingcertificate')->with('success','Leaving certificate deleted');
    }

    public function leavingcertificate_print($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $studentid = LeavingCertificateDetails::where('id',decrypt($id))->value('studentid');
        LeavingCertificateDetails::find(decrypt($id))->increment('printcount');
        $dob = StudentDetails::where('userid',$studentid)->value('dob');
        $newdob = Carbon::parse($dob)->format('d-M-Y');

        $dates = AppHelper::instance()->dates();
        $worddate = $dates[substr($dob,0,2)];

        if(substr($dob,6,4) < '2000')
        {
            $mainyear =  substr($dob,6,2);
            $subyear =  substr($dob,8,2);

            $dobinwords = $worddate.strtoupper(' '.Carbon::parse(substr($newdob,3,3))->format('F').' '.$format->format($mainyear).' '.$format->format($subyear));
        }
        else
        {
            $dobinwords = $worddate.strtoupper(' '.Carbon::parse(substr($newdob,3,3))->format('F').' '.$format->format(substr($newdob,7,4)));
        }

        $arr[] = [
            'studentid' => $studentid,
            'dobinwords' => $dobinwords,
        ];

        return view('prints/leavingcertificate')->with('data',$arr);
    }

    public function form17lc()
    {
        $lclist = DB::table('form17_lc_details')
            ->join('student_details','form17_lc_details.studentid','=','student_details.userid')
            ->join('student_other_details','form17_lc_details.studentid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('form17_lc_details.academicyear',Session::get('academicyear'))
            ->select('form17_lc_details.id','student_details.registerno','student_details.saralid','student_details.aadhar',
                'student_details.fname','student_details.mname','student_details.lname','student_details.placeob','student_details.dob',
                'student_other_details.mothername','student_details.mothertongue','religion_lists.religion','caste_category_lists.castename',
                'caste_category_lists.subcaste','student_details.classname','student_details.admission_date','student_details.registerfor',
                'student_details.schoolname','student_details.lastschool','form17_lc_details.issuedate','form17_lc_details.printcount','form17_lc_details.examseatno')
            ->orderBy('form17_lc_details.id','desc')->get();

        if(Session::get('registerfor') == 'School Form 17')
        {
            $studentlist = StudentDetails::where('registerfor','School Form 17')
                ->where('academicyear',Session::get('academicyear'))->where('hasaccess','1')->get();

            $girlscount = StudentDetails::where('academicyear',Session::get('academicyear'))
                ->where('classname','10')->where('registerfor','School Form 17')
                ->where('gender','Female')->get()->count();
            $boyscount = StudentDetails::where('academicyear',Session::get('academicyear'))
                ->where('classname','10')->where('registerfor','School Form 17')
                ->where('gender','Male')->get()->count();

            return view(auth()->user()->role.'/form17lc')->with('studentlist',$studentlist)->with('lclist',$lclist)
                ->with('girlscount',$girlscount)->with('boyscount',$boyscount)->with('totalcount',($boyscount+$girlscount));
        }
        $studentlist = [];
        return view(auth()->user()->role.'/form17lc')->with('studentlist',$studentlist)->with('lclist',$lclist)
            ->with('girlscount','0')->with('boyscount','0')->with('totalcount','0');
    }

    public function form17lc_issue(Request $request)
    {
        $lcdata['academicyear'] = Session::get('academicyear');
        $lcdata['issuedate'] = date('d-m-Y');
        $lcdata['studentid'] = $request->studentid;
        $lcdata['dateofpassing'] = $request->dateofpassing;
        $lcdata['examseatno'] = $request->examseatno;

        Form17LcDetails::create($lcdata);

        $accessdata['hasaccess'] = '0';
        User::where('userid',$request->studentid)->update($accessdata);
        StudentDetails::where('userid',$request->studentid)->update($accessdata);

        return back()->with('success','Leaving certificate issued successfully.');
    }

    public function form17lc_issue_print(Request $request)
    {
        $lcdata['academicyear'] = Session::get('academicyear');
        $lcdata['issuedate'] = date('d-m-Y');
        $lcdata['studentid'] = $request->studentid;
        $lcdata['dateofpassing'] = $request->dateofpassing;
        $lcdata['examseatno'] = $request->examseatno;

        Form17LcDetails::create($lcdata);

        $accessdata['hasaccess'] = '0';
        User::where('userid',$request->studentid)->update($accessdata);
        StudentDetails::where('userid',$request->studentid)->update($accessdata);

        Form17LcDetails::find($request->studentid)->increment('printcount');
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $dob = StudentDetails::where('userid',$request->studentid)->value('dob');
        $dob = Carbon::parse($dob)->format('d-M-Y');
        $dobinwords = strtoupper($format->format(substr($dob,0,2)).' '.Carbon::parse(substr($dob,3,3))->format('F').' '.$format->format(substr($dob,7,4)));
        $arr[] = [
            'studentid' => $request->studentid,
            'dobinwords' => $dobinwords,
        ];
        return view('prints/form17lc')->with('data',$arr);
    }

    public function form17lc_view($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $lc = DB::table('form17_lc_details')
            ->join('student_details','form17_lc_details.studentid','=','student_details.userid')
            ->join('student_other_details','form17_lc_details.studentid','=','student_other_details.userid')
            ->join('caste_category_lists','student_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('form17_lc_details.id',decrypt($id))
            ->select('form17_lc_details.id','student_details.registerno','student_details.saralid','student_details.aadhar',
                'student_details.fname','student_details.mname','student_details.lname','student_details.placeob','student_details.dob',
                'student_other_details.mothername','student_details.mothertongue','religion_lists.religion','caste_category_lists.castename',
                'caste_category_lists.subcaste','student_details.classname','student_details.admission_date','student_details.registerfor',
                'student_details.schoolname','student_details.lastschool','form17_lc_details.issuedate','form17_lc_details.printcount',
                'form17_lc_details.examseatno','form17_lc_details.dateofpassing','student_details.previousgrno','student_details.previouslcno')
            ->first();

        $dob = Carbon::parse($lc->dob)->format('d-M-Y');
        $data['dobinwords'] = strtoupper($format->format(substr($dob,0,2)).' '.Carbon::parse(substr($dob,3,3))->format('F').' '.$format->format(substr($dob,7,4)));
        $data['lc'] = $lc;

        $pdf = PDF::loadView('prints/form17lc_view',$data)->setPaper('A4','portrait');
        return $pdf->stream('lc_gr_'.$lc->registerno.'.pdf');
    }

    public function form17lc_edit($id)
    {
        $lc = DB::table('form17_lc_details')
            ->join('student_details','form17_lc_details.studentid','=','student_details.userid')
            ->join('student_other_details','form17_lc_details.studentid','=','student_other_details.userid')
            ->where('form17_lc_details.id',decrypt($id))
            ->first();

        $classdivision = ClassLists::where('classname',$lc->classname)->first();
        $divisionlist = explode(',',$classdivision->division);
        $castelist = CasteCategoryList::where('religion',$lc->religion)->select('castename')->distinct()->get();
        $subcastelist = CasteCategoryList::where('religion',$lc->religion)->where('castename',$lc->castename)->orderBy('subcaste','asc')->get();

        return view(auth()->user()->role.'/form17lc_edit')->with('lc',$lc)->with('divisionlist',$divisionlist)
            ->with('castelist',$castelist)->with('subcastelist',$subcastelist);
    }

    public function form17lc_editlc(Request $request)
    {
        $student['saralid'] = $request->saralid;
        $student['aadhar'] = $request->aadhar;
        $student['fname'] = $request->fname;
        $student['mname'] = $request->mname;
        $student['lname'] = $request->lname;
        $student['mothertongue'] = $request->mothertongue;
        $student['religion'] = $request->religion;
        $student['castename'] = $request->castename;
        $student['subcaste'] = $request->subcaste;
        $student['placeob'] = $request->placeob;
        $student['dob'] = $request->dob;
        $student['schoolname'] = $request->schoolname;
        $student['lastschool'] = $request->lastschool;
        $student['admission_date'] = $request->admission_date;
        StudentDetails::where('userid',$request->userid)->update($student);

        $otherdetails['mothername'] = $request->mothername;
        StudentOtherDetails::where('userid',$request->userid)->update($otherdetails);

        $lc['dateofpassing'] = $request->dateofpassing;
        $lc['examseatno'] = $request->examseatno;
        Form17LcDetails::where('studentid',$request->userid)->update($lc);

        return Redirect::route('form17lc')->with('success','Leaving certificate edited');
    }

    public function form17lc_delete($id)
    {
        $studentid = Form17LcDetails::where('id',decrypt($id))->value('studentid');
        Form17LcDetails::where('id',decrypt($id))->delete();

        $accessdata['hasaccess'] = '1';
        User::where('userid',$studentid)->update($accessdata);
        StudentDetails::where('userid',$studentid)->update($accessdata);

        return Redirect::route('form17lc')->with('success','Leaving certificate deleted');
    }

    public function form17lc_print($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $studentid = Form17LcDetails::where('id',decrypt($id))->value('studentid');
        Form17LcDetails::find(decrypt($id))->increment('printcount');
        $dob = StudentDetails::where('userid',$studentid)->value('dob');
        $dob = Carbon::parse($dob)->format('d-M-Y');
        $dobinwords = strtoupper($format->format(substr($dob,0,2)).' '.Carbon::parse(substr($dob,3,3))->format('F').' '.$format->format(substr($dob,7,4)));
        $arr[] = [
            'studentid' => $studentid,
            'dobinwords' => $dobinwords,
        ];

        return view('prints/form17lc')->with('data',$arr);
    }

}

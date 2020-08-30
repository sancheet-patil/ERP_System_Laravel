<?php

namespace App\Http\Controllers\Web\Admin;

use App\ClassLists;
use App\ClassSubjectDetails;
use App\ExamEvaluationDetails;
use App\ExamList;
use App\ExamScheduleList;
use App\Http\Controllers\Controller;
use App\SchoolExamination;
use App\StudentDetails;
use App\StudentEducationalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ExaminationController extends Controller
{
    public function examination()
    {
        return view(auth()->user()->role.'/examination')->with('classname','')->with('division','')
            ->with('semester','')->with('faculty','');
    }

    public function examination_post(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)->where('hasaccess','1');
        if($request->faculty)
        {
            $studentlist = $studentlist->where('faculty',$request->faculty)->get();
        }
        else
        {
            $studentlist = $studentlist->get();
        }
        $classdivision = ClassLists::where('classname',$request->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examination')->with('studentlist',$studentlist)
            ->with('classname',$request->classname)->with('division',$request->division)
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester)->with('faculty',$request->faculty);
    }

    public function examinationmark(Request $request)
    {
        $student = StudentDetails::where('userid',$request->studentid)->first();
        $subjectlist = DB::table('class_subject_details')
            ->join('subject_lists','class_subject_details.subjectname','=','subject_lists.id')
            ->select('class_subject_details.classname','class_subject_details.division','subject_lists.subjectname',
                'class_subject_details.outofmarks','class_subject_details.subjectname as subjectid')
            ->where('class_subject_details.academicyear',Session::get('academicyear'))
            ->where('class_subject_details.classname',$student->classname)
            ->where('class_subject_details.division',$student->division)->get();

        return view(auth()->user()->role.'/examinationmark')->with('studentid',$request->studentid)
            ->with('semester',$request->semester)->with('subjectlist',$subjectlist);
    }

    public function examinationmark_submit(Request $request)
    {
        SchoolExamination::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname[0])->where('division',$request->division[0])
            ->where('semester',$request->semester[0])->where('studentid',$request->studentid[0])->delete();

        for($num=0; $num < count($request->studentid); $num++) {
            $data['academicyear'] = Session::get('academicyear');
            $data['classname'] = $request->classname[$num];
            $data['division'] = $request->division[$num];
            $data['semester'] = $request->semester[$num];
            $data['studentid'] = $request->studentid[$num];
            $data['subjectname'] = $request->subjectname[$num];
            $data['marks'] = $request->obtainedmarks[$num];
            SchoolExamination::create($data);
        }

        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname[0])->where('division',$request->division[0])->get();
        $classdivision = ClassLists::where('classname',$request->classname[0])->first();
        $divisionlist = explode(',',$classdivision->division);

        return view(auth()->user()->role.'/examination')->with('studentlist',$studentlist)
            ->with('classname',$request->classname[0])->with('division',$request->division[0])
            ->with('divisionlist',$divisionlist)->with('semester',$request->semester[0])->with('success','Mark assigned to student');
    }

    public function promotestudents()
    {
        return view(auth()->user()->role.'/promotestudents');
    }

    public function promotestudents_add(Request $request)
    {
        foreach($request->to as $userid)
        {
            $academicyear = (substr(Session::get('academicyear'), 0, 4) + 1) . '-' . (substr(Session::get('academicyear'), 5, 4) + 1);
            if(strlen(strlen($request->classtopromote) == 1)) {
                $classname = '0'.$request->classtopromote;
            }
            else{
                $classname = $request->classtopromote;
            }
            $updateData = [
                'academicyear' => $academicyear,
                'classname' => $classname,
            ];
            StudentDetails::where('userid',$userid)->update($updateData);

            StudentEducationalDetails::updateOrCreate(
                ['userid' => $userid, 'academicyear' => $academicyear],
                ['classname' => $classname]
            );
        }
        return back()->with('success','Students promoted successfully');
    }

    public function demotestudents()
    {
        return view(auth()->user()->role.'/demotestudents');
    }

    public function demotestudents_add(Request $request)
    {
        foreach($request->to as $userid)
        {
            $academicyear = (substr(Session::get('academicyear'), 0, 4) - 1) . '-' . (substr(Session::get('academicyear'), 5, 4) - 1);
            if(strlen(strlen($request->classtopromote) == 1)) {
                $classname = '0'.$request->classtopromote;
            }
            else{
                $classname = $request->classtopromote;
            }
            $updateData = [
                'academicyear' => $academicyear,
                'classname' => $classname,
            ];
            StudentDetails::where('userid',$userid)->update($updateData);

            StudentEducationalDetails::updateOrCreate(
                ['userid' => $userid, 'academicyear' => $academicyear],
                ['classname' => $classname]
            );
        }
        return back()->with('success','Students demoted successfully');
    }

    public function exam()
    {
        $examlist = ExamScheduleList::orderBy('classname','asc')->get();
        return view(auth()->user()->role.'/exam')->with('examlist',$examlist)->with('classname','')
            ->with('examtype','')->with('faculty','');
    }

    public function exam_post(Request $request)
    {
        $examlist = ExamScheduleList::where('classname',$request->classname)->where('examtype',$request->examtype)
            ->where('faculty',$request->faculty)->get();
        return view(auth()->user()->role.'/exam')->with('examlist',$examlist)->with('classname',$request->classname)
            ->with('examtype',$request->examtype)->with('faculty',$request->faculty);
    }

    public function addexam()
    {
        return view(auth()->user()->role.'/addexam')->with('examtype','')->with('classname','')->with('faculty','');
    }

    public function addexam_post(Request $request)
    {
        $subjectlist = DB::table('class_subject_details')
            ->join('subject_lists','class_subject_details.subjectname','=','subject_lists.id')
            ->where('class_subject_details.classname',$request->classname)
            ->select('subject_lists.subjectname')->distinct('subject_lists.subjectname')
            ->orderBy('subject_lists.subjectname','asc')->get();
        return view(auth()->user()->role.'/addexam')->with('examtype',$request->examtype)->with('classname',$request->classname)
            ->with('faculty',$request->faculty)->with('subjectlist',$subjectlist);
    }

    public function exam_create(Request $request)
    {
        $subjectscount = sizeof($request->examtype);

        ExamScheduleList::where('examtype',$request->examtype[0])->where('classname',$request->classname[0])
            ->where('faculty',$request->faculty[0])->delete();

        for($i=0;$i<$subjectscount;$i++)
        {
            $inputdata[] = [
                'examtype'=> $request->examtype[$i],
                'classname'=> $request->classname[$i],
                'faculty'=> $request->faculty[$i],
                'subjectname'=> $request->subjectname[$i],
                'passingmarks'=> $request->passingmarks[$i],
                'outofmarks'=> $request->outofmarks[$i],
            ];
        }
        ExamScheduleList::insert($inputdata);

        return Redirect::route('exam');
    }

    public function exam_evaluation(Request $request)
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
            ->where('division',$request->division)->where('hasaccess','1');
        $exam = ExamScheduleList::where('examtype',$request->examtype)->where('classname',$request->classname)
            ->where('faculty',$request->faculty)->first();
        if($request->faculty)
        {
            $studentlist = $studentlist->where('faculty',$request->faculty);
        }
        $studentlist = $studentlist->get();

        return view(auth()->user()->role.'/examevaluation')->with('studentlist',$studentlist)->with('exam',$exam)
            ->with('data',$request);
    }

    public function examevaluation_submit(Request $request)
    {
        $studentscount = sizeof($request->studentid);

        ExamEvaluationDetails::where('academicyear',Session::get('academicyear'))->where('examtype',$request->examtype[0])
            ->where('classname',$request->classname[0])->where('division',$request->division[0])
            ->where('faculty',$request->faculty[0])->where('subjectname',$request->subjectname[0])
            ->delete();

        for($i=0;$i<$studentscount;$i++)
        {
            $inputdata[] = [
                'academicyear'=> Session::get('academicyear'),
                'studentid'=> $request->studentid[$i],
                'classname'=> $request->classname[$i],
                'division'=> $request->division[$i],
                'faculty'=> $request->faculty[$i],
                'examtype'=> $request->examtype[$i],
                'subjectname'=> $request->subjectname[$i],
                'passingmarks'=> $request->passingmarks[$i],
                'outofmarks'=> $request->outofmarks[$i],
                'obtainedmarks'=> $request->obtainedmarks[$i],
            ];
        }
        ExamEvaluationDetails::insert($inputdata);
        return Redirect::route('exam');
    }
}

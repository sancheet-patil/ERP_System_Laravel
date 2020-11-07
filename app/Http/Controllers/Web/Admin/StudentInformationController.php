<?php

namespace App\Http\Controllers\Web\Admin;

use App\BonafideDetails;
use App\CasteCategoryList;
use App\ClassLists;
use App\Form17LcDetails;
use App\LeavingCertificateDetails;
use App\OtherSchoolLists;
use App\ScholarshipApplyDetails;
use App\StudentDetails;
use App\StudentEducationalDetails;
use App\StudentOtherDetails;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StudentInformationController extends Controller
{
    public function student_admission()
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',Session::get('registerfor'))
            ->orderBy('student_details.id','desc')->paginate(10);
//        return $studentlist;
        return view(auth()->user()->role.'/student_admission')->with('studentlist',$studentlist);
    }

    public function student_admission_add(Request $request)
    {
        $userid = date('ymdhis');

        $studentDetails['userid']=$userid;
        $studentDetails['academicyear'] = $request->academicyear;
        $studentDetails['admission_year'] = $request->academicyear;
        $studentDetails['registerfor']=$request->registerfor;
        $studentDetails['faculty']=$request->faculty;
        $studentDetails['classname']=$request->classname;
        if($request->division)
        {
            $studentDetails['division']=$request->division;
        }
        else
        {
            $studentDetails['division']='NA';
        }
        $studentDetails['registerno']=$request->registerno;
        $studentDetails['admission_date']=$request->admission_date;
        $studentDetails['admission_class']=$request->classname;
        $studentDetails['saralid']=$request->saralid;
        $studentDetails['roll_no']=$request->roll_no;
        $studentDetails['fname']=$request->fname;
        $studentDetails['mname']=$request->mname;
        $studentDetails['lname']=$request->lname;
        $studentDetails['gender']=$request->gender;
        $studentDetails['dob']=$request->dob;
        $studentDetails['religion']=$request->religion;
        $studentDetails['category']= CasteCategoryList::where('id',$request->subcaste)->value('category');
        $studentDetails['castename']=$request->castename;
        $studentDetails['subcaste']=$request->subcaste;
        $studentDetails['mobile']=$request->mobile;
        $studentDetails['email']=$request->email;
        $studentDetails['aadhar']=$request->aadhar;
        $studentDetails['placeob']=$request->placeob;
        $studentDetails['mothertongue']=$request->mothertongue;
        $studentDetails['bloodgroup']=$request->bloodgroup;
        $studentDetails['pwd']=$request->pwd;
        $studentDetails['familyincome']=$request->familyincome;
        $studentDetails['bpl']=$request->bpl;
        $studentDetails['isminor']=$request->isminor;
        if($request->schoolname == 'Other')
        {
            $school['schoolname'] = $request->lastschool;
            $school = OtherSchoolLists::create($school);
            $studentDetails['schoolname'] = $school->id;
        }
        else{
            $studentDetails['schoolname'] = $request->schoolname;
        }
        $studentDetails['lastschool']=$request->lastschool;
        $studentDetails['lastclass']=$request->lastclass;
        $studentDetails['admissiontype']=$request->admissiontype;
        $studentDetails['lateadmission']=$request->lateadmission;
        $studentDetails['hostelrequired']=$request->hostelrequired;
        $studentDetails['citytype']=$request->citytype;
        $studentDetails['previouslcno']=$request->previouslcno;
        $studentDetails['previousgrno']=$request->previousgrno;
        $studentDetails['currentaddress']=$request->currentaddress;
        $studentDetails['permanentaddress']=$request->permanentaddress;
        $studentDetails['status']='Admitted';

        if($request->file('studentphoto')) {
            $file = $request->file('studentphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name;
            $studentDetails['studentphoto'] = $filepath;
        }
        else
        {
            $studentDetails['studentphoto'] = null;
        }
        StudentDetails::create($studentDetails);

        $studentOtherDetails['userid']=$userid;
        $studentOtherDetails['fathername']=$request->fathername;
        $studentOtherDetails['fatherphone']=$request->fatherphone;
        $studentOtherDetails['fatheroccupation']=$request->fatheroccupation;
        $studentOtherDetails['mothername']=$request->mothername;
        $studentOtherDetails['motherphone']=$request->motherphone;
        $studentOtherDetails['motheroccupation']=$request->motheroccupation;
        $studentOtherDetails['guardianname']=$request->guardianname;
        $studentOtherDetails['guardianphone']=$request->guardianphone;
        $studentOtherDetails['guardianrelation']=$request->guardianrelation;
        $studentOtherDetails['guardianoccupation']=$request->guardianoccupation;
        $studentOtherDetails['guardianaddress']=$request->guardianaddress;
        $studentOtherDetails['accounttitle'] = $request->accounttitle;
        $studentOtherDetails['accountno'] = $request->accountno;
        $studentOtherDetails['bankifsccode'] = $request->bankifsccode;
        $studentOtherDetails['bankname'] = $request->bankname;
        $studentOtherDetails['bankbranchname'] = $request->bankbranchname;
        $studentOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/studentdata/'.$userid.'/'.$new_name1;
            $studentOtherDetails['document1file']=$document1filepath;
        }
        else
        {
            $studentOtherDetails['document1file']=null;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name2;
            $studentOtherDetails['document2file'] = $document2filepath;
        }
        else
        {
            $studentOtherDetails['document2file']=null;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name3;
            $studentOtherDetails['document3file'] = $document3filepath;
        }
        else
        {
            $studentOtherDetails['document3file']=null;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name4;
            $studentOtherDetails['document4file'] = $document4filepath;
        }
        else
        {
            $studentOtherDetails['document4file']=null;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name5;
            $studentOtherDetails['document5file'] = $document5filepath;
        }
        else
        {
            $studentOtherDetails['document5file']=null;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name6;
            $studentOtherDetails['document6file'] = $document6filepath;
        }
        else
        {
            $studentOtherDetails['document6file']=null;
        }

        $studentOtherDetails['document1name']=$request->document1;
        $studentOtherDetails['document2name']=$request->document2;
        $studentOtherDetails['document3name']=$request->document3;
        $studentOtherDetails['document4name']=$request->document4;
        $studentOtherDetails['document5name']=$request->document5;
        $studentOtherDetails['document6name']=$request->document6;

        StudentOtherDetails::create($studentOtherDetails);

        StudentEducationalDetails::updateOrCreate(
            ['userid' => $userid, 'academicyear' => $request->academicyear],
            ['classname' => $request->classname]
        );

        $userDetails['userid'] = $userid;
        $userDetails['name'] = $request->fname;
        $userDetails['aadhar'] = $request->aadhar;
        $userDetails['password'] = bcrypt('1234');
        $userDetails['role'] = 'student';
        $userDetails['hasaccess'] = '1';
        User::create($userDetails);

        return Redirect::route('student.admission')->with('success','Student Added Successfully');
    }

    public function student_view($id)
    {
        $userid = decrypt($id);

        $studentdetails = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->where('student_details.userid',$userid)
            ->first();

        $educationaldetails = StudentEducationalDetails::where('userid',$userid)->get();

        return view(auth()->user()->role.'/student_view')->with('studentdetails',$studentdetails)
            ->with('educationaldetails',$educationaldetails);
    }

    public function student_admission_form($id)
    {
        $studentid = decrypt($id);

        /*$arr[] = [
            'studentid' => $studentid,
        ];*/

        return view('prints/student_admission_form')->with('studentid',$studentid);
    }

    public function student_editadmission($id)
    {
        $userid = decrypt($id);

        $studentdetails = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->where('student_details.userid',$userid)
            ->first();

        $classdivision = ClassLists::where('classname',$studentdetails->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        $castecategory = \App\CasteCategoryList::where('id',$studentdetails->subcaste)->first();
        if($castecategory){
            $castelist = CasteCategoryList::where('religion',$castecategory->religion)->select('castename')->distinct()->get();
            $subcastelist = CasteCategoryList::where('religion',$castecategory->religion)->where('castename',$castecategory->castename)->orderBy('subcaste','asc')->get();
            $studentdetails->religion = $castecategory->religion;
            $studentdetails->category = $castecategory->category;
            $studentdetails->castename = $castecategory->castename;
            $studentdetails->subcaste = $castecategory->id;
        }
        else{
            $castelist = [];
            $subcastelist = [];
            $studentdetails->religion = '';
            $studentdetails->category = '';
            $studentdetails->castename = '';
            $studentdetails->subcaste = '';
        }

        return view(auth()->user()->role.'/student_editadmission')->with('studentdetails',$studentdetails)
            ->with('divisionlist',$divisionlist)->with('castelist',$castelist)->with('subcastelist',$subcastelist);
    }

    public function student_editadmission_edit(Request $request)
    {
        $userid = $request->userid;

        $studentDetails['admission_year'] = $request->admission_year;
        $studentDetails['registerfor']=$request->registerfor;
        $studentDetails['faculty']=$request->faculty;
        $studentDetails['admission_class']=$request->admission_class;
        $studentDetails['division']=$request->division;
        $studentDetails['registerno']=$request->registerno;
        $studentDetails['admission_date']=$request->admission_date;
        $studentDetails['saralid']=$request->saralid;
        $studentDetails['roll_no']=$request->roll_no;
        $studentDetails['fname']=$request->fname;
        $studentDetails['mname']=$request->mname;
        $studentDetails['lname']=$request->lname;
        $studentDetails['gender']=$request->gender;
        $studentDetails['dob']=$request->dob;
        $studentDetails['religion']=$request->religion;
        $studentDetails['category']= CasteCategoryList::where('id',$request->subcaste)->value('category');
        $studentDetails['castename']=$request->castename;
        $studentDetails['subcaste']=$request->subcaste;
        $studentDetails['mobile']=$request->mobile;
        $studentDetails['email']=$request->email;
        $studentDetails['aadhar']=$request->aadhar;
        $studentDetails['placeob']=$request->placeob;
        $studentDetails['mothertongue']=$request->mothertongue;
        $studentDetails['bloodgroup']=$request->bloodgroup;
        $studentDetails['pwd']=$request->pwd;
        $studentDetails['familyincome']=$request->familyincome;
        $studentDetails['bpl']=$request->bpl;
        $studentDetails['isminor']=$request->isminor;
        $studentDetails['schoolname']=$request->schoolname;
        $studentDetails['lastschool']=$request->lastschool;
        $studentDetails['lastclass']=$request->lastclass;
        $studentDetails['admissiontype']=$request->admissiontype;
        $studentDetails['lateadmission']=$request->lateadmission;
        $studentDetails['hostelrequired']=$request->hostelrequired;
        $studentDetails['citytype']=$request->citytype;
        $studentDetails['previouslcno']=$request->previouslcno;
        $studentDetails['previousgrno']=$request->previousgrno;
        $studentDetails['currentaddress']=$request->currentaddress;
        $studentDetails['permanentaddress']=$request->permanentaddress;

        if($request->file('studentphoto')) {
            $file = $request->file('studentphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name;
            $studentDetails['studentphoto'] = $filepath;
        }
        StudentDetails::where('userid',$request->userid)->update($studentDetails);

        $studentOtherDetails['fathername']=$request->fathername;
        $studentOtherDetails['fatherphone']=$request->fatherphone;
        $studentOtherDetails['fatheroccupation']=$request->fatheroccupation;
        $studentOtherDetails['mothername']=$request->mothername;
        $studentOtherDetails['motherphone']=$request->motherphone;
        $studentOtherDetails['motheroccupation']=$request->motheroccupation;
        $studentOtherDetails['guardianname']=$request->guardianname;
        $studentOtherDetails['guardianphone']=$request->guardianphone;
        $studentOtherDetails['guardianrelation']=$request->guardianrelation;
        $studentOtherDetails['guardianoccupation']=$request->guardianoccupation;
        $studentOtherDetails['guardianaddress']=$request->guardianaddress;
        $studentOtherDetails['accounttitle'] = $request->accounttitle;
        $studentOtherDetails['accountno'] = $request->accountno;
        $studentOtherDetails['bankifsccode'] = $request->bankifsccode;
        $studentOtherDetails['bankname'] = $request->bankname;
        $studentOtherDetails['bankbranchname'] = $request->bankbranchname;
        $studentOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/studentdata/'.$userid.'/'.$new_name1;
            $studentOtherDetails['document1file']=$document1filepath;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name2;
            $studentOtherDetails['document2file'] = $document2filepath;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name3;
            $studentOtherDetails['document3file'] = $document3filepath;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name4;
            $studentOtherDetails['document4file'] = $document4filepath;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name5;
            $studentOtherDetails['document5file'] = $document5filepath;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name6;
            $studentOtherDetails['document6file'] = $document6filepath;
        }

        $studentOtherDetails['document1name']=$request->document1;
        $studentOtherDetails['document2name']=$request->document2;
        $studentOtherDetails['document3name']=$request->document3;
        $studentOtherDetails['document4name']=$request->document4;
        $studentOtherDetails['document5name']= CasteCategoryList::where('subcaste',$request->subcaste)->value('category');
        $studentOtherDetails['document6name']=$request->document6;

        StudentOtherDetails::where('userid',$request->userid)->update($studentOtherDetails);

        $userDetails['name'] = $request->fname;
        $userDetails['aadhar'] = $request->aadhar;
        User::where('userid',$request->userid)->update($userDetails);

        return Redirect::route('student.admission')->with('success','Student edited successfully');
    }

    public function student_delete($id)
    {
        $userid = decrypt($id);
        StudentDetails::where('userid',$userid)->delete();
        StudentOtherDetails::where('userid',$userid)->delete();
        User::where('userid',$userid)->delete();
        LeavingCertificateDetails::where('studentid',$userid)->delete();
        Form17LcDetails::where('studentid',$userid)->delete();
        BonafideDetails::where('studentid',$userid)->delete();
        StudentEducationalDetails::where('userid',$userid)->delete();

        return Redirect::route('student.search')->with('success','Student deleted successfully');
    }

    public function student_search()
    {
        $studentlist = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->where('student_details.academicyear',Session::get('academicyear'))
            ->where('student_details.registerfor',strtoupper(Session::get('registerfor')))
            ->orderBy('student_details.id','desc')->get();
        return view(auth()->user()->role.'/student_search')->with('studentlist',$studentlist);
    }

    public function student_editsearch($id)
    {
        $userid = decrypt($id);

        $studentdetails = DB::table('student_details')
            ->join('student_other_details','student_details.userid','=','student_other_details.userid')
            ->where('student_details.userid',$userid)
            ->first();
        $classdivision = ClassLists::where('classname',$studentdetails->classname)->first();
        $divisionlist = explode(',',$classdivision->division);

        $castecategory = \App\CasteCategoryList::where('id',$studentdetails->subcaste)->first();
        if($castecategory){
            $castelist = CasteCategoryList::where('religion',$castecategory->religion)->select('castename')->distinct()->get();
            $subcastelist = CasteCategoryList::where('religion',$castecategory->religion)->where('castename',$castecategory->castename)->orderBy('subcaste','asc')->get();
            $studentdetails->religion = $castecategory->religion;
            $studentdetails->category = $castecategory->category;
            $studentdetails->castename = $castecategory->castename;
            $studentdetails->subcaste = $castecategory->id;
        }
        else{
            $castelist = [];
            $subcastelist = [];
            $studentdetails->religion = '';
            $studentdetails->category = '';
            $studentdetails->castename = '';
            $studentdetails->subcaste = '';
        }

        return view(auth()->user()->role.'/student_editsearch')->with('studentdetails',$studentdetails)
            ->with('divisionlist',$divisionlist)->with('castelist',$castelist)->with('subcastelist',$subcastelist);
    }

    public function student_editsearch_edit(Request $request)
    {
        $userid = $request->userid;

        $studentDetails['admission_year'] = $request->admission_year;
        $studentDetails['registerfor']=$request->registerfor;
        $studentDetails['faculty']=$request->faculty;
        $studentDetails['admission_class']=$request->admission_class;
        $studentDetails['division']=$request->division;
        $studentDetails['registerno']=$request->registerno;
        $studentDetails['admission_date']=$request->admission_date;
        $studentDetails['saralid']=$request->saralid;
        $studentDetails['roll_no']=$request->roll_no;
        $studentDetails['fname']=$request->fname;
        $studentDetails['mname']=$request->mname;
        $studentDetails['lname']=$request->lname;
        $studentDetails['gender']=$request->gender;
        $studentDetails['dob']=$request->dob;
        $studentDetails['religion']=$request->religion;
        $studentDetails['category']= CasteCategoryList::where('id',$request->subcaste)->value('category');
        $studentDetails['castename']=$request->castename;
        $studentDetails['subcaste']=$request->subcaste;
        $studentDetails['mobile']=$request->mobile;
        $studentDetails['email']=$request->email;
        $studentDetails['aadhar']=$request->aadhar;
        $studentDetails['placeob']=$request->placeob;
        $studentDetails['mothertongue']=$request->mothertongue;
        $studentDetails['bloodgroup']=$request->bloodgroup;
        $studentDetails['pwd']=$request->pwd;
        $studentDetails['familyincome']=$request->familyincome;
        $studentDetails['bpl']=$request->bpl;
        $studentDetails['isminor']=$request->isminor;
        $studentDetails['schoolname']=$request->schoolname;
        $studentDetails['lastschool']=$request->lastschool;
        $studentDetails['lastclass']=$request->lastclass;
        $studentDetails['admissiontype']=$request->admissiontype;
        $studentDetails['lateadmission']=$request->lateadmission;
        $studentDetails['hostelrequired']=$request->hostelrequired;
        $studentDetails['citytype']=$request->citytype;
        $studentDetails['previouslcno']=$request->previouslcno;
        $studentDetails['previousgrno']=$request->previousgrno;
        $studentDetails['currentaddress']=$request->currentaddress;
        $studentDetails['permanentaddress']=$request->permanentaddress;

        if($request->file('studentphoto')) {
            $file = $request->file('studentphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name;
            $studentDetails['studentphoto'] = $filepath;
        }
        StudentDetails::where('userid',$request->userid)->update($studentDetails);

        $studentOtherDetails['fathername']=$request->fathername;
        $studentOtherDetails['fatherphone']=$request->fatherphone;
        $studentOtherDetails['fatheroccupation']=$request->fatheroccupation;
        $studentOtherDetails['mothername']=$request->mothername;
        $studentOtherDetails['motherphone']=$request->motherphone;
        $studentOtherDetails['motheroccupation']=$request->motheroccupation;
        $studentOtherDetails['guardianname']=$request->guardianname;
        $studentOtherDetails['guardianphone']=$request->guardianphone;
        $studentOtherDetails['guardianrelation']=$request->guardianrelation;
        $studentOtherDetails['guardianoccupation']=$request->guardianoccupation;
        $studentOtherDetails['guardianaddress']=$request->guardianaddress;
        $studentOtherDetails['accounttitle'] = $request->accounttitle;
        $studentOtherDetails['accountno'] = $request->accountno;
        $studentOtherDetails['bankifsccode'] = $request->bankifsccode;
        $studentOtherDetails['bankname'] = $request->bankname;
        $studentOtherDetails['bankbranchname'] = $request->bankbranchname;
        $studentOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/studentdata/'.$userid.'/'.$new_name1;
            $studentOtherDetails['document1file']=$document1filepath;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name2;
            $studentOtherDetails['document2file'] = $document2filepath;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name3;
            $studentOtherDetails['document3file'] = $document3filepath;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name4;
            $studentOtherDetails['document4file'] = $document4filepath;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name5;
            $studentOtherDetails['document5file'] = $document5filepath;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name6;
            $studentOtherDetails['document6file'] = $document6filepath;
        }

        $studentOtherDetails['document1name']=$request->document1;
        $studentOtherDetails['document2name']=$request->document2;
        $studentOtherDetails['document3name']=$request->document3;
        $studentOtherDetails['document4name']=$request->document4;
        $studentOtherDetails['document5name']= CasteCategoryList::where('subcaste',$request->subcaste)->value('category');
        $studentOtherDetails['document6name']=$request->document6;

        StudentOtherDetails::where('userid',$request->userid)->update($studentOtherDetails);

        $userDetails['name'] = $request->fname;
        $userDetails['aadhar'] = $request->aadhar;
        User::where('userid',$request->userid)->update($userDetails);

        return Redirect::route('student.search')->with('success','Student edited successfully');
    }

    public function bulkdivisionassign()
    {
        return view(auth()->user()->role.'/bulkdivisionassign');
    }

    public function bulkdivisionassign_add(Request $request)
    {
        if(is_array($request->to)==0){
            return back()->with('success','Students not selected');
        }
        foreach($request->to as $studentid)
        {
            $updateData = [
                'division' => $request->division,
            ];
            StudentDetails::where('userid',$studentid)->update($updateData);
        }

        return back()->with('success','Students assigned to division successfully');
    }

    public function studentidgenerate()
    {
        $studentlist = StudentDetails::where('academicyear',Session::get('academicyear'))
            ->where('registerfor',Session::get('registerfor'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/studentidgenerate')->with('studentlist',$studentlist);
    }

    public function student_idgenerate($id)
    {
        $arr[] = [
            'student' => decrypt($id),
        ];
        return Redirect::route('studentid.bulk.print')->withCookie('details',serialize($arr));
    }

    public function studentidgenerate_bulk()
    {
        return view(auth()->user()->role.'/studentidgenerate_bulk');
    }

    public function studentidgenerate_bulk_post(Request $request)
    {
        if($request->to == '[]'){
            return back()->with('success','No students selected');
        }
        foreach($request->to as $student)
        {
            $arr[] = [
                'student' => $student,
            ];
        }
        return Redirect::route('studentid.bulk.print')->withCookie('details',serialize($arr));
    }

    public function studentid_bulk_print(Request $request)
    {
        $data = unserialize($request->cookie('details'));
        return view('prints/studentid')->with('data',$data);
    }

    public function studentscholarshipapply()
    {
        $studentscholarshiplist = DB::table('scholarship_apply_details')
            ->join('scholarship_lists','scholarship_apply_details.scholarship','=','scholarship_lists.id')
            ->join('student_details','scholarship_apply_details.studentid','=','student_details.userid')
            ->select('scholarship_apply_details.scholarshipamount','scholarship_apply_details.noofmonths',
                'scholarship_lists.scholarshipname','student_details.fname','student_details.mname','student_details.lname',
                'student_details.classname','student_details.division','student_details.registerno','scholarship_apply_details.id as id')
            ->where('scholarship_apply_details.academicyear',Session::get('academicyear'))
            ->get();
        return view(auth()->user()->role.'/studentscholarshipapply')->with('studentscholarshiplist',$studentscholarshiplist);
    }

    public function studentscholarshipapply_post(Request $request)
    {
        ScholarshipApplyDetails::where('academicyear',Session::get('academicyear'))->where('scholarship',$request->scholarship)
            ->where('scholarshipclass',$request->scholarshipclass)->where('scholarshipdivision',$request->scholarshipdivision)
            ->where('scholarshipfaculty',$request->scholarshipfaculty)->delete();
        $data = $request->all();
        foreach($data['to'] as $studentid) {
            $input['academicyear'] = Session::get('academicyear');
            $input['studentid'] = $studentid;
            $input['scholarship'] = $request->scholarship;
            $input['scholarshipclass'] = $request->scholarshipclass;
            $input['scholarshipdivision'] = $request->scholarshipdivision;
            $input['scholarshipfaculty'] = $request->scholarshipfaculty;
            $input['scholarshipamount'] = $request->scholarshipamount;
            $input['noofmonths'] = $request->noofmonths;

            ScholarshipApplyDetails::create($input);

        }
        return back()->with('success','Scholarship applied successfully');
    }

    public function deletescholarshipstudent($id)
    {
        $id = decrypt($id);
        ScholarshipApplyDetails::where('id',$id)->delete();
        return back()->with('success','Student scholarship removed');
    }

    public function studentrejoin()
    {
        return view(auth()->user()->role.'/studentrejoin');
    }

    public function studentrejoin_add(Request $request)
    {
        $userid = date('ymdhis');

        $studentDetails['userid']=$userid;
        $studentDetails['academicyear'] = $request->academicyear;
        $studentDetails['admission_year'] = $request->academicyear;
        $studentDetails['registerfor']=$request->registerfor;
        $studentDetails['faculty']=$request->faculty;
        $studentDetails['classname']=$request->classname;
        if($request->division)
        {
            $studentDetails['division']=$request->division;
        }
        else
        {
            $studentDetails['division']='NA';
        }
        $studentDetails['registerno']=$request->registerno;
        $studentDetails['admission_date']=$request->admission_date;
        $studentDetails['admission_class']=$request->classname;
        $studentDetails['saralid']=$request->saralid;
        $studentDetails['roll_no']=$request->roll_no;
        $studentDetails['fname']=$request->fname;
        $studentDetails['mname']=$request->mname;
        $studentDetails['lname']=$request->lname;
        $studentDetails['gender']=$request->gender;
        $studentDetails['dob']=$request->dob;
        $studentDetails['religion']=$request->religion;
        $studentDetails['category']=$request->category;
        $studentDetails['castename']=$request->castename;
        $studentDetails['subcaste']=$request->subcaste;
        $studentDetails['mobile']=$request->mobile;
        $studentDetails['email']=$request->email;
        $studentDetails['aadhar']=$request->aadhar;
        $studentDetails['placeob']=$request->placeob;
        $studentDetails['mothertongue']=$request->mothertongue;
        $studentDetails['bloodgroup']=$request->bloodgroup;
        $studentDetails['pwd']=$request->pwd;
        $studentDetails['familyincome']=$request->familyincome;
        $studentDetails['bpl']=$request->bpl;
        $studentDetails['isminor']=$request->isminor;
        if($request->schoolname == 'Other')
        {
            $school['schoolname'] = $request->lastschool;
            $school = OtherSchoolLists::create($school);
            $studentDetails['schoolname'] = $school->id;
        }
        else{
            $studentDetails['schoolname'] = $request->schoolname;
        }
        $studentDetails['lastschool']=$request->lastschool;
        $studentDetails['lastclass']=$request->lastclass;
        $studentDetails['admissiontype']=$request->admissiontype;
        $studentDetails['lateadmission']=$request->lateadmission;
        $studentDetails['hostelrequired']=$request->hostelrequired;
        $studentDetails['citytype']=$request->citytype;
        $studentDetails['previouslcno']=$request->previouslcno;
        $studentDetails['previousgrno']=$request->previousgrno;
        $studentDetails['currentaddress']=$request->currentaddress;
        $studentDetails['permanentaddress']=$request->permanentaddress;
        $studentDetails['status']='Admitted';

        if($request->file('studentphoto')) {
            $file = $request->file('studentphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name;
            $studentDetails['studentphoto'] = $filepath;
        }
        else
        {
            $studentDetails['studentphoto'] = null;
        }
        StudentDetails::create($studentDetails);

        $studentOtherDetails['userid']=$userid;
        $studentOtherDetails['fathername']=$request->fathername;
        $studentOtherDetails['fatherphone']=$request->fatherphone;
        $studentOtherDetails['fatheroccupation']=$request->fatheroccupation;
        $studentOtherDetails['mothername']=$request->mothername;
        $studentOtherDetails['motherphone']=$request->motherphone;
        $studentOtherDetails['motheroccupation']=$request->motheroccupation;
        $studentOtherDetails['guardianname']=$request->guardianname;
        $studentOtherDetails['guardianphone']=$request->guardianphone;
        $studentOtherDetails['guardianrelation']=$request->guardianrelation;
        $studentOtherDetails['guardianoccupation']=$request->guardianoccupation;
        $studentOtherDetails['guardianaddress']=$request->guardianaddress;
        $studentOtherDetails['accounttitle'] = $request->accounttitle;
        $studentOtherDetails['accountno'] = $request->accountno;
        $studentOtherDetails['bankifsccode'] = $request->bankifsccode;
        $studentOtherDetails['bankname'] = $request->bankname;
        $studentOtherDetails['bankbranchname'] = $request->bankbranchname;
        $studentOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/studentdata/'.$userid.'/'.$new_name1;
            $studentOtherDetails['document1file']=$document1filepath;
        }
        else
        {
            $studentOtherDetails['document1file']=null;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name2;
            $studentOtherDetails['document2file'] = $document2filepath;
        }
        else
        {
            $studentOtherDetails['document2file']=null;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name3;
            $studentOtherDetails['document3file'] = $document3filepath;
        }
        else
        {
            $studentOtherDetails['document3file']=null;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name4;
            $studentOtherDetails['document4file'] = $document4filepath;
        }
        else
        {
            $studentOtherDetails['document4file']=null;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name5;
            $studentOtherDetails['document5file'] = $document5filepath;
        }
        else
        {
            $studentOtherDetails['document5file']=null;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/studentdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/studentdata/' . $userid . '/' . $new_name6;
            $studentOtherDetails['document6file'] = $document6filepath;
        }
        else
        {
            $studentOtherDetails['document6file']=null;
        }

        $studentOtherDetails['document1name']=$request->document1;
        $studentOtherDetails['document2name']=$request->document2;
        $studentOtherDetails['document3name']=$request->document3;
        $studentOtherDetails['document4name']=$request->document4;
        $studentOtherDetails['document5name']=$request->document5;
        $studentOtherDetails['document6name']=$request->document6;

        StudentOtherDetails::create($studentOtherDetails);

        StudentEducationalDetails::updateOrCreate(
            ['userid' => $userid, 'academicyear' => $request->academicyear],
            ['classname' => $request->classname]
        );

        User::where('aadhar',$request->aadhar)->update(['userid'=>$userid,'hasaccess'=>'1']);

        return Redirect::route('student.admission')->with('success','Student Added Successfully');
    }
}

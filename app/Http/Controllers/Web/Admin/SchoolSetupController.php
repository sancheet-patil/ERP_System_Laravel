<?php

namespace App\Http\Controllers\Web\Admin;

use App\AcademicYearList;
use App\CasteCategoryList;
use App\CategoryLists;
use App\ClassLists;
use App\ClassSubjectDetails;
use App\ClassTeacherDetails;
use App\ClassTimeTableDetails;
use App\DesignationLists;
use App\DivisionLists;
use App\EventsLists;
use App\ExaminerDetails;
use App\HolidayLists;
use App\OtherSchoolLists;
use App\ReligionLists;
use App\ScholarshipLists;
use App\SchoolInfos;
use App\StaffDetails;
use App\SubjectLists;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SchoolSetupController extends Controller
{
    public function schoolinfo()
    {
        $school = SchoolInfos::where('id','1')->first();
        return view(auth()->user()->role.'/schoolinfo')->with('school',$school);
    }

    public function schoolinfo_update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        SchoolInfos::where('id','1')->update($data);
        return back()->with('success','Info updated successfully');
    }

    public function setmaxlc()
    {
        $school = SchoolInfos::where('id','1')->first();
        return view(auth()->user()->role.'/maxlcprints')->with('school',$school);
    }

    public function setmaxlc_update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        SchoolInfos::where('id','1')->update($data);
        return back()->with('success','Info updated successfully');
    }

    public function academicyear()
    {
        $yearlist = AcademicYearList::orderBy('academicyear','desc')->get();
        return view(auth()->user()->role.'/academicyear')->with('yearlist',$yearlist);
    }

    public function academicyear_add(Request $request)
    {
        if(AcademicYearList::where('academicyear',$request->academicyear)->exists())
        {
            return back()->with('success','Academic year exists already');
        }
        AcademicYearList::create($request->all());
        return back()->with('success','Academic year added');
    }

    public function academicyear_delete($id)
    {
        AcademicYearList::where('id',decrypt($id))->delete();
        return back()->with('success','Academic year deleted');
    }

    public function religion()
    {
        $religions = ReligionLists::orderBy('religion','asc')->get();
        return view(auth()->user()->role.'/religion')->with('religions',$religions);
    }

    public function religion_add(Request $request)
    {
        if(ReligionLists::where('religion',$request->religion)->exists())
        {
            return back()->with('success','Religion exists already');
        }
        ReligionLists::create($request->all());
        return back()->with('success','Religion added');
    }

    public function religion_edit($id)
    {
        $religions = ReligionLists::orderBy('religion','asc')->get();
        $religion = ReligionLists::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/religion_edit')->with('religions',$religions)->with('religion',$religion);
    }

    public function religion_editreligion(Request $request)
    {
        $updateData = [
            'religion' => $request->religion,
        ];
        ReligionLists::where('id','=',$request->id)->update($updateData);

        return Redirect::route('religion')->with('success','religion edited successfully');
    }

    public function religion_delete($id)
    {
        ReligionLists::where('id',decrypt($id))->delete();
        return back()->with('success','Religion deleted');
    }

    public function category()
    {
        $categories = CategoryLists::orderBy('category','asc')->get();
        return view(auth()->user()->role.'/category')->with('categories',$categories);
    }

    public function category_add(Request $request)
    {
        if(CategoryLists::where('category',$request->category)->exists())
        {
            return back()->with('success','Category exists already');
        }
        CategoryLists::create($request->all());
        return back()->with('success','Category added');
    }

    public function category_edit($id)
    {
        $categories = CategoryLists::orderBy('category','asc')->get();
        $category = CategoryLists::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/category_edit')->with('categories',$categories)->with('category',$category);
    }

    public function category_editcategory(Request $request)
    {
        $updateData = [
            'category' => $request->category,
        ];
        CategoryLists::where('id','=',$request->id)->update($updateData);

        return Redirect::route('category')->with('success','category edited successfully');
    }

    public function category_delete($id)
    {
        CategoryLists::where('id',decrypt($id))->delete();
        return back()->with('success','Category deleted');
    }

    public function castecategories()
    {
        $religions = ReligionLists::orderBy('religion','asc')->get();
        $categories = CategoryLists::orderBy('category','asc')->get();
        $castecategories = DB::table('caste_category_lists')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->select('caste_category_lists.id','caste_category_lists.castename','caste_category_lists.subcaste',
                'religion_lists.religion','category_lists.category')
            ->orderBy('caste_category_lists.id','asc')->get();
        return view(auth()->user()->role.'/castecategories')->with('religions',$religions)->with('categories',$categories)->with('castecategories',$castecategories);
    }

    public function castecategory_add(Request $request)
    {
        if(CasteCategoryList::where('religion',$request->religion)->where('category',$request->category)
            ->where('castename',$request->castename)->where('subcaste',$request->subcaste)->exists())
        {
            return back()->with('success','Caste exists already');
        }
        CasteCategoryList::create($request->all());
        return back()->with('success','Caste category added');
    }

    public function castecategory_edit($id)
    {
        $religions = ReligionLists::orderBy('religion','asc')->get();
        $categories = CategoryLists::orderBy('category','asc')->get();
        $castecategories = DB::table('caste_category_lists')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->select('caste_category_lists.id','caste_category_lists.castename','caste_category_lists.subcaste',
                'religion_lists.religion','category_lists.category')
            ->orderBy('caste_category_lists.id','asc')->get();
        $castecategory = DB::table('caste_category_lists')
//            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
//            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('caste_category_lists.id','=',decrypt($id))->first();

        return view(auth()->user()->role.'/castecategories_edit')->with('religions',$religions)->with('categories',$categories)
            ->with('castecategories',$castecategories)->with('castecategory',$castecategory);
    }

    public function castecategory_editcastecategory(Request $request)
    {
        $updateData = [
            'religion' => $request->religion,
            'category' => $request->category,
            'castename' => $request->castename,
            'subcaste' => $request->subcaste,
        ];
        CasteCategoryList::where('id','=',$request->id)->update($updateData);

        return Redirect::route('castecategories')->with('success','caste category edited successfully');
    }

    public function castecategory_delete($id)
    {
        CasteCategoryList::where('id',decrypt($id))->delete();
        return back()->with('success','Caste category deleted');
    }

    public function designation()
    {
        $designations = DesignationLists::orderBy('designation','asc')->get();
        return view(auth()->user()->role.'/designation')->with('designations',$designations);
    }

    public function designation_add(Request $request)
    {
        if(DesignationLists::where('designation',$request->designation)->exists())
        {
            return back()->with('success','Designation exists already');
        }
        DesignationLists::create($request->all());
        return back()->with('success','Designation added');
    }

    public function designation_edit($id)
    {
        $designations = DesignationLists::orderBy('designation','asc')->get();
        $designation = DesignationLists::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/designation_edit')->with('designations',$designations)->with('designation',$designation);
    }

    public function designation_editdesignation(Request $request)
    {
        $updateData = [
            'designation' => $request->designation,
        ];
        DesignationLists::where('id','=',$request->id)->update($updateData);

        return Redirect::route('designation')->with('success','designation edited successfully');
    }

    public function designation_delete($id)
    {
        DesignationLists::where('id',decrypt($id))->delete();
        return back()->with('success','Designation deleted');
    }

    public function division()
    {
        $divisionlist = DivisionLists::orderBy('id','asc')->get();
        return view(auth()->user()->role.'/division')->with('divisionlist',$divisionlist);
    }

    public function division_add(Request $request)
    {
        $division = DivisionLists::where('division',$request->division)->first();
        if($division)
        {
            return back()->with('success','Division already present');
        }
        $data['division'] = $request->division;
        DivisionLists::create($data);

        return back()->with('success','Division added successfully');
    }

    public function division_edit($id)
    {
        $divisionlist = DivisionLists::orderBy('id','asc')->get();
        $division = DivisionLists::where('id','=',decrypt($id))->first();
        return view(auth()->user()->role.'/division_edit')->with('divisionlist',$divisionlist)->with('division',$division);
    }

    public function division_editdivision(Request $request)
    {
        $updateData = [
            'division' => $request->division,
        ];
        DivisionLists::where('id','=',$request->id)->update($updateData);

        return Redirect::route('division')->with('success','division edited successfully');
    }

    public function division_delete($id)
    {
        DivisionLists::where('id','=',decrypt($id))->delete();

        return back()->with('success','division deleted successfully');
    }

    public function classes()
    {
        $classlist = ClassLists::orderBy('classname','asc')->get();
        $divisionlist = DivisionLists::orderBy('division','asc')->get();
        return view(auth()->user()->role.'/classes')->with('classlist',$classlist)->with('divisionlist',$divisionlist);
    }

    public function classes_add(Request $request)
    {
        $class = ClassLists::where('classname',$request->classname)->first();
        if($class)
        {
            return back()->with('success','Class already present');
        }
        /*if($request->classname < 10){
            $data['classname'] = '0'.$request->classname;
        }
        else{
            $data['classname'] = $request->classname;
        }*/
        $data['classname'] = $request->classname;
        $data['division'] = implode(',',$request->division);

        ClassLists::create($data);

        return back()->with('success','Class added successfully');
    }

    public function classes_edit($id)
    {
        $classlist = ClassLists::orderBy('classname','asc')->get();
        $divisionlist = DivisionLists::orderBy('division','asc')->get();
        $class = ClassLists::where('id',decrypt($id))->first();
        $class['division'] = explode(',',$class->division);
        return view(auth()->user()->role.'/classes_edit')->with('classlist',$classlist)->with('divisionlist',$divisionlist)->with('class',$class);
    }

    public function classes_editclass(Request $request)
    {
        $updateData = [
            'classname' => $request->classname,
            'division' => implode(',',$request->division),
        ];
        ClassLists::where('id',$request->id)->update($updateData);

        return Redirect::route('classes')->with('success','Class edited successfully');
    }

    public function classes_delete($id)
    {
        ClassLists::where('id',decrypt($id))->delete();

        return back()->with('success','Class deleted successfully');
    }

    public function subjects()
    {
        $subjectlist = SubjectLists::orderBy('subjectname','asc')->get();
        return view(auth()->user()->role.'/subjects')->with('subjectlist',$subjectlist);
    }

    public function subjects_add(Request $request)
    {
        $subject = SubjectLists::where('subjectname',$request->subjectname)->where('subjectcode',$request->subjectcode)->first();
        if($subject)
        {
            return back()->with('success','Subject already present');
        }
        $data['subjectname'] = $request->subjectname;
        $data['subjectcode'] = $request->subjectcode;
        $data['subjecttype'] = $request->subjecttype;
        SubjectLists::create($data);

        return back()->with('success','Subject added successfully');
    }

    public function subjects_edit($id)
    {
        $subjectlist = SubjectLists::orderBy('subjectname','asc')->get();
        $subject = SubjectLists::where('id','=',decrypt($id))->first();
        return view(auth()->user()->role.'/subjects_edit')->with('subjectlist',$subjectlist)->with('subject',$subject);
    }

    public function subjects_editsubject(Request $request)
    {
        $updateData = [
            'subjectname' => $request->subjectname,
            'subjecttype' => $request->subjecttype,
            'subjectcode' => $request->subjectcode,
        ];
        SubjectLists::where('id',$request->id)->update($updateData);

        return Redirect::route('subjects')->with('success','Subject edited successfully');
    }

    public function subjects_delete($id)
    {
        SubjectLists::where('id',decrypt($id))->delete();
        return back()->with('success','Subject deleted successfully');
    }

    public function assignsubjects()
    {
        $subjectlist = SubjectLists::orderBy('subjectname','asc')->get();
        $teacherlist = StaffDetails::where('staffrole','Teacher')->orderBy('fname','asc')->get();
        return view(auth()->user()->role.'/assignsubjects')->with('subjectlist',$subjectlist)->with('teacherlist',$teacherlist);
    }

    public function assignsubjects_add(Request $request)
    {
        ClassSubjectDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname[0])
            ->where('division',$request->division[0])->where('faculty',$request->faculty[0])->delete();

        for($id = 0; $id < count($request->classname); $id++)
        {
            $data = array(
                'academicyear' => Session::get('academicyear'),
                'classname' => $request->classname[$id],
                'division' => $request->division[$id],
                'subjectname' => $request->subjectname[$id],
                'faculty' => $request->faculty[$id],
                'teachername' => $request->teachername[$id],
            );
            $insertData[] = $data;
        }
        ClassSubjectDetails::insert($insertData);

        return back()->with('success','Subject Assigned Successfully.');
    }

    public function assignclassteacher()
    {
        $classteacherlist = DB::table('class_teacher_details')
            ->join('staff_details','class_teacher_details.teacherid','=','staff_details.userid')
            ->select('class_teacher_details.id','class_teacher_details.classname','class_teacher_details.division',
                'class_teacher_details.faculty','staff_details.fname','staff_details.mname','staff_details.lname')
            ->where('class_teacher_details.academicyear',Session::get('academicyear'))
            ->orderBy('class_teacher_details.classname','asc')
            ->get();
//        return $classteacherlist;
        return view(auth()->user()->role.'/assignclassteacher')->with('classteacherlist',$classteacherlist);
    }

    public function assignclassteacher_add(Request $request)
    {
        $check = ClassTeacherDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname)
            ->where('faculty',$request->faculty)->where('division',$request->division)->first();
        if($check)
        {
            return back()->with('success','Class teacher already assigned');
        }
        $data['academicyear'] = Session::get('academicyear');
        $data['classname'] = $request->classname;
        $data['division'] = $request->division;
        $data['faculty'] = $request->faculty;
        $data['teacherid'] = $request->teacherid;
        ClassTeacherDetails::create($data);

        return back()->with('success','Class teacher assigned successfully');
    }

    public function assignclassteacher_edit($id)
    {
        $classteacher = ClassTeacherDetails::where('id',decrypt($id))->first();
        $classteacherlist = DB::table('class_teacher_details')
            ->join('staff_details','class_teacher_details.teacherid','=','staff_details.userid')
            ->select('class_teacher_details.id','class_teacher_details.classname','class_teacher_details.division',
                'class_teacher_details.faculty','staff_details.fname','staff_details.mname','staff_details.lname')
            ->where('class_teacher_details.academicyear',Session::get('academicyear'))
            ->orderBy('class_teacher_details.classname','asc')
            ->get();
        $class = ClassLists::where('classname',$classteacher->classname)->first();
        $divisionlist = explode(',',$class->division);
        return view(auth()->user()->role.'/assignclassteacher_edit')->with('classteacher',$classteacher)
            ->with('divisionlist',$divisionlist)->with('classteacherlist',$classteacherlist);
    }

    public function assignclassteacher_editclassteacher(Request $request)
    {
        $data['classname'] = $request->classname;
        $data['division'] = $request->division;
        $data['faculty'] = $request->faculty;
        $data['teacherid'] = $request->teacherid;
        ClassTeacherDetails::where('id',$request->id)->update($data);

        return Redirect::route('assignclassteacher')->with('success','Class teacher edited successfully');
    }

    public function assignclassteacher_delete($id)
    {
        ClassTeacherDetails::where('id',decrypt($id))->delete();

        return back()->with('success','Class teacher deleted successfully');
    }

    public function assignexaminer()
    {
        $examinerlist = DB::table('examiner_details')
            ->join('staff_details','examiner_details.staffid','=','staff_details.userid')
            ->select('examiner_details.academicyear','examiner_details.registerfor','staff_details.fname','staff_details.mname',
                'staff_details.lname','examiner_details.id')
            ->orderBy('examiner_details.id','desc')->get();
//        $examinerlist = ExaminerDetails::orderBy('id','desc')->get();
        return view(auth()->user()->role.'/assignexaminer')->with('examinerlist',$examinerlist);
    }

    public function assignexaminer_add(Request $request)
    {
        $data = $request->all();
        $data['academicyear'] = Session::get('academicyear');
        if(ExaminerDetails::where('academicyear',$data['academicyear'])->where('staffid',$request->staffid)->first()){
            return back()->with('success','Staff is already examiner');
        }
        ExaminerDetails::create($data);
        return back()->with('success','Examiner added');
    }

    public function assignexaminer_delete($id)
    {
        ExaminerDetails::where('id',decrypt($id))->delete();

        return back()->with('success','Examiner deleted successfully');
    }

    public function classtimetable()
    {
        return view(auth()->user()->role.'/classtimetable');
    }

    public function timetablecalender(Request $request)
    {
        $timetable = ClassTimeTableDetails::where('academicyear',Session::get('academicyear'))
            ->where('classname',$request->classname)->where('division',$request->division)
            ->where('faculty',$request->faculty)->where('subjectname',$request->subjectname)->get();

        $firstDay = Carbon::createFromFormat('d-m-Y','01-03-2020');
        $timeTableDetails = [];
        for($i=0;$i<6;$i++)
        {
            if($timetable != '[]')
            {
                $data['dayofweek'] = $firstDay->startOfWeek()->addDay($i)->format('l');
                $data['starttime'] = $timetable[$i]->starttime;
                $data['endtime'] = $timetable[$i]->endtime;
                $data['hallno'] = $timetable[$i]->hallno;
            }
            else
            {
                $data['dayofweek'] = $firstDay->startOfWeek()->addDay($i)->format('l');
                $data['starttime'] = '';
                $data['endtime'] = '';
                $data['hallno'] = '';
            }
            array_push($timeTableDetails,$data);
        }
        return $timeTableDetails;
    }

    public function classtimetable_add(Request $request)
    {
        $inputData = [];
        ClassTimeTableDetails::where('academicyear',Session::get('academicyear'))->where('classname',$request->classname[0])
            ->where('division',$request->division[0])->where('faculty',$request->faculty[0])->where('subjectname',$request->subjectname[0])->delete();
        for($i=0;$i<6;$i++)
        {
            $data['academicyear'] = Session::get('academicyear');
            $data['classname'] = $request->classname[$i];
            $data['division'] = $request->division[$i];
            $data['faculty'] = $request->faculty[$i];
            $data['subjectname'] = $request->subjectname[$i];
            $data['dayofweek'] = $request->dayofweek[$i];
            $data['starttime'] = $request->starttime[$i];
            $data['endtime'] = $request->endtime[$i];
            $data['hallno'] = $request->hallno[$i];

            array_push($inputData,$data);
        }
        ClassTimeTableDetails::insert($inputData);

        return back()->with('success','Timetable updated successfully');
    }

    public function scholarship()
    {
        $categories = CategoryLists::get();
        foreach ($categories as $category)
        {
            $applicablefor[] = 'C-'.$category->category;
        }
        $applicablefor[] = 'P-'.'PWD';
        $applicablefor[] = 'M-'.'Minority';
        $applicablefor[] = 'G-'.'Male';
        $applicablefor[] = 'G-'.'Female';

        $scholarshiplist = ScholarshipLists::orderBy('scholarshipname','asc')->get();
        return view(auth()->user()->role.'/scholarship')->with('scholarshiplist',$scholarshiplist)->with('applicablefor',$applicablefor);
    }

    public function scholarship_add(Request $request)
    {
        if(ScholarshipLists::where('scholarshipname',$request->scholarshipname)->exists())
        {
            return back()->with('success','Scholarship exists already');
        }
        $input = $request->all();
        $input['applicablefor'] = implode(',',$request->applicablefor);
        ScholarshipLists::create($input);
        return back()->with('success','Scholarship category added');
    }

    public function scholarship_edit($id)
    {
        $categories = CategoryLists::get();
        foreach ($categories as $category)
        {
            $applicablefor[] = 'C-'.$category->category;
        }
        $applicablefor[] = 'P-'.'PWD';
        $applicablefor[] = 'M-'.'Minority';
        $applicablefor[] = 'G-'.'Male';
        $applicablefor[] = 'G-'.'Female';

        $scholarshiplist = ScholarshipLists::orderBy('scholarshipname','asc')->get();
        $scholarship = ScholarshipLists::where('id','=',decrypt($id))->first();
        $scholarship['applicablefor'] = explode(',',$scholarship->applicablefor);
        return view(auth()->user()->role.'/scholarship_edit')->with('scholarshiplist',$scholarshiplist)
            ->with('scholarship',$scholarship)->with('applicablefor',$applicablefor);
    }

    public function scholarship_editscholarship(Request $request)
    {
        $updateData = [
            'scholarshipname' => $request->scholarshipname,
            'applicablefor' => implode(',',$request->applicablefor),
        ];
        ScholarshipLists::where('id',$request->id)->update($updateData);

        return Redirect::route('scholarship')->with('success','Scholarship edited successfully');
    }

    public function scholarship_delete($id)
    {
        ScholarshipLists::where('id',decrypt($id))->delete();
        return back()->with('success','Scholarship category deleted');
    }

    public function event()
    {
        $events = EventsLists::orderBy('ename','asc')->get();
        return view(auth()->user()->role.'/events')->with('events',$events);
    }

    public function event_add(Request $request)
    {
        if(EventsLists::where('edate',$request->edate)->exists())
        {
            return back()->with('success','Event exists already');
        }
        EventsLists::create($request->all());
        return back()->with('success','event added');
    }

    public function event_edit($id)
    {
        $events = EventsLists::orderBy('ename','asc')->get();
        $event = EventsLists::where('id','=',decrypt($id))->first();
        return view(auth()->user()->role.'/events_edit')->with('events',$events)->with('event',$event);
    }

    public function event_editevent(Request $request)
    {
        $updateData = [
            'ename' => $request->ename,
            'edate' => $request->edate,
            'details' => $request->details,
        ];
        EventsLists::where('id',$request->id)->update($updateData);

        return Redirect::route('event')->with('success','event edited successfully');
    }

    public function event_delete($id)
    {
        EventsLists::where('id',decrypt($id))->delete();
        return back()->with('success','event deleted');
    }

    public function holiday()
    {
        $holidays = HolidayLists::get();
        return view(auth()->user()->role.'/holidays')->with('holidays',$holidays);
    }

    public function holiday_add(Request $request)
    {
        if(HolidayLists::where('hdate',$request->hdate)->exists())
        {
            return back()->with('success','Holiday exists already');
        }
        HolidayLists::create($request->all());
        return back()->with('success','Holiday added');
    }

    public function holiday_edit($id)
    {
        $holidays = HolidayLists::get();
        $holiday = HolidayLists::where('id','=',decrypt($id))->first();
        return view(auth()->user()->role.'/holidays_edit')->with('holidays',$holidays)->with('holiday',$holiday);
    }

    public function holiday_editholiday(Request $request)
    {
        $updateData = [
            'hdate' => $request->hdate,
            'reason' => $request->reason,
        ];
        HolidayLists::where('id',$request->id)->update($updateData);

        return Redirect::route('holiday')->with('success','holiday edited successfully');
    }

    public function holiday_delete($id)
    {
        HolidayLists::where('id',decrypt($id))->delete();
        return back()->with('success','Holiday deleted');
    }

    public function otherschools()
    {
        $schools = OtherSchoolLists::orderBy('schoolname','asc')->get();
        return view(auth()->user()->role.'/otherschools')->with('schools',$schools);
    }

    public function otherschools_add(Request $request)
    {
        if(OtherSchoolLists::where('schoolname',$request->schoolname)->exists())
        {
            return back()->with('success','School exists already');
        }
        OtherSchoolLists::create($request->all());
        return back()->with('success','School added');
    }

    public function otherschools_edit($id)
    {
        $schools = OtherSchoolLists::orderBy('schoolname','asc')->get();
        $school = OtherSchoolLists::where('id','=',decrypt($id))->first();
        return view(auth()->user()->role.'/otherschools_edit')->with('schools',$schools)->with('school',$school);
    }

    public function otherschools_editschool(Request $request)
    {
        $updateData = [
            'schoolname' => $request->schoolname,
        ];
        OtherSchoolLists::where('id',$request->id)->update($updateData);

        return Redirect::route('otherschools')->with('success','school edited successfully');
    }

    public function otherschools_delete($id)
    {
        OtherSchoolLists::where('id',decrypt($id))->delete();
        return back()->with('success','School deleted');
    }

    public function resetpassword()
    {
        return view(auth()->user()->role.'/resetpassword');
    }

    public function resetpassword_reset(Request $request)
    {
        if(!$request->name)
        {
            return back()->with('success','AADHAR not found');
        }
        User::where('aadhar',$request->aadhar)->update(['password'=>bcrypt($request->password)]);
        return back()->with('success','Password Reset Successfully');
    }
}

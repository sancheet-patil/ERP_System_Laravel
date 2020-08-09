<?php

namespace App\Http\Controllers\Web\Admin;

use App\CasteCategoryList;
use App\StaffAttendanceInfo;
use App\StaffDetails;
use App\StaffOtherDetails;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class HumanResourceController extends Controller
{
    public function staff_joining()
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->orderBy('staff_details.id','desc')->get();
        return view(auth()->user()->role.'/staff_joining')->with('stafflist',$stafflist);
    }

    public function staff_joining_add(Request $request)
    {
        $validatedData = $request->validate([
            'aadhar' => 'required|unique:users',
        ]);

        $userid = date('ymdhis');

        $staffDetails['userid']=$userid;
        $staffDetails['staffid']=$request->staffid;
        $staffDetails['staffrole']=$request->staffrole;
        $staffDetails['designation']=$request->designation;
        $staffDetails['lname']=$request->lname;
        $staffDetails['fname']=$request->fname;
        $staffDetails['mname']=$request->mname;
        $staffDetails['mothername']=$request->mothername;
        $staffDetails['gender']=$request->gender;
        $staffDetails['dob']=$request->dob;
        $staffDetails['email']=$request->email;
        $staffDetails['mobile']=$request->mobile;
        $staffDetails['bloodgroup']=$request->bloodgroup;
        $staffDetails['maritalstatus']=$request->maritalstatus;
        $staffDetails['religion']=$request->religion;
        $staffDetails['category']= CasteCategoryList::where('id',$request->subcaste)->value('category');
        $staffDetails['castename']=$request->castename;
        $staffDetails['subcaste']=$request->subcaste;
        $staffDetails['aadhar']=$request->aadhar;
        $staffDetails['mothertongue']=$request->mothertongue;
        $staffDetails['placeob']=$request->placeob;
        $staffDetails['joiningdate']=$request->joiningdate;
        $staffDetails['shalarthid']=$request->shalarthid;
        $staffDetails['qualificationdetails']=$request->qualificationdetails;
        $staffDetails['experiencedetails']=$request->experiencedetails;
        $staffDetails['currentaddress']=$request->currentaddress;
        $staffDetails['permanentaddress']=$request->permanentaddress;

        if($request->file('staffphoto')) {
            $file = $request->file('staffphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name;
            $staffDetails['staffphoto'] = $filepath;
        }
        else
        {
            $staffDetails['staffphoto'] = null;
        }
        StaffDetails::create($staffDetails);

        $staffOtherDetails['userid']=$userid;
        $staffOtherDetails['epfno']=$request->epfno;
        $staffOtherDetails['basicsalary']=$request->basicsalary;
        $staffOtherDetails['contracttype']=$request->contracttype;
        $staffOtherDetails['accounttitle'] = $request->accounttitle;
        $staffOtherDetails['accountno'] = $request->accountno;
        $staffOtherDetails['bankifsccode'] = $request->bankifsccode;
        $staffOtherDetails['bankname'] = $request->bankname;
        $staffOtherDetails['bankbranchname'] = $request->bankbranchname;
        $staffOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/staffdata/'.$userid.'/'.$new_name1;
            $staffOtherDetails['document1file']=$document1filepath;
        }
        else
        {
            $staffOtherDetails['document1file']=null;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name2;
            $staffOtherDetails['document2file'] = $document2filepath;
        }
        else
        {
            $staffOtherDetails['document2file']=null;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name3;
            $staffOtherDetails['document3file'] = $document3filepath;
        }
        else
        {
            $staffOtherDetails['document3file']=null;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name4;
            $staffOtherDetails['document4file'] = $document4filepath;
        }
        else
        {
            $staffOtherDetails['document4file']=null;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name5;
            $staffOtherDetails['document5file'] = $document5filepath;
        }
        else
        {
            $staffOtherDetails['document5file']=null;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name6;
            $staffOtherDetails['document6file'] = $document6filepath;
        }
        else
        {
            $staffOtherDetails['document6file']=null;
        }

        $staffOtherDetails['document1name']=$request->document1;
        $staffOtherDetails['document2name']=$request->document2;
        $staffOtherDetails['document3name']=$request->document3;
        $staffOtherDetails['document4name']=$request->document4;
        $staffOtherDetails['document5name']=$request->document5;
        $staffOtherDetails['document6name']=$request->document6;

        StaffOtherDetails::create($staffOtherDetails);

        $userDetails['userid'] = $userid;
        $userDetails['name'] = $request->fname;
        $userDetails['aadhar'] = $request->aadhar;
        $userDetails['password'] = bcrypt('1234');
        $userDetails['role'] = strtolower($request->staffrole);
        $userDetails['hasaccess'] = '1';
        User::create($userDetails);

        return Redirect::route('staff.joining')->with('success','Staff Added Successfully');
    }

    public function staff_view($id)
    {
        $userid = decrypt($id);

        $staffdetails = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->where('staff_details.userid',$userid)
            ->first();

        return view(auth()->user()->role.'/staff_view')->with('staffdetails',$staffdetails);
    }

    public function staff_delete($id)
    {
        $userid = decrypt($id);
        StaffDetails::where('userid',$userid)->delete();
        StaffOtherDetails::where('userid',$userid)->delete();
        StaffAttendanceInfo::where('staffid',$userid)->delete();
        User::where('userid',$userid)->delete();

        return back()->with('success','Staff deleted successfully');
    }

    public function staff_editjoining($id)
    {
        $userid = decrypt($id);

        $staffdetails = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->where('staff_details.userid',$userid)
            ->first();


        $castecategory = \App\CasteCategoryList::where('id',$staffdetails->subcaste)->first();
        $castelist = CasteCategoryList::where('religion',$castecategory->religion)->select('castename')->distinct()->get();
        $subcastelist = CasteCategoryList::where('religion',$castecategory->religion)->where('castename',$castecategory->castename)->orderBy('subcaste','asc')->get();
        $staffdetails->religion = $castecategory->religion;
        $staffdetails->category = $castecategory->category;
        $staffdetails->castename = $castecategory->castename;
        $staffdetails->subcaste = $castecategory->id;

        return view(auth()->user()->role.'/staff_editjoining')->with('staffdetails',$staffdetails)
            ->with('castelist',$castelist)->with('subcastelist',$subcastelist);
    }

    public function staff_editjoining_edit(Request $request)
    {
        $userid = $request->userid;

        $staffDetails['staffid']=$request->staffid;
        $staffDetails['staffrole']=$request->staffrole;
        $staffDetails['designation']=$request->designation;
        $staffDetails['lname']=$request->lname;
        $staffDetails['fname']=$request->fname;
        $staffDetails['mname']=$request->mname;
        $staffDetails['mothername']=$request->mothername;
        $staffDetails['gender']=$request->gender;
        $staffDetails['dob']=$request->dob;
        $staffDetails['email']=$request->email;
        $staffDetails['mobile']=$request->mobile;
        $staffDetails['bloodgroup']=$request->bloodgroup;
        $staffDetails['maritalstatus']=$request->maritalstatus;
        $staffDetails['religion']=$request->religion;
        $staffDetails['category']= CasteCategoryList::where('id',$request->subcaste)->value('category');
        $staffDetails['castename']=$request->castename;
        $staffDetails['subcaste']=$request->subcaste;
        $staffDetails['aadhar']=$request->aadhar;
        $staffDetails['mothertongue']=$request->mothertongue;
        $staffDetails['placeob']=$request->placeob;
        $staffDetails['joiningdate']=$request->joiningdate;
        $staffDetails['shalarthid']=$request->shalarthid;
        $staffDetails['qualificationdetails']=$request->qualificationdetails;
        $staffDetails['experiencedetails']=$request->experiencedetails;
        $staffDetails['currentaddress']=$request->currentaddress;
        $staffDetails['permanentaddress']=$request->permanentaddress;

        if($request->file('staffphoto')) {
            $file = $request->file('staffphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name;
            $staffDetails['staffphoto'] = $filepath;
        }
        StaffDetails::where('userid',$userid)->update($staffDetails);

        $staffOtherDetails['epfno']=$request->epfno;
        $staffOtherDetails['basicsalary']=$request->basicsalary;
        $staffOtherDetails['contracttype']=$request->contracttype;
        $staffOtherDetails['accounttitle'] = $request->accounttitle;
        $staffOtherDetails['accountno'] = $request->accountno;
        $staffOtherDetails['bankifsccode'] = $request->bankifsccode;
        $staffOtherDetails['bankname'] = $request->bankname;
        $staffOtherDetails['bankbranchname'] = $request->bankbranchname;
        $staffOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/staffdata/'.$userid.'/'.$new_name1;
            $staffOtherDetails['document1file']=$document1filepath;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name2;
            $staffOtherDetails['document2file'] = $document2filepath;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name3;
            $staffOtherDetails['document3file'] = $document3filepath;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name4;
            $staffOtherDetails['document4file'] = $document4filepath;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name5;
            $staffOtherDetails['document5file'] = $document5filepath;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name6;
            $staffOtherDetails['document6file'] = $document6filepath;
        }

        $staffOtherDetails['document1name']=$request->document1;
        $staffOtherDetails['document2name']=$request->document2;
        $staffOtherDetails['document3name']=$request->document3;
        $staffOtherDetails['document4name']=$request->document4;
        $staffOtherDetails['document5name']=$request->document5;
        $staffOtherDetails['document6name']=$request->document6;

        StaffOtherDetails::where('userid',$userid)->update($staffOtherDetails);

        $userDetails['name'] = $request->fname;
        $userDetails['aadhar'] = $request->aadhar;
        $userDetails['role'] = strtolower($request->staffrole);
        User::where('userid',$request->userid)->update($userDetails);

        return Redirect::route('staff.joining')->with('success','Staff edited successfully');
    }

    public function staff_search()
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->orderBy('staff_details.id','desc')->get();
        return view(auth()->user()->role.'/staff_search')->with('stafflist',$stafflist);
    }

    public function staff_editsearch($id)
    {
        $userid = decrypt($id);

        $staffdetails = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->where('staff_details.userid',$userid)
            ->first();

        $castecategory = \App\CasteCategoryList::where('id',$staffdetails->subcaste)->first();
        $castelist = CasteCategoryList::where('religion',$castecategory->religion)->select('castename')->distinct()->get();
        $subcastelist = CasteCategoryList::where('religion',$castecategory->religion)->where('castename',$castecategory->castename)->orderBy('subcaste','asc')->get();
        $staffdetails->religion = $castecategory->religion;
        $staffdetails->category = $castecategory->category;
        $staffdetails->castename = $castecategory->castename;
        $staffdetails->subcaste = $castecategory->id;

        return view(auth()->user()->role.'/staff_editsearch')->with('staffdetails',$staffdetails)
            ->with('castelist',$castelist)->with('subcastelist',$subcastelist);
    }

    public function staff_editsearch_edit(Request $request)
    {
        $userid = $request->userid;

        $staffDetails['staffid']=$request->staffid;
        $staffDetails['staffrole']=$request->staffrole;
        $staffDetails['designation']=$request->designation;
        $staffDetails['lname']=$request->lname;
        $staffDetails['fname']=$request->fname;
        $staffDetails['mname']=$request->mname;
        $staffDetails['mothername']=$request->mothername;
        $staffDetails['gender']=$request->gender;
        $staffDetails['dob']=$request->dob;
        $staffDetails['email']=$request->email;
        $staffDetails['mobile']=$request->mobile;
        $staffDetails['bloodgroup']=$request->bloodgroup;
        $staffDetails['maritalstatus']=$request->maritalstatus;
        $staffDetails['religion']=$request->religion;
        $staffDetails['category']= CasteCategoryList::where('id',$request->subcaste)->value('category');
        $staffDetails['castename']=$request->castename;
        $staffDetails['subcaste']=$request->subcaste;
        $staffDetails['aadhar']=$request->aadhar;
        $staffDetails['mothertongue']=$request->mothertongue;
        $staffDetails['placeob']=$request->placeob;
        $staffDetails['joiningdate']=$request->joiningdate;
        $staffDetails['shalarthid']=$request->shalarthid;
        $staffDetails['qualificationdetails']=$request->qualificationdetails;
        $staffDetails['experiencedetails']=$request->experiencedetails;
        $staffDetails['currentaddress']=$request->currentaddress;
        $staffDetails['permanentaddress']=$request->permanentaddress;

        if($request->file('staffphoto')) {
            $file = $request->file('staffphoto');
            $new_name = date('ymdHis') . '_photo.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name;
            $staffDetails['staffphoto'] = $filepath;
        }
        StaffDetails::where('userid',$userid)->update($staffDetails);

        $staffOtherDetails['epfno']=$request->epfno;
        $staffOtherDetails['basicsalary']=$request->basicsalary;
        $staffOtherDetails['contracttype']=$request->contracttype;
        $staffOtherDetails['accounttitle'] = $request->accounttitle;
        $staffOtherDetails['accountno'] = $request->accountno;
        $staffOtherDetails['bankifsccode'] = $request->bankifsccode;
        $staffOtherDetails['bankname'] = $request->bankname;
        $staffOtherDetails['bankbranchname'] = $request->bankbranchname;
        $staffOtherDetails['bankmicrcode'] = $request->bankmicrcode;
        if($request->file('document1file'))
        {
            $file1 = $request->file('document1file');
            $new_name1 = date('ymdHis') . '_document1.' . $file1->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/'.$userid.'/',
                $file1,
                $new_name1
            );
            $document1filepath = config('app.url').'/storage/staffdata/'.$userid.'/'.$new_name1;
            $staffOtherDetails['document1file']=$document1filepath;
        }

        if($request->file('document2file')) {
            $file2 = $request->file('document2file');
            $new_name2 = date('ymdHis') . '_document2.' . $file2->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file2,
                $new_name2
            );
            $document2filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name2;
            $staffOtherDetails['document2file'] = $document2filepath;
        }

        if($request->file('document3file')) {
            $file3 = $request->file('document3file');
            $new_name3 = date('ymdHis') . '_document3.' . $file3->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file3,
                $new_name3
            );
            $document3filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name3;
            $staffOtherDetails['document3file'] = $document3filepath;
        }

        if($request->file('document4file')) {
            $file4 = $request->file('document4file');
            $new_name4 = date('ymdHis') . '_document4.' . $file4->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file4,
                $new_name4
            );
            $document4filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name4;
            $staffOtherDetails['document4file'] = $document4filepath;
        }

        if($request->file('document5file')) {
            $file5 = $request->file('document5file');
            $new_name5 = date('ymdHis') . '_document5.' . $file5->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file5,
                $new_name5
            );
            $document5filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name5;
            $staffOtherDetails['document5file'] = $document5filepath;
        }

        if($request->file('document6file')) {
            $file6 = $request->file('document6file');
            $new_name6 = date('ymdHis') . '_document6.' . $file6->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/staffdata/' . $userid . '/',
                $file6,
                $new_name6
            );
            $document6filepath = config('app.url') . '/storage/staffdata/' . $userid . '/' . $new_name6;
            $staffOtherDetails['document6file'] = $document6filepath;
        }

        $staffOtherDetails['document1name']=$request->document1;
        $staffOtherDetails['document2name']=$request->document2;
        $staffOtherDetails['document3name']=$request->document3;
        $staffOtherDetails['document4name']=$request->document4;
        $staffOtherDetails['document5name']=$request->document5;
        $staffOtherDetails['document6name']=$request->document6;

        StaffOtherDetails::where('userid',$userid)->update($staffOtherDetails);

        $userDetails['name'] = $request->fname;
        $userDetails['aadhar'] = $request->aadhar;
        $userDetails['role'] = strtolower($request->staffrole);
        User::where('userid',$request->userid)->update($userDetails);

        return Redirect::route('staff.search')->with('success','Staff edited successfully');
    }

    public function staffidgenerate()
    {
        $stafflist = DB::table('staff_details')
            ->join('staff_other_details','staff_details.userid','=','staff_other_details.userid')
            ->join('caste_category_lists','staff_details.subcaste','=','caste_category_lists.id')
            ->join('religion_lists','caste_category_lists.religion','=','religion_lists.id')
            ->join('category_lists','caste_category_lists.category','=','category_lists.id')
            ->orderBy('staff_details.id','desc')->get();
        return view(auth()->user()->role.'/staffidgenerate')->with('stafflist',$stafflist);
    }

    public function staff_idgenerate($id)
    {
        $arr[] = [
            'staff' => decrypt($id),
        ];
        return Redirect::route('staffid.bulk.print')->withCookie('details',serialize($arr));
    }

    public function staffidgenerate_bulk()
    {
        $stafflist = StaffDetails::orderBy('lname','asc')->get();
        return view(auth()->user()->role.'/staffidgenerate_bulk')->with('stafflist',$stafflist);
    }

    public function staffidgenerate_bulk_post(Request $request)
    {
        if(!$request->to || $request->to == '[]'){
            return back()->with('success','No staffs selected');
        }
        foreach($request->to as $staff)
        {
            $arr[] = [
                'staff' => $staff,
            ];
        }
        return Redirect::route('staffid.bulk.print')->withCookie('details',serialize($arr));
    }

    public function staffid_bulk_print(Request $request)
    {
        $data = unserialize($request->cookie('details'));
        return view('prints/staffid')->with('data',$data);
    }
}

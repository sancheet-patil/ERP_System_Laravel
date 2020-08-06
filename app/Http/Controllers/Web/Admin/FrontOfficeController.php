<?php

namespace App\Http\Controllers\Web\Admin;

use App\CircularDetails;
use App\ComplaintsList;
use App\InwardsDetails;
use App\OutwardsDetails;
use App\VisitorBookDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FrontOfficeController extends Controller
{
    public function visitorbook()
    {
        $visitorlist = VisitorBookDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/visitorbook')->with('visitorlist',$visitorlist);
    }

    public function visitorbook_add(Request $request)
    {
        $data['academicyear'] = Session::get('academicyear');
        $data['visitpurpose'] = $request->visitpurpose;
        $data['visitorname'] = $request->visitorname;
        $data['visitorphone'] = $request->visitorphone;
        $data['visitoridcard'] = $request->visitoridcard;
        $data['visitoridcardnumber'] = $request->visitoridcardnumber;
        $data['visitdate'] = $request->visitdate;
        $data['intime'] = $request->intime;
        $data['outtime'] = $request->outtime;
        VisitorBookDetails::create($data);

        return back()->with('success','Visitor added successfully');
    }

    public function visitorbook_edit($id)
    {
        $visitorlist = VisitorBookDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        $visitor = VisitorBookDetails::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/visitorbook_edit')->with('visitorlist',$visitorlist)->with('visitor',$visitor);
    }

    public function visitorbook_editvisitor(Request $request)
    {
        $updateData = [
            'visitpurpose' => $request->visitpurpose,
            'visitorname' => $request->visitorname,
            'visitorphone' => $request->visitorphone,
            'visitoridcard' => $request->visitoridcard,
            'visitoridcardnumber' => $request->visitoridcardnumber,
            'visitdate' => $request->visitdate,
            'intime' => $request->intime,
            'outtime' => $request->outtime,
        ];
        VisitorBookDetails::where('id',$request->id)->update($updateData);

        return Redirect::route('visitorbook')->with('success','Visitor edited successfully');
    }

    public function visitorbook_delete($id)
    {
        VisitorBookDetails::where('id','=',decrypt($id))->delete();

        return back()->with('success','Visitor deleted successfully');
    }

    public function outwards()
    {
        $outwardslist = OutwardsDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/outwards')->with('outwardslist',$outwardslist);
    }

    public function outwards_add(Request $request)
    {
        $data['academicyear'] = Session::get('academicyear');
        $data['totitle'] = $request->totitle;
        $data['referencenumber'] = $request->referencenumber;
        $data['toaddress'] = $request->toaddress;
        $data['fromtitle'] = $request->fromtitle;
        $data['postaldate'] = $request->postaldate;

        if($request->file('postfile')) {
            $file = $request->file('postfile');
            $new_name = date('ymdHis') . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/postaldata/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/postaldata/' . $new_name;
            $data['filename'] = $filepath;
        }

        OutwardsDetails::create($data);

        return back()->with('success','Outward added successfully');
    }

    public function outwards_edit($id)
    {
        $outwardslist = OutwardsDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        $outwards = OutwardsDetails::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/outwards_edit')->with('outwardslist',$outwardslist)->with('outwards',$outwards);
    }

    public function outwards_editoutwards(Request $request)
    {
        $updateData = [
            'totitle' => $request->totitle,
            'referencenumber' => $request->referencenumber,
            'toaddress' => $request->toaddress,
            'fromtitle' => $request->fromtitle,
            'postaldate' => $request->postaldate,
        ];
        OutwardsDetails::where('id',$request->id)->update($updateData);

        return Redirect::route('outwards')->with('success','Outward edited successfully');
    }

    public function outwards_delete($id)
    {
        OutwardsDetails::where('id',decrypt($id))->delete();

        return back()->with('success','Outward deleted successfully');
    }

    public function inwards()
    {
        $inwardslist = InwardsDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/inwards')->with('inwardslist',$inwardslist);
    }

    public function inwards_add(Request $request)
    {
        $data['academicyear'] = Session::get('academicyear');
        $data['fromtitle'] = $request->fromtitle;
        $data['referencenumber'] = $request->referencenumber;
        $data['fromaddress'] = $request->fromaddress;
        $data['totitle'] = $request->totitle;
        $data['postaldate'] = $request->postaldate;

        if($request->file('postfile')) {
            $file = $request->file('postfile');
            $new_name = date('ymdHis') . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/postaldata/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/postaldata/' . $new_name;
            $data['filename'] = $filepath;
        }

        InwardsDetails::create($data);

        return back()->with('success','Inward added successfully');
    }

    public function inwards_edit($id)
    {
        $inwardslist = InwardsDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        $inwards = InwardsDetails::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/inwards_edit')->with('inwardslist',$inwardslist)->with('inwards',$inwards);
    }

    public function inwards_editinwards(Request $request)
    {
        $updateData = [
            'fromtitle' => $request->fromtitle,
            'referencenumber' => $request->referencenumber,
            'fromaddress' => $request->fromaddress,
            'totitle' => $request->totitle,
            'postaldate' => $request->postaldate,
        ];
        InwardsDetails::where('id',$request->id)->update($updateData);

        return Redirect::route('inwards')->with('success','Inward edited successfully');
    }

    public function inwards_delete($id)
    {
        InwardsDetails::where('id',decrypt($id))->delete();

        return back()->with('success','Inward deleted successfully');
    }

    public function complaints()
    {
        $complaintslist = ComplaintsList::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/complaints')->with('complaintslist',$complaintslist);
    }

    public function complaints_add(Request $request)
    {
        $data['academicyear'] = Session::get('academicyear');
        $data['complaintby'] = $request->complaintby;
        $data['phone'] = $request->phone;
        $data['complaintdate'] = $request->complaintdate;
        $data['description'] = $request->description;
        $data['assigned'] = $request->assigned;
        $data['actiontaken'] = $request->actiontaken;
        $data['complaintstatus'] = $request->complaintstatus;

        ComplaintsList::create($data);

        return back()->with('success','Complaint added successfully');
    }

    public function complaints_edit($id)
    {
        $complaintslist = ComplaintsList::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        $complaint = ComplaintsList::where('id',decrypt($id))->first();
        return view(auth()->user()->role.'/complaints_edit')->with('complaintslist',$complaintslist)->with('complaint',$complaint);
    }

    public function complaints_editcomplaint(Request $request)
    {
        $updateData = [
            'complaintby' => $request->complaintby,
            'phone' => $request->phone,
            'complaintdate' => $request->complaintdate,
            'description' => $request->description,
            'assigned' => $request->assigned,
            'actiontaken' => $request->actiontaken,
            'complaintstatus' => $request->complaintstatus,
        ];
        ComplaintsList::where('id',$request->id)->update($updateData);

        return Redirect::route('complaints')->with('success','Complaint edited successfully');
    }

    public function complaints_delete($id)
    {
        ComplaintsList::where('id',decrypt($id))->delete();

        return back()->with('success','Complaint deleted successfully');
    }

    public function circular()
    {
        $circulars = CircularDetails::where('academicyear',Session::get('academicyear'))->orderBy('id','desc')->get();
        return view(auth()->user()->role.'/circular')->with('circulars',$circulars);
    }

    public function circular_add(Request $request)
    {
        $data = $request->all();
        $data['circulardate'] = date('d-m-Y');
        $data['academicyear'] = Session::get('academicyear');

        if($request->file('contentfile')) {
            $file = $request->file('contentfile');
            $new_name = date('ymdHis') . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->putFileAs(
                'public/circular/',
                $file,
                $new_name
            );
            $filepath = config('app.url') . '/storage/circular/' . $new_name;
            $data['contentpath'] = $filepath;
        }
        CircularDetails::create($data);
        return back()->with('success','Circular uploaded');
    }

    public function circular_delete($id)
    {
        CircularDetails::where('id',decrypt($id))->delete();
        return back()->with('success','Circular deleted');
    }
}

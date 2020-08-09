<style>
    body{
        font-size: 14px;
    }
    table,h1,h2,h3,h4,p{
        margin: 0;
        padding: 0;
    }
    .header{
        font-size: 14px;
    }
    .f10{
        font-size: 10px;
    }
    .f12{
        font-size: 12px;
    }
    .f14{
        font-size: 14px;
    }
    .p20{
        padding: 20px;
    }
    td {
        padding: 2px 0;
    }
    u{
        font-weight: bold;
    }
    hr{
        color: purple;
    }
    #outline{
        border: 2px solid purple;
        border-radius: 10px;
    }
    .center{
        text-align: center;
    }
    .textred{
        color: red;
    }
    .mrgnhor{
        margin: 0 20px;
    }
</style>
<body>
<table width="100%" border="0" id="outline">
    <tr>
        <th class="f10">
            <p class="center textred">
                (See Rules 17 & 32 in Chapter II. Section 11 of Grant in aid code)<br>No Change in any entry is to be made except by the
                authority issuing the leaving certificate and infringement of the rule will be punished with rustication
            </p>
            <hr>
        </th>
    </tr>
    <tr>
        <th>
            <table border="0" width="100%" class="header">
                <tr>
                    <th width="100px" align="right"><img src="{{asset('images/logo.png')}}" /></th>
                    <th align="center">
                        Shikshan Prasarak Mandal, Mandrup, Sanchalit<br>
                        <h3 class="textred">LOKSEVA VIDYAMANDIR & JUNIOR COLLEGE, MANDRUP</h3>
                        Tal. South Solapur, Dist. Solapur. Cell: 9420490054, 9923350050<br>
                        <b class="f12">(School UDISE No. 27301105412)</b>
                    </th>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
        <th>
            <table border="0" width="100%" class="header">
                <tr class="f12">
                    <th>
                        Board: Pune - Medium: Marathi - Index No.: S24.09.032 / J24.09.027
                    </th>
                    <th align="right">
                        School Reg. No.: S-1-(SH) NS/PR-POONA-4 Dated: 27-4-1966
                    </th>
                </tr>
            </table>
        </th>
    </tr>
    <tr>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td align="center">
            (@if($lc->printcount > 0) Duplicate @else Original @endif)
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>Sr.No.: <b>{{strtoupper($lc->id)}}</b></td>
                    <td align="right">G.R.No.: <b>{{strtoupper($lc->registerno)}}</b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td width="50%">1) Student ID: <b>{{strtoupper($lc->saralid)}}</b></td>
                    <td width="50%">2) AADHAR No.: <b>{{strtoupper($lc->aadhar)}}</b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        3) Name of the pupil in Full: <b>{{strtoupper($lc->lname.' '.$lc->fname.' '.$lc->mname)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        4) Mother's Name: <b>{{strtoupper($lc->mothername)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td width="50%">
                        5) Nationality: <b>{{strtoupper('INDIAN')}}</b>
                    </td>
                    <td width="50%">
                        6) Mother Tongue: <b>{{strtoupper($lc->mothertongue)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        7) Religion/Caste/SubCaste: <b>
                            @if(strtolower($lc->religion)!='na') {{strtoupper($lc->religion)}} @endif
                            @if(strtolower($lc->religion)!='na' && strtolower($lc->castename)!='na') - @endif
                            @if(strtolower($lc->castename)!='na') {{strtoupper($lc->castename)}} @endif
                            @if(strtolower($lc->castename)!='na' && strtolower($lc->subcaste)!='na') - @endif
                            @if(strtolower($lc->subcaste)!='na') {{strtoupper($lc->subcaste)}} @endif
                        </b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        8) Place of Birth: <b>{{strtoupper($lc->placeob)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        9) Date of Birth: <b>{{strtoupper($dob.' ('.ucwords($dobinwords).')')}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        <?php
                            if($lc->schoolname != 'Other') {
                                $lastschool = \App\OtherSchoolLists::where('id',$lc->schoolname)->value('schoolname');
                            }
                            else{
                                $lastschool = $lc->lastschool;
                            }
                        ?>
                        10) Last school attended: <b>{{strtoupper($lastschool)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td width="50%">
                        11) Date of Admission: <b>{{\Carbon\Carbon::parse($lc->admission_date)->format('d-m-Y')}}</b>
                    </td>
                    <td width="50%">
                        <?php
                        $admissionclass = \App\StudentDetails::where('userid',$lc->userid)->value('admission_class');
                        ?>
                        12) Standard:
                            <b>
                                @if($admissionclass > '10')
                                    {{$admissionclass}}<sup>th</sup>  {{$lc->faculty}}
                                @else
                                    {{$admissionclass}}<sup>th</sup>
                                @endif
                            </b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        13) Progress: <b>{{strtoupper($lc->progress)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        14) Conduct: <b>{{strtoupper($lc->conduct)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        15) Date of leaving school: <b>{{strtoupper($lc->dateofleaving)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        16) Standard in which studying and since when: <b> {{strtoupper($lc->studyinginclass)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        17) Reason of leaving school: <b>{{strtoupper($lc->reasonofleaving)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" class="mrgnhor">
                <tr>
                    <td>
                        18) Remarks: <b>{{strtoupper($lc->remarks)}}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td>
            <p class="center">Certified that above information is in accordance with the School Register</p><br><br><br>
        </td>
    </tr>
    <tr>
        <td align="right">
            <table border="0" width="100%" class="mrgnhor">
                <tr style="margin: auto">
                    <td style="padding: 0 0 0 40px;">Date: <b>
{{--                            {{$lc->issuedate}}--}}
                            {{date('d-m-Y')}}
                        </b></td>
                    <td>Clerk</td>
                    <td style="padding: 0 40px 0 0;" align="right">Principal</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

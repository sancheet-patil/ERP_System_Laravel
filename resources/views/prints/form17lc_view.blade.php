<style>
    body{
        font-size: 16px;
    }
    table,h1,h2,h3,h4,p{
        margin: 0;
        padding: 0;
    }
    table.maintable{
        border: 1px solid black;
        border-collapse: collapse;
    }
    table.maintable td {
        border: 1px solid black;
    }
    table.maintable tr:first-child td {
        border-top: 0;
    }
    table.maintable tr td:first-child {
        border-left: 0;
    }
    table.maintable tr:last-child td {
        border-bottom: 0;
    }
    table.maintable tr td:last-child {
        border-right: 0;
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
    td .pad {
        padding: 5px 10px;
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
        <td>
            <table width="100%" style="margin: 0;padding: 0;">
                <tr>
                    <td class="pad">
                        L.C. No: <b>{{$lc->id}}</b>
                    </td>
                    <td align="center">
                        <h4 class="textred" style="margin: 0;padding: 0;">Certificate to be given to Private Candidate</h4>
                    </td>
                    <td class="pad" align="right">
                        G.R. No.: <b>{{$lc->registerno}}</b>
                    </td>
                </tr>
            </table>
        </td>
        {{--<td align="center" style="margin: 0;">
            <h4 class="textred">Certificate to be given to Private Candidate</h4>
        </td>--}}
    </tr>
    <tr>
        <td align="center">
            (@if($lc->printcount > 0) Duplicate @else Original @endif)
        </td>
    </tr>
    <tr>
        <td>
            <table class="maintable" border="0" width="100%">
                <tr>
                    <td class="pad" width="6%" align="center">
                        1)
                    </td>
                    <td class="pad" width="42%">
                        Name of the pupil in Full:
                    </td>
                    <td class="pad" width="52%">
                        <b>{{strtoupper($lc->lname.' '.$lc->fname.' '.$lc->mname)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        2)
                    </td>
                    <td class="pad">
                        Mother's Name:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper($lc->mothername)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        3)
                    </td>
                    <td class="pad">
                        Caste-SubCaste:
                    </td>
                    <td class="pad">
                        <b>
                            @if(strtolower($lc->castename)=='na') @else {{strtoupper($lc->castename)}} @endif @if(strtolower($lc->subcaste)=='na') @else - {{strtoupper($lc->subcaste)}} @endif
                        </b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        4)
                    </td>
                    <td class="pad">
                        Nationality:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper('INDIAN')}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        5)
                    </td>
                    <td class="pad">
                        Religion:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper($lc->religion)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        6)
                    </td>
                    <td class="pad">
                        Place of Birth:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper($lc->placeob)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        7)
                    </td>
                    <td class="pad">
                        Date of Birth:
                    </td>
                    <td class="pad">
                        <b>{{$lc->dob.' ('.strtoupper($dobinwords).')'}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        8)
                    </td>
                    <td class="pad">
                        Mothertongue:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper($lc->mothertongue)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        9)
                    </td>
                    <td class="pad">
                        Previous School/College:
                    </td>
                    <td class="pad">
                        <?php
                        if($lc->schoolname != 'Other') {
                            $lastschool = \App\OtherSchoolLists::where('id',$lc->schoolname)->value('schoolname');
                        }
                        else{
                            $lastschool = $lc->lastschool;
                        }
                        ?>
                        <b>{{strtoupper($lastschool)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        10)
                    </td>
                    <td class="pad">
                        Date of Registration:
                    </td>
                    <td class="pad">
                        <b>{{$lc->admission_date}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        11)
                    </td>
                    <td class="pad">
                        Date of Passing:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper($lc->dateofpassing)}}</b>
                    </td>
                </tr>
                <tr>
                    <td class="pad" align="center">
                        12)
                    </td>
                    <td class="pad">
                        Seat no. & year of passing. Std X / Std XII:
                    </td>
                    <td class="pad">
                        <b>{{strtoupper($lc->examseatno.' (Year - '.substr($lc->dateofpassing,6,4).')')}}</b>
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
            <p class="center">The information above is certified as per the admission registration no.: <u>{{strtoupper($lc->previousgrno)}}</u> and
                School Leaving Certificate no.: <u>{{strtoupper($lc->previouslcno)}}</u> of <u>{{strtoupper($lastschool)}}</u> School / Jr. college.
            </p>
            <br><br><br>
        </td>
    </tr>
    <tr>
        <td align="right">
            <table border="0" width="100%" class="mrgnhor">
                <tr style="margin: auto">
                    <td>Date: <b>{{$lc->issuedate}}</b></td>
                    <td>Clerk</td>
                    <td align="right">Principal</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
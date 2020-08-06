<style>
    body{
        font-size: 16px;
    }
    table,h1,h2,h3,h4,p{
        margin: 0;
        padding: 0;
    }
    .header{
        font-size: 14px;
    }
    p{
        padding: 20px;
    }
    u{
        font-weight: bold;
    }
    hr{
        color: purple;
    }
    .f10{
        font-size: 10px;
    }
    .f12{
        font-size: 12px;
    }
    .textred{
        color: red;
    }
    #outline{
        border: 2px solid purple;
        border-radius: 10px;
    }
</style>
<body>
<table width="100%" border="0" id="outline">
    <tr>
        <td>
            <table border="0" width="100%" class="header">
                <tr>
                    <th>
                        <table border="0" width="100%" class="header">
                            <tr>
                                <th width="100px" align="right"><img src="{{asset('images/logo.png')}}" /></th>
                                <th align="center">
                                    Shikshan Prasarak Mandal, Mandrup, Sanchalit<br>
                                    <h3 class="textred">
                                        LOKSEVA VIDYAMANDIR & JUNIOR COLLEGE, MANDRUP
                                    </h3>
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
                            <tr class="f10">
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
            <h3 class="textred" align="center">
                BONAFIDE AND CHARACTER CERTIFICATE
            </h3>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" width="100%" style="padding: 0px 20px">
                <tr>
                    <td>Saral ID.: <b>{{$bonafide->saralid}}</b></td>
                    <td align="right">
                        Date: <b>{{$bonafide->issuedate}}</b><br>
                        Gr.No.: <b>{{$bonafide->registerno}}</b><br>
                    </td>
                </tr>
                <tr>
                    <td><img src="{{$bonafide->studentphoto}}" height="70px" width="70px" alt="studentphoto" style="border: 1px solid black;margin-top: 10px;"/> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <p style="line-height: 1.3;">
                This is to certify that,<br> Kumar / Kumari <b>{{strtoupper($bonafide->lname.' '.$bonafide->fname.' '.$bonafide->mname)}}</b> is / was a bonafide student of this school / college,
                studying in <b>{{strtoupper($bonafide->classname)}}, {{$bonafide->academicyear}}</b>.
                His / Her birth date on the General Register is <b>{{$bonafide->dob}}</b> <b>({{strtoupper($dobinwords)}})</b>.
                His / Her place of birth is <b>{{strtoupper($bonafide->placeob)}}</b> and he / she belong to caste
                <b>{{$bonafide->religion}} @if(strtolower($bonafide->castename)=='na') @else - {{$bonafide->castename}} @endif
                    @if(strtolower($bonafide->subcaste)=='na') @else - {{$bonafide->subcaste}} @endif</b>.<br>
                He / She / is / was regular attendance.<br>To the best of my knowledge he / she bears a good moral character.
            </p>
        </td>
    </tr>
    <tr>
        <td align="right">
            <table border="0" width="100%">
                <tr>
                    <td></td>
                    <td width="260px" align="center">
                        <br>
                        PRINCIPAL<br>
                        Lokseva Vidyamandir & Jr. College,<br>
                        Mandrup, Tal. S. Solapur, Dist. Solapur
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
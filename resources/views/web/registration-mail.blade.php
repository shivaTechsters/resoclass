<div class="gmail_quote"><div style="text-align:center" class="adM"><br></div><div class="adM">
</div><div style="text-align:center"><img src="https://grandtest.resonancehyderabad.com/web/images/logo.png" alt="resonance-logo.png" width="293" height="86" style="margin-right:0px" data-image-whitelisted="" class="CToWUd" data-bit="iit"></div>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="https://ci3.googleusercontent.com/meips/ADKq_Nbxy5ATxYVj0PN_NqvcprjrLHHU-tA_vm4lAbAj6_x-p3o3yGM-LG1h9flndffPx41iUP5PMbE5L6o4Gixt-AegJ2H8kRpJrrl9RRS3qaWTLnDSlvyrZLF-kldWLcKpbm9q58olHowZLIWAqE8F44LS9_oX7CGpHCxfzA=s0-d-e1-ft#https://resofast.resonancehyderabad.com/admin_assets/images/success-vector-illustration_1893-2234.jpg" style="margin-left:20px;margin-right:0px" width="570" height="427" class="CToWUd a6T" data-bit="iit" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 697.998px; top: 522.394px;"><span data-is-tooltip-wrapper="true" class="a5q" jsaction="JIbuQc:.CLIENT"><button class="VYBDae-JX-I VYBDae-JX-I-ql-ay5-ays CgzRE" jscontroller="PIVayb" jsaction="click:h5M12e; clickmod:h5M12e;pointerdown:FEiYhc;pointerup:mF5Elf;pointerenter:EX0mI;pointerleave:vpvbp;pointercancel:xyn4sd;contextmenu:xexox;focus:h06R8; blur:zjh6rb;mlnRJb:fLiPzd;" data-idom-class="CgzRE" jsname="hRZeKc" aria-label="Download attachment " data-tooltip-enabled="true" data-tooltip-id="tt-c122" data-tooltip-classes="AZPksf" id="" jslog="91252; u014N:cOuCgd,Kr2w4b,xr6bB; 4:WyIjbXNnLWY6MTc5NzI0ODMxMDE4Nzk0ODI0NSJd; 43:WyJpbWFnZS9qcGVnIl0."><span class="OiePBf-zPjgPe VYBDae-JX-UHGRz"></span><span class="bHC-Q" data-unbounded="false" jscontroller="LBaJxb" jsname="m9ZlFb" soy-skip="" ssk="6:RWVI5c"></span><span class="VYBDae-JX-ank-Rtc0Jf" jsname="S5tZuc" aria-hidden="true"><span class="bzc-ank" aria-hidden="true"><svg height="20" viewBox="0 -960 960 960" width="20" focusable="false" class=" aoH"><path d="M480-336 288-528l51-51 105 105v-342h72v342l105-105 51 51-192 192ZM263.72-192Q234-192 213-213.15T192-264v-72h72v72h432v-72h72v72q0 29.7-21.16 50.85Q725.68-192 695.96-192H263.72Z"></path></svg></span></span><div class="VYBDae-JX-ano"></div></button><div class="ne2Ple-oshW8e-J9" id="tt-c122" role="tooltip" aria-hidden="true">Download</div></span></div>&nbsp;<h1 style="text-align:center;font-size:30px;color:rgb(188,210,83);margin-left:20px"> Thank you for Registering with Resonance Hyderabad&nbsp;</h1><h1 style="text-align:center;font-size:30px;color:rgb(188,210,83);margin-left:20px">for NEET Free Grand Test</h1>
<h1 style="font-weight:400;margin-left:20px"><b>YOUR HALL TICKET NO:&nbsp;</b>{{$registration->reso_admit_card_no}}</h1>

<div style="padding-left:40px;padding-right:40px;margin-top:60px;margin-bottom:40px;background-color:#cccccc30;width:100%;padding-top:50px;padding-bottom:50px">

<div style="margin-bottom:40px">
<h3 style="color:#727272"><br></h3>
<h1 style="font-size:40px;color:#bcd253">ALL THE BEST FOR NEET GRAND TEST</h1>
</div>

<div style="display:grid">
<table style="width:500px">
<tbody><tr>
<td>NEET Application No</td>
<td>{{$registration->neet_application_no}}</td>

</tr>
<tr>
<td>Reso Admit Card NO</td>
<td>{{$registration->reso_admit_card_no}}</td>

</tr>
<tr>
<td>Student&nbsp;Name<br>Father Name</td>
<td>{{$registration->name}}<br>{{$registration->father_name}}</td>

</tr>

<tr>
<td>Mobile Number</td>
<td>{{$registration->neet_reg_phone}}</td>

</tr>
<tr>
<td>Email</td>
<td><a href="mailto:{{$registration->email}}" target="_blank">{{$registration->email}}</a></td>

</tr>
<tr>
<td>Exam Date</td>
<td>28-04-2024 2PM - 5:20PM</td>

</tr>
<tr>
<td>Exam Mode</td>
<td>Offline</td>

</tr>
<tr>
<td>Exam Centre</td>
<td>{{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->name}}</td>

</tr>
<tr>
<td>Download link&nbsp;</td>
<td><a href="{{ asset('storage/admit-card/'.$registration->reso_admit_card_no .'-' . date("dmY",strtotime($registration->date_of_birth)) . '.pdf') }}" target="_blank" >{{ asset('storage/admit-card/'.$registration->reso_admit_card_no .'-' . date("dmY",strtotime($registration->date_of_birth)) . '.pdf') }}</a></td></tr><tr><td>Address&nbsp;</td>
<td>Address: {{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->address}}<br></td>

</tr>
<tr>
<td>Location Map&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
<td><a href="{{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->google_maps_link}}" target="_blank">{{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->google_maps_link}}</a></td>

</tr>

</tbody></table>
</div>

<div style="text-align:left;margin-left:120px;color:#727272">
Note: Please Use this Hall Ticket Number for your Future Reference.
<br>
Help Desk Number for Queries : 9121219858
</div><div class="yj6qo"></div><div class="adL">
</div></div><div class="adL">
</div></div>
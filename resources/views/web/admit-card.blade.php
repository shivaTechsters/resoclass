<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Title -->
    <title>Admit Card</title>

    <!-- Internal CSS -->
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        section {
            border-radius: 5px;
            box-shadow: 0px 0px 7px #c4c6c7;
            background-color: #fff;
            padding: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 2px solid #272b2f;
            text-align: left;
            vertical-align: top;
            padding: 10px;
            background-color: #fff;
            font-size: 14px;
            margin-bottom: 0px;
        }

        table p {
            font-size: 14px;
            margin-bottom: 0px;
        }

        p {
            font-size: 14px;
            margin-bottom: 7px;
        }

        hr {
            background-color: #6c757d;
        }
    </style>


</head>

<body>



    <!-- Main (Start) -->
    <main>

        <!-- Section (Start) -->
        <section class="card shadow-sm">

            <img src="web/images/admit-card-header.png" style="width: 100%;" alt="">
            <div class="card-body">
                
                <br>

                <div class="container">

                    <table style="border: none">
                        <tr>
                            <td style="border: none;"><h1 style="font-size: 1.5rem; margin-bottom: 7px;">Resonance NEET 2024 Free Grand Test</h1>
                                <h1 style="font-size: 1.5rem;">Provisional Admit Card</h1></td>
                            <td>
                                <p style="margin-bottom: 4px; font-size: 0.9rem; white-space: nowrap;">Exam Date: 28.04.2024</p>
                                <p style="margin-bottom: 4px; font-size: 0.9rem; white-space: nowrap;">Exam Time: 2PM -5.20PM</p>
                                <p style="margin-bottom: 0px; font-size: 0.9rem; white-space: nowrap;">Exam Reporting Time: 1PM</p>
                            </td>
                        </tr>
                    </table>

                    <br>

                    <table style="table-layout: fixed;">
                        <tr>
                            <td style="border-right: none;">
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">NEET Application No. {{$registration->neet_application_no}}</p>
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">Reso Admit Card No. {{$registration->reso_admit_card_no}}</p>
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">Candidate Name: {{$registration->name}}</p>
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">Gender: {{$registration->gender}}</p>
                                <p style="margin-bottom: 0px; font-size: 0.9rem;">Mail ID: {{$registration->email}}</p>
                            </td>
                            <td style="border-left: none;">
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">Date of Birth: {{date('d-m-Y',strtotime($registration->date_of_birth))}}</p>
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">Father Name: {{$registration->father_name}}</p>
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">NEET Reg. Mobile Number : {{$registration->neet_reg_phone}}</p>
                                <p style="margin-bottom: 5px; font-size: 0.9rem;">Alternate Number : {{$registration->alternate_phone}}</p>
                                <p style="margin-bottom: 0px; font-size: 0.9rem;">Exam Center : {{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->name}}</p>
                                <p style="margin-bottom: 0px; font-size: 0.9rem;">Exam Center Address : {{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->address}}</p>
                            </td>
                        </tr>
                    </table>

                    <br>

                    <table style="table-layout: fixed;">
                        <tr>
                            <td style="border: none; padding: 0px;" align="center; width: 25%;" rowspan="2">
                                <div style="height: 210px; width: 160px; border: 2px solid #272b2f; margin-bottom: 10px; position: relative;">
                                    <p style="position: absolute; top: 45%; left: 37%;">Photo</p>
                                </div>
                            </td>
                            <td style="border: none; padding: 0px; text-align: center;" align="center;">
                                <div style="height: 80px; width: 100%; border: 2px solid #272b2f; margin-bottom: 10px; ">
                                    
                                    
                                </div>
                                <p style="font-size: 0.8rem;">Candidate's left hand thumb impression</p>
                                <br>
                            </td>
                            <td style="border: none; padding: 0px; text-align: center;" align="center;">
                                <div style="height: 80px; width: 100%; border: 2px solid #272b2f; margin-bottom: 10px; ">
                                    
                                    
                                </div>
                                <p style="font-size: 0.8rem;">Candidate's Parent Signature</p>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 0px; text-align: center;" align="center;">
                                <div style="height: 80px; width: 100%; border: 2px solid #272b2f; margin-bottom: 10px; ">
                                    
                                    
                                </div>
                                <p style="font-size: 0.8rem;">Invigilator Signature</p>
                            </td>
                            <td style="border: none; padding: 0px; text-align: center;" align="center;">
                                <div style="height: 80px; width: 100%; border: 2px solid #272b2f; margin-bottom: 10px; ">
                                    
                                    
                                </div>
                                <p style="font-size: 0.8rem;">Candidate's Signature</p>
                            </td>
                        </tr>
                    </table>

                    <br>

                    <div>
                        <p style="font-size: 0.7rem;">Guidelines for students:</p>

                        <p style="font-size: 0.65rem;">*No candidate shall be permitted to enter after the Gate Closing Time. <br>

                            *No candidate shall be permitted to leave the Examination Room/ Hall before the end of the examination. <br>
                            
                            *On completion of the examination, please wait for instructions from Invigilator and do not get up from your seat until advised. Thecandidates will be permitted
                            to move out one at a time only. <br>
                            
                            *If religion/customs require you to wear specific attire, please visit centre early for thorough checking. <br>
                            
                            *No Candidate would be allowed to enter the Examination Centre, without Admit Card, Valid ID Proof and proper frisking.Frisking through Handheld Metal
                            Detector (HHMD) will be carried out without touching body. <br>
                            
                            *Candidates are advised to carry only the following items with them into the examination venue:a) Admit Card along with Self Declaration (Undertaking)
                            downloaded from the attached an annexure 1 (a clear printout on A4size paper) duly filled in.b) A simple transparent Ball Point Pen) Additional photograph, to
                            be pasted on attendance sheet) Personal transparent water bottle <br>
                            
                            *Before reaching the Centre, the candidates must enter required details in the Undertaking in legible handwriting, put their signature and paste the Photograph
                            at the appropriate place. They should ensure that their Left-Hand Thumb Impression is clear and not smudged. <br>
                            
                            *Candidate must carry “Any one of the original and valid Photo Identification Proof issued by the government” — PANcard/Driving License/Voter ID/12th Class
                            Board Admit or Registration card/ Passport/ Aadhaar Card (With photograph)/ E-Aadhaar/Ration Card./ Aadhaar Enrolment No. with Photo. All other
                            ID/Photocopies of IDs even if attested/scanned photo of IDs in mobile phone will NOT be considered as valid ID Proof. <br>
                            
                            *Candidates are NOT allowed to carry any personal belongings including electronic devices, mobile phone and other banned/prohibited items listed in the
                            Information Bulletin to the Examination Centre. Examination Officials will not be responsible for safe keep of personal belongings and there will be no such
                            facility. <br>
                            
                            *Shoes/footwear with thick soles and garments with large buttons are NOT permitted. <br>
                            
                            *5 Blank paper sheets for rough work will be provided in the examination Hall/Room. Candidates must write their name and Roll Number at the top of the sheet
                            and must drop in the designated drop box without fail, before leaving the examination Hall/Room.Failure to do so may result in non-evaluation of your answers.
                            *Duly filled Admit Card at the end of examination must be dropped in the designated drop box. Failure to do so may result in non-evaluation of your answers.
                            *No Candidate should adopt any unfair means or indulge in any unfair examination practices as the examination centers are undersurveillance of CCTV and
                            equipped with Jammers. <br>
                            </p>
                        <div style="background-color: #053352; text-align: center; padding: 5px;">
                            <p  style="color: #fff;">For more details call: 9121219858 / 9398112233</p>
                        </div>
                    </div>
                    

                </div>

                
                <div>
                    
                    
                </div>

            </div>
        </section>
        <!-- Section (End) -->


    </main>
    <!-- Main (End) -->


</body>

</html>
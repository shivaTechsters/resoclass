<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Thank You</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{asset('web/css/style.css')}}" type="text/css" />



    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Thank You</title>

</head>

<body>

    <section class="thanks_section">

        <div class="container">


            <div class="thank_header text-center p-3 ">

                <img src="{{asset('web/images/resonance-logo.png')}}" alt="">
            </div>



            <div class="main_part">

                <h3>Thank you for Registering with Resonance Hyderabad
                    for NEET Free Grand Test</h3>



                <h5 class="text-center py-4">YOUR HALL TICKET NO: <b> <span> {{$registration->reso_admit_card_no}} </span> </b></h5>

            </div>


            <div class="user_details">

                <ul class="my-5">

                    <li>NEET Application No <span>{{$registration->neet_application_no}}</span> </li>

                    <li>Reso Admit Card NO <span>{{$registration->reso_admit_card_no}}</span></li>


                    <li>Student Name
                    <span> {{$registration->name}}</span>
                    </li>

                    <li>Father Name <span>{{$registration->father_name}}
                        </span></li>

                    <li>Mobile Number <span>{{$registration->neet_reg_phone}}</span></li>

                    <li>Email <span> {{$registration->email}}</span></li>

                    <li>Exam Date <span> 28-04-2024 2PM - 5:20PM</span></li>

                    <li>Exam Mode <span>Offline</span></li>

                    <li>Exam Centre <span>{{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->name}}</span></li>


                    <li>Download link <span><a href="{{ asset('storage/admit-card/'.$registration->reso_admit_card_no .'-' . date("dmY",strtotime($registration->date_of_birth)) . '.pdf') }}">{{ asset('storage/admit-card/'.$registration->reso_admit_card_no .'-' . date("dmY",strtotime($registration->date_of_birth)) . '.pdf') }}</a></span></li>

                    <li>Address <span>Address: {{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->address}}</span> </li>

                    <li class="mt-5">Location Map <span><a href="{{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->google_maps_link}}">{{\App\Models\ExaminationCenter::find($registration->examination_center_id)?->google_maps_link}}</a></span> </li>
                </ul>



                <p><a href="{{ asset('storage/admit-card/'.$registration->reso_admit_card_no .'-' . date("dmY",strtotime($registration->date_of_birth)) . '.pdf') }}"><button> Download</button></a></p>

            <p class="text-center" style="font-weight:bold;"> Note :  Please Use this Hall Ticket Number for your Future Reference.</p>


<p class="text-center pb-4" style="font-weight:bold;"> Help Desk Number for Queries : <a href="tel:9121219858">9121219858</a></p>
            </div>

        </div>


    </section>

</body>

</html>
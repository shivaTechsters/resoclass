

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('web/css/style.css')}}" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>

    <title>Resonance NEET Grand Test</title>
</head>
<style>
    .panel-card-body {
    background-color: #f0f0f0; /* Background color for the panel card body */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Color shadow effect */
    padding: 20px; /* Adjust padding as needed */
}

.panel-card-table table {
    width: 100%;
    border-collapse: collapse;
}

.panel-card-table th,
.panel-card-table td {
    padding: 10px;
    text-align: left;
}

.panel-card-table th {
    background-color: #f8f9fa; /* Background color for table header */
}

.panel-card-table tbody tr {
    background-color: #fff; /* Background color for table rows */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect for table rows */
}

.panel-card-table td:last-child {
    /* text-align: center; */
}

/* Styles for the dropdown menu */
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 5px;
    z-index: 1;
}

.dropdown-menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.dropdown-menu ul li {
    margin-bottom: 5px;
}

.dropdown-menu a {
    display: block;
    padding: 5px;
    color: #333;
    text-decoration: none;
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}
.table-row td {
    width: 50%; /* Adjust the width as needed */
}
.data-table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Light background color for even rows */
}

.data-table tbody tr:nth-child(odd) {
    background-color: #ffffff; /* Dark background color for odd rows */
}

</style>

<body>
    <section class="header">
        <div class="container-fluid">
            <img src="{{asset('web/images/logo.png')}}" alt="" class="logo" />
            <!-- <img src="./assets/img/logo.jpg" alt="" class="logo"> -->
        </div>
    </section>
    <div class="srm-search">
        <a class=" btn-lg btn-theme" href="javascript:history.back()">Back To Search</a>
    </div>
    <section class="Resonance_neet_form_section">
        <div class="container">
            <div class="col-md-2 m-auto">
            </div>

                <div class="col-md-8 m-auto">
                    
                    <div class="panel-card-body">
                        <div class="panel-card-table">
                            <table class="data-table ">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servic_requsets as $key => $examination_center)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $examination_center->name }}</td>
                                            <td>{{ $examination_center->message }}</td>
                                            <td>{{ $examination_center->status_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>


    <section class="footer">


        <div class="footer_div">
            <h1>For More Details Call :  <lord-icon src="https://cdn.lordicon.com/tftaqjwp.json" trigger="loop" colors="primary:#ffffff" style="width:20px;height:20px">
                    </lord-icon>
                    <a href="tel:9121219858">  9121219858 , </a>
                    <a href="tel:9398112233">  9398112233</a> </h1>

        </div>

    </section>
    

    
</body>

</html>

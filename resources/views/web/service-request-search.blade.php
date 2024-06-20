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
    <style>
        body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background: linear-gradient(to right, #2980b9, #6dd5fa); 
    box-shadow: rgb(211 227 253 / 97%) 0 0 0 1000px inset;

}

.search-box {
    width: 100%;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Box shadow for depth effect */
}
button, select {
    display: unset !important;
}

input[type="text"] {
    width: 70%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
}
form {
    display: flex;
    justify-content: center;
}

button {
    padding: 10px 20px;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition effect */
}

button:hover {
    background-color: #2980b9; /* Darker shade on hover */
}
    </style>
</head>
<body>
    <section class="header">
        <div class="container-fluid">
            <img src="{{asset('web/images/logo.png')}}" alt="" class="logo" />
            <!-- <img src="./assets/img/logo.jpg" alt="" class="logo"> -->
        </div>
    </section>
    <div class="srm-search">
        <a class=" btn-lg btn-theme" href="javascript:history.back()">Back To Home</a>
    </div>
    <section>
    <div class="container">
        <div class="search-box">
            <form action="{{ route('web.view.servicrequsetsu') }}" method="GET"> <!-- Specify the method and action -->
                <input type="text" name="query" placeholder="Search Request ID..."> <!-- Name attribute added for form submission -->
                <button type="submit">Search</button> <!-- Changed to type="submit" for form submission -->
            </form>
        </div>
    </div>
</section>
</body>
</html>
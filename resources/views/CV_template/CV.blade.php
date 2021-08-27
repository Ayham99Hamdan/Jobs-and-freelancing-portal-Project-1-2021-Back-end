<html>
    <head>
        <title>
            Your CV
        </title>
        <link rel="stylesheet" href="{{asset('css/cv.css')}}">
    </head>
    <body>
        <div class="container">
            <div class="primary-data">
                <div class="full-name">
                    <h1>{{$full_name}}</h1>
                    <h4>Full Stack Back end</h4>
                </div>
                <div class="avatar">
                    <img src="{{$avatar_url}}" alt="Full-name">
                </div>
            </div>
            <div class="information">
                <div class="phone">
                   Phone : {{$phone}}
                </div>

                <div class="email">
                    Email : {{$email}}
                 </div>
            </div>
        </div>
    </div>
    </body>
</html>
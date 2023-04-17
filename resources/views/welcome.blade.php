<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Website Dikerba</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ACE1AF;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            h2 {
                text-align: left;
            }
            p {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Website Dikerba
                </div>

                <p>
                    Unit Pendidikan dan Pelatihan (Diklat) adalah sebuah unit yang memiliki fungsi
                    menyelenggarakan kegiatan-kegiatan pendidikan dan pelatihan baik yang sasarannya
                    ke dalam maupun keluar rumah sakit. Unit Diklat memiliki tugas sebagai berikut :
                </p>
                <p>
                    1. Memfasilitasi penyelenggaraan berbagai kegiatan pendidikan
                    dan pelatihan baik internal maupun eksternal rumah sakit.
                </p>
                <p>
                    2. Memfasilitasi pelaksanaan kegiatan pendidikan dan
                    pelatihan bagi unit-unit / bagian / bidang instalasi yang membutuhkan.
                </p>
                <p>
                    3. Membuat perencanaan berbagai kegiatan pendidikan
                    dan pelatihan berdasarkan kebutuhan internal dan eksternal rumah sakit.
                </p>
                <p>
                    4. Memfasilitasi kebutuhan pendidikan seperti sarana dan
                    prasarana gedung dan peralatan yang dibutuhkan dalam proses pendidikan dan pelatihan.
                </p>
            </div>
        </div>
    </body>
</html>

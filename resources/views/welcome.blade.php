<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->

</head>

<body class="antialiased">
    @if (Session::get('id'))

        <div class="col text-center">
            <br>
            <h4>{{ Session::get('name') }}</h4>
        </div>

        <div class="card" style="margin: 3%;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">State</th>
                        <th scope="col">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($deposit as $a)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $a->order_id }}</td>
                            <td>{{ $a->amount }}</td>
                            <td>{{ $a->state }}</td>
                            <td>{{ $a->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
        <div class="col text-center">
            <form action="/logout" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-primary text-center">LogOut</button>
            </form>
        </div>
    @else
        <div style="margin-left: 30%;
        margin-right: 30%;
        margin-top: 10%;">
            <form action="/login" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="Dani Lukman hakim"
                        aria-describedby="emailHelp" placeholder="Enter FullName">
                </div>
                <button type="submit" class="btn btn-primary submitToken">Submit</button>
            </form>
        </div>

    @endif

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>

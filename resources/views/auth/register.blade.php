<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Register Chick's Coops</title>
  <link rel="shortcut icon" type="image/png" href="{{asset ('images/logos/yellow_chicken-removebg.png') }}" />
  <link rel="stylesheet" href="{{asset ('css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-5 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html"  class="text-nowrap logo-img text-center d-block py-3">
                  <div class="" style="display: flex; flex-direction: row; align-items: center; justify-content: center">
                    <h1 style="color: #ffd648;">CHICK'S</h1>
                    <img src="{{asset('images/logos/yellow_chicken-removebg.png') }}" style="width: 28%" alt="">
                    <h1 style="color: #ffd648;">COOPS</h1>
                  </div>
                </a>

                <p class="text-center" style="font-size: 20px;">Register Here</p>
                <form action="{{url('/auth/register')}}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    @if ($errors->has('name'))
                    {{$errors->first('name')}}
                    @endif
                  <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  @if ($errors->has('email'))
                  {{$errors->first('email')}}
                    @endif
                  <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  </div>
                  @if ($errors->has('password'))
                  {{$errors->first('password')}}
                    @endif
                  <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label">Re-enter password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1">
                  </div>
                  @if ($errors->has('password'))
                  {{$errors->first('password')}}
                    @endif
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    {{-- <div class="form-check">
                      <input class="form-check-input warning" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div> --}}
                    {{-- <a class="text-warning fw-bold" href="./index.html">Forgot Password ?</a> --}}
                  </div>
                  <button type="submit" class="btn btn-warning w-100 py-8 fs-4 mb-4 rounded-2">Register Now</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an account?</p>
                    <a class="text-warning fw-bold ms-2" href="/login">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>

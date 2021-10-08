@extends('master.master')
@section('title','profile')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-12 col-md-5 m-auto mt-5 ">
            <div class="card shadow-sm border border-0 py-2 px-2">

                <div class="card-body pt-0 scroll">
                    <div class="d-flex align-items-center flex-column ">
                        <form name='form' action="{{ route('changeImg') }}" class="d-flex justify-content-center align-items-center " method="post" enctype="multipart/form-data">
                           @csrf
                            <input onchange="form.submit()" type="file" name="photo" class="photo" hidden accept="image/jpg,image/png,image/jpeg," >
                            <img src="/image/{{ $auth->photo }}" onclick="changeImg()" class="border w-75  rounded-circle me-2" alt="">
                        </form>
                        <div class="d-flex flex-column align-items-center  ">
                            <span class="fs-5 text-capitalize my-2 fw-bolder ">{{ $auth->name }}</span>
                            <span class="fs-5  mb-0 ">{{ $auth->email }}</span>
                            <a href="{{ route('home') }}" class=" btn btn-outline-dark mt-4 ">
                                <i class="fa fa-arrow-left fs-6 "></i>
                                Back
                            </a>
                            <span class=" mt-5 text-black-50"> copyright &copy; all right reserved 2021 </span>
                        </div>
                    </div>

                </div>
         
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
  <script>
      function changeImg(){
        $('.photo').click();
      }
  </script>
@endsection
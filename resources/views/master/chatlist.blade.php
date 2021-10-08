@extends('master.master')


@section('content')

<div class="container">
    <div class="row ">
        <div class="col-12 col-md-5 m-auto mt-5 ">
            <div class="card shadow-sm border border-0 py-2 px-2">
                <div class="card-header bg-transparent border-0">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">
                            <a href="{{ route('profile') }}" class="">
                                <img src="/image/{{ $man->photo }}" class="border rounded-circle profileImg  me-2" alt="">
                            </a>
                            <div class="d-flex flex-column ">
                                <span class="fs-5 lead  text-capitalize mb-0 ">{{ $man->name }}</span>
                                @if ($man->active)
                                    <span class=" fs-6 text-success">Active Now</span>
                                    @else
                                    <span class=" fs-6 text-muted">Offline Now</span>
                                @endif
                            </div>
                        </div>

                        <div class="">
                            <form action="{{ route('chat.goaway') }}" method="POST">
                                @csrf
                               <button class="btn btn-outline-dark">Logout</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="card-body pt-0 scroll">
                                            
                    <div class="form-group position-relative mb-3">
                        <input type="text" class="form-control search" placeholder="Search someone ..." id="search">
                        <i class="fa fa-search position-absolute mb-0 searchBtn" style="top: 10px; right: 10px; cursor: pointer;" id="eye"></i>
                    </div>

                    <div class="box">
                        {{-- @foreach($all as $a)
                        @if ($a->id != $man->id)
                        <a href="{{ route('chating',$a->id) }}" class="text-decoration-none text-dark ">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="/image/{{ $a->photo }}" class="border rounded-circle otherImg  me-2" alt="">
                                    <div class="d-flex flex-column ">
                                        <span class="fs-6 mb-0 text-capitalize ">{{ $a->name }}</span>
                                        <span class="fw-light  fs-6 text-muted">Hello How are You?</span>
                                    </div>
                                </div>
                                <div class="">
                                    <i class="fa fa-circle active {{ $a->active ? 'text-success' : 'text-muted' }} mx-3"></i>
                                </div>
                            </div>
                        </a>
                        @endif 
                        @endforeach --}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        let allUser = @json($all);

        $('.search').keypress(function(){
            let value = $('.search').val().toLowerCase(); 
            let url = '{{ route('home') }}';

            if(value.length >1){   
             $.get(url,{'search' : value},function(data){
             console.log(data);
             userLoop(data);
             })
            }
            userLoop(allUser);
         
        })

        $('.searchBtn').on('click',function(){
         let value = $('.search').val().toLowerCase(); 
         let url = '{{ route('home') }}';

         $.get(url,{'search' : value},function(data){
             console.log(data);
             userLoop(data);
         })


        })
        
        function userLoop(x){
            $('.box').html('');             
                x.map(el=>{
                    if(el.id != '{{$man->id}}'){
                    $('.box').append(`
                    <a href="/chating/${el.id}" class="text-decoration-none text-dark ">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="/image/${el.photo}" class="border rounded-circle chatlistImg  me-2" alt="">
                                    <div class="d-flex flex-column ">
                                    <span class="fs-6 mb-0 text-capitalize ">${el.name}</span>
                                    <span class="fw-light  fs-6 text-muted">
                                    ${el.message[el.message.length-1].description}
                                    </span>
                                </div>
                            </div>
                            <div class="">
                                <i class="fa fa-circle active ${el.active ==1  ? 'text-success' : 'text-muted'} mx-3"></i>
                            </div>
                        </div>
                    </a>
                    
                `)

                }
            })
        }

        userLoop(allUser);
    </script>
@endsection
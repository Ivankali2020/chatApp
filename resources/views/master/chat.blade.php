@extends('master.master')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-12 col-md-6  col-xl-4 m-auto mt-5 ">
            <div class="card shadow-sm border border-0 ">
                <div class="card-header bg-white chatHead shadow-sm ">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">
                            <a href="{{ route('home') }}" class="text-dark">
                                <i class="fa fa-arrow-left fs-6 me-3"></i>
                            </a>
                           
                                <img src="/image/{{ $user->photo }}" class="border rounded-circle profileImg  me-2" alt="">
                            
                            <div class="d-flex flex-column ">
                                <span class="fs-5 lead text-capitalize  mb-0 ">{{ $user->name }}</span>
                                @if ($user->active)
                                <span class=" fs-6 text-success">Active Now</span>
                                @else
                                <span class=" fs-6 text-muted">Offline Now</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    
                </div>
              <div class="card-body pt-0 scroll position-relative  ">
                    <div class="message d-flex flex-column ">
                   
                        <!-- //receive message  -->
                        {{-- <div class="mt-3 d-flex align-items-end ">
                            <div class="align-items-end">                                   
                                <img src="/image/{{ $user->photo }}" class="border rounded-circle otherImg  me-2" alt="">
                            </div>
                            <div class="incoming p-2 bg-light w-75 align-self-end mt-3 ">
                                <p class="mb-0" style="text-align: justify;">
                                    hello how are your enderit laboa
                                </p>
                            </div>
                        </div> --}}
                        <!-- //send message  -->
                        {{-- <div class="outcoming p-2 bg-light w-75 align-self-end mt-3 ">
                            <p class="mb-0" style="text-align: justify;">
                                Lorem ipsum dolor, etur adipisicing elit.  
                                
                            </p>
                        </div> --}}

                    </div>
                    
              </div>
              <!-- this is send message place -->
                <div class="card-footer bg-white border-0 border-none  ">
                    {{-- <form action="{{ route('message.store') }}" method="POST">
                        @csrf --}}
                        <div class="d-flex justify-content-between ">

                            <textarea required name='description' class="form-control me-3 text-muted textarea" autofocus style="height: 20px;">  </textarea>
                            <button  class="sendBtn btn btn-dark d-flex justify-content-center align-items-center">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                            
                        </div>  
                    {{-- </form> --}}
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection

@section('script')

<script>

    let receiver = '{{ $auth->id }}';
    let sender = '{{ $user->id }}';
    $('.sendBtn').click(function(e){
        e.preventDefault();
        
        let description = $('.textarea').val();
        let link = '{{ route("message.store") }}';
        $('.textarea').val('');
        $.ajax({
            'url' : link,
            'method' : 'POST',
            'data' : { 
                'sender' :sender ,
                'receiver' : receiver,
                'description' : description,
                '_token' : '{{ csrf_token() }}',
            },
          
        }).done(function(data){
            loop(); 
            
        })
    })


    function loop(){
        let allurl = "{{ route('all.message') }}";

            $.get(allurl,{
                'sender' :sender ,
                'receiver' : receiver,
            },function(res){
                // let send = res.s;
                // let receive = res.r;
                // let arrayAll = send.concat(receive);
                // console.log(arrayAll)
                console.log(res);   
                $('.message').html('');
                res.map(el => {
                    console.log(sender,receiver)
                    if(el.sender == sender){
                        $('.message').append(`
                          <div class="text-end  w-75 align-self-end mt-3 ">
                            <p class="mb-0 text-end p-2  bg-dark text-white d-inline outcoming " >
                                ${el.description}                                
                            </p>
                          </div> 
                        `)
                    }else {
                        $('.message').append(`
                        <div class="mt-3 d-flex ">
                            <div class=" ">                                   
                                <img src="/image/{{ $user->photo }}" class="border rounded-circle otherImg  me-2" alt="">
                            </div>
                            <div class=" w-75 align-self-end mt-3 ">
                                <p class="mb-0 text-end p-2  bg-light d-inline incoming border border-muted   " >
                                ${el.description}                                
                            </p>
                            </div>
                        </div> 
                        `)
                    }
                  
                })
            })
       
    }
    loop();
    // setInterval(()=>{
    //     loop();
    // },500)



</script>

@endsection
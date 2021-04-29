@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                      <div class="card-body">
                            
                            <h1>items added for auction </h1>

                            @if(count($auctionitems)>0)
                                
                                    @foreach ($auctionitems as $item)

                                    
                                        <div class="well">

                                            <div class="row">
                                                <div class="col-md-4 col-sml-4">
                                                    <img style="width:100% " src="/storage/image/{{$item->image}}">

                                                </div>

                                                <div class="col-md-8 col-sml-8">
                                                   
                                                    <h3><a href="/items/{{$item->id}}">{{$item->name}}</a></h3>
                                                    <a href="{{route('bid',$item->id)}}" class="btn btn-primary">BID</a>
                                                    
                                                </div>

                                                </div>


                                            
                                        </div>   
                                    
                                       
                                    @endforeach
                               
                               
                            @else
                                <p>No posts found </p>
                            @endif
                      </div>
                     </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection



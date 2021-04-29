@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   
                    
                        
                    
                    <a href="/items" class="btn btn-primary ">Back</a>

                    <h1>{{$item->name}}</h1>
                    <img style="width:100% " src="/storage/image/{{$item->image}}">
                    <br>
                    <br>
                    <div>
                    <small>About : {{$item->description}}</small><br>
                    </div>
                    <hr>
                    <small>Updated at {{$item->created_at}}</small>
                    <hr>

                    <a href="/items/{{$item->id}}/edit" class="btn btn-primary">Edit</a>


                    <form method="POST" action= "{{route('items.destroy',$item->id)}}">

                        
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                       
                        
                        
                        
                            <div class="pull-right">
                             
                                <button type="submit" class="btn btn-danger">
                                   
                                    {{ __('DELETE') }}
                                </button>
                            </div>
                        
                    </form>

                   
                        
                        
                        
                     <a href="{{route('addauction',$item->id)}}" class="btn btn-primary">Add to Auction</a>
                        
                   


                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


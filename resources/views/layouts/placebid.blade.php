
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                                        
                    <h1>Place your BID</h1>

                    
                   
                        
                    

                    <form method="POST" action= "{{route('Auction.update',$item->id)}}" enctype="multipart/form-data">
                        @csrf
                        
                        <input name="_method" type="hidden" value="PUT">

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Product Price</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('name') is-invalid @enderror" name="price"  required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                             
                                <button type="submit" class="btn btn-primary">
                                   
                                    {{ __('Place your BID') }}
                                </button>
                            </div>
                        </div>
                    </form>


                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



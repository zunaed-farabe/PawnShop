@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                                        
                    <h1>Edit Intem Info</h1>

                    
                   
                        
                    

                    <form method="POST" action= "{{route('items.update',$item->id)}}" enctype="multipart/form-data">
                        @csrf
                        
                        <input name="_method" type="hidden" value="PUT">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Product Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $item->description }}" required >

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                 <input id="image" type="file" class="form-control @error('description') is-invalid @enderror" name="image" >

                           
                            </div>
                         </div>
                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                             
                                <button type="submit" class="btn btn-primary">
                                   
                                    {{ __('Update') }}
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



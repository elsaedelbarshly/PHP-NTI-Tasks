@extends('layouts.parent')
@section('title', 'Create Product')

@section('content')
    {{-- <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> --}}
    @include('includes.response-messages')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="name_en">Name En</label>
                            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                                id="name_en" value="{{ old('name_en') }}">
                            @error('name_en')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="name_ar">Name Ar</label>
                            <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                                id="name_ar"  value="{{ old('name_ar') }}">
                            @error('name_ar')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="code">Product Code</label>
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                id="code"  value="{{ old('code') }}">
                            @error('code')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price"  value="{{ old('price') }}">
                            @error('price')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="status">Status</label>
                            <select name="status" class='form-control @error('status') is-invalid @enderror' id="status">
                                <option {{ old('status') === '1' ? 'selected' : '' }} value="1">Active</option>
                                <option  {{ old('status') === '0' ? 'selected' : '' }} value="0">Not Active</option>
                            </select>
                            @error('status')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="brand_id">Brands</label>
                            <select name="brand_id" class='form-control @error('brand_id') is-invalid @enderror'
                                id="brand_id">
                                <option disabled selected>Choose Brand</option>
                                @foreach ($brands as $brand)
                                    <option {{ old('brand_id') == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="sub_category_id">Sub Categories</label>
                            <select name="sub_category_id" class='form-control @error('sub_category_id') is-invalid @enderror'
                                id="sub_category_id">
                                <option disabled selected>Choose Subcategory</option>
                                @foreach ($subcategories as $subcategory)
                                    <option {{ old('sub_category_id') == $subcategory->id ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                                @endforeach
                            </select>
                            @error('sub_category_id')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="des_en">Description En</label>
                            <textarea cols="30" rows="10" name="des_en"
                                class="form-control @error('des_en') is-invalid @enderror" id="des_en">{{old('des_en')}}</textarea>
                            @error('des_en')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="des_ar">Description Ar</label>
                            <textarea cols="30" rows="10" name="des_ar"
                                class="form-control @error('des_ar') is-invalid @enderror" id="des_ar">{{old('des_ar')}}</textarea>
                            @error('des_ar')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @error('image')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary" name="submit" value="index">Create Product</button>
                    <button type="submit" class="btn btn-outline-dark" name="submit" value="back">Create & New</button>
                </div>
            </form>
        </div>
    </div>
@endsection

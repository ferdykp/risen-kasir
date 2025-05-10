@extends('layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header mt-2">
                        <div class="w-100 w-md-auto ">
                            <h4 class="">Add Product</h4>
                            <hr class="bg-danger border-2 border-top border-danger" />
                        </div>

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Product Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">Kategori</label>
                                <div class="col-md-6">

                                    <select name="category" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price
                                </label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">
                                    Stock</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="picture" class="col-md-4 col-form-label text-md-right">Product Image</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('picture') is-invalid @enderror"
                                        name="picture" accept="image/*">
                                    @error('picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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

@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 card p-3 shadow-sm rounded">

                <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="text-center rounded"><img class="img-profile mb-1 w-25" id="output" src="">
                            </div>
                            <input type="file" name="image" accept="image/*" id=""
                                class="form-control mt-1 @error('image')
                                                    is-invalid
                                        @enderror "
                                onchange="loadFile(event)">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                @enderror

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name...">
                                        @error('name')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <select name="categoryId" id=""
                                            class="form-control @error('categoryId')
                                                is-invalid
                                                @enderror">
                                            <option value="">Choose Category...</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('categoryId') == $item->id) selected @endif>{{ $item->name }}
                                                </option>
                                            @endforeach
                                            @error('categoryId')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="price" value="{{ old('price') }}"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="Enter Price...">
                                        @error('price')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Stock</label>
                                        <input type="text" name="stock" value="{{ old('stock') }}"
                                            class="form-control @error('stock') is-invalid @enderror"
                                            placeholder="Enter Stock...">
                                        @error('stock')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="" cols="30" rows="10"
                                    class="form-control @error('description') is-invalid @enderror " placeholder="Enter Description...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="submit" value="Create Product"
                                    class=" btn btn-primary w-100 rounded shadow-sm">
                            </div>
                        </div>
                </form>

                <form action="{{route('products.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control @error('file')
                                                    is-invalid
                                        @enderror"  type="file" name="file" >
                                         @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                @enderror
                    <button class="mt-3 btn-sm btn btn-primary" type="submit">Import Products</button>
                </form>


            </div>

        </div>
    </div>
@endsection

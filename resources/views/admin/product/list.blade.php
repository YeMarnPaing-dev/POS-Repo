@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <button class=" btn btn-secondary rounded shadow-sm"> <i class="fa-solid fa-database"></i>
                    Product Count ({{ count($products) }}) </button>
                <a href="{{ route('product#list') }}" class=" btn btn-outline-primary  rounded shadow-sm">All Products</a>
                <a href="{{ route('product#list', 'lowAmt') }}" class=" btn btn-outline-danger  rounded shadow-sm">Low Amount
                    Product List</a>
                <a href="{{ route('product#list', 'highAmt') }}" class=" btn btn-outline-primary  rounded shadow-sm">High
                    Amount Products</a>
                <a href="{{ route('product.export') }}" class="mt-2 btn btn-outline-success  rounded shadow-sm">Download
                    Excel</a>

            </div>
            <div class="">
                <form action="{{ route('product#list') }}" method="get">

                    <div class="input-group">
                        <input type="text" name="searchKey" value="{{ request('searchKey') }}" class=" form-control"
                            placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($products) > 0)
                            @foreach ($products as $item)
                                <tr>
                                    <td> <img src="{{ asset('productImage/' . $item->image) }}"
                                            class=" img-thumbnail rounded shadow-sm" style="width:100px" alt="">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}mmk</td>
                                    <td class="col-2">
                                        <button type="button" class="btn btn-secondary position-relative">
                                            {{ $item->stock }}
                                            @if ($item->stock <= 3)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    Low amt stock
                                                </span>
                                            @endif

                                        </button>
                                    </td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>

                                        <a href="{{ route('product#detail', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary"> <i class="fa-solid fa-eye"></i> </a>
                                        <a href="{{ route('product#edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-secondary"> <i
                                                class="fa-solid fa-pen-to-square"></i> </a>
                                        <a href="{{ route('product#delete', $item->id) }}"
                                            class="btn btn-sm btn-outline-danger"> <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h5 class="text-muted text-center">There is no products</h5>
                                </td>
                            </tr>
                        @endif






                    </tbody>
                </table>



            </div>
        </div>
    </div>

@endsection

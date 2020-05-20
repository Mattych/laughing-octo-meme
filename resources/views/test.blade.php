@extends('layouts.app')

@section('content')

    <div class="container-fluid w-75 ">   
        <!-- First Row -->
        <h1 class="text-center mt-2">A Relief Goods Distribution System</h1>
        <div class="row">
            <!-- First Column -->
            <div class="col-2 pt-2 pb-2">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        Navigation
                    </div>
                    <div class="card-body">
                        @guest
                        <a href="{{route('login')}}"><button class="btn btn-block btn-donate mb-2">Donate Now</button></a>
                        @else
                        <a href="{{url('donations_table')}}"><button class="btn btn-block btn-donate mb-2">Donate Now</button></a>
                        <a href="{{url('goods_table')}}"><button class="btn btn-block btn-manage p-2">Relief Goods Management</button></a>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- First Column -->
            <div class="col-10 pt-2 pb-2">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <div id="distributionPictures" class="carousel slide shadow-sm" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#distributionPictures" data-slide-to="0" class="active"></li>
                                <li data-target="#distributionPictures" data-slide-to="1"></li>
                                <li data-target="#distributionPictures" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active ">
                                <img src="img/distribution1.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item ">
                                <img src="img/distribution2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item ">
                                <img src="img/distribution3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            
                            <a class="carousel-control-prev" href="#distributionPictures" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>

                            <a class="carousel-control-next" href="#distributionPictures" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <i>“One of the most important things you can do on this earth is to let people know they are not alone.” -― Shannon L. Alder</i>
                    </div>
                </div>

            </div>
            <!-- First Column -->
        </div>
        <!-- First Row -->
        <div class="row mt-3">

        </div>
    </div>

@endsection
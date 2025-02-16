@extends('layouts.admin')
@section('head')
    <style>
        .works-card {
            background: #e3f1ff;
            box-shadow: 0 0 5px #00000047;
            border-radius: 9px;
            padding: 25px;
            text-align: center;
        }
        .works-card p {
            font-size: 20px;
            margin-bottom: 0;
        }
        .works-card .btn{
            margin-top: 15px;
        }
        .arrowicon.arrow1 {
            text-align: center;
        }

        .arrowicon.arrow2 {
            text-align: right;
        }
        .arrowD {
            display: block;
        }
        .arrowM {
            display: none;
        }
        @media screen and (max-width:767px){
            .works-card{
                padding: 20px;
            }
            .Mheight {
                height: 94px;
            }
            .marrow2 {
                max-width: 60%;
                margin: 0 auto;
            }
            .arrowD {
                display: none;
            }
            .arrowM {
                display: block;
            }
            .arrowM .arrowicon.arrow2 {
                text-align: center;
                max-width: 55%;
                margin-left: 75px;
            }
            .arrowM5 .arrowicon.arrow2{
                margin-left: 0px;
                margin-right: 75px;
            }
            .arrowicon.arrow1 img {
                height: 45px;
            }
            .works-card p {
                font-size: 18px;
                margin-bottom: 0;
            }
            .works-card .btn {
                margin-top: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="flowchart">
        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p>Add <b>Customer / Company</b></p>
                        <a href="{{route('admin.customers.create')}}" class="btn btn-primary">Click here</a>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p>Add Equipment <b>Order</b></p>
                        <a href="{{route('admin.orders.create')}}" class="btn btn-primary">Click here</a>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                    <div class="arrowicon arrow1 marrow2">
                        <img src="{{asset('assets/images/arrow-H.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-6 auto">
                    <div class="works-card one">
                        <p>Order From <b>Inventory</b></p>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-sm-4 col-6 auto">
                    <div class="works-card one">
                        <p>Order From <b>Factory</b></p>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-6 auto">
                    <div class="works-card one">
                        <p>Update Order <b>Status</b></p>
                    </div>
                    <div class="arrowicon arrow2 arrowD">
                        <img src="{{asset('assets/images/arrow-VH.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-sm-4 col-6 auto">
                    <div class="works-card one Mheight">
                        <p>Generate <b>PO</b></p>
                    </div>
                    <div class="arrowicon arrow4 arrowD">
                        <img src="{{asset('assets/images/arrow-VH2.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-sm-6 col-6 auto arrowM">
                    <div class="arrowicon arrow2 ">
                        <img src="{{asset('assets/images/arrow-VH.png')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-sm-6 col-6 auto arrowM arrowM5">
                    <div class="arrowicon arrow2">
                        <img src="{{asset('assets/images/arrow-VH2.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p><b>Equipment</b></p>
                        <a href="{{route('admin.equipments.index')}}" class="btn btn-primary">Click here</a>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p><b>Add Job</b></p>
                        <a href="{{route('admin.jobs.create')}}" class="btn btn-primary">Click here</a>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p><b>Assign Technician</b> to Job</p>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p>Technician will <b>accept / Reject</b> Job</p>
                    </div>
                    <div class="arrowicon arrow1">
                        <img src="{{asset('assets/images/arrow-V.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-12 auto">
                    <div class="works-card one">
                        <p>Technician update EPOD & <b> Mark Job Completed</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('page_title')
    <h3><span class="badge badge-light" style="font-weight: bold"></span>
    </h3>
@endsection


@section('header')
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            // justify-content: center;
            justify-content: space-evenly;
            gap: 40px;
            /* Space between cards */
            padding: 20px;
        }

        .custom-card {
            background: linear-gradient(145deg, #ffffff, #d9dce1);
            border-radius: 15px;
            box-shadow: 8px 8px 16px #b1b4bb, -8px -8px 16px #ffffff;
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-10px);
        }

        .custom-card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .custom-card-icon {
            background-color: #5a67d8;
            border-radius: 50%;
            padding: 15px;
            margin-bottom: 20px;
        }

        .custom-card-icon i {
            color: #ffffff;
            font-size: 2rem;
        }

        .custom-card-text h3 {
            font-size: 1.5rem;
            color: #424874;
            margin: 0;
        }

        .custom-card-text p {
            font-size: 1rem;
            color: #6b778d;
            margin: 5px 0 0;
        }

        .custom-card-footer {
            background-color: #5a67d8;
            padding: 10px;
            text-align: center;
        }

        .custom-badge {
            background-color: #edf2f7;
            color: #5a67d8;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
@endsection


@section('content')
    <div class="card">

        <div class="card-container">
            <div class="custom-card">
                <div class="custom-card-content">
                    <div class="custom-card-icon">
                        <i class="fa fa-box-tissue"></i>
                    </div>
                    <div class="custom-card-text">
                        <a href="#">
                            <h3>Home</h3>
                        </a>

                    </div>
                </div>
                <div class="custom-card-footer">
                    <span class="custom-badge">10</span>
                </div>
            </div>
            <div class="custom-card">
                <div class="custom-card-content">
                    <div class="custom-card-icon">
                        <i class="fa fa-money-check"></i>
                    </div>
                    <div class="custom-card-text">
                        <a href="#about">
                            <h3>About</h3>
                        </a>

                    </div>
                </div>
                <div class="custom-card-footer">
                    <span class="custom-badge">20</span>
                </div>
            </div>

            <div class="custom-card">
                <div class="custom-card-content">
                    <div class="custom-card-icon">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <div class="custom-card-text">
                        <a href="">
                            <h3>Contact</h3>
                        </a>

                    </div>
                </div>
                <div class="custom-card-footer">
                    <span class="custom-badge">60</span>
                </div>
            </div>
            <div class="custom-card">
                <div class="custom-card-content">
                    <div class="custom-card-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="custom-card-text">
                        <a href="">
                            <h3>Photos</h3>
                        </a>

                    </div>
                </div>
                <div class="custom-card-footer">
                    <span class="custom-badge">5</span>
                </div>
            </div>

            <!-- Add more cards as needed -->
        </div>
    </div>
@endsection

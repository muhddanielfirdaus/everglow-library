@extends('user.layouts.main')

@section('content')

<div style="
    min-height: calc(100vh - 180px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 40px;
">

    <!-- LOGO -->
    <img src="{{ asset('images/logo.png') }}" width="220" style="margin-bottom: 30px;">

    <!-- MOVING WELCOME TEXT -->
    <div class="moving-wrapper">
        <div class="moving-text">
            Welcome to Everglow Academy Library Management System !!
        </div>
    </div>

    <!-- MOTTO -->
    <h2 style="
        font-size: 32px;
        color: #FFFACD;
        font-style: italic;
        margin-bottom: 25px;
    ">
        The Truth Will Make You Free !!
    </h2>

    <!-- DESCRIPTION -->
    <p style="
        font-size: 18px;
        color: white;
        max-width: 900px;
        line-height: 1.8;
        margin-bottom: 35px;
    ">
        Everglow Academy is a private research university in Sydney, Australia.
        As a member of the "SKY" universities, Everglow Academy is deemed one of
        the three most prestigious institutions in the country.
        It is particularly respected in the studies of medicine and engineering.
    </p>

    <!-- CONTACT BUTTON -->
    <a href="mailto:enquiries@EverglowAcademy.edu.my"
       style="
            background-color: #A0522D;
            color: white;
            padding: 14px 35px;
            border-radius: 8px;
            font-size: 18px;
            text-decoration: none;
            font-weight: bold;
       ">
        CONTACT US
    </a>

</div>

@endsection

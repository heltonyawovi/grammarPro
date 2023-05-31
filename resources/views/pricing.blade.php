@extends('layouts.horizontal')

@section('page-css')
<link rel="stylesheet" href="{{asset('css/pages/pricing.css')}}">
@endsection

@section('main-content')

<div class="page-heading">
    <h3>Our pricing</h3>
</div>

<section id="pricing-page" class="mb-24">
    <div class="pricing-container">
        <div class="pricing-column">
            <div class="pricing-card basic">
                <div class="pricing-header">
                    <span class="plan-title">Open plan</span>
                    <div class="price-circle">
                        <span class="price-title">
                            <small>¥</small><span>0</span>
                        </span>
                        <span class="info">/ Month</span>
                    </div>
                </div>
                <div class="badge-box">
                    <span>No account needed</span>
                </div>
                <!-- <div class="badge-box">
                    <span>Save 35%</span>
                </div> -->
                <ul>
                    <li>
                        <strong>1</strong> Request per month
                    </li>
                    <li>
                        <strong>5</strong> Reference sources
                    </li>
                    <li>
                        <strong>Unlimited</strong> Exportation
                    </li>
                    <li>
                        <strong>Unlimited</strong> Result filtering
                    </li>
                    <li>
                        <strong>No</strong> API Access
                    </li>
                </ul>
                <div class="buy-button-box">
                    <a href="#" class="buy-now">Start now</a>
                </div>
            </div>
        </div>
        <div class="pricing-column">
            <div class="pricing-card echo">
                <div class="pricing-header">
                    <span class="plan-title">Free plan</span>
                    <div class="price-circle">
                        <span class="price-title">
                            <small>¥</small><span>0</span>
                        </span>
                        <span class="info">/ Month</span>
                    </div>
                </div>
                <div class="badge-box">
                    <span>Needs a free account</span>
                </div>
                <ul>
                    <li>
                        <strong>Unlimited</strong> Requests per month
                    </li>
                    <li>
                        <strong>5</strong> Reference sources
                    </li>
                    <li>
                        <strong>Unlimited</strong> Exportation
                    </li>
                    <li>
                        <strong>Unlimited</strong> Result filtering
                    </li>
                    <li>
                        <strong>Limited</strong> API Access
                    </li>
                </ul>
                <div class="buy-button-box">
                    <a href="#" class="buy-now">Register now</a>
                </div>
            </div>
        </div>
        <div class="pricing-column">
            <div class="pricing-card pro">
                <div class="popular">POPULAR</div>
                <div class="pricing-header">
                    <span class="plan-title">Starter plan</span>
                    <div class="price-circle">
                        <span class="price-title">
                            <small>¥</small><span>500</span>
                        </span>
                        <span class="info">/ Month</span>
                    </div>
                </div>
                <div class="badge-box">
                    <span>Save 8%</span>
                </div>
                <ul>
                    <li>
                        <strong>Unlimited</strong> Requests per month
                    </li>
                    <li>
                        <strong>Unlimited</strong> Reference sources
                    </li>
                    <li>
                        <strong>Unlimited</strong> Exportation
                    </li>
                    <li>
                        <strong>Unlimited</strong> Result filtering
                    </li>
                    <li>
                        <strong>Limited</strong> API Access
                    </li>
                </ul>
                <div class="buy-button-box">
                    <a href="#" class="buy-now">Subscribe now</a>
                </div>
            </div>
        </div>
        <div class="pricing-column">
            <div class="pricing-card business">
                <div class="pricing-header">
                    <span class="plan-title">Pro plan</span>
                    <div class="price-circle">
                        <span class="price-title">
                            <small>¥</small><span>1,000</span>
                        </span>
                        <span class="info">/ Month</span>
                    </div>
                </div>
                <div class="badge-box">
                    <span>Save 15%</span>
                </div>
                <ul>
                    <li>
                        <strong>Unlimited</strong> Requests per month
                    </li>
                    <li>
                        <strong>Unlimited</strong> Reference sources
                    </li>
                    <li>
                        <strong>Unlimited</strong> Exportation
                    </li>
                    <li>
                        <strong>Unlimited</strong> Result filtering
                    </li>
                    <li>
                        <strong>Unlimited</strong> API Access
                    </li>
                </ul>
                <div class="buy-button-box">
                    <a href="#" class="buy-now">Subscribe now</a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('page-js')
@endsection
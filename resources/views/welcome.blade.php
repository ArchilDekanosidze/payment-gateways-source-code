@extends('layouts.layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0"
                        src="{{asset('uploads/img1.png')}}"
                        alt="..." />
                    <div class="d-flex mt-2">
                        <div>
                            <img class="card-sub-img" src="{{asset('uploads/img1.png')}}" alt="">
                        </div>
                        <div>
                            <img class="card-sub-img" style="margin-left: 10px" src="{{asset('uploads/img2.png')}}" alt="">
                        </div>
                        <div>
                            <img class="card-sub-img" style="margin-left: 10px" src="{{asset('uploads/img3.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: BST-498</div>
                    <h1 class="display-5 fw-bolder">Shop item template</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through">$45.00</span>
                        <span>$40.00</span>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem
                        modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus
                        ipsam minima ea iste laborum vero?</p>
                    <div class="">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                            style="max-width: 3rem" />

                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <form action="{{route('paypal.payment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="40" name="price">
                                        <button type="submit" class="btn btn-outline-dark flex-shrink-0" type="button">
                                            <i class="bi-cart-fill me-1"></i>
                                            Buy With Paypal
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4 my-2">
                                    <form action="{{route('stripe.payment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="40" name="price">
                                        <button type="submit" class="btn btn-outline-dark flex-shrink-0" type="button">
                                            <i class="bi-cart-fill me-1"></i>
                                            Buy With Stripe
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4 my-2">
                                    <form action="{{route('razorpay.payment')}}" method="POST">
                                        @csrf
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{config('razorpay.key')}}"
                                                data-amount="{{ 40 * 100}}"
                                                data-buttontext="Pay With Razorpay"
                                                data-name="test payment"
                                                data-description="Payment"
                                                data-prefill.name="user"
                                                data-prefill.email="user@gmail.com"
                                                data-theme.color="#ff7529">
                                        </script>
                                   </form>
                                </div>
                                <div class="col-md-4 my-2">
                                    <a href="{{route('twocheckout.payment')}}" type="submit" class="btn btn-outline-dark flex-shrink-0" type="button">
                                        <i class="bi-cart-fill me-1"></i>
                                        Buy With 2CO
                                    </a>
                                </div>

                                <div class="col-md-6 my-2">
                                    <form action="{{route('instamojo.payment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="price" value="3700">
                                        <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                            <i class="bi-cart-fill me-1"></i>
                                            Buy With Instamojo
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4 my-2">
                                    <form action="{{route('mollie.payment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="price" value="40">
                                        <button type="submit" class="btn btn-outline-dark flex-shrink-0">
                                            <i class="bi-cart-fill me-1"></i>
                                            Buy With Mollie
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4 my-2">
                                    <a href="{{route('paystack.redirect')}}" type="submit" class="btn btn-outline-dark flex-shrink-0" type="button">
                                        <i class="bi-cart-fill me-1"></i>
                                        Buy With Paystack
                                    </a>
                                </div>
                                <div class="col-md-6 my-2">
                                    <form action="{{route('sslcommerz.pay')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-dark flex-shrink-0" >
                                            <i class="bi-cart-fill me-1"></i>
                                            Buy With Ssscommerz
                                        </button>
                                      </form>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Fancy Product</h5>
                                <!-- Product price-->
                                $40.00 - $80.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Special Item</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$20.00</span>
                                $18.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Sale Item</h5>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$50.00</span>
                                $25.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Popular Item</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                $40.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

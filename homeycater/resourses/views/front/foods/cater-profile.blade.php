@extends('front.website-layout')
@section('css')
<title>Cater Listing || {{ env('APP_NAME') }}</title>
<style>
    .category-slider img {
        height: 195px;
    }

    .error {
        color: red;
    }


.rating {
    border: none;
    margin-right: 49px
}

.myratings {
    font-size: 85px;
    color: green
}

.rating>[id^="star"] {
    display: none
}

.rating>label:before {
    margin: 5px;
    font-size: 2.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005"
}

.rating>.half:before {
    content: "\f089";
    position: absolute
}

.rating>label {
    color: #ddd;
    float: right
}

.rating>[id^="star"]:checked~label,
.rating:not(:checked)>label:hover,
.rating:not(:checked)>label:hover~label {
    color: #FFD700
}

.rating>[id^="star"]:checked+label:hover,
.rating>[id^="star"]:checked~label:hover,
.rating>label:hover~[id^="star"]:checked~label,
.rating>[id^="star"]:checked~label:hover~label {
    color: #FFED85
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
@endsection
@section('content')
<section class="section-padding wrap_m_cl">
    <div class="container">
        <h2 class="head_con">Lorem ipsum dolor sit amet, consectetuer. </h2>
        <hr>
        <p>When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
            of letters, as opposed to using 'Content here, Lorem Ipsum has been the industry's standard dummy text ever
            since. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor</p>
    </div>
</section>


<section class="shop-list section-padding">
    <div class="row">
        @include('front.includes.filter-sidebar')

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="shop-head">
                <div class="head_veg">
                    <a href="#"><span class="mdi mdi-home"></span> Home</a> <span class="mdi mdi-chevron-right"></span>
                    <a href="#">Caters food</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Caters List</a>
                    <span class="mdi mdi-chevron-right"></span> <a href="#">Caters Profile </a>
                </div>

            </div>
            <div class="profile_panel">
                <div class="profile_sec">
                    <div class="row no-gutters">
                        <div class="col-lg-4">
                            <div class="caters_profile_img">

                                <img src="{{asset('storage/'.@$cater->cater->personal_pic)}}" class="img-responsive"
                                    alt="Image">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="right_text_con_m">
                                <h3>{{ ucfirst( $cater->name ) }}</h3>
                                <div class="stra_rating_cl">
                                    <span><b> {{ $cater->user_ratting }} </b> </span>
                                    <span></span>
                                    @if($cater->user_ratting == 1)
                                    <span><i class="mdi mdi-star"></i></span>
                                    <span><i class="mdi mdi-star-outline"></i></span>
                                    <span><i class="mdi mdi-star-outline"></i></span>
                                    <span><i class="mdi mdi-star-outline"></i></span>
                                    <span><i class="mdi mdi-star-outline"></i></span>
                                    @elseif ($cater->user_ratting <= 1.5) <span><i class="mdi mdi-star"></i></span>
                                        <span><i class="mdi mdi-star-half"></i></span>
                                        <span><i class="mdi mdi-star-outline"></i></span>
                                        <span><i class="mdi mdi-star-outline"></i></span>
                                        <span><i class="mdi mdi-star-outline"></i></span>
                                        @elseif($cater->user_ratting == 2)
                                        <span><i class="mdi mdi-star"></i></span>
                                        <span><i class="mdi mdi-star"></i></span>
                                        <span><i class="mdi mdi-star-outline"></i></span>
                                        <span><i class="mdi mdi-star-outline"></i></span>
                                        <span><i class="mdi mdi-star-outline"></i></span>
                                        @elseif ($cater->user_ratting <= 2.5) <span><i class="mdi mdi-star"></i></span>
                                            <span><i class="mdi mdi-star"></i></span>
                                            <span><i class="mdi mdi-star-half"></i></span>
                                            <span><i class="mdi mdi-star-outline"></i></span>
                                            <span><i class="mdi mdi-star-outline"></i></span>
                                            @elseif($cater->user_ratting == 3)
                                            <span><i class="mdi mdi-star"></i></span>
                                            <span><i class="mdi mdi-star"></i></span>
                                            <span><i class="mdi mdi-star"></i></span>
                                            <span><i class="mdi mdi-star-outline"></i></span>
                                            <span><i class="mdi mdi-star-outline"></i></span>
                                            @elseif ($cater->user_ratting <= 3.5) <span><i
                                                    class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star-half"></i></span>
                                                <span><i class="mdi mdi-star-outline"></i></span>

                                                @elseif($cater->user_ratting == 4)
                                                <span><i class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star"></i></span>
                                                <span><i class="mdi mdi-star-outline"></i></span>
                                                @elseif ($cater->user_ratting <= 4.5) <span><i
                                                        class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star-half"></i></span>
                                                    @else
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    <span><i class="mdi mdi-star"></i></span>
                                                    @endif

                                </div>
                                <p>{{ @$cater->cater->intro }}</p>
                            </div>
                            <div class="d-flex justify-content-end pr-3 mb-2">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#caterRateUs">Rate
                                    Us</button>
                            </div>


                            <div wire:ignore.self class="modal fade" id="caterRateUs" tabindex="-1" role="dialog"
                                aria-labelledby="addGalleryModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="POST" id="caterRateForm">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addGalleryModalLabel">Rate us</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true close-btn">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label">Your Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name" name="name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 col-form-label">Your
                                                        Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ratting" class="col-sm-3 col-form-label">Ratting</label>
                                                    <div class="col-sm-9">
                                                        <fieldset class="rating">
                                                            <input type="radio" id="star5" checked name="rating" value="5" />
                                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                                            <input type="radio" id="star4" name="rating" value="4" />
                                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                            <input type="radio" id="star3" name="rating" value="3" />
                                                            <label class="full" for="star3" title="Meh - 3 stars"></label>

                                                            <input type="radio" id="star2" name="rating" value="2" />
                                                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                                            <input type="radio" id="star1" name="rating" value="1" />
                                                            <label class="full" for="star1" title="Sucks big time - 1 star"></label>

                                                            {{-- <input type="radio" class="reset-option" name="rating" value="reset" /> --}}
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="reviews" class="col-sm-3 col-form-label">Reviews</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="reviews" id="reviews"
                                                            rows="5"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row error_list">

                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary close-btn"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-info">Rate now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!---TAB DATA-->
            <div class="tab_heading">
                <ul class="nav nav-pills tab_profile" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#home">Personal Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#menu1">Other Info</a>
                    </li>
                </ul>
            </div>
            <div class="tab_data_profile">
                <div class="tab-content">
                    <div id="home" class="tab-pane"><br>
                        <table class="table table-striped tab_m_table">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ @$cater->name }}</td>
                                </tr>
                                @php
                                $dis_b = !empty(Auth::id()) ? '' : 'none';
                                $dis_n = !empty(Auth::id()) ? 'none' : '';
                                @endphp
                                <tr class="contact_detail" style="display:{{$dis_n}}">
                                    <th>Contact Details</th>
                                    <td><button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#contactDetail">Show Detail</button></td>
                                </tr>
                                <tr class="hhh" style="display: {{ $dis_b }}">
                                    <th>Email</th>
                                    <td>{{ @$cater->email }}</td>
                                </tr>
                                <tr class="hhh" style="display:{{ $dis_b }}">
                                    <th>Contact Number</th>
                                    <td>{{ @$cater->cater->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ @$cater->cater->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Neighbrhood</th>
                                    <td>{{ @$cater->cater->neighborhood }}</td>
                                </tr>
                                <tr>
                                    <th>Town</th>
                                    <td>{{ @$cater->cater->town }}</td>
                                </tr>
                                <tr>
                                    <th>Contact to cater</th>
                                    <td><button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#caterContact">Send Email</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="menu1" class="tab-pane fade active show"><br>
                        <table class="table table-striped tab_m_table">
                            <tbody>
                                <tr>
                                    <th>Notice</th>
                                    <td>{{ @$cater->cater->notice }}</td>
                                </tr>
                                <tr>
                                    <th>Speciality</th>
                                    <td>{{ @$cater->cater->speciality }}</td>
                                </tr>
                                <tr>
                                    <th>Menu - Dish name + pic</th>
                                    <td class="dis_name_h">
                                        @foreach ($cater->caterMenus as $caters)
                                        <span>
                                            {{-- <img src="img/nuddles.jfif" class="img-responsive" alt="Image"> --}}
                                            <p>{{ $caters->dish->name }}</p>
                                        </span>
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <th>Home delivery available</th>
                                    <td>{{ ucfirst(@$cater->cater->home_delivery) }}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ @$cater->email }}</td>
                                </tr>
                                <tr>
                                    <th>Minimum Order</th>
                                    <td>{{@$cater->cater->min_order_catering }}</td>
                                </tr>
                                <tr>
                                    <th>Maximum Order</th>
                                    <td> {{@$cater->cater->large_order_catering }}</td>
                                </tr>
                                <tr>
                                    <th>Covid-19 Vaccinated</th>
                                    <td>{{ ucfirst(@$cater->covidDetails->covid_vaccinated) }}</td>
                                </tr>
                                <tr>
                                    <th>Cooking Place Cleaniess (Scalte 1-10)</th>
                                    <td>{{ @$cater->covidDetails->cleaniess }}</td>
                                </tr>

                                <tr>
                                    <th>Highen care - use glove, face mask, head hair cover</th>
                                    @php
                                    $data =json_decode(@$cater->covidDetails->highen_care);
                                    @endphp
                                    <td>
                                        <div class="Keyword_tag">
                                            @if (!empty($data))

                                            @forelse ($data as $d)
                                            <span> {{ucfirst($d)}}</span>
                                            @empty

                                            @endforelse
                                            @endif


                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pictures of dishes, kitchen personal</th>
                                    <td class="dis_pi">
                                        @foreach ($cater->gallery as $gallery)
                                        <span class="gallery">
                                            <a href="{{asset('storage/'.@$gallery->image)}}">
                                                <img class="img-fluid" src="{{asset('storage/'.@$gallery->image)}}"
                                                    alt="image">
                                            </a>
                                        </span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Video, Limited Size and Number</th>
                                    <td class="dis_pi">
                                        @foreach (@$cater->video as $vid)
                                        <span>
                                            <video width="100" height="60" controls>
                                                <source src="{{asset('storage/'.@$vid->video)}}" type="video/mp4">
                                            </video>
                                        </span>
                                        @endforeach
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div wire:ignore.self class="modal fade" id="contactDetail" tabindex="-1" role="dialog"
    aria-labelledby="addGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="contactDetailForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGalleryModalLabel">Contact Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Contact No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone">

                        </div>
                    </div>
                    <div class="form-group row error_list">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="caterContact" tabindex="-1" role="dialog"
    aria-labelledby="addGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="caterContactForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGalleryModalLabel">Send Message TO Cater</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="cater_id" id="" value="{{@$cater->id}}">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Your Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Your Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-3 col-form-label">Message</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group row error_list">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.3.2/js/lightgallery.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(".gallery").lightGallery();
$(document).ready(function(){
    $('form#contactDetailForm').on('submit', function (e) {
        e.preventDefault();
        var postData =$('form#contactDetailForm').serialize();
        $.ajax({
            type: "post",
            url: "{{ route('web.saveGuestDetail')}}",
            data: postData,
            success: function(responseData, textStatus, jqXHR) {
                $('#contactDetail').modal('hide');
                $('.hhh').css('display','');
                $('.contact_detail').css('display','none');
                $("#contactDetailForm")[0].reset();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var errors =  $.parseJSON(jqXHR.responseText).errors;
                $('#contactDetailForm .error_list').empty();
                $.each( errors, function( key, value ) {
                    $('#contactDetailForm .error_list').append('<div class="col-sm-9 error"> '+key+' :'+value+'</div>');
                });
            }
        })
    });
    $('form#caterContactForm').on('submit', function (e) {
        e.preventDefault();
        var postData =$('form#caterContactForm').serialize();
        $.ajax({
            type: "post",
            url: "{{ route('web.sendEmailToCater')}}",
            data: postData,
            success: function(responseData, textStatus, jqXHR) {
                $("#caterContactForm")[0].reset();
                $('#caterContact').modal('hide');
                swal("Send successfully!", "your message have been send successfully!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var errors =  $.parseJSON(jqXHR.responseText).errors;
                $('#contactDetailForm .error_list').empty();
                $.each( errors, function( key, value ) {
                    $('#caterContactForm .error_list').append('<div class="col-sm-9 error"> '+key+' :'+value+'</div>');
                });
            }
        })
    });

    $('form#caterRateForm').on('submit', function (e) {
        e.preventDefault();
        var postData =$('form#caterRateForm').serialize();
        $.ajax({
            type: "post",
            url: "{{ route('web.rate.cater', $cater->id)}}",
            data: postData,
            success: function(responseData, textStatus, jqXHR) {
                swal("Rated successfully!", "your rating have been saved successfully!");
                $('#caterRateUs').modal('hide');
                window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var errors =  $.parseJSON(jqXHR.responseText).errors;
                $('#caterRateForm .error_list').empty();
                $.each( errors, function( key, value ) {
                    $('#caterRateForm .error_list').append('<div class="col-sm-9 error"> '+key+' :'+value+'</div>');
                });
            }
        })
    });

});
</script>

@endsection

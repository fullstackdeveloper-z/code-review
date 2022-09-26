@extends('front.website-layout')
@section('css')

@endsection


@section('breadcrumb')
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="{{ route('web.home') }}">
					<strong>
						<span class="mdi mdi-home"></span> Home
					</strong>
				</a>
				<span class="mdi mdi-chevron-right"></span>
				<a href="javascript:void(0)">FAQs</a>
			</div>
		</div>
	</div>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="card mb-0">
                            <div class="card-header" id="headingOne">
                                <h6 class="mb-0">
                                    <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="icofont icofont-question-square"></i> Where can I get access to Capital IQ?
                                    </a>
                                </h6>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil helvetica, craf.
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2 mt-2">
                            <div class="card-header" id="headingTwo">
                                <h6 class="mb-0">
                                    <a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <i class="icofont icofont-question-square"></i> How do I get access to case studies?
                                    </a>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil helvetica, craf.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h6 class="mb-0">
                                    <a href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <i class="icofont icofont-question-square"></i> How much should I capitalize?
                                    </a>
                                </h6>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil helvetica, craf.
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h6 class="mb-0">
                                    <a href="#" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapseThree">
                                        <i class="icofont icofont-question-square"></i> How much should I capitalize?
                                    </a>
                                </h6>
                            </div>
                            <div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil helvetica, craf.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

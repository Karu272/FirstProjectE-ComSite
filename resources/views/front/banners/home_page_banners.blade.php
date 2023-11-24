
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($getCaruselImg as $key => $img)
                <div class="item @if ($key==1) {{ 'active' }} @endif">
                    <div class="container">
                        <a @if (!empty($img['first'])) href="{{ URL($img['first']) }}" @else href="javascript:void(0)" @endif>
                            <img style="width: 100%" src="{{ asset('images/banner_images/' . $img['caruselImg']) }}"
                                alt="{{ $img['second'] }}" title="{{ $img['second'] }}" />
                        </a>
                        <div class="carousel-caption overlay" >
                            <div class="content">
                                <div class="text wow bounceIn animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.2s; -webkit-animation-delay: 0.2s; animation-name: bounceIn; -webkit-animation-name: bounceIn;">
                                </div>
                            </div>
                          </div>
                       </div>
                </div>
            @endforeach
        </div>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    </div>

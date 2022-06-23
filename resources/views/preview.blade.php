<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Luach Zmanim</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="max-age=0">
    <meta http-equiv="cache-control" content="no-cache">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link type="image/x-icon" href="{{ asset('images/favicon.ico') }}" rel="shortcut icon">
    <style>
        body {
            background-color: black;
            overflow: hidden;
        }
        .layout {
            margin:0 auto;
            background-color: var(--accent-color-dark);
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
        }

        .layout.landscape {
            width: 100%;
        }

        .layout.portrait {
            height: 100%;
        }

        .media {
            position: absolute;
            border-style: dashed;
            border-width: 4px;
            border-color: transparent;
            z-index: 10;
        }

        .media.text, .media.ticker {
            padding: 0px 10px;
        }

        .media.image img, .media.video video {
            width: 100%;
            height: 100%;
        }

        .media.ticker {
            overflow: hidden;
            margin: 0 auto;
            padding: 0;
        }

        .media.ticker p {
            text-align:center;
            animation-name: ticker;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            padding-left: 100%;
            white-space: nowrap;
            display: inline-block;
        }

        @keyframes ticker {
        0%{
            transform: translate(0, 0);
        }
        
        100%{
            transform: translate(-100%, 0);
        }
        }
    </style>
</head>
<body>
    <div class="layout {{ $layout['orientation'] }}" 
    style="
            @if(!empty($layout['backgroundColor'])) background-color:{{ $layout['backgroundColor'] }}; @endif
            @if(!empty($layout['backgroundImage'])) background-image:url({{ $layout['backgroundImage'] }}); @endif
            @if(!empty($layout['backgroundSize'])) background-size:{{ $layout['backgroundSize'] }}; @endif"
    >
        @foreach ($layout['media'] as $media)
            
            @if($media['type'] === 'image')

                <div class="media {{ $media['type'] }}" style="
                    top:{{ $media['percentTop'] }}%;
                    left:{{ $media['percentLeft'] }}%;
                    width:{{ $media['percentWidth'] }}%;
                    height:{{ $media['percentHeight'] }}%;">
                    <img src="{{ $media['src'] }}" />
                </div>

            @elseif($media['type'] === 'video')

                <div class="media {{ $media['type'] }}" style="
                    top:{{ $media['percentTop'] }}%;
                    left:{{ $media['percentLeft'] }}%;
                    width:{{ $media['percentWidth'] }}%;
                    height:{{ $media['percentHeight'] }}%;
                    background-color:#000;">
                    <video src="{{ $media['src'] }}" {{ $media['autoplay'] ? 'autoplay' : '' }} {{ $media['loop'] ? 'loop' : '' }} muted></video>
                </div>

            @elseif($media['type'] === 'text')

                <div class="media {{ $media['type'] }}" style="
                    top:{{ $media['percentTop'] }}%;
                    left:{{ $media['percentLeft'] }}%;
                    width:{{ $media['percentWidth'] }}%;
                    height:{{ $media['percentHeight'] }}%;
                    font-size:{{ $media['fontSize'] }}px;
                    color:{{ $media['color'] }};
                    text-align:{{ $media['alignment'] }};">
                    <p>{{ $media['text'] }}</p>
                </div>

            @elseif($media['type'] === 'ticker')

                <div class="media {{ $media['type'] }}" style="
                    top:{{ $media['percentTop'] }}%;
                    left:{{ $media['percentLeft'] }}%;
                    width:{{ $media['percentWidth'] }}%;
                    height:{{ $media['percentHeight'] }}%;
                    font-size:{{ $media['fontSize'] }}px;
                    color:{{ $media['color'] }};">
                    <p style="animation-duration:{{ $media['duration'] }}s;">{{ $media['text'] }}</p>
                </div>

            @endif

        @endforeach
    </div>

<script>
    window.addEventListener('resize', resize);
    resize();
    function resize() {
        let layout = document.querySelector(".layout");
        let width = 0;
        let height = 0;
        @if($layout['orientation'] == 'landscape')
            width = layout.offsetWidth;
            height = width / (16 / 9);
            layout.style.height = height + "px";
        @elseif($layout['orientation'] == 'portrait')
            height = layout.offsetHeight;
            width = height / (16 / 9);
            layout.style.width = width + "px";
        @endif

        
        
    }
    
</script>
</body>
</html>
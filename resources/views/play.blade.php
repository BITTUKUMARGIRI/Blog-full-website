<!DOCTYPE html>
<html>
<head>
    <title>{{ $videos->title }}</title>

    <style>

        body{
            background:#000;
            margin:0;
            font-family:Arial;
            color:white;
        }

        .player-container{

            position:relative;

            width:90%;
            max-width:1000px;

            margin:40px auto;
        }

        video{

            width:100%;
            border-radius:10px;
            background:black;
        }

        /* CONTROLS OVER VIDEO */

        .controls{

            position:absolute;

            bottom:20px;
            left:0;

            width:100%;

            padding:0 20px;

            box-sizing:border-box;
        }

        .buttons{

            display:flex;

            align-items:center;

            gap:10px;

            margin-bottom:10px;
        }

        button{

            border:none;

            background:rgba(255,255,255,0.2);

            color:white;

            padding:10px 15px;

            border-radius:50px;

            cursor:pointer;

            backdrop-filter:blur(5px);

            font-size:16px;
        }

        button:hover{

            background:red;
        }

        /* SLIDER */

        #progress{

            width:100%;

            cursor:pointer;
        }

        .time{

            margin-top:5px;

            font-size:14px;

            color:#ddd;
        }

    </style>

</head>

<body>

<div class="player-container">

    <!-- VIDEO -->

    <video
        id="myVideo"
        preload="metadata"
        playsinline
    >

        <source
            src="{{ asset('storage/'.$videos->video) }}"
            type="video/mp4">

    </video>


    <!-- CONTROLS -->

    <div class="controls">

        <div class="buttons">

            <!-- <button onclick="backward()">
                ⏪ 10s
            </button> -->

            <button onclick="playPause()">
                ▶ / ⏸
            </button>

            <!-- <button onclick="forward()">
                ⏩ 10s
            </button> -->

            <button onclick="fullscreen()">
                ⛶
            </button>

        </div>
        <div class="btn like-btn">
            <form action="{{ route('save', $videos->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn"> Save</button>
            </form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <!-- SLIDER -->

        <input
            type="range"
            id="progress"
            value="0"
            min="0"
            max="100"
        >


        <!-- TIME -->

        <div class="time" id="time">

            0:00 / 0:00

        </div>

    </div>

</div>


<script>

    const video =
        document.getElementById("myVideo");

    const progress =
        document.getElementById("progress");

    const time =
        document.getElementById("time");



    // IMPORTANT

    video.addEventListener(
        "loadedmetadata",
        ()=>{

            progress.max =
                Math.floor(video.duration);
        }
    );



    // PLAY / PAUSE

    function playPause(){

        if(video.paused){

            video.play();

        }else{

            video.pause();
        }
    }



    // FORWARD

    function forward(){

        if(!isNaN(video.duration)){

            video.currentTime += 10;
        }
    }



    // BACKWARD

    function backward(){

        if(!isNaN(video.duration)){

            video.currentTime -= 10;
        }
    }



    // FULLSCREEN

    function fullscreen(){

        if(video.requestFullscreen){

            video.requestFullscreen();
        }
    }



    // UPDATE SLIDER

    video.addEventListener(
        "timeupdate",
        ()=>{

            progress.value =
                video.currentTime;

            updateTime();
        }
    );



    // SEEK VIDEO

    progress.addEventListener(
        "input",
        ()=>{

            video.currentTime =
                progress.value;
        }
    );



    // FORMAT TIME

    function format(seconds){

        if(isNaN(seconds)) return "0:00";

        let mins =
            Math.floor(seconds / 60);

        let secs =
            Math.floor(seconds % 60);

        if(secs < 10){

            secs = "0" + secs;
        }

        return mins + ":" + secs;
    }



    // UPDATE TIME

    function updateTime(){

        time.innerText =

            format(video.currentTime)

            + " / " +

            format(video.duration);
    }

</script>

</body>
</html>
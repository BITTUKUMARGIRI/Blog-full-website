  <div style="position:relative; min-height:80px;">
    <form action="{{ route('search') }}" method="GET" style="position:absolute; top:20px; right:20px;">
        <input type="text" name="search" placeholder="Search video..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
</div>
<div class="video-container">

    @foreach($videos as $video)
        <div class="video-card">
            <video controls>
                <source src="{{ asset('storage/' . $video->video) }}">
            </video>

            <h3>{{ $video->title }}</h3>

            <div class="video-actions">
                <a href="{{ route('play', $video->id) }}" class="play-btn">▶ Play</a>
                @if(auth()->check() && auth()->user()->role === 'admin' && auth()->id() === $video->video_id)
    <a href="{{ url('/videos/' . $video->id . '/manage') }}" class="manage-btn">Manage</a>
@endif
            </div>
        </div>
    @endforeach
    @forelse($videos as $video)
    <!-- <h3>did you mean :{{ $video->title }}</h3> -->
@empty
    <p>No videos found matching your search.</p>
@endforelse
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .video-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .video-card {
        width: 320px;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    .video-card video {
        width: 100%;
        border-radius: 8px;
    }

    .video-card h3 {
        margin: 12px 0;
        font-size: 20px;
        color: #333;
    }

    .video-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .play-btn,
    .manage-btn {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        color: white;
        font-size: 14px;
    }

    .play-btn {
        background: #28a745;
    }

    .manage-btn {
        background: #007bff;
    }
</style>
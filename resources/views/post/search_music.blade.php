<div class="music-container">
    @foreach($musics as $music)
        <div class="music-card">
            <div class="music-info">
                <div>
                    <div class="music-title">{{ $music->music_title }}</div>
                    <div class="music-artist">{{ $music->music_artist }}</div>
                </div>
                <div class="music-controls">
                    <audio controls class="audio-player" src="{{ asset('music/'. $music->music_url) }}"></audio>
                </div>
            </div>
        </div>
    @endforeach
</div>

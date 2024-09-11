<h1>Моя музыка</h1>
<div class="search-container">
    <input type="text" id="music-search" placeholder="Поиск друзей...">
    <button onclick="searchMyMusic()">Поиск</button>
</div>
<div id="music-results" class="music-container">
    @foreach($userMusic as $track)
        <div class="music-card">
            <div class="music-info">
                <div>
                    <div class="music-title">{{ $track->music_title }}</div>
                    <div class="music-artist">{{ $track->music_artist }}</div>
                </div>
                <div class="music-controls">
                    <audio controls class="audio-player" src="{{ asset('music/'. $track->music_url) }}"></audio>
                </div>
            </div>
        </div>
    @endforeach
</div>

<h1>Музыка</h1>
<div class="search-container">
    <input type="text" id="music-search" placeholder="Поиск друзей...">
    <button onclick="searchAllMusic()">Поиск</button>
</div>
<div id="music-results" class="music-container">
@foreach($Musics as $tracks)
        <div class="music-card">
            <div class="music-info">
                <div>
                    <div class="music-title">{{ $tracks->music_title }}</div>
                    <div class="music-artist">{{ $tracks->music_artist }}</div>
                </div>
                <div class="music-controls">
                    <audio controls class="audio-player" src="{{ asset('music/'. $tracks->music_url) }}"></audio>
                </div>
            </div>
        </div>
    @endforeach
</div>

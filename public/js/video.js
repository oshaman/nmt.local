var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var hash = window.location.search
var obj = {}
if (hash) {
    hash = hash.split('&');
    for (i = 0; i < hash.length; i++) {
        var temp = hash[i].split('=');
        obj[temp[0]] = temp[1]
    }
}


$('body').append('<div id="player5"></div>')

function onYouTubeIframeAPIReady() {
    allInOne();

}

console.log(obj);

function allInOne() {
    var player5;
    var videoStoped = false;

    function bigVideoInit() {
        // 1 инит большого экрана teamm = 0
        player5 = new YT.Player('player5', {
            height: '350',
            width: '540',
            videoId: obj.video,
            events: {
                'onReady': bigPlayVideo,
                'onStateChange': changeVid
            }
        });
    }

    bigVideoInit()

    function bigPlayVideo(e) {
        if (videoStoped) {
            return
        }
        player5.seekTo(obj.time, true);
        player5.playVideo();

        obj.mute == 'true' ? player5.mute() : player5.unMute();
    }

    function changeVid(e) {
    }
}
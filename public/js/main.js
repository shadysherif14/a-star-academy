$(document).ready(function () {

    /*
     * Get all the videos
     */
    let videos = $('video source');

/*     videos.each(function () {
        let src = this.attr('src');

        let blob = new Blob([src]);

        let url = URL.createObjectURL(blob);

        this.attr('src', url)

    }); */
});

// Tooltips Initialization
function initTooltip() {
    var options = {
        trigger: 'manual',
        title: function(){
            return $(this).attr('title');
          }
    };
    $('[data-toggle="tooltip"]').tooltip(options);
  }
/*************************************************/
/*************************************************/
/*************************************************/
  $(window).on('load',function(){

    initTooltip();
    $('#guide').show().animate();
    $('[data-toggle="tooltip"]').tooltip('show');

    // Play Audio #1
    document.getElementById('audio-player').play();

    // Play Audio #2 after Audio #1 ends
    $("#audio-player").on('ended',function(){

        $('.tooltip-inner').text("Please choose your school by clicking on one of these sections.");
        document.getElementById('audio-2').play();
       
    });

  });

/*************************************************/
/*************************************************/
/*************************************************/
function chooseSchool(e){

    let school = e.id;
    window.location.replace("/school/"+school);
}

/*************************************************/
/*************************************************/
/*************************************************/
$('#mute').click(function (){
    if (!document.getElementById('audio-player').muted){
        document.getElementById('audio-player').muted = true;
        $('#mute img').attr('src','res/mute.png');

    }
    else{
        document.getElementById('audio-player').muted = false;
        $('#mute img').attr('src','res/unmuted.png');
    }

    if (!document.getElementById('audio-2').muted){
        document.getElementById('audio-2').muted = true;
        $('#mute img').attr('src','res/mute.png');

    }
    else{
        document.getElementById('audio-2').muted = false;
        $('#mute img').attr('src','res/unmuted.png');

    }
})
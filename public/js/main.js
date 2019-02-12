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
    //document.getElementById('audio-player').play();

    // Play Audio #2 after Audio #1 ends
    $("#audio-player").on('ended',function(){

        $('.tooltip-inner').text("Please choose your school by clicking on one of these sections.");
        document.getElementById('audio-2').play();
       
    });

  });

/*************************************************/
/*************************************************/
/*************************************************/

$('.upper').on('click', function(e) {

    if (e.target !== this)
    return;
    
    $(this).animate({
        bottom: '0',
        top: '-50%'
    },750)

    $('.lower').animate({
        top: '100%',
    },750)

    $('.holder1').show();
    $('.igCloseBtn').show(); 


})



$('.lower').on('click', function(e) {

    if (e.target !== this)
    return;
  
    $(this).animate({
        top: '-50%',
    },750)

    $('.upper').animate({
        bottom: '100%',
    },750)

    $('.holder2').show();
    $('.americanCloseBtn').show();


})



$('.igCloseBtn').click(function(){

    $('.holder1').hide();
    $('.igCloseBtn').hide();

    

    $('.upper').animate({
        bottom: '50%',
        top: '0'
    },750)

    $('.lower').animate({
        top: '50%',
    },750)


});


$('.americanCloseBtn').click(function(){

    $('.holder2').hide();
    $('.americanCloseBtn').hide();
    
    $('.upper').animate({
        bottom: '50%',
    },750)

    $('.lower').animate({
        top: '50%',
    },750)

   
});



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

$('#loginBtn a').click(function () {
   
    window.location.assign($(this).attr('href'));

});

$('#signupBtn a').click(function () {

    window.location.assign($(this).attr('href'));

});


$('#igSubmitBtn').click(function(){
    if($("input:radio[name='grade']").is(":checked")) {
        let grade = $("input:radio[name='grade']:checked").val();
        
        window.location.assign(`/ig/courses/${grade}`);
    }
    else{
        alert('Please select grade first');
       
    }
    
})
$('#americanSubmitbtn').click(function(){
    event.preventDefault();
    if($("input:radio[name='course']").is(":checked")) {
        let course = $("input:radio[name='course']:checked").val();
        //$('#satForm').attr('action',`/sat/courses/${course}`);
        //$('#satForm').submit();
        //return;
        window.location.assign(`/sat/courses/${course}`);
    }
    else{
        alert('Please select course first');
        
    }
    
})
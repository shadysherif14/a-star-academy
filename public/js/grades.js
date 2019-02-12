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

    // Play Audio #3
    document.getElementById('audio-3').play();

});

/*************************************************/
/*************************************************/
/*************************************************/
document.addEventListener("DOMContentLoaded", function(){
    let rise = function(trigEl) {
            trigEl.blur();

            let ul = document.querySelector("ul");

            ul.classList.add("rise");
            trigEl.classList.add("pop");

            setTimeout(function(){
                trigEl.focus();

                ul.classList.remove("rise");
                trigEl.classList.remove("pop");
            }, 1000);
        };

    this.querySelectorAll("li a").forEach(function(el){
        let rt = document.querySelector(":root"),
            di = +el.getAttribute("data-item");
            // User has choosen grade
            el.addEventListener("click",function(){
                rt.style.setProperty("--rotateTimes",di);

                // Not the middle circle
                if ($(this).attr('href') !== '#'){

                    rise(this); //animation

                    $('#grades').hide();

                    let grade = $(this).attr('data-item') + 7;

    
                    $('#system').css('position','absolute');
                    $('#system').css('top','0');
                    $('#system').css('right','0');
                    $('#system').show();

                    // Play Audio #4 AND pause Audio #3
                    let aud = document.getElementById('audio-3');

                    if(aud.currentTime || !aud.paused){
                        aud.pause();
                    }

                    $('.tooltip-inner').text("The last thing to do is to choose your school system and level. Once you are done click \"Explore courses\" to see available courses.");
                    $('.tooltip').css('width','300px');
                    $('.tooltip').addClass('above');
                    $('.tooltip-inner').css('max-width','100%');
                    
                    document.getElementById('audio-4').play();
                    
                    
                    
                }
               

        });
        
    });
});

// Material Select Initialization

$(document).ready(function() {
    $('.mdb-select').material_select();
  });
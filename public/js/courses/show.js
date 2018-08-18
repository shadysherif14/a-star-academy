const player = new Plyr('#videoPlayer');


$('#enrollBtn').click(function(){

})


$('.list-item').click(function(){
    
    let id = $(this).attr('id');

    $('.list-item.active').removeClass('active');

    $(this).addClass('active');

    $.ajax({
        type: 'POST',
        url: '/sat/video',
        data: {
            video_id:  id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            let path = response.video.path;
            player.source = {
                type: 'video',
                title: 'Example title',
                sources: [
                    {
                        src: path,
                        type: 'video/mp4',
                        size: 720,
                    },
                ],
                
            };
            
            console.log(response)
        },
        
    });
})
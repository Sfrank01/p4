//  You can now use jQuery selectors to replace links with embedded content
$('#content a').embedly({key: '7f6cf7cec28511e0866c4040d3dc5c07'});


//Embedly requires that you pass a key with every request. To signup for a key please visit app.embed.ly/signup. 
//To avoid adding your key to every $.embedly call you can add it to the defaults like so:

    $.embedly.defaults.key = '7f6cf7cec28511e0866c4040d3dc5c07';
     
    # Directly
    $.embedly.extract('http://embed.ly').progress(function(data){alert(data.title)});
     
    # CSS Selector
    $('a').embedly();


    // Clean up the input after focus.
    $('.comment-add input').on('focus', function(){
    $('.comment-add input')
    .removeClass('error')
    .siblings('small').remove();
    })
     
    // Add media button.
    $('.comment-add .comment-media').on('click', function(){
    var $button = $(this);
    var $input = $('.comment-add input');
    var url = $input.val();
     
    // Add the spinner via Font-Awesome
    $button.html('<i class="fa fa-spin fa fa-spinner"></i>');
    // Set the input to disabled.
    $input.attr('disabled', 'disabled');
     
    // Call Embedly.
    $.embedly.oembed(url, {query:{maxwidth: 400} })
    .progress(function(obj){
    // Remove the spinner
    $button.html('Add');
    // check types.
    if (obj.type === 'photo'){
    // Add Image.
    $('.comment-add p').append(sprintf('<img src="%(url)s"/>', obj));
    } else if (obj.type === 'rich' || obj.type === 'video'){
    // Add Video or Rich.
    $('.comment-add p').append(obj.html);
    } else {
    // Just a link type, so throw an error to the user.
    $input.addClass('error')
    .removeAttr('disabled')
    .after('<small class="error">Invalid URL</small>');
    return false;
    }
    // Removed disabled and clear input.
    $('.comment-add input').removeAttr('disabled').val('');
    });
    })
     
    $('.comment-post').on('click', function(){
    // Add the comment to comments.
    var html = $('.comment-add p').html();
     
    // Time of post.
    var date = new Date();
    var time = date.getHours()+':'+date.getMinutes();
     
    // Create the comment from the html.
    var $comment = $(['<div class="comment"><p>',
    html,
    '</p><p><i class="fa fa-comment-alt"></i> ',
    'By <span>Anonymous</span>',
    ' at <time>2:45pm</time></p></div>'].join(''));
     
    // Add the comment.
    $('.comments').append($comment);
     
    // Clean up after yourself.
    $('.comment-add input').val('');
    $('.comment-add p').html('');
    })

	//You can now use jQuery selectors to replace links with embedded content:   API Key: API Key: 83298a8109b44e059a7d666964c02c33 


function nextMsg() {
            var picture = 0;
            if (messages.length == 0) {
                //reload array
                messages = [
                    "Търсиш<span>?</span>",
                    "Обучение<span>?</span>",
                    "Забавление<span>?</span>",
                    "Спорт<span>?</span>"
                ].reverse();
                nextMsg();
            } else {
                $('#message').html(messages.pop()).fadeIn(600).delay(8000).fadeOut(600,
                    function() {
                        $('.top-bar').stop().animate({
                            opacity: 0
                        }, 200, function() {
                            if (messages.length == 3) {
                                picture = 0;
                            } else {
                                picture = messages.length + 1;
                            };
                            $(this).css({
                                background: "-webkit-linear-gradient( rgba(255, 255, 255, .6), rgba(255, 255, 255, .6)), url(img/img_header" + (
                                    picture
                                ) + ".jpg)"
                            });
                            $(this).css({
                                background: "linear-gradient( rgba(255, 255, 255, .6), rgba(255, 255, 255, .6)), url(img/img_header" + (picture) + ".jpg)"
                            });
                        }).animate({
                            opacity: 1
                        }, {
                            duration: 200
                        });
                        nextMsg();
                    })
            } //end of else
        }; //end of function
        // list of h1 to display
        var messages = [
            "Търсиш<span>?</span>",
            "Обучение<span>?</span>",
            "Забавление<span>?</span>",
            "Спорт<span>?</span>"
        ].reverse();
        // initially hide the message
        $('#message').hide();
        // start animation
        nextMsg();
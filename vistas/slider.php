<!DOCTYPE html>
<html>
<head>
    <script
            src="http://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
</head>

<body>
<style>
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }

    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }

    body {
        line-height: 1;
    }

    ol, ul {
        list-style: none;
    }

    blockquote, q {
        quotes: none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    body{
        background: black;
    }

    .mySlides {
        display: none;
        width: 100%;
        height: 100%;
        background-repeat: no-repeat !important;
        background-position: center !important;
    }

    .slider {
        width: 100%;
        position: absolute;
        height: 100%;
        top: 0;
        height: 100%;
    }

</style>


<div class="slider">

</div>

<script>

    var myIndex = 0;


    $.ajax({
        url: "http://local.efphp.com/?s=gallery&ajax=true&json=true",
    }).done(function (data) {
        if (console && console.log) {

            var data = eval(data);
            for (var x in data) {

                console.log(data[x]);
                $('.slider').append('<div class="mySlides" style="background: url(' + data[x].image_src + ')"></div>');
            }

        }

        carousel();
    });


    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {


            x[i].style.display = "none";

            $(x[i]).fadeOut();
        }

        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }

        $(x[myIndex - 1]).fadeIn();

        setTimeout(carousel, 10000);
    }

    setTimeout(function () {
        window.location.reload(1);
    }, (60000) * 2);

</script>
</body>
</html>
